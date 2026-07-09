@extends ('layouts.app')

@section ('breadcrumb-parent', 'halaman')
@section ('breadcrumb-active', 'hasilan pola')

@section ('content')
    @include ('hasilkan-pola.partials.header')

    <!-- Main Designer Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start mb-8 w-full">
        <div class="flex w-full gap-8 flex-wrap">
            @include ('hasilkan-pola.partials.customer-selector')
            @include ('hasilkan-pola.partials.garment-selector')
            @include ('hasilkan-pola.partials.fabric-estimation')
        </div>

        @include ('hasilkan-pola.partials.canvas-viewer')
    </div>

    @include ('hasilkan-pola.partials.modals')
@endsection

@section ('scripts')
    @include ('hasilkan-pola.partials.pattern-scripts')
@endsection
