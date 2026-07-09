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
                let totalWidth = 0;
                let maxHeight = 0;
                let combinedInner = '';

                svgs.forEach((svg) => {
                    let width = 1000;
                    let height = 1000;

                    const viewBox = svg.getAttribute('viewBox');
                    if (viewBox) {
                        const matches = viewBox.match(/[\d\.]+/g);
                        if (matches && matches.length >= 4) {
                            width = parseFloat(matches[2]);
                            height = parseFloat(matches[3]);
                        }
                    }

                    if (height > maxHeight) maxHeight = height;

                    let inner = svg.innerHTML;
                    // Gunakan tag <g> dan susun menyamping (horizontal) dengan translate X
                    combinedInner += `<g transform="translate(${totalWidth}, 0)">${inner}</g>`;
                    totalWidth += width + 50; // Beri jarak 50px antar pola secara horizontal
                });

                totalWidth += 100;
                maxHeight += 100;

                const finalSVG = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 ${totalWidth} ${maxHeight}" width="${totalWidth}" height="${maxHeight}" style="background-color: #ffffff;">
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

            @include ('hasilkan-pola.partials.render-svg')

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
                                window.location.href = '/pola-busana';
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
