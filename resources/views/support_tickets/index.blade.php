@extends('layouts.master')
@section('title')
    Support Tickets
@endsection
@section('content')
<div class="d-flex justify-content-end mb-3" style="margin-right: 70px">
  <a href="{{route('request.ticket')}}" class="btn btn-primary">Create New Support ticket</a>
</div>
    <div class="row justify-content-center">
        <div class="col-md-10 bg-light">
            <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">DEPARTMENT</th>
                    <th scope="col">SUBJECT</th>
                    <th scope="col">STATUS</th>
                    <th scope="col">LAST UPDATED</th>
                    <th scope="col">CONVERSATIONS</th>
                  </tr>
                </thead>
                <tbody>
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
                  
                </tbody>
              </table>
          
        </div>
    </div>
@endsection