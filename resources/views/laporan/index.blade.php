@extends ('layouts.app')

@section ('content')
    <div class="mx-auto space-y-6 pb-10">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
            <div>
                <h1 class="font-serif text-3xl font-bold text-primary dark:text-white mb-2">
                    Laporan Penjualan
                </h1>
                <p class="text-grey dark:text-slate-400 text-sm">Pantau performa bisnis dan pertumbuhan pendapatan Anda.</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="relative group">
                    <button
                        class="flex items-center gap-2 px-4 py-2.5 bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-xl text-sm font-medium text-slate-700 dark:text-slate-200 hover:bg-gray-50 dark:hover:bg-slate-800 transition-colors shadow-sm"
                    >
                        <i class="fa-regular fa-calendar text-gray-400"></i>
                        @if ($filter == '7')
                            7 Hari Terakhir
                        @elseif ($filter == '365')
                            1 Tahun Terakhir
                        @else
                            30 Hari Terakhir
                        @endif
                        <i class="fa-solid fa-chevron-down text-gray-400 text-xs ml-1"></i>
                    </button>
                    <!-- Dropdown Menu -->
                    <div
                        class="absolute right-0 mt-2 w-48 bg-white dark:bg-slate-800 border border-gray-100 dark:border-slate-700 rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50 overflow-hidden"
                    >
                        <a
                            href="{{ route('laporan.index', ['filter' => 7]) }}"
                            class="block px-4 py-3 text-sm text-gray-700 dark:text-slate-300 hover:bg-gray-50 dark:hover:bg-slate-700 {{ $filter == '7' ? 'bg-gray-50 dark:bg-slate-700 font-bold' : '' }}"
                            >7 Hari Terakhir</a
                        >
                        <a
                            href="{{ route('laporan.index', ['filter' => 30]) }}"
                            class="block px-4 py-3 text-sm text-gray-700 dark:text-slate-300 hover:bg-gray-50 dark:hover:bg-slate-700 {{ $filter == '30' ? 'bg-gray-50 dark:bg-slate-700 font-bold' : '' }}"
                            >30 Hari Terakhir</a
                        >
                        <a
                            href="{{ route('laporan.index', ['filter' => 365]) }}"
                            class="block px-4 py-3 text-sm text-gray-700 dark:text-slate-300 hover:bg-gray-50 dark:hover:bg-slate-700 {{ $filter == '365' ? 'bg-gray-50 dark:bg-slate-700 font-bold' : '' }}"
                            >1 Tahun Terakhir</a
                        >
                    </div>
                </div>
                <a
                    href="{{ route('laporan.pdf', ['filter' => $filter]) }}"
                    class="flex items-center gap-2 px-4 py-2.5 bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-xl text-sm font-medium text-slate-700 dark:text-slate-200 hover:bg-gray-50 dark:hover:bg-slate-800 transition-colors shadow-sm"
                >
                    <i class="fa-solid fa-download text-gray-400"></i>
                    Cetak PDF
                </a>
            </div>
        </div>

            @include ('laporan.partials.stats')

    @include ('laporan.partials.chart')

    @include ('laporan.partials.table')
</div>
@endsection

@section ('scripts')
    @include ('laporan.partials.scripts')
@endsection
