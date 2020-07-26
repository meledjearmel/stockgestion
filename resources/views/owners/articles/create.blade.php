@extends('layouts.swup')
@section('child-css')
@endsection
@section('content')
    <div id="app-article-edit">
        <div class="br-mainpanel">
            <div class="br-pagetitle d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="icon ion-ios-filing-outline"></i>
                    <div class="ml-3">
                        <h4>Creer un nouvel article</h4>
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
                                <span><strong>Succès !</strong> L'article a été enregistré</span>
                            </div><!-- d-flex -->
                        </div>
                    </div>
                @endif
            </div>
            <div class="br-pagebody">
                <div class="br-section-wrapper">
                    <form action="{{ route('article.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-layout form-layout-2">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Code de l'article: <span class="tx-danger">*</span></label>
                                        <input class="form-control tx-uppercase" maxlength="8" type="text" name="code" value="{{ old('code') }}" placeholder="Entrer le code de l'article">
                                        @error('code')
                                        <ul class="parsley-errors-list filled" id="parsley-id-26">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                        @enderror
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Le prix de l'article: <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="number" name="price" value="{{ old('price') }}" placeholder="Entrer le prix de l'article">
                                        @error('price')
                                        <ul class="parsley-errors-list filled" id="parsley-id-26">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                        @enderror
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
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Le libélé de l'article: <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="name" value="{{ old('name') }}" placeholder="Entrer le libélé de l'article">
                                        @error('name')
                                        <ul class="parsley-errors-list filled" id="parsley-id-26">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                        @enderror
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Description de l'article: </label>
                                        <input class="form-control" type="text" name="caracts" value="{{ old('caracts') }}" placeholder="Decriver l'article">
                                        @error('caracts')
                                        <ul class="parsley-errors-list filled" id="parsley-id-26">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                        @enderror
                                    </div>
                                </div><!-- col-4 -->
                            </div><!-- row -->
                            <div class="d-flex justify-content-between form-layout-footer bd pd-20 bd-t-0">
                                <div>
                                    <button class="btn btn-info">Creer</button>
                                    <button type="reset" class="btn btn-secondary">Effacer</button>
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
