@section ('scripts')
    <style>
        .blueprint-grid {
            background-color: #fcfcfc;
            background-image:
                linear-gradient(#f0efea 1px, transparent 1px),
                linear-gradient(90deg, #f0efea 1px, transparent 1px);
            background-size: 16px 16px;
            background-position: center;
        }
        .dark .blueprint-grid {
            background-color: #0b0f19;
            background-image:
                linear-gradient(#1e293b 1px, transparent 1px),
                linear-gradient(90deg, #1e293b 1px, transparent 1px);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const customers = {!! json_encode($ukuranPelanggan) !!};
            console.log('CEK DATA CUSTOMERS:', customers);

            let activeType = 'KEMEJA';
            let selectedCustomer = customers.length > 0 ? customers[0] : null;
            let currentScale = 1.0;

            // DOM Elements
            const customerSearchInput = document.getElementById('customer-search-input');
            const customerSearchResults = document.getElementById('customer-search-results');
            const selectedCustomerCard = document.getElementById('selected-customer-card');

            // Init display values
            updateSelectedCustomerCard();
            renderSVG();
            updateEstimates();

            // Event listener garment cards
            document.querySelectorAll('.garment-type-card').forEach((card) => {
                card.addEventListener('click', function () {
                    document.querySelectorAll('.garment-type-card').forEach((c) => {
                        c.classList.remove('border-primary', 'bg-primary/5');
                        c.classList.add('border-[#EFECE6]', 'dark:border-slate-800');
                        // restore icon/text gray colors
                        const icon = c.querySelector('svg');
                        const text = c.querySelector('span');
                        if (icon) {
                            icon.classList.remove('text-primary', 'dark:text-accent');
                            icon.classList.add('text-gray-400');
                        }
                        if (text) {
                            text.classList.remove('text-primary', 'dark:text-accent');
                            text.classList.add('text-gray-500', 'dark:text-slate-400');
                        }
                    });

                    this.classList.remove('border-[#EFECE6]', 'dark:border-slate-800');
                    this.classList.add('border-primary', 'bg-primary/5');
                    const activeIcon = this.querySelector('svg');
                    const activeText = this.querySelector('span');
                    if (activeIcon) {
                        activeIcon.classList.remove('text-gray-400');
                        activeIcon.classList.add('text-primary', 'dark:text-accent');
                    }
                    if (activeText) {
                        activeText.classList.remove('text-gray-500', 'dark:text-slate-400');
                        activeText.classList.add('text-primary', 'dark:text-accent');
                    }

                    activeType = this.getAttribute('data-type');
                    renderSVG();
                    updateEstimates();
                });
            });

            // Customer search selector
            if (customerSearchInput) {
                customerSearchInput.addEventListener('input', function () {
                    const query = this.value.trim().toLowerCase();
                    if (query === '') {
                        customerSearchResults.classList.add('hidden');
                        return;
                    }

                    const matched = customers.filter((c) => c.nama_pelanggan.toLowerCase().includes(query));
                    if (matched.length === 0) {
                        customerSearchResults.innerHTML = `<div class="px-4 py-2 text-xs text-gray-400">Tidak ada pelanggan ditemukan</div>`;
                    } else {
                        customerSearchResults.innerHTML = matched
                            .map(
                                (c) => `
                                                                            <button type="button" class="w-full text-left px-4 py-2 text-xs text-slate-800 dark:text-slate-200 hover:bg-gray-50 dark:hover:bg-slate-700 flex items-center gap-2" onclick="selectCustomer(${c.id})">
                                                                                <span class="w-5 h-5 rounded-full ${c.avatar_bg} font-bold text-[9px] flex items-center justify-center">${c.inisial}</span>
                                                                                <span>${c.nama_pelanggan}</span>
                                                                            </button>
                                                                        `
                            )
                            .join('');
                    }
                    customerSearchResults.classList.remove('hidden');
                });
            }

            window.selectCustomer = function (id) {
                // Fetch the latest customers list if available/necessary
                // Optional: sync customers via AJAX here if backend fetch is needed

                // Pastikan customers terbaru sudah tersedia sebelum assignment
                const latestCustomer = customers.find((c) => c.id === id);
                if (latestCustomer) {
                    selectedCustomer = { ...latestCustomer }; // pastikan sinkronisasi data (deep copy jika perlu)
                    updateSelectedCustomerCard();
                    renderSVG();
                    updateEstimates();
                } else {
                    selectedCustomer = null;
                    updateSelectedCustomerCard();
                    renderSVG();
                    updateEstimates();
                }

                if (customerSearchResults) customerSearchResults.classList.add('hidden');
                if (customerSearchInput) customerSearchInput.value = '';

                // Bisa tambahkan callback atau sync ke UI lain jika ada panel/komponen lain bergantung
                console.log('pelanggan dipilih dan data disinkronisasi:', selectedCustomer);
            };

            function updateSelectedCustomerCard() {
                if (!selectedCustomer) return;

                const avatarEl = document.getElementById('selected-customer-avatar');
                const nameEl = document.getElementById('selected-customer-name');
                const idEl = document.getElementById('selected-customer-id');
                const dadaEl = document.getElementById('mini-val-dada');
                const panjangEl = document.getElementById('mini-val-panjang');
                const bahuEl = document.getElementById('mini-val-bahu');
                const lenganEl = document.getElementById('mini-val-lengan');

                if (avatarEl) {
                    avatarEl.innerText = selectedCustomer.inisial || '';
                    // Prioritaskan avatar_bg, atau fallback ke avatar_url jika diperlukan
                    avatarEl.className = `w-10 h-10 rounded-full font-bold text-sm flex items-center justify-center ${selectedCustomer.avatar_bg || selectedCustomer.avatar_url || 'bg-primary text-white'}`;
                }
                if (nameEl) {
                    nameEl.innerText = selectedCustomer.nama_pelanggan || '';
                }
                if (idEl) {
                    idEl.innerText =
                        selectedCustomer.kode_pelanggan || `ID #${selectedCustomer.pelanggan_id || '-'}`;
                }

                // Update panel summary menggunakan key yang baru
                if (dadaEl) {
                    dadaEl.innerText = validasiUkuran(selectedCustomer.l_badan);
                }
                if (panjangEl) {
                    panjangEl.innerText = validasiUkuran(selectedCustomer.p_baju);
                }
                if (bahuEl) {
                    bahuEl.innerText = validasiUkuran(selectedCustomer.l_punggung);
                }
                if (lenganEl) {
                    lenganEl.innerText = validasiUkuran(selectedCustomer.p_lengan);
                }
            }

            // Fungsi helper kecil agar rapi jika datanya bernilai null/'-'
            function validasiUkuran(val) {
                return val !== undefined && val !== null && val !== '-' ? `${val} cm` : '-';
            }
            // Toggle Modal Full Sizes
            window.showFullSizesModal = function () {
                const modal = document.getElementById('sizes-modal');
                const container = document.getElementById('sizes-modal-container');
                const content = document.getElementById('sizes-modal-content');

                // Menyesuaikan dengan keys dari database
                const metrics = [
                    { label: 'Lingkar Badan', val: selectedCustomer.l_badan },
                    { label: 'Panjang Baju', val: selectedCustomer.p_baju },
                    { label: 'Lebar Punggung (Bahu)', val: selectedCustomer.l_punggung },
                    { label: 'Panjang Bahu', val: selectedCustomer.p_bahu },
                    { label: 'Panjang Lengan', val: selectedCustomer.p_lengan },
                    { label: 'Lingkar Lengan', val: selectedCustomer.l_lengan },
                    { label: 'Lingkar Pinggang', val: selectedCustomer.l_pinggang },
                    { label: 'Tinggi Pinggang', val: selectedCustomer.t_pinggang },
                    { label: 'Lingkar Pinggul', val: selectedCustomer.l_pinggul },
                    { label: 'Tinggi Dada', val: selectedCustomer.t_susu },
                    { label: 'Panjang Rok', val: selectedCustomer.p_rok },
                    { label: 'Panjang Celana', val: selectedCustomer.p_celana || '-' },
                ];

                content.innerHTML = `
                                        <div class="divide-y divide-[#EFECE6]/80 dark:divide-slate-800">
                                            ${metrics
                                                .map(
                                                    (m) => `
                                                <div class="flex justify-between py-2.5 text-xs font-semibold text-slate-700 dark:text-slate-300">
                                                    <span class="text-gray-400">${m.label}</span>
                                                    <span class="font-bold text-slate-800 dark:text-white">${m.val !== undefined && m.val !== null ? m.val : '-'} ${m.val !== '-' && m.val !== undefined && m.val !== null ? 'cm' : ''}</span>
                                                </div>
                                            `
                                                )
                                                .join('')}
                                        </div>
                                        `;

                modal.classList.remove('hidden');
                setTimeout(() => {
                    container.classList.remove('scale-95', 'opacity-0');
                    container.classList.add('scale-100', 'opacity-100');
                }, 50);
            };
            window.closeSizesModal = function () {
                const modal = document.getElementById('sizes-modal');
                const container = document.getElementById('sizes-modal-container');
                container.classList.remove('scale-100', 'opacity-100');
                container.classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 300);
            };

            // Close on outer click
            document.addEventListener('click', function (e) {
                if (customerSearchResults && !e.target.closest('#customer-search-container')) {
                    customerSearchResults.classList.add('hidden');
                }
            });

            // Update estimates
            function updateEstimates() {
                if (!selectedCustomer) {
                    document.getElementById('fabric-estimation').innerText = '0 METER';
                    return;
                }

                let estimasi = 0;

                // Parse ukuran pelanggan, gunakan nilai default logis jika data kosong ('-')
                const pBaju = parseInt(selectedCustomer.p_baju) || 70;
                const pLengan =
                    parseInt(selectedCustomer.p_lengan || selectedCustomer.panjang_lengan) || 60;
                const pCelana = parseInt(selectedCustomer.p_celana) || 95;
                const pRok = parseInt(selectedCustomer.p_rok) || 65;

                switch (activeType) {
                    case 'KEMEJA':
                        // Rumus: Panjang Baju + Panjang Lengan + 20cm (untuk kerah & kampuh)
                        estimasi = (pBaju + pLengan + 20) / 100;
                        if (estimasi < 1.5) estimasi = 1.5; // Minimal kain 1.5m
                        break;

                    case 'CELANA':
                        // Rumus: Panjang Celana + 20cm (untuk ban pinggang & kelim)
                        estimasi = (pCelana + 20) / 100;
                        if (estimasi < 1.25) estimasi = 1.25;
                        break;

                    case 'ROK':
                        // Rumus: Panjang Rok + 20cm
                        estimasi = (pRok + 20) / 100;
                        if (estimasi < 1.25) estimasi = 1.25;
                        break;

                    case 'GAMIS':
                        // Rumus: (Panjang Gamis x 2) + 20cm
                        // Jika pBaju di bawah 100cm, asumsikan itu data kemeja dan gunakan default panjang gamis (135cm)
                        const panjangGamis = pBaju > 100 ? pBaju : 135;
                        estimasi = (panjangGamis * 2 + 20) / 100;
                        if (estimasi < 2.5) estimasi = 2.5;
                        break;

                    default:
                        estimasi = 2;
                }

                // Format menjadi maksimal 2 angka desimal (contoh: 1.50 METER atau 1.75 METER)
                const formattedEstimasi = estimasi.toFixed(2).replace(/\.00$/, '');
                document.getElementById('fabric-estimation').innerText = `${formattedEstimasi} METER`;
            }

            // Zooming blueprints
            window.zoomIn = function () {
                if (currentScale < 1.6) {
                    currentScale += 0.15;
                    document.getElementById('svg-wrapper').style.transform = `scale(${currentScale})`;
                }
            };

            window.zoomOut = function () {
                if (currentScale > 0.6) {
                    currentScale -= 0.15;
                    document.getElementById('svg-wrapper').style.transform = `scale(${currentScale})`;
                }
            };

            window.printPattern = function () {
                if (!selectedCustomer) return;
                const printWindow = window.open('', '_blank');
                const svgContent = document.getElementById('svg-wrapper').innerHTML;
                printWindow.document.write(`
                    <html>
                        <head>
                            <title>Cetak Pola - ${selectedCustomer.nama_pelanggan || 'Pelanggan'}</title>
                            <style>
                                body { margin: 0; font-family: sans-serif; padding: 20px; background: #fff; }
                                .print-header { margin-bottom: 30px; padding-bottom: 10px; border-bottom: 2px solid #ddd; font-size: 14px; color: #4A3A2A; }
                                .print-header h2 { margin: 0 0 10px 0; font-size: 20px; }
                                svg { width: 100%; max-height: 90vh; display: block; margin: 0 auto 50px auto; page-break-after: always; }
                                svg:last-of-type { page-break-after: auto; }
                            </style>
                        </head>
                        <body>
                            <div class="print-header">
                                <h2>JahitSpace Pola Teknis</h2>
                                <p>Pelanggan: <b>${selectedCustomer.nama_pelanggan || 'Unknown'} (ID #${selectedCustomer.pelanggan_id || '-'})</b></p>
                                <p>Jenis Busana: <b>${activeType}</b></p>
                            </div>
                            ${svgContent}
                        </body>
                    </html>
                `);
                printWindow.document.close();
                setTimeout(() => {
                    printWindow.print();
                }, 500);
            };

            // Downloading SVG files
            window.downloadSVG = function () {
                if (!selectedCustomer) return;

                const svgs = document.getElementById('svg-wrapper').querySelectorAll('svg');
                let totalHeight = 0;
                let maxWidth = 0;
                let combinedInner = '';

                svgs.forEach((svg) => {
                    const viewBox = svg.getAttribute('viewBox');
                    let width = 1000;
                    let height = 1000;

                    if (viewBox) {
                        const parts = viewBox.split(' ');
                        width = parseFloat(parts[2]);
                        height = parseFloat(parts[3]);
                    }

                    if (width > maxWidth) maxWidth = width;

                    let outerHTML = svg.outerHTML;
                    // Menambahkan properti x dan y ke dalam elemen svg secara langsung
                    outerHTML = outerHTML.replace('<svg ', `<svg x="0" y="${totalHeight}" `);

                    combinedInner += outerHTML;
                    totalHeight += height + 50; // Beri jarak 50px antar pola
                });

                const finalSVG = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 ${maxWidth} ${totalHeight}" width="${maxWidth}" height="${totalHeight}">
                    <rect width="100%" height="100%" fill="#ffffff"/>
                    ${combinedInner}
                </svg>`;

                const blob = new Blob([finalSVG], { type: 'image/svg+xml;charset=utf-8' });
                const url = URL.createObjectURL(blob);
                const link = document.createElement('a');
                link.href = url;
                const safeName = (selectedCustomer.nama_pelanggan || 'pelanggan')
                    .toLowerCase()
                    .replace(/\s+/g, '_');
                link.download = `pola_${activeType.toLowerCase()}_${safeName}.svg`;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                URL.revokeObjectURL(url);
                showNotification('Berkas pola SVG tunggal berhasil diunduh!');
            };

            // RENDER SVG TEMPLATES DYNAMICALLY
            function renderSVG() {
                const wrapper = document.getElementById('svg-wrapper');
                const strokeColor = document.documentElement.classList.contains('dark')
                    ? '#60a5fa'
                    : '#4A3A2A';
                const leaderColor = '#8C7A6B';

                let svgHTML = '';

                if (activeType === 'KEMEJA') {
                    function gambarPolaBajuKemeja() {
                        console.log('Fungsi gambarPola terpanggil');
                        // Ambil Input
                        // Ganti bagian Ambil Input menjadi ini:
                        const PB = parseInt(selectedCustomer.p_baju) || 70;
                        const LB = parseInt(selectedCustomer.l_badan) || 100;
                        const LBa = parseInt(selectedCustomer.l_punggung) / 2 || 24;

                        // Pengaturan Skala dan Kanvas
                        const skala = 10;
                        const padX = 80;
                        const padY = 100;

                        // Fungsi Bantuan Skala Titik
                        const pt = (x, y) => ({ x: padX + x * skala, y: padY + y * skala });

                        // ----------------------------------------------------
                        // 1. KOORDINAT TITIK UTAMA
                        // ----------------------------------------------------

                        // Garis Tengah Kiri (Sejajar di X = 0)
                        const A = { x: 0, y: 0 };
                        const F = { x: 0, y: -3 }; // Leher belakang
                        const A1 = { x: 0, y: 6 }; // Leher depan
                        const C = { x: 0, y: A1.y + LB / 4 }; // Garis Dada
                        const D = { x: 0, y: PB }; // Bawah baju

                        // Leher & Bahu
                        const A2 = { x: 7, y: 0 };
                        const B = { x: 7 + (LBa - 7), y: 6 };
                        const E = { x: 7, y: -6 };
                        const G = { x: B.x, y: B.y - 6 }; // Sejajar sumbu Y dari B

                        // Sisi Kanan (Pola Depan lebih lebar 2cm dari Belakang)
                        const C1_belakang = { x: LB / 4 + 5, y: C.y };
                        const C1_depan = { x: C1_belakang.x + 2, y: C.y };

                        const D1_belakang = { x: C1_belakang.x, y: PB };
                        const D1_depan = { x: C1_depan.x, y: PB };

                        // ----------------------------------------------------
                        // 2. MENGGAMBAR ELEMEN SVG DENGAN BÉZIER PRESISI
                        // ----------------------------------------------------

                        const maxLebar = pt(C1_depan.x, 0).x + 60;
                        const maxTinggi = pt(0, D.y).y + 60;

                        let svg = `<svg viewBox="0 0 ${maxLebar} ${maxTinggi}" class="w-full md:w-[45%] lg:w-[30%] bg-white shadow border border-gray-200 rounded-lg" style="height: auto; aspect-ratio: ${maxLebar}/${maxTinggi};">`;

                        // --- POLA BELAKANG (MERAH) ---
                        // Kurva F-E menggunakan tarikan mendatar dari F
                        // Kurva G-C1 menggunakan kelengkungan landai
                        svg += `
                                                                        <path
                                                                            d="M ${pt(F.x, F.y).x} ${pt(F.x, F.y).y}
                                                                               C ${pt(F.x + 3.5, F.y).x} ${pt(F.x + 3.5, F.y).y}, ${pt(E.x, E.y + 1.5).x} ${pt(E.x, E.y + 1.5).y}, ${pt(E.x, E.y).x} ${pt(E.x, E.y).y}
                                                                               L ${pt(G.x, G.y).x} ${pt(G.x, G.y).y}
                                                                               C ${pt(G.x, G.y + (C1_belakang.y - G.y) * 0.5).x} ${pt(G.x, G.y + (C1_belakang.y - G.y) * 0.5).y}, ${pt(C1_belakang.x - 5, C1_belakang.y).x} ${pt(C1_belakang.x - 5, C1_belakang.y).y}, ${pt(C1_belakang.x, C1_belakang.y).x} ${pt(C1_belakang.x, C1_belakang.y).y}
                                                                               L ${pt(D1_belakang.x, D1_belakang.y).x} ${pt(D1_belakang.x, D1_belakang.y).y}
                                                                               L ${pt(D.x, D.y).x} ${pt(D.x, D.y).y}
                                                                               Z"
                                                                            fill="#fecaca" fill-opacity="0.5" stroke="#ef4444" stroke-width="2"
                                                                        />`;

                        // --- POLA DEPAN (BIRU) ---
                        // Kurva A1-A2 menggunakan tarikan mendatar dari A1
                        // Kurva B-C1 menggunakan lekukan dalam bentuk L-halus (French Curve)
                        svg += `
                                                                        <path
                                                                            d="M ${pt(A1.x, A1.y).x} ${pt(A1.x, A1.y).y}
                                                                               C ${pt(A1.x + 3.5, A1.y).x} ${pt(A1.x + 3.5, A1.y).y}, ${pt(A2.x, A2.y + 3.5).x} ${pt(A2.x, A2.y + 3.5).y}, ${pt(A2.x, A2.y).x} ${pt(A2.x, A2.y).y}
                                                                               L ${pt(B.x, B.y).x} ${pt(B.x, B.y).y}
                                                                               C ${pt(B.x, B.y + (C1_depan.y - B.y) * 0.5).x} ${pt(B.x, B.y + (C1_depan.y - B.y) * 0.5).y}, ${pt(C1_depan.x - 7, C1_depan.y).x} ${pt(C1_depan.x - 7, C1_depan.y).y}, ${pt(C1_depan.x, C1_depan.y).x} ${pt(C1_depan.x, C1_depan.y).y}
                                                                               L ${pt(D1_depan.x, D1_depan.y).x} ${pt(D1_depan.x, D1_depan.y).y}
                                                                               L ${pt(D.x, D.y).x} ${pt(D.x, D.y).y}
                                                                               Z"
                                                                            fill="#bfdbfe" fill-opacity="0.6" stroke="#2563eb" stroke-width="2.5"
                                                                        />`;

                        // --- GARIS BANTU (PUTUS-PUTUS) ---
                        const garisBantu = [
                            { from: F, to: D }, // Berada persis di tepi kiri (X = 0)
                            { from: A, to: A2 },
                            { from: A1, to: B },
                            { from: C, to: C1_depan },
                            { from: A2, to: E },
                            { from: B, to: G },
                        ];

                        garisBantu.forEach((g) => {
                            svg += `<line x1="${pt(g.from.x, g.from.y).x}" y1="${pt(g.from.x, g.from.y).y}"
                                                                                      x2="${pt(g.to.x, g.to.y).x}" y2="${pt(g.to.x, g.to.y).y}"
                                                                                      stroke="#6b7280" stroke-dasharray="5,5" />`;
                        });

                        // --- LABEL TITIK DAN HURUF ---
                        const labelTitik = [
                            { id: 'A', pt: A, offsetX: -20, offsetY: 5 },
                            { id: 'F', pt: F, offsetX: -20, offsetY: 5 },
                            { id: 'A1', pt: A1, offsetX: -25, offsetY: 5 },
                            { id: 'A2', pt: A2, offsetX: 10, offsetY: 15 },
                            { id: 'E', pt: E, offsetX: -5, offsetY: -15 },
                            { id: 'B', pt: B, offsetX: -15, offsetY: -5 },
                            { id: 'G', pt: G, offsetX: 10, offsetY: -5 },
                            { id: 'C', pt: C, offsetX: -20, offsetY: 5 },
                            { id: 'C1', pt: C1_depan, offsetX: 15, offsetY: 5 },
                            { id: 'D', pt: D, offsetX: -20, offsetY: 5 },
                            { id: 'D1', pt: D1_depan, offsetX: 15, offsetY: 5 },
                        ];

                        labelTitik.forEach((l) => {
                            const p = pt(l.pt.x, l.pt.y);
                            svg += `<circle cx="${p.x}" cy="${p.y}" r="4" fill="#1f2937" />`;
                            svg += `<text x="${p.x + l.offsetX}" y="${p.y + l.offsetY}" font-family="sans-serif" font-size="16" font-weight="bold" fill="#111827">${l.id}</text>`;
                        });

                        // --- KETERANGAN UKURAN (TEKS KECIL) ---
                        svg += buatTeksUkuran('3cm', pt(F.x + 1, F.y + 1.5).x, pt(F.x + 1, F.y + 1.5).y);
                        svg += buatTeksUkuran('6cm', pt(A.x + 1, A.y + 3).x, pt(A.x + 1, A.y + 3).y);
                        svg += buatTeksUkuran('6cm', pt(A2.x + 1, E.y + 3).x, pt(A2.x + 1, E.y + 3).y);
                        svg += buatTeksUkuran('6cm', pt(B.x - 1.5, G.y + 3).x, pt(B.x - 1.5, G.y + 3).y);

                        // Penanda selisih 2cm antara pola depan dan belakang di C1
                        svg += buatTeksUkuran(
                            '2cm',
                            pt(C1_belakang.x + 1, C.y - 1).x,
                            pt(C1_belakang.x + 1, C.y - 1).y
                        );
                        // Jarak kerung lengan
                        svg += buatTeksUkuran(
                            '1cm',
                            pt(B.x + 2, B.y + (C1_belakang.y - B.y) / 2).x,
                            pt(B.x + 2, B.y + (C1_belakang.y - B.y) / 2).y
                        );

                        svg += `</svg>`;
                        svgHTML = svg;
                        // document.getElementById('svg-wrapper').innerHTML = svg;
                    }

                    // Fungsi Helper untuk teks keterangan ukuran
                    function buatTeksUkuran(teks, x, y) {
                        return `<text x="${x}" y="${y}" font-family="sans-serif" font-size="12" fill="#4b5563" text-anchor="middle">${teks}</text>`;
                    }

                    // Render pola pertama kali
                    gambarPolaBajuKemeja();

                    function gambarPolaLenganKemeja() {
                        // Ganti bagian Ambil Input menjadi ini:
                        const panjangLengan = parseInt(selectedCustomer.p_lengan) || 60;
                        const lingkarLengan = parseInt(selectedCustomer.l_lengan) || 40;

                        const skala = 10;
                        const padX = 80; // Diperlebar agar teks ukuran kiri tidak terpotong
                        const padY = 60;

                        // Hitung Koordinat (X, Y)
                        const A = { x: padX, y: padY };
                        const C = { x: padX, y: 10 * skala + padY };
                        const B = { x: padX, y: panjangLengan * skala + padY };

                        const jarakCE = lingkarLengan / 2 + 5;
                        const E = { x: jarakCE * skala + padX, y: 10 * skala + padY };
                        const D = { x: 20 * skala + padX, y: panjangLengan * skala + padY };

                        // Titik bantu kurva S (Kerung Lengan)
                        const cp1 = { x: A.x + (E.x - A.x) * 0.35, y: A.y - 3 * skala };
                        const cp2 = { x: A.x + (E.x - A.x) * 0.65, y: E.y + 2 * skala };

                        const maxLebar = Math.max(E.x, D.x) + padX + 40;
                        const maxTinggi = B.y + padY + 40;

                        // Generate seluruh elemen SVG
                        const svgUtuh = `
                                                                        <svg viewBox="0 0 ${maxLebar} ${maxTinggi}" class="w-full md:w-[45%] lg:w-[30%] bg-white shadow border border-gray-200 rounded-lg" style="height: auto; aspect-ratio: ${maxLebar}/${maxTinggi};">

                                                                            <path
                                                                                d="M ${A.x} ${A.y}
                                                                                   C ${cp1.x} ${cp1.y}, ${cp2.x} ${cp2.y}, ${E.x} ${E.y}
                                                                                   L ${D.x} ${D.y}
                                                                                   L ${B.x} ${B.y}
                                                                                   Z"
                                                                                fill="#bfdbfe" fill-opacity="0.6" stroke="#2563eb" stroke-width="2.5"
                                                                            />

                                                                            <line x1="${A.x}" y1="${A.y}" x2="${C.x}" y2="${C.y}" stroke="#6b7280" stroke-dasharray="5,5" />
                                                                            <line x1="${C.x}" y1="${C.y}" x2="${E.x}" y2="${E.y}" stroke="#6b7280" stroke-dasharray="5,5" />

                                                                            ${buatTeksUkuran('10 cm', A.x - 15, (A.y + C.y) / 2, -90)}
                                                                            ${buatTeksUkuran(panjangLengan + ' cm', A.x - 45, (A.y + B.y) / 2, -90)}
                                                                            ${buatTeksUkuran(jarakCE + ' cm', (C.x + E.x) / 2, C.y + 15, 0)}
                                                                            ${buatTeksUkuran('20 cm', (B.x + D.x) / 2, B.y + 20, 0)}

                                                                            ${buatLabel('A', A.x, A.y, -25, 5)}
                                                                            ${buatLabel('C', C.x, C.y, -25, 5)}
                                                                            ${buatLabel('B', B.x, B.y, -25, 5)}
                                                                            ${buatLabel('E', E.x, E.y, 15, 5)}
                                                                            ${buatLabel('D', D.x, D.y, 15, 5)}
                                                                        </svg>
                                                                    `;

                        svgHTML += svgUtuh;
                    }

                    // Fungsi membuat titik merah dan label huruf
                    function buatLabel(huruf, x, y, geserX, geserY) {
                        return `
                                                                        <circle cx="${x}" cy="${y}" r="5" fill="#111827" />
                                                                        <text x="${x + geserX}" y="${y + geserY}" font-family="sans-serif" font-size="18" font-weight="bold" fill="#111827">${huruf}</text>
                                                                    `;
                    }

                    // Fungsi baru untuk merender angka ukuran (bisa diputar/rotate)
                    function buatTeksUkuran(teks, x, y, rotasi = 0) {
                        return `
                                                                        <text x="${x}" y="${y}"
                                                                              font-family="sans-serif" font-size="14" font-weight="600"
                                                                              fill="#2563eb"
                                                                              text-anchor="middle" dominant-baseline="middle"
                                                                              transform="rotate(${rotasi}, ${x}, ${y})">
                                                                            ${teks}
                                                                        </text>
                                                                    `;
                    }

                    gambarPolaLenganKemeja();

                    function gambarPolaKerahKemeja() {
                        // Ambil Input
                        const LK = selectedCustomer.lingkar_kerah || 40;
                        const LK2 = LK / 2; // Kita gunakan Setengah Lingkar Kerah

                        // Pengaturan Skala dan Kanvas
                        const skala = 15; // Diperbesar agar detail lengkungan terlihat jelas
                        const padX = 80;
                        const padY = 60;

                        // Fungsi Bantuan Skala Titik
                        const pt = (x, y) => ({ x: padX + x * skala, y: padY + y * skala });

                        // ----------------------------------------------------
                        // 1. KOORDINAT TITIK UTAMA
                        // ----------------------------------------------------

                        // --- DAUN KERAH (Pola Atas) ---
                        const D1 = { x: 0, y: 0 };
                        const A1 = { x: 2, y: 7 };
                        const B1 = { x: LK2, y: 7 };
                        const C1 = { x: LK2, y: 3 }; // B1 - C1 = 4cm

                        // --- KAKI KERAH (Pola Bawah) ---
                        const gapY = 10; // Jarak visual antara pola atas dan bawah
                        const D = { x: 2, y: gapY };
                        const C = { x: LK2, y: gapY };
                        const B = { x: LK2, y: gapY + 3.5 };
                        const A = { x: 0, y: gapY + 2 }; // Titik A melengkung di sebelah kiri

                        // ----------------------------------------------------
                        // 2. MENGGAMBAR ELEMEN SVG
                        // ----------------------------------------------------

                        const maxLebar = pt(LK2, 0).x + 60;
                        const maxTinggi = pt(0, B.y).y + 60;

                        let svg = `<svg viewBox="0 0 ${maxLebar} ${maxTinggi}" class="w-full md:w-[45%] lg:w-[30%] bg-white shadow border border-gray-200 rounded-lg" style="height: auto; aspect-ratio: ${maxLebar}/${maxTinggi};">`;

                        // --- DAUN KERAH (Biru) ---
                        svg += `
                                                                        <path
                                                                            d="M ${pt(D1.x, D1.y).x} ${pt(D1.x, D1.y).y}
                                                                               C ${pt(LK2 * 0.3, 1.5).x} ${pt(LK2 * 0.3, 1.5).y}, ${pt(LK2 * 0.7, C1.y).x} ${pt(LK2 * 0.7, C1.y).y}, ${pt(C1.x, C1.y).x} ${pt(C1.x, C1.y).y}
                                                                               L ${pt(B1.x, B1.y).x} ${pt(B1.x, B1.y).y}
                                                                               L ${pt(A1.x, A1.y).x} ${pt(A1.x, A1.y).y}
                                                                               L ${pt(D1.x, D1.y).x} ${pt(D1.x, D1.y).y}
                                                                               Z"
                                                                            fill="#bfdbfe" fill-opacity="0.6" stroke="#2563eb" stroke-width="2.5"
                                                                        />`;

                        // --- KAKI KERAH (Merah) ---
                        svg += `
                                                                        <path
                                                                            d="M ${pt(D.x, D.y).x} ${pt(D.x, D.y).y}
                                                                               C ${pt(2 + LK2 * 0.3, D.y + 0.5).x} ${pt(2 + LK2 * 0.3, D.y + 0.5).y}, ${pt(LK2 * 0.7, C.y + 0.5).x} ${pt(LK2 * 0.7, C.y + 0.5).y}, ${pt(C.x, C.y).x} ${pt(C.x, C.y).y}
                                                                               L ${pt(B.x, B.y).x} ${pt(B.x, B.y).y}
                                                                               C ${pt(LK2 * 0.5, B.y).x} ${pt(LK2 * 0.5, B.y).y}, ${pt(3, B.y).x} ${pt(3, B.y).y}, ${pt(A.x, A.y).x} ${pt(A.x, A.y).y}
                                                                               C ${pt(0, gapY + 0.5).x} ${pt(0, gapY + 0.5).y}, ${pt(1, D.y).x} ${pt(1, D.y).y}, ${pt(D.x, D.y).x} ${pt(D.x, D.y).y}
                                                                               Z"
                                                                            fill="#fecaca" fill-opacity="0.6" stroke="#ef4444" stroke-width="2"
                                                                        />`;

                        // --- GARIS BANTU (PUTUS-PUTUS) ---
                        const garisBantu = [
                            { from: { x: 0, y: -2 }, to: { x: 0, y: B.y + 2 } }, // Garis vertikal 0 (Kiri D1 & A)
                            { from: { x: 2, y: D1.y }, to: { x: 2, y: B.y + 2 } }, // Garis vertikal 2 (Kiri A1 & D)
                            { from: { x: LK2, y: -2 }, to: { x: LK2, y: B.y + 2 } }, // Garis vertikal Kanan (C1, B1, C, B)
                        ];

                        garisBantu.forEach((g) => {
                            svg += `<line x1="${pt(g.from.x, g.from.y).x}" y1="${pt(g.from.x, g.from.y).y}"
                                                                                      x2="${pt(g.to.x, g.to.y).x}" y2="${pt(g.to.x, g.to.y).y}"
                                                                                      stroke="#6b7280" stroke-dasharray="5,5" />`;
                        });

                        // --- LABEL TITIK ---
                        const labelTitik = [
                            { id: 'D1', pt: D1, offsetX: -25, offsetY: 0 },
                            { id: 'A1', pt: A1, offsetX: 10, offsetY: 15 },
                            { id: 'C1', pt: C1, offsetX: 15, offsetY: -5 },
                            { id: 'B1', pt: B1, offsetX: 15, offsetY: 10 },

                            { id: 'A', pt: A, offsetX: -20, offsetY: 5 },
                            { id: 'D', pt: D, offsetX: 10, offsetY: -10 },
                            { id: 'C', pt: C, offsetX: 15, offsetY: -5 },
                            { id: 'B', pt: B, offsetX: 15, offsetY: 5 },
                        ];

                        labelTitik.forEach((l) => {
                            const p = pt(l.pt.x, l.pt.y);
                            svg += `<circle cx="${p.x}" cy="${p.y}" r="3" fill="#1f2937" />`;
                            svg += `<text x="${p.x + l.offsetX}" y="${p.y + l.offsetY}" font-family="sans-serif" font-size="16" font-weight="bold" fill="#111827">${l.id}</text>`;
                        });

                        // --- KETERANGAN UKURAN (TEKS) ---
                        svg += buatTeksUkuran('7 cm', pt(0, A1.y / 2).x - 20, pt(0, A1.y / 2).y, -90); // Vertikal kiri
                        svg += buatTeksUkuran('2 cm', pt(1, A1.y).x, pt(1, A1.y).y + 25); // Jarak horizontal A ke A1
                        svg += buatTeksUkuran('4 cm', pt(C1.x, C1.y + 2).x + 25, pt(C1.x, C1.y + 2).y, -90); // Vertikal kanan daun
                        svg += buatTeksUkuran(
                            '3.5 cm',
                            pt(C.x, C.y + 1.75).x + 30,
                            pt(C.x, C.y + 1.75).y,
                            -90
                        ); // Vertikal kanan kaki

                        svg += `</svg>`;
                        svgHTML += svg;
                    }

                    // Fungsi Helper untuk teks keterangan ukuran
                    function buatTeksUkuran(teks, x, y, rotasi = 0) {
                        return `
                                                                        <text x="${x}" y="${y}"
                                                                              font-family="sans-serif" font-size="14" font-weight="600"
                                                                              fill="#4b5563"
                                                                              text-anchor="middle" dominant-baseline="middle"
                                                                              transform="rotate(${rotasi}, ${x}, ${y})">
                                                                            ${teks}
                                                                        </text>
                                                                    `;
                    }

                    // Event Listener
                    // document.getElementById('inputLK').addEventListener('input', gambarPola);

                    // Render pola pertama kali
                    gambarPolaKerahKemeja();
                } else if (activeType === 'CELANA') {
                    function gambarPolaCelana() {
                        const panjang = parseInt(selectedCustomer.p_celana) || 95;
                        const pinggang = parseInt(selectedCustomer.l_pinggang) || 72;
                        const pesak = parseInt(selectedCustomer.l_pesak) || 66;
                        const paha = parseInt(selectedCustomer.l_paha) || 62;
                        const lutut = parseInt(selectedCustomer.l_lutut) || 52;
                        const kaki = parseInt(selectedCustomer.l_kaki) || 40;

                        const skala = 11; // Skala gambar
                        const padX = 250;
                        const padY = 80;
                        const pt = (x, y) => ({ x: padX + x * skala, y: padY + y * skala });

                        // 1. Hitung Titik Utama (Sumbu Y)
                        const A = { x: 0, y: 0 };
                        const B = { x: 0, y: panjang - 3 };
                        const A1 = { x: 0, y: (pesak / 2) - 6 }; // Garis Pesak
                        const A2 = { x: 0, y: A1.y + (B.y - A1.y) / 2 - 3 }; // Garis Lutut

                        // 2. Pola Depan (Merah)
                        const E1_x = (pinggang / 4) / 3;
                        const E_x = E1_x - (pinggang / 4);
                        const C_w = (paha / 2) - 4;
                        const C_x = -C_w / 2;
                        const C1_x = C_w / 2;
                        const C2_x = C1_x - 3.5;
                        const C3 = { x: C2_x, y: A1.y - 6 };
                        const F_w = (lutut / 2) - 2.5;
                        const F_x = -F_w / 2;
                        const F1_x = F_w / 2;
                        const D_w = (kaki / 2) - 2;
                        const D_x = -D_w / 2;
                        const D1_x = D_w / 2;

                        const E = { x: E_x, y: 0 };
                        const E1 = { x: E1_x, y: 0 };
                        const C = { x: C_x, y: A1.y };
                        const C1 = { x: C1_x, y: A1.y };
                        const C2 = { x: C2_x, y: A1.y };
                        const F = { x: F_x, y: A2.y };
                        const F1 = { x: F1_x, y: A2.y };
                        const D = { x: D_x, y: B.y };
                        const D1 = { x: D1_x, y: B.y };

                        // 3. Pola Belakang (Biru)
                        const H2 = { x: E1.x - 2, y: 0 };
                        const H1 = { x: H2.x, y: -2.5 };
                        const dist_H = (pinggang / 4) + 3;
                        // Pythagoras: H.x = H1.x - sqrt(dist^2 - dy^2)
                        const dy = Math.abs(H1.y);
                        const H_x = H1.x - Math.sqrt(dist_H*dist_H - dy*dy);
                        const H = { x: H_x, y: 0 };

                        const C4 = { x: C.x - 3, y: A1.y };
                        const C5 = { x: C1.x + 5, y: A1.y };
                        const F3 = { x: F.x - 2.5, y: A2.y };
                        const F2 = { x: F1.x + 2.5, y: A2.y };
                        const D3 = { x: D.x - 2, y: B.y };
                        const D2 = { x: D1.x + 2, y: B.y };

                        const maxLebar = pt(C5.x, 0).x + 100;
                        const maxTinggi = pt(0, B.y).y + 60;

                        let svg = `<svg viewBox="0 0 ${maxLebar} ${maxTinggi}" class="w-full md:w-[60%] lg:w-[45%] bg-white shadow border border-gray-200 rounded-lg" style="height: auto; aspect-ratio: ${maxLebar}/${maxTinggi}; font-family: sans-serif;">`;

                        // Garis Sumbu dan Garis Bantu
                        const axes = [
                            { from: {x: H.x - 10, y: 0}, to: {x: E1.x + 15, y: 0}, dash: '5,5' }, // Garis g (pinggang)
                            { from: A, to: B, dash: '5,5' }, // Sumbu tengah vertikal
                            { from: {x: C4.x - 10, y: A1.y}, to: {x: C5.x + 10, y: A1.y}, dash: '5,5' }, // Garis pesak
                            { from: {x: F3.x - 10, y: A2.y}, to: {x: F1.x + 10, y: A2.y}, dash: '5,5' }, // Garis lutut
                            { from: {x: D3.x - 10, y: B.y}, to: {x: D2.x + 10, y: B.y}, dash: '5,5' }, // Garis kaki
                            { from: C2, to: C3, dash: '3,3' } // Garis golbi
                        ];
                        axes.forEach(g => {
                            svg += `<line x1="${pt(g.from.x, g.from.y).x}" y1="${pt(g.from.x, g.from.y).y}"
                                          x2="${pt(g.to.x, g.to.y).x}" y2="${pt(g.to.x, g.to.y).y}"
                                          stroke="#6b7280" stroke-dasharray="${g.dash}" stroke-width="1.2" />`;
                        });

                        // Pola Belakang (Biru)
                        svg += `
                            <path d="M ${pt(H.x, H.y).x} ${pt(H.x, H.y).y}
                                     L ${pt(H1.x, H1.y).x} ${pt(H1.x, H1.y).y}
                                     Q ${pt(H1.x, C5.y - 12).x} ${pt(H1.x, C5.y - 12).y}, ${pt(C5.x, C5.y).x} ${pt(C5.x, C5.y).y}
                                     L ${pt(F2.x, F2.y).x} ${pt(F2.x, F2.y).y}
                                     L ${pt(D2.x, D2.y).x} ${pt(D2.x, D2.y).y}
                                     L ${pt(D3.x, D3.y).x} ${pt(D3.x, D3.y).y}
                                     L ${pt(F3.x, F3.y).x} ${pt(F3.x, F3.y).y}
                                     L ${pt(C4.x, C4.y).x} ${pt(C4.x, C4.y).y}
                                     Q ${pt(H.x, C4.y - 15).x} ${pt(H.x, C4.y - 15).y}, ${pt(H.x, H.y).x} ${pt(H.x, H.y).y} Z"
                                  fill="#bfdbfe" fill-opacity="0.6" stroke="#2563eb" stroke-width="1.5" />
                        `;

                        // Pola Depan (Merah)
                        svg += `
                            <path d="M ${pt(E.x, E.y).x} ${pt(E.x, E.y).y}
                                     L ${pt(E1.x, E1.y).x} ${pt(E1.x, E1.y).y}
                                     L ${pt(C3.x, C3.y).x} ${pt(C3.x, C3.y).y}
                                     Q ${pt(C3.x, C1.y).x} ${pt(C3.x, C1.y).y}, ${pt(C1.x, C1.y).x} ${pt(C1.x, C1.y).y}
                                     L ${pt(F1.x, F1.y).x} ${pt(F1.x, F1.y).y}
                                     L ${pt(D1.x, D1.y).x} ${pt(D1.x, D1.y).y}
                                     L ${pt(D.x, D.y).x} ${pt(D.x, D.y).y}
                                     L ${pt(F.x, F.y).x} ${pt(F.x, F.y).y}
                                     L ${pt(C.x, C.y).x} ${pt(C.x, C.y).y}
                                     Q ${pt(E.x, C.y - 15).x} ${pt(E.x, C.y - 15).y}, ${pt(E.x, E.y).x} ${pt(E.x, E.y).y} Z"
                                  fill="#fecaca" fill-opacity="0.5" stroke="#dc2626" stroke-width="1.5" />
                        `;

                        // Titik & Label Sesuai Gambar
                        const labels = [
                            { id: 'A', pt: A, ox: -15, oy: 15 },
                            { id: 'B', pt: B, ox: -10, oy: 20 },
                            { id: 'A1', pt: A1, ox: -20, oy: 15 },
                            { id: 'A2', pt: A2, ox: -20, oy: 15 },
                            { id: 'E', pt: E, ox: -18, oy: 15 },
                            { id: 'E1', pt: E1, ox: 8, oy: -10 },
                            { id: 'C', pt: C, ox: 8, oy: -10 },
                            { id: 'C1', pt: C1, ox: -15, oy: 20 },
                            { id: 'C2', pt: C2, ox: -22, oy: 15 },
                            { id: 'C3', pt: C3, ox: -20, oy: 5 },
                            { id: 'C4', pt: C4, ox: -25, oy: 5 },
                            { id: 'C5', pt: C5, ox: 15, oy: 5 },
                            { id: 'F', pt: F, ox: 8, oy: -10 },
                            { id: 'F1', pt: F1, ox: 15, oy: 5 },
                            { id: 'F2', pt: F2, ox: -18, oy: -5 },
                            { id: 'F3', pt: F3, ox: -25, oy: 5 },
                            { id: 'D', pt: D, ox: 8, oy: 20 },
                            { id: 'D1', pt: D1, ox: -18, oy: 20 },
                            { id: 'D2', pt: D2, ox: 15, oy: 20 },
                            { id: 'D3', pt: D3, ox: -25, oy: 20 },
                            { id: 'H', pt: H, ox: -15, oy: -10 },
                            { id: 'H1', pt: H1, ox: 8, oy: -10 },
                            { id: 'H2', pt: H2, ox: -18, oy: 18 },
                            { id: 'g', pt: {x: E1.x + 10, y: 0}, ox: 15, oy: 5 }
                        ];

                        labels.forEach(l => {
                            const p = pt(l.pt.x, l.pt.y);
                            if (l.id !== 'g' && l.id !== 'C2' && l.id !== 'H2') {
                                svg += `<circle cx="${p.x}" cy="${p.y}" r="4" fill="#1f2937" />`;
                            }
                            svg += `<text x="${p.x + l.ox}" y="${p.y + l.oy}" font-family="sans-serif" font-size="14" font-weight="bold" fill="#111827">${l.id}</text>`;
                        });

                        svg += `</svg>`;
                        svgHTML = svg;
                    }
                    gambarPolaCelana();
                } else if (activeType === 'ROK') {
                    function gambarPolaRok() {
                        const pinggang = parseInt(selectedCustomer.l_pinggang) || 68;
                        const pinggul = parseInt(selectedCustomer.l_pinggul) || 90;
                        const tinggiPinggul = 18; // Default tinggi pinggul
                        const panjang = parseInt(selectedCustomer.p_rok) || 65;

                        const skala = 10;
                        const padX = 100;
                        const padY = 80;
                        const pt = (x, y) => ({ x: padX + x * skala, y: padY + y * skala });

                        // 1. Koordinat Pola Belakang (Biru) - Kiri
                        const backA = { x: 0, y: 0 };
                        const backA_prime = { x: 0, y: 1.5 }; // Turun 1.5cm
                        const backC = { x: 0, y: tinggiPinggul };
                        const backB = { x: 0, y: panjang };
                        const widthBack = (pinggul / 4) - 1;
                        const backE = { x: widthBack, y: tinggiPinggul };
                        const backF = { x: widthBack, y: panjang };
                        const waistBack = (pinggang / 4) - 1 + 3; // +3 untuk kupnat
                        const backD = { x: waistBack, y: 0 };
                        const backD_prime = { x: waistBack, y: -1.5 }; // Naik 1.5cm di sisi

                        // Kupnat Belakang
                        const backDart_x = (pinggang / 10);
                        const backDart_y = 8;
                        const backDart_center = { x: backDart_x + 0.5, y: backDart_y }; // Geser 0.5
                        const backG = { x: backDart_x - 1.5, y: 0 };
                        const backG_prime = { x: backDart_x + 1.5, y: 0 };

                        // 2. Koordinat Pola Depan (Merah) - Kanan
                        const gap = 15;
                        const startXFront = widthBack + gap;
                        const widthFront = (pinggul / 4) + 1;
                        const frontA = { x: startXFront + widthFront, y: 0 }; // Center front (kanan)
                        const frontC = { x: frontA.x, y: tinggiPinggul };
                        const frontG_bot = { x: frontA.x, y: panjang };
                        const frontE = { x: startXFront, y: tinggiPinggul }; // Side front (kiri)
                        const frontF = { x: startXFront, y: panjang };
                        const waistFront = (pinggang / 4) + 1 + 3; // +3 untuk kupnat
                        const frontD = { x: frontA.x - waistFront, y: 0 };
                        const frontD_prime = { x: frontD.x, y: -1.5 };

                        // Kupnat Depan
                        const frontDart_x = frontA.x - (pinggang / 10);
                        const frontDart_y = 8;
                        const frontDart_center = { x: frontDart_x - 0.5, y: frontDart_y }; // Geser 0.5
                        const frontG_right = { x: frontDart_x + 1.5, y: 0 };
                        const frontG_left = { x: frontDart_x - 1.5, y: 0 };

                        const maxLebar = pt(frontA.x, 0).x + 80;
                        const maxTinggi = pt(0, panjang).y + 60;

                        let svg = `<svg viewBox="0 0 ${maxLebar} ${maxTinggi}" class="w-full md:w-[70%] lg:w-[60%] bg-white shadow border border-gray-200 rounded-lg" style="height: auto; aspect-ratio: ${maxLebar}/${maxTinggi}; font-family: sans-serif;">`;

                        // Pola Belakang (Biru)
                        svg += `
                            <path d="M ${pt(backA_prime.x, backA_prime.y).x} ${pt(backA_prime.x, backA_prime.y).y}
                                     L ${pt(backC.x, backC.y).x} ${pt(backC.x, backC.y).y}
                                     L ${pt(backB.x, backB.y).x} ${pt(backB.x, backB.y).y}
                                     L ${pt(backF.x, backF.y).x} ${pt(backF.x, backF.y).y}
                                     L ${pt(backE.x, backE.y).x} ${pt(backE.x, backE.y).y}
                                     Q ${pt(backE.x, backC.y - 10).x} ${pt(backE.x, backC.y - 10).y}, ${pt(backD_prime.x, backD_prime.y).x} ${pt(backD_prime.x, backD_prime.y).y}
                                     Q ${pt(backA_prime.x + widthBack/2, backD_prime.y + 1).x} ${pt(backA_prime.x + widthBack/2, backD_prime.y + 1).y}, ${pt(backA_prime.x, backA_prime.y).x} ${pt(backA_prime.x, backA_prime.y).y} Z"
                                  fill="#bfdbfe" fill-opacity="0.6" stroke="#2563eb" stroke-width="1.5" />
                        `;

                        // Kupnat Belakang
                        svg += `
                            <path d="M ${pt(backG.x, backG.y).x} ${pt(backG.x, backG.y).y}
                                     L ${pt(backDart_center.x, backDart_center.y).x} ${pt(backDart_center.x, backDart_center.y).y}
                                     L ${pt(backG_prime.x, backG_prime.y).x} ${pt(backG_prime.x, backG_prime.y).y}"
                                  fill="none" stroke="#2563eb" stroke-width="1.5" />
                        `;

                        // Garis putus-putus Belakang
                        const dashBack = [
                            { from: backA, to: backD },
                            { from: backA, to: backA_prime },
                            { from: backD, to: backD_prime },
                            { from: backC, to: backE },
                            { from: {x: backDart_x, y: 0}, to: backDart_center },
                            { from: backD_prime, to: backE } // Garis lurus sisi sbg panduan kurva
                        ];
                        dashBack.forEach(g => {
                            svg += `<line x1="${pt(g.from.x, g.from.y).x}" y1="${pt(g.from.x, g.from.y).y}"
                                          x2="${pt(g.to.x, g.to.y).x}" y2="${pt(g.to.x, g.to.y).y}"
                                          stroke="#111827" stroke-dasharray="4,4" stroke-width="1.2" />`;
                        });

                        // Pola Depan (Merah)
                        svg += `
                            <path d="M ${pt(frontA.x, frontA.y).x} ${pt(frontA.x, frontA.y).y}
                                     L ${pt(frontC.x, frontC.y).x} ${pt(frontC.x, frontC.y).y}
                                     L ${pt(frontG_bot.x, frontG_bot.y).x} ${pt(frontG_bot.x, frontG_bot.y).y}
                                     L ${pt(frontF.x, frontF.y).x} ${pt(frontF.x, frontF.y).y}
                                     L ${pt(frontE.x, frontE.y).x} ${pt(frontE.x, frontE.y).y}
                                     Q ${pt(frontE.x, frontC.y - 10).x} ${pt(frontE.x, frontC.y - 10).y}, ${pt(frontD_prime.x, frontD_prime.y).x} ${pt(frontD_prime.x, frontD_prime.y).y}
                                     Q ${pt(frontA.x - widthFront/2, frontD_prime.y + 0.5).x} ${pt(frontA.x - widthFront/2, frontD_prime.y + 0.5).y}, ${pt(frontA.x, frontA.y).x} ${pt(frontA.x, frontA.y).y} Z"
                                  fill="#fecaca" fill-opacity="0.5" stroke="#dc2626" stroke-width="1.5" />
                        `;

                        // Kupnat Depan
                        svg += `
                            <path d="M ${pt(frontG_left.x, frontG_left.y).x} ${pt(frontG_left.x, frontG_left.y).y}
                                     L ${pt(frontDart_center.x, frontDart_center.y).x} ${pt(frontDart_center.x, frontDart_center.y).y}
                                     L ${pt(frontG_right.x, frontG_right.y).x} ${pt(frontG_right.x, frontG_right.y).y}"
                                  fill="none" stroke="#dc2626" stroke-width="1.5" />
                        `;

                        // Garis putus-putus Depan
                        const dashFront = [
                            { from: frontA, to: frontD },
                            { from: frontD, to: frontD_prime },
                            { from: frontC, to: frontE },
                            { from: {x: frontDart_x, y: 0}, to: frontDart_center },
                            { from: frontD_prime, to: frontE }
                        ];
                        dashFront.forEach(g => {
                            svg += `<line x1="${pt(g.from.x, g.from.y).x}" y1="${pt(g.from.x, g.from.y).y}"
                                          x2="${pt(g.to.x, g.to.y).x}" y2="${pt(g.to.x, g.to.y).y}"
                                          stroke="#111827" stroke-dasharray="4,4" stroke-width="1.2" />`;
                        });

                        // Titik & Label Sesuai Gambar
                        const labels = [
                            // Belakang
                            { id: 'A', pt: backA, ox: -15, oy: -5 },
                            { id: 'A\'', pt: backA_prime, ox: -20, oy: 5 },
                            { id: 'C', pt: backC, ox: -15, oy: 5 },
                            { id: 'B', pt: backB, ox: -15, oy: 5 },
                            { id: 'F', pt: backF, ox: 10, oy: 5 },
                            { id: 'E', pt: backE, ox: 10, oy: 5 },
                            { id: 'D', pt: backD, ox: 15, oy: 5 },
                            { id: 'D\'', pt: backD_prime, ox: -5, oy: -15 },
                            { id: 'G', pt: backG, ox: -15, oy: -5 },
                            { id: 'G\'', pt: backG_prime, ox: 10, oy: -5 },
                            // Depan
                            { id: 'a', pt: frontA, ox: 15, oy: 0 },
                            { id: 'c', pt: frontC, ox: 15, oy: 5 },
                            { id: 'g', pt: frontG_bot, ox: 15, oy: 5 },
                            { id: 'f', pt: frontF, ox: -15, oy: 5 },
                            { id: 'e', pt: frontE, ox: -15, oy: 5 },
                            { id: 'd', pt: frontD, ox: -15, oy: 5 },
                            { id: 'd\'', pt: frontD_prime, ox: 0, oy: -15 },
                            { id: 'g', pt: frontG_left, ox: -15, oy: -5 }, // Label dart kiri
                            { id: 'g', pt: frontG_right, ox: 10, oy: -5 }  // Label dart kanan
                        ];

                        labels.forEach(l => {
                            const p = pt(l.pt.x, l.pt.y);
                            svg += `<circle cx="${p.x}" cy="${p.y}" r="3" fill="#1f2937" />`;
                            svg += `<text x="${p.x + l.ox}" y="${p.y + l.oy}" font-family="sans-serif" font-size="14" font-weight="bold" fill="#111827">${l.id}</text>`;
                        });

                        // Teks Ukuran Kupnat
                        const textSizes = [
                            { text: '0,5', pt: backDart_center, ox: -20, oy: 0 },
                            { text: '8', pt: {x: backDart_x, y: backDart_y/2}, ox: 10, oy: 5 },
                            { text: '0,5', pt: frontDart_center, ox: -20, oy: 0 },
                            { text: '8', pt: {x: frontDart_x, y: frontDart_y/2}, ox: 10, oy: 5 }
                        ];
                        textSizes.forEach(t => {
                            const p = pt(t.pt.x, t.pt.y);
                            svg += `<text x="${p.x + t.ox}" y="${p.y + t.oy}" font-family="sans-serif" font-size="12" fill="#111827">${t.text}</text>`;
                        });

                        svg += `</svg>`;
                        svgHTML = svg;
                    }
                    gambarPolaRok();
                } else if (activeType === 'GAMIS') {
                    const dada = selectedCustomer.l_dada;
                    const panjang = 135; // Default robe length

                    svgHTML = `
                                                                        <svg width="100%" height="100%" viewBox="0 0 600 450" fill="none" stroke="${strokeColor}" stroke-width="2" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M 240,50 L 360,50 L 340,70 L 450,110 L 415,160 L 360,140 L 400,410 L 200,410 L 240,140 L 185,160 L 150,110 L 260,70 Z" />
                                                                            <path d="M 270,70 C 270,95 330,95 330,70" />
                                                                            <path d="M 255,160 C 270,170 330,170 345,160" stroke-dasharray="3,3" />

                                                                            <!-- Dimension Dada -->
                                                                            <line x1="240" y1="130" x2="360" y2="130" stroke="${leaderColor}" stroke-width="1.2" stroke-dasharray="3,3" />
                                                                            <circle cx="240" cy="130" r="3.5" fill="${leaderColor}" />
                                                                            <circle cx="360" cy="130" r="3.5" fill="${leaderColor}" />
                                                                            <foreignObject x="272" y="115" width="56" height="30">
                                                                                <div style="background: white; border: 1px solid #EFECE6; border-radius: 4px; padding: 2px 4px; font-size: 10px; font-weight: bold; color: #334155; text-align: center; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">${dada} cm</div>
                                                                            </foreignObject>

                                                                            <!-- Dimension Panjang Robe -->
                                                                            <line x1="120" y1="50" x2="120" y2="410" stroke="${leaderColor}" stroke-width="1.2" stroke-dasharray="3,3" />
                                                                            <circle cx="120" cy="50" r="3.5" fill="${leaderColor}" />
                                                                            <circle cx="120" cy="410" r="3.5" fill="${leaderColor}" />
                                                                            <foreignObject x="92" y="210" width="56" height="30">
                                                                                <div style="background: white; border: 1px solid #EFECE6; border-radius: 4px; padding: 2px 4px; font-size: 10px; font-weight: bold; color: #334155; text-align: center; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">${panjang} cm</div>
                                                                            </foreignObject>
                                                                        </svg>
                                                                    `;
                } else if (activeType === 'WANITA') {
                    function gambarPolaWanita() {
                        const LB = parseInt(selectedCustomer.l_badan) || 90;
                        const LPg = parseInt(selectedCustomer.l_pinggang) || 72;
                        const LPa = parseInt(selectedCustomer.l_pinggul) || 94;
                        const lebarBahu = parseInt(selectedCustomer.l_bahu) || 38;
                        const lebarDada = parseInt(selectedCustomer.l_dada) || 32;
                        const pBaju = parseInt(selectedCustomer.p_baju) || 135;
                        const turunPinggang = 40; // Standar
                        const lingkarLengan = parseInt(selectedCustomer.l_lengan) || 44;
                        const lebarLingkarLengan = lingkarLengan / 2; // A2 - A3

                        const skala = 6;
                        const padX = 150;
                        const padY = 50;
                        const pt = (x, y) => ({ x: padX + x * skala, y: padY + y * skala });

                        // Koordinat Vertikal (Y)
                        const Y_A = 0;
                        const Y_A2 = 3;
                        const Y_Leher = 8;
                        const Y_H_top = Y_A2 + lebarLingkarLengan; // Garis badan (H)
                        const Y_A3 = Y_A2 + (lebarLingkarLengan / 2); // Garis dada (tengah-tengah A2 dan H)
                        const Y_H_bot = Y_A + turunPinggang; // Garis pinggang
                        const Y_E = Y_H_bot + 20; // Garis pinggul
                        const Y_B = pBaju; // Garis bawah

                        // Koordinat Horizontal (X)
                        const X_Center = 0;
                        const X_A1 = 8;
                        const X_C2 = lebarBahu / 2;
                        const Y_C2 = 4; // Kemiringan bahu
                        
                        const X_F2 = lebarDada / 2;
                        const X_F = (LB / 4) + 2;
                        const X_I = (LPg / 4) + 3 + 2;
                        const X_D = (LPa / 4) + 2;
                        const X_B1 = X_D; // Sesuai permintaan: B-B1 = E-D

                        // Titik-titik utama
                        const A = { x: X_Center, y: Y_A };
                        const A1 = { x: X_A1, y: Y_A };
                        const A2 = { x: X_Center, y: Y_A2 };
                        const Leher_Bawah = { x: X_Center, y: Y_Leher };
                        const C2 = { x: X_C2, y: Y_C2 };
                        const A3 = { x: X_Center, y: Y_A3 };
                        const F2 = { x: X_F2, y: Y_A3 };
                        const H_top = { x: X_Center, y: Y_H_top };
                        const F = { x: X_F, y: Y_H_top };
                        const H_bot = { x: X_Center, y: Y_H_bot };
                        const I = { x: X_I, y: Y_H_bot };
                        const E = { x: X_Center, y: Y_E };
                        const D = { x: X_D, y: Y_E };
                        const B = { x: X_Center, y: Y_B };
                        const B1 = { x: X_B1, y: Y_B };

                        // Titik bantu
                        const a1 = { x: X_A1, y: Y_H_bot }; // Proyeksi A1 ke pinggang
                        const b = { x: X_I - 5, y: Y_E }; // Titik b di pinggul
                        const a2 = { x: b.x, y: Y_H_bot }; // Titik a2 di atas b

                        // Kupnat
                        const dart_x = X_A1 + 2;
                        const dart_y_center = Y_H_bot;
                        const dart_top = { x: dart_x, y: dart_y_center - 12 };
                        const dart_bot = { x: dart_x, y: dart_y_center + 12 };
                        const dart_left = { x: dart_x - 1.5, y: dart_y_center };
                        const dart_right = { x: dart_x + 1.5, y: dart_y_center };

                        const maxLebar = pt(X_B1, 0).x + 50;
                        const maxTinggi = pt(0, Y_B).y + 50;

                        let svg = `<svg viewBox="0 0 ${maxLebar} ${maxTinggi}" class="w-full md:w-[60%] lg:w-[45%] bg-white shadow border border-gray-200 rounded-lg" style="height: auto; aspect-ratio: ${maxLebar}/${maxTinggi}; font-family: sans-serif;">`;

                        // Garis Bantu (Putus-putus)
                        const dashLines = [
                            { from: A, to: A1 },
                            { from: A, to: A2 },
                            { from: A1, to: a1 }, // A1 ke a1
                            { from: a2, to: b }, // a2 ke b (20cm)
                            { from: A3, to: F2 }, // A3 ke F2
                            { from: H_top, to: F }, // Garis badan
                            { from: H_bot, to: I }, // Garis pinggang
                            { from: E, to: D } // Garis pinggul
                        ];
                        dashLines.forEach(g => {
                            svg += `<line x1="${pt(g.from.x, g.from.y).x}" y1="${pt(g.from.x, g.from.y).y}"
                                          x2="${pt(g.to.x, g.to.y).x}" y2="${pt(g.to.x, g.to.y).y}"
                                          stroke="#111827" stroke-dasharray="4,4" stroke-width="1.2" />`;
                        });

                        // Garis Pola Utama (Merah tebal)
                        svg += `
                            <path d="M ${pt(Leher_Bawah.x, Leher_Bawah.y).x} ${pt(Leher_Bawah.x, Leher_Bawah.y).y}
                                     Q ${pt(A2.x + 3, Leher_Bawah.y).x} ${pt(A2.x + 3, Leher_Bawah.y).y}, ${pt(A1.x, A1.y).x} ${pt(A1.x, A1.y).y}
                                     L ${pt(C2.x, C2.y).x} ${pt(C2.x, C2.y).y}
                                     Q ${pt(F2.x, F2.y + 5).x} ${pt(F2.x, F2.y + 5).y}, ${pt(F.x, F.y).x} ${pt(F.x, F.y).y}
                                     L ${pt(I.x, I.y).x} ${pt(I.x, I.y).y}
                                     Q ${pt(I.x + (D.x - I.x)/2, I.y + 10).x} ${pt(I.x + (D.x - I.x)/2, I.y + 10).y}, ${pt(D.x, D.y).x} ${pt(D.x, D.y).y}
                                     L ${pt(B1.x, B1.y).x} ${pt(B1.x, B1.y).y}
                                     L ${pt(B.x, B.y).x} ${pt(B.x, B.y).y}
                                     L ${pt(Leher_Bawah.x, Leher_Bawah.y).x} ${pt(Leher_Bawah.x, Leher_Bawah.y).y} Z"
                                  fill="#fecaca" fill-opacity="0.3" stroke="#ff0000" stroke-width="2.5" />
                        `;

                        // Garis Leher Belakang (Opsional, merah)
                        svg += `<path d="M ${pt(A2.x, A2.y).x} ${pt(A2.x, A2.y).y} Q ${pt(A2.x + 4, A2.y).x} ${pt(A2.x + 4, A2.y).y}, ${pt(A1.x, A1.y).x} ${pt(A1.x, A1.y).y}" fill="none" stroke="#ff0000" stroke-width="2.5" />`;
                        svg += `<line x1="${pt(A2.x, A2.y).x}" y1="${pt(A2.x, A2.y).y}" x2="${pt(Leher_Bawah.x, Leher_Bawah.y).x}" y2="${pt(Leher_Bawah.x, Leher_Bawah.y).y}" stroke="#ff0000" stroke-width="2.5" />`;

                        // Kupnat
                        svg += `
                            <path d="M ${pt(dart_top.x, dart_top.y).x} ${pt(dart_top.x, dart_top.y).y}
                                     L ${pt(dart_right.x, dart_right.y).x} ${pt(dart_right.x, dart_right.y).y}
                                     L ${pt(dart_bot.x, dart_bot.y).x} ${pt(dart_bot.x, dart_bot.y).y}
                                     L ${pt(dart_left.x, dart_left.y).x} ${pt(dart_left.x, dart_left.y).y} Z"
                                  fill="none" stroke="#111827" stroke-dasharray="3,3" stroke-width="1.2" />
                        `;
                        svg += `<line x1="${pt(dart_top.x, dart_top.y).x}" y1="${pt(dart_top.x, dart_top.y).y}" x2="${pt(dart_bot.x, dart_bot.y).x}" y2="${pt(dart_bot.x, dart_bot.y).y}" stroke="#111827" stroke-dasharray="3,3" stroke-width="1.2" />`;

                        // Titik & Label Sesuai Gambar
                        const labels = [
                            { id: 'A', pt: A, ox: -15, oy: -5 },
                            { id: 'A1', pt: A1, ox: 0, oy: -10 },
                            { id: 'A2', pt: A2, ox: -20, oy: 5 },
                            { id: 'C2', pt: C2, ox: 10, oy: -5 },
                            { id: 'A3', pt: A3, ox: -20, oy: 5 },
                            { id: 'F2', pt: F2, ox: 10, oy: 5 },
                            { id: 'H', pt: H_top, ox: -15, oy: 5 },
                            { id: 'F', pt: F, ox: 10, oy: 5 },
                            { id: 'H', pt: H_bot, ox: -15, oy: 5 },
                            { id: 'I', pt: I, ox: 15, oy: 5 },
                            { id: 'a1', pt: a1, ox: -15, oy: -5 },
                            { id: 'a2', pt: a2, ox: -5, oy: -10 },
                            { id: 'b', pt: b, ox: -5, oy: 15 },
                            { id: 'E', pt: E, ox: -15, oy: 5 },
                            { id: 'D', pt: D, ox: 15, oy: 5 },
                            { id: 'B', pt: B, ox: -15, oy: 15 },
                            { id: 'B1', pt: B1, ox: 15, oy: 15 }
                        ];

                        labels.forEach(l => {
                            const p = pt(l.pt.x, l.pt.y);
                            svg += `<text x="${p.x + l.ox}" y="${p.y + l.oy}" font-family="sans-serif" font-size="12" fill="#111827">${l.id}</text>`;
                        });

                        // Teks Ukuran
                        const textSizes = [
                            { text: '8', pt: {x: 0, y: (Y_A2 + Y_Leher)/2}, ox: 10, oy: 5 },
                            { text: '1,5', pt: dart_left, ox: -5, oy: -5 },
                            { text: '1,5', pt: dart_right, ox: 5, oy: -5 }
                        ];
                        textSizes.forEach(t => {
                            const p = pt(t.pt.x, t.pt.y);
                            svg += `<text x="${p.x + t.ox}" y="${p.y + t.oy}" font-size="9" fill="#111827">${t.text}</text>`;
                        });

                        svg += `</svg>`;
                        svgHTML = svg;
                    }
                    gambarPolaWanita();
                }

                wrapper.innerHTML = svgHTML;

                function renderDetailTitikUkuran() {
                    let html = '';

                    if (activeType === 'KEMEJA' && selectedCustomer) {
                        // KEMEJA
                        // Data Titik/Titik Kunci berdasarkan renderSVG di file_context_0
                        const PB = parseInt(selectedCustomer.p_baju) || 70;
                        const LB = parseInt(selectedCustomer.l_badan) || 100;
                        const LBa =
                            selectedCustomer.l_punggung !== undefined
                                ? parseInt(selectedCustomer.l_punggung) / 2
                                : 24;

                        // --- Pola Kemeja Utama
                        html += `<div>
                                                                                        <div class="font-bold text-[11px] text-primary dark:text-accent mb-1">
                                                                                            Pola Kemeja:
                                                                                        </div>
                                                                                        <ul class="ml-3 list-disc space-y-0.5">
                                                                                            <li>A &ndash; F (Leher Belakang) = 3 cm</li>
                                                                                            <li>F &ndash; A (Garis Tengah Kiri) = 3 cm</li>
                                                                                            <li>A &ndash; A1 (Garis Tengah Kiri ke Leher Depan) = 6 cm</li>
                                                                                            <li>A &ndash; A2 (Garis Tengah ke Bahu Atas) = 7 cm</li>
                                                                                            <li>Bahu A2 &ndash; B (Lebar Bahu) = ${LBa ? (LBa - 7).toFixed(1) : '-'} cm</li>
                                                                                            <li>A1 &ndash; B (Leher Depan ke Bahu) = 6 cm</li>
                                                                                            <li>C (Garis Dada) = ${(LB / 4).toFixed(1)} cm dari A1</li>
                                                                                            <li>Panjang Baju (A1 &ndash; D) = ${PB} cm</li>
                                                                                            <li>C &ndash; C1 depan (Lebar Dada Depan) = ${(LB / 4 + 7).toFixed(1)} cm</li>
                                                                                            <li>C &ndash; C1 belakang (Lebar Dada Belakang) = ${(LB / 4 + 5).toFixed(1)} cm</li>
                                                                                            <li>C1 depan &ndash; C1 belakang (Selisih Pola Depan/Belakang) = 2 cm</li>
                                                                                        </ul>
                                                                                    </div>`;

                        // --- Pola Lengan
                        html += `<div>
                                                                                        <div class="font-bold text-[11px] text-primary dark:text-accent mb-1">
                                                                                            Pola Lengan Kemeja:
                                                                                        </div>
                                                                                        <ul class="ml-3 list-disc space-y-0.5">
                                                                                            <li>Panjang Lengan = ${selectedCustomer.p_lengan || 60} cm</li>
        <li>Lingkar Lengan Atas = ${selectedCustomer.l_lengan || Math.round((LB / 5 + 5) * 2) || 40} cm</li>
                                                                                            <li>Lingkar Pergelangan = ${selectedCustomer.lengan_bawah || 20} cm</li>
                                                                                        </ul>
                                                                                    </div>`;

                        // --- Pola Kerah
                        html += `<div>
                                                                                        <div class="font-bold text-[11px] text-primary dark:text-accent mb-1">
                                                                                            Pola Kerah Kemeja:
                                                                                        </div>
                                                                                        <ul class="ml-3 list-disc space-y-0.5">
                                                                                            <li>Panjang Kerah = ${selectedCustomer.lingkar_leher || Math.round(LB / 5 + 5) || 40} cm</li>
                                                                                            <li>Lebar Kerah = ${selectedCustomer.lebar_kerah || 12} cm</li>
                                                                                        </ul>
                                                                                    </div>`;
                    } else if (activeType === 'CELANA' && selectedCustomer) {
                        // CELANA
                        const panjang = parseInt(selectedCustomer.p_celana) || 95;
                        const pinggang = parseInt(selectedCustomer.l_pinggang) || 72;
                        const pesak = parseInt(selectedCustomer.l_pesak) || 66;
                        const paha = parseInt(selectedCustomer.l_paha) || 62;
                        const lutut = parseInt(selectedCustomer.l_lutut) || 52;
                        const kaki = parseInt(selectedCustomer.l_kaki) || 40;
                        const tinggiDuduk = (pesak / 2) - 6;

                        html += `<div>
                                    <div class="font-bold text-[11px] text-primary dark:text-accent mb-1">
                                        Pola Celana Panjang Bagian Depan:
                                    </div>
                                    <ul class="ml-3 list-disc space-y-0.5 mb-3">
                                        <li>Buat garis sumbu: A - B tegak lurus g</li>
                                        <li>A &ndash; B (Panjang celana - ban pinggang 3 cm) = ${panjang - 3} cm</li>
                                        <li>A &ndash; A1 (Tinggi duduk = ½ Lingkar pesak - 6 cm) = ${tinggiDuduk} cm</li>
                                        <li>A1 &ndash; A2 (½ (A1 - B) dikurangi 3 cm) = ${((panjang - 3 - tinggiDuduk) / 2 - 3).toFixed(1)} cm</li>
                                        <li>A &ndash; E1 (1/3 dari ¼ lingkar pinggang) = ${((pinggang / 4) / 3).toFixed(1)} cm</li>
                                        <li>E1 &ndash; E (¼ lingkar pinggang) = ${pinggang / 4} cm</li>
                                        <li>C &ndash; C1 (½ lingkar paha - 4 cm) = ${paha / 2 - 4} cm</li>
                                        <li>F &ndash; F1 (½ lingkar lutut - 2.5 cm) = ${lutut / 2 - 2.5} cm</li>
                                        <li>D &ndash; D1 (½ lingkar kaki - 2 cm) = ${kaki / 2 - 2} cm</li>
                                        <li>C1 &ndash; C2 = 3.5 cm</li>
                                        <li>C2 &ndash; C3 = 6 cm</li>
                                        <li>Lebar golbi = 3.5 cm</li>
                                    </ul>
                                    <div class="font-bold text-[11px] text-primary dark:text-accent mb-1">
                                        Pola Celana Panjang Bagian Belakang:
                                    </div>
                                    <ul class="ml-3 list-disc space-y-0.5">
                                        <li>E1 &ndash; H2 = 2 cm</li>
                                        <li>H2 &ndash; H1 = 2.5 cm</li>
                                        <li>H1 &ndash; H (¼ lingkar pinggang + 3 cm) = ${pinggang / 4 + 3} cm</li>
                                        <li class="italic text-gray-500 mt-1">*Catatan: Titik H menyentuh garis g.</li>
                                    </ul>
                                </div>`;
                    } else if (activeType === 'ROK' && selectedCustomer) {
                        const pinggang = parseInt(selectedCustomer.l_pinggang) || 68;
                        const pinggul = parseInt(selectedCustomer.l_pinggul) || 90;
                        const panjang = parseInt(selectedCustomer.p_rok) || 65;
                        const tinggiPinggul = 18;

                        html += `<div>
                                    <div class="font-bold text-[11px] text-primary dark:text-accent mb-1">
                                        Pola Rok:
                                    </div>
                                    <ul class="ml-3 list-disc space-y-0.5">
                                        <li>Panjang Rok (A &ndash; B / a &ndash; g) = ${panjang} cm</li>
                                        <li>Tinggi Pinggul (A &ndash; C / a &ndash; c) = ${tinggiPinggul} cm</li>
                                        <li>Lebar Pinggul Depan (c &ndash; e) = ${(pinggul / 4 + 1).toFixed(1)} cm</li>
                                        <li>Lebar Pinggul Belakang (C &ndash; E) = ${(pinggul / 4 - 1).toFixed(1)} cm</li>
                                        <li>Lebar Pinggang Depan (a &ndash; d) = ${(pinggang / 4 + 1 + 3).toFixed(1)} cm</li>
                                        <li>Lebar Pinggang Belakang (A &ndash; D) = ${(pinggang / 4 - 1 + 3).toFixed(1)} cm</li>
                                        <li>Lebar Kupnat Depan/Belakang = 3 cm</li>
                                        <li>Kedalaman Kupnat Depan/Belakang = 8 cm</li>
                                    </ul>
                                </div>`;
                    } else if (activeType === 'WANITA' && selectedCustomer) {
                        const LB = parseInt(selectedCustomer.l_badan) || 90;
                        const LPg = parseInt(selectedCustomer.l_pinggang) || 72;
                        const LPa = parseInt(selectedCustomer.l_pinggul) || 94;
                        const lebarBahu = parseInt(selectedCustomer.l_bahu) || 38;
                        const lebarDada = parseInt(selectedCustomer.l_dada) || 32;
                        const pBaju = parseInt(selectedCustomer.p_baju) || 135;
                        const lebarLingkarLengan = (parseInt(selectedCustomer.l_lengan) || 44) / 2;

                        html += `<div>
                                    <div class="font-bold text-[11px] text-primary dark:text-accent mb-1">
                                        Pola Wanita:
                                    </div>
                                    <ul class="ml-3 list-disc space-y-0.5">
                                        <li>A &ndash; A1 (Leher Horizontal) = 8 cm</li>
                                        <li>A &ndash; A2 (Leher Belakang) = 3 cm</li>
                                        <li>A2 &ndash; C1 (Lebar Bahu) = ${lebarBahu} cm</li>
                                        <li>A2 &ndash; A3 (Lebar Lingkar Lengan) = ${lebarLingkarLengan} cm</li>
                                        <li>A3 &ndash; F2 (Lebar Dada) = ${(lebarDada / 2).toFixed(1)} cm</li>
                                        <li>H &ndash; F (Lingkar Badan / 4 + 2cm) = ${(LB / 4 + 2).toFixed(1)} cm</li>
                                        <li>H &ndash; I (Lingkar Pinggang / 4 + 3cm + 2cm) = ${(LPg / 4 + 5).toFixed(1)} cm</li>
                                        <li>E &ndash; D (Lingkar Pinggul / 4 + 2cm) = ${(LPa / 4 + 2).toFixed(1)} cm</li>
                                        <li>A1 &ndash; a1 (Turun Pinggang) = 40 cm (Standar)</li>
                                        <li>a2 &ndash; b (Jarak Pinggang ke Pinggul) = 20 cm</li>
                                        <li>A &ndash; B (Panjang Baju) = ${pBaju} cm</li>
                                        <li>B &ndash; B1 (Lebar Bawah) = E &ndash; D = ${(LPa / 4 + 2).toFixed(1)} cm</li>
                                    </ul>
                                </div>`;
                    } else {
                        html = `<div class="text-gray-500 text-sm">Pilih pelanggan dan tipe pola untuk melihat detail titik ukuran.</div>`;
                    }

                    document.getElementById('detailJarakTitikPola').innerHTML = html;
                }

                // Jalankan saat renderSVG dipanggil
                renderDetailTitikUkuran();
            }

            // Save to LocalStorage Actions
            const btnSaveDraft = document.getElementById('btn-save-draft');
            const btnGenerate = document.getElementById('btn-generate');

            if (btnSaveDraft) {
                btnSaveDraft.addEventListener('click', () => savePattern('Draf'));
            }
            if (btnGenerate) {
                btnGenerate.addEventListener('click', () => savePattern('Aktif'));
            }

            function savePattern(status) {
                if (!selectedCustomer) {
                    alert('Harap pilih pelanggan terlebih dahulu!');
                    return;
                }

                fetch('/hasilkan-pola/simpan', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        pelanggan_id: selectedCustomer.pelanggan_id,
                        type: activeType,
                        status: status,
                    }),
                })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            showNotification(
                                status === 'Draf'
                                    ? 'Pola berhasil disimpan sebagai draf!'
                                    : 'Pola berhasil dibuat dan ditambahkan ke arsip!'
                            );

                            setTimeout(() => {
                                window.location.href = '/arsip-pola';
                            }, 1200);
                        } else {
                            alert('Gagal menyimpan pola.');
                        }
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat menyimpan.');
                    });
            }

            // Helper Toast
            function showNotification(message, iconClass = 'fa-check-circle') {
                const toast = document.getElementById('toast');
                const toastMsg = document.getElementById('toast-message');
                const toastIcon = document.getElementById('toast-icon');

                toastMsg.innerText = message;
                toastIcon.innerHTML = `<i class="fas ${iconClass}"></i>`;

                toast.classList.remove('translate-y-[-100px]', 'opacity-0');
                toast.classList.add('translate-y-0', 'opacity-100');

                setTimeout(() => {
                    toast.classList.remove('translate-y-0', 'opacity-100');
                    toast.classList.add('translate-y-[-100px]', 'opacity-0');
                }, 3000);
            }
        });
    </script>
@endsection
