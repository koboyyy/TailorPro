@extends('layouts.app')

@section('breadcrumb-parent', 'halaman')
@section('breadcrumb-active', 'hasilan pola')

@section('content')
<!-- Toast Notification Banner -->
<div id="toast" class="fixed top-6 right-6 z-50 transform translate-y-[-100px] opacity-0 transition-all duration-300 pointer-events-none">
    <div class="bg-secondary text-accent px-6 py-4 rounded-xl shadow-2xl flex items-center gap-3 border border-accent/20">
        <span id="toast-icon" class="text-lg"><i class="fas fa-check-circle"></i></span>
        <p id="toast-message" class="text-sm font-medium"></p>
    </div>
</div>

<!-- Header -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
    <div>
        <h1 class="font-serif text-3xl font-bold text-primary dark:text-white mb-1 tracking-tight">Hasilkan Pola Busana</h1>
        <p class="text-xs text-grey dark:text-slate-400 font-medium">Hasilkan rancangan pola potongan busana secara otomatis berdasarkan ukuran pelanggan.</p>
    </div>
    
    <div class="flex items-center gap-3">
        <button type="button" id="btn-save-draft" class="px-5 py-3 border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-900 rounded-xl text-xs font-bold text-slate-700 dark:text-slate-300 hover:bg-gray-50 dark:hover:bg-slate-800 transition shadow-sm active:scale-95">
            Simpan Draf
        </button>
        <button type="button" id="btn-generate" class="flex items-center justify-center gap-2 bg-primary hover:bg-secondary text-accent font-semibold text-xs px-5 py-3 rounded-xl shadow-lg shadow-primary/15 transition duration-200 active:scale-95">
            <i class="fas fa-wand-magic-sparkles text-[10px]"></i>
            <span>Hasilkan Pola</span>
        </button>
    </div>
</div>

