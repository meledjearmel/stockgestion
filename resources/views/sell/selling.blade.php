@extends('layouts.swup')
@section('content')

    <div id="app-selling">
        <div class="br-mainpanel">
            <div id="factureModal" class="modal fade" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content bd-0 tx-14">
                        <div class="modal-header pd-x-20">
                            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold"><span>Montant de la facture: </span><span id="mount"></span></h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div id="facturePrint" class="modal-body pd-5">
                            <table class="table mg-b-0 tx-10-force">
                                <thead>
                                <tr>
                                    <th class="tx-10-force">ID</th>
                                    <th class="tx-10-force">NOM</th>
                                    <th class="tx-10-force">PRIX</th>
                                    <th class="tx-10-force">NOMBRE</th>
                                    <th class="tx-10-force">TOTAL</th>
                                </tr>
                                </thead>
                                <tbody id="factContent">

                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button @click="resetFact" type="button" class="btn btn-danger tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">SUPPRIMER LA FACTURE</button>
                            <button @click="printFact" type="button" class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">VALIDER</button>
                        </div>
                    </div>
                </div><!-- modal-dialog -->
            </div>
            <div class="br-pagetitle d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="icon ion-bag"></i>
                    <div class="ml-3">
                        <h4>Point de vente</h4>
                        <p class="mg-b-0">Vendez sans vous préocuper du point</p>
                    </div>
                </div>
                <div class="ht-lg-40 bg-gray-200 pd-x-20 d-lg-flex align-items-center justify-content-center">
                    <ul class="nav nav-effect nav-effect-1 flex-column flex-lg-row" role="tablist">
                        <li @click.prevent="loadHome" class="nav-item"><a class="nav-link" data-toggle="tab" href="{{ route('sellboard') }}" role="tab">Acceuil</a></li>
                        <li @click.prevent="loadSell" class="nav-item"><a class="nav-link active" data-toggle="tab" href="{{ route('selling') }}" role="tab">Vendre</a></li>
                    </ul>
                </div>
            </div>
            <div class="br-pagebody">
                <div class="br-section-wrapper mr-5 pd-b-25-force pd-t-30-force" style="">
                    <div class="form-layout form-layout-3">
                    <div class="row mg-b-25">
                        <div class="col-lg-12 mg-b-20-force">
                            <h5 class="text-righ ">Montant total de la facture: <span id="mountDash">0 XOF</span></h5>
                        </div><!-- col-4 -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input v-model.trim.lazy="product.code" style="font-size: 1.2em !important;" class="form-control text-center text-uppercase" type="text" name="code" value="" maxlength="8" placeholder="CODE DU PRODUIT">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input v-model.trim.lazy="product.name" style="font-size: 1.2em !important;" class="form-control text-center  text-uppercase" type="text" name="name" value="" placeholder="NOM DU PRODUIT">
                            </div>
                        </div><!-- col-4 -->
                    </div><!-- row -->
                    <div class="row mg-b-25">
                        <div class="col-lg-6">
                            <div class="form-group bg-gray-200">
                                <input v-model="product.price" style="font-size: 1.2em !important; cursor: not-allowed" class="form-control text-center disabled text-uppercase" type="text" name="price" value="" placeholder="PRIX UNITAIRE" disabled>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input v-model.number="product.count" @keyup="calculMount" style="font-size: 1.2em !important;" class="form-control text-center" type="number" name="name" value="" placeholder="QUANTITE DU PRODUIT">
                            </div>
                        </div><!-- col-4 -->
                    </div><!-- row -->
                    <div class="row mg-b-25">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input @keyup="calcMonnaie" v-model="clientMount" style="font-size: 1.2em !important;" class="form-control text-center disabled text-uppercase" type="text"  value="" placeholder="ARGENT REMIS">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-6">
                            <div class="form-group bg-gray-200">
                                <input style="font-size: 1.2em !important; cursor: not-allowed" id="monnaie" class="form-control text-center" type="text"  value="" placeholder="MONNAIE DU CLIENT" disabled>
                            </div>
                        </div><!-- col-4 -->
                    </div><!-- row -->

                    <div class="form-layout-footer d-flex justify-content-center">
                        <button @click.prevent="delRecentProduct" style="cursor: pointer" class="m-2 btn btn-danger btn-with-icon">
                            <div class="ht-40">
                                <span class="icon wd-40"><i class="fa fa-trash"></i></span>
                                <span class="pd-x-15">SUPRIMER LE PRODUIT</span>
                            </div>
                        </button>
                        <button @click.prevent="addProduct" style="cursor: pointer" class="m-2 btn btn-primary btn-with-icon">
                            <div class="ht-40">
                                <span class="icon wd-40"><i class="fa fa-shopping-cart"></i></span>
                                <span class="pd-x-15">AJOUTER LE PRODUIT</span>
                            </div>
                        </button>
                        <button @click="doFacture" style="cursor: pointer" class="m-2 btn btn-success btn-with-icon" data-toggle="modal" data-target="#factureModal">
                            <div class="ht-40">
                                <span class="icon wd-40"><i class="fa fa-money"></i></span>
                                <span class="pd-x-15">FAIRE LA FACTURE</span>
                            </div>
                        </button>
                    </div><!-- form-layout-footer -->
                </div><!-- form-layout -->
                </div>
            </div>
        </div>
    </div>

@endsection
@section('child-js')
    <script src="{{ asset('js/app-selling.js') }}"></script>
@endsection
