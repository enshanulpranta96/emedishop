@extends('dashboard.vendor.layouts.app')

@section('title', 'Orders | Vendor')

@section('content')

<div>
    <div class="container" id="mainDiv">
        <div class="row justify-content-center mt-5">
                <div class="col-lg-7 border w-100 mt-5 bg-transparent" id="conversationsId">
                    <h4><small>All Conversations</small></h4>
                    <hr>
                    <div class="col-md-10 bg-light">
                        <table class="table">
                            <thead class="thead-dark">
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col"><small>NAME</small></th>
                                <th scope="col"><small>STATUS</small></th>
                                <th scope="col"><small>LAST UPDATED</small></th>
                                <th scope="col"><small>VIEW CHAT</small></th>
                              </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">0</th>
                                    <td>Admin</td>
                                    <td>open</td>
                                    <td><small class="bg-dark text-light" style="border: 1px solid black; padding: 5px; border-radius: 5px;">{{isset($item->updated_at) ? date('d/M/y', strtotime($item->updated_at)): "0-0-0"}}</small></td>
                                    <td><a style="border: 1px solid black; border-radius: 8px; padding: 5px;  color: black" href="{{route('vendor.chat', ['user2' => 'Admin','user2_id'=> 2])}}">Open Conversation</a></td>
                                  </tr>
                              @foreach ($tickets as $item)
                              <tr>
                                <th scope="row">{{$loop->index+1}}</th>
                                <td>{{$item->user2_name}}</td>
                                <td>{{$item->status}}</td>
                                <td><small class="bg-dark text-light" style="border: 1px solid black; padding: 5px; border-radius: 5px;">{{isset($item->updated_at) ? date('d/M/y', strtotime($item->updated_at)): "0-0-0"}}</small></td>
                                <td><a style="border: 1px solid black; border-radius: 8px; padding: 5px;  color: black" href="{{route('chatWithVendor', ['ticket_id'=> $item->id])}}">Open Conversation</a></td>
                              </tr>
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

@endsection

@section('javascript')
    <script>
  

    </script>
@endsection