<!-- Main Designer Grid -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start mb-8">
    <!-- PILIH JENIS BUSANA (2/3 width) -->
    <div class="lg:col-span-2 bg-white dark:bg-slate-900 border border-[#EFECE6] dark:border-slate-800 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)] h-full min-h-[260px]">
        <h3 class="text-xs font-bold tracking-tight text-slate-800 dark:text-white mb-4 uppercase">Pilih Jenis Busana</h3>
        
        <div class="grid grid-cols-2 gap-4">
            <!-- Baju Button -->
            <button type="button" data-type="BAJU" class="garment-type-card border border-primary bg-primary/5 p-5 rounded-2xl flex flex-col items-center justify-center gap-3 transition hover:bg-primary/5 active:scale-95">
                <i class="fa-solid fa-shirt text-xl text-primary dark:text-accent"></i>
                <span class="text-xs font-bold text-primary dark:text-accent">Baju</span>
            </button>

            <!-- Celana Button -->
            <button type="button" data-type="CELANA" class="garment-type-card border border-[#EFECE6] dark:border-slate-800 p-5 rounded-2xl flex flex-col items-center justify-center gap-3 transition hover:bg-gray-50 dark:hover:bg-slate-800 active:scale-95">
                <i class="fa-solid fa-socks text-xl text-gray-400"></i>
                <span class="text-xs font-bold text-gray-500 dark:text-slate-400">Celana</span>
            </button>

            <!-- Rok Button -->
            <button type="button" data-type="ROK" class="garment-type-card border border-[#EFECE6] dark:border-slate-800 p-5 rounded-2xl flex flex-col items-center justify-center gap-3 transition hover:bg-gray-50 dark:hover:bg-slate-800 active:scale-95">
                <i class="fa-solid fa-person-dress text-xl text-gray-400"></i>
                <span class="text-xs font-bold text-gray-500 dark:text-slate-400">Rok</span>
            </button>

            <!-- Gamis Button -->
            <button type="button" data-type="GAMIS" class="garment-type-card border border-[#EFECE6] dark:border-slate-800 p-5 rounded-2xl flex flex-col items-center justify-center gap-3 transition hover:bg-gray-50 dark:hover:bg-slate-800 active:scale-95">
                <i class="fa-solid fa-user-group text-xl text-gray-400"></i>
                <span class="text-xs font-bold text-gray-500 dark:text-slate-400">Gamis</span>
            </button>
        </div>
    </div>

    <!-- PILIH PELANGGAN (1/3 width) -->
    <div class="bg-white dark:bg-slate-900 border border-[#EFECE6] dark:border-slate-800 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)] h-full min-h-[260px] flex flex-col">
        <h3 class="text-xs font-bold tracking-tight text-slate-800 dark:text-white mb-4 uppercase">Pilih Pelanggan</h3>
        
        <div class="space-y-4 flex-1 flex flex-col justify-between">
            <!-- Search Container -->
            <div class="relative" id="customer-search-container">
                <span class="absolute inset-y-0 left-4 flex items-center text-gray-400 pointer-events-none text-xs">
                    <i class="fas fa-search"></i>
                </span>
                <input type="text" id="customer-search-input" placeholder="Cari nama atau ID..." class="w-full pl-10 pr-4 py-3 bg-background dark:bg-slate-800 border border-[#EFECE6]/80 dark:border-slate-700/80 rounded-2xl text-xs text-secondary dark:text-white focus:outline-none focus:border-primary transition">
                
                <!-- Dropdown Search Results -->
                <div id="customer-search-results" class="hidden absolute left-0 right-0 mt-2 bg-white dark:bg-slate-850 border border-gray-100 dark:border-slate-700 rounded-2xl shadow-xl py-1.5 max-h-40 overflow-y-auto z-40">
                    <!-- Populated by JS -->
                </div>
            </div>

            <!-- Selected Customer Profile Card -->
            <div id="selected-customer-card" class="flex items-center justify-between p-3.5 bg-gray-50/50 dark:bg-slate-850 border border-gray-100 dark:border-slate-700 rounded-2xl">
                <div class="flex items-center gap-3">
                    <div id="selected-customer-avatar" class="w-10 h-10 rounded-full font-bold text-sm flex items-center justify-center text-white bg-primary">AS</div>
                    <div>
                        <span id="selected-customer-name" class="block text-sm font-bold text-slate-800 dark:text-slate-100">Ahmad Subagja</span>
                        <span id="selected-customer-id" class="block text-[9px] text-gray-400 mt-0.5">ID #T-2204</span>
                    </div>
                </div>
                <div class="w-6 h-6 rounded-full bg-primary text-white flex items-center justify-center">
                    <i class="fas fa-check text-xs"></i>
                </div>
            </div>

            <!-- Detail Ukuran Mini Summary -->
            <div class="pt-3 border-t border-[#EFECE6]/80 dark:border-slate-800/80 mt-auto">
                <div class="flex justify-between items-center mb-3">
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Detail Ukuran</span>
                    <button type="button" onclick="showFullSizesModal()" class="text-[9px] font-extrabold text-primary hover:text-secondary uppercase tracking-wider">Lihat Selengkapnya</button>
                </div>
                <div class="grid grid-cols-2 gap-x-4 gap-y-2 text-[11px] font-medium text-slate-700 dark:text-slate-300">
                    <div class="flex justify-between">
                        <span class="text-gray-400">Lingkar Dada</span>
                        <span class="font-bold text-slate-800 dark:text-slate-200" id="mini-val-dada">96 cm</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Panjang Baju</span>
                        <span class="font-bold text-slate-800 dark:text-slate-200" id="mini-val-panjang">72 cm</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Lebar Bahu</span>
                        <span class="font-bold text-slate-800 dark:text-slate-200" id="mini-val-bahu">44 cm</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">P. Lengan</span>
                        <span class="font-bold text-slate-800 dark:text-slate-200" id="mini-val-lengan">24 cm</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- PREVIEW POLA TEKNIS (Full Width) -->
<div class="bg-white dark:bg-slate-900 border border-[#EFECE6] dark:border-slate-800 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)] mb-8">
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center gap-2">
            <span class="w-8 h-8 rounded-lg bg-gray-50 dark:bg-slate-800 flex items-center justify-center text-primary dark:text-accent font-bold font-serif text-sm">A</span>
            <div>
                <h3 class="text-sm font-bold tracking-tight text-slate-800 dark:text-white">Preview Pola Teknis</h3>
                <p class="text-[10px] text-gray-400">Draf Otomatis</p>
            </div>
        </div>
        
        <!-- Action Buttons -->
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
    <div class="blueprint-canvas-container relative w-full h-[450px] rounded-2xl overflow-hidden border border-[#EFECE6] dark:border-slate-800 flex items-center justify-center bg-[#FCFCFC] dark:bg-slate-950">
        <!-- Grid overlay -->
        <div class="absolute inset-0 blueprint-grid opacity-70"></div>
        
        <!-- Scalable Canvas Wrapper -->
        <div id="svg-wrapper" class="relative z-10 w-full h-full flex items-center justify-center transition-transform duration-200" style="transform: scale(1.0)">
            <!-- Rendered via JS -->
        </div>
    </div>

    <!-- Format Indicator -->
    <div class="flex items-center justify-between mt-3 text-[10px] font-medium text-gray-400">
        <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-blue-500"></span> FORMAT: SVG</span>
        <span class="italic">Klik 'Hasilkan' untuk memperbarui pola berdasarkan ukuran terbaru.</span>
    </div>
