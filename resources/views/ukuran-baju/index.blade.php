@extends('layouts.app')

@section('content')
<!-- Toast Notification Banner -->
<div id="toast" class="fixed top-6 right-6 z-50 transform translate-y-[-100px] opacity-0 transition-all duration-300 pointer-events-none">
    <div class="bg-secondary text-accent px-6 py-4 rounded-xl shadow-2xl flex items-center gap-3 border border-accent/20">
        <span id="toast-icon" class="text-lg"><i class="fas fa-check-circle"></i></span>
        <p id="toast-message" class="text-sm font-medium"></p>
    </div>
</div>

        <!-- Page Content Title & Subtitle -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="font-serif text-3xl font-bold text-primary dark:text-on-surface mb-1 tracking-tight">Daftar Ukuran Baju</h1>
                <p class="text-xs text-grey dark:text-on-surface font-medium">Kelola data pengukuran fisik pelanggan secara detail.</p>
            </div>
            
            <button id="btn-add-new" class="flex items-center justify-center gap-2 bg-primary hover:bg-secondary text-accent font-semibold text-xs px-5 py-3 rounded-xl shadow-lg shadow-primary/15 transition duration-200 group active:scale-95">
                <i class="fas fa-plus text-[10px] group-hover:rotate-90 transition-transform duration-200"></i>
                <span>Tambah Ukuran Baru</span>
            </button>
        </div>

        <!-- Dashboard Main Grid Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            
            <!-- Include Table Component -->
            @include('ukuran-baju.partials.table')

            <!-- Include Form Component -->
            @include('ukuran-baju.partials.form')

        </div>

