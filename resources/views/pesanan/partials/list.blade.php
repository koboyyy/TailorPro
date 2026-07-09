<!-- ========================================================== -->
    <!-- 1. VIEW LIST (DAFTAR PESANAN) -->
    <!-- ========================================================== -->
    <div id="view-list" class="space-y-6">
        <!-- Title & Add Button Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <h1
                    class="font-serif text-3xl font-bold text-primary dark:text-white mb-1 tracking-tight"
                >
                    Pesanan
                </h1>
                <p class="text-xs text-grey dark:text-slate-400 font-medium">Kelola dan pantau setiap tahapan produksi busana pelanggan Anda.</p>
            </div>

            <a
                href="#tambah"
                class="flex items-center justify-center gap-2 bg-primary hover:bg-secondary text-accent font-semibold text-xs px-5 py-3 rounded-xl shadow-lg shadow-primary/15 transition duration-200 group active:scale-95"
            >
                <i
                    class="fas fa-plus text-[10px] group-hover:rotate-90 transition-transform duration-200"
                ></i>
                <span>Tambah Pesanan</span>
            </a>
        </div>

        <!-- Status Tabs Filter -->
        <div
            class="flex flex-wrap gap-2 mb-6 border-b border-[#EFECE6]/70 dark:border-slate-800/70 pb-5"
        >
            <button
                data-status="Semua"
                class="status-tab px-4 py-2 text-xs font-semibold rounded-full border border-primary text-primary transition duration-150 active-tab font-medium"
            >
                Semua <span class="font-bold text-[10px] ml-1" id="count-semua">4</span>
            </button>
            <button
                data-status="MENUNGGU"
                class="status-tab px-4 py-2 text-xs font-semibold rounded-full border border-transparent text-grey hover:bg-gray-100 dark:hover:bg-slate-800 transition duration-150 font-medium"
            >
                Menunggu <span class="font-bold text-[10px] ml-1" id="count-menunggu">1</span>
            </button>
            <button
                data-status="PEMOTONGAN"
                class="status-tab px-4 py-2 text-xs font-semibold rounded-full border border-transparent text-grey hover:bg-gray-100 dark:hover:bg-slate-800 transition duration-150 font-medium"
            >
                Pemotongan <span class="font-bold text-[10px] ml-1" id="count-pemotongan">1</span>
            </button>
            <button
                data-status="PENJAHITAN"
                class="status-tab px-4 py-2 text-xs font-semibold rounded-full border border-transparent text-grey hover:bg-gray-100 dark:hover:bg-slate-800 transition duration-150 font-medium"
            >
                Penjahitan <span class="font-bold text-[10px] ml-1" id="count-penjahitan">1</span>
            </button>
            <button
                data-status="PENYELESAIAN"
                class="status-tab px-4 py-2 text-xs font-semibold rounded-full border border-transparent text-grey hover:bg-gray-100 dark:hover:bg-slate-800 transition duration-150 font-medium"
            >
                Penyelesaian
                <span class="font-bold text-[10px] ml-1" id="count-penyelesaian">1</span>
            </button>
            <button
                data-status="SELESAI"
                class="status-tab px-4 py-2 text-xs font-semibold rounded-full border border-transparent text-grey hover:bg-gray-100 dark:hover:bg-slate-800 transition duration-150 font-medium"
            >
                Selesai <span class="font-bold text-[10px] ml-1" id="count-selesai">0</span>
            </button>
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
                            <th class="px-8 py-5">PELANGGAN & PESANAN</th>
                            <th class="px-8 py-5">TENGGAT WAKTU</th>
                            <th class="px-8 py-5">PROGRES PRODUKSI</th>
                            <th class="px-8 py-5 text-right">AKSI</th>
                        </tr>
                    </thead>
                    <tbody
                        id="orders-table-body"
                        class="divide-y divide-[#EFECE6]/50 text-xs font-medium text-gray-600 dark:divide-slate-800/50"
                    >
                        <!-- Rows dynamically loaded by JS -->
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
                    Pesanan Tidak Ditemukan
                </h4>
                <p class="text-xs text-gray-500 dark:text-slate-400 max-w-xs mx-auto">Tidak ada data pesanan yang cocok dengan kriteria Anda.</p>
            </div>

            <!-- Pagination Footer -->
            <div
                class="px-8 py-5 border-t dark:bg-slate-900 border-[#EFECE6]/80 dark:border-slate-800/80 flex flex-col md:flex-row items-center justify-between gap-4 bg-white/50"
            >
                <span class="text-[11px] text-gray-400 font-medium" id="pagination-info">
                    Menampilkan 1-4 dari 24 pesanan aktif
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
                        class="w-7 h-7 flex items-center justify-center rounded-md border border-gray-100 dark:border-slate-800 bg-white dark:bg-slate-800 text-gray-500 dark:text-slate-300 text-xs font-bold hover:bg-gray-50 dark:hover:bg-slate-700 hover:border-gray-200 transition shadow-sm"
                    >
                        2
                    </button>

                    <button
                        class="w-7 h-7 flex items-center justify-center rounded-md border border-gray-100 dark:border-slate-800 bg-white dark:bg-slate-800 text-gray-500 dark:text-slate-300 text-xs font-bold hover:bg-gray-50 dark:hover:bg-slate-700 hover:border-gray-200 transition shadow-sm"
                    >
                        3
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