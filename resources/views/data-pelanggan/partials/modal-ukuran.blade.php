<!-- Modal Tambah/Edit Ukuran -->
<div
    id="ukuranModal"
    class="fixed inset-0 z-50 hidden bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4"
>
    <div
        class="bg-white dark:bg-slate-900 w-full max-w-2xl rounded-3xl shadow-2xl border border-gray-100 dark:border-slate-800 overflow-hidden transform transition-all max-h-[90vh] flex flex-col"
    >
        <div
            class="px-6 py-4 border-b border-gray-100 dark:border-slate-800 flex items-center justify-between shrink-0"
        >
            <div>
                <h3 id="ukuranModalTitle" class="font-bold text-lg text-slate-800 dark:text-white">
                    Detail Ukuran Baju
                </h3>
                <span
                    id="ukuranModalBadge"
                    class="bg-primary/10 text-primary dark:bg-slate-800 dark:text-accent text-[9px] font-bold tracking-wider px-2.5 py-1 rounded uppercase mt-1 inline-block"
                >
                    NAMA
                </span>
            </div>
            <button
                type="button"
                onclick="closeUkuranModal()"
                class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition"
            >
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <form id="ukuranForm" onsubmit="saveUkuran(event)" class="p-6 overflow-y-auto flex-1">
            <input type="hidden" id="ukuranCustomerId" value="" />
            <input type="hidden" id="ukuranCustomerName" value="" />

            <div class="grid grid-cols-2 gap-4">
                <!-- Lingkar Badan -->
                <div>
                    <label
                        class="text-[10px] font-bold uppercase tracking-wider text-grey block mb-1"
                    >
                        Lingkar Badan
                    </label>
                    <div class="relative">
                        <input
                            type="number"
                            id="input-l-badan"
                            class="w-full pl-3 pr-8 py-2 bg-[#F8F7F5] dark:bg-slate-800 text-slate-800 dark:text-white border border-transparent dark:border-slate-700/50 rounded-lg text-xs font-medium focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                            required
                        />
                        <span
                            class="absolute inset-y-0 right-3 flex items-center text-[9px] font-bold text-gray-400"
                        >
                            CM
                        </span>
                    </div>
                </div>
                <!-- Lingkar Pinggang -->
                <div>
                    <label
                        class="text-[10px] font-bold uppercase tracking-wider text-grey block mb-1"
                    >
                        Lingkar Pinggang
                    </label>
                    <div class="relative">
                        <input
                            type="number"
                            id="input-l-pinggang"
                            class="w-full pl-3 pr-8 py-2 bg-[#F8F7F5] dark:bg-slate-800 text-slate-800 dark:text-white border border-transparent dark:border-slate-700/50 rounded-lg text-xs font-medium focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                            required
                        />
                        <span
                            class="absolute inset-y-0 right-3 flex items-center text-[9px] font-bold text-gray-400"
                        >
                            CM
                        </span>
                    </div>
                </div>
                <!-- Lebar Bahu -->
                <div>
                    <label
                        class="text-[10px] font-bold uppercase tracking-wider text-grey block mb-1"
                    >
                        Lebar Bahu
                    </label>
                    <div class="relative">
                        <input
                            type="number"
                            id="input-p-bahu"
                            class="w-full pl-3 pr-8 py-2 bg-[#F8F7F5] dark:bg-slate-800 text-slate-800 dark:text-white border border-transparent dark:border-slate-700/50 rounded-lg text-xs font-medium focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                            required
                        />
                        <span
                            class="absolute inset-y-0 right-3 flex items-center text-[9px] font-bold text-gray-400"
                        >
                            CM
                        </span>
                    </div>
                </div>
                <!-- Panjang Lengan -->
                <div>
                    <label
                        class="text-[10px] font-bold uppercase tracking-wider text-grey block mb-1"
                    >
                        Panjang Lengan
                    </label>
                    <div class="relative">
                        <input
                            type="number"
                            id="input-p-lengan"
                            class="w-full pl-3 pr-8 py-2 bg-[#F8F7F5] dark:bg-slate-800 text-slate-800 dark:text-white border border-transparent dark:border-slate-700/50 rounded-lg text-xs font-medium focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                            required
                        />
                        <span
                            class="absolute inset-y-0 right-3 flex items-center text-[9px] font-bold text-gray-400"
                        >
                            CM
                        </span>
                    </div>
                </div>
                <!-- Lingkar Lengan -->
                <div>
                    <label
                        class="text-[10px] font-bold uppercase tracking-wider text-grey block mb-1"
                    >
                        Lingkar Lengan
                    </label>
                    <div class="relative">
                        <input
                            type="number"
                            id="input-l-lengan"
                            class="w-full pl-3 pr-8 py-2 bg-[#F8F7F5] dark:bg-slate-800 text-slate-800 dark:text-white border border-transparent dark:border-slate-700/50 rounded-lg text-xs font-medium focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                            required
                        />
                        <span
                            class="absolute inset-y-0 right-3 flex items-center text-[9px] font-bold text-gray-400"
                        >
                            CM
                        </span>
                    </div>
                </div>
                <!-- Lebar Dada -->
                <div>
                    <label
                        class="text-[10px] font-bold uppercase tracking-wider text-grey block mb-1"
                    >
                        Lebar Dada
                    </label>
                    <div class="relative">
                        <input
                            type="number"
                            id="input-l-dada"
                            class="w-full pl-3 pr-8 py-2 bg-[#F8F7F5] dark:bg-slate-800 text-slate-800 dark:text-white border border-transparent dark:border-slate-700/50 rounded-lg text-xs font-medium focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                            required
                        />
                        <span
                            class="absolute inset-y-0 right-3 flex items-center text-[9px] font-bold text-gray-400"
                        >
                            CM
                        </span>
                    </div>
                </div>
                <!-- Lebar Punggung -->
                <div>
                    <label
                        class="text-[10px] font-bold uppercase tracking-wider text-grey block mb-1"
                    >
                        Lebar Punggung
                    </label>
                    <div class="relative">
                        <input
                            type="number"
                            id="input-l-punggung"
                            class="w-full pl-3 pr-8 py-2 bg-[#F8F7F5] dark:bg-slate-800 text-slate-800 dark:text-white border border-transparent dark:border-slate-700/50 rounded-lg text-xs font-medium focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                            required
                        />
                        <span
                            class="absolute inset-y-0 right-3 flex items-center text-[9px] font-bold text-gray-400"
                        >
                            CM
                        </span>
                    </div>
                </div>
                <!-- Lingkar Pinggul -->
                <div>
                    <label
                        class="text-[10px] font-bold uppercase tracking-wider text-grey block mb-1"
                    >
                        Lingkar Pinggul
                    </label>
                    <div class="relative">
                        <input
                            type="number"
                            id="input-l-pinggul"
                            class="w-full pl-3 pr-8 py-2 bg-[#F8F7F5] dark:bg-slate-800 text-slate-800 dark:text-white border border-transparent dark:border-slate-700/50 rounded-lg text-xs font-medium focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                            required
                        />
                        <span
                            class="absolute inset-y-0 right-3 flex items-center text-[9px] font-bold text-gray-400"
                        >
                            CM
                        </span>
                    </div>
                </div>
                <!-- Panjang Baju -->
                <div>
                    <label
                        class="text-[10px] font-bold uppercase tracking-wider text-grey block mb-1"
                    >
                        Panjang Baju
                    </label>
                    <div class="relative">
                        <input
                            type="number"
                            id="input-p-baju"
                            class="w-full pl-3 pr-8 py-2 bg-[#F8F7F5] dark:bg-slate-800 text-slate-800 dark:text-white border border-transparent dark:border-slate-700/50 rounded-lg text-xs font-medium focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                            required
                        />
                        <span
                            class="absolute inset-y-0 right-3 flex items-center text-[9px] font-bold text-gray-400"
                        >
                            CM
                        </span>
                    </div>
                </div>
                <!-- Turun Pinggang -->
                <div>
                    <label
                        class="text-[10px] font-bold uppercase tracking-wider text-grey block mb-1"
                    >
                        Turun Pinggang
                    </label>
                    <div class="relative">
                        <input
                            type="number"
                            id="input-t-pinggang"
                            class="w-full pl-3 pr-8 py-2 bg-[#F8F7F5] dark:bg-slate-800 text-slate-800 dark:text-white border border-transparent dark:border-slate-700/50 rounded-lg text-xs font-medium focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                            required
                        />
                        <span
                            class="absolute inset-y-0 right-3 flex items-center text-[9px] font-bold text-gray-400"
                        >
                            CM
                        </span>
                    </div>
                </div>
                <!-- Turun Susu -->
                <div>
                    <label
                        class="text-[10px] font-bold uppercase tracking-wider text-grey block mb-1"
                    >
                        Turun Susu/Tetek
                    </label>
                    <div class="relative">
                        <input
                            type="number"
                            id="input-t-susu"
                            class="w-full pl-3 pr-8 py-2 bg-[#F8F7F5] dark:bg-slate-800 text-slate-800 dark:text-white border border-transparent dark:border-slate-700/50 rounded-lg text-xs font-medium focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                            required
                        />
                        <span
                            class="absolute inset-y-0 right-3 flex items-center text-[9px] font-bold text-gray-400"
                        >
                            CM
                        </span>
                    </div>
                </div>
                <!-- Lingkar Ketiak -->
                <div>
                    <label
                        class="text-[10px] font-bold uppercase tracking-wider text-grey block mb-1"
                    >
                        Lingkar Ketiak
                    </label>
                    <div class="relative">
                        <input
                            type="number"
                            id="input-l-ketiak"
                            class="w-full pl-3 pr-8 py-2 bg-[#F8F7F5] dark:bg-slate-800 text-slate-800 dark:text-white border border-transparent dark:border-slate-700/50 rounded-lg text-xs font-medium focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                            required
                        />
                        <span
                            class="absolute inset-y-0 right-3 flex items-center text-[9px] font-bold text-gray-400"
                        >
                            CM
                        </span>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <label class="text-[10px] font-bold uppercase tracking-wider text-grey block mb-1">
                    Panjang Rok/Celana
                </label>
                <div class="relative">
                    <input
                        type="number"
                        id="input-p-rok"
                        class="w-full pl-3 pr-8 py-2 bg-[#F8F7F5] dark:bg-slate-800 text-slate-800 dark:text-white border border-transparent dark:border-slate-700/50 rounded-lg text-xs font-medium focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                    />
                    <span
                        class="absolute inset-y-0 right-3 flex items-center text-[9px] font-bold text-gray-400"
                    >
                        CM
                    </span>
                </div>
            </div>

            <div
                class="pt-4 flex items-center justify-end gap-3 border-t border-gray-100 dark:border-slate-800 mt-6 shrink-0"
            >
                <button
                    type="button"
                    onclick="closeUkuranModal()"
                    class="px-5 py-2.5 text-sm font-bold text-gray-500 hover:bg-gray-100 dark:hover:bg-slate-800 rounded-xl transition"
                >
                    Batal
                </button>
                <button
                    type="submit"
                    id="btnSaveUkuran"
                    class="px-5 py-2.5 text-sm font-bold text-white bg-primary hover:bg-secondary rounded-xl transition shadow-lg shadow-primary/20 flex items-center gap-2"
                >
                    <i class="fas fa-save"></i>
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
