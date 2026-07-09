<!-- PILIH JENIS BUSANA (2/3 width) -->
<div
    class="lg:col-span-2 bg-white dark:bg-slate-900 border border-[#EFECE6] dark:border-slate-800 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)] h-full min-h-[260px] w-full"
>
    <h3 class="text-xs font-bold tracking-tight text-slate-800 dark:text-white mb-4 uppercase">
        Pilih Jenis Busana
    </h3>

    <div class="grid grid-cols-2 gap-4">
        <!-- Baju Button -->
        <button
            type="button"
            data-type="KEMEJA"
            class="garment-type-card border border-primary bg-primary/5 p-5 rounded-2xl flex flex-col items-center justify-center gap-3 transition hover:bg-primary/5 active:scale-95"
        >
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mb-1 text-primary dark:text-accent"><path d="M20.38 3.46 16 2a4 4 0 0 1-8 0L3.62 3.46a2 2 0 0 0-1.34 2.23l.58 3.47a1 1 0 0 0 .99.84H6v10c0 1.1.9 2 2 2h8a2 2 0 0 0 2-2V10h2.15a1 1 0 0 0 .99-.84l.58-3.47a2 2 0 0 0-1.34-2.23z" /></svg>
            <span class="text-xs font-bold text-primary dark:text-accent">Kemeja</span>
        </button>

        <!-- Celana Button -->
        <button
            type="button"
            data-type="CELANA"
            class="garment-type-card border border-[#EFECE6] dark:border-slate-800 p-5 rounded-2xl flex flex-col items-center justify-center gap-3 transition hover:bg-gray-50 dark:hover:bg-slate-800 active:scale-95"
        >
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mb-1 text-gray-400"><path d="M6 3h12a2 2 0 0 1 2 2v2a2 2 0 0 1-.5 1.3l-3.5 4.7v9a2 2 0 0 1-2 2H10a2 2 0 0 1-2-2v-9L4.5 8.3A2 2 0 0 1 4 7V5a2 2 0 0 1 2-2z" /></svg>
            <span class="text-xs font-bold text-gray-500 dark:text-slate-400">Celana</span>
        </button>

        <!-- Rok Button -->
        <button
            type="button"
            data-type="ROK"
            class="garment-type-card border border-[#EFECE6] dark:border-slate-800 p-5 rounded-2xl flex flex-col items-center justify-center gap-3 transition hover:bg-gray-50 dark:hover:bg-slate-800 active:scale-95"
        >
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mb-1 text-gray-400"><path d="M8 4h8l5 16H3z" /></svg>
            <span class="text-xs font-bold text-gray-500 dark:text-slate-400">Rok</span>
        </button>

        <!-- Wanita Button -->
        <button
            type="button"
            data-type="WANITA"
            class="garment-type-card border border-[#EFECE6] dark:border-slate-800 p-5 rounded-2xl flex flex-col items-center justify-center gap-3 transition hover:bg-gray-50 dark:hover:bg-slate-800 active:scale-95"
        >
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mb-1 text-gray-400"><path d="M12 2a2 2 0 0 1 2 2v2c0 1.1-.9 2-2 2s-2-.9-2-2V4a2 2 0 0 1 2-2zM8 10h8a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2v-2a2 2 0 0 1 2-2zm-1 8h10l-1 4H8l-1-4z" /></svg>
            <span class="text-xs font-bold text-gray-500 dark:text-slate-400">Wanita</span>
        </button>
    </div>
</div>
