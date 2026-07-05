<!-- Modals Detail Ukuran Lengkap -->
<div
    id="sizes-modal"
    class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm hidden transition-all duration-300"
>
    <div
        class="bg-white dark:bg-slate-900 border border-[#EFECE6] dark:border-slate-800 w-full max-w-md rounded-3xl shadow-2xl overflow-hidden transform scale-95 opacity-0 transition-all duration-300"
        id="sizes-modal-container"
    >
        <div
            class="px-6 py-5 border-b border-[#EFECE6]/80 dark:border-slate-800/80 flex justify-between items-center"
        >
            <h3 class="font-serif text-lg font-bold text-primary dark:text-white">
                Profil Ukuran Lengkap
            </h3>
            <button
                type="button"
                class="text-gray-400 hover:text-gray-600 dark:hover:text-white transition"
                onclick="closeSizesModal()"
            >
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="p-6 space-y-4 max-h-[350px] overflow-y-auto" id="sizes-modal-content">
            <!-- Rendered by JS -->
        </div>

        <div
            class="px-6 py-4 border-t border-[#EFECE6]/80 dark:border-slate-800/80 flex justify-end bg-gray-50/50 dark:bg-slate-850"
        >
            <button
                type="button"
                class="px-5 py-2.5 bg-primary text-accent text-xs font-bold rounded-xl shadow transition active:scale-95"
                onclick="closeSizesModal()"
            >
                Tutup
            </button>
        </div>
    </div>
</div>
