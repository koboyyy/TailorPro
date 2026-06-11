@extends('layouts.app')

@section('content')
  <!-- Page Content Title & Subtitle -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="font-serif text-3xl font-bold text-primary dark:text-white mb-1 tracking-tight">Data Pelanggan</h1>
                <p class="text-xs text-grey dark:text-slate-400 font-medium">Kelola informasi kontak dan riwayat pesanan pelanggan Anda.</p>
            </div>
            
            <button id="btn-add-new" class="flex items-center justify-center gap-2 bg-primary hover:bg-secondary text-accent font-semibold text-xs px-5 py-3 rounded-xl shadow-lg shadow-primary/15 transition duration-200 group active:scale-95">
                <i class="fa-solid fa-user-plus text-[10px] group-hover:rotate-90 transition-transform duration-200"></i>
                <span>Tambah Pelanggan</span>
            </button>
        </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-[30px]">
        
        <!-- Card 1 -->
        <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-800 flex flex-col justify-between h-36 relative overflow-hidden group hover:border-gray-300 dark:hover:border-slate-700 transition-colors">
            <p class="text-[11px] font-bold text-gray-400 dark:text-slate-500 tracking-wider mb-4 uppercase">Total Pelanggan</p>
            <div class="flex items-end justify-between mt-auto z-10">
                <h3 class="font-serif text-[32px] leading-none font-bold text-slate-800 dark:text-white">1,284</h3>
                <span class="flex items-center gap-1 text-xs font-semibold text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/30 border border-emerald-100 dark:border-emerald-900/50 px-2 py-1 rounded-lg">
                    <i class="fa-solid fa-arrow-trend-up"></i> +18.4%
                </span>
            </div>
            <!-- Decorative background -->
            <div class="absolute -bottom-8 -right-8 w-32 h-32 bg-gray-50 dark:bg-slate-800/50 rounded-full opacity-50 group-hover:scale-110 transition-transform"></div>
            <div class="absolute -bottom-4 -right-4 w-20 h-20 bg-white dark:bg-slate-900 rounded-full opacity-50"></div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-800 flex flex-col justify-between h-36 relative overflow-hidden group hover:border-gray-300 dark:hover:border-slate-700 transition-colors">
            <p class="text-[11px] font-bold text-gray-400 dark:text-slate-500 tracking-wider mb-4 uppercase">Pelanggan Aktif</p>
            <div class="flex items-end justify-between mt-auto z-10">
                <h3 class="font-serif text-[32px] leading-none font-bold text-slate-800 dark:text-white">156</h3>
                <span class="flex items-center gap-1 text-xs font-semibold text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/30 border border-emerald-100 dark:border-emerald-900/50 px-2 py-1 rounded-lg">
                    <i class="fa-solid fa-arrow-trend-up"></i> +5.2%
                </span>
            </div>
            <!-- Decorative background -->
            <div class="absolute -bottom-8 -right-8 w-32 h-32 bg-gray-50 dark:bg-slate-800/50 rounded-full opacity-50 group-hover:scale-110 transition-transform"></div>
            <div class="absolute -bottom-4 -right-4 w-20 h-20 bg-white dark:bg-slate-900 rounded-full opacity-50"></div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-800 flex flex-col justify-between h-36 relative overflow-hidden group hover:border-gray-300 dark:hover:border-slate-700 transition-colors">
            <p class="text-[11px] font-bold text-gray-400 dark:text-slate-500 tracking-wider mb-4 uppercase">Member Baru</p>
            <div class="flex items-end justify-between mt-auto z-10">
                <h3 class="font-serif text-[32px] leading-none font-bold text-slate-800 dark:text-white">42</h3>
                <span class="flex items-center gap-1 text-xs font-semibold text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-950/30 border border-blue-100 dark:border-blue-900/50 px-2 py-1 rounded-lg">
                    <i class="fa-solid fa-user-plus"></i> +12
                </span>
            </div>
            <!-- Decorative background -->
            <div class="absolute -bottom-8 -right-8 w-32 h-32 bg-gray-50 dark:bg-slate-800/50 rounded-full opacity-50 group-hover:scale-110 transition-transform"></div>
            <div class="absolute -bottom-4 -right-4 w-20 h-20 bg-white dark:bg-slate-900 rounded-full opacity-50"></div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-800 flex flex-col justify-between h-36 relative overflow-hidden group hover:border-gray-300 dark:hover:border-slate-700 transition-colors">
            <p class="text-[11px] font-bold text-gray-400 dark:text-slate-500 tracking-wider mb-4 uppercase">Repeat Order</p>
            <div class="flex items-end justify-between mt-auto z-10">
                <h3 class="font-serif text-[32px] leading-none font-bold text-slate-800 dark:text-white">42%</h3>
                <span class="flex items-center gap-1 text-xs font-semibold text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-950/30 border border-blue-100 dark:border-blue-900/50 px-2 py-1 rounded-lg">
                    <i class="fa-solid fa-user-plus"></i> Sangat Tinggi
                </span>
            </div>
            <!-- Decorative background -->
            <div class="absolute -bottom-8 -right-8 w-32 h-32 bg-gray-50 dark:bg-slate-800/50 rounded-full opacity-50 group-hover:scale-110 transition-transform"></div>
            <div class="absolute -bottom-4 -right-4 w-20 h-20 bg-white dark:bg-slate-900 rounded-full opacity-50"></div>
        </div>
    </div>

