<!-- Products Start -->
{{-- store --}}
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">LATEST MEDICINE</span></h2>
    </div>

    <div class="row px-xl-5 pb-3">
        @foreach ($products as $item)
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="card product-item border-0 mb-4">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    <img class="img-fluid" style="height:280px;max-width:280px;width: expression(this.width > 280 ? 280: true);" src="{{asset('images/products/'.$item->image)}}" alt="{{$item->product_name}}">
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
                {{-- <div class="card-footer d-flex justify-content-between bg-light border">
                <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                @if (Auth::user())
                <button onclick="addToCart({{$item->id.','. $item->price}})" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</button>
                @else
                <a href="{{route('user.withoutauth')}}" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                @endif

            </div> --}}
        </div>
    </div>


    @endforeach


</div>
</div>


