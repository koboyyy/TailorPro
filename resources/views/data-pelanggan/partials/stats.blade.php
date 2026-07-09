<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-[30px]">
    <!-- Card 1 -->
    <div
        class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-800 flex flex-col justify-between h-36 relative overflow-hidden group hover:border-gray-300 dark:hover:border-slate-700 transition-colors"
    >
        <p class="text-[11px] font-bold text-gray-400 dark:text-slate-500 tracking-wider mb-4 uppercase">Total Pelanggan</p>
        <div class="flex items-end justify-between mt-auto z-10">
            <h3
                class="font-serif text-[32px] leading-none font-bold text-slate-800 dark:text-white"
            >
                {{ number_format($totalPelanggan) }}
            </h3>
            <span
                class="flex items-center gap-1 text-xs font-semibold text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/30 border border-emerald-100 dark:border-emerald-900/50 px-2 py-1 rounded-lg"
            >
                <i class="fa-solid fa-users"></i>
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
        <p class="text-[11px] font-bold text-gray-400 dark:text-slate-500 tracking-wider mb-4 uppercase">Pelanggan Aktif</p>
        <div class="flex items-end justify-between mt-auto z-10">
            <h3
                class="font-serif text-[32px] leading-none font-bold text-slate-800 dark:text-white"
            >
                {{ number_format($pelangganAktif) }}
            </h3>
            <span
                class="flex items-center gap-1 text-xs font-semibold text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/30 border border-emerald-100 dark:border-emerald-900/50 px-2 py-1 rounded-lg"
            >
                <i class="fa-solid fa-user-check"></i>
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
        <p class="text-[11px] font-bold text-gray-400 dark:text-slate-500 tracking-wider mb-4 uppercase">Member Baru</p>
        <div class="flex items-end justify-between mt-auto z-10">
            <h3
                class="font-serif text-[32px] leading-none font-bold text-slate-800 dark:text-white"
            >
                {{ number_format($memberBaru) }}
            </h3>
            <span
                class="flex items-center gap-1 text-xs font-semibold text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-950/30 border border-blue-100 dark:border-blue-900/50 px-2 py-1 rounded-lg"
            >
                <i class="fa-solid fa-user-plus"></i>
                Bulan Ini
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
        <p class="text-[11px] font-bold text-gray-400 dark:text-slate-500 tracking-wider mb-4 uppercase">Repeat Order</p>
        <div class="flex items-end justify-between mt-auto z-10">
            <h3
                class="font-serif text-[32px] leading-none font-bold text-slate-800 dark:text-white"
            >
                {{ $repeatOrder }}%
            </h3>
            <span
                class="flex items-center gap-1 text-xs font-semibold text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-950/30 border border-blue-100 dark:border-blue-900/50 px-2 py-1 rounded-lg"
            >
                <i class="fa-solid fa-rotate-right"></i>
                Loyalitas
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
