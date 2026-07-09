@extends ('layouts.app')

@section ('breadcrumb-parent', 'halaman')
@section ('breadcrumb-active', 'pesanan')

@section ('content')
    <x-toast />

    @include ('pesanan.partials.list')

    @include ('pesanan.partials.form')

    @include ('pesanan.partials.detail')

    @include ('pesanan.partials.modal')

@endsection

@section ('scripts')
    @include ('pesanan.partials.scripts')
@endsection