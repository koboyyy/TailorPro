@extends('layouts.app')

@section('breadcrumb-parent', 'halaman')
@section('breadcrumb-active', 'pesanan')

@section('content')
<!-- Toast Notification Banner -->
<div id="toast" class="fixed top-6 right-6 z-50 transform translate-y-[-100px] opacity-0 transition-all duration-300 pointer-events-none">
    <div class="bg-secondary text-accent px-6 py-4 rounded-xl shadow-2xl flex items-center gap-3 border border-accent/20">
        <span id="toast-icon" class="text-lg"><i class="fas fa-check-circle"></i></span>
        <p id="toast-message" class="text-sm font-medium"></p>
    </div>
</div>

<!-- ========================================================== -->
<!-- 1. VIEW LIST (DAFTAR PESANAN) -->
<!-- ========================================================== -->
<div id="view-list" class="space-y-6">
    <!-- Title & Add Button Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="font-serif text-3xl font-bold text-primary dark:text-on-surface mb-1 tracking-tight">Pesanan</h1>
            <p class="text-xs text-grey dark:text-on-surface font-medium">Kelola dan pantau setiap tahapan produksi busana pelanggan Anda.</p>
        </div>
        
        <a href="#tambah" class="flex items-center justify-center gap-2 bg-primary hover:bg-secondary text-accent font-semibold text-xs px-5 py-3 rounded-xl shadow-lg shadow-primary/15 transition duration-200 group active:scale-95">
            <i class="fas fa-plus text-[10px] group-hover:rotate-90 transition-transform duration-200"></i>
            <span>Tambah Pesanan</span>
        </a>
    </div>

    <!-- Status Tabs Filter -->
    <div class="flex flex-wrap gap-2 mb-6 border-b border-[#EFECE6]/70 dark:border-surface pb-5">
        <button data-status="Semua" class="status-tab px-4 py-2 text-xs font-semibold rounded-full border border-primary text-primary transition duration-150 active-tab font-medium">
            Semua <span class="font-bold text-[10px] ml-1" id="count-semua">4</span>
        </button>
        <button data-status="MENUNGGU" class="status-tab px-4 py-2 text-xs font-semibold rounded-full border border-transparent text-grey hover:bg-gray-100 dark:hover:bg-surface transition duration-150 font-medium">
            Menunggu <span class="font-bold text-[10px] ml-1" id="count-menunggu">1</span>
        </button>
        <button data-status="PEMOTONGAN" class="status-tab px-4 py-2 text-xs font-semibold rounded-full border border-transparent text-grey hover:bg-gray-100 dark:hover:bg-surface transition duration-150 font-medium">
            Pemotongan <span class="font-bold text-[10px] ml-1" id="count-pemotongan">1</span>
        </button>
        <button data-status="PENJAHITAN" class="status-tab px-4 py-2 text-xs font-semibold rounded-full border border-transparent text-grey hover:bg-gray-100 dark:hover:bg-surface transition duration-150 font-medium">
            Penjahitan <span class="font-bold text-[10px] ml-1" id="count-penjahitan">1</span>
        </button>
        <button data-status="PENYELESAIAN" class="status-tab px-4 py-2 text-xs font-semibold rounded-full border border-transparent text-grey hover:bg-gray-100 dark:hover:bg-surface transition duration-150 font-medium">
            Penyelesaian <span class="font-bold text-[10px] ml-1" id="count-penyelesaian">1</span>
        </button>
        <button data-status="SELESAI" class="status-tab px-4 py-2 text-xs font-semibold rounded-full border border-transparent text-grey hover:bg-gray-100 dark:hover:bg-surface transition duration-150 font-medium">
            Selesai <span class="font-bold text-[10px] ml-1" id="count-selesai">0</span>
        </button>
    </div>

    <!-- Main Table Container -->
    <div class="bg-white dark:bg-surface rounded-3xl border border-[#EFECE6] dark:border-surface shadow-[0_8px_30px_rgb(0,0,0,0.02)] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-white dark:bg-surface border-b border-[#EFECE6]/80 dark:border-surface text-[10px] font-bold tracking-wider text-gray-400 dark:text-on-surface uppercase">
                        <th class="px-8 py-5">PELANGGAN & PESANAN</th>
                        <th class="px-8 py-5">TENGGAT WAKTU</th>
                        <th class="px-8 py-5">PROGRES PRODUKSI</th>
                        <th class="px-8 py-5 text-right">AKSI</th>
                    </tr>
                </thead>
                <tbody id="orders-table-body" class="divide-y divide-[#EFECE6]/50 text-xs font-medium text-gray-600 dark:divide-slate-800/50">
                    <!-- Rows dynamically loaded by JS -->
                </tbody>
            </table>
        </div>

        <!-- Empty State -->
        <div id="empty-state" class="hidden py-16 px-6 text-center">
            <div class="w-16 h-16 rounded-full bg-slate-50 dark:bg-surface flex items-center justify-center mx-auto mb-4 text-gray-400">
                <i class="fas fa-search text-xl"></i>
            </div>
            <h4 class="text-sm font-semibold text-slate-800 dark:text-on-surface mb-1">Pesanan Tidak Ditemukan</h4>
            <p class="text-xs text-gray-500 dark:text-on-surface max-w-xs mx-auto">Tidak ada data pesanan yang cocok dengan kriteria Anda.</p>
        </div>

        <!-- Pagination Footer -->
        <div class="px-8 py-5 border-t dark:bg-surface border-[#EFECE6]/80 dark:border-surface flex flex-col md:flex-row items-center justify-between gap-4 bg-white/50">
            <span class="text-[11px] text-gray-400 font-medium" id="pagination-info">
                Menampilkan 1-4 dari 24 pesanan aktif
            </span>

            <div class="flex items-center gap-1.5">
                <button class="w-7 h-7 flex items-center justify-center rounded-md border border-gray-100 dark:border-surface bg-white dark:bg-surface text-gray-400 hover:bg-gray-50 dark:hover:bg-surface hover:border-gray-200 transition shadow-sm">
                    <i class="fas fa-chevron-left text-[9px]"></i>
                </button>

                <button class="w-7 h-7 flex items-center justify-center rounded-md bg-primary text-white text-xs font-bold shadow-sm">
                    1
                </button>

                <button class="w-7 h-7 flex items-center justify-center rounded-md border border-gray-100 dark:border-surface bg-white dark:bg-surface text-gray-500 dark:text-on-surface text-xs font-bold hover:bg-gray-50 dark:hover:bg-surface hover:border-gray-200 transition shadow-sm">
                    2
                </button>

                <button class="w-7 h-7 flex items-center justify-center rounded-md border border-gray-100 dark:border-surface bg-white dark:bg-surface text-gray-500 dark:text-on-surface text-xs font-bold hover:bg-gray-50 dark:hover:bg-surface hover:border-gray-200 transition shadow-sm">
                    3
                </button>

                <button class="w-7 h-7 flex items-center justify-center rounded-md border border-gray-100 dark:border-surface bg-white dark:bg-surface text-gray-400 hover:bg-gray-50 dark:hover:bg-surface hover:border-gray-200 transition shadow-sm">
                    <i class="fas fa-chevron-right text-[9px]"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ========================================================== -->
