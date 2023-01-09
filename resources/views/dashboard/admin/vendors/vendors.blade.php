@extends('dashboard.admin.layouts.app')

@section('title', 'Manage Vendors | Admin')

@section('content')

<div>
    <div class="container" id="mainDiv">
        <div class="row justify-content-center">
            <div class="col-md-10 my-5 card p-4">
                <h4>Manage Vendors</h4>
                <div>
                    {{-- <a href="" class="btn btn-primary">Add New Vendor</a> --}}
                    <a href="{{route('admin.vendors.request')}}" class="btn btn-danger">New Vendors Request</a>
                </div>
                <hr>
                <div class="table-responsive">
                    <table id="example" class="table table-striped tbl" id="tbl" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Shopname</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Action</th>
                                {{-- <th>Edit</th> --}}
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $item)
                            @if ($item->acc_status == 'active' || $item->acc_status == 'deactivated')
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{$item->shopname}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->acc_status}}</td>
                                <td><a href="{{route('admin.vendors.action', ['id' => $item->id, 'acc_status' => $item->acc_status == 'deactivated'? 'active': 'deactivated'])}}" class='btn btn-warning'>{{$item->acc_status == 'deactivated'? 'Active this user': 'Deactivate this user'}}</a></td>

                                {{-- <td><a href="{{route('vendor.product.editproduct', ['id' => $item->id])}}" class='btn btn-outline-primary'>Edit</a></td> --}}

                                <td><a href="{{route('vendor.product.delete', ['id' => $item->id])}}" class="btn btn-danger">Delete</a></td>
                            </tr>
                            @endif
                            @endforeach

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@section('javascript')

@endsection

@endsection
