@extends('layouts.swup')
@section('content')
    <div id="app-warehouse-edit">
        <div class="br-mainpanel">
            <div class="br-pagetitle d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="icon ion-ios-filing-outline"></i>
                    <div class="ml-3">
                        <h4>Creer un nouvel entrepot</h4>
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
                                <span><strong>Succès !</strong> L'entrepot a été enregistré</span>
                            </div><!-- d-flex -->
                        </div>
                    </div>
                @endif
            </div>
            <div class="br-pagebody">
                <div class="br-section-wrapper">
                    <form action="{{ route('warehouse.store') }}" method="POST">
                        @csrf
                        <div class="form-layout form-layout-2">
                        <div class="row no-gutters">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label">Libélé de l'entrepot: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="name" value="{{ old('name') }}" placeholder="Entrer le libélé de l'entrepot">
                                    @error('name')
                                        <ul class="parsley-errors-list filled" id="parsley-id-26">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Localité de l'entrepot: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="location" value="{{ old('location') }}" placeholder="Entrer la localité de l'entrepot">
                                    @error('location')
                                        <ul class="parsley-errors-list filled" id="parsley-id-26">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Capacité de l'entrepot: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="number" name="capacity" value="{{ old('capacity') }}" placeholder="Entrer la capacité de l'entrepot">
                                    @error('capacity')
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
                                <a href="{{ route('warehouse.index') }}"><button type="button" class="btn btn-outline-success">Voir mes entrepots</button></a>
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

@endsection
