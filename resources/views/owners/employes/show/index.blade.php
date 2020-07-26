@extends('owners.employes.show')
@section('show-content')
    <div id="modaldemo5" class="modal fade" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-body tx-center pd-y-20 pd-x-20">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <i class="icon icon ion-ios-close-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>
                    <h4 class="tx-danger tx-semibold mg-b-20">Danger: suppression de l'employe !</h4>
                    <p class="mg-b-20 mg-x-20">Si vous etes sure de supprimer cet employe entrer <br><strong>{{ $userSlug ?? '' }}</strong></p>
                    <form action="{{ route('employe.destroy', $user->id) }}" method="POST">
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
   {{-- <div id="modaldemo6" class="modal fade" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-body tx-center pd-y-20 pd-x-20">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <i class="icon icon fa fa-shopping-cart tx-100 tx-primary lh-1 mg-t-20 d-inline-block"></i>
                    <h4 class="tx-primary tx-semibold mg-b-20">Modifiaction !</h4>
                    <p class="mg-b-20 mg-x-20">Changer le point de vente de <strong>{{ $user->lastname }} {{ $user->name }}</strong></p>
                    <form action="{{ route('employe.update', $user->id) }}" method="POST">
                        @method('PUT')
                        <input type="hidden" name="change_sellpoint" value="on">
                        @csrf
                        <div style="width: 400px;" class="form-group bd-info col-12">
                            <select class="form-control select2 col-12" data-placeholder="Choose Browser">
                                @foreach($sellpoints as $sell)
                                    <option value="{{ $sell->id }}">{{ $sell->name }} ( {{ $sell->location }} )</option>
                                @endforeach
                            </select>
                        </div><!-- form-group -->
                        <button type="submit" class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20">Modifier</button>
                    </form>
                </div><!-- modal-body -->
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div>--}}
    <div id="modaldemo4" class="modal fade" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-body tx-center pd-y-20 pd-x-20">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <i class="icon icon ion-key tx-100 tx-info lh-1 mg-t-20 d-inline-block"></i>
                    <h4 class="tx-info tx-semibold mg-b-20">Modifiaction !</h4>
                    <p class="mg-b-20 mg-x-20">Changer la fonction de <strong>{{ $user->lastname }} {{ $user->name }}</strong></p>
                    <form action="{{ route('employe.update', $user->id) }}" method="POST">
                        @method('PUT')
                        <input type="hidden" name="change_role" value="on">
                        @csrf
                        <div style="width: 400px;" class="form-group bd-info col-12">
                            <select class="form-control select2 col-12" name="role" data-placeholder="Choisir le role">
                                <option value="manager">Manager de stock</option>
                                <option value="seller">{{ ($user->sex === 'Masculin') ? 'Vendeur' : 'Vendeuse' }}</option>
                            </select>
                        </div><!-- form-group -->
                        <button type="submit" class="btn btn-info tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20">Modifier</button>
                    </form>
                </div><!-- modal-body -->
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex justify-content-center align-content-start flex-column">
            <h3>{{ $user->lastname }} {{ $user->name }}</h3>
            <h6>{{ $user->sex }}</h6>
            <h6>{{ $role }} au point de vente {{ $sellpoint->name }}, {{ $sellpoint->location }}</h6>
            <h6>{{ $user->email }}</h6>
            <h6>{{ $user->contact }}</h6>
            @php
                $picture = str_replace('public', 'storage', $user->picture);
            @endphp
        </div>
        <img id="profil_img" src="{{ asset($picture) }}" class="img-fluid d-block" width="200px" alt="">
    </div>

    <hr class="w-100">
    <h6 class="tx-uppercase mg-b-20-force">Informations sur le ponit de vente {{ $sellpoint->name }}, {{ $sellpoint->location }}</h6>
    <div class="col-sm-10 col-xl-8 m-auto">
        <div class="{{ $bgcolor }} rounded overflow-hidden">
            <div class="pd-x-20 pd-t-20 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="mg-l-20 text-center">
                        <p class="tx-20 tx-white tx-lato tx-bold mg-b-10 lh-1">Artisan(s)</p>
                        <p class="tx-18 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8">{{ $nbreEmploye }}</p>
                        <p class="tx-11 tx-spacing-1 tx-uppercase tx-white-8">Actif</p>
                    </div>
                </div>
                <div class="text-center">
                    <p class="tx-20 tx-white tx-lato tx-bold mg-b-10 lh-1">Article(s)</p>
                    <p class="tx-18 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8">{{ $nbreArticle }}</p>
                    <p class="tx-11 tx-spacing-1 tx-uppercase tx-white-8">En stock</p>
                </div>
                <div class="text-center">
                    <p class="tx-20 tx-white tx-lato tx-bold mg-b-10 lh-1">Ventes</p>
                    <p class="tx-18 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8">{{ $soldeMensuel }} CFA</p>
                    <p class="tx-11 tx-spacing-1 tx-uppercase tx-white-8">Dans ce mois</p>
                </div>
                <div class="d-flex justify-content-end align-items-center">
                    <a onmouseover="style.color = '#fff'" href="{{ route('sellpoint.show', $sellpoint->id) }}" style="cursor: pointer" class="btn tx-12 tx-white tx-lato bd-white-3 {{ $bgcolor }} tx-uppercase">Visiter</a>
                </div>
            </div>
            <div id="ch1" class="ht-30 tr-y-1"></div>
        </div>
    </div><!-- col-3 -->

    <hr class="w-100">
    <h6 class="tx-uppercase mg-b-20-force">Actions sur l'employe</h6>
    <div class="d-flex align-content-center justify-content-between">
        <button style="cursor:pointer;" data-toggle="modal" data-target="#modaldemo4" class="btn btn-info btn-with-icon">
            <div class="ht-40">
                <span class="icon wd-40"><i class="ion-android-settings"></i></span>
                <span class="pd-x-15">CHANGER LA FONCTION DE L'EMPLOYE</span>
            </div>
        </button>
        {{--<button style="cursor:pointer;" data-toggle="modal" data-target="#modaldemo6" class="btn btn-primary btn-with-icon">
            <div class="ht-40">
                <span class="icon wd-40"><i class="ion-android-settings"></i></span>
                <span class="pd-x-15">CHANGER LE POINT DE VENTE DE L'EMPLOYE</span>
            </div>
        </button>--}}
        <button style="cursor:pointer;" data-toggle="modal" data-target="#modaldemo5" class="btn btn-danger btn-with-icon">
            <div class="ht-40">
                <span class="icon wd-40"><i class="fa fa-trash-o"></i></span>
                <span class="pd-x-15">SUPPRIMER L'EMPLOYE</span>
            </div>
        </button>
    </div>
@endsection
@section('min-child-js')
    <script>
        (function () {
            let img = document.querySelector('#profil_img'),
                testImg = new Image();
            testImg.onerror = () => {
                img.src = location.origin + '/img/img11.jpg'
            }
            testImg.src = img.src
        })()
    </script>
@endsection
