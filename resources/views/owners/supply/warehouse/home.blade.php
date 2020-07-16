@extends('layouts.swup')
@section('content')
    <div id="app-warehouse-show">
        <div class="br-mainpanel">
            <div class="br-pagetitle d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="icon ion-ios-filing-outline"></i>
                    <div class="ml-3">
                        <h4>Alimentation des entrepots</h4>
                    </div>
                </div>
            </div>

            <div class="br-pagebody pd-t-15-force pd-b-15-force">
                <div class="br-section-wrapper">
                    <select class="form-control select2" data-placeholder="Choose Browser">
                        <option value="Firefox">Firefox</option>
                        <option value="Chrome">Chrome</option>
                        <option value="Safari">Safari</option>
                        <option value="Opera">Opera</option>
                        <option value="Internet Explorer">Internet Explorer</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
@endsection
