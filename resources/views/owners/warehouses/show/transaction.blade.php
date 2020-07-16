@extends('owners.warehouses.show')

@section('show-content')
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex justify-content-center align-content-start flex-column">
            <h4>Aliomentation effectué sur {{ $warehouse->name }}</h4>
        </div>
        <img src="{{ asset('img/warehouse.jpg') }}" class="img-fluid d-block" width="80px" alt="">
    </div>
    <hr class="w-100">
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
@endsection
