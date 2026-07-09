<!-- Modal Quick Add Customer -->
    <div
        id="quick-customer-modal"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm hidden transition-all duration-300"
    >
        <div
            class="bg-white dark:bg-slate-900 border border-[#EFECE6] dark:border-slate-800 w-full max-w-md rounded-3xl shadow-2xl overflow-hidden transform scale-95 opacity-0 transition-all duration-300"
            id="quick-customer-modal-container"
        >
            <div
                class="px-6 py-5 border-b border-[#EFECE6]/80 dark:border-slate-800/80 flex justify-between items-center"
            >
                <h3 class="font-serif text-lg font-bold text-primary dark:text-white">
                    Tambah Pelanggan Baru
                </h3>
                <button
                    type="button"
                    class="text-gray-400 hover:text-gray-600 dark:hover:text-white transition"
                    onclick="closeQuickCustomerModal()"
                >
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="quick-customer-form" onsubmit="saveQuickCustomer(event)">
                <div class="p-6 space-y-4">
                    <div>
                        <label
                            for="quick-customer-name"
                            class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5"
                            >Nama Lengkap</label
                        >
                        <input
                            type="text"
                            id="quick-customer-name"
                            required
                            placeholder="Contoh: Siti Aminah"
                            class="w-full px-4 py-3 bg-background dark:bg-slate-800 border border-[#EFECE6]/80 dark:border-slate-700/80 rounded-2xl text-xs text-secondary dark:text-white focus:outline-none focus:border-primary transition"
                        />
                    </div>
                    <div>
                        <label
                            for="quick-customer-phone"
                            class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5"
                            >No. Telepon / WhatsApp</label
                        >
                        <input
                            type="tel"
                            id="quick-customer-phone"
                            required
                            placeholder="Contoh: 081234567890"
                            class="w-full px-4 py-3 bg-background dark:bg-slate-800 border border-[#EFECE6]/80 dark:border-slate-700/80 rounded-2xl text-xs text-secondary dark:text-white focus:outline-none focus:border-primary transition"
                        />
                    </div>
                    <div>
                        <label
                            for="quick-customer-address"
                            class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5"
                            >Alamat</label
                        >
                        <textarea
                            id="quick-customer-address"
                            rows="3"
                            placeholder="Alamat lengkap pelanggan..."
                            class="w-full px-4 py-3 bg-background dark:bg-slate-800 border border-[#EFECE6]/80 dark:border-slate-700/80 rounded-2xl text-xs text-secondary dark:text-white focus:outline-none focus:border-primary transition resize-none"
                        ></textarea>
                    </div>
                </div>
                <div
                    class="px-6 py-4 border-t border-[#EFECE6]/80 dark:border-slate-800/80 flex justify-end gap-3 bg-gray-50/50 dark:bg-slate-850"
                >
                    <button
                        type="button"
                        class="px-5 py-2.5 border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-900 rounded-xl text-xs font-bold text-slate-700 dark:text-slate-300 hover:bg-gray-50 dark:hover:bg-slate-800 transition active:scale-95"
                        onclick="closeQuickCustomerModal()"
                    >
                        Batal
                    </button>
                    <button
                        type="submit"
                        class="px-5 py-2.5 bg-primary text-accent text-xs font-bold rounded-xl shadow transition active:scale-95"
                    >
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>