<!-- Dynamic Logic for the Dashboard page -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Data from DB
            let customers = {!! json_encode($customers ?? []) !!};

            // Active State variables
            let selectedCustomerId = customers.length > 0 ? customers[0].id : null;
            let isCreatingMode = false;
            let searchQuery = '';

            // DOM Elements
            const tableBody = document.getElementById('customer-table-body');
            const emptyState = document.getElementById('empty-state');
            const searchInput = document.getElementById('search-input');

            const formPanel = document.getElementById('form-panel');
            const formTitle = document.getElementById('form-title');
            const formBadge = document.getElementById('form-badge');
            const customerNameGroup = document.getElementById('customer-name-group');
            const measurementForm = document.getElementById('measurement-form');

            // Form input elements
            const inputId = document.createElement('input');
            inputId.type = 'hidden';
            inputId.name = 'id';
            measurementForm.appendChild(inputId);

            const inputName = document.getElementById('input-name');
            const inputLBadan = document.getElementById('input-l-badan');
            const inputLPinggang = document.getElementById('input-l-pinggang');
            const inputLPunggung = document.getElementById('input-l-punggung');
            const inputPBahu = document.getElementById('input-p-bahu');
            const inputPLengan = document.getElementById('input-p-lengan');
            const inputLLengan = document.getElementById('input-l-lengan');
            const inputTSusu = document.getElementById('input-t-susu');
            const inputTPinggang = document.getElementById('input-t-pinggang');
            const inputLPinggul = document.getElementById('input-l-pinggul');
            const inputPBaju = document.getElementById('input-p-baju');
            const inputPRok = document.getElementById('input-p-rok');

            // Buttons
            const btnAddNew = document.getElementById('btn-add-new');
            const btnCancel = document.getElementById('btn-cancel');
            const btnSubmit = document.getElementById('btn-submit');
            const filterBtn = document.getElementById('filter-btn');

            // Mobile Sidebar elements
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebar-overlay');

            // Initial Render
            renderTable();
            loadActiveCustomer();

            // Mobile Sidebar Toggling logic
            if (mobileMenuBtn) {
                mobileMenuBtn.addEventListener('click', toggleSidebar);
                sidebarOverlay.addEventListener('click', toggleSidebar);
            }

            function toggleSidebar() {
                sidebar.classList.toggle('-translate-x-full');
                sidebarOverlay.classList.toggle('hidden');
            }

            // Helper: Show Toast Notification
            function showNotification(message, iconClass = 'fa-check-circle') {
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

            // Helper: Get Initials from Name
            function getInitials(name) {
                return name
                    .split(' ')
                    .slice(0, 2)
                    .map((word) => word.charAt(0).toUpperCase())
                    .join('');
            }

            // Render customer list in table
            function renderTable() {
                // Filter list based on search input
                const filtered = customers.filter((c) =>
                    c.name.toLowerCase().includes(searchQuery.toLowerCase())
                );

                if (filtered.length === 0) {
                    tableBody.innerHTML = '';
                    emptyState.classList.remove('hidden');
                    return;
                }

                emptyState.classList.add('hidden');
                tableBody.innerHTML = filtered
                    .map((c) => {
                        const isActive = c.id === selectedCustomerId && !isCreatingMode;
                        const activeClasses = isActive
                            ? 'bg-[#FAF9F6] dark:bg-slate-800/60 border-l-4 border-primary'
                            : 'hover:bg-background/50 dark:hover:bg-slate-800/30 border-l-4 border-transparent';

                        return `
                    <tr class="transition duration-150 cursor-pointer ${activeClasses}" onclick="selectCustomer(${c.id})">
                        <td class="px-6 py-4 font-semibold text-primary">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full ${c.avatarBg} font-bold text-[10px] flex items-center justify-center tracking-wider shrink-0 shadow-sm border border-black/5">
                                    ${c.initials}
                                </div>
                                <span class="truncate max-w-[120px] md:max-w-none block text-sm font-bold text-primary dark:text-slate-100">${c.name}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center font-medium dark:text-slate-300">${c.l_badan} cm</td>
                        <td class="px-6 py-4 text-center font-medium dark:text-slate-300">${c.l_pinggang} cm</td>
                        <td class="px-6 py-4 text-center font-medium dark:text-slate-300">${c.p_baju} cm</td>
                        <td class="px-6 py-4 text-center font-light text-gray-500 dark:text-slate-400">${c.updated_at}</td>
                        <td class="px-6 py-4 text-right" onclick="event.stopPropagation()">
                            <div class="flex items-center justify-end gap-2.5">
                                <button onclick="editCustomerFromAction(${c.id})" class="text-grey dark:text-slate-400 hover:text-primary dark:hover:text-accent hover:scale-110 p-1 transition" title="Edit Ukuran">
                                    <i class="far fa-edit text-xs"></i>
                                </button>
                                <button onclick="deleteCustomer(${c.id})" class="text-grey dark:text-slate-400 hover:text-red-700 hover:scale-110 p-1 transition" title="Hapus Pelanggan">
                                    <i class="far fa-trash-can text-xs"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
                    })
                    .join('');
            }

            // Select a customer row
            window.selectCustomer = function (id) {
                if (isCreatingMode) {
                    if (
                        !confirm(
                            'Batalkan penambahan ukuran baru? Perubahan yang belum disimpan akan hilang.'
                        )
                    ) {
                        return;
                    }
                }
                isCreatingMode = false;
                selectedCustomerId = id;
                renderTable();
                loadActiveCustomer();
            };

            // Edit button click in row
            window.editCustomerFromAction = function (id) {
                window.selectCustomer(id);
                // Flash the form to indicate visual focus
                formPanel.classList.add('ring-2', 'ring-primary/30');
                setTimeout(() => {
                    formPanel.classList.remove('ring-2', 'ring-primary/30');
                }, 600);
            };

            // Load active customer measurement data into form
            function loadActiveCustomer() {
                if (isCreatingMode) {
                    // Prepare form for addition
                    formTitle.innerText = 'Tambah Ukuran Baru';
                    formBadge.innerText = 'PELANGGAN BARU';
                    formBadge.className =
                        'bg-background text-grey text-[9px] font-bold tracking-wider px-2.5 py-1 rounded border border-[#EFECE6] dark:border-slate-800 uppercase';

                    customerNameGroup.classList.remove('hidden');

                    inputId.value = '';
                    inputName.value = '';
                    inputLBadan.value = '';
                    inputLPinggang.value = '';
                    inputLPunggung.value = '';
                    inputPBahu.value = '';
                    inputPLengan.value = '';
                    inputLLengan.value = '';
                    inputTSusu.value = '';
                    inputTPinggang.value = '';
                    inputLPinggul.value = '';
                    inputPBaju.value = '';
                    inputPRok.value = '';

                    btnSubmit.innerText = 'Simpan Data Baru';
                    inputName.focus();
                    return;
                }

                // Normal edit mode
                const customer = customers.find((c) => c.id === selectedCustomerId);
                if (!customer) return;

                formTitle.innerText = 'Edit Detail Ukuran';
                formBadge.innerText = customer.name;
                formBadge.className =
                    'bg-primary/10 text-primary dark:bg-slate-800 dark:text-accent text-[9px] font-bold tracking-wider px-2.5 py-1 rounded uppercase truncate max-w-[150px]';

                customerNameGroup.classList.add('hidden');

                inputId.value = customer.id;
                inputName.value = customer.name;
                inputLBadan.value = customer.l_badan;
                inputLPinggang.value = customer.l_pinggang;
                inputLPunggung.value = customer.l_punggung;
                inputPBahu.value = customer.p_bahu;
                inputPLengan.value = customer.p_lengan;
                inputLLengan.value = customer.l_lengan;
                inputTSusu.value = customer.t_susu;
                inputTPinggang.value = customer.t_pinggang;
                inputLPinggul.value = customer.l_pinggul;
                inputPBaju.value = customer.p_baju;
                inputPRok.value = customer.p_rok == 0 ? '' : customer.p_rok;

                btnSubmit.innerText = 'Simpan Perubahan';
            }

            // Add New click event
            btnAddNew.addEventListener('click', function () {
                isCreatingMode = true;
                selectedCustomerId = null;
                renderTable();
                loadActiveCustomer();
            });

            // Cancel click event
            btnCancel.addEventListener('click', function () {
                if (isCreatingMode) {
                    isCreatingMode = false;
                    // Revert to first customer if available
                    selectedCustomerId = customers.length > 0 ? customers[0].id : null;
                    renderTable();
                    loadActiveCustomer();
                } else {
                    // Just reload current customer measurements (revert changes)
                    loadActiveCustomer();
                    showNotification('Perubahan dibatalkan', 'fa-circle-info');
                }
            });

            // Search Input event
            searchInput.addEventListener('input', function (e) {
                searchQuery = e.target.value;
                renderTable();
            });

            // Delete customer action
            window.deleteCustomer = function (id) {
                const customer = customers.find((c) => c.id === id);
                if (!customer) return;

                if (
                    confirm(`Apakah Anda yakin ingin menghapus data ukuran pelanggan "${customer.name}"?`)
                ) {
                    btnSubmit.innerText = 'Menghapus...';
                    btnSubmit.disabled = true;

                    fetch(`/ukuran-baju/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            Accept: 'application/json',
                        },
                    })
                        .then((res) => res.json())
                        .then((data) => {
                            if (data.success) {
                                showNotification(
                                    `Data ukuran "${customer.name}" berhasil dihapus`,
                                    'fa-trash-can'
                                );
                                setTimeout(() => {
                                    window.location.reload();
                                }, 500);
                            } else {
                                alert('Gagal menghapus data.');
                                btnSubmit.innerText = 'Simpan Perubahan';
                                btnSubmit.disabled = false;
                            }
                        })
                        .catch((err) => {
                            console.error(err);
                            alert('Terjadi kesalahan jaringan');
                            btnSubmit.innerText = 'Simpan Perubahan';
                            btnSubmit.disabled = false;
                        });
                }
            };

            // Form Submit handler
            measurementForm.addEventListener('submit', function (e) {
                e.preventDefault();

                const name = inputName.value.trim();
                if (isCreatingMode && !name) {
                    alert('Nama pelanggan harus diisi!');
                    inputName.focus();
                    return;
                }

                btnSubmit.innerText = 'Menyimpan...';
                btnSubmit.disabled = true;

                const payload = {
                    id: isCreatingMode ? null : inputId.value,
                    name: isCreatingMode
                        ? name
                        : customerNameGroup.classList.contains('hidden')
                          ? inputName.value
                          : name,
                    l_badan: parseInt(inputLBadan.value) || 0,
                    l_pinggang: parseInt(inputLPinggang.value) || 0,
                    l_punggung: parseInt(inputLPunggung.value) || 0,
                    p_bahu: parseInt(inputPBahu.value) || 0,
                    p_lengan: parseInt(inputPLengan.value) || 0,
                    l_lengan: parseInt(inputLLengan.value) || 0,
                    t_susu: parseInt(inputTSusu.value) || 0,
                    t_pinggang: parseInt(inputTPinggang.value) || 0,
                    l_pinggul: parseInt(inputLPinggul.value) || 0,
                    p_baju: parseInt(inputPBaju.value) || 0,
                    p_rok: parseInt(inputPRok.value) || 0,
                };

                fetch('{{ route("ukuran-baju.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        Accept: 'application/json',
                    },
                    body: JSON.stringify(payload),
                })
                    .then((res) => res.json())
                    .then((data) => {
                        if (data.success) {
                            showNotification(
                                isCreatingMode
                                    ? `Data ukuran "${name}" berhasil ditambahkan!`
                                    : `Data ukuran "${name}" berhasil diperbarui!`
                            );
                            setTimeout(() => {
                                window.location.reload();
                            }, 500);
                        } else {
                            alert('Gagal menyimpan data.');
                            btnSubmit.innerText = isCreatingMode ? 'Simpan Data Baru' : 'Simpan Perubahan';
                            btnSubmit.disabled = false;
                        }
                    })
                    .catch((err) => {
                        console.error(err);
                        alert('Terjadi kesalahan jaringan');
                        btnSubmit.innerText = isCreatingMode ? 'Simpan Data Baru' : 'Simpan Perubahan';
                        btnSubmit.disabled = false;
                    });
            });

            // Filter button toggle sorting / custom action
            if (filterBtn) {
                filterBtn.addEventListener('click', function () {
                    // Reverse list sorting as a demonstration of dynamic capability
                    customers.reverse();
                    renderTable();
                    showNotification('Urutan daftar pelanggan diubah', 'fa-sort');
                });
            }
        });
    </script>