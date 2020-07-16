@extends('owners.sellpoints.show')
@section('show-content')
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex justify-content-center align-content-start flex-column">
            <h4>{{ $sellpoint->name }}</h4>
            <h6>Localité : {{ $sellpoint->location }}</h6>
            <h6>Crée {{ $sellpoint->created_at->diffForHumans() }}</h6>
        </div>
        <img src="{{ asset('img/undraw_business_shop_qw5t.svg') }}" class="img-fluid d-block" width="200px" alt="">
    </div>
    <hr class="w-100">

@endsection
