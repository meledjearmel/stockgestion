@extends('layouts.swup')
@section('content')
    <div id="app-warehouse-show">
        <div class="br-mainpanel">
            <div class="br-pagetitle d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="icon ion-ios-filing-outline"></i>
                    <div class="ml-3">
                        <h4>Liste des point de vente disponible</h4>
                    </div>
                </div>
            </div>

            <div class="br-pagebody pd-t-15-force pd-b-15-force">
                <div class="br-section-wrapper">
                    <div class="table-wrapper">
                        <table id="datatable1" class="table display responsive nowrap">
                            <thead>
                            <tr>
                                <th class="wd-5p tx-center">#</th>
                                <th class="wd-35p">Libéle du point de vente</th>
                                <th class="wd-35p">Localité du point de vente</th>
                                <th class="wd-15p tx-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($sellpoints))
                                @foreach($sellpoints as $sellpoint)
                                    <tr>
                                        <td class="text-center">{{ $sellpoint->id }}</td>
                                        <td>{{ $sellpoint->name }}</td>
                                        <td>{{ $sellpoint->location }}</td>
                                        <td class="tx-center">
                                            <a href="{{ route('sellpoint.show', $sellpoint->id) }}"><button class="btn btn-outline-success mr-2 pd-t-2-force pd-b-2-force" style="cursor: pointer">VOIR</button></a>
                                            <a href="{{ route('sellpoint.edit', $sellpoint->id) }}"><button class="btn btn-outline-info ml-2 pd-t-2-force pd-b-2-force" style="cursor: pointer">EDITER</button></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="odd">
                                    <td colspan="4" class="dataTables_empty" valign="top">
                                        Aucun point de vente n'a été enregitré
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('child-js')
    <script>
        $('#datatable1').DataTable({
            responsive: true,
            lengthMenu: [5],
            language: {
                searchPlaceholder: 'Recherche...',
                sSearch: '',
                lengthMenu: '_MENU_ points de vente par page',
            }
        });
    </script>
@endsection
