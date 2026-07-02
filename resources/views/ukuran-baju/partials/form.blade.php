<<<<<<< HEAD
<section id="form-panel" class="bg-white dark:bg-surface rounded-2xl border border-[#EFECE6] dark:border-surface shadow-[0_8px_30px_rgb(0,0,0,0.02)] p-6 transition-all duration-300">
    <!-- Form Header -->
    <div class="flex items-center justify-between border-b border-[#EFECE6]/80 dark:border-surface pb-4 mb-6">
        <h3 id="form-title" class="text-sm font-bold tracking-tight text-primary dark:text-on-surface">Edit Detail Ukuran</h3>
        <span id="form-badge" class="bg-[#F2ECE4] dark:bg-surface text-[#4A3A2A] dark:text-accent text-[9px] font-bold tracking-wider px-2.5 py-1 rounded uppercase">
=======
<section
    id="form-panel"
    class="bg-white dark:bg-slate-900 rounded-2xl border border-[#EFECE6] dark:border-slate-800 shadow-[0_8px_30px_rgb(0,0,0,0.02)] p-6 transition-all duration-300"
>
    <!-- Form Header -->
    <div
        class="flex items-center justify-between border-b border-[#EFECE6]/80 dark:border-slate-800/80 pb-4 mb-6"
    >
        <h3 id="form-title" class="text-sm font-bold tracking-tight text-primary dark:text-white">
            Edit Detail Ukuran
        </h3>
        <span
            id="form-badge"
            class="bg-[#F2ECE4] dark:bg-slate-800 text-[#4A3A2A] dark:text-accent text-[9px] font-bold tracking-wider px-2.5 py-1 rounded uppercase"
        >
>>>>>>> origin/main
            BUDI NUGRAHA
        </span>
    </div>

    <!-- Input Form fields -->
    <form id="measurement-form" class="space-y-4">
        <!-- Dynamic Name Field (Visible when adding new customer) -->
        <div id="customer-name-group" class="hidden">
<<<<<<< HEAD
            <label for="input-name" class="text-[10px] font-bold uppercase tracking-wider text-grey block mb-1">Nama Lengkap Pelanggan</label>
            <input type="text" id="input-name" placeholder="Contoh: Budi Nugraha" class="w-full px-3 py-2 bg-[#F8F7F5] dark:bg-surface text-slate-800 dark:text-on-surface border border-transparent dark:border-surface/50 rounded-lg text-xs font-medium placeholder-gray-400 focus:outline-none focus:bg-white dark:focus:bg-slate-900 focus:border-primary focus:ring-1 focus:ring-primary transition duration-200">
=======
            <label
                for="input-name"
                class="text-[10px] font-bold uppercase tracking-wider text-grey block mb-1"
                >Nama Lengkap Pelanggan</label
            >
            <input
                type="text"
                id="input-name"
                placeholder="Contoh: Budi Nugraha"
                class="w-full px-3 py-2 bg-[#F8F7F5] dark:bg-slate-800 text-slate-800 dark:text-white border border-transparent dark:border-slate-700/50 rounded-lg text-xs font-medium placeholder-gray-400 focus:outline-none focus:bg-white dark:focus:bg-slate-900 focus:border-primary focus:ring-1 focus:ring-primary transition duration-200"
            />
>>>>>>> origin/main
        </div>

        <!-- Grid of Measurements -->
        <div class="grid grid-cols-2 gap-4">
            <!-- Lingkar Badan -->
            <div>
                <label
                    for="input-l-badan"
                    class="text-[10px] font-bold uppercase tracking-wider text-grey block mb-1"
                    >Lingkar Badan</label
                >
                <div class="relative">
<<<<<<< HEAD
                    <input type="number" id="input-l-badan" class="w-full pl-3 pr-8 py-2 bg-[#F8F7F5] dark:bg-surface text-slate-800 dark:text-on-surface border border-transparent dark:border-surface/50 rounded-lg text-xs font-medium focus:outline-none focus:bg-white dark:focus:bg-slate-900 focus:border-primary focus:ring-1 focus:ring-primary transition duration-200" required>
                    <span class="absolute inset-y-0 right-3 flex items-center text-[9px] font-bold text-gray-400">CM</span>
