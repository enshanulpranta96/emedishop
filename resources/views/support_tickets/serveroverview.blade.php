@extends('layouts.master')
@section('title')
    Server Overview
@endsection
@section('content')
{{-- <div class="d-flex justify-content-end mb-3" style="margin-right: 70px">
  <a href="{{route('request.ticket')}}" class="btn btn-primary">Create New Support ticket</a>
</div> --}}
    <h2 class="text-center">SERVER OVERVIEW</h2>
    <div class="row justify-content-center mt-3">
        <div class="col-md-12 bg-light text-center">
            <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col"><small>SERVER NAME</small></th>
                    <th scope="col"><small>IP</small></th>
                    <th scope="col"><small>Status</small></th>
                    <th scope="col"><small>NOTICE</small></th>
                    <th scope="col"><small>DETAILS</small></th>
                  </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>1</th> 
                        <td><small>BOBO S1 FULLY MANAGED SERVER</small></td>
                        <td><small>192.168.1.254</small></td>
                        <td> <i class="zmdi zmdi-circle text-success"></i> <small class="mb-2"> RUNNING</small></td>
                        <td><small>#24/7 runtime</small></td>
                        <td><a href="{{route('server.details')}}"><i class="zmdi zmdi-format-list-bulleted"></i></a></td>
                    </tr>
                    <tr>
                        <th>1</th> 
                        <td><small>BOBO S2 FULLY MANAGED SERVER</small></td>
                        <td><small>192.168.1.254</small></td>
                        <td> <i class="zmdi zmdi-circle text-success"></i> <small class="mb-2"> RUNNING</small></td>
                        <td><small>#24/7 runtime</small></td>
                        <td><a href="{{route('server.details')}}"><i class="zmdi zmdi-format-list-bulleted"></i></a></td>
                    </tr>
                    <tr>
                        <th>1</th> 
                        <td><small>BOBO S8 FULLY MANAGED SERVER</small></td>
                        <td><small>192.168.1.254</small></td>
                        <td> <i class="zmdi zmdi-circle text-success"></i> <small class="mb-2"> RUNNING</small></td>
                        <td><small>#24/7 runtime</small></td>
                        <td><a href="{{route('server.details')}}"><i class="zmdi zmdi-format-list-bulleted"></i></a></td>
                    </tr>
                </tbody>
                {{-- <tbody>
                  @foreach ($data as $item)
                  <tr>
                    <th scope="row">{{$loop->index+1}}</th>
                    <td>{{$item->department}}</td>
                    <td>{{$item->subject}}</td>
                    <td> <small class="bg-dark text-light" style="border: 1px solid black; padding: 5px; border-radius: 5px;">{{$item->status}}</small> </td>
                    <td>{{isset($item->updated_at) ? date('d/M/y', strtotime($item->updated_at)): "0-0-0"}}</td>
                    <td><a style="border: 1px solid black; border-radius: 8px; padding: 5px;  color: black" href="{{route('open.conversation', ['ticket_id'=> $item->id])}}">Open Conversation</a></td>
                  </tr>
                  @endforeach
                  
                </tbody> --}}
              </table>
          
        </div>
    </div>
@endsection