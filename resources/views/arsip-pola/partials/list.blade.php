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