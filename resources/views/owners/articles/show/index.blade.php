@extends('owners.articles.show')
@section('show-content')
    <div id="modaldemo5" class="modal fade" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-body tx-center pd-y-20 pd-x-20">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <i class="icon icon ion-ios-close-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>
                    <h4 class="tx-danger  tx-semibold mg-b-20">Danger: suppression de l'article !</h4>
                    <p class="mg-b-20 mg-x-20">Si vous etes sure de supprimer cet article entrer <strong>{{ $articleSlug }}</strong></p>
                    <form action="{{ route('article.destroy', $article->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <div class="form-group">
                            <input name="slugDelete" class="form-control is-warning tx-center" placeholder="" type="text" autofocus>
                        </div>
                        <button type="submit" class="btn btn-danger tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20">Supprimer</button>
                    </form>
                </div><!-- modal-body -->
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div>

    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex justify-content-center align-content-start flex-column">
            <h4>{{ $article->name }}</h4>
            <h6 class="tx-14-force" style="max-width: 300px">{{ $article->caracts ?? 'Aucune description' }}</h6>
            <h6>Prix Unitaire : {{ $article->price }} XOF</h6>
            <h6>Crée {{ $article->created_at->diffForHumans() }}</h6>
            @php
                $img_url = str_replace('public', 'storage', $article->img_url);
                function getQuantity ($model)
                    {
                        $used = DB::table('article_warehouse')
                            ->select(DB::raw('sum(quantity) as total'))
                            ->where('warehouse_id', '=', $model->id)
                            ->get();

                        return $used[0]->total;
                    }
                    $sellId = 0;
                    $wareId = 0;
            @endphp
        </div>
        <img id="article_img" src="{{ asset($img_url) }}" class="img-fluid d-block" width="200px" alt="">
    </div>
    <hr class="w-100">
    <h6 class="tx-uppercase mg-b-10-force"> @if(!empty($warehouses->toArray())) Disponibilite dans les entrepots @else Cet article n'a ete atribuer a aucun entrepot @endif</h6>
    <div class="row row-sm">
        @if($warehouses)

            @foreach($warehouses as $warehouse)
                @php
                    $i = rand(0, 9);
                    $qty = ($warehouse->pivot->quantity * 100) / getQuantity($warehouse);
                @endphp
                <div class="col-sm-6 col-xl-4">
                    <div class="{{ $bgcolor[$i] }} rounded overflow-hidden">
                        <div class="pd-x-20 pd-t-20 d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <i class="ion ion-ios-filing-outline tx-60 lh-0 tx-white op-7"></i>
                                <div class="mg-l-20">
                                    <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">{{ $warehouse->name }}</p>
                                    @if($warehouse->pivot->quantity !== 0)
                                        <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">{{ $warehouse->pivot->quantity }}</p>
                                    @else
                                        <p class="tx-18 tx-white tx-lato tx-bold mg-b-6-force lh-1">{{ 'En rupture de stock' }}</p>
                                    @endif
                                    <span class="tx-11 tx-roboto tx-white-8">{{ round($qty, 2) }}% du stock</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end align-items-center">
                                <a onmouseover="style.color = '#fff'" href="{{ route('warehouse.show', $warehouse->id) }}" style="cursor: pointer" class="btn tx-12 tx-white tx-lato bd-white-3 {{ $bgcolor[$i] }} tx-uppercase">Visiter</a>
                            </div>
                        </div>
                        <div id="{{ 'warehouse'.++$wareId }}" class="ht-50 tr-y-1"></div>
                    </div>
                </div><!-- col-3 -->
            @endforeach

        @endif
    </div><!-- row -->

    <hr class="w-100">

    <h6 class="tx-uppercase mg-b-20-force">@if(!empty($sellpoints->toArray())) Disponibilite dans les points de ventes @else Cet article n'a ete atribuer a aucun point de vente @endif</h6>
    <div class="row row-sm">
        @if($sellpoints)

            @foreach($sellpoints as $sellpoint)
                @php
                    $i = rand(0, 9);
                @endphp
                <div class="col-sm-6 col-xl-4">
                    <div class="{{ $bgcolor[$i] }} rounded overflow-hidden">
                        <div class="pd-x-20 pd-t-20 d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <i class="ion ion-bag tx-60 lh-0 tx-white op-7"></i>
                                <div class="mg-l-20">
                                    <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">{{ $sellpoint->name }}</p>
                                    @if($sellpoint->pivot->quantity !== 0)
                                        <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">{{ $sellpoint->pivot->quantity }}</p>
                                    @else
                                        <p class="tx-18 tx-white tx-lato tx-bold mg-b-6-force lh-1">{{ 'En rupture de stock' }}</p>
                                    @endif
                                    <span class="tx-11 tx-roboto tx-white-8"></span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end align-items-center">
                                <a onmouseover="style.color = '#fff'" href="{{ route('sellpoint.show', $sellpoint->id) }}" style="cursor: pointer" class="btn tx-12 tx-white tx-lato bd-white-3 {{ $bgcolor[$i] }} tx-uppercase">Visiter</a>
                            </div>
                        </div>
                        <div id="{{ 'sellpoint'.++$sellId }}" class="ht-50 tr-y-1"></div>
                    </div>
                </div><!-- col-3 -->
            @endforeach

        @endif
    </div><!-- row -->
    <div class="col-sm-6 col-xl-4 mg-t-20 mg-xl-t-0">
        <div class="bg-teal rounded overflow-hidden">

        </div>
    </div><!-- col-4 -->

    <hr class="w-100">

    <h6 class="tx-uppercase mg-b-20-force">Actions sur l'article</h6>
    <div class="d-flex align-content-center justify-content-between">
        <a href="{{ route('article.edit', $article->id) }}" style="cursor:pointer; color: #fff" class="btn btn-primary btn-with-icon">
            <div class="ht-40 justify-content-between">
                <span class="pd-x-15">EDITER L'ARTICLE</span>
                <span class="icon wd-40"><i class="fa fa-edit"></i></span>
            </div>
        </a>
        <button style="cursor:pointer;" data-toggle="modal" data-target="#modaldemo5" class="btn btn-danger btn-with-icon">
            <div class="ht-40">
                <span class="icon wd-40"><i class="fa fa-trash-o"></i></span>
                <span class="pd-x-15">SUPPRIMER L'ARTICLE</span>
            </div>
        </button>
    </div>
    <div id="counter" class="d-none" data-count-sellpoint="{{ count($sellpoints->toArray()) }}" data-count-warehouse="{{ count($warehouses->toArray()) }}"></div>
@endsection
@section('min-child-js')
    <script src="{{ asset('js/rickraw/article-sellpoint-load.js') }}"></script>
    <script>
        (function () {
            let img = document.querySelector('#article_img'),
                testImg = new Image();
            testImg.onerror = () => {
                img.src = location.origin + '/img/img11.jpg'
            }
            testImg.src = img.src
        })()
    </script>
@endsection
