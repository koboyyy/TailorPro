<!-- Toast Notification Banner -->
<div
    id="toast"
    class="fixed top-6 right-6 z-50 transform translate-y-[-100px] opacity-0 transition-all duration-300 pointer-events-none"
>
    <div
        class="bg-secondary text-accent px-6 py-4 rounded-xl shadow-2xl flex items-center gap-3 border border-accent/20"
    >
        <span id="toast-icon" class="text-lg"><i class="fas fa-check-circle"></i></span>
        <p id="toast-message" class="text-sm font-medium"></p>
    </div>
</div>

<!-- Header -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
    <div>
        <h1 class="font-serif text-3xl font-bold text-primary dark:text-white mb-1 tracking-tight">
            Hasilkan Pola Busana
        </h1>
        <p class="text-xs text-grey dark:text-slate-400 font-medium">Hasilkan rancangan pola potongan busana secara otomatis berdasarkan ukuran pelanggan.</p>
    </div>

    <div class="flex items-center gap-3">
        <button
            type="button"
            id="btn-save-draft"
            class="px-5 py-3 border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-900 rounded-xl text-xs font-bold text-slate-700 dark:text-slate-300 hover:bg-gray-50 dark:hover:bg-slate-800 transition shadow-sm active:scale-95"
        >
            Simpan Draf
        </button>
        <button
            type="button"
            id="btn-generate"
            class="flex items-center justify-center gap-2 bg-primary hover:bg-secondary text-accent font-semibold text-xs px-5 py-3 rounded-xl shadow-lg shadow-primary/15 transition duration-200 active:scale-95"
        >
            <i class="fas fa-wand-magic-sparkles text-[10px]"></i>
            <span>Hasilkan Pola</span>
        </button>
    </div>
</div>