<!-- Dynamic Logic for the Dashboard page -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // Mock Initial Data State
        let customers = [
            {
                id: 1,
                name: "Andi Saputra",
                initials: "AS",
                avatarBg: "bg-[#EFEAE4] text-[#8C7A6B]",
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
                p_rok: "-",
                updated_at: "12 Mei 2024"
            },
            {
                id: 2,
                name: "Budi Nugraha",
                initials: "BN",
                avatarBg: "bg-[#E0F2F1] text-[#00796B]",
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
                p_rok: "-",
                updated_at: "15 Mei 2024"
            },
            {
                id: 3,
                name: "Citra Putri",
                initials: "CP",
                avatarBg: "bg-[#FCE4EC] text-[#C2185B]",
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
                p_rok: "-",
                updated_at: "18 Mei 2024"
            },
            {
                id: 4,
                name: "Dedi Mulyadi",
                initials: "DM",
                avatarBg: "bg-[#E3F2FD] text-[#1976D2]",
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
                p_rok: "-",
                updated_at: "20 Mei 2024"
            }
        ];

        // Active State variables
        let selectedCustomerId = 2; // Default select Budi Nugraha
        let isCreatingMode = false;
        let searchQuery = "";

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

        // Helper: Get Initials from Name
        function getInitials(name) {
            return name
                .split(' ')
                .slice(0, 2)
                .map(word => word.charAt(0).toUpperCase())
                .join('');
        }

        // Helper: Generate Random Pastel Avatar Styling
        function getRandomAvatarStyle() {
            const styles = [
                "bg-[#EFEAE4] text-[#8C7A6B]",
                "bg-[#E0F2F1] text-[#00796B]",
                "bg-[#FCE4EC] text-[#C2185B]",
                "bg-[#E3F2FD] text-[#1976D2]",
                "bg-[#FFF3E0] text-[#E65100]",
                "bg-[#EDE7F6] text-[#5E35B1]"
            ];
            return styles[Math.floor(Math.random() * styles.length)];
        }

        // Helper: Format Date today (Indonesian format)
        function formatDateToday() {
            const months = [
                "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                "Juli", "Agustus", "September", "Oktober", "November", "Desember"
            ];
            const date = new Date();
            const day = date.getDate();
            const month = months[date.getMonth()];
            const year = date.getFullYear();
            return `${day} ${month} ${year}`;
        }

        // Render customer list in table
        function renderTable() {
            // Filter list based on search input
            const filtered = customers.filter(c => 
                c.name.toLowerCase().includes(searchQuery.toLowerCase())
            );

            if (filtered.length === 0) {
                tableBody.innerHTML = '';
                emptyState.classList.remove('hidden');
                return;
            }

            emptyState.classList.add('hidden');
            tableBody.innerHTML = filtered.map(c => {
                const isActive = (c.id === selectedCustomerId && !isCreatingMode);
                const activeClasses = isActive 
                    ? 'bg-[#FAF9F6] dark:bg-[#30251A] border-l-4 border-primary' 
                    : 'hover:bg-background/50 dark:hover:bg-[#30251A]/50 border-l-4 border-transparent';
                
                const textClass = isActive ? 'dark:text-primary' : 'dark:text-on-surface';
                const iconClass = isActive ? 'dark:text-primary' : 'dark:text-on-surface';

                return `
                    <tr class="transition duration-150 cursor-pointer ${activeClasses}" onclick="selectCustomer(${c.id})">
                        <td class="px-6 py-4 font-semibold text-primary">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full ${c.avatarBg} font-bold text-[10px] flex items-center justify-center tracking-wider shrink-0 shadow-sm border border-black/5">
                                    ${c.initials}
                                </div>
                                <span class="truncate max-w-[120px] md:max-w-none block text-sm font-bold text-primary ${textClass}">${c.name}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center font-medium ${textClass}">${c.l_badan} cm</td>
                        <td class="px-6 py-4 text-center font-medium ${textClass}">${c.l_pinggang} cm</td>
                        <td class="px-6 py-4 text-center font-medium ${textClass}">${c.p_baju} cm</td>
                        <td class="px-6 py-4 text-center font-light text-gray-500 ${textClass}">${c.updated_at}</td>
                        <td class="px-6 py-4 text-right" onclick="event.stopPropagation()">
                            <div class="flex items-center justify-end gap-2.5">
                                <button onclick="editCustomerFromAction(${c.id})" class="text-grey ${iconClass} hover:text-primary dark:hover:text-accent hover:scale-110 p-1 transition" title="Edit Ukuran">
                                    <i class="far fa-edit text-xs"></i>
                                </button>
                                <button onclick="deleteCustomer(${c.id})" class="text-grey ${iconClass} hover:text-red-700 hover:scale-110 p-1 transition" title="Hapus Pelanggan">
                                    <i class="far fa-trash-can text-xs"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
            }).join('');
        }

        // Select a customer row
        window.selectCustomer = function(id) {
            if (isCreatingMode) {
                if (!confirm("Batalkan penambahan ukuran baru? Perubahan yang belum disimpan akan hilang.")) {
                    return;
                }
            }
            isCreatingMode = false;
            selectedCustomerId = id;
            renderTable();
            loadActiveCustomer();
        };

        // Edit button click in row
        window.editCustomerFromAction = function(id) {
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
                formTitle.innerText = "Tambah Ukuran Baru";
                formBadge.innerText = "PELANGGAN BARU";
                formBadge.className = "bg-background text-grey text-[9px] font-bold tracking-wider px-2.5 py-1 rounded border border-[#EFECE6] dark:border-surface uppercase";
                
                customerNameGroup.classList.remove('hidden');
                
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
                
                btnSubmit.innerText = "Simpan Data Baru";
                inputName.focus();
                return;
            }

            // Normal edit mode
            const customer = customers.find(c => c.id === selectedCustomerId);
            if (!customer) return;

            formTitle.innerText = "Edit Detail Ukuran";
            formBadge.innerText = customer.name;
            formBadge.className = "bg-primary/10 text-primary dark:bg-surface dark:text-accent text-[9px] font-bold tracking-wider px-2.5 py-1 rounded uppercase truncate max-w-[150px]";
            
            customerNameGroup.classList.add('hidden');

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
            inputPRok.value = customer.p_rok === "-" ? "" : customer.p_rok;
            
            btnSubmit.innerText = "Simpan Perubahan";
        }

        // Add New click event
        btnAddNew.addEventListener('click', function() {
            isCreatingMode = true;
            selectedCustomerId = null;
            renderTable();
            loadActiveCustomer();
        });

        // Cancel click event
        btnCancel.addEventListener('click', function() {
            if (isCreatingMode) {
                isCreatingMode = false;
                // Revert to first customer if available
                selectedCustomerId = customers.length > 0 ? customers[0].id : null;
                renderTable();
                loadActiveCustomer();
            } else {
                // Just reload current customer measurements (revert changes)
                loadActiveCustomer();
                showNotification("Perubahan dibatalkan", "fa-circle-info");
            }
        });

        // Search Input event
        searchInput.addEventListener('input', function(e) {
            searchQuery = e.target.value;
            renderTable();
        });

        // Delete customer action
        window.deleteCustomer = function(id) {
            const customer = customers.find(c => c.id === id);
            if (!customer) return;

            if (confirm(`Apakah Anda yakin ingin menghapus data ukuran pelanggan "${customer.name}"?`)) {
                customers = customers.filter(c => c.id !== id);
                
                // If the deleted one was selected, select another one
                if (selectedCustomerId === id) {
                    selectedCustomerId = customers.length > 0 ? customers[0].id : null;
                }

                showNotification(`Data ukuran "${customer.name}" berhasil dihapus`, "fa-trash-can");
                renderTable();
                loadActiveCustomer();
            }
        };

        // Form Submit handler
        measurementForm.addEventListener('submit', function(e) {
            e.preventDefault();

            if (isCreatingMode) {
                // Create mode
                const name = inputName.value.trim();
                if (!name) {
                    alert("Nama pelanggan harus diisi!");
                    inputName.focus();
                    return;
                }

                const newId = customers.length > 0 ? Math.max(...customers.map(c => c.id)) + 1 : 1;
                const newCustomer = {
                    id: newId,
                    name: name,
                    initials: getInitials(name),
                    avatarBg: getRandomAvatarStyle(),
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
                    p_rok: inputPRok.value.trim() || "-",
                    updated_at: formatDateToday()
                };

                customers.unshift(newCustomer); // Put at top
                selectedCustomerId = newId;
                isCreatingMode = false;
                
                showNotification(`Data ukuran "${name}" berhasil ditambahkan!`);
                renderTable();
                loadActiveCustomer();
            } else {
                // Edit mode
                const customerIndex = customers.findIndex(c => c.id === selectedCustomerId);
                if (customerIndex === -1) return;

                customers[customerIndex].l_badan = parseInt(inputLBadan.value) || 0;
                customers[customerIndex].l_pinggang = parseInt(inputLPinggang.value) || 0;
                customers[customerIndex].l_punggung = parseInt(inputLPunggung.value) || 0;
                customers[customerIndex].p_bahu = parseInt(inputPBahu.value) || 0;
                customers[customerIndex].p_lengan = parseInt(inputPLengan.value) || 0;
                customers[customerIndex].l_lengan = parseInt(inputLLengan.value) || 0;
                customers[customerIndex].t_susu = parseInt(inputTSusu.value) || 0;
                customers[customerIndex].t_pinggang = parseInt(inputTPinggang.value) || 0;
                customers[customerIndex].l_pinggul = parseInt(inputLPinggul.value) || 0;
                customers[customerIndex].p_baju = parseInt(inputPBaju.value) || 0;
                customers[customerIndex].p_rok = inputPRok.value.trim() || "-";
                customers[customerIndex].updated_at = formatDateToday();

                showNotification(`Data ukuran "${customers[customerIndex].name}" berhasil diperbarui!`);
                renderTable();
                loadActiveCustomer();
            }
        });

        // Filter button toggle sorting / custom action
        if (filterBtn) {
            filterBtn.addEventListener('click', function() {
                // Reverse list sorting as a demonstration of dynamic capability
                customers.reverse();
                renderTable();
                showNotification("Urutan daftar pelanggan diubah", "fa-sort");
            });
        }

    });
</script>
@endsection
