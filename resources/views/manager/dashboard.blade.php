@extends('layouts.swup')

@section('child-css')
    <link href="{{ asset("lib/morris.js/morris.css") }}" rel="stylesheet">
@endsection

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

                <div class="br-section-wrapper mg-t-20-force">

                    <div class="row">
                        <div class="col-xl-6">
                            <div class="">
                                <h6>Articles disponible en entrepot</h6>
                            </div>
                            <div class="pd-b-30">
                                <div id="chartPieContent" data-articles="{{ json_encode($articles) }}" class="ht-300 ht-sm-300"></div>
                            </div>
                        </div>
                        <div class="col-xl-6 mg-t-20 mg-xl-t-0">
                            <div class="mg-l-10-force">
                                <h6>Graphique du nombre d'article sortie les 7 derniers jours</h6>
                            </div>
                            <div id="morrisLine2" data-weeksell="{{ json_encode($weekSells) }}" class="ht-200 ht-sm-300"></div>
                        </div><!-- col-6 -->
                    </div><!-- row -->

                    <div class="row mg-t-20-force">
                        <div class="card bd-0 shadow-base pd-25 col-12 mg-t-20">
                            <div class="d-md-flex justify-content-between">
                                <div>
                                    <h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">Lste des articles disponible</h6>
                                    <p>Derniere mise a jour  {{ \Carbon\Carbon::now()->format('d M, Y \a H:i') }}</p>
                                </div>
                                <div class="wd-200">
                                    <select class="form-control select2 select2-hidden-accessible" data-placeholder="Choose location" tabindex="-1" aria-hidden="true">
                                        <option label="Choose one"></option>
                                        <option value="enable" selected="">Disponible</option>
                                        <option value="disable">Vendu</option>
                                    </select>
                                </div><!-- wd-200 -->
                            </div><!-- d-flex -->
                            <div class="row mg-t-20">

                                <div class="table-wrapper">
                                    <table id="datatable1" class="table display responsive nowrap">
                                        <thead>
                                        <tr>
                                            <th class="wd-5p tx-center">#</th>
                                            <th class="wd-35p">Libéle de l'entrepot</th>
                                            <th class="wd-35p">Localité de l'entrepot</th>
                                            <th class="wd-10p">Capacité</th>
                                            <th class="wd-15p tx-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($warehouses))
                                            @foreach($warehouses as $warehouse)
                                                <tr>
                                                    <td class="text-center">{{ $warehouse->id }}</td>
                                                    <td>{{ $warehouse->name }}</td>
                                                    <td>{{ $warehouse->location }}</td>
                                                    <td class="text-center">{{ $warehouse->capacity }}</td>
                                                    <td class="tx-center">
                                                        <a href="{{ route('warehouse.show', $warehouse->id) }}"><button class="btn btn-outline-success mr-2 pd-t-2-force pd-b-2-force" style="cursor: pointer">VOIR</button></a>
                                                        <a href="{{ route('warehouse.edit', $warehouse->id) }}"><button class="btn btn-outline-info ml-2 pd-t-2-force pd-b-2-force" style="cursor: pointer">EDITER</button></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr class="odd">
                                                <td colspan="4" class="dataTables_empty" valign="top">
                                                    Aucun entrepot n'a été enregitré
                                                </td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>

                            </div><!-- row -->
                        </div>
                    </div>

                </div><!-- br-section-wrapper -->
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
