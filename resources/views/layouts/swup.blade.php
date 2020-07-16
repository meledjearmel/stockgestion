@extends('layouts.app')

@section('css-script')
    @yield('child-css')
    <link href="{{ asset('css/swup.css') }}" rel="stylesheet">
@endsection

@section('content')

    <main id="swup" class="transition-fade">
        @yield('content')
    </main>

@endsection

@section('js-script')
    @yield('child-js')
@endsection
