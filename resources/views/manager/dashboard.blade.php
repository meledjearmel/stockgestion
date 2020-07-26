@extends('layouts.swup')
@section('content')
    <div id="app-selling">
        <div class="br-mainpanel">
            <div class="br-pagebody mg-t-80-force">
                <div class="row row-sm">

                    <div class="col-sm-12 col-xl-4 mg-t-20 mg-sm-t-0">
                        <div class="bg-purple rounded overflow-hidden">
                            <div class="pd-x-20 pd-t-20 d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <i class="ion ion-cash tx-60 lh-0 tx-white op-7"></i>
                                    <div class="mg-l-20">
                                        <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Articles sorti aujourd'hui</p>
                                        <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">{{ $nbrToday }}</p>
                                        <span class="tx-11 tx-roboto tx-white-8">Articles</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end align-items-center">
                                    <button style="cursor: pointer" class="btn bd-white-3 btn-purple tx-uppercase">Voir</button>
                                </div>
                            </div>
                            <div id="ch3" class="ht-50 tr-y-1"></div>
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-sm-6 col-xl-4">
                        <div class="bg-info rounded overflow-hidden">
                            <div class="pd-x-20 pd-t-20 d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <i class="ion ion-earth tx-60 lh-0 tx-white op-7"></i>
                                    <div class="mg-l-20">
                                        <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Articles sorti d'hier</p>
                                        <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">{{ $nbrYester }}</p>
                                        <span class="tx-11 tx-roboto tx-white-8">Articles</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end align-items-center">
                                    <button style="cursor: pointer" class="btn bd-white-3 btn-info tx-uppercase">Voir</button>
                                </div>
                            </div>
                            <div id="ch1" class="ht-50 tr-y-1"></div>
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-sm-6 col-xl-4 mg-t-20 mg-xl-t-0">
                        <div class="bg-teal rounded overflow-hidden">
                            <div class="pd-x-20 pd-t-20 d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <i class="ion ion-monitor tx-60 lh-0 tx-white op-7"></i>
                                    <div class="mg-l-20">
                                        <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Articles sorti ce mois</p>
                                        <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">{{ $nbrMonth }}</p>
                                        <span class="tx-11 tx-roboto tx-white-8">Articles</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end align-items-center">
                                    <button style="cursor: pointer" class="btn tx-lato bd-white-3 btn-teal tx-uppercase">Voir</button>
                                </div>
                            </div>
                            <div id="ch2" class="ht-50 tr-y-1"></div>
                        </div>
                    </div><!-- col-4 -->

                </div><!-- row -->
                <h6 class="br-section-label">Line Chart</h6>
                <p class="br-section-text">Below is the basic line chart example.</p>

                <div class="row">
                    <div class="col-xl-6">
                        <div id="morrisLine1" class="ht-200 ht-sm-300 bd"></div>
                    </div><!-- col-6 -->
                    <div class="col-xl-6 mg-t-20 mg-xl-t-0">
                        <div id="morrisLine2" class="ht-200 ht-sm-300 bd"></div>
                    </div><!-- col-6 -->
                </div><!-- row -->

                <p class="br-section-label-sm">Javascript Code</p>
                <pre><code class="javascript pd-20">new Morris.Line({ ... );</code></pre>
            </div><!-- br-pagebody -->
        </div><!-- br-mainpanel -->
    </div>
@endsection
@section('child-js')
    <script src="{{ asset('js/charts/warehouse.show.content.js') }}"></script>
    <script src="{{ asset('lib/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('lib/morris.js/morris.js') }}"></script>
    <script src="{{ asset('js/charts/manager.morrischart.js') }}"></script>
    <script>
        $('#datatable1').DataTable({
            responsive: true,
            lengthMenu: [5],
            language: {
                searchPlaceholder: 'Recherche...',
                sSearch: '',
                lengthMenu: '_MENU_ articles par page',
            }
        });
    </script>
@endsection
