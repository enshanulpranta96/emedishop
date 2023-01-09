@extends('layouts.app')

@section('title', 'Covid 19 | Emedishop')

@section('content')

<!-- Navbar Start -->
@include('emedishop.navbar')
<!-- Navbar End -->

<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 180px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">COVID 19</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="{{asset('/')}}">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Covid 19</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Store Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        {{-- <div class="col-lg-3 col-md-12">
           
        </div> --}}
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-12 col-md-12">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">

                    </div>
                </div>


                @foreach ($products as $item)
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="card product-item border-0 mb-4">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="img-fluid" style="height:150px;width:280px;width: expression(this.width > 280 ? 280: true);" src="{{asset('images/products/'.$item->image)}}" alt="{{$item->product_name}}">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">{{$item->product_name}}</h6>
                            <div class="d-flex justify-content-center">
                                <h6>&#2547; {{$item->price}}</h6>
                                <h6 class="text-muted ml-2"><del>&#2547; 5</del></h6>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <form action="{{route('prodcut_details')}}" method="POST">
                                @csrf
                                <input type="text" name="id" value="{{$item->id}}" hidden>
                                <button type="submit" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</button>
                            </form>

                            @if (Auth::user())
                            <a href="{{route('user.addToCart', ['product_id'=> $item->id, 'price' => $item->price])}}" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                            @else
                            <a href="{{route('user.withoutauth')}}" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="col-12 pb-1">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center mb-3">
                            {{$products->links()}}

                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->

@endsection
