<section
    class="lg:col-span-2 bg-white dark:bg-slate-900 rounded-2xl border border-[#EFECE6] dark:border-slate-800 shadow-[0_8px_30px_rgb(0,0,0,0.02)] overflow-hidden"
>
    <!-- Card Header -->
    <div
        class="px-6 py-5 border-b border-[#EFECE6]/80 dark:border-slate-800/80 flex justify-between items-center"
    >
        <h3 class="text-sm font-bold tracking-tight text-primary dark:text-white">
            Semua Pelanggan
        </h3>
        <button
            id="filter-btn"
            class="w-8 h-8 rounded-lg border border-[#EFECE6] dark:border-slate-800 bg-background dark:bg-slate-800 flex items-center justify-center text-xs text-grey dark:text-slate-400 hover:text-primary dark:hover:text-white hover:border-gray-300 dark:hover:border-slate-700 transition"
        >
            <i class="fas fa-sliders-h"></i>
        </button>
    </div>

    <!-- Table Content Container -->
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr
                    class="bg-background dark:bg-slate-800/30 border-b border-[#EFECE6]/80 dark:border-slate-800/80 text-[10px] font-bold tracking-wider text-grey dark:text-slate-400 uppercase"
                >
                    <th class="px-6 py-4">Nama Pelanggan</th>
                    <th class="px-6 py-4 text-center">L. Badan</th>
                    <th class="px-6 py-4 text-center">L. Pinggang</th>
                    <th class="px-6 py-4 text-center">P. Baju</th>
                    <th class="px-6 py-4 text-center">Update Terakhir</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody
                id="customer-table-body"
                class="divide-y divide-[#EFECE6]/50 text-xs font-medium text-grey"
            >
                <!-- Rows will be injected by JS -->
            </tbody>
        </table>
    </div>

    <!-- Empty Search State -->
    <div id="empty-state" class="hidden py-16 px-6 text-center">
        <div
            class="w-16 h-16 rounded-full bg-background flex items-center justify-center mx-auto mb-4 text-grey"
        >
            <i class="fas fa-search text-xl"></i>
        </div>
        <h4 class="text-sm font-semibold text-primary mb-1">Pelanggan Tidak Ditemukan</h4>
        <p class="text-xs text-grey max-w-xs mx-auto">Tidak ada data pelanggan yang cocok dengan kata kunci pencarian Anda.</p>
    </div>
</section>