=======
                    <input
                        type="number"
                        id="input-l-badan"
                        class="w-full pl-3 pr-8 py-2 bg-[#F8F7F5] dark:bg-slate-800 text-slate-800 dark:text-white border border-transparent dark:border-slate-700/50 rounded-lg text-xs font-medium focus:outline-none focus:bg-white dark:focus:bg-slate-900 focus:border-primary focus:ring-1 focus:ring-primary transition duration-200"
                        required
                    />
                    <span
                        class="absolute inset-y-0 right-3 flex items-center text-[9px] font-bold text-gray-400"
                        >CM</span
                    >
>>>>>>> origin/main
                </div>
            </div>

            <!-- Lingkar Pinggang -->
            <div>
                <label
                    for="input-l-pinggang"
                    class="text-[10px] font-bold uppercase tracking-wider text-grey block mb-1"
                    >Lingkar Pinggang</label
                >
                <div class="relative">
<<<<<<< HEAD
                    <input type="number" id="input-l-pinggang" class="w-full pl-3 pr-8 py-2 bg-[#F8F7F5] dark:bg-surface text-slate-800 dark:text-on-surface border border-transparent dark:border-surface/50 rounded-lg text-xs font-medium focus:outline-none focus:bg-white dark:focus:bg-slate-900 focus:border-primary focus:ring-1 focus:ring-primary transition duration-200" required>
                    <span class="absolute inset-y-0 right-3 flex items-center text-[9px] font-bold text-gray-400">CM</span>
=======
                    <input
                        type="number"
                        id="input-l-pinggang"
                        class="w-full pl-3 pr-8 py-2 bg-[#F8F7F5] dark:bg-slate-800 text-slate-800 dark:text-white border border-transparent dark:border-slate-700/50 rounded-lg text-xs font-medium focus:outline-none focus:bg-white dark:focus:bg-slate-900 focus:border-primary focus:ring-1 focus:ring-primary transition duration-200"
                        required
                    />
                    <span
                        class="absolute inset-y-0 right-3 flex items-center text-[9px] font-bold text-gray-400"
                        >CM</span
                    >
>>>>>>> origin/main
                </div>
            </div>

            <!-- Lebar Punggung -->
            <div>
                <label
                    for="input-l-punggung"
                    class="text-[10px] font-bold uppercase tracking-wider text-grey block mb-1"
                    >Lebar Punggung</label
                >
                <div class="relative">
<<<<<<< HEAD
                    <input type="number" id="input-l-punggung" class="w-full pl-3 pr-8 py-2 bg-[#F8F7F5] dark:bg-surface text-slate-800 dark:text-on-surface border border-transparent dark:border-surface/50 rounded-lg text-xs font-medium focus:outline-none focus:bg-white dark:focus:bg-slate-900 focus:border-primary focus:ring-1 focus:ring-primary transition duration-200" required>
                    <span class="absolute inset-y-0 right-3 flex items-center text-[9px] font-bold text-gray-400">CM</span>
=======
                    <input
                        type="number"
                        id="input-l-punggung"
                        class="w-full pl-3 pr-8 py-2 bg-[#F8F7F5] dark:bg-slate-800 text-slate-800 dark:text-white border border-transparent dark:border-slate-700/50 rounded-lg text-xs font-medium focus:outline-none focus:bg-white dark:focus:bg-slate-900 focus:border-primary focus:ring-1 focus:ring-primary transition duration-200"
                        required
                    />
                    <span
                        class="absolute inset-y-0 right-3 flex items-center text-[9px] font-bold text-gray-400"
                        >CM</span
                    >
>>>>>>> origin/main
                </div>
            </div>

            <!-- Panjang Bahu -->
            <div>
                <label
                    for="input-p-bahu"
                    class="text-[10px] font-bold uppercase tracking-wider text-grey block mb-1"
                    >Panjang Bahu</label
                >
                <div class="relative">
<<<<<<< HEAD
                    <input type="number" id="input-p-bahu" class="w-full pl-3 pr-8 py-2 bg-[#F8F7F5] dark:bg-surface text-slate-800 dark:text-on-surface border border-transparent dark:border-surface/50 rounded-lg text-xs font-medium focus:outline-none focus:bg-white dark:focus:bg-slate-900 focus:border-primary focus:ring-1 focus:ring-primary transition duration-200" required>
                    <span class="absolute inset-y-0 right-3 flex items-center text-[9px] font-bold text-gray-400">CM</span>
