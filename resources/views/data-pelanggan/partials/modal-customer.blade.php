<!-- Modal Tambah/Edit Pelanggan -->
<div
    id="customerModal"
    class="fixed inset-0 z-50 hidden bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4"
>
    <div
        class="bg-white dark:bg-slate-900 w-full max-w-lg rounded-3xl shadow-2xl border border-gray-100 dark:border-slate-800 overflow-hidden transform transition-all"
    >
        <div
            class="px-6 py-4 border-b border-gray-100 dark:border-slate-800 flex items-center justify-between"
        >
            <h3 id="modalTitle" class="font-bold text-lg text-slate-800 dark:text-white">
                Tambah Pelanggan Baru
            </h3>
            <button
                type="button"
                onclick="closeModal()"
                class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition"
            >
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <form id="customerForm" onsubmit="saveCustomer(event)" class="p-6 space-y-4">
            <input type="hidden" id="customerId" value="" />

            <div>
                <label class="block text-xs font-bold text-gray-700 dark:text-slate-300 mb-1">
                    Nama Lengkap *
                </label>
                <input
                    type="text"
                    id="customerName"
                    required
                    class="w-full bg-gray-50 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm text-slate-800 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition"
                    placeholder="Contoh: Andi Saputra"
                />
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 dark:text-slate-300 mb-1">
                    No. Telepon
                </label>
                <input
                    type="text"
                    id="customerPhone"
                    class="w-full bg-gray-50 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm text-slate-800 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition"
                    placeholder="Contoh: 081234567890"
                />
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 dark:text-slate-300 mb-1">
                    Alamat Lengkap
                </label>
                <textarea
                    id="customerAddress"
                    rows="3"
                    class="w-full bg-gray-50 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm text-slate-800 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition"
                    placeholder="Contoh: Jl. Merdeka No. 123..."
                ></textarea>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 dark:text-slate-300 mb-1">
                    Status Pelanggan *
                </label>
                <select
                    id="customerStatus"
                    class="w-full bg-gray-50 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm text-slate-800 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition"
                >
                    <option value="Aktif">Aktif</option>
                    <option value="Tidak Aktif">Tidak Aktif</option>
                    <option value="Menunggu">Menunggu</option>
                </select>
            </div>

            <div
                class="pt-4 flex items-center justify-end gap-3 border-t border-gray-100 dark:border-slate-800 mt-6"
            >
                <button
                    type="button"
                    onclick="closeModal()"
                    class="px-5 py-2.5 text-sm font-bold text-gray-500 hover:bg-gray-100 dark:hover:bg-slate-800 rounded-xl transition"
                >
                    Batal
                </button>
                <button
                    type="submit"
                    id="btnSaveCustomer"
                    class="px-5 py-2.5 text-sm font-bold text-white bg-primary hover:bg-secondary rounded-xl transition shadow-lg shadow-primary/20 flex items-center gap-2"
                >
                    <i class="fas fa-save"></i>
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
