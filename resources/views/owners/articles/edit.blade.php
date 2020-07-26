@extends('layouts.swup')
@section('child-css')
    <link rel="stylesheet" href="{{ asset('lib/dropzone/dist/min/dropzone.min.css') }}">
@endsection
@section('content')
    <div id="app-article-edit">
        <div class="br-mainpanel">
            <div class="br-pagetitle d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="icon ion-ios-filing-outline"></i>
                    <div class="ml-3">
                        <h4>Mise a jour de l'article {{ $article->name }}</h4>
                    </div>
                </div>
            </div>
            <div class="br-pagebody">
                <div class="br-section-wrapper">
                    <form action="{{ route('article.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-layout form-layout-2">
                            <div class="row no-gutters">
                                <div class="col-md-4 bg-gray-200">
                                    <div class="form-group">
                                        <label class="form-control-label">Code de l'article: <span class="tx-danger">*</span></label>
                                        <input class="form-control tx-uppercase" style="cursor: not-allowed" maxlength="8" type="text" name="code" value="{{ $article->code  }}" readonly>
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Le prix de l'article: <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="number" name="price" value="{{ $article->price ?? old('price') }}" placeholder="Entrer le prix de l'article">
                                        @error('price')
                                        <ul class="parsley-errors-list filled" id="parsley-id-26">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                        @enderror
                                        @if(session()->get( 'price' ))
                                            <ul class="parsley-errors-list filled" id="parsley-id-26">
                                                <li style="color: #23BF08 !important;" class="parsley-required">Le prix a été modifié avec succès</li>
                                            </ul>
                                        @endif
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-md-4 ">
                                    <div class="form-group">
                                        <label class="form-control-label">L'image de l'article: </label>
                                        <input type="file" name="img_url" id="file-2" accept=".jpg, .jpeg, .png, .svg" class="inputfile">
                                        <label for="file-2" class="if-outline if-outline-info">
                                            <i class="icon ion-ios-upload-outline tx-24"></i>
                                            <span>Choisissez l'image de l'article...</span>
                                        </label>
                                        @error('img_url')
                                        <ul class="parsley-errors-list filled" id="parsley-id-26">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                        @enderror
                                        @if(session()->get( 'img' ))
                                            <ul class="parsley-errors-list filled" id="parsley-id-26">
                                                <li style="color: #23BF08 !important;" class="parsley-required">L'image a été modifié avec succès</li>
                                            </ul>
                                        @endif
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Le libélé de l'article: <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="name" value="{{ $article->name ?? old('name') }}" placeholder="Entrer le libélé de l'article">
                                        @error('name')
                                        <ul class="parsley-errors-list filled" id="parsley-id-26">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                        @enderror
                                        @if(session()->get( 'name' ))
                                            <ul class="parsley-errors-list filled" id="parsley-id-26">
                                                <li style="color: #23BF08 !important;" class="parsley-required">Le libélé a été modifié avec succès</li>
                                            </ul>
                                        @endif
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Description de l'article: </label>
                                        <input class="form-control" type="text" name="caracts" value="{{ $article->caracts ?? old('caracts') }}" placeholder="Decriver l'article">
                                        @error('caracts')
                                        <ul class="parsley-errors-list filled" id="parsley-id-26">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                        @enderror
                                        @if(session()->get( 'caracts' ))
                                            <ul class="parsley-errors-list filled" id="parsley-id-26">
                                                <li style="color: #23BF08 !important;" class="parsley-required">La description a été modifiée avec succès</li>
                                            </ul>
                                        @endif
                                    </div>
                                </div><!-- col-4 -->
                            </div><!-- row -->
                            <div class="d-flex justify-content-between form-layout-footer bd pd-20 bd-t-0">
                                <div>
                                    <button class="btn btn-info">Mettre a jour</button>
                                </div>
                                <div>
                                    <a href="{{ route('article.index') }}"><button type="button" class="btn btn-outline-success">Voir mes articles</button></a>
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
    </script>
@endsection