<!-- 2. VIEW FORM (TAMBAH / EDIT PESANAN) -->
<!-- ========================================================== -->
<div id="view-form" class="hidden space-y-6">
    <div class="mb-6">
        <h1 id="form-title" class="font-serif text-3xl font-bold text-primary dark:text-on-surface mb-1 tracking-tight">Tambah Pesanan Baru</h1>
        <p id="form-subtitle" class="text-xs text-grey dark:text-on-surface font-medium">Lengkapi profil pesanan baju pelanggan</p>
    </div>

    <form id="order-form" class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        <input type="hidden" id="form-order-id">
        
        <!-- Left Side: Fields (2 Columns wide) -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- PILIH PELANGGAN -->
            <div class="bg-white dark:bg-surface border border-[#EFECE6] dark:border-surface rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)]">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xs font-bold tracking-tight text-slate-800 dark:text-on-surface uppercase">Pilih Pelanggan</h3>
                    <button type="button" onclick="openQuickCustomerModal()" class="text-xs text-primary dark:text-accent hover:text-secondary dark:hover:text-accent/80 font-bold flex items-center gap-1.5 transition">
                        <i class="fas fa-plus-circle text-xs"></i>
                        <span>Pelanggan Baru</span>
                    </button>
                </div>
                
                <div class="space-y-4">
                    <!-- Search Input -->
                    <div class="relative" id="customer-search-container">
                        <span class="absolute inset-y-0 left-4 flex items-center text-gray-400 pointer-events-none text-xs">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" id="customer-search-input" placeholder="Cari nama atau ID..." class="w-full pl-10 pr-4 py-3 bg-background dark:bg-surface border border-[#EFECE6]/80 dark:border-surface rounded-2xl text-xs text-secondary dark:text-on-surface focus:outline-none focus:border-primary transition">
                        
                        <!-- Search Results Dropdown -->
                        <div id="customer-search-results" class="hidden absolute left-0 right-0 mt-2 bg-white dark:bg-surface border border-gray-100 dark:border-surface rounded-2xl shadow-xl py-1.5 max-h-48 overflow-y-auto z-40">
                            <!-- Populated by JS -->
                        </div>
                    </div>

                    <!-- Selected Customer Card -->
                    <div id="selected-customer-display" class="hidden flex items-center justify-between p-4 bg-gray-50/50 dark:bg-surface border border-gray-100 dark:border-surface rounded-2xl">
                        <div class="flex items-center gap-3">
                            <div id="selected-customer-avatar" class="w-10 h-10 rounded-full font-bold text-sm flex items-center justify-center text-white">S</div>
                            <div>
                                <span id="selected-customer-name" class="block text-sm font-bold text-slate-800 dark:text-on-surface">Siti Aminah</span>
                                <span class="block text-[10px] text-gray-400">Profil Pelanggan Terpilih</span>
                            </div>
                        </div>
                        <button type="button" onclick="clearSelectedCustomer()" class="text-xs text-red-500 hover:text-red-700 font-semibold px-3 py-1.5 rounded-lg hover:bg-red-50 dark:hover:bg-red-950/20 transition">Ubah</button>
                    </div>
                </div>
            </div>

            <!-- DETAIL PESANAN -->
            <div class="bg-white dark:bg-surface border border-[#EFECE6] dark:border-surface rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)]">
                <h3 class="text-xs font-bold tracking-tight text-slate-800 dark:text-on-surface mb-4 uppercase">Detail Pesanan</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Jenis Pesanan -->
                    <div class="md:col-span-1">
                        <label for="input-type" class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Jenis Pesanan</label>
                        <input type="text" id="input-type" required placeholder="Gamis Syar'i" class="w-full px-4 py-3 bg-background dark:bg-surface border border-[#EFECE6]/80 dark:border-surface rounded-2xl text-xs text-secondary dark:text-on-surface focus:outline-none focus:border-primary transition">
                    </div>

                    <!-- Jumlah Pesanan -->
                    <div>
                        <label for="input-quantity" class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Jumlah Pesanan</label>
                        <input type="number" id="input-quantity" value="1" required class="w-full px-4 py-3 bg-background dark:bg-surface border border-[#EFECE6]/80 dark:border-surface rounded-2xl text-xs text-secondary dark:text-on-surface focus:outline-none focus:border-primary transition">
                    </div>

                    <!-- Tanggal Masuk -->
                    <div>
                        <label for="input-start-date" class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Tanggal Masuk</label>
                        <input type="date" id="input-start-date" required class="w-full px-4 py-3 bg-background dark:bg-surface border border-[#EFECE6]/80 dark:border-surface rounded-2xl text-xs text-secondary dark:text-on-surface focus:outline-none focus:border-primary transition">
                    </div>

                    <!-- Tenggat Waktu -->
                    <div>
                        <label for="input-deadline" class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Tenggat Waktu</label>
                        <input type="date" id="input-deadline" required class="w-full px-4 py-3 bg-background dark:bg-surface border border-[#EFECE6]/80 dark:border-surface rounded-2xl text-xs text-secondary dark:text-on-surface focus:outline-none focus:border-primary transition">
                    </div>

                    <!-- Harga -->
                    <div class="md:col-span-1">
                        <label for="input-price" class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Harga</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-4 flex items-center text-xs font-semibold text-gray-400">Rp</span>
                            <input type="text" id="input-price" required placeholder="250.000" class="w-full pl-10 pr-4 py-3 bg-background dark:bg-surface border border-[#EFECE6]/80 dark:border-surface rounded-2xl text-xs text-secondary dark:text-on-surface focus:outline-none focus:border-primary transition">
                        </div>
                    </div>
                </div>
            </div>

            <!-- DETAIL PENGUKURAN -->
            <div class="bg-white dark:bg-surface border border-[#EFECE6] dark:border-surface rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)]">
                <h3 class="text-xs font-bold tracking-tight text-slate-800 dark:text-on-surface mb-4 uppercase">Detail Pengukuran</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Lingkar Badan -->
                    <div>
                        <label for="input-l-badan" class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Lingkar Badan</label>
                        <div class="relative">
                            <input type="number" id="input-l-badan" class="w-full pr-12 pl-4 py-3 bg-background dark:bg-surface border border-[#EFECE6]/80 dark:border-surface rounded-2xl text-xs text-secondary dark:text-on-surface focus:outline-none focus:border-primary transition">
                            <span class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400">CM</span>
                        </div>
                    </div>

                    <!-- Lingkar Pinggang -->
                    <div>
                        <label for="input-l-pinggang" class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Lingkar Pinggang</label>
                        <div class="relative">
                            <input type="number" id="input-l-pinggang" class="w-full pr-12 pl-4 py-3 bg-background dark:bg-surface border border-[#EFECE6]/80 dark:border-surface rounded-2xl text-xs text-secondary dark:text-on-surface focus:outline-none focus:border-primary transition">
                            <span class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400">CM</span>
                        </div>
                    </div>

                    <!-- Lebar Punggung -->
                    <div>
                        <label for="input-l-punggung" class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Lebar Punggung</label>
                        <div class="relative">
                            <input type="number" id="input-l-punggung" class="w-full pr-12 pl-4 py-3 bg-background dark:bg-surface border border-[#EFECE6]/80 dark:border-surface rounded-2xl text-xs text-secondary dark:text-on-surface focus:outline-none focus:border-primary transition">
                            <span class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400">CM</span>
                        </div>
                    </div>

                    <!-- Panjang Bahu -->
                    <div>
                        <label for="input-p-bahu" class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Panjang Bahu</label>
                        <div class="relative">
                            <input type="number" id="input-p-bahu" class="w-full pr-12 pl-4 py-3 bg-background dark:bg-surface border border-[#EFECE6]/80 dark:border-surface rounded-2xl text-xs text-secondary dark:text-on-surface focus:outline-none focus:border-primary transition">
                            <span class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400">CM</span>
                        </div>
                    </div>

                    <!-- Panjang Lengan -->
                    <div>
                        <label for="input-p-lengan" class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Panjang Lengan</label>
                        <div class="relative">
                            <input type="number" id="input-p-lengan" class="w-full pr-12 pl-4 py-3 bg-background dark:bg-surface border border-[#EFECE6]/80 dark:border-surface rounded-2xl text-xs text-secondary dark:text-on-surface focus:outline-none focus:border-primary transition">
                            <span class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400">CM</span>
                        </div>
                    </div>

                    <!-- Lingkar Lengan -->
                    <div>
                        <label for="input-l-lengan" class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Lingkar Lengan</label>
                        <div class="relative">
                            <input type="number" id="input-l-lengan" class="w-full pr-12 pl-4 py-3 bg-background dark:bg-surface border border-[#EFECE6]/80 dark:border-surface rounded-2xl text-xs text-secondary dark:text-on-surface focus:outline-none focus:border-primary transition">
                            <span class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400">CM</span>
                        </div>
                    </div>

                    <!-- Turun Susu -->
                    <div>
                        <label for="input-t-susu" class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Turun Susu</label>
                        <div class="relative">
                            <input type="number" id="input-t-susu" class="w-full pr-12 pl-4 py-3 bg-background dark:bg-surface border border-[#EFECE6]/80 dark:border-surface rounded-2xl text-xs text-secondary dark:text-on-surface focus:outline-none focus:border-primary transition">
                            <span class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400">CM</span>
                        </div>
                    </div>

                    <!-- Turun Pinggang -->
                    <div>
                        <label for="input-t-pinggang" class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Turun Pinggang</label>
                        <div class="relative">
                            <input type="number" id="input-t-pinggang" class="w-full pr-12 pl-4 py-3 bg-background dark:bg-surface border border-[#EFECE6]/80 dark:border-surface rounded-2xl text-xs text-secondary dark:text-on-surface focus:outline-none focus:border-primary transition">
                            <span class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400">CM</span>
                        </div>
                    </div>

                    <!-- Lingkar Pinggul -->
                    <div>
                        <label for="input-l-pinggul" class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Lingkar Pinggul</label>
                        <div class="relative">
                            <input type="number" id="input-l-pinggul" class="w-full pr-12 pl-4 py-3 bg-background dark:bg-surface border border-[#EFECE6]/80 dark:border-surface rounded-2xl text-xs text-secondary dark:text-on-surface focus:outline-none focus:border-primary transition">
                            <span class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400">CM</span>
                        </div>
                    </div>

                    <!-- Panjang Baju -->
                    <div>
                        <label for="input-p-baju" class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Panjang Baju</label>
                        <div class="relative">
                            <input type="number" id="input-p-baju" class="w-full pr-12 pl-4 py-3 bg-background dark:bg-surface border border-[#EFECE6]/80 dark:border-surface rounded-2xl text-xs text-secondary dark:text-on-surface focus:outline-none focus:border-primary transition">
                            <span class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400">CM</span>
                        </div>
                    </div>

                    <!-- Panjang Rok -->
                    <div>
                        <label for="input-p-rok" class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Panjang Rok</label>
                        <div class="relative">
                            <input type="text" id="input-p-rok" placeholder="-" class="w-full pr-12 pl-4 py-3 bg-background dark:bg-surface border border-[#EFECE6]/80 dark:border-surface rounded-2xl text-xs text-secondary dark:text-on-surface focus:outline-none focus:border-primary transition">
                            <span class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400">CM</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: References (1 Column wide) -->
        <div class="space-y-6">
            <!-- FOTO REFERENSI -->
            <div class="bg-white dark:bg-surface border border-[#EFECE6] dark:border-surface rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)]">
                <h3 class="text-xs font-bold tracking-tight text-slate-800 dark:text-on-surface mb-4 uppercase">Foto Referensi</h3>
                
                <div id="image-dropzone" class="border border-dashed border-[#EFECE6] dark:border-surface rounded-2xl p-6 text-center cursor-pointer hover:border-primary dark:hover:border-slate-500 transition min-h-[220px] flex flex-col justify-center items-center">
                    <input type="file" id="form-photo-input" class="hidden" accept="image/*">
                    <div id="upload-prompt" class="space-y-3">
                        <div class="w-12 h-12 rounded-full bg-gray-50 dark:bg-surface flex items-center justify-center mx-auto text-gray-400">
                            <i class="fa-regular fa-image text-lg"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-800 dark:text-slate-200">Klik untuk unggah atau tarik foto ke sini</p>
                            <p class="text-[10px] text-gray-400 mt-1">PNG, JPG atau WEBP (Maksimal. 5mb)</p>
                        </div>
                    </div>
                    <img id="form-photo-preview" class="hidden w-full max-h-56 object-cover rounded-xl mt-2 border border-gray-100 dark:border-surface">
                </div>
            </div>

            <!-- CATATAN TAMBAHAN -->
            <div class="bg-white dark:bg-surface border border-[#EFECE6] dark:border-surface rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)]">
                <h3 class="text-xs font-bold tracking-tight text-slate-800 dark:text-on-surface mb-4 uppercase">Catatan Tambahan</h3>
                <textarea id="input-notes" rows="4" class="w-full px-4 py-3 bg-background dark:bg-surface border border-[#EFECE6]/80 dark:border-surface rounded-2xl text-xs text-secondary dark:text-on-surface focus:outline-none focus:border-primary transition" placeholder="Tidak ada catatan tambahan"></textarea>
            </div>

            <!-- Action buttons in Sidebar -->
            <div class="flex items-center gap-3 pt-2">
                <a href="#list" class="flex-1 text-center py-3 border border-gray-200 dark:border-surface bg-white dark:bg-surface rounded-xl text-xs font-bold text-slate-700 dark:text-on-surface hover:bg-gray-50 dark:hover:bg-surface transition shadow-sm">Batal</a>
                <button type="submit" class="flex-1 flex items-center justify-center gap-2 py-3 bg-primary hover:bg-secondary text-accent font-bold text-xs rounded-xl shadow-lg shadow-primary/10 transition duration-200"><i class="fas fa-save"></i> Simpan Pesanan</button>
            </div>
        </div>
    </form>
</div>

<!-- ========================================================== -->
<!-- 3. VIEW DETAIL (DETAIL PESANAN) -->
<!-- ========================================================== -->
<div id="view-detail" class="hidden space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="font-serif text-3xl font-bold text-primary dark:text-on-surface mb-1 tracking-tight">Detail Pesanan</h1>
            <p class="text-xs text-grey dark:text-on-surface font-medium">Kelola informasi pelanggan dan progres produksi pesanan pelanggan.</p>
        </div>
        
        <a href="#list" class="inline-flex items-center gap-2 px-5 py-2.5 border border-gray-200 dark:border-surface bg-white dark:bg-surface rounded-xl text-xs font-bold text-slate-700 dark:text-on-surface hover:bg-gray-50 dark:hover:bg-surface transition shadow-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        <!-- Left Side: Detail & Measurements (2 Columns wide) -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- PELANGGAN -->
            <div class="bg-white dark:bg-surface border border-[#EFECE6] dark:border-surface rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)]">
                <h3 class="text-xs font-bold tracking-tight text-slate-800 dark:text-on-surface mb-4 uppercase">Pelanggan</h3>
                
                <div class="flex items-center justify-between p-4 bg-gray-50/50 dark:bg-surface border border-gray-100 dark:border-surface rounded-2xl">
                    <div class="flex items-center gap-3">
                        <div id="detail-customer-avatar" class="w-10 h-10 rounded-full font-bold text-sm flex items-center justify-center text-white bg-primary">S</div>
                        <div>
                            <span id="detail-customer-name" class="block text-sm font-bold text-slate-800 dark:text-on-surface">Siti Aminah</span>
                            <span class="block text-[10px] text-gray-400">Profil Pelanggan</span>
                        </div>
                    </div>
                    <div class="w-6 h-6 rounded-full bg-emerald-500 text-white flex items-center justify-center">
                        <i class="fas fa-check text-xs"></i>
                    </div>
                </div>
            </div>

            <!-- DETAIL PENGUKURAN -->
            <div class="bg-white dark:bg-surface border border-[#EFECE6] dark:border-surface rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)]">
                <h3 class="text-xs font-bold tracking-tight text-slate-800 dark:text-on-surface mb-4 uppercase">Detail Pengukuran</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Lingkar Badan -->
                    <div>
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Lingkar Badan</span>
                        <div class="relative">
                            <input type="text" id="detail-l-badan" disabled class="w-full pr-12 pl-4 py-3 bg-gray-50/50 dark:bg-surface border border-gray-100 dark:border-surface rounded-2xl text-xs text-secondary dark:text-on-surface">
                            <span class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400">CM</span>
                        </div>
                    </div>

                    <!-- Lingkar Pinggang -->
                    <div>
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Lingkar Pinggang</span>
                        <div class="relative">
                            <input type="text" id="detail-l-pinggang" disabled class="w-full pr-12 pl-4 py-3 bg-gray-50/50 dark:bg-surface border border-gray-100 dark:border-surface rounded-2xl text-xs text-secondary dark:text-on-surface">
                            <span class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400">CM</span>
                        </div>
                    </div>

                    <!-- Lebar Punggung -->
                    <div>
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Lebar Punggung</span>
                        <div class="relative">
                            <input type="text" id="detail-l-punggung" disabled class="w-full pr-12 pl-4 py-3 bg-gray-50/50 dark:bg-surface border border-gray-100 dark:border-surface rounded-2xl text-xs text-secondary dark:text-on-surface">
                            <span class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400">CM</span>
                        </div>
                    </div>

                    <!-- Panjang Bahu -->
                    <div>
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Panjang Bahu</span>
                        <div class="relative">
                            <input type="text" id="detail-p-bahu" disabled class="w-full pr-12 pl-4 py-3 bg-gray-50/50 dark:bg-surface border border-gray-100 dark:border-surface rounded-2xl text-xs text-secondary dark:text-on-surface">
                            <span class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400">CM</span>
                        </div>
                    </div>

                    <!-- Panjang Lengan -->
                    <div>
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Panjang Lengan</span>
                        <div class="relative">
                            <input type="text" id="detail-p-lengan" disabled class="w-full pr-12 pl-4 py-3 bg-gray-50/50 dark:bg-slate-855 border border-gray-100 dark:border-surface rounded-2xl text-xs text-secondary dark:text-on-surface">
                            <span class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400">CM</span>
                        </div>
                    </div>

                    <!-- Lingkar Lengan -->
                    <div>
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Lingkar Lengan</span>
                        <div class="relative">
                            <input type="text" id="detail-l-lengan" disabled class="w-full pr-12 pl-4 py-3 bg-gray-50/50 dark:bg-surface border border-gray-100 dark:border-surface rounded-2xl text-xs text-secondary dark:text-on-surface">
                            <span class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400">CM</span>
                        </div>
                    </div>

                    <!-- Turun Susu -->
                    <div>
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Turun Susu</span>
                        <div class="relative">
                            <input type="text" id="detail-t-susu" disabled class="w-full pr-12 pl-4 py-3 bg-gray-50/50 dark:bg-surface border border-gray-100 dark:border-surface rounded-2xl text-xs text-secondary dark:text-on-surface">
                            <span class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400">CM</span>
                        </div>
                    </div>

                    <!-- Turun Pinggang -->
                    <div>
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Turun Pinggang</span>
                        <div class="relative">
                            <input type="text" id="detail-t-pinggang" disabled class="w-full pr-12 pl-4 py-3 bg-gray-50/50 dark:bg-surface border border-gray-100 dark:border-surface rounded-2xl text-xs text-secondary dark:text-on-surface">
                            <span class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400">CM</span>
                        </div>
                    </div>

                    <!-- Lingkar Pinggul -->
                    <div>
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Lingkar Pinggul</span>
                        <div class="relative">
                            <input type="text" id="detail-l-pinggul" disabled class="w-full pr-12 pl-4 py-3 bg-gray-50/50 dark:bg-surface border border-gray-100 dark:border-surface rounded-2xl text-xs text-secondary dark:text-on-surface">
                            <span class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400">CM</span>
                        </div>
                    </div>

                    <!-- Panjang Baju -->
                    <div>
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Panjang Baju</span>
                        <div class="relative">
                            <input type="text" id="detail-p-baju" disabled class="w-full pr-12 pl-4 py-3 bg-gray-50/50 dark:bg-surface border border-gray-100 dark:border-surface rounded-2xl text-xs text-secondary dark:text-on-surface">
                            <span class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400">CM</span>
                        </div>
                    </div>

                    <!-- Panjang Rok -->
                    <div>
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Panjang Rok</span>
                        <div class="relative">
                            <input type="text" id="detail-p-rok" disabled class="w-full pr-12 pl-4 py-3 bg-gray-50/50 dark:bg-surface border border-gray-100 dark:border-surface rounded-2xl text-xs text-secondary dark:text-on-surface">
                            <span class="absolute inset-y-0 right-4 flex items-center text-[10px] font-bold text-gray-400">CM</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DETAIL PESANAN -->
            <div class="bg-white dark:bg-surface border border-[#EFECE6] dark:border-surface rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)]">
                <h3 class="text-xs font-bold tracking-tight text-slate-800 dark:text-on-surface mb-4 uppercase">Detail Pesanan</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1">Jenis Pesanan</span>
                        <div class="py-3 px-4 bg-gray-50/50 dark:bg-surface rounded-2xl border border-gray-100 dark:border-surface text-xs font-bold text-slate-800 dark:text-slate-200" id="detail-display-type">Gamis Syar'i</div>
                    </div>
                    <div>
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1">Jumlah Pesanan</span>
                        <div class="py-3 px-4 bg-gray-50/50 dark:bg-surface rounded-2xl border border-gray-100 dark:border-surface text-xs font-bold text-slate-800 dark:text-slate-200" id="detail-display-quantity">1</div>
                    </div>
                    <div>
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1">Tanggal Masuk</span>
                        <div class="py-3 px-4 bg-gray-50/50 dark:bg-surface rounded-2xl border border-gray-100 dark:border-surface text-xs font-bold text-slate-800 dark:text-slate-200" id="detail-display-start-date">17 Agustus 2026</div>
                    </div>
                    <div>
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1">Tenggat Waktu</span>
                        <div class="py-3 px-4 bg-gray-50/50 dark:bg-surface rounded-2xl border border-gray-100 dark:border-surface text-xs font-bold text-slate-800 dark:text-slate-200" id="detail-display-deadline">25 Agustus 2026</div>
                    </div>
                    <div class="md:col-span-1">
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1">Harga</span>
                        <div class="py-3 px-4 bg-gray-50/50 dark:bg-surface rounded-2xl border border-gray-100 dark:border-surface text-xs font-bold text-slate-800 dark:text-slate-200" id="detail-display-price">Rp250.000</div>
                    </div>
                </div>
            </div>

            <!-- CATATAN TAMBAHAN -->
            <div class="bg-white dark:bg-surface border border-[#EFECE6] dark:border-surface rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)]">
                <h3 class="text-xs font-bold tracking-tight text-slate-800 dark:text-on-surface mb-4 uppercase">Catatan Tambahan</h3>
                <div class="py-4 px-4 bg-gray-50/50 dark:bg-surface border border-gray-100 dark:border-surface rounded-2xl text-xs text-gray-600 dark:text-on-surface" id="detail-display-notes">
                    Tidak ada catatan tambahan
                </div>
            </div>
        </div>

        <!-- Right Side: Status Progress & History Timeline (1 Column wide) -->
        <div class="space-y-6">
            <!-- FOTO REFERENSI -->
            <div class="bg-white dark:bg-surface border border-[#EFECE6] dark:border-surface rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)]">
                <h3 class="text-xs font-bold tracking-tight text-slate-800 dark:text-on-surface mb-4 uppercase">Foto Referensi</h3>
                <div class="relative overflow-hidden rounded-2xl border border-gray-100 dark:border-surface bg-gray-50 dark:bg-surface min-h-[220px] flex items-center justify-center">
                    <img id="detail-photo-preview" src="https://images.unsplash.com/photo-1583391733956-3750e0ff4e8b?q=80&w=400" alt="Foto Referensi" class="w-full max-h-72 object-cover">
                </div>
            </div>

            <!-- UPDATE STATUS PENGERJAAN -->
            <div class="bg-white dark:bg-surface border border-[#EFECE6] dark:border-surface rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)]">
                <h3 class="text-xs font-bold tracking-tight text-slate-800 dark:text-on-surface mb-4 uppercase">Update Status Pengerjaan</h3>
                
                <div class="space-y-4">
                    <div>
                        <label for="detail-update-status" class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Jumlah Pesanan Status</label>
                        <select id="detail-update-status" class="w-full px-4 py-3 bg-background dark:bg-surface border border-[#EFECE6]/80 dark:border-surface rounded-2xl text-xs text-secondary dark:text-on-surface focus:outline-none focus:border-primary transition">
                            <option value="MENUNGGU">Menunggu</option>
                            <option value="PEMOTONGAN">Pemotongan</option>
                            <option value="PENJAHITAN">Penjahitan</option>
                            <option value="PENYELESAIAN">Penyelesaian</option>
                            <option value="SELESAI">Selesai</option>
                        </select>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="detail-update-progress" class="block text-[10px] font-bold uppercase tracking-wider text-gray-400">PROGRESS</label>
                            <span class="text-xs font-bold text-slate-800 dark:text-slate-200" id="detail-update-progress-label">65%</span>
                        </div>
                        <input type="range" id="detail-update-progress" min="0" max="100" class="w-full h-1 bg-gray-200 dark:bg-surface rounded-lg appearance-none cursor-pointer accent-primary">
                    </div>

                    <button type="button" onclick="updateOrderStatus()" class="w-full flex items-center justify-center gap-2 py-3 bg-primary hover:bg-secondary text-accent font-bold text-xs rounded-xl shadow-lg transition duration-200">
                        <i class="fa-regular fa-floppy-disk"></i> Perbarui Status
                    </button>
                </div>
            </div>

            <!-- RIWAYAT STATUS -->
            <div class="bg-white dark:bg-surface border border-[#EFECE6] dark:border-surface rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)]">
                <h3 class="text-xs font-bold tracking-tight text-slate-800 dark:text-on-surface mb-4 uppercase">Riwayat Status</h3>
                
                <div class="relative border-l-2 border-gray-100 dark:border-surface ml-2 pl-4 space-y-6" id="detail-timeline">
                    <!-- Timeline items loaded dynamically -->
                </div>

                <button type="button" class="w-full text-center text-xs font-bold text-slate-400 hover:text-primary transition flex items-center justify-center gap-1 mt-6">
                    Lihat Semua Riwayat <i class="fas fa-chevron-down text-[9px]"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Quick Add Customer -->
<div id="quick-customer-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm hidden transition-all duration-300">
    <div class="bg-white dark:bg-surface border border-[#EFECE6] dark:border-surface w-full max-w-md rounded-3xl shadow-2xl overflow-hidden transform scale-95 opacity-0 transition-all duration-300" id="quick-customer-modal-container">
        <div class="px-6 py-5 border-b border-[#EFECE6]/80 dark:border-surface flex justify-between items-center">
            <h3 class="font-serif text-lg font-bold text-primary dark:text-on-surface">Tambah Pelanggan Baru</h3>
            <button type="button" class="text-gray-400 hover:text-gray-600 dark:hover:text-white transition" onclick="closeQuickCustomerModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="quick-customer-form" onsubmit="saveQuickCustomer(event)">
            <div class="p-6 space-y-4">
                <div>
                    <label for="quick-customer-name" class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Nama Lengkap</label>
                    <input type="text" id="quick-customer-name" required placeholder="Contoh: Siti Aminah" class="w-full px-4 py-3 bg-background dark:bg-surface border border-[#EFECE6]/80 dark:border-surface rounded-2xl text-xs text-secondary dark:text-on-surface focus:outline-none focus:border-primary transition">
                </div>
                <div>
                    <label for="quick-customer-phone" class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">No. Telepon / WhatsApp</label>
                    <input type="tel" id="quick-customer-phone" required placeholder="Contoh: 081234567890" class="w-full px-4 py-3 bg-background dark:bg-surface border border-[#EFECE6]/80 dark:border-surface rounded-2xl text-xs text-secondary dark:text-on-surface focus:outline-none focus:border-primary transition">
                </div>
                <div>
                    <label for="quick-customer-address" class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Alamat</label>
                    <textarea id="quick-customer-address" rows="3" placeholder="Alamat lengkap pelanggan..." class="w-full px-4 py-3 bg-background dark:bg-surface border border-[#EFECE6]/80 dark:border-surface rounded-2xl text-xs text-secondary dark:text-on-surface focus:outline-none focus:border-primary transition resize-none"></textarea>
                </div>
            </div>
            <div class="px-6 py-4 border-t border-[#EFECE6]/80 dark:border-surface flex justify-end gap-3 bg-gray-50/50 dark:bg-surface">
                <button type="button" class="px-5 py-2.5 border border-gray-200 dark:border-surface bg-white dark:bg-surface rounded-xl text-xs font-bold text-slate-700 dark:text-on-surface hover:bg-gray-50 dark:hover:bg-surface transition active:scale-95" onclick="closeQuickCustomerModal()">Batal</button>
                <button type="submit" class="px-5 py-2.5 bg-primary text-accent text-xs font-bold rounded-xl shadow transition active:scale-95">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // Seed data matching the mockup exactly
    let orders = [
        {
            id: 1,
            customer: "Siti Aminah",
            type: "Gamis Syar'i",
            quantity: 1,
            start_date: "2026-08-17",
            deadline: "2026-08-25",
            price: "250.000",
            status: "PENJAHITAN",
            progress: 65,
            notes: "Tidak ada catatan tambahan",
            initials: "S",
            avatarBg: "bg-[#2D6A4F] text-white",
            photo: null, // base64 / data URL
            // Size profile details
            l_badan: 88,
            l_pinggang: 76,
            l_punggung: 40,
            p_bahu: 12,
            p_lengan: 24,
            l_lengan: 32,
            t_susu: 25,
            t_pinggang: 38,
            l_pinggul: 94,
            p_baju: 70,
            p_rok: "-"
        },
        {
            id: 2,
            customer: "Budi Santoso",
            type: "Kemeja Batik",
            quantity: 1,
            start_date: "2026-08-12",
            deadline: "2026-08-18",
            price: "180.000",
            status: "PEMOTONGAN",
            progress: 30,
            notes: "Kerah tegak, kancing dalam.",
            initials: "B",
            avatarBg: "bg-[#8C6D58] text-white",
            photo: null,
            l_badan: 92,
            l_pinggang: 80,
            l_punggung: 42,
            p_bahu: 13,
            p_lengan: 25,
            l_lengan: 34,
            t_susu: 26,
            t_pinggang: 39,
            l_pinggul: 96,
            p_baju: 72,
            p_rok: "-"
        },
        {
            id: 3,
            customer: "Dewi Sartika",
            type: "Kebaya Wisuda",
            quantity: 1,
            start_date: "2026-08-10",
            deadline: "2026-08-16",
            price: "350.000",
            status: "PENYELESAIAN",
            progress: 90,
            notes: "Bahan brokat dengan furing satin.",
            initials: "D",
            avatarBg: "bg-[#2F3E46] text-white",
            photo: null,
            l_badan: 84,
            l_pinggang: 68,
            l_punggung: 38,
            p_bahu: 11,
            p_lengan: 23,
            l_lengan: 30,
            t_susu: 24,
            t_pinggang: 37,
            l_pinggul: 90,
            p_baju: 65,
            p_rok: "-"
        },
        {
            id: 4,
            customer: "Anita Wijaya",
            type: "Dress Casual",
            quantity: 2,
            start_date: "2026-08-15",
            deadline: "2026-08-22",
            price: "120.000",
            status: "MENUNGGU",
            progress: 5,
            notes: "Model loose dress casual.",
            initials: "A",
            avatarBg: "bg-[#457B9D] text-white",
            photo: null,
            l_badan: 96,
            l_pinggang: 84,
            l_punggung: 44,
            p_bahu: 14,
            p_lengan: 26,
            l_lengan: 36,
            t_susu: 27,
            t_pinggang: 40,
            l_pinggul: 100,
            p_baju: 75,
            p_rok: "-"
        }
    ];

    // Seeding mock customers sizes for dynamic pre-population
    const customerSizes = [
        { id: 1, name: "Siti Aminah", initials: "S", avatarBg: "bg-[#2D6A4F] text-white", l_badan: 88, l_pinggang: 76, l_punggung: 40, p_bahu: 12, p_lengan: 24, l_lengan: 32, t_susu: 25, t_pinggang: 38, l_pinggul: 94, p_baju: 70, p_rok: "-" },
        { id: 2, name: "Budi Santoso", initials: "B", avatarBg: "bg-[#8C6D58] text-white", l_badan: 92, l_pinggang: 80, l_punggung: 42, p_bahu: 13, p_lengan: 25, l_lengan: 34, t_susu: 26, t_pinggang: 39, l_pinggul: 96, p_baju: 72, p_rok: "-" },
        { id: 3, name: "Dewi Sartika", initials: "D", avatarBg: "bg-[#2F3E46] text-white", l_badan: 84, l_pinggang: 68, l_punggung: 38, p_bahu: 11, p_lengan: 23, l_lengan: 30, t_susu: 24, t_pinggang: 37, l_pinggul: 90, p_baju: 65, p_rok: "-" },
        { id: 4, name: "Anita Wijaya", initials: "A", avatarBg: "bg-[#457B9D] text-white", l_badan: 96, l_pinggang: 84, l_punggung: 44, p_bahu: 14, p_lengan: 26, l_lengan: 36, t_susu: 27, t_pinggang: 40, l_pinggul: 100, p_baju: 75, p_rok: "-" }
    ];

    // Seed timelines matching the mockup
    let orderTimeline = {
        1: [
            { status: "PENJAHITAN", time: "10 Maret 2024, 14:20", author: "Admin", location: "Workshop" },
            { status: "PEMOTONGAN", time: "05 Maret 2024, 09:15", author: "Admin", location: "Workshop" },
            { status: "MENUNGGU", time: "01 Maret 2024, 10:00", author: "Admin", location: "Workshop" }
        ],
        2: [
            { status: "PEMOTONGAN", time: "08 Maret 2024, 11:30", author: "Admin", location: "Workshop" },
            { status: "MENUNGGU", time: "05 Maret 2024, 09:00", author: "Admin", location: "Workshop" }
        ],
        3: [
            { status: "PENYELESAIAN", time: "12 Maret 2024, 16:00", author: "Admin", location: "Workshop" },
            { status: "PENJAHITAN", time: "07 Maret 2024, 10:30", author: "Admin", location: "Workshop" },
            { status: "PEMOTONGAN", time: "04 Maret 2024, 14:00", author: "Admin", location: "Workshop" },
            { status: "MENUNGGU", time: "01 Maret 2024, 11:00", author: "Admin", location: "Workshop" }
        ],
        4: [
            { status: "MENUNGGU", time: "11 Maret 2024, 09:45", author: "Admin", location: "Workshop" }
        ]
    };

    let currentFilter = "Semua";
    let searchQuery = "";
    let selectedCustomer = null;
    let uploadedImageDataUrl = null;
    let activeOrderId = null;
    
    // DOM Elements - Navigation & Filters
    const tableBody = document.getElementById('orders-table-body');
    const emptyState = document.getElementById('empty-state');
    const searchInput = document.getElementById('search-input');
    
    // DOM Elements - Form View
    const orderForm = document.getElementById('order-form');
    const customerSearchInput = document.getElementById('customer-search-input');
    const customerSearchResults = document.getElementById('customer-search-results');
    const selectedCustomerDisplay = document.getElementById('selected-customer-display');
    const selectedCustomerAvatar = document.getElementById('selected-customer-avatar');
    const selectedCustomerName = document.getElementById('selected-customer-name');
    const formPhotoInput = document.getElementById('form-photo-input');
    const formPhotoPreview = document.getElementById('form-photo-preview');
    const uploadPrompt = document.getElementById('upload-prompt');
    const imageDropzone = document.getElementById('image-dropzone');
    
    // DOM Elements - Detail View Update Progress
    const detailUpdateStatus = document.getElementById('detail-update-status');
    const detailUpdateProgress = document.getElementById('detail-update-progress');
    const detailUpdateProgressLabel = document.getElementById('detail-update-progress-label');

    // Routing System (Hash Router)
    function handleRouting() {
        const hash = window.location.hash || '#list';
        
        // Hide all views
        document.getElementById('view-list').classList.add('hidden');
        document.getElementById('view-form').classList.add('hidden');
        document.getElementById('view-detail').classList.add('hidden');
        
        // Find layout breadcrumbs to edit
        const breadcrumbSpans = document.querySelectorAll('header.pb-6 .text-xs.text-grey span');
        let parentSpan = breadcrumbSpans.length > 0 ? breadcrumbSpans[0] : null;
        let activeSpan = breadcrumbSpans.length > 2 ? breadcrumbSpans[2] : null;

        // Reset dropdown menus
        document.querySelectorAll('[id^="dropdown-"]').forEach(d => d.classList.add('hidden'));

        if (hash === '#list') {
            document.getElementById('view-list').classList.remove('hidden');
            if (parentSpan) parentSpan.innerText = 'halaman';
            if (activeSpan) activeSpan.innerText = 'pesanan';
            renderOrders();
        } else if (hash === '#tambah') {
            document.getElementById('view-form').classList.remove('hidden');
            if (parentSpan) parentSpan.innerText = 'ukuran baju';
            if (activeSpan) activeSpan.innerText = 'tambah pesanan';
            loadFormView();
        } else if (hash.startsWith('#edit-')) {
            document.getElementById('view-form').classList.remove('hidden');
            if (parentSpan) parentSpan.innerText = 'halaman';
            if (activeSpan) activeSpan.innerText = 'edit pesanan';
            const id = parseInt(hash.split('-')[1]);
            loadFormView(id);
        } else if (hash.startsWith('#detail-')) {
            document.getElementById('view-detail').classList.remove('hidden');
            if (parentSpan) parentSpan.innerText = 'pesanan';
            if (activeSpan) activeSpan.innerText = 'detail pesanan';
            const id = parseInt(hash.split('-')[1]);
            loadDetailView(id);
        }
    }
    
    window.addEventListener('hashchange', handleRouting);
    
    // INITIAL LOAD (moved to bottom of script to avoid ReferenceError initialization order bugs)

    // ==========================================================
    // JS EVENT LISTENERS
    // ==========================================================

    // Global Search Input
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            searchQuery = e.target.value;
            renderOrders();
        });
    }

    // Status Tab Switches
    document.querySelectorAll('.status-tab').forEach(tab => {
        tab.addEventListener('click', function() {
            document.querySelectorAll('.status-tab').forEach(t => {
                t.classList.remove('border-primary', 'text-primary', 'active-tab');
                t.classList.add('border-transparent', 'text-grey');
            });
            this.classList.remove('border-transparent', 'text-grey');
            this.classList.add('border-primary', 'text-primary', 'active-tab');
            currentFilter = this.getAttribute('data-status');
            renderOrders();
        });
    });

    // Customer Selection Search (Form View)
    if (customerSearchInput) {
        customerSearchInput.addEventListener('input', function() {
            const query = this.value.trim().toLowerCase();
            if (query === "") {
                customerSearchResults.classList.add('hidden');
                return;
            }

            const matched = customerSizes.filter(c => c.name.toLowerCase().includes(query));
            if (matched.length === 0) {
                customerSearchResults.innerHTML = `<div class="px-4 py-2 text-xs text-gray-400">Tidak ada pelanggan ditemukan</div>`;
            } else {
                customerSearchResults.innerHTML = matched.map(c => `
                    <button type="button" class="w-full text-left px-4 py-2 text-xs text-slate-800 dark:text-slate-200 hover:bg-gray-50 dark:hover:bg-surface flex items-center gap-2" onclick="selectCustomer(${c.id})">
                        <span class="w-5 h-5 rounded-full ${c.avatarBg} font-bold text-[9px] flex items-center justify-center">${c.initials}</span>
                        <span>${c.name}</span>
                    </button>
                `).join('');
            }
            customerSearchResults.classList.remove('hidden');
        });
    }

    // Drag & Drop Reference Photo (Form View)
    if (imageDropzone) {
        imageDropzone.addEventListener('click', () => formPhotoInput.click());
        imageDropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
            imageDropzone.classList.add('border-primary');
        });
        imageDropzone.addEventListener('dragleave', () => {
            imageDropzone.classList.remove('border-primary');
        });
        imageDropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            imageDropzone.classList.remove('border-primary');
            const file = e.dataTransfer.files[0];
            handlePhotoFile(file);
        });
    }

    if (formPhotoInput) {
        formPhotoInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            handlePhotoFile(file);
        });
    }

    // Detail Update Progress Slider
    if (detailUpdateProgress) {
        detailUpdateProgress.addEventListener('input', function() {
            detailUpdateProgressLabel.innerText = `${this.value}%`;
        });
    }

    // Save Order Submit Handler
    if (orderForm) {
        orderForm.addEventListener('submit', function(e) {
            e.preventDefault();
            saveOrder();
        });
    }

    // Close Dropdowns & Search results on outside clicks
    document.addEventListener('click', function(e) {
        if (customerSearchResults && !e.target.closest('#customer-search-container')) {
            customerSearchResults.classList.add('hidden');
        }
        if (!e.target.closest('.relative')) {
            document.querySelectorAll('[id^="dropdown-"]').forEach(d => d.classList.add('hidden'));
        }
    });

    // ==========================================================
    // JS ACTION CONTROLLERS
    // ==========================================================

    // Photo file handling (Read as DataURL)
    function handlePhotoFile(file) {
        if (!file) return;
        if (!file.type.startsWith('image/')) {
            alert('Silakan pilih file gambar (PNG, JPG, WEBP)!');
            return;
        }
        
        const reader = new FileReader();
        reader.onload = function(e) {
            uploadedImageDataUrl = e.target.result;
            formPhotoPreview.src = uploadedImageDataUrl;
            formPhotoPreview.classList.remove('hidden');
            uploadPrompt.classList.add('hidden');
        };
        reader.readAsDataURL(file);
    }

    // Pre-populate customer details on Form View
    window.selectCustomer = function(id) {
        const customer = customerSizes.find(c => c.id === id);
        if (!customer) return;

        selectedCustomer = customer;
        
        // Show Customer display card
        selectedCustomerAvatar.innerText = customer.initials;
        selectedCustomerAvatar.className = `w-10 h-10 rounded-full font-bold text-sm flex items-center justify-center ${customer.avatarBg}`;
        selectedCustomerName.innerText = customer.name;
        
        document.getElementById('customer-search-container').classList.add('hidden');
        selectedCustomerDisplay.classList.remove('hidden');
        
        // Pre-fill Measurements
        document.getElementById('input-l-badan').value = customer.l_badan;
        document.getElementById('input-l-pinggang').value = customer.l_pinggang;
        document.getElementById('input-l-punggung').value = customer.l_punggung;
        document.getElementById('input-p-bahu').value = customer.p_bahu;
        document.getElementById('input-p-lengan').value = customer.p_lengan;
        document.getElementById('input-l-lengan').value = customer.l_lengan;
        document.getElementById('input-t-susu').value = customer.t_susu;
        document.getElementById('input-t-pinggang').value = customer.t_pinggang;
        document.getElementById('input-l-pinggul').value = customer.l_pinggul;
        document.getElementById('input-p-baju').value = customer.p_baju;
        document.getElementById('input-p-rok').value = customer.p_rok;
    };

    window.clearSelectedCustomer = function() {
        selectedCustomer = null;
        selectedCustomerDisplay.classList.add('hidden');
        document.getElementById('customer-search-container').classList.remove('hidden');
        customerSearchInput.value = "";
        customerSearchInput.focus();
        
        // Clear Measurements inputs
        document.getElementById('input-l-badan').value = "";
        document.getElementById('input-l-pinggang').value = "";
        document.getElementById('input-l-punggung').value = "";
        document.getElementById('input-p-bahu').value = "";
        document.getElementById('input-p-lengan').value = "";
        document.getElementById('input-l-lengan').value = "";
        document.getElementById('input-t-susu').value = "";
        document.getElementById('input-t-pinggang').value = "";
        document.getElementById('input-l-pinggul').value = "";
        document.getElementById('input-p-baju').value = "";
        document.getElementById('input-p-rok').value = "";
    };

    window.openQuickCustomerModal = function() {
        const modal = document.getElementById('quick-customer-modal');
        const container = document.getElementById('quick-customer-modal-container');
        modal.classList.remove('hidden');
        setTimeout(() => {
            container.classList.remove('scale-95', 'opacity-0');
            container.classList.add('scale-100', 'opacity-100');
        }, 50);
    };

    window.closeQuickCustomerModal = function() {
        const modal = document.getElementById('quick-customer-modal');
        const container = document.getElementById('quick-customer-modal-container');
        container.classList.remove('scale-100', 'opacity-100');
        container.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    };

    window.saveQuickCustomer = function(event) {
        event.preventDefault();
        const nameInput = document.getElementById('quick-customer-name');
        const phoneInput = document.getElementById('quick-customer-phone');
        const addressInput = document.getElementById('quick-customer-address');

        const name = nameInput.value.trim();
        const phone = phoneInput.value.trim();
        const address = addressInput.value.trim();

        if (!name || !phone) return;

        // Auto-generate average measurement sizing metrics
        const numericFields = ['l_badan', 'l_pinggang', 'l_punggung', 'p_bahu', 'p_lengan', 'l_lengan', 't_susu', 't_pinggang', 'l_pinggul', 'p_baju'];
        const averages = {};

        numericFields.forEach(field => {
            const values = customerSizes
                .map(c => parseFloat(c[field]))
                .filter(val => !isNaN(val));
            const sum = values.reduce((a, b) => a + b, 0);
            averages[field] = values.length > 0 ? Math.round(sum / values.length) : 0;
        });

        const newId = customerSizes.length > 0 ? Math.max(...customerSizes.map(c => c.id)) + 1 : 1;
        const initials = name.split(' ').map(n => n[0]).join('').substring(0, 2).toUpperCase() || "P";
        const colorPool = ['bg-[#2D6A4F] text-white', 'bg-[#8C6D58] text-white', 'bg-[#2F3E46] text-white', 'bg-[#457B9D] text-white', 'bg-[#E76F51] text-white', 'bg-[#2A9D8F] text-white'];
        const avatarBg = colorPool[Math.floor(Math.random() * colorPool.length)];

        const newCustomer = {
            id: newId,
            name: name,
            initials: initials,
            avatarBg: avatarBg,
            ...averages,
            p_rok: "-"
        };

        customerSizes.push(newCustomer);

        // Select the newly added customer
        selectCustomer(newId);

        // Close modal
        closeQuickCustomerModal();

        // Reset form
        document.getElementById('quick-customer-form').reset();

        // Show success notification
        showNotification("Pelanggan baru berhasil ditambahkan!");
    };

    // Toggle row action menu
    window.toggleDropdown = function(event, id) {
        event.stopPropagation();
        const targetDropdown = document.getElementById(`dropdown-${id}`);
        const isHidden = targetDropdown.classList.contains('hidden');
        
        document.querySelectorAll('[id^="dropdown-"]').forEach(d => d.classList.add('hidden'));
        
        if (isHidden) {
            targetDropdown.classList.remove('hidden');
        }
    };

    // Load values for Tambah / Edit views
    function loadFormView(id = null) {
        orderForm.reset();
        clearSelectedCustomer();
        
        uploadedImageDataUrl = null;
        formPhotoPreview.src = "";
        formPhotoPreview.classList.add('hidden');
        uploadPrompt.classList.remove('hidden');

        // Preset date inputs
        const today = new Date();
        document.getElementById('input-start-date').value = today.toISOString().split('T')[0];
        const nextWeek = new Date();
        nextWeek.setDate(today.getDate() + 7);
        document.getElementById('input-deadline').value = nextWeek.toISOString().split('T')[0];

        if (id) {
            // EDIT MODE
            const order = orders.find(o => o.id === id);
            if (!order) {
                window.location.hash = '#list';
                return;
            }
            
            document.getElementById('form-order-id').value = order.id;
            document.getElementById('form-title').innerText = "Edit Detail Pesanan";
            document.getElementById('form-subtitle').innerText = "Perbarui detail busana dan ukuran pengerjaan pelanggan";
            
            // Re-select customer sizes
            selectCustomer(order.id); // mapping order.id to seeded sizes for ease
            
            // Prefill detail fields
            document.getElementById('input-type').value = order.type;
            document.getElementById('input-quantity').value = order.quantity;
            document.getElementById('input-start-date').value = order.start_date;
            document.getElementById('input-deadline').value = order.deadline;
            document.getElementById('input-price').value = order.price;
            document.getElementById('input-notes').value = order.notes;

            // Load photo preview if any
            if (order.photo) {
                uploadedImageDataUrl = order.photo;
                formPhotoPreview.src = order.photo;
                formPhotoPreview.classList.remove('hidden');
                uploadPrompt.classList.add('hidden');
            }
        } else {
            // CREATE MODE
            document.getElementById('form-order-id').value = "";
            document.getElementById('form-title').innerText = "Tambah Pesanan Baru";
            document.getElementById('form-subtitle').innerText = "Lengkapi profil pesanan baju pelanggan";
        }
    }

    // Load Detail View
    function loadDetailView(id) {
        const order = orders.find(o => o.id === id);
        if (!order) {
            window.location.hash = '#list';
            return;
        }

        activeOrderId = id;

        // Customer card
        document.getElementById('detail-customer-avatar').innerText = order.initials;
        document.getElementById('detail-customer-avatar').className = `w-10 h-10 rounded-full font-bold text-sm flex items-center justify-center ${order.avatarBg}`;
        document.getElementById('detail-customer-name').innerText = order.customer;

        // Details Display
        document.getElementById('detail-display-type').innerText = order.type;
        document.getElementById('detail-display-quantity').innerText = order.quantity;
        document.getElementById('detail-display-start-date').innerText = formatIndonesianDate(order.start_date);
        document.getElementById('detail-display-deadline').innerText = formatIndonesianDate(order.deadline);
        document.getElementById('detail-display-price').innerText = `Rp${order.price}`;
        document.getElementById('detail-display-notes').innerText = order.notes || "Tidak ada catatan tambahan";

        // Measurement fields
        document.getElementById('detail-l-badan').value = order.l_badan || "-";
        document.getElementById('detail-l-pinggang').value = order.l_pinggang || "-";
        document.getElementById('detail-l-punggung').value = order.l_punggung || "-";
        document.getElementById('detail-p-bahu').value = order.p_bahu || "-";
        document.getElementById('detail-p-lengan').value = order.p_lengan || "-";
        document.getElementById('detail-l-lengan').value = order.l_lengan || "-";
        document.getElementById('detail-t-susu').value = order.t_susu || "-";
        document.getElementById('detail-t-pinggang').value = order.t_pinggang || "-";
        document.getElementById('detail-l-pinggul').value = order.l_pinggul || "-";
        document.getElementById('detail-p-baju').value = order.p_baju || "-";
        document.getElementById('detail-p-rok').value = order.p_rok || "-";

        // Photo Reference Preview
        const photoPreview = document.getElementById('detail-photo-preview');
        if (order.photo) {
            photoPreview.src = order.photo;
        } else {
            // Unsplash placeholder matching modest fashion mockup 2
            photoPreview.src = "https://images.unsplash.com/photo-1583391733956-3750e0ff4e8b?q=80&w=400";
        }

        // Set Update Progress controls
        detailUpdateStatus.value = order.status;
        detailUpdateProgress.value = order.progress;
        detailUpdateProgressLabel.innerText = `${order.progress}%`;

        // Render timeline logs
        renderTimeline();
    }

    // Render Timeline Updates
    function renderTimeline() {
        const container = document.getElementById('detail-timeline');
        const timelineList = orderTimeline[activeOrderId] || [];

        if (timelineList.length === 0) {
            container.innerHTML = `<p class="text-xs text-gray-400">Belum ada riwayat aktivitas.</p>`;
            return;
        }

        container.innerHTML = timelineList.map((item, index) => {
            const isFirst = index === 0;
            const dotClass = isFirst ? 'bg-primary' : 'bg-gray-300 dark:bg-slate-700';
            
            // Format status readable
            const statusLabelMap = {
                'MENUNGGU': 'Menunggu',
                'PEMOTONGAN': 'Pemotongan',
                'PENJAHITAN': 'Penjahitan',
                'PENYELESAIAN': 'Penyelesaian',
                'SELESAI': 'Selesai'
            };
            const labelText = statusLabelMap[item.status] || item.status;

            return `
                <div class="relative pl-2">
                    <div class="absolute -left-[23px] top-1.5 w-2.5 h-2.5 rounded-full ${dotClass} border-4 border-white dark:border-slate-900"></div>
                    <div>
                        <span class="block text-xs font-bold text-slate-800 dark:text-on-surface">${labelText}</span>
                        <span class="block text-[10px] text-gray-400 mt-0.5">${item.time}</span>
                        <span class="block text-[10px] text-gray-400 font-medium mt-0.5">Oleh ${item.author} • ${item.location}</span>
                    </div>
                </div>
            `;
        }).join('');
    }

    // Update Status inside Detail View
    window.updateOrderStatus = function() {
        const statusVal = detailUpdateStatus.value;
        const progressVal = parseInt(detailUpdateProgress.value) || 0;
        
        const orderIndex = orders.findIndex(o => o.id === activeOrderId);
        if (orderIndex !== -1) {
            orders[orderIndex].status = statusVal;
            orders[orderIndex].progress = progressVal;

            const now = new Date();
            const monthsList = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            const formattedTime = `${now.getDate()} ${monthsList[now.getMonth()]} ${now.getFullYear()}, ${now.getHours().toString().padStart(2, '0')}:${now.getMinutes().toString().padStart(2, '0')}`;

            if (!orderTimeline[activeOrderId]) {
                orderTimeline[activeOrderId] = [];
            }

            orderTimeline[activeOrderId].unshift({
                status: statusVal,
                time: formattedTime,
                author: "Admin",
                location: "Workshop"
            });

            showNotification("Status pengerjaan berhasil diperbarui!");
            loadDetailView(activeOrderId);
            updateCounts();
        }
    };

    // Save Order (Create or Update from form)
    function saveOrder() {
        const idVal = document.getElementById('form-order-id').value;
        const typeVal = document.getElementById('input-type').value.trim();
        const quantityVal = parseInt(document.getElementById('input-quantity').value) || 1;
        const startDateVal = document.getElementById('input-start-date').value;
        const deadlineVal = document.getElementById('input-deadline').value;
        const priceVal = document.getElementById('input-price').value.trim();
        const notesVal = document.getElementById('input-notes').value.trim();

        if (!selectedCustomer) {
            alert("Harap pilih pelanggan terlebih dahulu!");
            return;
        }

        // Gather measurements
        const l_badan = parseInt(document.getElementById('input-l-badan').value) || null;
        const l_pinggang = parseInt(document.getElementById('input-l-pinggang').value) || null;
        const l_punggung = parseInt(document.getElementById('input-l-punggung').value) || null;
        const p_bahu = parseInt(document.getElementById('input-p-bahu').value) || null;
        const p_lengan = parseInt(document.getElementById('input-p-lengan').value) || null;
        const l_lengan = parseInt(document.getElementById('input-l-lengan').value) || null;
        const t_susu = parseInt(document.getElementById('input-t-susu').value) || null;
        const t_pinggang = parseInt(document.getElementById('input-t-pinggang').value) || null;
        const l_pinggul = parseInt(document.getElementById('input-l-pinggul').value) || null;
        const p_baju = parseInt(document.getElementById('input-p-baju').value) || null;
        const p_rok = document.getElementById('input-p-rok').value.trim() || "-";

        if (idVal) {
            // EDIT SAVE
            const index = orders.findIndex(o => o.id === parseInt(idVal));
            if (index !== -1) {
                orders[index].customer = selectedCustomer.name;
                orders[index].type = typeVal;
                orders[index].quantity = quantityVal;
                orders[index].start_date = startDateVal;
                orders[index].deadline = deadlineVal;
                orders[index].price = priceVal;
                orders[index].notes = notesVal;
                orders[index].photo = uploadedImageDataUrl;
                
                // sizes
                orders[index].l_badan = l_badan;
                orders[index].l_pinggang = l_pinggang;
                orders[index].l_punggung = l_punggung;
                orders[index].p_bahu = p_bahu;
                orders[index].p_lengan = p_lengan;
                orders[index].l_lengan = l_lengan;
                orders[index].t_susu = t_susu;
                orders[index].t_pinggang = t_pinggang;
                orders[index].l_pinggul = l_pinggul;
                orders[index].p_baju = p_baju;
                orders[index].p_rok = p_rok;

                showNotification(`Pesanan "${selectedCustomer.name}" berhasil diperbarui!`);
            }
        } else {
            // CREATE SAVE
            const newId = orders.length > 0 ? Math.max(...orders.map(o => o.id)) + 1 : 1;
            
            const newOrder = {
                id: newId,
                customer: selectedCustomer.name,
                type: typeVal,
                quantity: quantityVal,
                start_date: startDateVal,
                deadline: deadlineVal,
                price: priceVal,
                status: "MENUNGGU",
                progress: 5,
                notes: notesVal || "Tidak ada catatan tambahan",
                initials: selectedCustomer.initials,
                avatarBg: selectedCustomer.avatarBg,
                photo: uploadedImageDataUrl,
                l_badan, l_pinggang, l_punggung, p_bahu, p_lengan, l_lengan, t_susu, t_pinggang, l_pinggul, p_baju, p_rok
            };

            orders.unshift(newOrder);

            // Timeline initial
            orderTimeline[newId] = [
                { status: "MENUNGGU", time: formatTimelineDate(new Date()), author: "Admin", location: "Workshop" }
            ];

            showNotification(`Pesanan baru untuk "${selectedCustomer.name}" berhasil dibuat!`);
        }

        updateCounts();
        window.location.hash = '#list';
    }

    // Timeline Date Helper (Create view log)
    function formatTimelineDate(date) {
        const idMonths = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        return `${date.getDate()} ${idMonths[date.getMonth()]} ${date.getFullYear()}, ${date.getHours().toString().padStart(2, '0')}:${date.getMinutes().toString().padStart(2, '0')}`;
    }

    // Delete order
    window.deleteOrder = function(id) {
        const order = orders.find(o => o.id === id);
        if (!order) return;
        
        if (confirm(`Apakah Anda yakin ingin menghapus pesanan untuk "${order.customer}"?`)) {
            orders = orders.filter(o => o.id !== id);
            showNotification(`Pesanan "${order.customer}" berhasil dihapus`, "fa-trash-can");
            updateCounts();
            renderOrders();
        }
    };

    // Update status counters
    function updateCounts() {
        document.getElementById('count-semua').innerText = orders.length;
        document.getElementById('count-menunggu').innerText = orders.filter(o => o.status === 'MENUNGGU').length;
        document.getElementById('count-pemotongan').innerText = orders.filter(o => o.status === 'PEMOTONGAN').length;
        document.getElementById('count-penjahitan').innerText = orders.filter(o => o.status === 'PENJAHITAN').length;
        document.getElementById('count-penyelesaian').innerText = orders.filter(o => o.status === 'PENYELESAIAN').length;
        document.getElementById('count-selesai').innerText = orders.filter(o => o.status === 'SELESAI').length;
    }

    // Date formatter indonesian
    function formatIndonesianDate(dateStr) {
        if (!dateStr) return "-";
        const parts = dateStr.split('-');
        if (parts.length !== 3) return dateStr;
        const date = new Date(parseInt(parts[0]), parseInt(parts[1]) - 1, parseInt(parts[2]));
        const idMonths = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        return `${date.getDate()} ${idMonths[date.getMonth()]} ${date.getFullYear()}`;
    }

    // Deadline subtext calculator
    function getDeadlineLabel(dateStr) {
        const deadline = new Date(dateStr);
        const reference = new Date('2026-08-12'); // Fixed mockup anchor date
        
        const diffTime = deadline - reference;
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        
        if (diffDays === 1) {
            return { text: 'Besok Tenggat Waktu', class: 'text-red-500 font-bold dark:text-red-400 italic' };
        } else if (diffDays === 0) {
            return { text: 'Hari Ini Tenggat Waktu', class: 'text-red-600 font-black dark:text-red-400 italic' };
        } else if (diffDays < 0) {
            return { text: 'Terlewat ' + Math.abs(diffDays) + ' Hari', class: 'text-red-700 font-bold dark:text-red-400 italic' };
        } else if (diffDays === 6) { 
            return { text: 'On Schedule', class: 'text-gray-400 dark:text-on-surface font-medium italic' };
        } else {
            return { text: diffDays + ' Hari Lagi', class: 'text-gray-400 dark:text-on-surface font-medium italic' };
        }
    }

    // Render orders table
    function renderOrders() {
        let filtered = orders;
        
        if (currentFilter !== "Semua") {
            filtered = filtered.filter(o => o.status === currentFilter);
        }
        
        if (searchQuery.trim() !== "") {
            const query = searchQuery.toLowerCase();
            filtered = filtered.filter(o => 
                o.customer.toLowerCase().includes(query) || 
                o.type.toLowerCase().includes(query)
            );
        }

        document.getElementById('pagination-info').innerText = `Menampilkan 1-${filtered.length} dari ${orders.length} pesanan aktif`;

        if (filtered.length === 0) {
            tableBody.innerHTML = '';
            emptyState.classList.remove('hidden');
            return;
        }

        emptyState.classList.add('hidden');
        tableBody.innerHTML = filtered.map(o => {
            const deadlineInfo = getDeadlineLabel(o.deadline);
            const formattedDate = formatIndonesianDate(o.deadline);
            
            return `
                <tr class="hover:bg-slate-50/50 dark:hover:bg-surface/40 transition duration-150">
                    <!-- Customer and Apparel type -->
                    <td class="px-8 py-5">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full ${o.avatarBg} font-bold text-sm flex items-center justify-center shrink-0 border border-black/5">
                                ${o.initials}
                            </div>
                            <div>
                                <span class="block text-sm font-bold text-slate-800 dark:text-on-surface">${o.customer}</span>
                                <span class="inline-block px-2.5 py-1 text-[9px] font-bold text-primary dark:text-accent bg-primary/10 dark:bg-primary/30 rounded-md mt-1 leading-none">${o.type}</span>
                            </div>
                        </div>
                    </td>
                    
                    <!-- Deadline -->
                    <td class="px-8 py-5">
                        <span class="block text-sm font-bold text-slate-800 dark:text-on-surface">${formattedDate}</span>
                        <span class="block text-[10px] mt-0.5 ${deadlineInfo.class}">${deadlineInfo.text}</span>
                    </td>
                    
                    <!-- Progress -->
                    <td class="px-8 py-5">
                        <div class="w-64 max-w-full">
                            <div class="flex items-center justify-between mb-1.5">
                                <span class="text-[9px] font-extrabold uppercase tracking-wider text-slate-800 dark:text-on-surface">${o.status}</span>
                                <span class="text-[10px] font-bold text-gray-400">${o.progress}%</span>
                            </div>
                            <div class="w-full bg-gray-100 dark:bg-surface h-1.5 rounded-full overflow-hidden">
                                <div class="bg-primary h-full rounded-full" style="width: ${o.progress}%"></div>
                            </div>
                        </div>
                    </td>
                    
                    <!-- Action Buttons -->
                    <td class="px-8 py-5 text-right">
                        <div class="flex items-center justify-end gap-2.5">
                            <a href="#detail-${o.id}" class="w-8 h-8 rounded-lg bg-gray-50 dark:bg-surface border border-gray-100 dark:border-surface flex items-center justify-center text-gray-400 hover:text-primary dark:hover:text-accent hover:scale-105 active:scale-95 transition" title="Lihat Detail">
                                <i class="fa-regular fa-eye text-xs"></i>
                            </a>
                            <div class="relative">
                                <button onclick="toggleDropdown(event, ${o.id})" class="w-8 h-8 rounded-lg bg-gray-50 dark:bg-surface border border-gray-100 dark:border-surface flex items-center justify-center text-gray-400 hover:text-primary dark:hover:text-accent hover:scale-105 active:scale-95 transition" title="Menu">
                                    <i class="fa-solid fa-ellipsis-vertical text-xs"></i>
                                </button>
                                <div id="dropdown-${o.id}" class="absolute right-0 mt-2 w-32 bg-white dark:bg-surface border border-gray-100 dark:border-surface rounded-xl shadow-lg py-1.5 hidden z-45">
                                    <a href="#edit-${o.id}" class="w-full text-left px-4 py-2 text-xs text-gray-600 dark:text-on-surface hover:bg-gray-50 dark:hover:bg-surface/50 flex items-center gap-2 transition">
                                        <i class="fa-regular fa-edit text-[10px]"></i> Edit
                                    </a>
                                    <button onclick="deleteOrder(${o.id})" class="w-full text-left px-4 py-2 text-xs text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-950/20 flex items-center gap-2 transition">
                                        <i class="fa-regular fa-trash-can text-[10px]"></i> Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            `;
        }).join('');
    }

    // Helper Toast notification
    function showNotification(message, iconClass = "fa-check-circle") {
        const toast = document.getElementById('toast');
        const toastMsg = document.getElementById('toast-message');
        const toastIcon = document.getElementById('toast-icon');

        toastMsg.innerText = message;
        toastIcon.innerHTML = `<i class="fas ${iconClass}"></i>`;

        toast.classList.remove('translate-y-[-100px]', 'opacity-0');
        toast.classList.add('translate-y-0', 'opacity-100');

        setTimeout(() => {
            toast.classList.remove('translate-y-0', 'opacity-100');
            toast.classList.add('translate-y-[-100px]', 'opacity-0');
        }, 3000);
    }

    // INITIAL LOAD
    handleRouting();
    updateCounts();
});
</script>
@endsection