=======
                    <input
                        type="number"
                        id="input-p-bahu"
                        class="w-full pl-3 pr-8 py-2 bg-[#F8F7F5] dark:bg-slate-800 text-slate-800 dark:text-white border border-transparent dark:border-slate-700/50 rounded-lg text-xs font-medium focus:outline-none focus:bg-white dark:focus:bg-slate-900 focus:border-primary focus:ring-1 focus:ring-primary transition duration-200"
                        required
                    />
                    <span
                        class="absolute inset-y-0 right-3 flex items-center text-[9px] font-bold text-gray-400"
                        >CM</span
                    >
>>>>>>> origin/main
                </div>
            </div>

            <!-- Panjang Lengan -->
            <div>
                <label
                    for="input-p-lengan"
                    class="text-[10px] font-bold uppercase tracking-wider text-grey block mb-1"
                    >Panjang Lengan</label
                >
                <div class="relative">
<<<<<<< HEAD
                    <input type="number" id="input-p-lengan" class="w-full pl-3 pr-8 py-2 bg-[#F8F7F5] dark:bg-surface text-slate-800 dark:text-on-surface border border-transparent dark:border-surface/50 rounded-lg text-xs font-medium focus:outline-none focus:bg-white dark:focus:bg-slate-900 focus:border-primary focus:ring-1 focus:ring-primary transition duration-200" required>
                    <span class="absolute inset-y-0 right-3 flex items-center text-[9px] font-bold text-gray-400">CM</span>
=======
                    <input
                        type="number"
                        id="input-p-lengan"
                        class="w-full pl-3 pr-8 py-2 bg-[#F8F7F5] dark:bg-slate-800 text-slate-800 dark:text-white border border-transparent dark:border-slate-700/50 rounded-lg text-xs font-medium focus:outline-none focus:bg-white dark:focus:bg-slate-900 focus:border-primary focus:ring-1 focus:ring-primary transition duration-200"
                        required
                    />
                    <span
                        class="absolute inset-y-0 right-3 flex items-center text-[9px] font-bold text-gray-400"
                        >CM</span
                    >
>>>>>>> origin/main
                </div>
            </div>

            <!-- Lingkar Lengan -->
            <div>
                <label
                    for="input-l-lengan"
                    class="text-[10px] font-bold uppercase tracking-wider text-grey block mb-1"
                    >Lingkar Lengan</label
                >
                <div class="relative">
<<<<<<< HEAD
                    <input type="number" id="input-l-lengan" class="w-full pl-3 pr-8 py-2 bg-[#F8F7F5] dark:bg-surface text-slate-800 dark:text-on-surface border border-transparent dark:border-surface/50 rounded-lg text-xs font-medium focus:outline-none focus:bg-white dark:focus:bg-slate-900 focus:border-primary focus:ring-1 focus:ring-primary transition duration-200" required>
                    <span class="absolute inset-y-0 right-3 flex items-center text-[9px] font-bold text-gray-400">CM</span>
=======
                    <input
                        type="number"
                        id="input-l-lengan"
                        class="w-full pl-3 pr-8 py-2 bg-[#F8F7F5] dark:bg-slate-800 text-slate-800 dark:text-white border border-transparent dark:border-slate-700/50 rounded-lg text-xs font-medium focus:outline-none focus:bg-white dark:focus:bg-slate-900 focus:border-primary focus:ring-1 focus:ring-primary transition duration-200"
                        required
                    />
                    <span
                        class="absolute inset-y-0 right-3 flex items-center text-[9px] font-bold text-gray-400"
                        >CM</span
                    >
>>>>>>> origin/main
                </div>
            </div>

            <!-- Turun Susu -->
            <div>
                <label
                    for="input-t-susu"
                    class="text-[10px] font-bold uppercase tracking-wider text-grey block mb-1"
                    >Turun Susu/Tetek</label
                >
                <div class="relative">
