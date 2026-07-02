@extends ('layouts.app')

@section('breadcrumb-parent', 'halaman')
@section('breadcrumb-active', 'data pelanggan')

@section ('content')
    <!-- Page Content Title & Subtitle -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1
                class="font-serif text-3xl font-bold text-primary dark:text-white mb-1 tracking-tight"
            >
                Data Pelanggan
            </h1>
            <p class="text-xs text-grey dark:text-slate-400 font-medium">Kelola informasi kontak dan riwayat pesanan pelanggan Anda.</p>
        </div>

        <button
            id="btn-add-new"
            class="flex items-center justify-center gap-2 bg-primary hover:bg-secondary text-accent font-semibold text-xs px-5 py-3 rounded-xl shadow-lg shadow-primary/15 transition duration-200 group active:scale-95"
        >
            <i
                class="fa-solid fa-user-plus text-[10px] group-hover:rotate-90 transition-transform duration-200"
            ></i>
            <span>Tambah Pelanggan</span>
        </button>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-[30px]">
        <!-- Card 1 -->
        <div
            class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-800 flex flex-col justify-between h-36 relative overflow-hidden group hover:border-gray-300 dark:hover:border-slate-700 transition-colors"
        >
            <p class="text-[11px] font-bold text-gray-400 dark:text-slate-500 tracking-wider mb-4 uppercase">Total Pelanggan</p>
            <div class="flex items-end justify-between mt-auto z-10">
                <h3
                    class="font-serif text-[32px] leading-none font-bold text-slate-800 dark:text-white"
                >
                    {{ number_format($totalPelanggan) }}
                </h3>
                <span
                    class="flex items-center gap-1 text-xs font-semibold text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/30 border border-emerald-100 dark:border-emerald-900/50 px-2 py-1 rounded-lg"
                >
                    <i class="fa-solid fa-users"></i>
                </span>
            </div>
            <!-- Decorative background -->
            <div
                class="absolute -bottom-8 -right-8 w-32 h-32 bg-gray-50 dark:bg-slate-800/50 rounded-full opacity-50 group-hover:scale-110 transition-transform"
            ></div>
            <div
                class="absolute -bottom-4 -right-4 w-20 h-20 bg-white dark:bg-slate-900 rounded-full opacity-50"
            ></div>
        </div>

        <!-- Card 2 -->
        <div
            class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-800 flex flex-col justify-between h-36 relative overflow-hidden group hover:border-gray-300 dark:hover:border-slate-700 transition-colors"
        >
            <p class="text-[11px] font-bold text-gray-400 dark:text-slate-500 tracking-wider mb-4 uppercase">Pelanggan Aktif</p>
            <div class="flex items-end justify-between mt-auto z-10">
                <h3
                    class="font-serif text-[32px] leading-none font-bold text-slate-800 dark:text-white"
                >
                    {{ number_format($pelangganAktif) }}
                </h3>
                <span
                    class="flex items-center gap-1 text-xs font-semibold text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/30 border border-emerald-100 dark:border-emerald-900/50 px-2 py-1 rounded-lg"
                >
                    <i class="fa-solid fa-user-check"></i>
                </span>
            </div>
            <!-- Decorative background -->
            <div
                class="absolute -bottom-8 -right-8 w-32 h-32 bg-gray-50 dark:bg-slate-800/50 rounded-full opacity-50 group-hover:scale-110 transition-transform"
            ></div>
            <div
                class="absolute -bottom-4 -right-4 w-20 h-20 bg-white dark:bg-slate-900 rounded-full opacity-50"
            ></div>
        </div>

        <!-- Card 3 -->
        <div
            class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-800 flex flex-col justify-between h-36 relative overflow-hidden group hover:border-gray-300 dark:hover:border-slate-700 transition-colors"
        >
            <p class="text-[11px] font-bold text-gray-400 dark:text-slate-500 tracking-wider mb-4 uppercase">Member Baru</p>
            <div class="flex items-end justify-between mt-auto z-10">
                <h3
                    class="font-serif text-[32px] leading-none font-bold text-slate-800 dark:text-white"
                >
                    {{ number_format($memberBaru) }}
                </h3>
                <span
                    class="flex items-center gap-1 text-xs font-semibold text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-950/30 border border-blue-100 dark:border-blue-900/50 px-2 py-1 rounded-lg"
                >
                    <i class="fa-solid fa-user-plus"></i> Bulan Ini
                </span>
            </div>
            <!-- Decorative background -->
            <div
                class="absolute -bottom-8 -right-8 w-32 h-32 bg-gray-50 dark:bg-slate-800/50 rounded-full opacity-50 group-hover:scale-110 transition-transform"
            ></div>
            <div
                class="absolute -bottom-4 -right-4 w-20 h-20 bg-white dark:bg-slate-900 rounded-full opacity-50"
            ></div>
        </div>

        <!-- Card 3 -->
        <div
            class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-800 flex flex-col justify-between h-36 relative overflow-hidden group hover:border-gray-300 dark:hover:border-slate-700 transition-colors"
        >
            <p class="text-[11px] font-bold text-gray-400 dark:text-slate-500 tracking-wider mb-4 uppercase">Repeat Order</p>
            <div class="flex items-end justify-between mt-auto z-10">
                <h3
                    class="font-serif text-[32px] leading-none font-bold text-slate-800 dark:text-white"
                >
                    {{ $repeatOrder }}%
                </h3>
                <span
                    class="flex items-center gap-1 text-xs font-semibold text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-950/30 border border-blue-100 dark:border-blue-900/50 px-2 py-1 rounded-lg"
                >
                    <i class="fa-solid fa-rotate-right"></i> Loyalitas
                </span>
            </div>
            <!-- Decorative background -->
            <div
                class="absolute -bottom-8 -right-8 w-32 h-32 bg-gray-50 dark:bg-slate-800/50 rounded-full opacity-50 group-hover:scale-110 transition-transform"
            ></div>
            <div
                class="absolute -bottom-4 -right-4 w-20 h-20 bg-white dark:bg-slate-900 rounded-full opacity-50"
            ></div>
        </div>
    </div>

    <section
        class="lg:col-span-2 bg-white dark:bg-slate-900 rounded-2xl border border-[#EFECE6] dark:border-slate-800 shadow-[0_8px_30px_rgb(0,0,0,0.02)] overflow-hidden"
    >
        <div
            class="px-6 py-5 border-b border-[#EFECE6]/80 dark:border-slate-800/80 flex justify-between items-center"
        >
            <h3 class="text-sm font-bold tracking-tight text-slate-800 dark:text-white">
                Semua Pelanggan
            </h3>
            <button
                id="filter-btn"
                class="w-8 h-8 rounded-lg border border-[#EFECE6] dark:border-slate-800 bg-white dark:bg-slate-800 flex items-center justify-center text-xs text-gray-500 dark:text-slate-400 hover:text-blue-600 hover:border-gray-300 transition"
            >
                <i class="fas fa-sliders-h"></i>
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr
                        class="bg-white dark:bg-slate-800/30 border-b border-[#EFECE6]/80 dark:border-slate-800/80 text-[10px] font-bold tracking-wider text-gray-400 dark:text-slate-400 uppercase"
                    >
                        <th class="px-6 py-4">Nama Pelanggan</th>
                        <th class="px-6 py-4">No. Telepon</th>
                        <th class="px-6 py-4">Alamat</th>
                        <th class="px-6 py-4">Total Pesanan</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody
                    id="customer-table-body"
                    class="divide-y divide-[#EFECE6]/50 text-xs font-medium text-gray-600"
                ></tbody>
            </table>
        </div>

        <div id="empty-state" class="hidden py-16 px-6 text-center">
            <div
                class="w-16 h-16 rounded-full bg-slate-50 flex items-center justify-center mx-auto mb-4 text-gray-400"
            >
                <i class="fas fa-search text-xl"></i>
            </div>
            <h4 class="text-sm font-semibold text-slate-800 mb-1">Pelanggan Tidak Ditemukan</h4>
            <p class="text-xs text-gray-500 max-w-xs mx-auto">Tidak ada data pelanggan yang cocok dengan kata kunci pencarian Anda.</p>
        </div>

        <div
            class="px-6 py-4 border-t dark:bg-slate-900 border-[#EFECE6]/80 flex flex-col md:flex-row items-center justify-between gap-4 bg-white/50"
        >
            <span class="text-[11px] text-gray-400 font-medium" id="pagination-info">
                <!-- Diisi oleh JS -->
            </span>

            <div class="flex items-center gap-1.5" id="pagination-controls">
                <!-- Diisi oleh JS -->
            </div>
        </div>
    </section>
    </section>
    
    <!-- Modal Tambah/Edit Pelanggan -->
    <div id="customerModal" class="fixed inset-0 z-50 hidden bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white dark:bg-slate-900 w-full max-w-lg rounded-3xl shadow-2xl border border-gray-100 dark:border-slate-800 overflow-hidden transform transition-all">
            <div class="px-6 py-4 border-b border-gray-100 dark:border-slate-800 flex items-center justify-between">
                <h3 id="modalTitle" class="font-bold text-lg text-slate-800 dark:text-white">Tambah Pelanggan Baru</h3>
                <button type="button" onclick="closeModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <form id="customerForm" onsubmit="saveCustomer(event)" class="p-6 space-y-4">
                <input type="hidden" id="customerId" value="">
                
                <div>
                    <label class="block text-xs font-bold text-gray-700 dark:text-slate-300 mb-1">Nama Lengkap *</label>
                    <input type="text" id="customerName" required class="w-full bg-gray-50 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm text-slate-800 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition" placeholder="Contoh: Andi Saputra">
                </div>
                
                <div>
                    <label class="block text-xs font-bold text-gray-700 dark:text-slate-300 mb-1">No. Telepon</label>
                    <input type="text" id="customerPhone" class="w-full bg-gray-50 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm text-slate-800 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition" placeholder="Contoh: 081234567890">
                </div>
                
                <div>
                    <label class="block text-xs font-bold text-gray-700 dark:text-slate-300 mb-1">Alamat Lengkap</label>
                    <textarea id="customerAddress" rows="3" class="w-full bg-gray-50 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm text-slate-800 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition" placeholder="Contoh: Jl. Merdeka No. 123..."></textarea>
                </div>
                
                <div>
                    <label class="block text-xs font-bold text-gray-700 dark:text-slate-300 mb-1">Status Pelanggan *</label>
                    <select id="customerStatus" class="w-full bg-gray-50 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm text-slate-800 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition">
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                        <option value="Menunggu">Menunggu</option>
                    </select>
                </div>
                
                <div class="pt-4 flex items-center justify-end gap-3 border-t border-gray-100 dark:border-slate-800 mt-6">
                    <button type="button" onclick="closeModal()" class="px-5 py-2.5 text-sm font-bold text-gray-500 hover:bg-gray-100 dark:hover:bg-slate-800 rounded-xl transition">Batal</button>
                    <button type="submit" id="btnSaveCustomer" class="px-5 py-2.5 text-sm font-bold text-white bg-primary hover:bg-secondary rounded-xl transition shadow-lg shadow-primary/20 flex items-center gap-2">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let customersData = @json($customers ?? []);
        let customers = customersData;

        let urlParams = new URLSearchParams(window.location.search);
        let searchQuery = urlParams.get('q') || '';
        let currentPage = 1;
        const itemsPerPage = 10;

        const tableBody = document.getElementById('customer-table-body');
        const emptyState = document.getElementById('empty-state');
        const paginationControls = document.getElementById('pagination-controls');
        
        // Listener pencarian global
        const searchInput = document.getElementById('search-input');
        if (searchInput) {
            searchInput.addEventListener('input', function (e) {
                searchQuery = e.target.value;
                currentPage = 1; // Reset ke halaman pertama saat mencari
                renderTable();
            });
        }

        // Menjalankan fungsi render saat halaman pertama dimuat
        renderTable();

        window.changePage = function(page) {
            currentPage = page;
            renderTable();
        };

        function renderTable() {
            try {
                const filtered = customers.filter(
                    (c) =>
                        (c.name && String(c.name).toLowerCase().includes(searchQuery.toLowerCase())) ||
                        (c.phone && String(c.phone).includes(searchQuery))
                );
            
            const totalPages = Math.ceil(filtered.length / itemsPerPage);
            const startIndex = (currentPage - 1) * itemsPerPage;
            const paginatedItems = filtered.slice(startIndex, startIndex + itemsPerPage);

            if (filtered.length === 0) {
                tableBody.innerHTML = '';
                emptyState.classList.remove('hidden');
                document.getElementById('pagination-info').innerText = 'Tidak ada data';
                paginationControls.innerHTML = '';
                return;
            }

            emptyState.classList.add('hidden');
            tableBody.innerHTML = paginatedItems
                .map((c) => {
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
                })
                .join('');
                
            // Update info
            const endItem = Math.min(startIndex + itemsPerPage, filtered.length);
            document.getElementById('pagination-info').innerText = 
                `Menampilkan ${startIndex + 1} - ${endItem} dari ${filtered.length} pelanggan`;
                
                // Update tombol paginasi
                renderPagination(totalPages);
            } catch (error) {
                tableBody.innerHTML = `<tr><td colspan="6" class="text-red-500 font-bold p-4">Error JS: ${error.message} - ${error.stack}</td></tr>`;
                emptyState.classList.add('hidden');
            }
        }

        function renderPagination(totalPages) {
            let html = '';
            
            // Prev button
            html += `
                <button onclick="changePage(${currentPage - 1})" ${currentPage === 1 ? 'disabled' : ''}
                    class="w-7 h-7 flex items-center justify-center rounded-md border border-gray-100 bg-white text-gray-400 hover:bg-gray-50 hover:border-gray-200 transition shadow-sm disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    <i class="fas fa-chevron-left text-[9px]"></i>
                </button>
            `;
            
            // Page numbers
            for (let i = 1; i <= totalPages; i++) {
                if (i === currentPage) {
                    html += `<button class="w-7 h-7 flex items-center justify-center rounded-md bg-[#594A3F] text-white text-xs font-bold shadow-sm">${i}</button>`;
                } else {
                    html += `<button onclick="changePage(${i})" class="w-7 h-7 flex items-center justify-center rounded-md border border-gray-100 bg-white text-gray-500 text-xs font-bold hover:bg-gray-50 hover:border-gray-200 transition shadow-sm">${i}</button>`;
                }
            }
            
            // Next button
            html += `
                <button onclick="changePage(${currentPage + 1})" ${currentPage === totalPages ? 'disabled' : ''}
                    class="w-7 h-7 flex items-center justify-center rounded-md border border-gray-100 bg-white text-gray-400 hover:bg-gray-50 hover:border-gray-200 transition shadow-sm disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    <i class="fas fa-chevron-right text-[9px]"></i>
                </button>
            `;
            
            paginationControls.innerHTML = html;
        }

        // Modal Logic
        const modal = document.getElementById('customerModal');
        const form = document.getElementById('customerForm');
        
        document.getElementById('btn-add-new').addEventListener('click', () => {
            document.getElementById('modalTitle').innerText = 'Tambah Pelanggan Baru';
            form.reset();
            document.getElementById('customerId').value = '';
            modal.classList.remove('hidden');
        });

        function closeModal() {
            modal.classList.add('hidden');
        }

        function editCustomer(id) {
            const customer = customersData.find(c => c.id === id);
            if (!customer) return;
            
            document.getElementById('modalTitle').innerText = 'Edit Data Pelanggan';
            document.getElementById('customerId').value = customer.id;
            document.getElementById('customerName').value = customer.name;
            document.getElementById('customerPhone').value = customer.phone;
            document.getElementById('customerAddress').value = customer.address;
            document.getElementById('customerStatus').value = customer.status;
            
            modal.classList.remove('hidden');
        }

        function saveCustomer(e) {
            e.preventDefault();
            
            const btn = document.getElementById('btnSaveCustomer');
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
            btn.disabled = true;
            
            const id = document.getElementById('customerId').value;
            const payload = {
                name: document.getElementById('customerName').value,
                phone: document.getElementById('customerPhone').value,
                address: document.getElementById('customerAddress').value,
                status: document.getElementById('customerStatus').value,
            };
            
            const url = id ? `/data-pelanggan/${id}` : '/data-pelanggan/simpan';
            const method = id ? 'PUT' : 'POST';
            
            fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(payload)
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    alert(id ? 'Data berhasil diperbarui!' : 'Pelanggan berhasil ditambahkan!');
                    window.location.reload();
                } else {
                    alert('Gagal menyimpan data.');
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                }
            })
            .catch(err => {
                console.error(err);
                alert('Terjadi kesalahan.');
                btn.innerHTML = originalText;
                btn.disabled = false;
            });
        }

        function deleteCustomer(id) {
            if (confirm('Apakah Anda yakin ingin menghapus pelanggan ini?')) {
                fetch(`/data-pelanggan/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        customersData.splice(customersData.findIndex(c => c.id === id), 1);
                        renderTable();
                        alert('Pelanggan berhasil dihapus');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal menghapus data pelanggan.');
                });
            }
        }
    </script>

@endsection ()
