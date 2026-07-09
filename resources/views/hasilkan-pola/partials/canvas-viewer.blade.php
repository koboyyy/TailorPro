<!-- PREVIEW POLA TEKNIS (Full Width) -->
<div
    class="col-span-2 bg-white dark:bg-slate-900 border border-[#EFECE6] dark:border-slate-800 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)] mb-8 w-full h-full"
>
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center gap-2">
            <span
                class="w-8 h-8 rounded-lg bg-gray-50 dark:bg-slate-800 flex items-center justify-center text-primary dark:text-accent font-bold font-serif text-sm"
            >
                A
            </span>
            <div>
                <h3 class="text-sm font-bold tracking-tight text-slate-800 dark:text-white">
                    Preview Pola Teknis
                </h3>
                <p class="text-[10px] text-gray-400">Draf Otomatis</p>
            </div>
        </div>

        <!-- Action Buttons -->
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

    <!-- Blueprint Canvas -->
    <div
        class="blueprint-canvas-container relative w-full h-auto min-h-[450px] rounded-2xl overflow-y-auto border border-[#EFECE6] dark:border-slate-800 flex flex-col items-start justify-center bg-[#FCFCFC] dark:bg-slate-950"
    >
        <!-- Grid overlay -->
        <div class="absolute inset-0 blueprint-grid opacity-70"></div>

        <!-- Scalable Canvas Wrapper -->
        <div
            id="svg-wrapper"
            class="relative z-10 w-full min-h-full flex flex-row flex-wrap items-start justify-center gap-12 py-10 transition-transform duration-200"
            style="transform: scale(1)"
        >
            {{-- <div id="kanvasContainer" class="w-full flex justify-center"></div> --}}
        </div>
    </div>

    <!-- Format Indicator + Detail Jarak Pola -->

    <div class="flex items-center justify-between mt-3 text-[10px] font-medium text-gray-400">
        <span class="flex items-center gap-1.5">
            <span class="w-2 h-2 rounded-full bg-blue-500"></span>
            FORMAT: SVG
        </span>
        <span class="italic">
            Klik 'Hasilkan' untuk memperbarui pola berdasarkan ukuran terbaru.
        </span>
    </div>

    <!-- Detail Jarak Titik Pola -->
    <div
        id="detailJarakTitikPola"
        class="mt-3 bg-gray-50 dark:bg-slate-900 border border-[#EFECE6] dark:border-slate-800 rounded-xl px-4 py-3 text-xs text-gray-600 dark:text-slate-300 space-y-3"
    ></div>
</div>