<<<<<<< HEAD
                    <input type="number" id="input-t-susu" class="w-full pl-3 pr-8 py-2 bg-[#F8F7F5] dark:bg-surface text-slate-800 dark:text-on-surface border border-transparent dark:border-surface/50 rounded-lg text-xs font-medium focus:outline-none focus:bg-white dark:focus:bg-slate-900 focus:border-primary focus:ring-1 focus:ring-primary transition duration-200" required>
                    <span class="absolute inset-y-0 right-3 flex items-center text-[9px] font-bold text-gray-400">CM</span>
=======
                    <input
                        type="number"
                        id="input-t-susu"
                        class="w-full pl-3 pr-8 py-2 bg-[#F8F7F5] dark:bg-slate-800 text-slate-800 dark:text-white border border-transparent dark:border-slate-700/50 rounded-lg text-xs font-medium focus:outline-none focus:bg-white dark:focus:bg-slate-900 focus:border-primary focus:ring-1 focus:ring-primary transition duration-200"
                        required
                    />
                    <span
                        class="absolute inset-y-0 right-3 flex items-center text-[9px] font-bold text-gray-400"
                        >CM</span
                    >
>>>>>>> origin/main
                </div>
            </div>

            <!-- Turun Pinggang -->
            <div>
                <label
                    for="input-t-pinggang"
                    class="text-[10px] font-bold uppercase tracking-wider text-grey block mb-1"
                    >Turun Pinggang</label
                >
                <div class="relative">
<<<<<<< HEAD
                    <input type="number" id="input-t-pinggang" class="w-full pl-3 pr-8 py-2 bg-[#F8F7F5] dark:bg-surface text-slate-800 dark:text-on-surface border border-transparent dark:border-surface/50 rounded-lg text-xs font-medium focus:outline-none focus:bg-white dark:focus:bg-slate-900 focus:border-primary focus:ring-1 focus:ring-primary transition duration-200" required>
                    <span class="absolute inset-y-0 right-3 flex items-center text-[9px] font-bold text-gray-400">CM</span>
=======
                    <input
                        type="number"
                        id="input-t-pinggang"
                        class="w-full pl-3 pr-8 py-2 bg-[#F8F7F5] dark:bg-slate-800 text-slate-800 dark:text-white border border-transparent dark:border-slate-700/50 rounded-lg text-xs font-medium focus:outline-none focus:bg-white dark:focus:bg-slate-900 focus:border-primary focus:ring-1 focus:ring-primary transition duration-200"
                        required
                    />
                    <span
                        class="absolute inset-y-0 right-3 flex items-center text-[9px] font-bold text-gray-400"
                        >CM</span
                    >
>>>>>>> origin/main
                </div>
            </div>

            <!-- Lingkar Pinggul -->
            <div>
                <label
                    for="input-l-pinggul"
                    class="text-[10px] font-bold uppercase tracking-wider text-grey block mb-1"
                    >Lingkar Pinggul</label
                >
                <div class="relative">
<<<<<<< HEAD
                    <input type="number" id="input-l-pinggul" class="w-full pl-3 pr-8 py-2 bg-[#F8F7F5] dark:bg-surface text-slate-800 dark:text-on-surface border border-transparent dark:border-surface/50 rounded-lg text-xs font-medium focus:outline-none focus:bg-white dark:focus:bg-slate-900 focus:border-primary focus:ring-1 focus:ring-primary transition duration-200" required>
                    <span class="absolute inset-y-0 right-3 flex items-center text-[9px] font-bold text-gray-400">CM</span>
=======
                    <input
                        type="number"
                        id="input-l-pinggul"
                        class="w-full pl-3 pr-8 py-2 bg-[#F8F7F5] dark:bg-slate-800 text-slate-800 dark:text-white border border-transparent dark:border-slate-700/50 rounded-lg text-xs font-medium focus:outline-none focus:bg-white dark:focus:bg-slate-900 focus:border-primary focus:ring-1 focus:ring-primary transition duration-200"
                        required
                    />
                    <span
                        class="absolute inset-y-0 right-3 flex items-center text-[9px] font-bold text-gray-400"
                        >CM</span
                    >
>>>>>>> origin/main
                </div>
            </div>

            <!-- Panjang Baju -->
            <div>
                <label
                    for="input-p-baju"
                    class="text-[10px] font-bold uppercase tracking-wider text-grey block mb-1"
                    >Panjang Baju</label
                >
                <div class="relative">
