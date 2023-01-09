@extends('dashboard.vendor.layouts.app')

@section('title', 'Products | Vendor')

@section('content')

<div>
    <div class="container" id="mainDiv">
        <div class="row justify-content-center">
            <div class="col-md-10 my-5 card p-4">
                <h4>Manage Products</h4>
                @if (Session::get('success'))
                {{-- <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <strong>{{Session::get('success')}}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div> --}}
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{Session::get('success')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div>
                <a href="{{route('vendor.product.create')}}" class="btn btn-danger">Add new products</a>
            </div>
            <hr>
            <div class="table-responsive text-center">
                <table id="example" class="table table-striped tbl" id="tbl" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->index }}</td>
                            <td>{{$item->product_name}}</td>
                            <td><img src="{{asset("images/products/".$item->image)}}" style="max-width: 75px" alt=""></td>
                            <td>{{$item->price}}</td>
                            <td>{{$item->stock}}</td>
                            <td>
                                <form action="{{route('vendor.product.editproduct')}}" method="POST">
                                    @csrf
                                    <input type="text" name="id" value="{{$item->id}}" hidden>
                                    <button type="submit" class='btn btn-primary'>Edit</button>
                                </form>
                            </td>
                            {{-- <td><a href="{{route('vendor.product.editproduct', ['id' => $item->id])}}" class='btn btn-primary'>Edit</a></td> --}}

                            <td><a href="{{route('vendor.product.delete', ['id' => $item->id])}}" class="btn btn-danger">Delete</a></td>
                        </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
</div>

@endsection

@section('javascript')


<script>
    // getServices();

</script>

@endsection
