@extends('layouts.swup')
@section('child-css')
    <link rel="stylesheet" href="{{ asset('lib/dropzone/dist/min/dropzone.min.css') }}">
@endsection
@section('content')
    <div id="app-article-edit">
        <div class="br-mainpanel">
            <div class="br-pagetitle d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="icon ion-person-add"></i>
                    <div class="ml-3">
                        <h4>Creer un nouvel employe</h4>
                    </div>
                </div>
                @if(session()->get('success'))
                    <div class="col-xl-5" id="successNotify">
                        <div class="alert alert-success alert-solid" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <div class="d-flex align-items-center justify-content-start">
                                <i style="color: #fff" class="icon ion-ios-checkmark alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
                                <div class="d-flex flex-column justify-content-center align-content-start">
                                    <span><strong>Succès ! </strong>{{ session()->get('role') }} {{ session()->get('lastname') }} {{ session()->get('name') }} a ete creer</span>
                                    <span>Login: {{ session()->get('email') }}</span>
                                    <span>Mot de passe: {{ session()->get('password') }}</span>
                                </div>
                            </div><!-- d-flex -->
                        </div>
                    </div>
                @endif
            </div>
            <div style="margin-top: 10px !important;" class="br-pagebody">
                <div class="br-section-wrapper">
                    <form action="{{ route('employe.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-layout form-layout-2">
                            <div class="row no-gutters">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Prenom(s): <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="lastname" value="{{ old('lastname') }}" placeholder="Ex: John">
                                        @error('lastname')
                                            <ul class="parsley-errors-list filled" id="parsley-id-26">
                                                <li class="parsley-required">{{ $message }}</li>
                                            </ul>
                                        @enderror
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Nom: <span class="tx-danger">*</span></label>
                                        <input class="form-control" maxlength="8" type="text" name="name" value="{{ old('name') }}" placeholder="Ex: Doe">
                                        @error('name')
                                            <ul class="parsley-errors-list filled" id="parsley-id-26">
                                                <li class="parsley-required">{{ $message }}</li>
                                            </ul>
                                        @enderror
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Sexe: </label>
                                        <div style="justify-content: space-evenly" class="d-flex align-items-center">
                                            <label class="rdiobox">
                                                <input name="sex" value="Masculin" type="radio" checked>
                                                <span>Homme</span>
                                            </label>
                                            <label class="rdiobox">
                                                <input name="sex" value="Feminin" type="radio">
                                                <span>Femme</span>
                                            </label>
                                        </div>
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Adresse e-mail: <span class="tx-danger">*</span></label>
                                        <input  class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="Ex: johndoe@stockgestion.com">
                                        @error('email')
                                            <ul class="parsley-errors-list filled" id="parsley-id-26">
                                                <li class="parsley-required">{{ $message }}</li>
                                            </ul>
                                        @enderror
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Numero de telephone: <span class="tx-danger">*</span></label>
                                        <input id="phoneMask" class="form-control" type="text" name="contact" value="{{ old('contact') }}" placeholder="(225) 87-614-613">
                                        @error('contact')
                                            <ul class="parsley-errors-list filled" id="parsley-id-26">
                                                <li class="parsley-required">{{ $message }}</li>
                                            </ul>
                                        @enderror
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-md-4">
                                    <div style="padding-bottom: 0px;" class="form-group">
                                        <label class="form-control-label">Photo: </label>
                                        <input type="file" name="picture" id="file-2" accept=".jpg, .jpeg, .png, .svg" class="inputfile" >
                                        <label for="file-2" class="if-outline if-outline-info">
                                            <i class="icon ion-ios-upload-outline tx-24"></i>
                                            <span>Choisissez une photo...</span>
                                        </label>
                                        @error('picture')
                                        <ul class="parsley-errors-list filled" id="parsley-id-26">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                        @enderror
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Point de vente: <span class="tx-danger">*</span></label>
                                        @if($sellpoints)
                                        <select name="sellpoint_id" class="form-control select2-show-search" data-placeholder="Choose Browser">
                                            @foreach($sellpoints as $sellpoint)
                                                <option value="{{ $sellpoint->id }}">{{ $sellpoint->name }}</option>
                                            @endforeach
                                        </select>
                                        @else
                                            <div class="has-warning">
                                                <select name="sellpoint_id" class="form-control select2" data-placeholder="Choose Browser">
                                                        <option value="">Aucun entrepot disponible</option>
                                                </select>
                                            </div>
                                        @endif
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Role: <span class="tx-danger">*</span></label>
                                        <select name="role" class="form-control select2" data-placeholder="Choose Browser">
                                            <option value="manager">Manager de stock</option>
                                            <option value="seller">Vendeur</option>
                                        </select>
                                    </div>
                                </div><!-- col-4 -->

                            </div><!-- row -->
                            <div class="d-flex justify-content-between form-layout-footer bd pd-20 bd-t-0">
                                <div>
                                    <button class="btn btn-info">Creer</button>
                                    <button type="reset" class="btn btn-secondary">Effacer</button>
                                </div>
                                <div>
                                    <a href="{{ route('employe.index') }}"><button type="button" class="btn btn-outline-success">Voir tout les employes</button></a>
                                </div>
                            </div><!-- form-group -->
                        </div><!-- form-layout -->
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('child-js')
    <script>
        (function () {
            let $input	 = $( '.inputfile' ),
                $label	 = $input.next( 'label' ),
                labelVal = $label.html();

            $input.on( 'change', function( e )
            {
                var fileName = '';

                if( e.target.value )
                    fileName = e.target.value.split( '\\' ).pop();

                if( fileName )
                    $label.find( 'span' ).html( fileName );
                else
                    $label.html( labelVal );
            });

            // Firefox bug fix
            $input
                .on( 'focus', function(){ $input.addClass( 'has-focus' ); })
                .on( 'blur', function(){ $input.removeClass( 'has-focus' ); });
        })()

        $('#phoneMask').mask('(999) 99-999-999');
    </script>
@endsection
