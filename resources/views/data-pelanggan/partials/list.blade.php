<section
        class="lg:col-span-2 bg-white dark:bg-slate-900 rounded-2xl border border-[#EFECE6] dark:border-slate-800 shadow-[0_8px_30px_rgb(0,0,0,0.02)] overflow-hidden"
    >
        <div
            class="px-6 py-5 border-b border-[#EFECE6]/80 dark:border-slate-800/80 flex justify-between items-center"
        >
            <h3 class="text-sm font-bold tracking-tight text-slate-800 dark:text-white">
                Semua Pelanggan
            </h3>
            <button
                id="filter-btn"
                class="w-8 h-8 rounded-lg border border-[#EFECE6] dark:border-slate-800 bg-white dark:bg-slate-800 flex items-center justify-center text-xs text-gray-500 dark:text-slate-400 hover:text-blue-600 hover:border-gray-300 transition"
            >
                <i class="fas fa-sliders-h"></i>
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr
                        class="bg-white dark:bg-slate-800/30 border-b border-[#EFECE6]/80 dark:border-slate-800/80 text-[10px] font-bold tracking-wider text-gray-400 dark:text-slate-400 uppercase"
                    >
                        <th class="px-6 py-4">Nama Pelanggan</th>
                        <th class="px-6 py-4">No. Telepon</th>
                        <th class="px-6 py-4">Alamat</th>
                        <th class="px-6 py-4">Total Pesanan</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody
                    id="customer-table-body"
                    class="divide-y divide-[#EFECE6]/50 text-xs font-medium text-gray-600"
                ></tbody>
            </table>
        </div>

        <div id="empty-state" class="hidden py-16 px-6 text-center">
            <div
                class="w-16 h-16 rounded-full bg-slate-50 flex items-center justify-center mx-auto mb-4 text-gray-400"
            >
                <i class="fas fa-search text-xl"></i>
            </div>
            <h4 class="text-sm font-semibold text-slate-800 mb-1">Pelanggan Tidak Ditemukan</h4>
            <p class="text-xs text-gray-500 max-w-xs mx-auto">Tidak ada data pelanggan yang cocok dengan kata kunci pencarian Anda.</p>
        </div>

        <div
            class="px-6 py-4 border-t dark:bg-slate-900 border-[#EFECE6]/80 flex flex-col md:flex-row items-center justify-between gap-4 bg-white/50"
        >
            <span class="text-[11px] text-gray-400 font-medium" id="pagination-info">
                <!-- Diisi oleh JS -->
            </span>

            <div class="flex items-center gap-1.5" id="pagination-controls">
                <!-- Diisi oleh JS -->
            </div>
        </div>
    </section>
    </section>