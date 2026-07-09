<!-- PILIH PELANGGAN (1/3 width) -->
<div
    class="bg-white dark:bg-slate-900 border border-[#EFECE6] dark:border-slate-800 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)] h-full min-h-[260px] flex flex-col w-full"
>
    <h3 class="text-xs font-bold tracking-tight text-slate-800 dark:text-white mb-4 uppercase">
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
                    >
                        Ahmad Subagja
                    </span>
                    <span id="selected-customer-id" class="block text-[9px] text-gray-400 mt-0.5">
                        ID #T-2204
                    </span>
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
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">
                    Detail Ukuran
                </span>
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
                    <span class="font-bold text-slate-800 dark:text-slate-200" id="mini-val-dada">
                        96 cm
                    </span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Panjang Baju</span>
                    <span
                        class="font-bold text-slate-800 dark:text-slate-200"
                        id="mini-val-panjang"
                    >
                        72 cm
                    </span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Lebar Bahu</span>
                    <span class="font-bold text-slate-800 dark:text-slate-200" id="mini-val-bahu">
                        44 cm
                    </span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">P. Lengan</span>
                    <span class="font-bold text-slate-800 dark:text-slate-200" id="mini-val-lengan">
                        24 cm
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
