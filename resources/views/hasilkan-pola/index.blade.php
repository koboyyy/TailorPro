@extends ('layouts.app')

@section ('breadcrumb-parent', 'halaman')
@section ('breadcrumb-active', 'hasilan pola')

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

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1
                class="font-serif text-3xl font-bold text-primary dark:text-white mb-1 tracking-tight"
            >
                Hasilkan Pola Busana
            </h1>
            <p class="text-xs text-grey dark:text-slate-400 font-medium">Hasilkan rancangan pola potongan busana secara otomatis berdasarkan ukuran pelanggan.</p>
        </div>

        <div class="flex items-center gap-3">
            <button
                type="button"
                id="btn-save-draft"
                class="px-5 py-3 border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-900 rounded-xl text-xs font-bold text-slate-700 dark:text-slate-300 hover:bg-gray-50 dark:hover:bg-slate-800 transition shadow-sm active:scale-95"
            >
                Simpan Draf
            </button>
            <button
                type="button"
                id="btn-generate"
                class="flex items-center justify-center gap-2 bg-primary hover:bg-secondary text-accent font-semibold text-xs px-5 py-3 rounded-xl shadow-lg shadow-primary/15 transition duration-200 active:scale-95"
            >
                <i class="fas fa-wand-magic-sparkles text-[10px]"></i>
                <span>Hasilkan Pola</span>
            </button>
        </div>
    </div>

    <!-- Main Designer Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start mb-8 w-full">
        <div class="flex w-full gap-8 flex-wrap">
            <!-- PILIH JENIS BUSANA (2/3 width) -->
            <div
                class="lg:col-span-2 bg-white dark:bg-slate-900 border border-[#EFECE6] dark:border-slate-800 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)] h-full min-h-[260px] w-full"
            >
                <h3
                    class="text-xs font-bold tracking-tight text-slate-800 dark:text-white mb-4 uppercase"
                >
                    Pilih Jenis Busana
                </h3>

                <div class="grid grid-cols-2 gap-4">
                    <!-- Baju Button -->
                    <button
                        type="button"
                        data-type="KEMEJA"
                        class="garment-type-card border border-primary bg-primary/5 p-5 rounded-2xl flex flex-col items-center justify-center gap-3 transition hover:bg-primary/5 active:scale-95"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mb-1 text-primary dark:text-accent"><path d="M20.38 3.46 16 2a4 4 0 0 1-8 0L3.62 3.46a2 2 0 0 0-1.34 2.23l.58 3.47a1 1 0 0 0 .99.84H6v10c0 1.1.9 2 2 2h8a2 2 0 0 0 2-2V10h2.15a1 1 0 0 0 .99-.84l.58-3.47a2 2 0 0 0-1.34-2.23z"/></svg>
                        <span class="text-xs font-bold text-primary dark:text-accent">Kemeja</span>
                    </button>

                    <!-- Celana Button -->
                    <button
                        type="button"
                        data-type="CELANA"
                        class="garment-type-card border border-[#EFECE6] dark:border-slate-800 p-5 rounded-2xl flex flex-col items-center justify-center gap-3 transition hover:bg-gray-50 dark:hover:bg-slate-800 active:scale-95"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mb-1 text-gray-400"><path d="M6 3h12a2 2 0 0 1 2 2v2a2 2 0 0 1-.5 1.3l-3.5 4.7v9a2 2 0 0 1-2 2H10a2 2 0 0 1-2-2v-9L4.5 8.3A2 2 0 0 1 4 7V5a2 2 0 0 1 2-2z"/></svg>
                        <span class="text-xs font-bold text-gray-500 dark:text-slate-400"
                            >Celana</span
                        >
                    </button>

                    <!-- Rok Button -->
                    <button
                        type="button"
                        data-type="ROK"
                        class="garment-type-card border border-[#EFECE6] dark:border-slate-800 p-5 rounded-2xl flex flex-col items-center justify-center gap-3 transition hover:bg-gray-50 dark:hover:bg-slate-800 active:scale-95"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mb-1 text-gray-400"><path d="M8 4h8l5 16H3z"/></svg>
                        <span class="text-xs font-bold text-gray-500 dark:text-slate-400">Rok</span>
                    </button>

                    <!-- Gamis Button -->
                    <button
                        type="button"
                        data-type="GAMIS"
                        class="garment-type-card border border-[#EFECE6] dark:border-slate-800 p-5 rounded-2xl flex flex-col items-center justify-center gap-3 transition hover:bg-gray-50 dark:hover:bg-slate-800 active:scale-95"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mb-1 text-gray-400"><path d="M9 4c0 1.5 1.5 3 3 3s3-1.5 3-3M6 4h12l3 6h-3l-2 11H8l-2-11H3z"/></svg>
                        <span class="text-xs font-bold text-gray-500 dark:text-slate-400"
                            >Gamis</span
                        >
                    </button>
                </div>
            </div>

            <!-- PILIH PELANGGAN (1/3 width) -->
            <div
                class="bg-white dark:bg-slate-900 border border-[#EFECE6] dark:border-slate-800 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)] h-full min-h-[260px] flex flex-col w-full"
            >
                <h3
                    class="text-xs font-bold tracking-tight text-slate-800 dark:text-white mb-4 uppercase"
                >
                    Pilih Pelanggan
                </h3>

                <div class="space-y-4 flex-1 flex flex-col justify-between">
                    <!-- Search Container -->
                    <div class="relative" id="customer-search-container">
                        <span
                            class="absolute inset-y-0 left-4 flex items-center text-gray-400 pointer-events-none text-xs"
                        >
                            <i class="fas fa-search"></i>
                        </span>
                        <input
                            type="text"
                            id="customer-search-input"
                            placeholder="Cari nama atau ID..."
                            class="w-full pl-10 pr-4 py-3 bg-background dark:bg-slate-800 border border-[#EFECE6]/80 dark:border-slate-700/80 rounded-2xl text-xs text-secondary dark:text-white focus:outline-none focus:border-primary transition"
                        />

                        <!-- Dropdown Search Results -->
                        <div
                            id="customer-search-results"
                            class="hidden absolute left-0 right-0 mt-2 bg-white dark:bg-slate-850 border border-gray-100 dark:border-slate-700 rounded-2xl shadow-xl py-1.5 max-h-40 overflow-y-auto z-40"
                        >
                            <!-- Populated by JS -->
                        </div>
                    </div>

                    <!-- Selected Customer Profile Card -->
                    <div
                        id="selected-customer-card"
                        class="flex items-center justify-between p-3.5 bg-gray-50/50 dark:bg-slate-850 border border-gray-100 dark:border-slate-700 rounded-2xl"
                    >
                        <div class="flex items-center gap-3">
                            <div
                                id="selected-customer-avatar"
                                class="w-10 h-10 rounded-full font-bold text-sm flex items-center justify-center text-white bg-primary"
                            >
                                AS
                            </div>
                            <div>
                                <span
                                    id="selected-customer-name"
                                    class="block text-sm font-bold text-slate-800 dark:text-slate-100"
                                    >Ahmad Subagja</span
                                >
                                <span
                                    id="selected-customer-id"
                                    class="block text-[9px] text-gray-400 mt-0.5"
                                    >ID #T-2204</span
                                >
                            </div>
                        </div>
                        <div
                            class="w-6 h-6 rounded-full bg-primary text-white flex items-center justify-center"
                        >
                            <i class="fas fa-check text-xs"></i>
                        </div>
                    </div>

                    <!-- Detail Ukuran Mini Summary -->
                    <div class="pt-3 border-t border-[#EFECE6]/80 dark:border-slate-800/80 mt-auto">
                        <div class="flex justify-between items-center mb-3">
                            <span
                                class="text-[10px] font-bold text-gray-400 uppercase tracking-wider"
                                >Detail Ukuran</span
                            >
                            <button
                                type="button"
                                onclick="showFullSizesModal()"
                                class="text-[9px] font-extrabold text-primary hover:text-secondary uppercase tracking-wider"
                            >
                                Lihat Selengkapnya
                            </button>
                        </div>
                        <div
                            class="grid grid-cols-2 gap-x-4 gap-y-2 text-[11px] font-medium text-slate-700 dark:text-slate-300"
                        >
                            <div class="flex justify-between">
                                <span class="text-gray-400">Lingkar Dada</span>
                                <span
                                    class="font-bold text-slate-800 dark:text-slate-200"
                                    id="mini-val-dada"
                                    >96 cm</span
                                >
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Panjang Baju</span>
                                <span
                                    class="font-bold text-slate-800 dark:text-slate-200"
                                    id="mini-val-panjang"
                                    >72 cm</span
                                >
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Lebar Bahu</span>
                                <span
                                    class="font-bold text-slate-800 dark:text-slate-200"
                                    id="mini-val-bahu"
                                    >44 cm</span
                                >
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">P. Lengan</span>
                                <span
                                    class="font-bold text-slate-800 dark:text-slate-200"
                                    id="mini-val-lengan"
                                    >24 cm</span
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ESTIMASI KAIN -->
    <div
        class="bg-white dark:bg-slate-900 border border-[#EFECE6] dark:border-slate-800 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)]"
    >
        <h3 class="text-xs font-bold tracking-tight text-slate-800 dark:text-white mb-3 uppercase">
            Estimasi Kain Yang Terpakai
        </h3>
        <div
            class="py-4 px-5 bg-gray-50 dark:bg-slate-850 border border-gray-100 dark:border-slate-800 rounded-2xl text-sm font-black text-slate-800 dark:text-white tracking-wider"
            id="fabric-estimation"
        >
            3 METER
        </div>
    </div>
        </div>

        <!-- PREVIEW POLA TEKNIS (Full Width) -->
        <div
            class="col-span-2 bg-white dark:bg-slate-900 border border-[#EFECE6] dark:border-slate-800 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)] mb-8 w-full h-full"
        >
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-2">
                    <span
                        class="w-8 h-8 rounded-lg bg-gray-50 dark:bg-slate-800 flex items-center justify-center text-primary dark:text-accent font-bold font-serif text-sm"
                        >A</span
                    >
                    <div>
                        <h3 class="text-sm font-bold tracking-tight text-slate-800 dark:text-white">
                            Preview Pola Teknis
                        </h3>
                        <p class="text-[10px] text-gray-400">Draf Otomatis</p>
                    </div>
                </div>

                <!-- Action Buttons -->
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

            <!-- Blueprint Canvas -->
            <div
                class="blueprint-canvas-container relative w-full h-auto min-h-[450px] rounded-2xl overflow-y-auto border border-[#EFECE6] dark:border-slate-800 flex flex-col items-start justify-center bg-[#FCFCFC] dark:bg-slate-950"
            >
                <!-- Grid overlay -->
                <div class="absolute inset-0 blueprint-grid opacity-70"></div>

                <!-- Scalable Canvas Wrapper -->
                <div
                    id="svg-wrapper"
                    class="relative z-10 w-full min-h-full flex flex-row flex-wrap items-start justify-center gap-12 py-10 transition-transform duration-200"
                    style="transform: scale(1)"
                >
                    {{-- <div id="kanvasContainer" class="w-full flex justify-center"></div> --}}
                </div>
            </div>

            <!-- Format Indicator + Detail Jarak Pola -->

            <div
                class="flex items-center justify-between mt-3 text-[10px] font-medium text-gray-400"
            >
                <span class="flex items-center gap-1.5"
                    ><span class="w-2 h-2 rounded-full bg-blue-500"></span> FORMAT: SVG</span
                >
                <span class="italic"
                    >Klik 'Hasilkan' untuk memperbarui pola berdasarkan ukuran terbaru.</span
                >
            </div>

            <!-- Detail Jarak Titik Pola -->
            <div
                id="detailJarakTitikPola"
                class="mt-3 bg-gray-50 dark:bg-slate-900 border border-[#EFECE6] dark:border-slate-800 rounded-xl px-4 py-3 text-xs text-gray-600 dark:text-slate-300 space-y-3"
            ></div>
        </div>
    </div>

    

    <!-- Modals Detail Ukuran Lengkap -->
    <div
        id="sizes-modal"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm hidden transition-all duration-300"
    >
        <div
            class="bg-white dark:bg-slate-900 border border-[#EFECE6] dark:border-slate-800 w-full max-w-md rounded-3xl shadow-2xl overflow-hidden transform scale-95 opacity-0 transition-all duration-300"
            id="sizes-modal-container"
        >
            <div
                class="px-6 py-5 border-b border-[#EFECE6]/80 dark:border-slate-800/80 flex justify-between items-center"
            >
                <h3 class="font-serif text-lg font-bold text-primary dark:text-white">
                    Profil Ukuran Lengkap
                </h3>
                <button
                    type="button"
                    class="text-gray-400 hover:text-gray-600 dark:hover:text-white transition"
                    onclick="closeSizesModal()"
                >
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="p-6 space-y-4 max-h-[350px] overflow-y-auto" id="sizes-modal-content">
                <!-- Rendered by JS -->
            </div>

            <div
                class="px-6 py-4 border-t border-[#EFECE6]/80 dark:border-slate-800/80 flex justify-end bg-gray-50/50 dark:bg-slate-850"
            >
                <button
                    type="button"
                    class="px-5 py-2.5 bg-primary text-accent text-xs font-bold rounded-xl shadow transition active:scale-95"
                    onclick="closeSizesModal()"
                >
                    Tutup
                </button>
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
            // Seed mockup data customers
            // const customers = [
            //     {
            //         id: 1,
            //         name: 'Ahmad Subagja',
            //         code: 'ID #T-2204',
            //         avatarBg: 'bg-[#2563EB] text-white',
            //         initials: 'AS',
            //         l_dada: 96,
            //         l_bahu: 44,
            //         p_lengan: 24,
            //         l_pinggang: 80,
            //         l_pinggul: 98,
            //         p_celana: 95,
            //         p_rok: '-',

            //         p_baju: 72,
            //         lingkar_badan: 100,
            //         lebar_bahu: 48,

            //         panjang_lengan: 60,
            //         lingkar_lengan: 40,

            //         lingkar_kerah: 40,
            //     },
            //     {
            //         id: 2,
            //         name: 'Siti Aminah',
            //         code: 'ID #T-2201',
            //         avatarBg: 'bg-[#2D6A4F] text-white',
            //         initials: 'S',
            //         l_dada: 88,
            //         p_baju: 70,
            //         l_bahu: 40,
            //         p_lengan: 24,
            //         l_pinggang: 76,
            //         l_pinggul: 94,
            //         p_celana: '-',
            //         p_rok: '-',
            //     },
            //     {
            //         id: 3,
            //         name: 'Budi Santoso',
            //         code: 'ID #T-2202',
            //         avatarBg: 'bg-[#8C6D58] text-white',
            //         initials: 'B',
            //         l_dada: 92,
            //         p_baju: 72,
            //         l_bahu: 42,
            //         p_lengan: 25,
            //         l_pinggang: 80,
            //         l_pinggul: 96,
            //         p_celana: 96,
            //         p_rok: '-',
            //     },
            //     {
            //         id: 4,
            //         name: 'Dewi Sartika',
            //         code: 'ID #T-2203',
            //         avatarBg: 'bg-[#2F3E46] text-white',
            //         initials: 'D',
            //         l_dada: 84,
            //         p_baju: 65,
            //         l_bahu: 38,
            //         p_lengan: 23,
            //         l_pinggang: 68,
            //         l_pinggul: 90,
            //         p_celana: '-',
            //         p_rok: 65,
            //     },
            // ];

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
                        if (icon)
                            icon.className = icon.className.replace(
                                'text-primary dark:text-accent',
                                'text-gray-400'
                            );
                        if (text) {
                            text.classList.remove('text-primary', 'dark:text-accent');
                            text.classList.add('text-gray-500', 'dark:text-slate-400');
                        }
                    });

                    this.classList.remove('border-[#EFECE6]', 'dark:border-slate-800');
                    this.classList.add('border-primary', 'bg-primary/5');
                    const activeIcon = this.querySelector('svg');
                    const activeText = this.querySelector('span');
                    if (activeIcon)
                        activeIcon.className = activeIcon.className.replace(
                            'text-gray-400',
                            'text-primary dark:text-accent'
                        );
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
                const safeName = (selectedCustomer.nama_pelanggan || 'pelanggan').toLowerCase().replace(/\s+/g, '_');
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
                    const pinggang = selectedCustomer.l_pinggang !== '-' ? selectedCustomer.l_pinggang : 80;
                    const panjang = selectedCustomer.p_celana !== '-' ? selectedCustomer.p_celana : 95;

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
                } else if (activeType === 'ROK') {
                    const pinggang = selectedCustomer.l_pinggang !== '-' ? selectedCustomer.l_pinggang : 68;
                    const panjang = selectedCustomer.p_rok !== '-' ? selectedCustomer.p_rok : 65;

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
                        const pinggang =
                            selectedCustomer.l_pinggang !== '-' ? selectedCustomer.l_pinggang : 80;
                        const panjang = selectedCustomer.p_celana !== '-' ? selectedCustomer.p_celana : 95;
                        html += `<div>
                                                                                        <div class="font-bold text-[11px] text-primary dark:text-accent mb-1">
                                                                                            Pola Celana:
                                                                                        </div>
                                                                                        <ul class="ml-3 list-disc space-y-0.5">
                                                                                            <li>Panjang Celana = ${panjang} cm</li>
                                                                                            <li>Lingkar Pinggang = ${pinggang} cm</li>
                                                                                        </ul>
                                                                                    </div>`;
                    } else if (activeType === 'ROK' && selectedCustomer) {
                        // ROK
                        const pinggang =
                            selectedCustomer.l_pinggang !== '-' ? selectedCustomer.l_pinggang : 68;
                        const panjang = selectedCustomer.p_rok !== '-' ? selectedCustomer.p_rok : 65;
                        html += `<div>
                                                                                        <div class="font-bold text-[11px] text-primary dark:text-accent mb-1">
                                                                                            Pola Rok:
                                                                                        </div>
                                                                                        <ul class="ml-3 list-disc space-y-0.5">
                                                                                            <li>Panjang Rok = ${panjang} cm</li>
                                                                                            <li>Lingkar Pinggang = ${pinggang} cm</li>
                                                                                        </ul>
                                                                                    </div>`;
                    } else if (activeType === 'GAMIS' && selectedCustomer) {
                        // GAMIS (Use l_dada and default panjang as in SVG)
                        const dada = selectedCustomer.l_dada || '-';
                        const panjang = selectedCustomer.p_baju || 135;
                        html += `<div>
                                                                                        <div class="font-bold text-[11px] text-primary dark:text-accent mb-1">
                                                                                            Pola Gamis:
                                                                                        </div>
                                                                                        <ul class="ml-3 list-disc space-y-0.5">
                                                                                            <li>Lingkar Dada = ${dada} cm</li>
                                                                                            <li>Panjang Gamis = ${panjang} cm</li>
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
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        pelanggan_id: selectedCustomer.pelanggan_id,
                        type: activeType,
                        status: status
                    })
                })
                .then(response => response.json())
                .then(data => {
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
                .catch(error => {
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
