<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Card 1 -->
    <div
        class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-800 flex flex-col justify-between h-36 relative overflow-hidden group hover:border-gray-300 dark:hover:border-slate-700 transition-colors"
    >
        <p class="text-[11px] font-bold text-gray-400 dark:text-slate-500 tracking-wider mb-4 uppercase">Total Pendapatan</p>
        <div class="flex items-end justify-between mt-auto z-10">
            <h3
                class="font-serif text-[32px] leading-none font-bold text-slate-800 dark:text-white"
            >
                Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
            </h3>
            <span
                class="flex items-center gap-1 text-xs font-semibold px-2 py-1 rounded-lg {{ $pendapatanGrowth >= 0 ? 'text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/30 border border-emerald-100 dark:border-emerald-900/50' : 'text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-950/30 border border-red-100 dark:border-red-900/50' }}"
            >
                <i
                    class="fa-solid {{ $pendapatanGrowth >= 0 ? 'fa-arrow-trend-up' : 'fa-arrow-trend-down' }}"
                ></i>
                {{ $pendapatanGrowth >= 0 ? '+' : '' }}{{ number_format($pendapatanGrowth, 1) }}%
            </span>
        </div>
        <!-- Decorative background -->
        <div
            class="absolute -bottom-8 -right-8 w-32 h-32 bg-gray-50 dark:bg-slate-800/50 rounded-full opacity-50 group-hover:scale-110 transition-transform"
        ></div>
        <div
            class="absolute -bottom-4 -right-4 w-20 h-20 bg-white dark:bg-slate-900 rounded-full opacity-50"
        ></div>
    </div>

    <!-- Card 2 -->
    <div
        class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-800 flex flex-col justify-between h-36 relative overflow-hidden group hover:border-gray-300 dark:hover:border-slate-700 transition-colors"
    >
        <p class="text-[11px] font-bold text-gray-400 dark:text-slate-500 tracking-wider mb-4 uppercase">Total Pesanan</p>
        <div class="flex items-end justify-between mt-auto z-10">
            <h3
                class="font-serif text-[32px] leading-none font-bold text-slate-800 dark:text-white"
            >
                {{ $totalPesanan }}
            </h3>
            <span
                class="flex items-center gap-1 text-xs font-semibold px-2 py-1 rounded-lg {{ $pesananGrowth >= 0 ? 'text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/30 border border-emerald-100 dark:border-emerald-900/50' : 'text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-950/30 border border-red-100 dark:border-red-900/50' }}"
            >
                <i
                    class="fa-solid {{ $pesananGrowth >= 0 ? 'fa-arrow-trend-up' : 'fa-arrow-trend-down' }}"
                ></i>
                {{ $pesananGrowth >= 0 ? '+' : '' }}{{ number_format($pesananGrowth, 1) }}%
            </span>
        </div>
        <!-- Decorative background -->
        <div
            class="absolute -bottom-8 -right-8 w-32 h-32 bg-gray-50 dark:bg-slate-800/50 rounded-full opacity-50 group-hover:scale-110 transition-transform"
        ></div>
        <div
            class="absolute -bottom-4 -right-4 w-20 h-20 bg-white dark:bg-slate-900 rounded-full opacity-50"
        ></div>
    </div>

    <!-- Card 3 -->
    <div
        class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-800 flex flex-col justify-between h-36 relative overflow-hidden group hover:border-gray-300 dark:hover:border-slate-700 transition-colors"
    >
        <p class="text-[11px] font-bold text-gray-400 dark:text-slate-500 tracking-wider mb-4 uppercase">Pelanggan Baru</p>
        <div class="flex items-end justify-between mt-auto z-10">
            <h3
                class="font-serif text-[32px] leading-none font-bold text-slate-800 dark:text-white"
            >
                {{ $pelangganBaru }}
            </h3>
            <span
                class="flex items-center gap-1 text-xs font-semibold px-2 py-1 rounded-lg {{ $pelangganGrowth >= 0 ? 'text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-950/30 border border-blue-100 dark:border-blue-900/50' : 'text-gray-600 dark:text-gray-400 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700' }}"
            >
                <i class="fa-solid fa-user-plus"></i>
                {{ $pelangganGrowth >= 0 ? '+' : '' }}{{ $pelangganGrowth }}
            </span>
        </div>
        <!-- Decorative background -->
        <div
            class="absolute -bottom-8 -right-8 w-32 h-32 bg-gray-50 dark:bg-slate-800/50 rounded-full opacity-50 group-hover:scale-110 transition-transform"
        ></div>
        <div
            class="absolute -bottom-4 -right-4 w-20 h-20 bg-white dark:bg-slate-900 rounded-full opacity-50"
        ></div>
    </div>
</div>
