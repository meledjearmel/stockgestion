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
                   @livewire('create-employe')
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

            // Firefox bug fix
            $input
                .on( 'focus', function(){ $input.addClass( 'has-focus' ); })
                .on( 'blur', function(){ $input.removeClass( 'has-focus' ); });
        })()

        $('#phoneMask').mask('(225) 99-999-999');
    </script>
@endsection
