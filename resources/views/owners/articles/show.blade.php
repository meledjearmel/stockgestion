@extends('layouts.swup')
@section('content')

    <div id="">
        <div class="br-mainpanel">
            <div class="br-pagetitle d-flex justify-content-center align-items-center">
                @if(session()->get('change_role'))
                    <div class="col-xl-5" id="successNotify">
                        <div class="alert alert-success alert-solid" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <div class="d-flex align-items-center justify-content-start">
                                <i style="color: #fff" class="icon ion-ios-checkmark alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
                                <span><strong>Succès !</strong> {{ $user->lastname }} {{ $user->lastname }} est maintenant {{ session()->get('role') }}</span>
                            </div><!-- d-flex -->
                        </div>
                    </div>
                @endif
                    @if(session()->get('no_change_role'))
                        <div class="col-xl-5" id="successNotify">
                            <div class="alert alert-danger alert-solid" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <div class="d-flex align-items-center justify-content-start">
                                    <i style="color: #fff" class="icon ion-ios-checkmark alert-icon tx-22 mg-t-5 mg-xs-t-0"></i>
                                    <span><strong>Désole !</strong> {{ $user->lastname }} {{ $user->lastname }} est deja {{ session()->get('role') }}</span>
                                </div><!-- d-flex -->
                            </div>
                        </div>
                    @endif
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
    <script src="{{ asset("js/charts/warehouse.show.pie.js") }}"></script>
    <script src="{{ asset('js/charts/warehouse.show.content.js') }}"></script>
    @yield('min-child-js')
@endsection
