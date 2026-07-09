@extends ('layouts.app')

@section ('breadcrumb-parent', 'halaman')
@section ('breadcrumb-active', 'pola busana')

@section ('content')
    <x-toast />

    @include ('arsip-pola.partials.list')

    @include ('arsip-pola.partials.detail')

@endsection

@section ('scripts')
    @include ('arsip-pola.partials.scripts')
@endsection