<script>
    let customersData = @json ($customers ?? []);
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

    window.changePage = function (page) {
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
                        <button onclick="editUkuran(${c.id})" class="w-8 h-8 rounded border border-gray-200 flex items-center justify-center text-gray-400 hover:text-green-600 hover:border-green-300 transition" title="Edit Ukuran Baju">
                            <i class="fas fa-ruler-combined text-xs"></i>
                        </button>
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
        const customer = customersData.find((c) => c.id === id);
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
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify(payload),
        })
            .then((res) => res.json())
            .then((data) => {
                if (data.success) {
                    alert(id ? 'Data berhasil diperbarui!' : 'Pelanggan berhasil ditambahkan!');
                    window.location.reload();
                } else {
                    alert('Gagal menyimpan data.');
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                }
            })
            .catch((err) => {
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
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        customersData.splice(
                            customersData.findIndex((c) => c.id === id),
                            1
                        );
                        renderTable();
                        alert('Pelanggan berhasil dihapus');
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                    alert('Gagal menghapus data pelanggan.');
                });
        }
    }

    const ukuranModal = document.getElementById('ukuranModal');

    function editUkuran(id) {
        const customer = customersData.find((c) => c.id === id);
        if (!customer) return;

        document.getElementById('ukuranModalBadge').innerText = customer.name;
        document.getElementById('ukuranCustomerId').value = customer.id;
        document.getElementById('ukuranCustomerName').value = customer.name;

        const u = customer.ukuran || {};
        document.getElementById('input-l-badan').value = u.l_badan || 0;
        document.getElementById('input-l-pinggang').value = u.l_pinggang || 0;
        document.getElementById('input-l-punggung').value = u.l_punggung || 0;
        document.getElementById('input-p-bahu').value = u.p_bahu || 0;
        document.getElementById('input-p-lengan').value = u.p_lengan || 0;
        document.getElementById('input-l-lengan').value = u.l_lengan || 0;
        document.getElementById('input-l-dada').value = u.l_dada || 0;
        document.getElementById('input-t-susu').value = u.t_susu || 0;
        document.getElementById('input-t-pinggang').value = u.t_pinggang || 0;
        document.getElementById('input-l-pinggul').value = u.l_pinggul || 0;
        document.getElementById('input-p-baju').value = u.p_baju || 0;
        document.getElementById('input-l-ketiak').value = u.l_ketiak || 0;
        document.getElementById('input-p-rok').value = u.p_rok || 0;

        ukuranModal.classList.remove('hidden');
    }

    function closeUkuranModal() {
        ukuranModal.classList.add('hidden');
    }

    function saveUkuran(e) {
        e.preventDefault();

        const btn = document.getElementById('btnSaveUkuran');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
        btn.disabled = true;

        const payload = {
            id: document.getElementById('ukuranCustomerId').value,
            name: document.getElementById('ukuranCustomerName').value,
            l_badan: parseInt(document.getElementById('input-l-badan').value) || 0,
            l_pinggang: parseInt(document.getElementById('input-l-pinggang').value) || 0,
            l_punggung: parseInt(document.getElementById('input-l-punggung').value) || 0,
            p_bahu: parseInt(document.getElementById('input-p-bahu').value) || 0,
            p_lengan: parseInt(document.getElementById('input-p-lengan').value) || 0,
            l_lengan: parseInt(document.getElementById('input-l-lengan').value) || 0,
            l_dada: parseInt(document.getElementById('input-l-dada').value) || 0,
            t_susu: parseInt(document.getElementById('input-t-susu').value) || 0,
            t_pinggang: parseInt(document.getElementById('input-t-pinggang').value) || 0,
            l_pinggul: parseInt(document.getElementById('input-l-pinggul').value) || 0,
            p_baju: parseInt(document.getElementById('input-p-baju').value) || 0,
            l_ketiak: parseInt(document.getElementById('input-l-ketiak').value) || 0,
            p_rok: parseInt(document.getElementById('input-p-rok').value) || 0,
        };

        fetch('/ukuran-baju/simpan', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify(payload),
        })
            .then((res) => res.json())
            .then((data) => {
                if (data.success) {
                    alert('Data ukuran berhasil disimpan!');
                    window.location.reload();
                } else {
                    alert('Gagal menyimpan data ukuran.');
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                }
            })
            .catch((err) => {
                console.error(err);
                alert('Terjadi kesalahan.');
                btn.innerHTML = originalText;
                btn.disabled = false;
            });
    }
</script>
