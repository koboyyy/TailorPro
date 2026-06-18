@extends('layouts.app')

@section('breadcrumb-parent', 'halaman')
@section('breadcrumb-active', 'arsip pola')

@section('content')
<!-- Toast Notification Banner -->
<div id="toast" class="fixed top-6 right-6 z-50 transform translate-y-[-100px] opacity-0 transition-all duration-300 pointer-events-none">
    <div class="bg-secondary text-accent px-6 py-4 rounded-xl shadow-2xl flex items-center gap-3 border border-accent/20">
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
            <h1 class="font-serif text-3xl font-bold text-primary dark:text-white mb-1 tracking-tight">Arsip Pola Busana</h1>
            <p class="text-xs text-grey dark:text-slate-400 font-medium">Kelola, lihat kembali, cetak, atau unduh pola-pola potongan busana yang telah dihasilkan sebelumnya.</p>
        </div>
        
        <a href="/hasilan-pola" class="flex items-center justify-center gap-2 bg-primary hover:bg-secondary text-accent font-semibold text-xs px-5 py-3 rounded-xl shadow-lg shadow-primary/15 transition duration-200 group active:scale-95">
            <i class="fas fa-wand-magic-sparkles text-[10px]"></i>
            <span>Hasilkan Pola Baru</span>
        </a>
    </div>

    <!-- Main Table Container -->
    <div class="bg-white dark:bg-slate-900 rounded-3xl border border-[#EFECE6] dark:border-slate-800 shadow-[0_8px_30px_rgb(0,0,0,0.02)] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-white dark:bg-slate-800/30 border-b border-[#EFECE6]/80 dark:border-slate-800/80 text-[10px] font-bold tracking-wider text-gray-400 dark:text-slate-400 uppercase">
                        <th class="px-8 py-5">NAMA POLA</th>
                        <th class="px-8 py-5">JENIS BUSANA</th>
                        <th class="px-8 py-5">PELANGGAN</th>
                        <th class="px-8 py-5">TANGGAL DIBUAT</th>
                        <th class="px-8 py-5">STATUS</th>
                        <th class="px-8 py-5 text-right">AKSI</th>
                    </tr>
                </thead>
                <tbody id="patterns-table-body" class="divide-y divide-[#EFECE6]/50 text-xs font-medium text-gray-600 dark:divide-slate-800/50">
                    <!-- Rows loaded via JS -->
                </tbody>
            </table>
        </div>

        <!-- Empty State -->
        <div id="empty-state" class="hidden py-16 px-6 text-center">
            <div class="w-16 h-16 rounded-full bg-slate-50 dark:bg-slate-800 flex items-center justify-center mx-auto mb-4 text-gray-400">
                <i class="fas fa-search text-xl"></i>
            </div>
            <h4 class="text-sm font-semibold text-slate-800 dark:text-white mb-1">Pola Tidak Ditemukan</h4>
            <p class="text-xs text-gray-500 dark:text-slate-400 max-w-xs mx-auto">Tidak ada arsip pola yang cocok dengan kriteria pencarian Anda.</p>
        </div>

        <!-- Footer -->
        <div class="px-8 py-5 border-t dark:bg-slate-900 border-[#EFECE6]/80 dark:border-slate-800/80 flex flex-col md:flex-row items-center justify-between gap-4 bg-white/50">
            <span class="text-[11px] text-gray-400 font-medium" id="pagination-info">
                Menampilkan 1-3 dari 3 pola tersimpan
            </span>

            <div class="flex items-center gap-1.5">
                <button class="w-7 h-7 flex items-center justify-center rounded-md border border-gray-100 dark:border-slate-800 bg-white dark:bg-slate-800 text-gray-400 hover:bg-gray-50 dark:hover:bg-slate-700 hover:border-gray-200 transition shadow-sm">
                    <i class="fas fa-chevron-left text-[9px]"></i>
                </button>
                <button class="w-7 h-7 flex items-center justify-center rounded-md bg-primary text-white text-xs font-bold shadow-sm">1</button>
                <button class="w-7 h-7 flex items-center justify-center rounded-md border border-gray-100 dark:border-slate-800 bg-white dark:bg-slate-800 text-gray-400 hover:bg-gray-50 dark:hover:bg-slate-700 hover:border-gray-200 transition shadow-sm">
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
            <h1 class="font-serif text-3xl font-bold text-primary dark:text-white mb-1 tracking-tight" id="detail-title">Detail Pola Baju</h1>
            <p class="text-xs text-grey dark:text-slate-400 font-medium" id="detail-subtitle">Tampilan pola potongan teknis dan rincian ukuran pelanggan.</p>
        </div>
        
        <a href="#list" class="inline-flex items-center gap-2 px-5 py-2.5 border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-900 rounded-xl text-xs font-bold text-slate-700 dark:text-slate-300 hover:bg-gray-50 dark:hover:bg-slate-800 transition shadow-sm">
            <i class="fas fa-arrow-left"></i> Kembali ke Arsip
        </a>
    </div>

    <!-- 2 Column Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        
        <!-- Left Side: Blueprint (2 Columns wide) -->
        <div class="lg:col-span-2 bg-white dark:bg-slate-900 border border-[#EFECE6] dark:border-slate-800 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)]">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-gray-50 dark:bg-slate-800 flex items-center justify-center text-primary dark:text-accent font-bold font-serif text-sm">A</span>
                    <div>
                        <h3 class="text-sm font-bold tracking-tight text-slate-800 dark:text-white">Pola Gambar Vektor</h3>
                        <p class="text-[10px] text-gray-400">Berkas SVG Interaktif</p>
                    </div>
                </div>
                
                <!-- SVG Controls -->
                <div class="flex items-center gap-1.5">
                    <button type="button" onclick="zoomIn()" class="w-8 h-8 rounded-lg bg-gray-50 dark:bg-slate-800 border border-gray-100 dark:border-slate-700 flex items-center justify-center text-gray-400 hover:text-primary transition" title="Perbesar">
                        <i class="fas fa-search-plus text-xs"></i>
                    </button>
                    <button type="button" onclick="zoomOut()" class="w-8 h-8 rounded-lg bg-gray-50 dark:bg-slate-800 border border-gray-100 dark:border-slate-700 flex items-center justify-center text-gray-400 hover:text-primary transition" title="Perkecil">
                        <i class="fas fa-search-minus text-xs"></i>
                    </button>
                    <button type="button" onclick="printPattern()" class="w-8 h-8 rounded-lg bg-gray-50 dark:bg-slate-800 border border-gray-100 dark:border-slate-700 flex items-center justify-center text-gray-400 hover:text-primary transition" title="Cetak Pola">
                        <i class="fas fa-print text-xs"></i>
                    </button>
                    <button type="button" onclick="downloadSVG()" class="w-8 h-8 rounded-lg bg-gray-50 dark:bg-slate-800 border border-gray-100 dark:border-slate-700 flex items-center justify-center text-gray-400 hover:text-primary transition" title="Unduh SVG">
                        <i class="fas fa-download text-xs"></i>
                    </button>
                </div>
            </div>

            <!-- Blueprint Canvas -->
            <div class="blueprint-canvas-container relative w-full h-[430px] rounded-2xl overflow-hidden border border-[#EFECE6] dark:border-slate-800 flex items-center justify-center bg-[#FCFCFC] dark:bg-slate-950">
                <div class="absolute inset-0 blueprint-grid opacity-70"></div>
                <div id="svg-wrapper" class="relative z-10 w-full h-full flex items-center justify-center transition-transform duration-200" style="transform: scale(1.0)">
                    <!-- Loaded dynamically -->
                </div>
            </div>
        </div>

        <!-- Right Side: Details (1 Column wide) -->
        <div class="space-y-6">
            <!-- PELANGGAN CARD -->
            <div class="bg-white dark:bg-slate-900 border border-[#EFECE6] dark:border-slate-800 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)]">
                <h3 class="text-xs font-bold tracking-tight text-slate-800 dark:text-white mb-4 uppercase">Pelanggan</h3>
                
                <div class="flex items-center justify-between p-3.5 bg-gray-50/50 dark:bg-slate-850 border border-gray-100 dark:border-slate-700 rounded-2xl">
                    <div class="flex items-center gap-3">
                        <div id="detail-customer-avatar" class="w-10 h-10 rounded-full font-bold text-sm flex items-center justify-center text-white bg-primary">AS</div>
                        <div>
                            <span id="detail-customer-name" class="block text-sm font-bold text-slate-800 dark:text-slate-100">Ahmad Subagja</span>
                            <span id="detail-customer-id" class="block text-[9px] text-gray-400 mt-0.5">ID #T-2204</span>
                        </div>
                    </div>
                    <div class="w-6 h-6 rounded-full bg-emerald-500 text-white flex items-center justify-center">
                        <i class="fas fa-check text-xs"></i>
                    </div>
                </div>
            </div>

            <!-- DETAILED SIZES LIST -->
            <div class="bg-white dark:bg-slate-900 border border-[#EFECE6] dark:border-slate-800 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)]">
                <h3 class="text-xs font-bold tracking-tight text-slate-800 dark:text-white mb-4 uppercase">Rincian Ukuran Pola</h3>
                <div class="divide-y divide-[#EFECE6]/80 dark:divide-slate-800" id="detail-sizes-list">
                    <!-- Sizes dynamically loaded -->
                </div>
            </div>

            <!-- ESTIMASI KAIN -->
            <div class="bg-white dark:bg-slate-900 border border-[#EFECE6] dark:border-slate-800 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)]">
                <h3 class="text-xs font-bold tracking-tight text-slate-800 dark:text-white mb-3 uppercase">Estimasi Kain Terpakai</h3>
                <div class="py-4 px-5 bg-gray-50 dark:bg-slate-850 border border-gray-100 dark:border-slate-800 rounded-2xl text-sm font-black text-slate-800 dark:text-white tracking-wider" id="detail-fabric-estimation">
                    3 METER
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<style>
.blueprint-grid {
    background-color: #FCFCFC;
    background-image: linear-gradient(#F0EFEA 1px, transparent 1px), linear-gradient(90deg, #F0EFEA 1px, transparent 1px);
    background-size: 16px 16px;
    background-position: center;
}
.dark .blueprint-grid {
    background-color: #0b0f19;
    background-image: linear-gradient(#1e293b 1px, transparent 1px), linear-gradient(90deg, #1e293b 1px, transparent 1px);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // Seed initial mock patterns list if none exists in localStorage
    const initialPatterns = [
        {
            id: 1,
            name: "Pola Baju - Ahmad Subagja",
            type: "BAJU",
            customerName: "Ahmad Subagja",
            customerCode: "ID #T-2204",
            avatarBg: "bg-[#2563EB] text-white",
            initials: "AS",
            date: "18 Juni 2026",
            status: "Aktif",
            l_dada: 96,
            p_baju: 72,
            l_bahu: 44,
            p_lengan: 24,
            l_pinggang: 80,
            l_pinggul: 98,
            p_celana: 95,
            p_rok: "-"
        },
        {
            id: 2,
            name: "Pola Gamis - Siti Aminah",
            type: "GAMIS",
            customerName: "Siti Aminah",
            customerCode: "ID #T-2201",
            avatarBg: "bg-[#2D6A4F] text-white",
            initials: "S",
            date: "15 Juni 2026",
            status: "Aktif",
            l_dada: 88,
            p_baju: 70,
            l_bahu: 40,
            p_lengan: 24,
            l_pinggang: 76,
            l_pinggul: 94,
            p_celana: "-",
            p_rok: "-"
        },
        {
            id: 3,
            name: "Pola Celana - Budi Santoso",
            type: "CELANA",
            customerName: "Budi Santoso",
            customerCode: "ID #T-2202",
            avatarBg: "bg-[#8C6D58] text-white",
            initials: "B",
            date: "12 Juni 2026",
            status: "Draf",
            l_dada: 92,
            p_baju: 72,
            l_bahu: 42,
            p_lengan: 25,
            l_pinggang: 80,
            l_pinggul: 96,
            p_celana: 96,
            p_rok: "-"
        }
    ];

    if (!localStorage.getItem('saved_patterns')) {
        localStorage.setItem('saved_patterns', JSON.stringify(initialPatterns));
    }

    let patterns = JSON.parse(localStorage.getItem('saved_patterns'));
    let activePattern = null;
    let currentScale = 1.0;
    let searchQuery = "";

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
            if (activeSpan) activeSpan.innerText = 'arsip pola';
            renderPatterns();
        } else if (hash.startsWith('#detail-')) {
            document.getElementById('view-detail').classList.remove('hidden');
            if (parentSpan) parentSpan.innerText = 'arsip pola';
            if (activeSpan) activeSpan.innerText = 'detail pola';
            const id = parseInt(hash.split('-')[1]);
            loadDetailView(id);
        }
    }
    
    window.addEventListener('hashchange', handleRouting);
    
    // Search listener
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            searchQuery = e.target.value;
            renderPatterns();
        });
    }

    // Run Initial Load
    handleRouting();

    // Render Table
    function renderPatterns() {
        patterns = JSON.parse(localStorage.getItem('saved_patterns')) || [];
        let filtered = patterns;

        if (searchQuery.trim() !== "") {
            const query = searchQuery.toLowerCase();
            filtered = filtered.filter(p => 
                p.name.toLowerCase().includes(query) || 
                p.customerName.toLowerCase().includes(query)
            );
        }

        document.getElementById('pagination-info').innerText = `Menampilkan 1-${filtered.length} dari ${patterns.length} pola tersimpan`;

        if (filtered.length === 0) {
            tableBody.innerHTML = '';
            emptyState.classList.remove('hidden');
            return;
        }

        emptyState.classList.add('hidden');
        tableBody.innerHTML = filtered.map(p => {
            const statusClass = p.status === 'Aktif' 
                ? 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950/30 dark:text-emerald-400' 
                : 'bg-gray-100 text-gray-500 dark:bg-slate-800 dark:text-slate-400';
            
            // Format Jenis Busana Readable
            const typeLabelMap = {
                'BAJU': 'Baju',
                'CELANA': 'Celana',
                'ROK': 'Rok',
                'GAMIS': 'Gamis'
            };
            const typeLabel = typeLabelMap[p.type] || p.type;

            return `
                <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/40 transition duration-150">
                    <!-- Pattern Name & Icon -->
                    <td class="px-8 py-5">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg bg-gray-50 dark:bg-slate-800 flex items-center justify-center text-primary dark:text-accent font-bold font-serif text-sm">${p.type.charAt(0)}</span>
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
        }).join('');
    }

    // Load Detail view
    function loadDetailView(id) {
        patterns = JSON.parse(localStorage.getItem('saved_patterns')) || [];
        activePattern = patterns.find(p => p.id === id);
        if (!activePattern) {
            window.location.hash = '#list';
            return;
        }

        // Title info
        document.getElementById('detail-title').innerText = activePattern.name;
        
        // Customer Card info
        document.getElementById('detail-customer-avatar').innerText = activePattern.initials;
        document.getElementById('detail-customer-avatar').className = `w-10 h-10 rounded-full font-bold text-sm flex items-center justify-center ${activePattern.avatarBg}`;
        document.getElementById('detail-customer-name').innerText = activePattern.customerName;
        document.getElementById('detail-customer-id').innerText = activePattern.customerCode;

        // Metric list
        const metrics = [
            { label: "Lingkar Dada", val: activePattern.l_dada },
            { label: "Panjang Baju", val: activePattern.p_baju },
            { label: "Lebar Bahu", val: activePattern.l_bahu },
            { label: "Panjang Lengan", val: activePattern.p_lengan },
            { label: "Lingkar Pinggang", val: activePattern.l_pinggang },
            { label: "Lingkar Pinggul", val: activePattern.l_pinggul },
            { label: "Panjang Celana", val: activePattern.p_celana },
            { label: "Panjang Rok", val: activePattern.p_rok }
        ];

        document.getElementById('detail-sizes-list').innerHTML = metrics.map(m => `
            <div class="flex justify-between py-2.5 text-xs font-semibold text-slate-700 dark:text-slate-300">
                <span class="text-gray-400">${m.label}</span>
                <span class="font-bold text-slate-800 dark:text-white">${m.val} ${m.val !== "-" ? "cm" : ""}</span>
            </div>
        `).join('');

        // Estimates
        const fabricEstimates = {
            "BAJU": "3 METER",
            "CELANA": "2.5 METER",
            "ROK": "2 METER",
            "GAMIS": "4 METER"
        };
        document.getElementById('detail-fabric-estimation').innerText = fabricEstimates[activePattern.type] || "3 METER";

        // Render SVG Pattern
        renderSVGDetail();
    }

    // Zooming
    window.zoomIn = function() {
        if (currentScale < 1.6) {
            currentScale += 0.15;
            document.getElementById('svg-wrapper').style.transform = `scale(${currentScale})`;
        }
    };

    window.zoomOut = function() {
        if (currentScale > 0.6) {
            currentScale -= 0.15;
            document.getElementById('svg-wrapper').style.transform = `scale(${currentScale})`;
        }
    };

    // Print SVG
    window.printPattern = function() {
        if (!activePattern) return;
        const printWindow = window.open('', '_blank');
        const svgContent = document.getElementById('svg-wrapper').innerHTML;
        printWindow.document.write(`
            <html>
                <head>
                    <title>Cetak Pola - ${activePattern.customerName}</title>
                    <style>
                        body { display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; font-family: sans-serif; }
                        svg { width: 100%; height: 90vh; }
                        .print-header { position: absolute; top: 20px; left: 20px; font-size: 14px; color: #4A3A2A; }
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
    window.downloadSVG = function() {
        if (!activePattern) return;
        const svgContent = document.getElementById('svg-wrapper').innerHTML.trim();
        const blob = new Blob([svgContent], { type: 'image/svg+xml;charset=utf-8' });
        const url = URL.createObjectURL(blob);
        const link = document.createElement('a');
        link.href = url;
        link.download = `pola_${activePattern.type.toLowerCase()}_${activePattern.customerName.toLowerCase().replace(/\s+/g, '_')}.svg`;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        URL.revokeObjectURL(url);
        showNotification("Berkas pola SVG berhasil diunduh!");
    };

    // External Download trigger
    window.downloadSVGEffect = function(id) {
        patterns = JSON.parse(localStorage.getItem('saved_patterns')) || [];
        const pattern = patterns.find(p => p.id === id);
        if (!pattern) return;
        
        // Render temporarily to get SVG content
        activePattern = pattern;
        loadDetailView(id);
        downloadSVG();
        
        // Revert back
        window.location.hash = "#list";
    };

    // Delete saved pattern
    window.deletePattern = function(id) {
        patterns = JSON.parse(localStorage.getItem('saved_patterns')) || [];
        const pattern = patterns.find(p => p.id === id);
        if (!pattern) return;

        if (confirm(`Apakah Anda yakin ingin menghapus arsip pola "${pattern.name}"?`)) {
            const updated = patterns.filter(p => p.id !== id);
            localStorage.setItem('saved_patterns', JSON.stringify(updated));
            showNotification(`Arsip "${pattern.name}" berhasil dihapus`, "fa-trash-can");
            renderPatterns();
        }
    };

    // RENDER DETAIL SVG BLUEPRINTS
    function renderSVGDetail() {
        if (!activePattern) return;
        const wrapper = document.getElementById('svg-wrapper');
        const strokeColor = document.documentElement.classList.contains('dark') ? '#60a5fa' : '#4A3A2A';
        const leaderColor = "#8C7A6B";
        
        let svgHTML = "";

        if (activePattern.type === "BAJU") {
            const bahu = activePattern.l_bahu;
            const dada = activePattern.l_dada;
            const lengan = activePattern.p_lengan;

            svgHTML = `
                <svg width="100%" height="100%" viewBox="0 0 600 450" fill="none" stroke="${strokeColor}" stroke-width="2" xmlns="http://www.w3.org/2000/svg">
                    <path d="M 220,90 L 380,90 L 360,120 L 480,170 L 430,240 L 370,210 L 370,410 L 230,410 L 230,210 L 170,240 L 120,170 L 240,120 Z" />
                    <line x1="170" y1="240" x2="240" y2="120" stroke-dasharray="3,3" />
                    <line x1="430" y1="240" x2="360" y2="120" stroke-dasharray="3,3" />
                    <path d="M 260,120 L 300,150 L 340,120" />
                    <path d="M 260,120 L 300,90 L 340,120" />
                    <line x1="300" y1="150" x2="300" y2="410" stroke-dasharray="3,3" />
                    <rect x="310" y="180" width="45" height="50" rx="3" />
                    
                    <!-- Dimension Bahu -->
                    <line x1="240" y1="100" x2="360" y2="100" stroke="${leaderColor}" stroke-width="1.2" stroke-dasharray="3,3" />
                    <circle cx="240" cy="100" r="3.5" fill="${leaderColor}" />
                    <circle cx="360" cy="100" r="3.5" fill="${leaderColor}" />
                    <foreignObject x="272" y="85" width="56" height="30">
                        <div style="background: white; border: 1px solid #EFECE6; border-radius: 4px; padding: 2px 4px; font-size: 10px; font-weight: bold; color: #334155; text-align: center;">${bahu} cm</div>
                    </foreignObject>

                    <!-- Dimension Dada -->
                    <line x1="230" y1="280" x2="370" y2="280" stroke="${leaderColor}" stroke-width="1.2" stroke-dasharray="3,3" />
                    <circle cx="230" cy="280" r="3.5" fill="${leaderColor}" />
                    <circle cx="370" cy="280" r="3.5" fill="${leaderColor}" />
                    <foreignObject x="272" y="265" width="56" height="30">
                        <div style="background: white; border: 1px solid #EFECE6; border-radius: 4px; padding: 2px 4px; font-size: 10px; font-weight: bold; color: #334155; text-align: center;">${dada} cm</div>
                    </foreignObject>

                    <!-- Dimension Lengan -->
                    <line x1="120" y1="170" x2="170" y2="240" stroke="${leaderColor}" stroke-width="1.2" stroke-dasharray="3,3" />
                    <circle cx="120" cy="170" r="3.5" fill="${leaderColor}" />
                    <circle cx="170" cy="240" r="3.5" fill="${leaderColor}" />
                    <foreignObject x="110" y="215" width="56" height="30">
                        <div style="background: white; border: 1px solid #EFECE6; border-radius: 4px; padding: 2px 4px; font-size: 10px; font-weight: bold; color: #334155; text-align: center;">${lengan} cm</div>
                    </foreignObject>
                </svg>
            `;
        } else if (activePattern.type === "CELANA") {
            const pinggang = activePattern.l_pinggang !== "-" ? activePattern.l_pinggang : 80;
            const panjang = activePattern.p_celana !== "-" ? activePattern.p_celana : 95;

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
        } else if (activePattern.type === "ROK") {
            const pinggang = activePattern.l_pinggang !== "-" ? activePattern.l_pinggang : 68;
            const panjang = activePattern.p_rok !== "-" ? activePattern.p_rok : 65;

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
        } else if (activePattern.type === "GAMIS") {
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
    function showNotification(message, iconClass = "fa-check-circle") {
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
