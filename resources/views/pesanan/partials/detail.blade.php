<!-- ========================================================== -->
<!-- 3. VIEW DETAIL (DETAIL PESANAN) -->
<!-- ========================================================== -->
<div id="view-detail" class="hidden space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h1
                class="font-serif text-3xl font-bold text-primary dark:text-white mb-1 tracking-tight"
            >
                Detail Pesanan
            </h1>
            <p class="text-xs text-grey dark:text-slate-400 font-medium">Kelola informasi pelanggan dan progres produksi pesanan pelanggan.</p>
        </div>

        <a
            href="#list"
            class="inline-flex items-center gap-2 px-5 py-2.5 border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-900 rounded-xl text-xs font-bold text-slate-700 dark:text-slate-300 hover:bg-gray-50 dark:hover:bg-slate-800 transition shadow-sm"
        >
            <i class="fas fa-arrow-left"></i>
            Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        <!-- Left Side: Detail & Measurements (2 Columns wide) -->
        <div class="lg:col-span-2 space-y-6">
            <!-- PELANGGAN -->
            <div
                class="bg-white dark:bg-slate-900 border border-[#EFECE6] dark:border-slate-800 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)]"
            >
                <h3
                    class="text-xs font-bold tracking-tight text-slate-800 dark:text-white mb-4 uppercase"
                >
                    Pelanggan
                </h3>

                <div
                    class="flex items-center justify-between p-4 bg-gray-50/50 dark:bg-slate-850 border border-gray-100 dark:border-slate-700 rounded-2xl"
                >
                    <div class="flex items-center gap-3">
                        <div
                            id="detail-customer-avatar"
                            class="w-10 h-10 rounded-full font-bold text-sm flex items-center justify-center text-white bg-primary"
                        >
                            S
                        </div>
                        <div>
                            <span
                                id="detail-customer-name"
                                class="block text-sm font-bold text-slate-800 dark:text-slate-100"
                            >
                                Siti Aminah
                            </span>
                            <span class="block text-[10px] text-gray-400">Profil Pelanggan</span>
                        </div>
                    </div>
                    <div
                        class="w-6 h-6 rounded-full bg-emerald-500 text-white flex items-center justify-center"
                    >
                        <i class="fas fa-check text-xs"></i>
                    </div>
                </div>
            </div>

            <!-- DETAIL PENGUKURAN -->
            <div
                class="bg-white dark:bg-slate-900 border border-[#EFECE6] dark:border-slate-800 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)]"
            >
                <h3
                    class="text-xs font-bold tracking-tight text-slate-800 dark:text-white mb-4 uppercase"
                >
                    Detail Pengukuran
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Lingkar Badan -->
                    <div>
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Lingkar Badan</span>
                        <div class="relative">
                            <input type="text" id="detail-l-badan" disabled class="w-full pr-12 pl-4 py-3 bg-gray-50/50 dark:bg-slate-850 border border-gray-100 dark:border-slate-800 rounded-2xl text-xs text-secondary dark:text-slate-300" />
                            <span class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400">CM</span>
                        </div>
                    </div>

                    <!-- Lingkar Pinggang -->
                    <div>
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Lingkar Pinggang</span>
                        <div class="relative">
                            <input type="text" id="detail-l-pinggang" disabled class="w-full pr-12 pl-4 py-3 bg-gray-50/50 dark:bg-slate-850 border border-gray-100 dark:border-slate-800 rounded-2xl text-xs text-secondary dark:text-slate-300" />
                            <span class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400">CM</span>
                        </div>
                    </div>

                    <!-- Lebar Bahu -->
                    <div>
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Lebar Bahu</span>
                        <div class="relative">
                            <input type="text" id="detail-p-bahu" disabled class="w-full pr-12 pl-4 py-3 bg-gray-50/50 dark:bg-slate-850 border border-gray-100 dark:border-slate-800 rounded-2xl text-xs text-secondary dark:text-slate-300" />
                            <span class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400">CM</span>
                        </div>
                    </div>

                    <!-- Panjang Lengan -->
                    <div>
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Panjang Lengan</span>
                        <div class="relative">
                            <input type="text" id="detail-p-lengan" disabled class="w-full pr-12 pl-4 py-3 bg-gray-50/50 dark:bg-slate-850 border border-gray-100 dark:border-slate-800 rounded-2xl text-xs text-secondary dark:text-slate-300" />
                            <span class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400">CM</span>
                        </div>
                    </div>

                    <!-- Lingkar Lengan -->
                    <div>
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Lingkar Lengan</span>
                        <div class="relative">
                            <input type="text" id="detail-l-lengan" disabled class="w-full pr-12 pl-4 py-3 bg-gray-50/50 dark:bg-slate-850 border border-gray-100 dark:border-slate-800 rounded-2xl text-xs text-secondary dark:text-slate-300" />
                            <span class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400">CM</span>
                        </div>
                    </div>

                    <!-- Lebar Dada -->
                    <div>
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Lebar Dada</span>
                        <div class="relative">
                            <input type="text" id="detail-l-dada" disabled class="w-full pr-12 pl-4 py-3 bg-gray-50/50 dark:bg-slate-850 border border-gray-100 dark:border-slate-800 rounded-2xl text-xs text-secondary dark:text-slate-300" />
                            <span class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400">CM</span>
                        </div>
                    </div>

                    <!-- Lebar Punggung -->
                    <div>
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Lebar Punggung</span>
                        <div class="relative">
                            <input type="text" id="detail-l-punggung" disabled class="w-full pr-12 pl-4 py-3 bg-gray-50/50 dark:bg-slate-850 border border-gray-100 dark:border-slate-800 rounded-2xl text-xs text-secondary dark:text-slate-300" />
                            <span class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400">CM</span>
                        </div>
                    </div>

                    <!-- Lingkar Pinggul -->
                    <div>
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Lingkar Pinggul</span>
                        <div class="relative">
                            <input type="text" id="detail-l-pinggul" disabled class="w-full pr-12 pl-4 py-3 bg-gray-50/50 dark:bg-slate-850 border border-gray-100 dark:border-slate-800 rounded-2xl text-xs text-secondary dark:text-slate-300" />
                            <span class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400">CM</span>
                        </div>
                    </div>

                    <!-- Panjang Baju -->
                    <div>
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Panjang Baju</span>
                        <div class="relative">
                            <input type="text" id="detail-p-baju" disabled class="w-full pr-12 pl-4 py-3 bg-gray-50/50 dark:bg-slate-850 border border-gray-100 dark:border-slate-800 rounded-2xl text-xs text-secondary dark:text-slate-300" />
                            <span class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400">CM</span>
                        </div>
                    </div>

                    <!-- Turun Pinggang -->
                    <div>
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Turun Pinggang</span>
                        <div class="relative">
                            <input type="text" id="detail-t-pinggang" disabled class="w-full pr-12 pl-4 py-3 bg-gray-50/50 dark:bg-slate-850 border border-gray-100 dark:border-slate-800 rounded-2xl text-xs text-secondary dark:text-slate-300" />
                            <span class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400">CM</span>
                        </div>
                    </div>

                    <!-- Turun Susu -->
                    <div>
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Turun Susu</span>
                        <div class="relative">
                            <input type="text" id="detail-t-susu" disabled class="w-full pr-12 pl-4 py-3 bg-gray-50/50 dark:bg-slate-850 border border-gray-100 dark:border-slate-800 rounded-2xl text-xs text-secondary dark:text-slate-300" />
                            <span class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400">CM</span>
                        </div>
                    </div>

                    <!-- Lingkar Ketiak -->
                    <div>
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Lingkar Ketiak</span>
                        <div class="relative">
                            <input type="text" id="detail-l-ketiak" disabled class="w-full pr-12 pl-4 py-3 bg-gray-50/50 dark:bg-slate-850 border border-gray-100 dark:border-slate-800 rounded-2xl text-xs text-secondary dark:text-slate-300" />
                            <span class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400">CM</span>
                        </div>
                    </div>

                    <!-- Panjang Rok/Celana -->
                    <div>
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Panjang Rok/Celana</span>
                        <div class="relative">
                            <input type="text" id="detail-p-rok" disabled class="w-full pr-12 pl-4 py-3 bg-gray-50/50 dark:bg-slate-850 border border-gray-100 dark:border-slate-800 rounded-2xl text-xs text-secondary dark:text-slate-300" />
                            <span class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400">CM</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DETAIL PESANAN -->
            <div
                class="bg-white dark:bg-slate-900 border border-[#EFECE6] dark:border-slate-800 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)]"
            >
                <h3
                    class="text-xs font-bold tracking-tight text-slate-800 dark:text-white mb-4 uppercase"
                >
                    Detail Pesanan
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <span
                            class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1"
                        >
                            Jenis Pesanan
                        </span>
                        <div
                            class="py-3 px-4 bg-gray-50/50 dark:bg-slate-850 rounded-2xl border border-gray-100 dark:border-slate-800 text-xs font-bold text-slate-800 dark:text-slate-200"
                            id="detail-display-type"
                        >
                            Gamis Syar'i
                        </div>
                    </div>
                    <div>
                        <span
                            class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1"
                        >
                            Jumlah Pesanan
                        </span>
                        <div
                            class="py-3 px-4 bg-gray-50/50 dark:bg-slate-850 rounded-2xl border border-gray-100 dark:border-slate-800 text-xs font-bold text-slate-800 dark:text-slate-200"
                            id="detail-display-quantity"
                        >
                            1
                        </div>
                    </div>
                    <div>
                        <span
                            class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1"
                        >
                            Tanggal Masuk
                        </span>
                        <div
                            class="py-3 px-4 bg-gray-50/50 dark:bg-slate-850 rounded-2xl border border-gray-100 dark:border-slate-800 text-xs font-bold text-slate-800 dark:text-slate-200"
                            id="detail-display-start-date"
                        >
                            17 Agustus 2026
                        </div>
                    </div>
                    <div>
                        <span
                            class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1"
                        >
                            Tenggat Waktu
                        </span>
                        <div
                            class="py-3 px-4 bg-gray-50/50 dark:bg-slate-850 rounded-2xl border border-gray-100 dark:border-slate-800 text-xs font-bold text-slate-800 dark:text-slate-200"
                            id="detail-display-deadline"
                        >
                            25 Agustus 2026
                        </div>
                    </div>
                    <div class="md:col-span-1">
                        <span
                            class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1"
                        >
                            Harga
                        </span>
                        <div
                            class="py-3 px-4 bg-gray-50/50 dark:bg-slate-850 rounded-2xl border border-gray-100 dark:border-slate-800 text-xs font-bold text-slate-800 dark:text-slate-200"
                            id="detail-display-price"
                        >
                            Rp250.000
                        </div>
                    </div>
                </div>
            </div>

            <!-- CATATAN TAMBAHAN -->
            <div
                class="bg-white dark:bg-slate-900 border border-[#EFECE6] dark:border-slate-800 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)]"
            >
                <h3
                    class="text-xs font-bold tracking-tight text-slate-800 dark:text-white mb-4 uppercase"
                >
                    Catatan Tambahan
                </h3>
                <div
                    class="py-4 px-4 bg-gray-50/50 dark:bg-slate-850 border border-gray-100 dark:border-slate-800 rounded-2xl text-xs text-gray-600 dark:text-slate-300"
                    id="detail-display-notes"
                >
                    Tidak ada catatan tambahan
                </div>
            </div>
        </div>

        <!-- Right Side: Status Progress & History Timeline (1 Column wide) -->
        <div class="space-y-6">
            <!-- FOTO REFERENSI -->
            <div
                class="bg-white dark:bg-slate-900 border border-[#EFECE6] dark:border-slate-800 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)]"
            >
                <h3
                    class="text-xs font-bold tracking-tight text-slate-800 dark:text-white mb-4 uppercase"
                >
                    Foto Referensi
                </h3>
                <div
                    class="relative overflow-hidden rounded-2xl border border-gray-100 dark:border-slate-800 bg-gray-50 dark:bg-slate-850 min-h-[220px] flex items-center justify-center"
                >
                    <img
                        id="detail-photo-preview"
                        src="https://images.unsplash.com/photo-1583391733956-3750e0ff4e8b?q=80&w=400"
                        alt="Foto Referensi"
                        class="w-full max-h-72 object-cover"
                    />
                </div>
            </div>

            <!-- UPDATE STATUS PENGERJAAN -->
            <div
                class="bg-white dark:bg-slate-900 border border-[#EFECE6] dark:border-slate-800 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)]"
            >
                <h3
                    class="text-xs font-bold tracking-tight text-slate-800 dark:text-white mb-4 uppercase"
                >
                    Update Status Pengerjaan
                </h3>

                <div class="space-y-4">
                    <div>
                        <label
                            for="detail-update-status"
                            class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5"
                        >
                            Jumlah Pesanan Status
                        </label>
                        <select
                            id="detail-update-status"
                            class="w-full px-4 py-3 bg-background dark:bg-slate-800 border border-[#EFECE6]/80 dark:border-slate-700/80 rounded-2xl text-xs text-secondary dark:text-white focus:outline-none focus:border-primary transition"
                        >
                            <option value="MENUNGGU">Menunggu</option>
                            <option value="PEMOTONGAN">Pemotongan</option>
                            <option value="PENJAHITAN">Penjahitan</option>
                            <option value="PENYELESAIAN">Penyelesaian</option>
                            <option value="SELESAI">Selesai</option>
                        </select>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label
                                for="detail-update-progress"
                                class="block text-[10px] font-bold uppercase tracking-wider text-gray-400"
                            >
                                PROGRESS
                            </label>
                            <span
                                class="text-xs font-bold text-slate-800 dark:text-slate-200"
                                id="detail-update-progress-label"
                            >
                                65%
                            </span>
                        </div>
                        <input
                            type="range"
                            id="detail-update-progress"
                            min="0"
                            max="100"
                            class="w-full h-1 bg-gray-200 dark:bg-slate-800 rounded-lg appearance-none cursor-pointer accent-primary"
                        />
                    </div>

                    <button
                        type="button"
                        onclick="updateOrderStatus()"
                        class="w-full flex items-center justify-center gap-2 py-3 bg-primary hover:bg-secondary text-accent font-bold text-xs rounded-xl shadow-lg transition duration-200"
                    >
                        <i class="fa-regular fa-floppy-disk"></i>
                        Perbarui Status
                    </button>
                </div>
            </div>

            <!-- RIWAYAT STATUS -->
            <div
                class="bg-white dark:bg-slate-900 border border-[#EFECE6] dark:border-slate-800 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)]"
            >
                <h3
                    class="text-xs font-bold tracking-tight text-slate-800 dark:text-white mb-4 uppercase"
                >
                    Riwayat Status
                </h3>

                <div
                    class="relative border-l-2 border-gray-100 dark:border-slate-800 ml-2 pl-4 space-y-6"
                    id="detail-timeline"
                >
                    <!-- Timeline items loaded dynamically -->
                </div>

                <button
                    type="button"
                    class="w-full text-center text-xs font-bold text-slate-400 hover:text-primary transition flex items-center justify-center gap-1 mt-6"
                >
                    Lihat Semua Riwayat
                    <i class="fas fa-chevron-down text-[9px]"></i>
                </button>
            </div>
        </div>
    </div>
</div>
