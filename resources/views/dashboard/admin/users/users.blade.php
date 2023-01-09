@extends('dashboard.admin.layouts.app')

@section('title', 'Users | Admin')

@section('content')

<div>
    <div class="container" id="mainDiv">
        <div class="row justify-content-center">
            <div class="col-md-10 my-5 card p-4">
                <h4>Manage Users</h4>
                {{-- <div>
                    <a href="" class="btn btn-primary">Add new user</a>
                    <a href="{{route('admin.users.request')}}" class="btn btn-danger"> <span id="count"></span> New Users Request</a>
            </div> --}}
            <hr>
            <div class="table-responsive">
                <table id="example" class="table table-striped tbl" id="tbl" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                            {{-- <th>Edit</th> --}}
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $item)
                        {{-- @if ($item->acc_status == 'active' || $item->acc_status == 'deactivated') --}}
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->acc_status}}</td>
                            <td><a href="{{route('admin.users.action', ['id' => $item->id, 'acc_status' => $item->acc_status == 'deactivated'? 'active': 'deactivated'])}}" class='btn btn-warning'>{{$item->acc_status == 'deactivated'? 'Active this user': 'Deactivate this user'}}</a></td>

                            {{-- <td><a href="{{route('vendor.product.editproduct', ['id' => $item->id])}}" class='btn btn-outline-primary'>Edit</a></td> --}}

                            <td><a href="{{route('vendor.product.delete', ['id' => $item->id])}}" class="btn btn-danger">Delete</a></td>
                        </tr>
                        {{-- @endif --}}
                        @endforeach

                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
</div>

{{-- <div class="container" id="loadingDiv">
    <div class="row justify-content-center" style="min-height: 460px">
        <div class="col-md-4 my-5 p-4 mx-auto d-flex align-items-center" style="width: 200px;">
            <button class="customCard p-3 text-danger" type="button" disabled>
                <span class="spinner-grow spinner-grow-sm text-danger" role="status" aria-hidden="true"></span>
                Loading...
            </button>
        </div>
    </div>
</div>

<div class="container d-none" id="wrongDiv">
    <div class="row justify-content-center" style="min-height: 460px">
        <div class="col-md-4 my-5 p-4 mx-auto d-flex align-items-center" style="width: 300px;">
            <button class="customCard p-3 text-danger" type="button" disabled>
                <span class="spinner-grow spinner-grow-sm text-danger" role="status" aria-hidden="true"></span>
                Somthing went wrong...
            </button>
        </div>
    </div>
</div> --}}
@section('javascript')

@endsection

@endsection
