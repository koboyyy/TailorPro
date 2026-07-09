<!-- ========================================================== -->
<!-- 2. VIEW FORM (TAMBAH / EDIT PESANAN) -->
<!-- ========================================================== -->
<div id="view-form" class="hidden space-y-6">
    <div class="mb-6">
        <h1
            id="form-title"
            class="font-serif text-3xl font-bold text-primary dark:text-white mb-1 tracking-tight"
        >
            Tambah Pesanan Baru
        </h1>
        <p id="form-subtitle" class="text-xs text-grey dark:text-slate-400 font-medium">Lengkapi profil pesanan baju pelanggan</p>
    </div>

    <form
        id="order-form"
        action="{{ route('pesanan.store') }}"
        method="POST"
        class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start"
    >
        @csrf

        <input type="hidden" name="id" id="form-order-id" />
        <input type="hidden" name="pelanggan_id" id="form-pelanggan-id" />
        <input type="hidden" name="photo_reference" id="form-photo-base64" />

        <div class="lg:col-span-2 space-y-6">
            <div
                class="bg-white dark:bg-slate-900 border border-[#EFECE6] dark:border-slate-800 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)]"
            >
                <div class="flex justify-between items-center mb-4">
                    <h3
                        class="text-xs font-bold tracking-tight text-slate-800 dark:text-white uppercase"
                    >
                        Pilih Pelanggan
                    </h3>
                    <button
                        type="button"
                        onclick="openQuickCustomerModal()"
                        class="text-xs text-primary dark:text-accent hover:text-secondary dark:hover:text-accent/80 font-bold flex items-center gap-1.5 transition"
                    >
                        <i class="fas fa-plus-circle text-xs"></i>
                        <span>Pelanggan Baru</span>
                    </button>
                </div>

                <div class="space-y-4">
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

                        <div
                            id="customer-search-results"
                            class="hidden absolute left-0 right-0 mt-2 bg-white dark:bg-slate-850 border border-gray-100 dark:border-slate-700 rounded-2xl shadow-xl py-1.5 max-h-48 overflow-y-auto z-40"
                        ></div>
                    </div>

                    <div
                        id="selected-customer-display"
                        class="hidden flex items-center justify-between p-4 bg-gray-50/50 dark:bg-slate-850 border border-gray-100 dark:border-slate-700 rounded-2xl"
                    >
                        <div class="flex items-center gap-3">
                            <div
                                id="selected-customer-avatar"
                                class="w-10 h-10 rounded-full font-bold text-sm flex items-center justify-center text-white"
                            >
                                S
                            </div>
                            <div>
                                <span
                                    id="selected-customer-name"
                                    class="block text-sm font-bold text-slate-800 dark:text-slate-100"
                                >
                                    Siti Aminah
                                </span>
                                <span class="block text-[10px] text-gray-400">
                                    Profil Pelanggan Terpilih
                                </span>
                            </div>
                        </div>
                        <button
                            type="button"
                            onclick="clearSelectedCustomer()"
                            class="text-xs text-red-500 hover:text-red-700 font-semibold px-3 py-1.5 rounded-lg hover:bg-red-50 dark:hover:bg-red-950/20 transition"
                        >
                            Ubah
                        </button>
                    </div>
                </div>
            </div>

            <div
                class="bg-white dark:bg-slate-900 border border-[#EFECE6] dark:border-slate-800 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)]"
            >
                <h3
                    class="text-xs font-bold tracking-tight text-slate-800 dark:text-white mb-4 uppercase"
                >
                    Detail Pesanan
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-1">
                        <label
                            for="input-type"
                            class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5"
                        >
                            Jenis Pesanan
                        </label>
                        <input
                            type="text"
                            id="input-type"
                            name="type"
                            required
                            placeholder="Gamis Syar'i"
                            class="w-full px-4 py-3 bg-background dark:bg-slate-800 border border-[#EFECE6]/80 dark:border-slate-700/80 rounded-2xl text-xs text-secondary dark:text-white focus:outline-none focus:border-primary transition"
                        />
                    </div>

                    <div>
                        <label
                            for="input-quantity"
                            class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5"
                        >
                            Jumlah Pesanan
                        </label>
                        <input
                            type="number"
                            id="input-quantity"
                            name="quantity"
                            value="1"
                            required
                            class="w-full px-4 py-3 bg-background dark:bg-slate-800 border border-[#EFECE6]/80 dark:border-slate-700/80 rounded-2xl text-xs text-secondary dark:text-white focus:outline-none focus:border-primary transition"
                        />
                    </div>

                    <div>
                        <label
                            for="input-start-date"
                            class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5"
                        >
                            Tanggal Masuk
                        </label>
                        <input
                            type="date"
                            id="input-start-date"
                            name="start_date"
                            required
                            class="w-full px-4 py-3 bg-background dark:bg-slate-800 border border-[#EFECE6]/80 dark:border-slate-700/80 rounded-2xl text-xs text-secondary dark:text-white focus:outline-none focus:border-primary transition"
                        />
                    </div>

                    <div>
                        <label
                            for="input-deadline"
                            class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5"
                        >
                            Tenggat Waktu
                        </label>
                        <input
                            type="date"
                            id="input-deadline"
                            name="deadline"
                            required
                            class="w-full px-4 py-3 bg-background dark:bg-slate-800 border border-[#EFECE6]/80 dark:border-slate-700/80 rounded-2xl text-xs text-secondary dark:text-white focus:outline-none focus:border-primary transition"
                        />
                    </div>

                    <div class="md:col-span-1">
                        <label
                            for="input-price"
                            class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5"
                        >
                            Harga
                        </label>
                        <div class="relative">
                            <span
                                class="absolute inset-y-0 left-4 flex items-center text-xs font-semibold text-gray-400"
                            >
                                Rp
                            </span>
                            <input
                                type="text"
                                id="input-price"
                                name="price"
                                required
                                placeholder="250.000"
                                class="w-full pl-10 pr-4 py-3 bg-background dark:bg-slate-800 border border-[#EFECE6]/80 dark:border-slate-700/80 rounded-2xl text-xs text-secondary dark:text-white focus:outline-none focus:border-primary transition"
                            />
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="bg-white dark:bg-slate-900 border border-[#EFECE6] dark:border-slate-800 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)]"
            >
                <h3
                    class="text-xs font-bold tracking-tight text-slate-800 dark:text-white mb-4 uppercase"
                >
                    Detail Pengukuran
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label
                            for="input-l-badan"
                            class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5"
                        >
                            Lingkar Badan
                        </label>
                        <div class="relative">
                            <input
                                type="number"
                                id="input-l-badan"
                                name="l_badan"
                                class="w-full pr-12 pl-4 py-3 bg-background dark:bg-slate-800 border border-[#EFECE6]/80 dark:border-slate-700/80 rounded-2xl text-xs text-secondary dark:text-white focus:outline-none focus:border-primary transition"
                            />
                            <span
                                class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400"
                            >
                                CM
                            </span>
                        </div>
                    </div>

                    <div>
                        <label
                            for="input-l-pinggang"
                            class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5"
                        >
                            Lingkar Pinggang
                        </label>
                        <div class="relative">
                            <input
                                type="number"
                                id="input-l-pinggang"
                                name="l_pinggang"
                                class="w-full pr-12 pl-4 py-3 bg-background dark:bg-slate-800 border border-[#EFECE6]/80 dark:border-slate-700/80 rounded-2xl text-xs text-secondary dark:text-white focus:outline-none focus:border-primary transition"
                            />
                            <span
                                class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400"
                            >
                                CM
                            </span>
                        </div>
                    </div>

                    <div>
                        <label
                            for="input-p-bahu"
                            class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5"
                        >
                            Lebar Bahu
                        </label>
                        <div class="relative">
                            <input
                                type="number"
                                id="input-p-bahu"
                                name="p_bahu"
                                class="w-full pr-12 pl-4 py-3 bg-background dark:bg-slate-800 border border-[#EFECE6]/80 dark:border-slate-700/80 rounded-2xl text-xs text-secondary dark:text-white focus:outline-none focus:border-primary transition"
                            />
                            <span
                                class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400"
                            >
                                CM
                            </span>
                        </div>
                    </div>

                    <div>
                        <label
                            for="input-p-lengan"
                            class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5"
                        >
                            Panjang Lengan
                        </label>
                        <div class="relative">
                            <input
                                type="number"
                                id="input-p-lengan"
                                name="p_lengan"
                                class="w-full pr-12 pl-4 py-3 bg-background dark:bg-slate-800 border border-[#EFECE6]/80 dark:border-slate-700/80 rounded-2xl text-xs text-secondary dark:text-white focus:outline-none focus:border-primary transition"
                            />
                            <span
                                class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400"
                            >
                                CM
                            </span>
                        </div>
                    </div>

                    <div>
                        <label
                            for="input-l-lengan"
                            class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5"
                        >
                            Lingkar Lengan
                        </label>
                        <div class="relative">
                            <input
                                type="number"
                                id="input-l-lengan"
                                name="l_lengan"
                                class="w-full pr-12 pl-4 py-3 bg-background dark:bg-slate-800 border border-[#EFECE6]/80 dark:border-slate-700/80 rounded-2xl text-xs text-secondary dark:text-white focus:outline-none focus:border-primary transition"
                            />
                            <span
                                class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400"
                            >
                                CM
                            </span>
                        </div>
                    </div>

                    <div>
                        <label
                            for="input-l-dada"
                            class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5"
                        >
                            Lebar Dada
                        </label>
                        <div class="relative">
                            <input
                                type="number"
                                id="input-l-dada"
                                name="l_dada"
                                class="w-full pr-12 pl-4 py-3 bg-background dark:bg-slate-800 border border-[#EFECE6]/80 dark:border-slate-700/80 rounded-2xl text-xs text-secondary dark:text-white focus:outline-none focus:border-primary transition"
                            />
                            <span
                                class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400"
                            >
                                CM
                            </span>
                        </div>
                    </div>

                    <div>
                        <label
                            for="input-l-punggung"
                            class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5"
                        >
                            Lebar Punggung
                        </label>
                        <div class="relative">
                            <input
                                type="number"
                                id="input-l-punggung"
                                name="l_punggung"
                                class="w-full pr-12 pl-4 py-3 bg-background dark:bg-slate-800 border border-[#EFECE6]/80 dark:border-slate-700/80 rounded-2xl text-xs text-secondary dark:text-white focus:outline-none focus:border-primary transition"
                            />
                            <span
                                class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400"
                            >
                                CM
                            </span>
                        </div>
                    </div>

                    <div>
                        <label
                            for="input-l-pinggul"
                            class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5"
                        >
                            Lingkar Pinggul
                        </label>
                        <div class="relative">
                            <input
                                type="number"
                                id="input-l-pinggul"
                                name="l_pinggul"
                                class="w-full pr-12 pl-4 py-3 bg-background dark:bg-slate-800 border border-[#EFECE6]/80 dark:border-slate-700/80 rounded-2xl text-xs text-secondary dark:text-white focus:outline-none focus:border-primary transition"
                            />
                            <span
                                class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400"
                            >
                                CM
                            </span>
                        </div>
                    </div>

                    <div>
                        <label
                            for="input-p-baju"
                            class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5"
                        >
                            Panjang Baju
                        </label>
                        <div class="relative">
                            <input
                                type="number"
                                id="input-p-baju"
                                name="p_baju"
                                class="w-full pr-12 pl-4 py-3 bg-background dark:bg-slate-800 border border-[#EFECE6]/80 dark:border-slate-700/80 rounded-2xl text-xs text-secondary dark:text-white focus:outline-none focus:border-primary transition"
                            />
                            <span
                                class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400"
                            >
                                CM
                            </span>
                        </div>
                    </div>

                    <div>
                        <label
                            for="input-t-pinggang"
                            class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5"
                        >
                            Turun Pinggang
                        </label>
                        <div class="relative">
                            <input
                                type="number"
                                id="input-t-pinggang"
                                name="t_pinggang"
                                class="w-full pr-12 pl-4 py-3 bg-background dark:bg-slate-800 border border-[#EFECE6]/80 dark:border-slate-700/80 rounded-2xl text-xs text-secondary dark:text-white focus:outline-none focus:border-primary transition"
                            />
                            <span
                                class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400"
                            >
                                CM
                            </span>
                        </div>
                    </div>

                    <div>
                        <label
                            for="input-t-susu"
                            class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5"
                        >
                            Turun Susu
                        </label>
                        <div class="relative">
                            <input
                                type="number"
                                id="input-t-susu"
                                name="t_susu"
                                class="w-full pr-12 pl-4 py-3 bg-background dark:bg-slate-800 border border-[#EFECE6]/80 dark:border-slate-700/80 rounded-2xl text-xs text-secondary dark:text-white focus:outline-none focus:border-primary transition"
                            />
                            <span
                                class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400"
                            >
                                CM
                            </span>
                        </div>
                    </div>

                    <div>
                        <label
                            for="input-l-ketiak"
                            class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5"
                        >
                            Lingkar Ketiak
                        </label>
                        <div class="relative">
                            <input
                                type="number"
                                id="input-l-ketiak"
                                name="l_ketiak"
                                class="w-full pr-12 pl-4 py-3 bg-background dark:bg-slate-800 border border-[#EFECE6]/80 dark:border-slate-700/80 rounded-2xl text-xs text-secondary dark:text-white focus:outline-none focus:border-primary transition"
                            />
                            <span
                                class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400"
                            >
                                CM
                            </span>
                        </div>
                    </div>

                    <div>
                        <label
                            for="input-p-rok"
                            class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5"
                        >
                            Panjang Rok/Celana
                        </label>
                        <div class="relative">
                            <input
                                type="text"
                                id="input-p-rok"
                                name="p_rok"
                                placeholder="-"
                                class="w-full pr-12 pl-4 py-3 bg-background dark:bg-slate-800 border border-[#EFECE6]/80 dark:border-slate-700/80 rounded-2xl text-xs text-secondary dark:text-white focus:outline-none focus:border-primary transition"
                            />
                            <span
                                class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400"
                            >
                                CM
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div
                class="bg-white dark:bg-slate-900 border border-[#EFECE6] dark:border-slate-800 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)]"
            >
                <h3
                    class="text-xs font-bold tracking-tight text-slate-800 dark:text-white mb-4 uppercase"
                >
                    Foto Referensi
                </h3>

                <div
                    id="image-dropzone"
                    class="border border-dashed border-[#EFECE6] dark:border-slate-800 rounded-2xl p-6 text-center cursor-pointer hover:border-primary dark:hover:border-slate-500 transition min-h-[220px] flex flex-col justify-center items-center"
                >
                    <input type="file" id="form-photo-input" class="hidden" accept="image/*" />
                    <div id="upload-prompt" class="space-y-3">
                        <div
                            class="w-12 h-12 rounded-full bg-gray-50 dark:bg-slate-800 flex items-center justify-center mx-auto text-gray-400"
                        >
                            <i class="fa-regular fa-image text-lg"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-800 dark:text-slate-200">Klik untuk unggah atau tarik foto ke sini</p>
                            <p class="text-[10px] text-gray-400 mt-1">PNG, JPG atau WEBP (Maksimal. 5mb)</p>
                        </div>
                    </div>
                    <img
                        id="form-photo-preview"
                        class="hidden w-full max-h-56 object-cover rounded-xl mt-2 border border-gray-100 dark:border-slate-800"
                    />
                </div>
            </div>

            <div
                class="bg-white dark:bg-slate-900 border border-[#EFECE6] dark:border-slate-800 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)]"
            >
                <h3
                    class="text-xs font-bold tracking-tight text-slate-800 dark:text-white mb-4 uppercase"
                >
                    Catatan Tambahan
                </h3>
                <textarea
                    id="input-notes"
                    name="notes"
                    rows="4"
                    class="w-full px-4 py-3 bg-background dark:bg-slate-800 border border-[#EFECE6]/80 dark:border-slate-700/80 rounded-2xl text-xs text-secondary dark:text-white focus:outline-none focus:border-primary transition"
                    placeholder="Tidak ada catatan tambahan"
                ></textarea>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <a
                    href="#list"
                    class="flex-1 text-center py-3 border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-900 rounded-xl text-xs font-bold text-slate-700 dark:text-slate-300 hover:bg-gray-50 dark:hover:bg-slate-800 transition shadow-sm"
                >
                    Batal
                </a>
                <button
                    type="submit"
                    onclick="return validasiForm(event);"
                    class="flex-1 flex items-center justify-center gap-2 py-3 bg-primary hover:bg-secondary text-accent font-bold text-xs rounded-xl shadow-lg shadow-primary/10 transition duration-200"
                >
                    <i class="fas fa-save"></i>
                    Simpan Pesanan
                </button>
            </div>
        </div>
    </form>
</div>
