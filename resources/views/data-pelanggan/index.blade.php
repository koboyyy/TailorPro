@extends ('layouts.app')

@section ('breadcrumb-parent', 'halaman')
@section ('breadcrumb-active', 'data pelanggan')

@section ('content')
    <x-toast />

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

    @include ('data-pelanggan.partials.stats')

    @include ('data-pelanggan.partials.list')

    @include ('data-pelanggan.partials.modal-customer')

    @include ('data-pelanggan.partials.modal-ukuran')

@endsection

@section ('scripts')
    @include ('data-pelanggan.partials.scripts')
@endsection
