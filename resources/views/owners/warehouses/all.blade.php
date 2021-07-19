@extends('layouts.swup')
@section('content')
    <div id="app-warehouse-show">
        <div class="br-mainpanel">
            <div class="br-pagetitle d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="icon ion-ios-filing-outline"></i>
                    <div class="ml-3">
                        <h4>Liste des entrepots disponible</h4>
                    </div>
                </div>
                @if(session()->get('success'))
                    <div class="col-xl-5" id="successNotify">
                        <div class="alert alert-success alert-solid" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <div class="d-flex align-items-center justify-content-start">
                                <i style="color: #fff" class="icon ion-ios-checkmark alert-icon tx-22 mg-t-5 mg-xs-t-0"></i>
                                <span><strong>Succès !</strong> L'entrepot {{session()->get('name')}} a été supprimé</span>
                            </div><!-- d-flex -->
                        </div>
                    </div>
                @endif
            </div>

            <div class="br-pagebody pd-t-15-force pd-b-15-force">
                <div class="br-section-wrapper">
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
            lengthMenu: '_MENU_ entrepots par page',
        }
    });
</script>
@endsection
