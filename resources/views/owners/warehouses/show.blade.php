@extends('layouts.swup')
@section('content')

    <div id="app-warehouse-edit">
        <div class="br-mainpanel">
            <div class="br-pagetitle d-flex justify-content-center align-items-center">
                <div class="pd-10 bd rounded mg-t-10">
                    <ul class="nav nav-pills flex-column flex-md-row justify-content-end" role="tablist">
                        <li class="nav-item"><a class="nav-link {{ preg_match_all('/^\/warehouse\/[0-9]+$/i', request()->getRequestUri()) ? 'active' : '' }}"  href="{{ route('warehouse.show', $warehouse->id) }}"><i class="ion-ios-home"></i> Presentation</a></li>
                        <li class="nav-item"><a class="nav-link {{ strpos(request()->getRequestUri(), 'supply')  ? 'active' : '' }}"  href="{{ route('warehouse.supply.inner', $warehouse->id) }}"><i class=""></i> Alimentation</a></li>
                        <li class="nav-item"><a class="nav-link {{ strpos(request()->getRequestUri(), 'transaction')  ? 'active' : '' }}"  href="{{ route('warehouse.transaction', $warehouse->id) }}"><i class="fa fa-stack-exchange"></i> Transaction</a></li>
                        <li class="nav-item"><a class="nav-link {{ strpos(request()->getRequestUri(), 'settings')  ? 'active' : '' }}" href="{{ route('warehouse.setting.index', $warehouse->id) }}"><i class="ion-android-settings"></i> Paramètres</a></li>
                    </ul>
                </div>
                @if(session()->get('success'))
                    <div class="col-xl-5" id="successNotify">
                        <div class="alert alert-success alert-solid" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <div class="d-flex align-items-center justify-content-start">
                                <i style="color: #fff" class="icon ion-ios-checkmark alert-icon tx-22 mg-t-5 mg-xs-t-0"></i>
                                <span><strong>Succès !</strong> L'article a été ajouté</span>
                            </div><!-- d-flex -->
                        </div>
                    </div>
                @endif
                @if(session()->get('failed'))
                    <div class="col-xl-5" id="successNotify">
                        <div class="alert alert-danger alert-solid" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <div class="d-flex align-items-center justify-content-start">
                                <i style="color: #fff" class="icon ion-ios-checkmark alert-icon tx-22 mg-t-5 mg-xs-t-0"></i>
                                <span><strong>Désole !</strong> Ce entrepot a {{ session()->get('noUsed') }} de place disponible</span>
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
@endsection

