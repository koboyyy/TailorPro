@extends ('layouts.app')

@section ('content')
    <!-- Toast Notification Banner -->
    <div
        id="toast"
        class="fixed top-6 right-6 z-50 transform translate-y-[-100px] opacity-0 transition-all duration-300 pointer-events-none"
    >
        <div
            class="bg-secondary text-accent px-6 py-4 rounded-xl shadow-2xl flex items-center gap-3 border border-accent/20"
        >
            <span id="toast-icon" class="text-lg"><i class="fas fa-check-circle"></i></span>
            <p id="toast-message" class="text-sm font-medium"></p>
        </div>
    </div>

    <!-- Page Content Title & Subtitle -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1
                class="font-serif text-3xl font-bold text-primary dark:text-white mb-1 tracking-tight"
            >
                Daftar Ukuran Baju
            </h1>
            <p class="text-xs text-grey dark:text-slate-400 font-medium">Kelola data pengukuran fisik pelanggan secara detail.</p>
        </div>

        <button
            id="btn-add-new"
            class="flex items-center justify-center gap-2 bg-primary hover:bg-secondary text-accent font-semibold text-xs px-5 py-3 rounded-xl shadow-lg shadow-primary/15 transition duration-200 group active:scale-95"
        >
            <i
                class="fas fa-plus text-[10px] group-hover:rotate-90 transition-transform duration-200"
            ></i>
            <span>Tambah Ukuran Baru</span>
        </button>
    </div>

    <!-- Dashboard Main Grid Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        <!-- Include Table Component -->
        @include ('ukuran-baju.partials.table')

        <!-- Include Form Component -->
        @include ('ukuran-baju.partials.form')
    </div>

    </div>
@endsection

@section ('scripts')
    @include ('ukuran-baju.partials.scripts')
@endsection
