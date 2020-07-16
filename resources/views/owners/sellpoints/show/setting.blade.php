@extends('owners.sellpoints.show')
@section('show-content')
    <div id="modaldemo5" class="modal fade" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-body tx-center pd-y-20 pd-x-20">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <i class="icon icon ion-ios-close-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>
                    <h4 class="tx-danger  tx-semibold mg-b-20">Danger: suppression du point de vente !</h4>
                    <p class="mg-b-20 mg-x-20">Si vous etes sure de supprimer cet point de vente entrer <strong>{{ $sellpointSlug }}</strong></p>
                    <form action="{{ route('sellpoint.destroy', $sellpoint->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <div class="form-group">
                            <input name="slugDelete" class="form-control is-warning tx-center" placeholder="" type="text" autofocus>
                        </div>
                        <button type="submit" class="btn btn-danger tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20">
                            Supprimer</button>
                    </form>
                </div><!-- modal-body -->
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div>

    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex justify-content-center align-content-start flex-column">
            <h4>{{ $sellpoint->name }}</h4>
            <h6>Localité : {{ $sellpoint->location }}</h6>
            <h6>Crée {{ $sellpoint->created_at->diffForHumans() }}</h6>
        </div>
        <img src="{{ asset('img/undraw_business_shop_qw5t.svg') }}" class="img-fluid d-block" width="200px" alt="">
    </div>
    <hr class="w-100">
    <div class="d-flex align-content-center justify-content-between mt-4">
        <a href="{{ route('sellpoint.edit', $sellpoint->id) }}" style="cursor:pointer; color: #fff" class="btn btn-primary btn-with-icon">
            <div class="ht-40 justify-content-between">
                <span class="pd-x-15">EDITER LE POINT DE VENTE</span>
                <span class="icon wd-40"><i class="fa fa-edit"></i></span>
            </div>
        </a>
        <button style="cursor:pointer;" data-toggle="modal" data-target="#modaldemo5" class="btn btn-danger btn-with-icon">
            <div class="ht-40">
                <span class="icon wd-40"><i class="fa fa-trash-o"></i></span>
                <span class="pd-x-15">SUPPRIMER LE POINT DE VENTE</span>
            </div>
        </button>
    </div>
@endsection
