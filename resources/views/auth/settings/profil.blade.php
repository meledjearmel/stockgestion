@extends('layouts.swup')
@section('child-css')
    <link rel="stylesheet" href="{{ asset('lib/dropzone/dist/min/dropzone.min.css') }}">
@endsection
@section('content')
    <div id="app-article-edit">
        <div class="br-mainpanel">
            <div class="br-pagetitle d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="icon ion-ios-person"></i>
                    <div class="ml-3">
                        <h4>Editer votre profil</h4>
                    </div>
                </div>
            </div>
            <div style="margin-top: 10px !important;" class="br-pagebody">
                <div class="br-section-wrapper">
                    <form action="{{ route('employe.update',  Auth::id()) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        <input type="hidden" name="profil" value="on">
                        @csrf
                        <div class="form-layout form-layout-2">
                            <div class="row no-gutters">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Prenom(s): <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="lastname" value="{{ old('lastname') ?? $user->lastname }}" placeholder="Ex: John">
                                        @error('lastname')
                                        <ul class="parsley-errors-list filled" id="parsley-id-26">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                        @enderror
                                        @if(session()->get( 'lastname' ))
                                            <ul class="parsley-errors-list filled" id="parsley-id-26">
                                                <li style="color: #23BF08 !important;" class="parsley-required">Le prenom a été modifié avec succès</li>
                                            </ul>
                                        @endif
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Nom: <span class="tx-danger">*</span></label>
                                        <input class="form-control" maxlength="8" type="text" name="name" value="{{ old('name') ?? $user->name }}" placeholder="Ex: Doe">
                                        @error('name')
                                        <ul class="parsley-errors-list filled" id="parsley-id-26">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                        @enderror
                                        @if(session()->get( 'name' ))
                                            <ul class="parsley-errors-list filled" id="parsley-id-26">
                                                <li style="color: #23BF08 !important;" class="parsley-required">Le nom a été modifié avec succès</li>
                                            </ul>
                                        @endif
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Numero de telephone: <span class="tx-danger">*</span></label>
                                        <input id="phoneMask" class="form-control" type="text" name="contact" value="{{ old('contact') ?? $user->contact }}" placeholder="(225) 87-614-613">
                                        @error('contact')
                                        <ul class="parsley-errors-list filled" id="parsley-id-26">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                        @enderror
                                        @if(session()->get( 'contact' ))
                                            <ul class="parsley-errors-list filled" id="parsley-id-26">
                                                <li style="color: #23BF08 !important;" class="parsley-required">Le telephone a été modifié avec succès</li>
                                            </ul>
                                        @endif
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Photo: </label>
                                        <input name="picture" accept=".jpg, .jpeg, .png" id="photo" type="file" id="file">
                                        @error('picture')
                                        <ul class="parsley-errors-list filled" id="parsley-id-26">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                        @enderror
                                        @if(session()->get( 'picture' ))
                                            <ul class="parsley-errors-list filled" id="parsley-id-26">
                                                <li style="color: #23BF08 !important;" class="parsley-required">La photo a été modifiée avec succès</li>
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
    <script src="{{ asset('lib/dropzone/dist/min/dropzone.min.js') }}"></script>
    <script>
        $('#phoneMask').mask('(999) 99-999-999');
    </script>
@endsection
