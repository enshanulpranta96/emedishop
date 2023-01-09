@extends('dashboard.vendor.layouts.app')

@section('title', 'Home | Vendor')

@section('content')
<div class="container mt-5" id="mainDiv">
    <div class="row justify-content-around text-center">
        <div class="col-md-4 card p-3 mt-5 bg-danger mx-2">
            <a href="{{route('vendor.products')}}" style="text-decoration: none;">
                <h2 class="text-wrap text-light">TOTAL PRODUCTS</h3>
                    <hr class="bg-light">
                    <h1 id="visitors" class="text-light text-danger fw-bolder fs-1 font-monospace">{{$productCount}}</h1>
            </a>
        </div>

        <div class="col-md-4 card p-3 mt-5 bg-primary mx-2">
            <a href="#" style="text-decoration: none;">
                <h2 class="text-wrap text-light">TOTAL ORDERS</h2>
                <hr class="bg-light">
                <h1 id="courses" class="text-light fw-bolder fs-1 font-monospace">0</h1>
            </a>
        </div>
    </div>
</div>
@endsection
