<!-- ========================================================== -->
    <!-- 2. VIEW DETAIL (DETAIL TAMPILAN POLA) -->
    <!-- ========================================================== -->
    <div id="view-detail" class="hidden space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
            <div>
                <h1
                    class="font-serif text-3xl font-bold text-primary dark:text-white mb-1 tracking-tight"
                    id="detail-title"
                >
                    Detail Pola Baju
                </h1>
                <p class="text-xs text-grey dark:text-slate-400 font-medium" id="detail-subtitle">Tampilan pola potongan teknis dan rincian ukuran pelanggan.</p>
            </div>

            <a
                href="#list"
                class="inline-flex items-center gap-2 px-5 py-2.5 border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-900 rounded-xl text-xs font-bold text-slate-700 dark:text-slate-300 hover:bg-gray-50 dark:hover:bg-slate-800 transition shadow-sm"
            >
                <i class="fas fa-arrow-left"></i> Kembali ke Arsip
            </a>
        </div>

        <!-- 2 Column Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            <!-- Left Side: Blueprint (2 Columns wide) -->
            <div
                class="lg:col-span-2 bg-white dark:bg-slate-900 border border-[#EFECE6] dark:border-slate-800 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)]"
            >
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2">
                        <span
                            class="w-8 h-8 rounded-lg bg-gray-50 dark:bg-slate-800 flex items-center justify-center text-primary dark:text-accent font-bold font-serif text-sm"
                            >A</span
                        >
                        <div>
                            <h3
                                class="text-sm font-bold tracking-tight text-slate-800 dark:text-white"
                            >
                                Pola Gambar Vektor
                            </h3>
                            <p class="text-[10px] text-gray-400">Berkas SVG Interaktif</p>
                        </div>
                    </div>

                    <!-- SVG Controls -->
                    <div class="flex items-center gap-1.5">
                        <button
                            type="button"
                            onclick="zoomIn()"
                            class="w-8 h-8 rounded-lg bg-gray-50 dark:bg-slate-800 border border-gray-100 dark:border-slate-700 flex items-center justify-center text-gray-400 hover:text-primary transition"
                            title="Perbesar"
                        >
                            <i class="fas fa-search-plus text-xs"></i>
                        </button>
                        <button
                            type="button"
                            onclick="zoomOut()"
                            class="w-8 h-8 rounded-lg bg-gray-50 dark:bg-slate-800 border border-gray-100 dark:border-slate-700 flex items-center justify-center text-gray-400 hover:text-primary transition"
                            title="Perkecil"
                        >
                            <i class="fas fa-search-minus text-xs"></i>
                        </button>
                        <button
                            type="button"
                            onclick="printPattern()"
                            class="w-8 h-8 rounded-lg bg-gray-50 dark:bg-slate-800 border border-gray-100 dark:border-slate-700 flex items-center justify-center text-gray-400 hover:text-primary transition"
                            title="Cetak Pola"
                        >
                            <i class="fas fa-print text-xs"></i>
                        </button>
                        <button
                            type="button"
                            onclick="downloadSVG()"
                            class="w-8 h-8 rounded-lg bg-gray-50 dark:bg-slate-800 border border-gray-100 dark:border-slate-700 flex items-center justify-center text-gray-400 hover:text-primary transition"
                            title="Unduh SVG"
                        >
                            <i class="fas fa-download text-xs"></i>
                        </button>
                    </div>
                </div>

                <div
                    class="blueprint-canvas-container relative w-full h-auto min-h-[430px] rounded-2xl overflow-y-auto border border-[#EFECE6] dark:border-slate-800 flex flex-col items-start justify-center bg-[#FCFCFC] dark:bg-slate-950"
                >
                    <div class="absolute inset-0 blueprint-grid opacity-70"></div>
                    <div
                        id="svg-wrapper"
                        class="relative z-10 w-full min-h-full flex flex-row flex-wrap justify-center items-start gap-12 py-10 transition-transform duration-200"
                        style="transform: scale(1)"
                    >
                        <!-- Loaded dynamically -->
                    </div>
                </div>
            </div>

            <!-- Right Side: Details (1 Column wide) -->
            <div class="space-y-6">
                <!-- PELANGGAN CARD -->
                <div
                    class="bg-white dark:bg-slate-900 border border-[#EFECE6] dark:border-slate-800 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)]"
                >
                    <h3
                        class="text-xs font-bold tracking-tight text-slate-800 dark:text-white mb-4 uppercase"
                    >
                        Pelanggan
                    </h3>

                    <div
                        class="flex items-center justify-between p-3.5 bg-gray-50/50 dark:bg-slate-850 border border-gray-100 dark:border-slate-700 rounded-2xl"
                    >
                        <div class="flex items-center gap-3">
                            <div
                                id="detail-customer-avatar"
                                class="w-10 h-10 rounded-full font-bold text-sm flex items-center justify-center text-white bg-primary"
                            >
                                AS
                            </div>
                            <div>
                                <span
                                    id="detail-customer-name"
                                    class="block text-sm font-bold text-slate-800 dark:text-slate-100"
                                    >Ahmad Subagja</span
                                >
                                <span
                                    id="detail-customer-id"
                                    class="block text-[9px] text-gray-400 mt-0.5"
                                    >ID #T-2204</span
                                >
                            </div>
                        </div>
                        <div
                            class="w-6 h-6 rounded-full bg-emerald-500 text-white flex items-center justify-center"
                        >
                            <i class="fas fa-check text-xs"></i>
                        </div>
                    </div>
                </div>

                <!-- DETAILED SIZES LIST -->
                <div
                    class="bg-white dark:bg-slate-900 border border-[#EFECE6] dark:border-slate-800 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)]"
                >
                    <h3
                        class="text-xs font-bold tracking-tight text-slate-800 dark:text-white mb-4 uppercase"
                    >
                        Rincian Ukuran Pola
                    </h3>
                    <div
                        class="divide-y divide-[#EFECE6]/80 dark:divide-slate-800"
                        id="detail-sizes-list"
                    >
                        <!-- Sizes dynamically loaded -->
                    </div>
                </div>

                <!-- ESTIMASI KAIN -->
                <div
                    class="bg-white dark:bg-slate-900 border border-[#EFECE6] dark:border-slate-800 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)]"
                >
                    <h3
                        class="text-xs font-bold tracking-tight text-slate-800 dark:text-white mb-3 uppercase"
                    >
                        Estimasi Kain Terpakai
                    </h3>
                    <div
                        class="py-4 px-5 bg-gray-50 dark:bg-slate-850 border border-gray-100 dark:border-slate-800 rounded-2xl text-sm font-black text-slate-800 dark:text-white tracking-wider"
                        id="detail-fabric-estimation"
                    >
                        3 METER
                    </div>
                </div>
            </div>
        </div>
    </div>