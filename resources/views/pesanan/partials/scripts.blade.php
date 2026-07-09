<script>
        document.addEventListener('DOMContentLoaded', function () {
            // Seed data matching the mockup exactly
            let orders = @json ($orders);
            let customerSizes = @json ($customers);

            // Seed timelines from controller
            let orderTimeline = @json ($orderTimeline);

            let currentFilter = 'Semua';
            let searchQuery = '';
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
                document.querySelectorAll('[id^="dropdown-"]').forEach((d) => d.classList.add('hidden'));

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
                searchInput.addEventListener('input', function (e) {
                    searchQuery = e.target.value;
                    renderOrders();
                });
            }

            // Status Tab Switches
            document.querySelectorAll('.status-tab').forEach((tab) => {
                tab.addEventListener('click', function () {
                    document.querySelectorAll('.status-tab').forEach((t) => {
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
                customerSearchInput.addEventListener('input', function () {
                    const query = this.value.trim().toLowerCase();
                    if (query === '') {
                        customerSearchResults.classList.add('hidden');
                        return;
                    }

                    const matched = customerSizes.filter((c) => c.name.toLowerCase().includes(query));
                    if (matched.length === 0) {
                        customerSearchResults.innerHTML = `<div class="px-4 py-2 text-xs text-gray-400">Tidak ada pelanggan ditemukan</div>`;
                    } else {
                        customerSearchResults.innerHTML = matched
                            .map(
                                (c) => `
                    <button type="button" class="w-full text-left px-4 py-2 text-xs text-slate-800 dark:text-slate-200 hover:bg-gray-50 dark:hover:bg-slate-700 flex items-center gap-2" onclick="selectCustomer(${c.id})">
                        <span class="w-5 h-5 rounded-full ${c.avatarBg} font-bold text-[9px] flex items-center justify-center">${c.initials}</span>
                        <span>${c.name}</span>
                    </button>
                `
                            )
                            .join('');
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
                detailUpdateProgress.addEventListener('input', function () {
                    detailUpdateProgressLabel.innerText = `${this.value}%`;
                });
            }

            // Close Dropdowns & Search results on outside clicks
            document.addEventListener('click', function (e) {
                if (customerSearchResults && !e.target.closest('#customer-search-container')) {
                    customerSearchResults.classList.add('hidden');
                }
                if (!e.target.closest('.relative')) {
                    document
                        .querySelectorAll('[id^="dropdown-"]')
                        .forEach((d) => d.classList.add('hidden'));
                }
            });

            // ==========================================================
            // JS ACTION CONTROLLERS
            // ==========================================================

            // Photo file handling (Read as DataURL)
            function handlePhotoFile(file) {
                if (!file) return;
                const reader = new FileReader();
                reader.onload = function (e) {
                    uploadedImageDataUrl = e.target.result;
                    formPhotoPreview.src = uploadedImageDataUrl;
                    formPhotoPreview.classList.remove('hidden');
                    uploadPrompt.classList.add('hidden');

                    // TAMBAHKAN BARIS INI:
                    document.getElementById('form-photo-base64').value = uploadedImageDataUrl;
                };
                reader.readAsDataURL(file);
            }

            // Pre-populate customer details on Form View
            window.selectCustomer = function (id) {
                const customer = customerSizes.find((c) => c.id === id);
                if (!customer) return;

                selectedCustomer = customer;

                document.getElementById('form-pelanggan-id').value = customer.id;

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

            window.clearSelectedCustomer = function () {
                selectedCustomer = null;
                selectedCustomerDisplay.classList.add('hidden');
                document.getElementById('customer-search-container').classList.remove('hidden');
                customerSearchInput.value = '';
                customerSearchInput.focus();

                // Clear Measurements inputs
                document.getElementById('input-l-badan').value = '';
                document.getElementById('input-l-pinggang').value = '';
                document.getElementById('input-l-punggung').value = '';
                document.getElementById('input-p-bahu').value = '';
                document.getElementById('input-p-lengan').value = '';
                document.getElementById('input-l-lengan').value = '';
                document.getElementById('input-t-susu').value = '';
                document.getElementById('input-t-pinggang').value = '';
                document.getElementById('input-l-pinggul').value = '';
                document.getElementById('input-p-baju').value = '';
                document.getElementById('input-p-rok').value = '';
            };

            window.openQuickCustomerModal = function () {
                const modal = document.getElementById('quick-customer-modal');
                const container = document.getElementById('quick-customer-modal-container');
                modal.classList.remove('hidden');
                setTimeout(() => {
                    container.classList.remove('scale-95', 'opacity-0');
                    container.classList.add('scale-100', 'opacity-100');
                }, 50);
            };

            window.closeQuickCustomerModal = function () {
                const modal = document.getElementById('quick-customer-modal');
                const container = document.getElementById('quick-customer-modal-container');
                container.classList.remove('scale-100', 'opacity-100');
                container.classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 300);
            };

            window.saveQuickCustomer = function (event) {
                event.preventDefault();
                const nameInput = document.getElementById('quick-customer-name');
                const phoneInput = document.getElementById('quick-customer-phone');
                const addressInput = document.getElementById('quick-customer-address');

                const name = nameInput.value.trim();
                const phone = phoneInput.value.trim();
                const address = addressInput.value.trim();

                if (!name || !phone) return;

                // Auto-generate average measurement sizing metrics
                const numericFields = [
                    'l_badan',
                    'l_pinggang',
                    'l_punggung',
                    'p_bahu',
                    'p_lengan',
                    'l_lengan',
                    't_susu',
                    't_pinggang',
                    'l_pinggul',
                    'p_baju',
                ];
                const averages = {};

                numericFields.forEach((field) => {
                    const values = customerSizes
                        .map((c) => parseFloat(c[field]))
                        .filter((val) => !isNaN(val));
                    const sum = values.reduce((a, b) => a + b, 0);
                    averages[field] = values.length > 0 ? Math.round(sum / values.length) : 0;
                });

                const newId =
                    customerSizes.length > 0 ? Math.max(...customerSizes.map((c) => c.id)) + 1 : 1;
                const initials =
                    name
                        .split(' ')
                        .map((n) => n[0])
                        .join('')
                        .substring(0, 2)
                        .toUpperCase() || 'P';
                const colorPool = [
                    'bg-[#2D6A4F] text-white',
                    'bg-[#8C6D58] text-white',
                    'bg-[#2F3E46] text-white',
                    'bg-[#457B9D] text-white',
                    'bg-[#E76F51] text-white',
                    'bg-[#2A9D8F] text-white',
                ];
                const avatarBg = colorPool[Math.floor(Math.random() * colorPool.length)];

                const newCustomer = {
                    id: newId,
                    name: name,
                    initials: initials,
                    avatarBg: avatarBg,
                    ...averages,
                    p_rok: '-',
                };

                customerSizes.push(newCustomer);

                // Select the newly added customer
                selectCustomer(newId);

                // Close modal
                closeQuickCustomerModal();

                // Reset form
                document.getElementById('quick-customer-form').reset();

                // Show success notification
                showNotification('Pelanggan baru berhasil ditambahkan!');
            };

            // Toggle row action menu
            window.toggleDropdown = function (event, id) {
                event.stopPropagation();
                const targetDropdown = document.getElementById(`dropdown-${id}`);
                const isHidden = targetDropdown.classList.contains('hidden');

                document.querySelectorAll('[id^="dropdown-"]').forEach((d) => d.classList.add('hidden'));

                if (isHidden) {
                    targetDropdown.classList.remove('hidden');
                }
            };

            // Load values for Tambah / Edit views
            // Load values for Tambah / Edit views
            function loadFormView(id = null) {
                orderForm.reset();
                clearSelectedCustomer();

                uploadedImageDataUrl = null;
                formPhotoPreview.src = '';
                formPhotoPreview.classList.add('hidden');
                uploadPrompt.classList.remove('hidden');

                // Preset date inputs
                const today = new Date();
                document.getElementById('input-start-date').value = today.toISOString().split('T')[0];
                const nextWeek = new Date();
                nextWeek.setDate(today.getDate() + 7);
                document.getElementById('input-deadline').value = nextWeek.toISOString().split('T')[0];

                if (id) {
                    // ========================================================
                    // EDIT MODE
                    // ========================================================
                    const order = orders.find((o) => o.id === id);
                    if (!order) {
                        window.location.hash = '#list';
                        return;
                    }

                    document.getElementById('form-order-id').value = order.id;
                    document.getElementById('form-title').innerText = 'Edit Detail Pesanan';
                    document.getElementById('form-subtitle').innerText =
                        'Perbarui detail busana dan ukuran pengerjaan pelanggan';

                    // PERBAIKAN: Cari master pelanggan berdasarkan nama dari data pesanan
                    const customerMatch = customerSizes.find((c) => c.name === order.customer);
                    if (customerMatch) {
                        // Aktifkan kartu tampilan profil pelanggan terpilih
                        selectCustomer(customerMatch.id);
                    }

                    // PERBAIKAN: Timpa kembali input form dengan data ukuran spesifik pada PESANAN ini
                    document.getElementById('input-l-badan').value = order.l_badan || '';
                    document.getElementById('input-l-pinggang').value = order.l_pinggang || '';
                    document.getElementById('input-l-punggung').value = order.l_punggung || '';
                    document.getElementById('input-p-bahu').value = order.p_bahu || '';
                    document.getElementById('input-p-lengan').value = order.p_lengan || '';
                    document.getElementById('input-l-lengan').value = order.l_lengan || '';
                    document.getElementById('input-t-susu').value = order.t_susu || '';
                    document.getElementById('input-t-pinggang').value = order.t_pinggang || '';
                    document.getElementById('input-l-pinggul').value = order.l_pinggul || '';
                    document.getElementById('input-p-baju').value = order.p_baju || '';
                    document.getElementById('input-p-rok').value =
                        order.p_rok && order.p_rok !== '-' ? order.p_rok : '';

                    // Prefill detail bidang informasi pesanan
                    document.getElementById('input-type').value = order.type;
                    document.getElementById('input-quantity').value = order.quantity;
                    document.getElementById('input-start-date').value = order.start_date;
                    document.getElementById('input-deadline').value = order.deadline;
                    document.getElementById('input-price').value = order.price;
                    document.getElementById('input-notes').value = order.notes;

                    // Load foto referensi jika tersedia
                    if (order.photo) {
                        uploadedImageDataUrl = order.photo;
                        formPhotoPreview.src = order.photo;
                        formPhotoPreview.classList.remove('hidden');
                        uploadPrompt.classList.add('hidden');
                    }
                } else {
                    // ========================================================
                    // CREATE MODE (TAMBAH BARU)
                    // ========================================================
                    document.getElementById('form-order-id').value = '';
                    document.getElementById('form-title').innerText = 'Tambah Pesanan Baru';
                    document.getElementById('form-subtitle').innerText =
                        'Lengkapi profil pesanan baju pelanggan';
                }
            }
            // Load Detail View
            function loadDetailView(id) {
                const order = orders.find((o) => o.id === id);
                if (!order) {
                    window.location.hash = '#list';
                    return;
                }

                activeOrderId = id;

                // Customer card
                document.getElementById('detail-customer-avatar').innerText = order.initials;
                document.getElementById('detail-customer-avatar').className =
                    `w-10 h-10 rounded-full font-bold text-sm flex items-center justify-center ${order.avatarBg}`;
                document.getElementById('detail-customer-name').innerText = order.customer;

                // Details Display
                document.getElementById('detail-display-type').innerText = order.type;
                document.getElementById('detail-display-quantity').innerText = order.quantity;
                document.getElementById('detail-display-start-date').innerText = formatIndonesianDate(
                    order.start_date
                );
                document.getElementById('detail-display-deadline').innerText = formatIndonesianDate(
                    order.deadline
                );
                document.getElementById('detail-display-price').innerText = `Rp${order.price}`;
                document.getElementById('detail-display-notes').innerText =
                    order.notes || 'Tidak ada catatan tambahan';

                // Measurement fields
                document.getElementById('detail-l-badan').value = order.l_badan || '-';
                document.getElementById('detail-l-pinggang').value = order.l_pinggang || '-';
                document.getElementById('detail-l-punggung').value = order.l_punggung || '-';
                document.getElementById('detail-p-bahu').value = order.p_bahu || '-';
                document.getElementById('detail-p-lengan').value = order.p_lengan || '-';
                document.getElementById('detail-l-lengan').value = order.l_lengan || '-';
                document.getElementById('detail-t-susu').value = order.t_susu || '-';
                document.getElementById('detail-t-pinggang').value = order.t_pinggang || '-';
                document.getElementById('detail-l-pinggul').value = order.l_pinggul || '-';
                document.getElementById('detail-p-baju').value = order.p_baju || '-';
                document.getElementById('detail-p-rok').value = order.p_rok || '-';

                // Photo Reference Preview
                const photoPreview = document.getElementById('detail-photo-preview');
                if (order.photo) {
                    photoPreview.src = order.photo;
                } else {
                    // Unsplash placeholder matching modest fashion mockup 2
                    photoPreview.src =
                        'https://images.unsplash.com/photo-1583391733956-3750e0ff4e8b?q=80&w=400';
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

                container.innerHTML = timelineList
                    .map((item, index) => {
                        const isFirst = index === 0;
                        const dotClass = isFirst ? 'bg-primary' : 'bg-gray-300 dark:bg-slate-700';

                        // Format status readable
                        const statusLabelMap = {
                            MENUNGGU: 'Menunggu',
                            PEMOTONGAN: 'Pemotongan',
                            PENJAHITAN: 'Penjahitan',
                            PENYELESAIAN: 'Penyelesaian',
                            SELESAI: 'Selesai',
                        };
                        const labelText = statusLabelMap[item.status] || item.status;

                        return `
                <div class="relative pl-2">
                    <div class="absolute -left-[23px] top-1.5 w-2.5 h-2.5 rounded-full ${dotClass} border-4 border-white dark:border-slate-900"></div>
                    <div>
                        <span class="block text-xs font-bold text-slate-800 dark:text-slate-100">${labelText}</span>
                        <span class="block text-[10px] text-gray-400 mt-0.5">${item.time}</span>
                        <span class="block text-[10px] text-gray-400 font-medium mt-0.5">Oleh ${item.author} • ${item.location}</span>
                    </div>
                </div>
            `;
                    })
                    .join('');
            }

            // Update Status inside Detail View
            window.updateOrderStatus = function () {
                const statusVal = detailUpdateStatus.value;
                const progressVal = parseInt(detailUpdateProgress.value) || 0;

                const orderIndex = orders.findIndex((o) => o.id === activeOrderId);
                if (orderIndex !== -1) {
                    fetch(`/pesanan/${activeOrderId}/status`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({
                            status: statusVal,
                            progress: progressVal,
                        }),
                    })
                        .then((response) => response.json())
                        .then((data) => {
                            if (data.success) {
                                orders[orderIndex].status = statusVal;
                                orders[orderIndex].progress = progressVal;

                                const now = new Date();
                                const monthsList = [
                                    'Januari',
                                    'Februari',
                                    'Maret',
                                    'April',
                                    'Mei',
                                    'Juni',
                                    'Juli',
                                    'Agustus',
                                    'September',
                                    'Oktober',
                                    'November',
                                    'Desember',
                                ];
                                const formattedTime = `${now.getDate()} ${monthsList[now.getMonth()]} ${now.getFullYear()}, ${now.getHours().toString().padStart(2, '0')}:${now.getMinutes().toString().padStart(2, '0')}`;

                                if (!orderTimeline[activeOrderId]) {
                                    orderTimeline[activeOrderId] = [];
                                }

                                orderTimeline[activeOrderId].unshift({
                                    status: statusVal,
                                    time: formattedTime,
                                    author: 'Admin',
                                    location: 'Workshop',
                                });

                                showNotification('Status pengerjaan berhasil diperbarui!');
                                loadDetailView(activeOrderId);
                                updateCounts();
                            } else {
                                alert('Gagal memperbarui status');
                            }
                        })
                        .catch((error) => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan');
                        });
                }
            };

            // Timeline Date Helper (Create view log)
            function formatTimelineDate(date) {
                const idMonths = [
                    'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember',
                ];
                return `${date.getDate()} ${idMonths[date.getMonth()]} ${date.getFullYear()}, ${date.getHours().toString().padStart(2, '0')}:${date.getMinutes().toString().padStart(2, '0')}`;
            }

            // Delete order
            window.deleteOrder = function (id) {
                const order = orders.find((o) => o.id === id);
                if (!order) return;

                if (confirm(`Apakah Anda yakin ingin menghapus pesanan untuk "${order.customer}"?`)) {
                    fetch(`/pesanan/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                    })
                        .then((response) => response.json())
                        .then((data) => {
                            if (data.success) {
                                orders = orders.filter((o) => o.id !== id);
                                showNotification(
                                    `Pesanan "${order.customer}" berhasil dihapus`,
                                    'fa-trash-can'
                                );
                                updateCounts();
                                renderOrders();
                            } else {
                                alert('Gagal menghapus pesanan');
                            }
                        })
                        .catch((error) => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan');
                        });
                }
            };

            // Update status counters
            function updateCounts() {
                document.getElementById('count-semua').innerText = orders.length;
                document.getElementById('count-menunggu').innerText = orders.filter(
                    (o) => o.status === 'MENUNGGU'
                ).length;
                document.getElementById('count-pemotongan').innerText = orders.filter(
                    (o) => o.status === 'PEMOTONGAN'
                ).length;
                document.getElementById('count-penjahitan').innerText = orders.filter(
                    (o) => o.status === 'PENJAHITAN'
                ).length;
                document.getElementById('count-penyelesaian').innerText = orders.filter(
                    (o) => o.status === 'PENYELESAIAN'
                ).length;
                document.getElementById('count-selesai').innerText = orders.filter(
                    (o) => o.status === 'SELESAI'
                ).length;
            }

            // Date formatter indonesian
            function formatIndonesianDate(dateStr) {
                if (!dateStr) return '-';
                const parts = dateStr.split('-');
                if (parts.length !== 3) return dateStr;
                const date = new Date(parseInt(parts[0]), parseInt(parts[1]) - 1, parseInt(parts[2]));
                const idMonths = [
                    'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember',
                ];
                return `${date.getDate()} ${idMonths[date.getMonth()]} ${date.getFullYear()}`;
            }

            // Deadline subtext calculator
            function getDeadlineLabel(dateStr) {
                const deadline = new Date(dateStr);
                const reference = new Date('2026-08-12'); // Fixed mockup anchor date

                const diffTime = deadline - reference;
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                if (diffDays === 1) {
                    return {
                        text: 'Besok Tenggat Waktu',
                        class: 'text-red-500 font-bold dark:text-red-400 italic',
                    };
                } else if (diffDays === 0) {
                    return {
                        text: 'Hari Ini Tenggat Waktu',
                        class: 'text-red-600 font-black dark:text-red-400 italic',
                    };
                } else if (diffDays < 0) {
                    return {
                        text: 'Terlewat ' + Math.abs(diffDays) + ' Hari',
                        class: 'text-red-700 font-bold dark:text-red-400 italic',
                    };
                } else if (diffDays === 6) {
                    return {
                        text: 'On Schedule',
                        class: 'text-gray-400 dark:text-slate-400 font-medium italic',
                    };
                } else {
                    return {
                        text: diffDays + ' Hari Lagi',
                        class: 'text-gray-400 dark:text-slate-400 font-medium italic',
                    };
                }
            }

            // Render orders table
            function renderOrders() {
                let filtered = orders;

                if (currentFilter !== 'Semua') {
                    filtered = filtered.filter((o) => o.status === currentFilter);
                }

                if (searchQuery.trim() !== '') {
                    const query = searchQuery.toLowerCase();
                    filtered = filtered.filter(
                        (o) =>
                            o.customer.toLowerCase().includes(query) || o.type.toLowerCase().includes(query)
                    );
                }

                document.getElementById('pagination-info').innerText =
                    `Menampilkan 1-${filtered.length} dari ${orders.length} pesanan aktif`;

                if (filtered.length === 0) {
                    tableBody.innerHTML = '';
                    emptyState.classList.remove('hidden');
                    return;
                }

                emptyState.classList.add('hidden');
                tableBody.innerHTML = filtered
                    .map((o) => {
                        const deadlineInfo = getDeadlineLabel(o.deadline);
                        const formattedDate = formatIndonesianDate(o.deadline);

                        return `
                <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/40 transition duration-150">
                    <!-- Customer and Apparel type -->
                    <td class="px-8 py-5">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full ${o.avatarBg} font-bold text-sm flex items-center justify-center shrink-0 border border-black/5">
                                ${o.initials}
                            </div>
                            <div>
                                <span class="block text-sm font-bold text-slate-800 dark:text-slate-100">${o.customer}</span>
                                <span class="inline-block px-2.5 py-1 text-[9px] font-bold text-primary dark:text-accent bg-primary/10 dark:bg-primary/30 rounded-md mt-1 leading-none">${o.type}</span>
                            </div>
                        </div>
                    </td>

                    <!-- Deadline -->
                    <td class="px-8 py-5">
                        <span class="block text-sm font-bold text-slate-800 dark:text-slate-100">${formattedDate}</span>
                        <span class="block text-[10px] mt-0.5 ${deadlineInfo.class}">${deadlineInfo.text}</span>
                    </td>

                    <!-- Progress -->
                    <td class="px-8 py-5">
                        <div class="w-64 max-w-full">
                            <div class="flex items-center justify-between mb-1.5">
                                <span class="text-[9px] font-extrabold uppercase tracking-wider text-slate-800 dark:text-slate-300">${o.status}</span>
                                <span class="text-[10px] font-bold text-gray-400">${o.progress}%</span>
                            </div>
                            <div class="w-full bg-gray-100 dark:bg-slate-800 h-1.5 rounded-full overflow-hidden">
                                <div class="bg-primary h-full rounded-full" style="width: ${o.progress}%"></div>
                            </div>
                        </div>
                    </td>

                    <!-- Action Buttons -->
                    <td class="px-8 py-5 text-right">
                        <div class="flex items-center justify-end gap-2.5">
                            <a href="#detail-${o.id}" class="w-8 h-8 rounded-lg bg-gray-50 dark:bg-slate-800 border border-gray-100 dark:border-slate-700 flex items-center justify-center text-gray-400 hover:text-primary dark:hover:text-accent hover:scale-105 active:scale-95 transition" title="Lihat Detail">
                                <i class="fa-regular fa-eye text-xs"></i>
                            </a>
                            <div class="relative">
                                <button onclick="toggleDropdown(event, ${o.id})" class="w-8 h-8 rounded-lg bg-gray-50 dark:bg-slate-800 border border-gray-100 dark:border-slate-700 flex items-center justify-center text-gray-400 hover:text-primary dark:hover:text-accent hover:scale-105 active:scale-95 transition" title="Menu">
                                    <i class="fa-solid fa-ellipsis-vertical text-xs"></i>
                                </button>
                                <div id="dropdown-${o.id}" class="absolute right-0 mt-2 w-32 bg-white dark:bg-slate-800 border border-gray-100 dark:border-slate-700 rounded-xl shadow-lg py-1.5 hidden z-45">
                                    <a href="#edit-${o.id}" class="w-full text-left px-4 py-2 text-xs text-gray-600 dark:text-slate-300 hover:bg-gray-50 dark:hover:bg-slate-700/50 flex items-center gap-2 transition">
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
                    })
                    .join('');
            }

            // Helper Toast notification
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

            // INITIAL LOAD
            handleRouting();
            updateCounts();
        });
    </script>