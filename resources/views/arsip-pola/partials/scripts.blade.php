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
            const selectedCustomer = activePattern.ukuran || activePattern;

            wrapper.innerHTML = window.PatternRenderer.generateSVG(
                activePattern.type,
                selectedCustomer
            );
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
