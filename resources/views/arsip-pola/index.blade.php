@extends ('layouts.app')

@section ('breadcrumb-parent', 'halaman')
@section ('breadcrumb-active', 'pola busana')

@section ('content')
    <!-- Toast Notification Banner -->
    <div
        id="toast"
        class="fixed top-6 right-6 z-50 transform translate-y-[-100px] opacity-0 transition-all duration-300 pointer-events-none"
    >
        <div
            class="bg-secondary text-accent px-6 py-4 rounded-xl shadow-2xl flex items-center gap-3 border border-accent/20"
        >
            <span id="toast-icon" class="text-lg"><i class="fas fa-check-circle"></i></span>
            <p id="toast-message" class="text-sm font-medium"></p>
        </div>
    </div>

    <!-- ========================================================== -->
    <!-- 1. VIEW LIST (ARSIP DAFTAR POLA) -->
    <!-- ========================================================== -->
    <div id="view-list" class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <h1
                    class="font-serif text-3xl font-bold text-primary dark:text-white mb-1 tracking-tight"
                >
                    Pola Busana
                </h1>
                <p class="text-xs text-grey dark:text-slate-400 font-medium">Kelola, lihat kembali, cetak, atau unduh pola-pola potongan busana yang telah dihasilkan sebelumnya.</p>
            </div>

            <a
                href="/hasilkan-pola"
                class="flex items-center justify-center gap-2 bg-primary hover:bg-secondary text-accent font-semibold text-xs px-5 py-3 rounded-xl shadow-lg shadow-primary/15 transition duration-200 group active:scale-95"
            >
                <i class="fas fa-wand-magic-sparkles text-[10px]"></i>
                <span>Hasilkan Pola Baru</span>
            </a>
        </div>

        <!-- Main Table Container -->
        <div
            class="bg-white dark:bg-slate-900 rounded-3xl border border-[#EFECE6] dark:border-slate-800 shadow-[0_8px_30px_rgb(0,0,0,0.02)] overflow-hidden"
        >
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="bg-white dark:bg-slate-800/30 border-b border-[#EFECE6]/80 dark:border-slate-800/80 text-[10px] font-bold tracking-wider text-gray-400 dark:text-slate-400 uppercase"
                        >
                            <th class="px-8 py-5">NAMA POLA</th>
                            <th class="px-8 py-5">JENIS BUSANA</th>
                            <th class="px-8 py-5">PELANGGAN</th>
                            <th class="px-8 py-5">TANGGAL DIBUAT</th>
                            <th class="px-8 py-5">STATUS</th>
                            <th class="px-8 py-5 text-right">AKSI</th>
                        </tr>
                    </thead>
                    <tbody
                        id="patterns-table-body"
                        class="divide-y divide-[#EFECE6]/50 text-xs font-medium text-gray-600 dark:divide-slate-800/50"
                    >
                        <!-- Rows loaded via JS -->
                    </tbody>
                </table>
            </div>

            <!-- Empty State -->
            <div id="empty-state" class="hidden py-16 px-6 text-center">
                <div
                    class="w-16 h-16 rounded-full bg-slate-50 dark:bg-slate-800 flex items-center justify-center mx-auto mb-4 text-gray-400"
                >
                    <i class="fas fa-search text-xl"></i>
                </div>
                <h4 class="text-sm font-semibold text-slate-800 dark:text-white mb-1">
                    Pola Tidak Ditemukan
                </h4>
                <p class="text-xs text-gray-500 dark:text-slate-400 max-w-xs mx-auto">Tidak ada arsip pola yang cocok dengan kriteria pencarian Anda.</p>
            </div>

            <!-- Footer -->
            <div
                class="px-8 py-5 border-t dark:bg-slate-900 border-[#EFECE6]/80 dark:border-slate-800/80 flex flex-col md:flex-row items-center justify-between gap-4 bg-white/50"
            >
                <span class="text-[11px] text-gray-400 font-medium" id="pagination-info">
                    Menampilkan 1-3 dari 3 pola tersimpan
                </span>

                <div class="flex items-center gap-1.5">
                    <button
                        class="w-7 h-7 flex items-center justify-center rounded-md border border-gray-100 dark:border-slate-800 bg-white dark:bg-slate-800 text-gray-400 hover:bg-gray-50 dark:hover:bg-slate-700 hover:border-gray-200 transition shadow-sm"
                    >
                        <i class="fas fa-chevron-left text-[9px]"></i>
                    </button>
                    <button
                        class="w-7 h-7 flex items-center justify-center rounded-md bg-primary text-white text-xs font-bold shadow-sm"
                    >
                        1
                    </button>
                    <button
                        class="w-7 h-7 flex items-center justify-center rounded-md border border-gray-100 dark:border-slate-800 bg-white dark:bg-slate-800 text-gray-400 hover:bg-gray-50 dark:hover:bg-slate-700 hover:border-gray-200 transition shadow-sm"
                    >
                        <i class="fas fa-chevron-right text-[9px]"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================================== -->
    <!-- 2. VIEW DETAIL (DETAIL TAMPILAN POLA) -->
    <!-- ========================================================== -->
    <div id="view-detail" class="hidden space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
            <div>
                <h1
                    class="font-serif text-3xl font-bold text-primary dark:text-white mb-1 tracking-tight"
                    id="detail-title"
                >
                    Detail Pola Baju
                </h1>
                <p class="text-xs text-grey dark:text-slate-400 font-medium" id="detail-subtitle">Tampilan pola potongan teknis dan rincian ukuran pelanggan.</p>
            </div>

            <a
                href="#list"
                class="inline-flex items-center gap-2 px-5 py-2.5 border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-900 rounded-xl text-xs font-bold text-slate-700 dark:text-slate-300 hover:bg-gray-50 dark:hover:bg-slate-800 transition shadow-sm"
            >
                <i class="fas fa-arrow-left"></i> Kembali ke Arsip
            </a>
        </div>

        <!-- 2 Column Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            <!-- Left Side: Blueprint (2 Columns wide) -->
            <div
                class="lg:col-span-2 bg-white dark:bg-slate-900 border border-[#EFECE6] dark:border-slate-800 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)]"
            >
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2">
                        <span
                            class="w-8 h-8 rounded-lg bg-gray-50 dark:bg-slate-800 flex items-center justify-center text-primary dark:text-accent font-bold font-serif text-sm"
                            >A</span
                        >
                        <div>
                            <h3
                                class="text-sm font-bold tracking-tight text-slate-800 dark:text-white"
                            >
                                Pola Gambar Vektor
                            </h3>
                            <p class="text-[10px] text-gray-400">Berkas SVG Interaktif</p>
                        </div>
                    </div>

                    <!-- SVG Controls -->
                    <div class="flex items-center gap-1.5">
                        <button
                            type="button"
                            onclick="zoomIn()"
                            class="w-8 h-8 rounded-lg bg-gray-50 dark:bg-slate-800 border border-gray-100 dark:border-slate-700 flex items-center justify-center text-gray-400 hover:text-primary transition"
                            title="Perbesar"
                        >
                            <i class="fas fa-search-plus text-xs"></i>
                        </button>
                        <button
                            type="button"
                            onclick="zoomOut()"
                            class="w-8 h-8 rounded-lg bg-gray-50 dark:bg-slate-800 border border-gray-100 dark:border-slate-700 flex items-center justify-center text-gray-400 hover:text-primary transition"
                            title="Perkecil"
                        >
                            <i class="fas fa-search-minus text-xs"></i>
                        </button>
                        <button
                            type="button"
                            onclick="printPattern()"
                            class="w-8 h-8 rounded-lg bg-gray-50 dark:bg-slate-800 border border-gray-100 dark:border-slate-700 flex items-center justify-center text-gray-400 hover:text-primary transition"
                            title="Cetak Pola"
                        >
                            <i class="fas fa-print text-xs"></i>
                        </button>
                        <button
                            type="button"
                            onclick="downloadSVG()"
                            class="w-8 h-8 rounded-lg bg-gray-50 dark:bg-slate-800 border border-gray-100 dark:border-slate-700 flex items-center justify-center text-gray-400 hover:text-primary transition"
                            title="Unduh SVG"
                        >
                            <i class="fas fa-download text-xs"></i>
                        </button>
                    </div>
                </div>

                <div
                    class="blueprint-canvas-container relative w-full h-auto min-h-[430px] rounded-2xl overflow-y-auto border border-[#EFECE6] dark:border-slate-800 flex flex-col items-start justify-center bg-[#FCFCFC] dark:bg-slate-950"
                >
                    <div class="absolute inset-0 blueprint-grid opacity-70"></div>
                    <div
                        id="svg-wrapper"
                        class="relative z-10 w-full min-h-full flex flex-row flex-wrap justify-center items-start gap-12 py-10 transition-transform duration-200"
                        style="transform: scale(1)"
                    >
                        <!-- Loaded dynamically -->
                    </div>
                </div>
            </div>

            <!-- Right Side: Details (1 Column wide) -->
            <div class="space-y-6">
                <!-- PELANGGAN CARD -->
                <div
                    class="bg-white dark:bg-slate-900 border border-[#EFECE6] dark:border-slate-800 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)]"
                >
                    <h3
                        class="text-xs font-bold tracking-tight text-slate-800 dark:text-white mb-4 uppercase"
                    >
                        Pelanggan
                    </h3>

                    <div
                        class="flex items-center justify-between p-3.5 bg-gray-50/50 dark:bg-slate-850 border border-gray-100 dark:border-slate-700 rounded-2xl"
                    >
                        <div class="flex items-center gap-3">
                            <div
                                id="detail-customer-avatar"
                                class="w-10 h-10 rounded-full font-bold text-sm flex items-center justify-center text-white bg-primary"
                            >
                                AS
                            </div>
                            <div>
                                <span
                                    id="detail-customer-name"
                                    class="block text-sm font-bold text-slate-800 dark:text-slate-100"
                                    >Ahmad Subagja</span
                                >
                                <span
                                    id="detail-customer-id"
                                    class="block text-[9px] text-gray-400 mt-0.5"
                                    >ID #T-2204</span
                                >
                            </div>
                        </div>
                        <div
                            class="w-6 h-6 rounded-full bg-emerald-500 text-white flex items-center justify-center"
                        >
                            <i class="fas fa-check text-xs"></i>
                        </div>
                    </div>
                </div>

                <!-- DETAILED SIZES LIST -->
                <div
                    class="bg-white dark:bg-slate-900 border border-[#EFECE6] dark:border-slate-800 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)]"
                >
                    <h3
                        class="text-xs font-bold tracking-tight text-slate-800 dark:text-white mb-4 uppercase"
                    >
                        Rincian Ukuran Pola
                    </h3>
                    <div
                        class="divide-y divide-[#EFECE6]/80 dark:divide-slate-800"
                        id="detail-sizes-list"
                    >
                        <!-- Sizes dynamically loaded -->
                    </div>
                </div>

                <!-- ESTIMASI KAIN -->
                <div
                    class="bg-white dark:bg-slate-900 border border-[#EFECE6] dark:border-slate-800 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)]"
                >
                    <h3
                        class="text-xs font-bold tracking-tight text-slate-800 dark:text-white mb-3 uppercase"
                    >
                        Estimasi Kain Terpakai
                    </h3>
                    <div
                        class="py-4 px-5 bg-gray-50 dark:bg-slate-850 border border-gray-100 dark:border-slate-800 rounded-2xl text-sm font-black text-slate-800 dark:text-white tracking-wider"
                        id="detail-fabric-estimation"
                    >
                        3 METER
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

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
            const patternsData = {!! json_encode($patterns ?? []) !!};
            let patterns = patternsData;
            let activePattern = null;
            let currentScale = 1.0;
            let searchQuery = '';

            // Icon SVG Helper
            function getClothingIcon(type) {
                switch(type) {
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
                const breadcrumbSpans = document.querySelectorAll(
                    'header.pb-6 .text-xs.text-grey span'
                );
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
                document.getElementById('detail-customer-avatar').innerText =
                    activePattern.initials;
                document.getElementById('detail-customer-avatar').className =
                    `w-10 h-10 rounded-full font-bold text-sm flex items-center justify-center ${activePattern.avatarBg}`;
                document.getElementById('detail-customer-name').innerText =
                    activePattern.customerName;
                document.getElementById('detail-customer-id').innerText =
                    activePattern.customerCode;

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
                    document.getElementById('svg-wrapper').style.transform =
                        `scale(${currentScale})`;
                }
            };

            window.zoomOut = function () {
                if (currentScale > 0.6) {
                    currentScale -= 0.15;
                    document.getElementById('svg-wrapper').style.transform =
                        `scale(${currentScale})`;
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
                let totalHeight = 0;
                let maxWidth = 0;
                let combinedInner = '';
                
                svgs.forEach(svg => {
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
                    outerHTML = outerHTML.replace('<svg ', `<svg x="0" y="${totalHeight}" `);
                    
                    combinedInner += outerHTML;
                    totalHeight += height + 50; 
                });
                
                const finalSVG = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 ${maxWidth} ${totalHeight}" width="${maxWidth}" height="${totalHeight}">
                    <rect width="100%" height="100%" fill="#ffffff"/>
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
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            patternsData.splice(patternsData.findIndex(p => p.id === id), 1);
                            showNotification(`Arsip "${pattern.name}" berhasil dihapus`, 'fa-trash-can');
                            renderPatterns();
                        } else {
                            alert('Gagal menghapus pola');
                        }
                    })
                    .catch(error => {
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

                if (activePattern.type === 'KEMEJA' || activePattern.type === 'BAJU') {
                    const selectedCustomer = activePattern.ukuran || activePattern;

                    function gambarPolaBajuKemeja() {
                        const PB = parseInt(selectedCustomer.p_baju) || 70;
                        const LB = parseInt(selectedCustomer.l_badan || selectedCustomer.l_dada) || 100;
                        const LBa = parseInt(selectedCustomer.l_punggung) ? parseInt(selectedCustomer.l_punggung) / 2 : (parseInt(selectedCustomer.l_bahu) / 2 || 24);

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

                        const garisBantu = [{ from: F, to: D }, { from: A, to: A2 }, { from: A1, to: B }, { from: C, to: C1_depan }, { from: A2, to: E }, { from: B, to: G }];
                        garisBantu.forEach((g) => { svg += `<line x1="${pt(g.from.x, g.from.y).x}" y1="${pt(g.from.x, g.from.y).y}" x2="${pt(g.to.x, g.to.y).x}" y2="${pt(g.to.x, g.to.y).y}" stroke="#6b7280" stroke-dasharray="5,5" />`; });

                        const labelTitik = [
                            { id: 'A', pt: A, offsetX: -20, offsetY: 5 }, { id: 'F', pt: F, offsetX: -20, offsetY: 5 }, { id: 'A1', pt: A1, offsetX: -25, offsetY: 5 },
                            { id: 'A2', pt: A2, offsetX: 10, offsetY: 15 }, { id: 'E', pt: E, offsetX: -5, offsetY: -15 }, { id: 'B', pt: B, offsetX: -15, offsetY: -5 },
                            { id: 'G', pt: G, offsetX: 10, offsetY: -5 }, { id: 'C', pt: C, offsetX: -20, offsetY: 5 }, { id: 'C1', pt: C1_depan, offsetX: 15, offsetY: 5 },
                            { id: 'D', pt: D, offsetX: -20, offsetY: 5 }, { id: 'D1', pt: D1_depan, offsetX: 15, offsetY: 5 },
                        ];
                        labelTitik.forEach((l) => {
                            const p = pt(l.pt.x, l.pt.y);
                            svg += `<circle cx="${p.x}" cy="${p.y}" r="4" fill="#1f2937" /><text x="${p.x + l.offsetX}" y="${p.y + l.offsetY}" font-family="sans-serif" font-size="16" font-weight="bold" fill="#111827">${l.id}</text>`;
                        });

                        svg += buatTeksUkuran('3cm', pt(F.x + 1, F.y + 1.5).x, pt(F.x + 1, F.y + 1.5).y);
                        svg += buatTeksUkuran('6cm', pt(A.x + 1, A.y + 3).x, pt(A.x + 1, A.y + 3).y);
                        svg += buatTeksUkuran('6cm', pt(A2.x + 1, E.y + 3).x, pt(A2.x + 1, E.y + 3).y);
                        svg += buatTeksUkuran('6cm', pt(B.x - 1.5, G.y + 3).x, pt(B.x - 1.5, G.y + 3).y);
                        svg += buatTeksUkuran('2cm', pt(C1_belakang.x + 1, C.y - 1).x, pt(C1_belakang.x + 1, C.y - 1).y);
                        svg += buatTeksUkuran('1cm', pt(B.x + 2, B.y + (C1_belakang.y - B.y) / 2).x, pt(B.x + 2, B.y + (C1_belakang.y - B.y) / 2).y);

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

                        const buatLabel = (huruf, x, y, geserX, geserY) => `<circle cx="${x}" cy="${y}" r="5" fill="#111827" /><text x="${x + geserX}" y="${y + geserY}" font-family="sans-serif" font-size="18" font-weight="bold" fill="#111827">${huruf}</text>`;
                        svgUtuh += buatLabel('A', A.x, A.y, -25, 5) + buatLabel('C', C.x, C.y, -25, 5) + buatLabel('B', B.x, B.y, -25, 5) + buatLabel('E', E.x, E.y, 15, 5) + buatLabel('D', D.x, D.y, 15, 5) + `</svg>`;
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

                        const garisBantu = [{ from: { x: 0, y: -2 }, to: { x: 0, y: B.y + 2 } }, { from: { x: 2, y: D1.y }, to: { x: 2, y: B.y + 2 } }, { from: { x: LK2, y: -2 }, to: { x: LK2, y: B.y + 2 } }];
                        garisBantu.forEach((g) => { svg += `<line x1="${pt(g.from.x, g.from.y).x}" y1="${pt(g.from.x, g.from.y).y}" x2="${pt(g.to.x, g.to.y).x}" y2="${pt(g.to.x, g.to.y).y}" stroke="#6b7280" stroke-dasharray="5,5" />`; });

                        const labelTitik = [
                            { id: 'D1', pt: D1, offsetX: -25, offsetY: 0 }, { id: 'A1', pt: A1, offsetX: 10, offsetY: 15 }, { id: 'C1', pt: C1, offsetX: 15, offsetY: -5 }, { id: 'B1', pt: B1, offsetX: 15, offsetY: 10 },
                            { id: 'A', pt: A, offsetX: -20, offsetY: 5 }, { id: 'D', pt: D, offsetX: 10, offsetY: -10 }, { id: 'C', pt: C, offsetX: 15, offsetY: -5 }, { id: 'B', pt: B, offsetX: 15, offsetY: 5 },
                        ];
                        labelTitik.forEach((l) => { const p = pt(l.pt.x, l.pt.y); svg += `<circle cx="${p.x}" cy="${p.y}" r="3" fill="#1f2937" /><text x="${p.x + l.offsetX}" y="${p.y + l.offsetY}" font-family="sans-serif" font-size="16" font-weight="bold" fill="#111827">${l.id}</text>`; });

                        svg += buatTeksUkuran('7 cm', pt(0, A1.y / 2).x - 20, pt(0, A1.y / 2).y, -90);
                        svg += buatTeksUkuran('2 cm', pt(1, A1.y).x, pt(1, A1.y).y + 25);
                        svg += buatTeksUkuran('4 cm', pt(C1.x, C1.y + 2).x + 25, pt(C1.x, C1.y + 2).y, -90);
                        svg += buatTeksUkuran('3.5 cm', pt(C.x, C.y + 1.75).x + 30, pt(C.x, C.y + 1.75).y, -90);

                        svg += `</svg>`;
                        svgHTML += svg;
                    }
                    
                    gambarPolaKerahKemeja();

                } else if (activePattern.type === 'CELANA') {
                    const pinggang =
                        activePattern.l_pinggang !== '-' ? activePattern.l_pinggang : 80;
                    const panjang = activePattern.p_celana !== '-' ? activePattern.p_celana : 95;

                    svgHTML = `
                <svg width="100%" height="100%" viewBox="0 0 600 450" fill="none" stroke="${strokeColor}" stroke-width="2" xmlns="http://www.w3.org/2000/svg">
                    <path d="M 230,60 L 370,60 L 380,130 L 340,410 L 295,410 L 300,180 L 290,180 L 255,410 L 210,410 L 220,130 Z" />
                    <line x1="230" y1="80" x2="370" y2="80" stroke-dasharray="3,3" />
                    <path d="M 300,80 L 300,140 L 290,150" />
                    <path d="M 230,100 L 250,130" />
                    <path d="M 370,100 L 350,130" />
                    
                    <!-- Dimension Pinggang -->
                    <line x1="230" y1="50" x2="370" y2="50" stroke="${leaderColor}" stroke-width="1.2" stroke-dasharray="3,3" />
                    <circle cx="230" cy="50" r="3.5" fill="${leaderColor}" />
                    <circle cx="370" cy="50" r="3.5" fill="${leaderColor}" />
                    <foreignObject x="272" y="35" width="56" height="30">
                        <div style="background: white; border: 1px solid #EFECE6; border-radius: 4px; padding: 2px 4px; font-size: 10px; font-weight: bold; color: #334155; text-align: center;">${pinggang} cm</div>
                    </foreignObject>

                    <!-- Dimension Panjang -->
                    <line x1="180" y1="60" x2="180" y2="410" stroke="${leaderColor}" stroke-width="1.2" stroke-dasharray="3,3" />
                    <circle cx="180" cy="60" r="3.5" fill="${leaderColor}" />
                    <circle cx="180" cy="410" r="3.5" fill="${leaderColor}" />
                    <foreignObject x="152" y="220" width="56" height="30">
                        <div style="background: white; border: 1px solid #EFECE6; border-radius: 4px; padding: 2px 4px; font-size: 10px; font-weight: bold; color: #334155; text-align: center;">${panjang} cm</div>
                    </foreignObject>
                </svg>
            `;
                } else if (activePattern.type === 'ROK') {
                    const pinggang =
                        activePattern.l_pinggang !== '-' ? activePattern.l_pinggang : 68;
                    const panjang = activePattern.p_rok !== '-' ? activePattern.p_rok : 65;

                    svgHTML = `
                <svg width="100%" height="100%" viewBox="0 0 600 450" fill="none" stroke="${strokeColor}" stroke-width="2" xmlns="http://www.w3.org/2000/svg">
                    <path d="M 250,70 L 350,70 L 390,390 L 210,390 Z" />
                    <line x1="250" y1="95" x2="350" y2="95" stroke-dasharray="3,3" />
                    <line x1="280" y1="95" x2="280" y2="120" />
                    <line x1="320" y1="95" x2="320" y2="120" />
                    
                    <!-- Dimension Pinggang -->
                    <line x1="250" y1="60" x2="350" y2="60" stroke="${leaderColor}" stroke-width="1.2" stroke-dasharray="3,3" />
                    <circle cx="250" cy="60" r="3.5" fill="${leaderColor}" />
                    <circle cx="350" cy="60" r="3.5" fill="${leaderColor}" />
                    <foreignObject x="272" y="45" width="56" height="30">
                        <div style="background: white; border: 1px solid #EFECE6; border-radius: 4px; padding: 2px 4px; font-size: 10px; font-weight: bold; color: #334155; text-align: center;">${pinggang} cm</div>
                    </foreignObject>

                    <!-- Dimension Panjang -->
                    <line x1="180" y1="70" x2="180" y2="390" stroke="${leaderColor}" stroke-width="1.2" stroke-dasharray="3,3" />
                    <circle cx="180" cy="70" r="3.5" fill="${leaderColor}" />
                    <circle cx="180" cy="390" r="3.5" fill="${leaderColor}" />
                    <foreignObject x="152" y="210" width="56" height="30">
                        <div style="background: white; border: 1px solid #EFECE6; border-radius: 4px; padding: 2px 4px; font-size: 10px; font-weight: bold; color: #334155; text-align: center;">${panjang} cm</div>
                    </foreignObject>
                </svg>
            `;
                } else if (activePattern.type === 'GAMIS') {
                    const dada = activePattern.l_dada;
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
                        <div style="background: white; border: 1px solid #EFECE6; border-radius: 4px; padding: 2px 4px; font-size: 10px; font-weight: bold; color: #334155; text-align: center;">${dada} cm</div>
                    </foreignObject>

                    <!-- Dimension Panjang -->
                    <line x1="120" y1="50" x2="120" y2="410" stroke="${leaderColor}" stroke-width="1.2" stroke-dasharray="3,3" />
                    <circle cx="120" cy="50" r="3.5" fill="${leaderColor}" />
                    <circle cx="120" cy="410" r="3.5" fill="${leaderColor}" />
                    <foreignObject x="92" y="210" width="56" height="30">
                        <div style="background: white; border: 1px solid #EFECE6; border-radius: 4px; padding: 2px 4px; font-size: 10px; font-weight: bold; color: #334155; text-align: center;">${panjang} cm</div>
                    </foreignObject>
                </svg>
            `;
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
@endsection
