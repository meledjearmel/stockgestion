@extends('layouts.swup')
@section('child-css')
    <link rel="stylesheet" href="{{ asset('lib/dropzone/dist/min/dropzone.min.css') }}">
@endsection
@section('content')
    <div id="app-article-edit">
        <div class="br-mainpanel">
            <div class="br-pagetitle d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="icon ion-ios-person tx-50-force"></i>
                    <div class="ml-3">
                        <h4>Editer votre profil</h4>
                    </div>
                </div>
            </div>
            <div style="margin-top: 10px !important;" class="br-pagebody">
                <div class="br-section-wrapper pd-t-30-force pd-b-40-force">
                    <div class="d-flex justify-content-between align-items-center mg-b-10-force">
                        <div class="d-flex justify-content-center align-content-start flex-column">
                            <h5>{{ Auth::user()->lastname }} {{ Auth::user()->name }}</h5>
                            <h6 class="tx-16-force">{{ Auth::user()->sex }}</h6>
                            <h6 class="tx-16-force">{{ Auth::user()->email }}</h6>
                            <h6 class="tx-16-force">{{ Auth::user()->contact }}</h6>
                            @php
                                $picture = str_replace('public', 'storage', $user->picture);
                            @endphp
                        </div>
                        <img id="picture" src="{{ asset($picture) }}" class="card-profile-img d-block rounded-20" width="125px" alt="">
                    </div>
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
                                        @livewire('update-user-pic')

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
        (function () {
            let img = document.querySelector('#profil_img'),
                testImg = new Image();
            testImg.onerror = () => {
                img.src = location.origin + '/img/img11.jpg'
            }
            testImg.src = img.src
        })()
        $('#phoneMask').mask('(999) 99-999-999');
    </script>
@endsection
