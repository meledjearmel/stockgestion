@extends('layouts.swup')
@section('content')
    <div id="app-warehouse-edit">
        <div class="br-mainpanel">
            <div class="br-pagetitle d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="icon ion-ios-filing-outline"></i>
                    <div class="ml-3">
                        <h4>Edition de {{ $sellpoint->name }}</h4>
                    </div>
                </div>
            </div>
            <div class="br-pagebody">
                <div class="br-section-wrapper">
                    <form action="{{ route('sellpoint.update', $sellpoint->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="form-layout form-layout-2">
                            <div class="row no-gutters">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Libélé du point de vente: <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="name" value="{{ old('name')??$sellpoint->name }}" placeholder="Entrer le libélé du point de vente">
                                        @error('name')
                                        <ul class="parsley-errors-list filled" id="parsley-id-26">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                        @enderror
                                        @if(session()->get( 'nameChange' ))
                                            <ul class="parsley-errors-list filled" id="parsley-id-26">
                                                <li style="color: #23BF08 !important;" class="parsley-required">Le libélé a été modifié avec succès</li>
                                            </ul>
                                        @endif
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Localité du point de vente: <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="location" value="{{ old('location')??$sellpoint->location }}" placeholder="Entrer la localité du point de vente">
                                        @error('location')
                                        <ul class="parsley-errors-list filled" id="parsley-id-26">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                        @enderror
                                        @if(session()->get( 'localChange' ))
                                            <ul class="parsley-errors-list filled" id="parsley-id-26">
                                                <li style="color: #23BF08 !important;" class="parsley-required">La localité a été modifiée avec succès</li>
                                            </ul>
                                        @endif
                                    </div>
                                </div><!-- col-4 -->

                            </div><!-- row -->
                            <div class="d-flex justify-content-between form-layout-footer bd pd-20 bd-t-0">
                                <div>
                                    <button class="btn btn-info">Mettre à jour</button>
                                </div>
                                <div>
                                    @if(route('sellpoint.setting.index', $sellpoint->id) === redirect()->back()->getTargetUrl() | session()->exists('url'))
                                        @php
                                            if (!session()->exists('url')) {
                                                request()->session()->put('url', redirect()->back()->getTargetUrl());
                                            }
                                        @endphp
                                        <a href="{{ session()->get('url') }}"><button type="button" class="btn btn-outline-primary">Retour</button></a>
                                    @else
                                        <a href="{{ route('sellpoint.index') }}"><button type="button" class="btn btn-outline-success">Voir mes points de ventes</button></a>
                                    @endif
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


