@extends('owners.warehouses.show')

@section('show-content')
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex justify-content-center align-content-start flex-column">
            <h4>Ajouter des articles à {{ $warehouse->name }}</h4>
            <h5>Stockage libre: {{ ($warehouse->capacity - $used) }}</h5>
            <h5>Stockage utilise: {{ $used ?? 0 }}</h5>
        </div>
        <img src="{{ asset('img/warehouse.jpg') }}" class="img-fluid d-block" width="100px" alt="">
    </div>
    <hr class="w-100">
    <div class="d-flex align-content-center">
        <form action="{{ route('warehouse.supply.store', $warehouse->id) }}" class="w-100" method="POST">
            @csrf
            <div class="col-lg-12 mg-t-10-force w-100 d-flex flex-column justify-content-center align-items-center">
                <div class="row col-lg-12 mg-t-10-force w-100">
                    <div class="form-group has-success col-6">
                        <select name="article_id" class="form-control select2-show-search" data-placeholder="Choisir l'article">
                            @if($articles)
                                @foreach($articles as $article)
                                    <option value="{{ $article->id }}">{{ $article->name }} ({{ $article->caracts }} {{ $article->price }}XOF)</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-6 form-group">
                        <div class="col-lg has-success">
                            <input name="quantity" class="form-control tx-uppercase tx-center" placeholder="Entrer la quantité de l'article" type="number">
                        </div>
                    </div>
                    </div>
                <div class="form-group col-5 mt-3">
                    <button type="submit" style="cursor: pointer" class="btn btn-outline-primary bd-2 btn-oblong btn-block mg-b-10">AJOUTER L'ARTICLE A L'ENTREPOT</button>
                </div>
            </div>
        </form>
    </div>
@endsection
