@extends('layouts.swup')
@section('content')

    <div id="">
        <div class="br-mainpanel">
            <div class="br-pagetitle d-flex justify-content-center align-items-center">
            </div>
            <div class="br-pagebody ">
                <div class="br-section-wrapper">

                    @yield('show-content')

                </div>
            </div>
        </div>
    </div>

@endsection
@section('child-js')
    @yield('min-child-js')
@endsection
