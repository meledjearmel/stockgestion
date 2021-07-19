@extends('layouts.swup')
@section('content')
    <div id="app-article-show">
        <div class="br-mainpanel">
            <div class="br-pagetitle d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="icon ion-ios-filing-outline"></i>
                    <div class="ml-3">
                        <h4>Liste de tout les employes de la plateforme</h4>
                    </div>
                </div>
            </div>
            <div class="br-pagebody pd-t-15-force pd-b-15-force">
                <div class="br-section-wrapper">
                    <div class="table-wrapper">
                        <table id="datatable1" class="table display responsive nowrap">
                            <thead>
                            <tr>
                                <th class="wd-10p">Nom</th>
                                <th class="wd-25p">Prenom(s)</th>
                                <th class="wd-10p">Genre</th>
                                <th class="wd-20p">Email</th>
                                <th class="wd-10p text-center">Contact</th>
                                <th class="wd-15p text-center">Role</th>
                                <th class="wd-10p tx-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($employes))
                                @foreach($employes as $employe)
                                    @php
                                        $roles = $employe->getRoleNames();
                                        if ($roles[0] === 'manager') {
                                            $role = 'Manager';
                                        } elseif ($roles[0] === 'seller') {
                                            $role = ($employe->sex === 'Masculin') ? 'Vendeur' : 'Vendeuse';
                                        }
                                    @endphp
                                    <tr>
                                        <td>{{ $employe->name }}</td>
                                        <td>{{ $employe->lastname }}</td>
                                        <td>{{ $employe->sex }}</td>
                                        <td>{{ $employe->email }}</td>
                                        <td class="text-center">{{ $employe->contact }}</td>
                                        <td class="text-center">{{ $role }}</td>
                                        <td class="tx-center">
                                            <a href="{{ route('employe.show', $employe->id) }}"><button class="btn btn-outline-success mr-2 pd-t-2-force pd-b-2-force" style="cursor: pointer">VOIR</button></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="odd">
                                    <td colspan="6" class="dataTables_empty" valign="top">
                                        <a href="{{ route('employe.create') }}"><button class="btn btn-outline-info" style="cursor: pointer">CREER UN NOUVEL EMPOYE</button></a>
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
                lengthMenu: '_MENU_ employes par page',
            }
        });
    </script>
@endsection
