@extends('owners.warehouses.show')
@section('show-content')
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex justify-content-center align-content-start flex-column">
            <h4>{{ $warehouse->name }}</h4>
            <h6>Localité : {{ $warehouse->location }}</h6>
            <h6>Capacité initial : {{ $warehouse->capacity }} articles</h6>
            <h6>Crée {{ $warehouse->created_at->diffForHumans() }}</h6>
        </div>
        <img src="{{ asset('img/warehouse.jpg') }}" class="img-fluid d-block" width="200px" alt="">
    </div>
    <hr class="w-100">
    <div class="row">
        <div class="col-xl-6">
            <div class="">
                <h6>Stockage</h6>
            </div>
            <div class="pd-b-30">
                <div id="chartPie" data-used="{{ $used }}" data-no-used="{{ $warehouse->capacity - $used }}" class="ht-300 ht-sm-300"></div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="">
                <h6>Articles</h6>
            </div>
            <div class="pd-b-30">
                <div id="chartPieContent" data-articles="{{ json_encode($articles) }}" class="ht-300 ht-sm-300"></div>
            </div>
        </div>
    </div><!-- row -->

@endsection