<<<<<<< HEAD
                    <input type="number" id="input-p-baju" class="w-full pl-3 pr-8 py-2 bg-[#F8F7F5] dark:bg-surface text-slate-800 dark:text-on-surface border border-transparent dark:border-surface/50 rounded-lg text-xs font-medium focus:outline-none focus:bg-white dark:focus:bg-slate-900 focus:border-primary focus:ring-1 focus:ring-primary transition duration-200" required>
                    <span class="absolute inset-y-0 right-3 flex items-center text-[9px] font-bold text-gray-400">CM</span>
=======
                    <input
                        type="number"
                        id="input-p-baju"
                        class="w-full pl-3 pr-8 py-2 bg-[#F8F7F5] dark:bg-slate-800 text-slate-800 dark:text-white border border-transparent dark:border-slate-700/50 rounded-lg text-xs font-medium focus:outline-none focus:bg-white dark:focus:bg-slate-900 focus:border-primary focus:ring-1 focus:ring-primary transition duration-200"
                        required
                    />
                    <span
                        class="absolute inset-y-0 right-3 flex items-center text-[9px] font-bold text-gray-400"
                        >CM</span
                    >
>>>>>>> origin/main
                </div>
            </div>
        </div>

        <!-- Panjang Rok (Full width span) -->
        <div>
            <label
                for="input-p-rok"
                class="text-[10px] font-bold uppercase tracking-wider text-grey block mb-1"
                >Panjang Rok</label
            >
            <div class="relative">
<<<<<<< HEAD
                <input type="text" id="input-p-rok" placeholder="-" class="w-full pl-3 pr-8 py-2 bg-[#F8F7F5] dark:bg-surface text-slate-800 dark:text-on-surface border border-transparent dark:border-surface/50 rounded-lg text-xs font-medium focus:outline-none focus:bg-white dark:focus:bg-slate-900 focus:border-primary focus:ring-1 focus:ring-primary transition duration-200">
                <span class="absolute inset-y-0 right-3 flex items-center text-[9px] font-bold text-gray-400">CM</span>
=======
                <input
                    type="text"
                    id="input-p-rok"
                    placeholder="-"
                    class="w-full pl-3 pr-8 py-2 bg-[#F8F7F5] dark:bg-slate-800 text-slate-800 dark:text-white border border-transparent dark:border-slate-700/50 rounded-lg text-xs font-medium focus:outline-none focus:bg-white dark:focus:bg-slate-900 focus:border-primary focus:ring-1 focus:ring-primary transition duration-200"
                />
                <span
                    class="absolute inset-y-0 right-3 flex items-center text-[9px] font-bold text-gray-400"
                    >CM</span
                >
>>>>>>> origin/main
            </div>
        </div>

        <!-- Bottom Action Buttons inside Form Card -->
<<<<<<< HEAD
        <div class="flex items-center gap-3 pt-6 border-t border-[#EFECE6]/80 dark:border-surface mt-6">
            <button type="button" id="btn-cancel" class="flex-1 px-4 py-3 border border-[#EFECE6] dark:border-surface bg-white dark:bg-surface text-xs font-semibold rounded-xl text-grey dark:text-on-surface hover:bg-background dark:hover:bg-surface active:scale-98 transition duration-200">
=======
        <div
            class="flex items-center gap-3 pt-6 border-t border-[#EFECE6]/80 dark:border-slate-800 mt-6"
        >
            <button
                type="button"
                id="btn-cancel"
                class="flex-1 px-4 py-3 border border-[#EFECE6] dark:border-slate-700 bg-white dark:bg-slate-800 text-xs font-semibold rounded-xl text-grey dark:text-slate-300 hover:bg-background dark:hover:bg-slate-700 active:scale-98 transition duration-200"
            >
>>>>>>> origin/main
                Batal
            </button>
            <button
                type="submit"
                id="btn-submit"
                class="flex-1 px-4 py-3 bg-primary hover:bg-secondary text-accent text-xs font-semibold rounded-xl shadow-md shadow-primary/15 active:scale-98 transition duration-200"
            >
                Simpan Perubahan
            </button>
        </div>
    </form>
</section>
