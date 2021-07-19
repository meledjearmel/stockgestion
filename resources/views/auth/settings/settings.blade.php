@extends('layouts.swup')
@section('child-css')
    <link rel="stylesheet" href="{{ asset('lib/dropzone/dist/min/dropzone.min.css') }}">
@endsection
@section('content')
    <div id="app-article-edit">
        <div class="br-mainpanel">
            <div class="br-pagetitle d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="icon ion-android-settings tx-50-force"></i>
                    <div class="ml-3">
                        <h4>Modifier les parametres de votre compte</h4>
                    </div>
                </div>
            </div>
            <div style="margin-top: 10px !important;" class="br-pagebody">
                <div class="br-section-wrapper pd-t-25-force pd-b-25-force">

                    <h6 class="tx-uppercase mg-b-20-force"><i class="ion ion-email"></i>&nbsp;&nbsp;Adresse e-mail & nom d'utilisateur</h6>
                    <form action="{{ route('employe.update', Auth::id()) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        <input type="hidden" name="account" value="on">
                        @csrf
                        <div class="form-layout form-layout-2">
                            <div class="row no-gutters">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Email: <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="email" name="email" value="{{ old('email') ?? $user->email }}" placeholder="Ex: jonhdoe@stockgestion.com">
                                        @error('email')
                                        <ul class="parsley-errors-list filled" id="parsley-id-26">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                        @enderror
                                        @if(session()->get( 'email' ))
                                            <ul class="parsley-errors-list filled" id="parsley-id-26">
                                                <li style="color: #23BF08 !important;" class="parsley-required">L'adresse email a été modifié avec succès</li>
                                            </ul>
                                        @endif
                                    </div>
                                </div><!-- col-6 -->

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Nom d'utilisateur: <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="username" value="{{ old('username') ?? $user->username }}" placeholder="Ex: johndoe">
                                        @error('username')
                                        <ul class="parsley-errors-list filled" id="parsley-id-26">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                        @enderror
                                        @if(session()->get( 'username' ))
                                            <ul class="parsley-errors-list filled" id="parsley-id-26">
                                                <li style="color: #23BF08 !important;" class="parsley-required">Le nom d'utilisateur a été modifié avec succès</li>
                                            </ul>
                                        @endif
                                    </div>
                                </div><!-- col-6 -->

                            </div><!-- row -->
                            <div class="d-flex justify-content-end form-layout-footer bd pd-20 bd-t-0">
                                <div>
                                    <button class="btn btn-info">Mettre a jour</button>
                                </div>
                            </div><!-- form-group -->
                        </div><!-- form-layout -->
                    </form>

                    <hr class="w-100">
                    <h6 class="tx-uppercase mg-b-20-force"><i class="ion ion-locked"></i>&nbsp;&nbsp;Changer de mot de passe</h6>
                    <form action="{{ route('employe.update', Auth::id()) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        <input type="hidden" name="change_password" value="on">
                        @csrf
                        <div class="form-layout form-layout-2">
                            <div class="row no-gutters">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <span class="d-flex justify-content-between align-items-center">
                                            <label class="form-control-label">Ancien mot de passe: <span class="tx-danger">*</span></label>
                                            <span style="cursor: pointer" class="passview form-control-label tx-24-force"><i class="ion ion-ios-eye"></i></span>
                                        </span>
                                        <input class="form-control passfield" type="password" name="old_pass" value="{{ old('old_pass') }}" placeholder="Entrer l'ancien mot de passe">
                                        @error('old_pass')
                                        <ul class="parsley-errors-list filled" id="parsley-id-26">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                        @enderror
                                        @if(session()->get( 'password' ))
                                            <ul class="parsley-errors-list filled" id="parsley-id-26">
                                                <li style="color: #23BF08 !important;" class="parsley-required">L'ancien mot de passe a ete modifié avec succès</li>
                                            </ul>
                                        @endif
                                    </div>
                                </div><!-- col-3 -->

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <span class="d-flex justify-content-between align-items-center">
                                            <label class="form-control-label">Nouveau mot de passe: <span class="tx-danger">*</span></label>
                                            <span style="cursor: pointer" class="passview form-control-label tx-24-force"><i class="ion ion-ios-eye"></i></span>
                                        </span>
                                        <input class="form-control passfield" type="password" name="password" value="{{ old('password') }}" placeholder="Entrer le nouveau mot de passe">
                                        @error('password')
                                        <ul class="parsley-errors-list filled" id="parsley-id-26">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                        @enderror
                                        @if(session()->get( 'password' ))
                                            <ul class="parsley-errors-list filled" id="parsley-id-26">
                                                <li style="color: #23BF08 !important;" class="parsley-required">Le mot de passe a ete modifié avec succès</li>
                                            </ul>
                                        @endif
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <span class="d-flex justify-content-between align-items-center">
                                            <label class="form-control-label">Confirmation du nouveau mot de passe: <span class="tx-danger">*</span></label>
                                            <span style="cursor: pointer" class="passview form-control-label tx-24-force"><i class="ion ion-ios-eye"></i></span>
                                        </span>
                                        <input class="form-control passfield" type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirmer le nouveau mot de passe">
                                        @error('password_confirmation')
                                        <ul class="parsley-errors-list filled" id="parsley-id-26">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                        @enderror
                                        @if(session()->get( 'password' ))
                                            <ul class="parsley-errors-list filled" id="parsley-id-26">
                                                <li style="color: #23BF08 !important;" class="parsley-required">Le mot de passe a ete modifié avec succès</li>
                                            </ul>
                                        @endif
                                    </div>
                                </div><!-- col-4 -->

                            </div><!-- row -->
                            <div class="d-flex justify-content-end form-layout-footer bd pd-20 bd-t-0">
                                <div>
                                    <button class="btn btn-info">Mettre a jour</button>
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
            let views = document.querySelectorAll('.passview')
            views.forEach((view) => {
                view.addEventListener('click', function (e) {
                    e.preventDefault()
                    let icons = document.querySelectorAll('.passview i'),
                        passfields = document.querySelectorAll('.passfield')

                    icons.forEach((icon) => {
                        if(icon.classList.contains('ion-ios-eye')) {
                            icon.classList.remove('ion-ios-eye')
                            icon.classList.add('ion-eye-disabled')
                        } else {
                            icon.classList.remove('ion-eye-disabled')
                            icon.classList.add('ion-ios-eye')
                        }
                    })

                    passfields.forEach((passfield) => {
                        if (passfield.getAttribute('type') === 'password') {
                            passfield.setAttribute('type', 'text')
                        } else {
                            passfield.setAttribute('type', 'password')
                        }

                    })
                })
            })
        })()
    </script>
@endsection