<section class="lg:col-span-2 bg-white dark:bg-slate-900 rounded-2xl border border-[#EFECE6] dark:border-slate-800 shadow-[0_8px_30px_rgb(0,0,0,0.02)] overflow-hidden">
    <div class="px-6 py-5 border-b border-[#EFECE6]/80 dark:border-slate-800/80 flex justify-between items-center">
        <h3 class="text-sm font-bold tracking-tight text-slate-800 dark:text-white">Semua Pelanggan</h3>
        <button id="filter-btn" class="w-8 h-8 rounded-lg border border-[#EFECE6] dark:border-slate-800 bg-white dark:bg-slate-800 flex items-center justify-center text-xs text-gray-500 dark:text-slate-400 hover:text-blue-600 hover:border-gray-300 transition">
            <i class="fas fa-sliders-h"></i>
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-white dark:bg-slate-800/30 border-b border-[#EFECE6]/80 dark:border-slate-800/80 text-[10px] font-bold tracking-wider text-gray-400 dark:text-slate-400 uppercase">
                    <th class="px-6 py-4">Nama Pelanggan</th>
                    <th class="px-6 py-4">No. Telepon</th>
                    <th class="px-6 py-4">Alamat</th>
                    <th class="px-6 py-4">Total Pesanan</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody id="customer-table-body" class="divide-y divide-[#EFECE6]/50 text-xs font-medium text-gray-600 ">
                </tbody>
        </table>
    </div>
    
    <div id="empty-state" class="hidden py-16 px-6 text-center">
        <div class="w-16 h-16 rounded-full bg-slate-50 flex items-center justify-center mx-auto mb-4 text-gray-400">
            <i class="fas fa-search text-xl"></i>
        </div>
        <h4 class="text-sm font-semibold text-slate-800 mb-1">Pelanggan Tidak Ditemukan</h4>
        <p class="text-xs text-gray-500 max-w-xs mx-auto">Tidak ada data pelanggan yang cocok dengan kata kunci pencarian Anda.</p>
    </div>

    <div class="px-6 py-4 border-t dark:bg-slate-900 border-[#EFECE6]/80 flex flex-col md:flex-row items-center justify-between gap-4 bg-white/50">
        <span class="text-[11px] text-gray-400 font-medium">
            Menampilkan 1 - 5 dari 1,284 pelanggan
        </span>

        <div class="flex items-center gap-1.5">
            <button class="w-7 h-7 flex items-center justify-center rounded-md border border-gray-100 bg-white text-gray-400 hover:bg-gray-50 hover:border-gray-200 transition shadow-sm">
                <i class="fas fa-chevron-left text-[9px]"></i>
            </button>

            <button class="w-7 h-7 flex items-center justify-center rounded-md bg-[#594A3F] text-white text-xs font-bold shadow-sm">
                1
            </button>

            <button class="w-7 h-7 flex items-center justify-center rounded-md border border-gray-100 bg-white text-gray-500 text-xs font-bold hover:bg-gray-50 hover:border-gray-200 transition shadow-sm">
                2
            </button>

            <button class="w-7 h-7 flex items-center justify-center rounded-md border border-gray-100 bg-white text-gray-500 text-xs font-bold hover:bg-gray-50 hover:border-gray-200 transition shadow-sm">
                3
            </button>

            <span class="w-7 h-7 flex items-center justify-center text-gray-400 text-xs tracking-widest">
                ...
            </span>

            <button class="w-7 h-7 flex items-center justify-center rounded-md border border-gray-100 bg-white text-gray-400 hover:bg-gray-50 hover:border-gray-200 transition shadow-sm">
                <i class="fas fa-chevron-right text-[9px]"></i>
            </button>
        </div>
    </div>
</section>
</section>

<script>
    // Struktur data disesuaikan dengan gambar
    let customers = [
        {
            id: 1,
            name: "Andi Saputra",
            member_since: "Jan 2023",
            phone: "+62 812-3456-7890",
            address: "Jl. Merdeka No. 123,<br>Jakarta Selatan",
            total_orders: 12,
            badge_bg: "bg-[#F6EFE6]",
            badge_text: "text-[#8C7A6B]",
            status: "Aktif",
            status_color: "text-green-500",
            avatar: "https://i.pravatar.cc/150?u=1", 
            initials: "AS",
            row_bg: "bg-white"
        },
        {
            id: 2,
            name: "Budi Nugraha",
            member_since: "Mar 2023",
            phone: "+62 856-7890-1234",
            address: "Komp. Griya Asri Blok C-4,<br>Bandung",
            total_orders: 8,
            badge_bg: "bg-[#E0F2F1]",
            badge_text: "text-[#00796B]",
            status: "Aktif",
            status_color: "text-green-500",
            avatar: "https://i.pravatar.cc/150?u=2",
            initials: "BN",
            row_bg: "bg-[#FAF9F6]" // Efek background slightly beige seperti di gambar
        },
        {
            id: 3,
            name: "Citra Putri",
            member_since: "Feb 2024",
            phone: "+62 821-4455-6677",
            address: "Apartemen Roseville, Lt 12,<br>Tangerang",
            total_orders: 5,
            badge_bg: "bg-[#FCE4EC]",
            badge_text: "text-[#C2185B]",
            status: "Menunggu",
            status_color: "text-orange-500",
            avatar: "https://i.pravatar.cc/150?u=3",
            initials: "CP",
            row_bg: "bg-white"
        },
        {
            id: 4,
            name: "Dedi Mulyadi",
            member_since: "Nov 2022",
            phone: "+62 899-0011-2233",
            address: "Jl. Gatot Subroto No. 45,<br>Semarang",
            total_orders: 28,
            badge_bg: "bg-[#E8EAF6]",
            badge_text: "text-[#3F51B5]",
            status: "Tidak Aktif",
            status_color: "text-gray-400",
            avatar: "https://i.pravatar.cc/150?u=4",
            initials: "DM",
            row_bg: "bg-white"
        },
        {
            id: 5,
            name: "Eka Kusuma",
            member_since: "Mei 2024",
            phone: "+62 813-9988-7766",
            address: "Perumahan Elit Graha 2,<br>Surabaya",
            total_orders: 2,
            badge_bg: "bg-[#F6EFE6]",
            badge_text: "text-[#8C7A6B]",
            status: "Aktif",
            status_color: "text-green-500",
            avatar: null, // Simulasi tanpa foto profil, menggunakan inisial
            initials: "EK",
            row_bg: "bg-white"
        }
    ];

    let searchQuery = ""; 

    const tableBody = document.getElementById('customer-table-body');
    const emptyState = document.getElementById('empty-state');

    // Menjalankan fungsi render saat halaman pertama dimuat
    renderTable();

    function renderTable() {
        const filtered = customers.filter(c => 
            c.name.toLowerCase().includes(searchQuery.toLowerCase()) || 
            c.phone.includes(searchQuery)
        );

        if (filtered.length === 0) {
            tableBody.innerHTML = '';
            emptyState.classList.remove('hidden');
            return;
        }

        emptyState.classList.add('hidden');
        tableBody.innerHTML = filtered.map(c => {
            
            // Logika untuk menampilkan gambar profil atau inisial
            const avatarElement = c.avatar 
                ? `<img src="${c.avatar}" alt="${c.name}" class="w-10 h-10 rounded-full object-cover shrink-0 shadow-sm">`
                : `<div class="w-10 h-10 rounded-full bg-gray-200 text-gray-500 font-bold text-xs flex items-center justify-center tracking-wider shrink-0 shadow-sm">${c.initials}</div>`;

            return `
                <tr class="${c.row_bg} hover:bg-slate-50 transition duration-150 dark:bg-slate-900">
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-3">
                            ${avatarElement}
                            <div>
                                <span class="block text-sm font-bold text-slate-800 dark:text-slate-100">${c.name}</span>
                                <span class="block text-[10px] text-gray-400 mt-0.5">Member sejak ${c.member_since}</span>
                            </div>
                        </div>
                    </td>
                    
                    <td class="px-6 py-5 align-top">
                        <span class="block mt-1 font-medium text-gray-600 dark:text-slate-300 w-32 break-words">
                            ${c.phone}
                        </span>
                    </td>
                    
                    <td class="px-6 py-5 align-top">
                        <span class="block mt-1 text-gray-500 dark:text-slate-400">
                            ${c.address}
                        </span>
                    </td>
                    
                    <td class="px-6 py-5 align-top">
                        <div class="inline-flex items-center px-2.5 py-1 rounded-full ${c.badge_bg} ${c.badge_text} text-[10px] font-bold mt-1">
                            ${c.total_orders} Pesanan
                        </div>
                    </td>
                    
                    <td class="px-6 py-5 align-top">
                        <div class="flex items-center gap-1.5 mt-2">
                            <div class="w-1.5 h-1.5 rounded-full ${c.status_color.replace('text', 'bg')}"></div>
                            <span class="${c.status_color} text-[10px] font-bold uppercase tracking-wide">${c.status}</span>
                        </div>
                    </td>
                    
                    <td class="px-6 py-5 align-top">
                        <div class="flex items-center justify-center gap-2 mt-1">
                            <button onclick="editCustomer(${c.id})" class="w-8 h-8 rounded border border-gray-200 flex items-center justify-center text-gray-400 hover:text-blue-600 hover:border-blue-300 transition" title="Edit Data">
                                <i class="fas fa-pencil-alt text-xs"></i>
                            </button>
                            <button onclick="deleteCustomer(${c.id})" class="w-8 h-8 rounded border border-gray-200 flex items-center justify-center text-gray-400 hover:text-red-500 hover:border-red-300 transition" title="Hapus Data">
                                <i class="far fa-trash-alt text-xs"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `;
        }).join('');
    }

    // Fungsi placeholder
    function editCustomer(id) {
        console.log("Edit ID:", id);
    }
    function deleteCustomer(id) {
        console.log("Hapus ID:", id);
    }
</script>

@endsection()