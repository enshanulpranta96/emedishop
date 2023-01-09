@extends('dashboard.vendor.layouts.app')

@section('title', 'Create users | Admin')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-4 mx-auto p-4 my-4 card js-tilt">
            <h4>Create New Product</h4>
            <hr>
            <form action="{{route('vendor.product.create.new')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="vendor_id" value="{{Auth::guard('vendor')->user()->id}}" hidden>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Product Name</label>
                    <input type="text" name="product_name" value="{{old('product_name')}}" class="form-control @error('product_name') is-invalid @enderror" placeholder="Enter product name">
                    @error('product_name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Price</label>
                    <input type="text" name="price" value="{{old('price')}}" class="form-control @error('price') is-invalid @enderror" placeholder="Enter price">
                    @error('price')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Stoke</label>
                    <input type="number" name="stock" value="{{old('stock')}}" class="form-control @error('stock') is-invalid @enderror" placeholder="Enter available product stock">
                    @error('stock')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Image</label>
                    <img class="py-2 w-25" id="blah" />
                    <input type="file" id="imgInp" accept="image/*" name="image" class="form-control-file" value="{{old('image')}}" class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                    <span class=" text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Product Description</label>
                    <textarea type="text" name="product_des" class="form-control @error('product_des') is-invalid @enderror" id=" exampleInputPassword1" placeholder="Enter product descriptoin"></textarea>
                    @error('product_des')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="btn btn-outline-primary">Create New Product</button>
                </div>

            </form>


        </div>

    </div>
</div>
@endsection

@section('javascript')

<script>
    imgInp.onchange = evt => {
        const [file] = imgInp.files
        if (file) {
            blah.src = URL.createObjectURL(file)
        }
    }

</script>


@endsection