</div>

<!-- ESTIMASI KAIN -->
<div class="bg-white dark:bg-slate-900 border border-[#EFECE6] dark:border-slate-800 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)]">
    <h3 class="text-xs font-bold tracking-tight text-slate-800 dark:text-white mb-3 uppercase">Estimasi Kain Yang Terpakai</h3>
    <div class="py-4 px-5 bg-gray-50 dark:bg-slate-850 border border-gray-100 dark:border-slate-800 rounded-2xl text-sm font-black text-slate-800 dark:text-white tracking-wider" id="fabric-estimation">
        3 METER
    </div>
</div>

<!-- Modals Detail Ukuran Lengkap -->
<div id="sizes-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm hidden transition-all duration-300">
    <div class="bg-white dark:bg-slate-900 border border-[#EFECE6] dark:border-slate-800 w-full max-w-md rounded-3xl shadow-2xl overflow-hidden transform scale-95 opacity-0 transition-all duration-300" id="sizes-modal-container">
        <div class="px-6 py-5 border-b border-[#EFECE6]/80 dark:border-slate-800/80 flex justify-between items-center">
            <h3 class="font-serif text-lg font-bold text-primary dark:text-white">Profil Ukuran Lengkap</h3>
            <button type="button" class="text-gray-400 hover:text-gray-600 dark:hover:text-white transition" onclick="closeSizesModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="p-6 space-y-4 max-h-[350px] overflow-y-auto" id="sizes-modal-content">
            <!-- Rendered by JS -->
        </div>
        <div class="px-6 py-4 border-t border-[#EFECE6]/80 dark:border-slate-800/80 flex justify-end bg-gray-50/50 dark:bg-slate-850">
            <button type="button" class="px-5 py-2.5 bg-primary text-accent text-xs font-bold rounded-xl shadow transition active:scale-95" onclick="closeSizesModal()">Tutup</button>
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
    
    // Seed mockup data customers
    const customers = [
        {
            id: 1,
            name: "Ahmad Subagja",
            code: "ID #T-2204",
            avatarBg: "bg-[#2563EB] text-white",
            initials: "AS",
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
            name: "Siti Aminah",
            code: "ID #T-2201",
            avatarBg: "bg-[#2D6A4F] text-white",
            initials: "S",
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
            name: "Budi Santoso",
            code: "ID #T-2202",
            avatarBg: "bg-[#8C6D58] text-white",
            initials: "B",
            l_dada: 92,
            p_baju: 72,
            l_bahu: 42,
            p_lengan: 25,
            l_pinggang: 80,
            l_pinggul: 96,
            p_celana: 96,
            p_rok: "-"
        },
        {
            id: 4,
            name: "Dewi Sartika",
            code: "ID #T-2203",
            avatarBg: "bg-[#2F3E46] text-white",
            initials: "D",
            l_dada: 84,
            p_baju: 65,
            l_bahu: 38,
            p_lengan: 23,
            l_pinggang: 68,
            l_pinggul: 90,
            p_celana: "-",
            p_rok: 65
        }
    ];

    let activeType = "BAJU";
    let selectedCustomer = customers[0]; // Default: Ahmad Subagja
    let currentScale = 1.0;

    // DOM Elements
    const customerSearchInput = document.getElementById('customer-search-input');
    const customerSearchResults = document.getElementById('customer-search-results');
    const selectedCustomerCard = document.getElementById('selected-customer-card');
    
    // Init display values
    updateSelectedCustomerCard();
    renderSVG();

    // Event listener garment cards
    document.querySelectorAll('.garment-type-card').forEach(card => {
        card.addEventListener('click', function() {
            document.querySelectorAll('.garment-type-card').forEach(c => {
                c.classList.remove('border-primary', 'bg-primary/5');
                c.classList.add('border-[#EFECE6]', 'dark:border-slate-800');
                // restore icon/text gray colors
                const icon = c.querySelector('i');
                const text = c.querySelector('span');
                if (icon) icon.className = icon.className.replace('text-primary dark:text-accent', 'text-gray-400');
                if (text) {
                    text.classList.remove('text-primary', 'dark:text-accent');
                    text.classList.add('text-gray-500', 'dark:text-slate-400');
                }
            });

            this.classList.remove('border-[#EFECE6]', 'dark:border-slate-800');
            this.classList.add('border-primary', 'bg-primary/5');
            const activeIcon = this.querySelector('i');
            const activeText = this.querySelector('span');
            if (activeIcon) activeIcon.className = activeIcon.className.replace('text-gray-400', 'text-primary dark:text-accent');
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
        customerSearchInput.addEventListener('input', function() {
            const query = this.value.trim().toLowerCase();
            if (query === "") {
                customerSearchResults.classList.add('hidden');
                return;
            }

            const matched = customers.filter(c => c.name.toLowerCase().includes(query) || c.code.toLowerCase().includes(query));
            if (matched.length === 0) {
                customerSearchResults.innerHTML = `<div class="px-4 py-2 text-xs text-gray-400">Tidak ada pelanggan ditemukan</div>`;
            } else {
                customerSearchResults.innerHTML = matched.map(c => `
                    <button type="button" class="w-full text-left px-4 py-2 text-xs text-slate-800 dark:text-slate-200 hover:bg-gray-50 dark:hover:bg-slate-700 flex items-center gap-2" onclick="selectCustomer(${c.id})">
                        <span class="w-5 h-5 rounded-full ${c.avatarBg} font-bold text-[9px] flex items-center justify-center">${c.initials}</span>
                        <span>${c.name} (${c.code})</span>
                    </button>
                `).join('');
            }
            customerSearchResults.classList.remove('hidden');
        });
    }

    window.selectCustomer = function(id) {
        selectedCustomer = customers.find(c => c.id === id);
        updateSelectedCustomerCard();
        renderSVG();
        if (customerSearchResults) customerSearchResults.classList.add('hidden');
        if (customerSearchInput) customerSearchInput.value = "";
    };

    function updateSelectedCustomerCard() {
        if (!selectedCustomer) return;
        document.getElementById('selected-customer-avatar').innerText = selectedCustomer.initials;
        document.getElementById('selected-customer-avatar').className = `w-10 h-10 rounded-full font-bold text-sm flex items-center justify-center ${selectedCustomer.avatarBg}`;
        document.getElementById('selected-customer-name').innerText = selectedCustomer.name;
        document.getElementById('selected-customer-id').innerText = selectedCustomer.code;

        // update summary panel
        document.getElementById('mini-val-dada').innerText = `${selectedCustomer.l_dada} cm`;
        document.getElementById('mini-val-panjang').innerText = `${selectedCustomer.p_baju} cm`;
        document.getElementById('mini-val-bahu').innerText = `${selectedCustomer.l_bahu} cm`;
        document.getElementById('mini-val-lengan').innerText = `${selectedCustomer.p_lengan} cm`;
    }

    // Toggle Modal Full Sizes
    window.showFullSizesModal = function() {
        const modal = document.getElementById('sizes-modal');
        const container = document.getElementById('sizes-modal-container');
        const content = document.getElementById('sizes-modal-content');

        const metrics = [
            { label: "Lingkar Dada", val: selectedCustomer.l_dada },
            { label: "Panjang Baju", val: selectedCustomer.p_baju },
            { label: "Lebar Bahu", val: selectedCustomer.l_bahu },
            { label: "Panjang Lengan", val: selectedCustomer.p_lengan },
            { label: "Lingkar Pinggang", val: selectedCustomer.l_pinggang },
            { label: "Lingkar Pinggul", val: selectedCustomer.l_pinggul },
            { label: "Panjang Celana", val: selectedCustomer.p_celana },
            { label: "Panjang Rok", val: selectedCustomer.p_rok }
        ];

        content.innerHTML = `
            <div class="divide-y divide-[#EFECE6]/80 dark:divide-slate-800">
                ${metrics.map(m => `
                    <div class="flex justify-between py-2.5 text-xs font-semibold text-slate-700 dark:text-slate-300">
                        <span class="text-gray-400">${m.label}</span>
                        <span class="font-bold text-slate-800 dark:text-white">${m.val} ${m.val !== "-" ? "cm" : ""}</span>
                    </div>
                `).join('')}
            </div>
        `;

        modal.classList.remove('hidden');
        setTimeout(() => {
            container.classList.remove('scale-95', 'opacity-0');
            container.classList.add('scale-100', 'opacity-100');
        }, 50);
    };

    window.closeSizesModal = function() {
        const modal = document.getElementById('sizes-modal');
        const container = document.getElementById('sizes-modal-container');
        container.classList.remove('scale-100', 'opacity-100');
        container.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    };

    // Close on outer click
    document.addEventListener('click', function(e) {
        if (customerSearchResults && !e.target.closest('#customer-search-container')) {
            customerSearchResults.classList.add('hidden');
        }
    });

    // Update estimates
    function updateEstimates() {
        const estimates = {
            "BAJU": "3 METER",
            "CELANA": "2.5 METER",
            "ROK": "2 METER",
            "GAMIS": "4 METER"
        };
        document.getElementById('fabric-estimation').innerText = estimates[activeType] || "3 METER";
    }

    // Zooming blueprints
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

    // Printing blueprints
    window.printPattern = function() {
        const printWindow = window.open('', '_blank');
        const svgContent = document.getElementById('svg-wrapper').innerHTML;
        printWindow.document.write(`
            <html>
                <head>
                    <title>Cetak Pola - ${selectedCustomer.name}</title>
                    <style>
                        body { display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; font-family: sans-serif; }
                        svg { width: 100%; height: 90vh; }
                        .print-header { position: absolute; top: 20px; left: 20px; font-size: 14px; color: #4A3A2A; }
                    </style>
                </head>
                <body>
                    <div class="print-header">
                        <h2>JahitSpace Pola Teknis</h2>
                        <p>Pelanggan: <b>${selectedCustomer.name} (${selectedCustomer.code})</b></p>
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
    window.downloadSVG = function() {
        const svgContent = document.getElementById('svg-wrapper').innerHTML.trim();
        const blob = new Blob([svgContent], { type: 'image/svg+xml;charset=utf-8' });
        const url = URL.createObjectURL(blob);
        const link = document.createElement('a');
        link.href = url;
        link.download = `pola_${activeType.toLowerCase()}_${selectedCustomer.name.toLowerCase().replace(/\s+/g, '_')}.svg`;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        URL.revokeObjectURL(url);
        showNotification("Berkas pola SVG berhasil diunduh!");
    };

    // RENDER SVG TEMPLATES DYNAMICALLY
    function renderSVG() {
        const wrapper = document.getElementById('svg-wrapper');
        const strokeColor = document.documentElement.classList.contains('dark') ? '#60a5fa' : '#4A3A2A';
        const leaderColor = "#8C7A6B";
        
        let svgHTML = "";

        if (activeType === "BAJU") {
            const bahu = selectedCustomer.l_bahu;
            const dada = selectedCustomer.l_dada;
            const lengan = selectedCustomer.p_lengan;

            svgHTML = `
                <svg width="100%" height="100%" viewBox="0 0 600 450" fill="none" stroke="${strokeColor}" stroke-width="2" xmlns="http://www.w3.org/2000/svg">
                    <!-- Outline of shirt -->
                    <path d="M 220,90 L 380,90 L 360,120 L 480,170 L 430,240 L 370,210 L 370,410 L 230,410 L 230,210 L 170,240 L 120,170 L 240,120 Z" />
                    <!-- Details -->
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
                        <div style="background: white; border: 1px solid #EFECE6; border-radius: 4px; padding: 2px 4px; font-size: 10px; font-weight: bold; color: #334155; text-align: center; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">${bahu} cm</div>
                    </foreignObject>

                    <!-- Dimension Dada -->
                    <line x1="230" y1="280" x2="370" y2="280" stroke="${leaderColor}" stroke-width="1.2" stroke-dasharray="3,3" />
                    <circle cx="230" cy="280" r="3.5" fill="${leaderColor}" />
                    <circle cx="370" cy="280" r="3.5" fill="${leaderColor}" />
                    <foreignObject x="272" y="265" width="56" height="30">
                        <div style="background: white; border: 1px solid #EFECE6; border-radius: 4px; padding: 2px 4px; font-size: 10px; font-weight: bold; color: #334155; text-align: center; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">${dada} cm</div>
                    </foreignObject>

                    <!-- Dimension Lengan -->
                    <line x1="120" y1="170" x2="170" y2="240" stroke="${leaderColor}" stroke-width="1.2" stroke-dasharray="3,3" />
                    <circle cx="120" cy="170" r="3.5" fill="${leaderColor}" />
                    <circle cx="170" cy="240" r="3.5" fill="${leaderColor}" />
                    <foreignObject x="110" y="215" width="56" height="30">
                        <div style="background: white; border: 1px solid #EFECE6; border-radius: 4px; padding: 2px 4px; font-size: 10px; font-weight: bold; color: #334155; text-align: center; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">${lengan} cm</div>
                    </foreignObject>
                </svg>
            `;
        } else if (activeType === "CELANA") {
            const pinggang = selectedCustomer.l_pinggang !== "-" ? selectedCustomer.l_pinggang : 80;
            const panjang = selectedCustomer.p_celana !== "-" ? selectedCustomer.p_celana : 95;

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
                        <div style="background: white; border: 1px solid #EFECE6; border-radius: 4px; padding: 2px 4px; font-size: 10px; font-weight: bold; color: #334155; text-align: center; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">${pinggang} cm</div>
                    </foreignObject>

                    <!-- Dimension Panjang Celana -->
                    <line x1="180" y1="60" x2="180" y2="410" stroke="${leaderColor}" stroke-width="1.2" stroke-dasharray="3,3" />
                    <circle cx="180" cy="60" r="3.5" fill="${leaderColor}" />
                    <circle cx="180" cy="410" r="3.5" fill="${leaderColor}" />
                    <foreignObject x="152" y="220" width="56" height="30">
                        <div style="background: white; border: 1px solid #EFECE6; border-radius: 4px; padding: 2px 4px; font-size: 10px; font-weight: bold; color: #334155; text-align: center; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">${panjang} cm</div>
                    </foreignObject>
                </svg>
            `;
        } else if (activeType === "ROK") {
            const pinggang = selectedCustomer.l_pinggang !== "-" ? selectedCustomer.l_pinggang : 68;
            const panjang = selectedCustomer.p_rok !== "-" ? selectedCustomer.p_rok : 65;

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
                        <div style="background: white; border: 1px solid #EFECE6; border-radius: 4px; padding: 2px 4px; font-size: 10px; font-weight: bold; color: #334155; text-align: center; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">${pinggang} cm</div>
                    </foreignObject>

                    <!-- Dimension Panjang Rok -->
                    <line x1="180" y1="70" x2="180" y2="390" stroke="${leaderColor}" stroke-width="1.2" stroke-dasharray="3,3" />
                    <circle cx="180" cy="70" r="3.5" fill="${leaderColor}" />
                    <circle cx="180" cy="390" r="3.5" fill="${leaderColor}" />
                    <foreignObject x="152" y="210" width="56" height="30">
                        <div style="background: white; border: 1px solid #EFECE6; border-radius: 4px; padding: 2px 4px; font-size: 10px; font-weight: bold; color: #334155; text-align: center; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">${panjang} cm</div>
                    </foreignObject>
                </svg>
            `;
        } else if (activeType === "GAMIS") {
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
        }

        wrapper.innerHTML = svgHTML;
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
            alert("Harap pilih pelanggan terlebih dahulu!");
            return;
        }

        let savedPatterns = JSON.parse(localStorage.getItem('saved_patterns')) || [];
        
        // Generate new record
        const newId = savedPatterns.length > 0 ? Math.max(...savedPatterns.map(p => p.id)) + 1 : 1;
        const now = new Date();
        const dateStr = `${now.getDate()} Juni ${now.getFullYear()}`;

        const newPattern = {
            id: newId,
            name: `Pola ${activeType.charAt(0) + activeType.slice(1).toLowerCase()} - ${selectedCustomer.name}`,
            type: activeType,
            customerName: selectedCustomer.name,
            customerCode: selectedCustomer.code,
            avatarBg: selectedCustomer.avatarBg,
            initials: selectedCustomer.initials,
            date: dateStr,
            status: status,
            // Capture selected sizes for the detail preview
            l_dada: selectedCustomer.l_dada,
            p_baju: selectedCustomer.p_baju,
            l_bahu: selectedCustomer.l_bahu,
            p_lengan: selectedCustomer.p_lengan,
            l_pinggang: selectedCustomer.l_pinggang,
            l_pinggul: selectedCustomer.l_pinggul,
            p_celana: selectedCustomer.p_celana,
            p_rok: selectedCustomer.p_rok
        };

        savedPatterns.unshift(newPattern);
        localStorage.setItem('saved_patterns', JSON.stringify(savedPatterns));

        showNotification(status === 'Draf' ? "Pola berhasil disimpan sebagai draf!" : "Pola berhasil dibuat dan ditambahkan ke arsip!");
        
        setTimeout(() => {
            window.location.href = '/arsip-pola';
        }, 1200);
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
