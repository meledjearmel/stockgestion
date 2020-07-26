@extends('layouts.swup')
@section('content')
    <div id="app-article-show">
        <div class="br-mainpanel">
            <div class="br-pagetitle d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="icon ion-ios-filing-outline"></i>
                    <div class="ml-3">
                        <h4>Liste des articles enregistrés</h4>
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
                                <th class="wd-10p">Code</th>
                                <th class="wd-20p">Libélé des articles</th>
                                <th style="" class="wd-40p">Caracteristiques</th>
                                <th class="wd-10p">Prix Unitaire</th>
                                <th class="wd-15p tx-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(!empty($articles))
                                    @foreach($articles as $article)
                                        <tr>
                                            <td class="text-center">{{ $article->id }}</td>
                                            <td>{{ $article->code }}</td>
                                            <td>{{ $article->name }}</td>
                                            <td style="max-width: 300px !important; text-overflow: ellipsis; overflow: hidden">{{ $article->caracts ?? 'Aucune caracteristique note' }}</td>
                                            <td class="text-center">{{ $article->price }}</td>
                                            <td class="tx-center">
                                                <a href="{{ route('article.show', $article->id) }}"><button class="btn btn-outline-success mr-2 pd-t-2-force pd-b-2-force" style="cursor: pointer">VOIR</button></a>
                                                <a href="{{ route('article.edit', $article->id) }}"><button class="btn btn-outline-info ml-2 pd-t-2-force pd-b-2-force" style="cursor: pointer">EDITER</button></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="odd">
                                        <td colspan="6" class="dataTables_empty" valign="top">
                                            <a href="{{ route('article.create') }}"><button class="btn btn-outline-info" style="cursor: pointer">CREER UN NOUVEL ARTICLE</button></a>
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
                lengthMenu: '_MENU_ articles par page',
            }
        });
    </script>
@endsection
