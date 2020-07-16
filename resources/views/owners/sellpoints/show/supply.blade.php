@extends('owners.sellpoints.show')
@section('show-content')
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex justify-content-center align-content-start flex-column">
            <h4>{{ $sellpoint->name }}</h4>
            <h6>Localité : {{ $sellpoint->location }}</h6>
            <h6>Crée {{ $sellpoint->created_at->diffForHumans() }}</h6>
        </div>
        <img src="{{ asset('img/undraw_business_shop_qw5t.svg') }}" class="img-fluid d-block" width="200px" alt="">
    </div>
    <hr class="w-100">
    <div class="d-flex align-content-center" id="app-sellpoint-supply">
        <form action="{{ route('sellpoint.supply.store', $sellpoint->id) }}" class="w-100" method="POST">
            @csrf
            <div class="col-lg-12 mg-t-10-force w-100 d-flex flex-column justify-content-center align-items-center">
                <div class="row col-lg-12 mg-t-10-force w-100">
                    <div class="form-group has-success col-6">
                        <select v-model="warehouse_id" v-select='warehouse_id' @change="sendWarehouseId" id="warehouse_id" name="warehouse_id" class="form-control select2-show-search" data-placeholder="Choisir l'entrepot">
                            @if($warehouses)
                                @foreach($warehouses as $warehouse)
                                    <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div :class="state.wareUsed ? 'has-success' : 'has-danger'" class="form-group col-6">

                        <select v-if="state.wareUsed" v-model="article_id" v-select='article_id' id="article_id" name="article_id" class="form-control select2-show-search" :data-placeholder="state.placeholder">
                            <option v-for="article in state.articles" :value="article.id">@{{ article.name }} ( @{{ article.value }} produit(s) restant(s) )</option>
                        </select>

                        <select v-else class="form-control select2-show-search" :data-placeholder="state.placeholder" readonly>

                        </select>

                    </div>
                </div>
                <div class="row col-lg-12 mg-t-10-force w-100 d-flex justify-content-center">
                    <div :class="state.wareUsed ? 'has-success' : 'has-danger'" class="form-group col-6">
                        <input name="quantity" class="form-control tx-uppercase tx-center" placeholder="Entrer la quantité de l'article" type="number">
                    </div>
                </div>
                <div class="form-group col-5 mt-3">
                    <button type="" style="cursor: pointer" class="btn btn-outline-primary bd-2 btn-oblong btn-block mg-b-10">AJOUTER L'ARTICLE AU POINT DE VENTE</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('myChild-js')
    <script src="{{ asset('js/app-sellpoint-supply.js') }}"></script>
@endsection
