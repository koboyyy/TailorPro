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
            const patternsData = {!! json_encode($patterns ?? []) !!};
            let patterns = patternsData;
            let activePattern = null;
            let currentScale = 1.0;
            let searchQuery = '';

            // Icon SVG Helper
            function getClothingIcon(type) {
                switch (type) {
                    case 'BAJU':
                    case 'KEMEJA':
                        return '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.38 3.46 16 2a4 4 0 0 1-8 0L3.62 3.46a2 2 0 0 0-1.34 2.23l.58 3.47a1 1 0 0 0 .99.84H6v10c0 1.1.9 2 2 2h8a2 2 0 0 0 2-2V10h2.15a1 1 0 0 0 .99-.84l.58-3.47a2 2 0 0 0-1.34-2.23z"/></svg>';
                    case 'CELANA':
                        return '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 3h12a2 2 0 0 1 2 2v2a2 2 0 0 1-.5 1.3l-3.5 4.7v9a2 2 0 0 1-2 2H10a2 2 0 0 1-2-2v-9L4.5 8.3A2 2 0 0 1 4 7V5a2 2 0 0 1 2-2z"/></svg>';
                    case 'ROK':
                        return '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 4h8l5 16H3z"/></svg>';
                    case 'GAMIS':
                        return '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 4c0 1.5 1.5 3 3 3s3-1.5 3-3M6 4h12l3 6h-3l-2 11H8l-2-11H3z"/></svg>';
                    case 'JAS':
                        return '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 4h12l4 6h-3v11H5V10H2z"/><path d="M12 4v17"/><path d="M9 4l3 6 3-6"/></svg>';
                    default:
                        return '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 8v4"/><path d="M12 16h.01"/></svg>';
                }
            }

            // DOM elements
            const tableBody = document.getElementById('patterns-table-body');
            const emptyState = document.getElementById('empty-state');
            const searchInput = document.getElementById('search-input');

            // Routing Logic
            function handleRouting() {
                const hash = window.location.hash || '#list';

                document.getElementById('view-list').classList.add('hidden');
                document.getElementById('view-detail').classList.add('hidden');

                // Find layout breadcrumbs to edit
                const breadcrumbSpans = document.querySelectorAll('header.pb-6 .text-xs.text-grey span');
                let parentSpan = breadcrumbSpans.length > 0 ? breadcrumbSpans[0] : null;
                let activeSpan = breadcrumbSpans.length > 2 ? breadcrumbSpans[2] : null;

                if (hash === '#list') {
                    document.getElementById('view-list').classList.remove('hidden');
                    if (parentSpan) parentSpan.innerText = 'halaman';
                    if (activeSpan) activeSpan.innerText = 'pola busana';
                    renderPatterns();
                } else if (hash.startsWith('#detail-')) {
                    document.getElementById('view-detail').classList.remove('hidden');
                    if (parentSpan) parentSpan.innerText = 'pola busana';
                    if (activeSpan) activeSpan.innerText = 'detail pola';
                    const id = parseInt(hash.split('-')[1]);
                    loadDetailView(id);
                }
            }

            window.addEventListener('hashchange', handleRouting);

            // Search listener
            if (searchInput) {
                searchInput.addEventListener('input', function (e) {
                    searchQuery = e.target.value;
                    renderPatterns();
                });
            }

            // Run Initial Load
            handleRouting();

            function renderPatterns() {
                patterns = patternsData;
                let filtered = patterns;

                if (searchQuery.trim() !== '') {
                    const query = searchQuery.toLowerCase();
                    filtered = filtered.filter(
                        (p) =>
                            p.name.toLowerCase().includes(query) ||
                            p.customerName.toLowerCase().includes(query)
                    );
                }

                document.getElementById('pagination-info').innerText =
                    `Menampilkan 1-${filtered.length} dari ${patterns.length} pola tersimpan`;

                if (filtered.length === 0) {
                    tableBody.innerHTML = '';
                    emptyState.classList.remove('hidden');
                    return;
                }

                emptyState.classList.add('hidden');
                tableBody.innerHTML = filtered
                    .map((p) => {
                        const statusClass =
                            p.status === 'Aktif'
                                ? 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950/30 dark:text-emerald-400'
                                : 'bg-gray-100 text-gray-500 dark:bg-slate-800 dark:text-slate-400';

                        // Format Jenis Busana Readable
                        const typeLabelMap = {
                            BAJU: 'Baju',
                            CELANA: 'Celana',
                            ROK: 'Rok',
                            GAMIS: 'Gamis',
                        };
                        const typeLabel = typeLabelMap[p.type] || p.type;

                        return `
                <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/40 transition duration-150">
                    <!-- Pattern Name & Icon -->
                    <td class="px-8 py-5">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg bg-gray-50 dark:bg-slate-800 flex items-center justify-center text-primary dark:text-accent font-bold font-serif text-sm">${getClothingIcon(p.type)}</span>
                            <div>
                                <span class="block text-sm font-bold text-slate-800 dark:text-slate-100">${p.name}</span>
                            </div>
                        </div>
                    </td>

                    <!-- Type -->
                    <td class="px-8 py-5 align-middle">
                        <span class="inline-block px-2.5 py-1 text-[9px] font-bold text-primary dark:text-accent bg-primary/10 dark:bg-primary/30 rounded-md leading-none">${typeLabel}</span>
                    </td>

                    <!-- Customer -->
                    <td class="px-8 py-5 align-middle">
                        <div class="flex items-center gap-2.5">
                            <div class="w-6 h-6 rounded-full ${p.avatarBg} font-bold text-[8px] flex items-center justify-center shrink-0">${p.initials}</div>
                            <div>
                                <span class="block text-xs font-bold text-slate-800 dark:text-slate-200">${p.customerName}</span>
                                <span class="block text-[9px] text-gray-400">${p.customerCode}</span>
                            </div>
                        </div>
                    </td>

                    <!-- Date -->
                    <td class="px-8 py-5 text-gray-500 dark:text-slate-400 align-middle">
                        ${p.date}
                    </td>

                    <!-- Status -->
                    <td class="px-8 py-5 align-middle">
                        <span class="px-2 py-0.5 rounded-full text-[9px] font-bold uppercase tracking-wider ${statusClass}">${p.status}</span>
                    </td>

                    <!-- Action buttons -->
                    <td class="px-8 py-5 text-right align-middle">
                        <div class="flex items-center justify-end gap-2">
                            <a href="#detail-${p.id}" class="w-8 h-8 rounded-lg bg-gray-50 dark:bg-slate-800 border border-gray-100 dark:border-slate-700 flex items-center justify-center text-gray-400 hover:text-primary dark:hover:text-accent hover:scale-105 active:scale-95 transition" title="Lihat Pola">
                                <i class="fa-regular fa-eye text-xs"></i>
                            </a>
                            <button onclick="downloadSVGEffect(${p.id})" class="w-8 h-8 rounded-lg bg-gray-50 dark:bg-slate-800 border border-gray-100 dark:border-slate-700 flex items-center justify-center text-gray-400 hover:text-primary dark:hover:text-accent hover:scale-105 active:scale-95 transition" title="Unduh SVG">
                                <i class="fas fa-download text-xs"></i>
                            </button>
                            <button onclick="deletePattern(${p.id})" class="w-8 h-8 rounded-lg bg-gray-50 dark:bg-slate-800 border border-gray-100 dark:border-slate-700 flex items-center justify-center text-gray-400 hover:text-red-500 hover:scale-105 active:scale-95 transition" title="Hapus Pola">
                                <i class="fa-regular fa-trash-can text-xs"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `;
                    })
                    .join('');
            }

            // Load Detail view
            function loadDetailView(id) {
                patterns = patternsData;
                activePattern = patterns.find((p) => p.id === id);
                if (!activePattern) {
                    window.location.hash = '#list';
                    return;
                }

                // Title info
                document.getElementById('detail-title').innerText = activePattern.name;

                // Customer Card info
                document.getElementById('detail-customer-avatar').innerText = activePattern.initials;
                document.getElementById('detail-customer-avatar').className =
                    `w-10 h-10 rounded-full font-bold text-sm flex items-center justify-center ${activePattern.avatarBg}`;
                document.getElementById('detail-customer-name').innerText = activePattern.customerName;
                document.getElementById('detail-customer-id').innerText = activePattern.customerCode;

                // Metric list
                const metrics = [
                    { label: 'Lingkar Dada', val: activePattern.l_dada },
                    { label: 'Panjang Baju', val: activePattern.p_baju },
                    { label: 'Lebar Bahu', val: activePattern.l_bahu },
                    { label: 'Panjang Lengan', val: activePattern.p_lengan },
                    { label: 'Lingkar Pinggang', val: activePattern.l_pinggang },
                    { label: 'Lingkar Pinggul', val: activePattern.l_pinggul },
                    { label: 'Panjang Celana', val: activePattern.p_celana },
                    { label: 'Panjang Rok', val: activePattern.p_rok },
                ];

                document.getElementById('detail-sizes-list').innerHTML = metrics
                    .map(
                        (m) => `
            <div class="flex justify-between py-2.5 text-xs font-semibold text-slate-700 dark:text-slate-300">
                <span class="text-gray-400">${m.label}</span>
                <span class="font-bold text-slate-800 dark:text-white">${m.val} ${m.val !== '-' ? 'cm' : ''}</span>
            </div>
        `
                    )
                    .join('');

                // Estimates
                const fabricEstimates = {
                    BAJU: '3 METER',
                    CELANA: '2.5 METER',
                    ROK: '2 METER',
                    GAMIS: '4 METER',
                };
                document.getElementById('detail-fabric-estimation').innerText =
                    fabricEstimates[activePattern.type] || '3 METER';

                // Render SVG Pattern
                renderSVGDetail();
            }

            // Zooming
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

            // Print SVG
            window.printPattern = function () {
                if (!activePattern) return;
                const printWindow = window.open('', '_blank');
                const svgContent = document.getElementById('svg-wrapper').innerHTML;
                printWindow.document.write(`
            <html>
                <head>
                    <title>Cetak Pola - ${activePattern.customerName}</title>
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
                        <h2>JahitSpace Pola Teknis (Arsip)</h2>
                        <p>Pelanggan: <b>${activePattern.customerName} (${activePattern.customerCode})</b></p>
                        <p>Jenis Busana: <b>${activePattern.type}</b></p>
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

            // Download SVG
            window.downloadSVG = function () {
                if (!activePattern) return;

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

                // Tambahkan ekstra padding
                totalWidth += 100;
                maxHeight += 100;

                const finalSVG = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 ${totalWidth} ${maxHeight}" width="${totalWidth}" height="${maxHeight}" style="background-color: #ffffff;">
                    ${combinedInner}
                </svg>`;

                const blob = new Blob([finalSVG], { type: 'image/svg+xml;charset=utf-8' });
                const url = URL.createObjectURL(blob);
                const link = document.createElement('a');
                link.href = url;
                link.download = `pola_${activePattern.type.toLowerCase()}_${activePattern.customerName.toLowerCase().replace(/\s+/g, '_')}.svg`;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                URL.revokeObjectURL(url);
                showNotification('Berkas pola SVG berhasil diunduh!');
            };

            // External Download trigger
            window.downloadSVGEffect = function (id) {
                patterns = patternsData;
                const pattern = patterns.find((p) => p.id === id);
                if (!pattern) return;

                // Render temporarily to get SVG content
                activePattern = pattern;
                loadDetailView(id);
                downloadSVG();

                // Revert back
                window.location.hash = '#list';
            };

            // Delete saved pattern
            window.deletePattern = function (id) {
                patterns = patternsData;
                const pattern = patterns.find((p) => p.id === id);
                if (!pattern) return;

                if (confirm(`Apakah Anda yakin ingin menghapus arsip pola "${pattern.name}"?`)) {
                    fetch(`/pola-busana/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                    })
                        .then((response) => response.json())
                        .then((data) => {
                            if (data.success) {
                                patternsData.splice(
                                    patternsData.findIndex((p) => p.id === id),
                                    1
                                );
                                showNotification(
                                    `Arsip "${pattern.name}" berhasil dihapus`,
                                    'fa-trash-can'
                                );
                                renderPatterns();
                            } else {
                                alert('Gagal menghapus pola');
                            }
                        })
                        .catch((error) => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan saat menghapus');
                        });
                }
            };

            // RENDER DETAIL SVG BLUEPRINTS
            function renderSVGDetail() {
                if (!activePattern) return;
                const wrapper = document.getElementById('svg-wrapper');
                const strokeColor = document.documentElement.classList.contains('dark')
                    ? '#60a5fa'
                    : '#4A3A2A';
                const leaderColor = '#8C7A6B';

                let svgHTML = '';
                const selectedCustomer = activePattern.ukuran || activePattern;

                if (activePattern.type === 'KEMEJA' || activePattern.type === 'BAJU') {

                    function gambarPolaBajuKemeja() {
                        const PB = parseInt(selectedCustomer.p_baju) || 70;
                        const LB = parseInt(selectedCustomer.l_badan || selectedCustomer.l_dada) || 100;
                        const LBa = parseInt(selectedCustomer.l_punggung)
                            ? parseInt(selectedCustomer.l_punggung) / 2
                            : parseInt(selectedCustomer.l_bahu) / 2 || 24;

                        const skala = 10;
                        const padX = 80;
                        const padY = 100;
                        const pt = (x, y) => ({ x: padX + x * skala, y: padY + y * skala });

                        const A = { x: 0, y: 0 };
                        const F = { x: 0, y: -3 };
                        const A1 = { x: 0, y: 6 };
                        const C = { x: 0, y: A1.y + LB / 4 };
                        const D = { x: 0, y: PB };
                        const A2 = { x: 7, y: 0 };
                        const B = { x: 7 + (LBa - 7), y: 6 };
                        const E = { x: 7, y: -6 };
                        const G = { x: B.x, y: B.y - 6 };
                        const C1_belakang = { x: LB / 4 + 5, y: C.y };
                        const C1_depan = { x: C1_belakang.x + 2, y: C.y };
                        const D1_belakang = { x: C1_belakang.x, y: PB };
                        const D1_depan = { x: C1_depan.x, y: PB };

                        const maxLebar = pt(C1_depan.x, 0).x + 60;
                        const maxTinggi = pt(0, D.y).y + 60;

                        let svg = `<svg viewBox="0 0 ${maxLebar} ${maxTinggi}" class="w-full md:w-[45%] lg:w-[30%] bg-white shadow border border-gray-200 rounded-lg" style="height: auto; aspect-ratio: ${maxLebar}/${maxTinggi};">`;

                        svg += `<path d="M ${pt(F.x, F.y).x} ${pt(F.x, F.y).y} C ${pt(F.x + 3.5, F.y).x} ${pt(F.x + 3.5, F.y).y}, ${pt(E.x, E.y + 1.5).x} ${pt(E.x, E.y + 1.5).y}, ${pt(E.x, E.y).x} ${pt(E.x, E.y).y} L ${pt(G.x, G.y).x} ${pt(G.x, G.y).y} C ${pt(G.x, G.y + (C1_belakang.y - G.y) * 0.5).x} ${pt(G.x, G.y + (C1_belakang.y - G.y) * 0.5).y}, ${pt(C1_belakang.x - 5, C1_belakang.y).x} ${pt(C1_belakang.x - 5, C1_belakang.y).y}, ${pt(C1_belakang.x, C1_belakang.y).x} ${pt(C1_belakang.x, C1_belakang.y).y} L ${pt(D1_belakang.x, D1_belakang.y).x} ${pt(D1_belakang.x, D1_belakang.y).y} L ${pt(D.x, D.y).x} ${pt(D.x, D.y).y} Z" fill="#fecaca" fill-opacity="0.5" stroke="#ef4444" stroke-width="2" />`;
                        svg += `<path d="M ${pt(A1.x, A1.y).x} ${pt(A1.x, A1.y).y} C ${pt(A1.x + 3.5, A1.y).x} ${pt(A1.x + 3.5, A1.y).y}, ${pt(A2.x, A2.y + 3.5).x} ${pt(A2.x, A2.y + 3.5).y}, ${pt(A2.x, A2.y).x} ${pt(A2.x, A2.y).y} L ${pt(B.x, B.y).x} ${pt(B.x, B.y).y} C ${pt(B.x, B.y + (C1_depan.y - B.y) * 0.5).x} ${pt(B.x, B.y + (C1_depan.y - B.y) * 0.5).y}, ${pt(C1_depan.x - 7, C1_depan.y).x} ${pt(C1_depan.x - 7, C1_depan.y).y}, ${pt(C1_depan.x, C1_depan.y).x} ${pt(C1_depan.x, C1_depan.y).y} L ${pt(D1_depan.x, D1_depan.y).x} ${pt(D1_depan.x, D1_depan.y).y} L ${pt(D.x, D.y).x} ${pt(D.x, D.y).y} Z" fill="#bfdbfe" fill-opacity="0.6" stroke="#2563eb" stroke-width="2.5" />`;

                        const garisBantu = [
                            { from: F, to: D },
                            { from: A, to: A2 },
                            { from: A1, to: B },
                            { from: C, to: C1_depan },
                            { from: A2, to: E },
                            { from: B, to: G },
                        ];
                        garisBantu.forEach((g) => {
                            svg += `<line x1="${pt(g.from.x, g.from.y).x}" y1="${pt(g.from.x, g.from.y).y}" x2="${pt(g.to.x, g.to.y).x}" y2="${pt(g.to.x, g.to.y).y}" stroke="#6b7280" stroke-dasharray="5,5" />`;
                        });

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
                            svg += `<circle cx="${p.x}" cy="${p.y}" r="4" fill="#1f2937" /><text x="${p.x + l.offsetX}" y="${p.y + l.offsetY}" font-family="sans-serif" font-size="16" font-weight="bold" fill="#111827">${l.id}</text>`;
                        });

                        svg += buatTeksUkuran('3cm', pt(F.x + 1, F.y + 1.5).x, pt(F.x + 1, F.y + 1.5).y);
                        svg += buatTeksUkuran('6cm', pt(A.x + 1, A.y + 3).x, pt(A.x + 1, A.y + 3).y);
                        svg += buatTeksUkuran('6cm', pt(A2.x + 1, E.y + 3).x, pt(A2.x + 1, E.y + 3).y);
                        svg += buatTeksUkuran('6cm', pt(B.x - 1.5, G.y + 3).x, pt(B.x - 1.5, G.y + 3).y);
                        svg += buatTeksUkuran(
                            '2cm',
                            pt(C1_belakang.x + 1, C.y - 1).x,
                            pt(C1_belakang.x + 1, C.y - 1).y
                        );
                        svg += buatTeksUkuran(
                            '1cm',
                            pt(B.x + 2, B.y + (C1_belakang.y - B.y) / 2).x,
                            pt(B.x + 2, B.y + (C1_belakang.y - B.y) / 2).y
                        );

                        svg += `</svg>`;
                        svgHTML = svg;
                    }

                    function buatTeksUkuran(teks, x, y, rotasi = 0) {
                        return `<text x="${x}" y="${y}" font-family="sans-serif" font-size="14" font-weight="600" fill="#4b5563" text-anchor="middle" dominant-baseline="middle" transform="rotate(${rotasi}, ${x}, ${y})">${teks}</text>`;
                    }

                    gambarPolaBajuKemeja();

                    function gambarPolaLenganKemeja() {
                        const panjangLengan = parseInt(selectedCustomer.p_lengan) || 60;
                        const lingkarLengan = parseInt(selectedCustomer.l_lengan) || 40;
                        const skala = 10;
                        const padX = 80;
                        const padY = 60;

                        const A = { x: padX, y: padY };
                        const C = { x: padX, y: 10 * skala + padY };
                        const B = { x: padX, y: panjangLengan * skala + padY };
                        const jarakCE = lingkarLengan / 2 + 5;
                        const E = { x: jarakCE * skala + padX, y: 10 * skala + padY };
                        const D = { x: 20 * skala + padX, y: panjangLengan * skala + padY };
                        const cp1 = { x: A.x + (E.x - A.x) * 0.35, y: A.y - 3 * skala };
                        const cp2 = { x: A.x + (E.x - A.x) * 0.65, y: E.y + 2 * skala };

                        const maxLebar = Math.max(E.x, D.x) + padX + 40;
                        const maxTinggi = B.y + padY + 40;

                        let svgUtuh = `<svg viewBox="0 0 ${maxLebar} ${maxTinggi}" class="w-full md:w-[45%] lg:w-[30%] bg-white shadow border border-gray-200 rounded-lg" style="height: auto; aspect-ratio: ${maxLebar}/${maxTinggi};">
                            <path d="M ${A.x} ${A.y} C ${cp1.x} ${cp1.y}, ${cp2.x} ${cp2.y}, ${E.x} ${E.y} L ${D.x} ${D.y} L ${B.x} ${B.y} Z" fill="#bfdbfe" fill-opacity="0.6" stroke="#2563eb" stroke-width="2.5" />
                            <line x1="${A.x}" y1="${A.y}" x2="${C.x}" y2="${C.y}" stroke="#6b7280" stroke-dasharray="5,5" />
                            <line x1="${C.x}" y1="${C.y}" x2="${E.x}" y2="${E.y}" stroke="#6b7280" stroke-dasharray="5,5" />
                            ${buatTeksUkuran('10 cm', A.x - 15, (A.y + C.y) / 2, -90)}
                            ${buatTeksUkuran(panjangLengan + ' cm', A.x - 45, (A.y + B.y) / 2, -90)}
                            ${buatTeksUkuran(jarakCE + ' cm', (C.x + E.x) / 2, C.y + 15, 0)}
                            ${buatTeksUkuran('20 cm', (B.x + D.x) / 2, B.y + 20, 0)}
                        `;

                        const buatLabel = (huruf, x, y, geserX, geserY) =>
                            `<circle cx="${x}" cy="${y}" r="5" fill="#111827" /><text x="${x + geserX}" y="${y + geserY}" font-family="sans-serif" font-size="18" font-weight="bold" fill="#111827">${huruf}</text>`;
                        svgUtuh +=
                            buatLabel('A', A.x, A.y, -25, 5) +
                            buatLabel('C', C.x, C.y, -25, 5) +
                            buatLabel('B', B.x, B.y, -25, 5) +
                            buatLabel('E', E.x, E.y, 15, 5) +
                            buatLabel('D', D.x, D.y, 15, 5) +
                            `</svg>`;
                        svgHTML += svgUtuh;
                    }

                    gambarPolaLenganKemeja();

                    function gambarPolaKerahKemeja() {
                        const LK = selectedCustomer.lingkar_kerah || selectedCustomer.l_leher || 40;
                        const LK2 = LK / 2;
                        const skala = 15;
                        const padX = 80;
                        const padY = 60;
                        const pt = (x, y) => ({ x: padX + x * skala, y: padY + y * skala });

                        const D1 = { x: 0, y: 0 };
                        const A1 = { x: 2, y: 7 };
                        const B1 = { x: LK2, y: 7 };
                        const C1 = { x: LK2, y: 3 };
                        const gapY = 10;
                        const D = { x: 2, y: gapY };
                        const C = { x: LK2, y: gapY };
                        const B = { x: LK2, y: gapY + 3.5 };
                        const A = { x: 0, y: gapY + 2 };

                        const maxLebar = pt(LK2, 0).x + 60;
                        const maxTinggi = pt(0, B.y).y + 60;

                        let svg = `<svg viewBox="0 0 ${maxLebar} ${maxTinggi}" class="w-full md:w-[45%] lg:w-[30%] bg-white shadow border border-gray-200 rounded-lg" style="height: auto; aspect-ratio: ${maxLebar}/${maxTinggi};">`;
                        svg += `<path d="M ${pt(D1.x, D1.y).x} ${pt(D1.x, D1.y).y} C ${pt(LK2 * 0.3, 1.5).x} ${pt(LK2 * 0.3, 1.5).y}, ${pt(LK2 * 0.7, C1.y).x} ${pt(LK2 * 0.7, C1.y).y}, ${pt(C1.x, C1.y).x} ${pt(C1.x, C1.y).y} L ${pt(B1.x, B1.y).x} ${pt(B1.x, B1.y).y} L ${pt(A1.x, A1.y).x} ${pt(A1.x, A1.y).y} L ${pt(D1.x, D1.y).x} ${pt(D1.x, D1.y).y} Z" fill="#bfdbfe" fill-opacity="0.6" stroke="#2563eb" stroke-width="2.5" />`;
                        svg += `<path d="M ${pt(D.x, D.y).x} ${pt(D.x, D.y).y} C ${pt(2 + LK2 * 0.3, D.y + 0.5).x} ${pt(2 + LK2 * 0.3, D.y + 0.5).y}, ${pt(LK2 * 0.7, C.y + 0.5).x} ${pt(LK2 * 0.7, C.y + 0.5).y}, ${pt(C.x, C.y).x} ${pt(C.x, C.y).y} L ${pt(B.x, B.y).x} ${pt(B.x, B.y).y} C ${pt(LK2 * 0.5, B.y).x} ${pt(LK2 * 0.5, B.y).y}, ${pt(3, B.y).x} ${pt(3, B.y).y}, ${pt(A.x, A.y).x} ${pt(A.x, A.y).y} C ${pt(0, gapY + 0.5).x} ${pt(0, gapY + 0.5).y}, ${pt(1, D.y).x} ${pt(1, D.y).y}, ${pt(D.x, D.y).x} ${pt(D.x, D.y).y} Z" fill="#fecaca" fill-opacity="0.6" stroke="#ef4444" stroke-width="2" />`;

                        const garisBantu = [
                            { from: { x: 0, y: -2 }, to: { x: 0, y: B.y + 2 } },
                            { from: { x: 2, y: D1.y }, to: { x: 2, y: B.y + 2 } },
                            { from: { x: LK2, y: -2 }, to: { x: LK2, y: B.y + 2 } },
                        ];
                        garisBantu.forEach((g) => {
                            svg += `<line x1="${pt(g.from.x, g.from.y).x}" y1="${pt(g.from.x, g.from.y).y}" x2="${pt(g.to.x, g.to.y).x}" y2="${pt(g.to.x, g.to.y).y}" stroke="#6b7280" stroke-dasharray="5,5" />`;
                        });

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
                            svg += `<circle cx="${p.x}" cy="${p.y}" r="3" fill="#1f2937" /><text x="${p.x + l.offsetX}" y="${p.y + l.offsetY}" font-family="sans-serif" font-size="16" font-weight="bold" fill="#111827">${l.id}</text>`;
                        });

                        svg += buatTeksUkuran('7 cm', pt(0, A1.y / 2).x - 20, pt(0, A1.y / 2).y, -90);
                        svg += buatTeksUkuran('2 cm', pt(1, A1.y).x, pt(1, A1.y).y + 25);
                        svg += buatTeksUkuran('4 cm', pt(C1.x, C1.y + 2).x + 25, pt(C1.x, C1.y + 2).y, -90);
                        svg += buatTeksUkuran(
                            '3.5 cm',
                            pt(C.x, C.y + 1.75).x + 30,
                            pt(C.x, C.y + 1.75).y,
                            -90
                        );

                        svg += `</svg>`;
                        svgHTML += svg;
                    }

                    gambarPolaKerahKemeja();
                } else if (activePattern.type === 'CELANA') {
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
                } else if (activePattern.type === 'ROK') {
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
                } else if (activePattern.type === 'GAMIS') {
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
                } else if (activePattern.type === 'WANITA') {
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