@extends('layouts.app')

@section('title', 'Prodcut Details | Emedishop')

@section('content')

<!-- Navbar Start -->
@include('emedishop.navbar')
<!-- Navbar End -->

<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 180px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Product Details</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="{{asset('/')}}">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Product Details</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Shop Detail Start -->
<div class="container-fluid py-5">
    <div class="row px-xl-5 justify-content-center">
        <div class="col-lg-5 pb-5">
            <img class="w-100 h-100" src="{{asset('images/products/'.$product->image)}}" alt="Image">
        </div>

        <div class="col-lg-5 pb-5">
            <h3 class="font-weight-semi-bold">{{$product->product_name}}</h3>
            <h6 class="font-weight-semi-bold">BY: {{$product->brand_name}}</h3>
                <h6 class="font-weight-semi-bold">PIECES: {{$product->pieces}}</h3>
                    <h3 class="font-weight-semi-bold mb-4">MRP: &#2547; {{$product->price}}</h3>
                    <h6>PRODUCT DETAILS: </h6>
                    <p class="mb-4">{{$product->product_des}}</p>

                    <form action="{{route('addToCart')}}" method="POST">
                        @csrf
                        <div class="d-flex align-items-center mb-4 pt-2">
                            <div class="input-group quantity mr-3" style="width: 130px;">
                                <div class="input-group-btn">
                                    <span onclick="minusbtn()" class="btn btn-primary btn-minus">
                                        <i class="fa fa-minus"></i>
                                    </span>
                                </div>
                                <input type="text" name="product_id" value="{{$product->id}}" hidden>
                                <input type="text" name="price" value="{{$product->price}}" hidden>
                                <input type="text" name="quantity" id="quantity" class="form-control bg-secondary text-center" value="1">
                                <div class="input-group-btn">
                                    <span onclick="plusbtn()" class="btn btn-primary btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </span>
                                </div>
                            </div>

                            @if (Auth::user())
                            <button type="submit" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
                            @else
                            <a href="{{route('user.withoutauth')}}" class="btn btn-primary px-3"><i class="fas fa-shopping-cart mr-1"></i>Add To Cart</a>
                            @endif

                        </div>
                    </form>
                    {{-- <form action="{{route('chatWithVendor')}}" method="post">
                        @csrf
                        <input type="text" name="vendor_id" value="{{$product->vendor_id}}" hidden="true">
                        <button type="submit" name="submit" class="btn btn-primary">SEND MESSAGE TO VENDOR</button>
                    </form> --}}
                    <a style="border: 1px solid black; border-radius: 8px; padding: 5px;  color: black" href="{{route('vendor.chat', ['user2' => 'Vendor','user2_id'=> $product->vendor_id])}}">SEND MESSAGE TO VENDOR</a>
                    
        </div>
    </div>
</div>
<!-- Shop Detail End -->


<!-- Products Start -->
<div class="container-fluid py-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">You May Also Like</span></h2>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel related-carousel">
                @foreach ($mayalsolike as $item)
                <div class="card product-item border-0">
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
                        {{-- <a href="{{route('prodcut_details')}}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a> --}}
                        @if (Auth::user())
                        <a href="{{route('user.addToCart', ['product_id'=> $item->id, 'price' => $item->price])}}" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                        @else
                        <a href="{{route('user.withoutauth')}}" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Products End -->

@endsection

@section('javascript')
<script>
    function plusbtn() {
        var val = $('#quantity').val();
        $('#quantity').val(parseInt(val) + 1);

    }

    function minusbtn() {
        var val = $('#quantity').val();
        if (val > 1) {
            $('#quantity').val(parseInt(val) - 1);
        }

    }

</script>
@endsection
