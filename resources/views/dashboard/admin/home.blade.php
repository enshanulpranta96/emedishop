@extends('dashboard.admin.layouts.app')

@section('title', 'Home | Admin')

@section('content')
<div class="container mt-5" id="mainDiv">
    <div class="row justify-content-around text-center">
        <div class="col-md-3 card p-3 mt-5 bg-danger mx-2">
            <a href="{{route('admin.users')}}" style="text-decoration: none;">
                <h4 class="text-wrap text-light">ACTIVE USERS</h4>
                <hr class="bg-light">
                <h1 id="visitors" class="text-light text-danger fw-bolder fs-1 font-monospace">{{$activeUser}}</h1>
            </a>
        </div>

        <div class="col-md-3 card p-3 mt-5 bg-primary mx-2">
            <a href="{{route('admin.vendors')}}" style="text-decoration: none;">
                <h4 class="text-wrap text-light">ACTIVE VENDORS</h4>
                <hr class="bg-light">
                <h1 id="courses" class="text-light fw-bolder fs-1 font-monospace">{{$activeVendor}}</h1>
            </a>
        </div>

        <div class="col-md-3 card p-3 mt-5 bg-success mx-2">
            <a href="{{route('admin.vendors.request')}}" style="text-decoration: none;">
                <h4 class="text-wrap text-light">VENDOR REQUESTS</h4>
                <hr class="bg-light">
                <h1 id="courses" class="text-light fw-bolder fs-1 font-monospace">{{$newvendorRequest}}</h1>
            </a>
        </div>

        <div class="col-md-3 card p-3 mt-5 bg-secondary mx-2">
            <a href="{{route('admin.categories')}}" style="text-decoration: none;">
                <h4 class="text-wrap text-light">CATEGORIES</h4>
                <hr class="bg-light">
                <h1 id="courses" class="text-light fw-bolder fs-1 font-monospace">{{$categories}}</h1>
            </a>
        </div>

        <div class="col-md-3 card p-3 mt-5 bg-dark mx-2">
            <a href="#" style="text-decoration: none;">
                <h4 class="text-wrap text-light">TOTAL PRODCUTS</h4>
                <hr class="bg-light">
                <h1 id="courses" class="text-light fw-bolder fs-1 font-monospace">{{$productCount}}</h1>
            </a>
        </div>

        <div class="col-md-3 card p-3 mt-5 bg-info mx-2">
            <a href="#" style="text-decoration: none;">
                <h4 class="text-wrap text-light">TOTAL ORDERS</h4>
                <hr class="bg-light">
                <h1 id="courses" class="text-light fw-bolder fs-1 font-monospace">0</h1>
            </a>
        </div>
    </div>
</div>
@endsection
