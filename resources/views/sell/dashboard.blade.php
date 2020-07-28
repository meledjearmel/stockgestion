@extends('layouts.swup')
@section('content')
<div id="app-selling">
    <div class="br-mainpanel">
        <div class="br-pagebody mg-t-80-force">
            <div class="row row-sm">

                <div class="col-sm-12 col-xl-4 mg-t-20 mg-sm-t-0">
                    <div class="bg-purple rounded overflow-hidden">
                        <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                            <i class="ion ion-cash tx-60 lh-0 tx-white op-7"></i>
                            <div class="mg-l-20">
                                <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Total de la vente d'aujourd'hui</p>
                                <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">{{ number_format($mountToday, 1, ",", ".") }}</p>
                                <span class="tx-11 tx-roboto tx-white-8">Franc CFA XOF</span>
                            </div>
                        </div>
                        <div id="ch3" class="ht-50 tr-y-1"></div>
                    </div>
                </div><!-- col-3 -->

                <div class="col-sm-6 col-xl-4">
                    <div class="bg-info rounded overflow-hidden">
                        <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                            <i class="ion ion-earth tx-60 lh-0 tx-white op-7"></i>
                            <div class="mg-l-20">
                                <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Total des ventes d'hier</p>
                                <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">{{ number_format($mountYester, 1, ",", ".") }}</p>
                                <span class="tx-11 tx-roboto tx-white-8">Franc CFA XOF</span>
                            </div>
                        </div>
                        <div id="ch1" class="ht-50 tr-y-1"></div>
                    </div>
                </div><!-- col-3 -->

                <div class="col-sm-6 col-xl-4 mg-t-20 mg-xl-t-0">
                    <div class="bg-teal rounded overflow-hidden">
                        <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                            <i class="ion ion-monitor tx-60 lh-0 tx-white op-7"></i>
                            <div class="mg-l-20">
                                <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Total des ventes du mois</p>
                                <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">{{ number_format($mountMonth, 1, ",", ".") }}</p>
                                <span class="tx-11 tx-roboto tx-white-8">Franc CFA XOF</span>
                            </div>
                        </div>
                        <div id="ch2" class="ht-50 tr-y-1"></div>
                    </div>
                </div><!-- col-3 -->

            </div><!-- row -->

            <div class="row row-sm mg-t-20">
                <div class="col-lg-12">
                    <div class="card bd-0 shadow-base">
                        <div class="pd-l-25 pd-r-15 pd-b-25 pd-t-25">
                            <div id="ch5" class="ht-250 ht-sm-300">
                                <div class="table-wrapper">
                                    <table id="datatable1" class="table display responsive nowrap">
                                        <thead>
                                        <tr>
                                            <th class="wd-45p">Libelle du roduits</th>
                                            <th class="wd-15p tx-center">Prix unitaire</th>
                                            <th class="wd-10p tx-center">Quantite</th>
                                            <th class="wd-15p tx-center">Montant</th>
                                            <th class="wd-15p tx-center">Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($AllSelled))
                                            @foreach($AllSelled as $selled)
                                                <tr>
                                                    <td title="{{ $selled->name }}" style="max-width: 600px !important; text-overflow: ellipsis; overflow: hidden">{{ $selled->name }}</td>
                                                    <td class="text-center">{{ $selled->price }} XOF</td>
                                                    <td class="text-center">{{ $selled->count }}</td>
                                                    <td class="text-center">{{ $selled->mount }} XOF</td>
                                                    <td class="text-center">{{ $selled->date }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr class="odd">
                                                <td colspan="5" class="dataTables_empty" valign="top">
                                                    Aucune vente n'a été enregitré
                                                </td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div><!-- card -->
                </div><!-- col-8 -->
            </div><!-- row -->

        </div><!-- br-pagebody -->
    </div><!-- br-mainpanel -->
</div>
@endsection
@section('child-js')
    <script src="{{ asset('js/app-selling.js') }}"></script>
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
