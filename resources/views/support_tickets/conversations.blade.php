@extends('layouts.master')
@section('title')
    Conversations
@endsection
@section('content')

<div class="d-flex justify-content-end mb-3" style="margin-right: 150px">
  {{-- <a href="{{route('request.ticket')}}" class="btn btn-primary">Create New Support ticket</a> --}}
</div>
    <div class="row justify-content-center">
        <div class="col-md-8 bg-light customCard p-0">
            <div class="mx-3 my-3">
                <h4> <small>View Ticket #{{$ticketDetails[0]->id}}</small></h4>
                <h6 class="mt-1">Subject: {{$ticketDetails[0]->subject}}</h6>
            </div>
            <hr class="m-0">
            {{-- replay --}}
            <div id="conversation">

            </div>
            {{-- <div class="d-flex justify-content-between align-items-center bg-dark px-3 py-2">
                <h5 class="text-light"><small>Posted By {{$ticketDetails[0]->name}} on {{date('d/M/y', strtotime($ticketDetails[0]->created_at))}} </small></h5>
                <p> <small class="bg-dark text-light" style="border: 1px solid rgb(252, 252, 252); padding: 5px; border-radius: 5px;">OPERATOR</small></p>
            </div>
            <hr class="m-0">
            <div class="m-3">
                <p> <small class="text-dark">{{$ticketDetails[0]->message}}</small></p>
            </div> --}}

            {{-- users default message --}}
            <div class="d-flex justify-content-between align-items-center bg-dark px-3 py-2">
                <h5 class="text-light"><small>Posted By {{$ticketDetails[0]->name}} on {{date('d/M/y', strtotime($ticketDetails[0]->created_at))}} </small></h5>
                <p> <small class="bg-success text-light" style="border: 1px solid rgb(255, 255, 255); padding: 5px; border-radius: 5px;">OWNER</small></p>
            </div>
            <hr class="m-0">
            <div class="m-3">
                <p> <small class="text-dark">{{$ticketDetails[0]->message}}</small></p>
            </div>

            <hr class="m-0">

            <div class="form-group m-3">
                <label for="msg">REPLAY</label>
                <textarea class="form-control msg" id="msg" rows="5"></textarea>
                <button type="submit" class="my-3 px-3 py-1 mx-auto bg-dark text-light" style="border: 1px solid rgb(0, 0, 0); padding: 5px; border-radius: 5px;" onclick="submit()">Submit</button>
            </div>

            <div class="d-grid gap-2 mt-4">
                
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.25.0/axios.min.js" integrity="sha512-/Q6t3CASm04EliI1QyIDAA/nDo9R8FQ/BULoUFyN4n/BDdyIxeH7u++Z+eobdmr11gG5D/6nPFyDlnisDwhpYA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        let ticket_id = `{{$ticketDetails[0]->id}}`;
        let time;

        function getConversation(){
            $('#conversation').empty();
            axios.post('/get-conversation', {
                'ticket_id': ticket_id,
            }).then(response => {
                console.log(response);
                if(response.status == 200) {
                    // let reversed = new Array(response.data.reverse());
                    response.data.slice().reverse().forEach((item, index) => {
                    let name = item.sent_by == "OWNER"? item.name : "SUPPORT TEAM";
                    let dateTime = new Date(item.updated_at);
                    let date = dateTime.toLocaleDateString();
                    let time = dateTime.toLocaleTimeString();
                    console.log(date);
                    // time = "{{ date('d/m/y H:i:s', strtotime("+item.updated_at+")) }}";
                    
                    let miniBg = item.sent_by == "OWNER"? "bg-success": "bg-dark"
                    $('#conversation').append(
                    '<div class="d-flex justify-content-between align-items-center bg-dark px-3 py-2">'+
                        '<h5 class="text-light"><small>Posted By '+ name +' on '+ date +' '+ time +' </small></h5>'+
                        '<p> <small class="'+ miniBg +' text-light" style="border: 1px solid rgb(252, 252, 252); padding: 5px; border-radius: 5px;">'+ item.sent_by +'</small></p>'+
                    '</div>'+
                    '<hr class="m-0">'+
                    '<div class="m-3">'+
                        '<p> <small class="text-dark">'+ item.message +'</small></p>'+
                    '</div>'
                );
                });
                }
            }).catch(error => {
                console.log(error);
            })
        }
        getConversation();

        function submit(){
            let message = $('textarea.msg').val();
            axios.post('/replay-message', {
                'ticket_id': ticket_id,
                'message': message,
                'sent_by': 'OWNER'
            }).then(response => {
                console.log(response);
                $('textarea.msg').val('');
                getConversation();
            }).catch(error => {
                console.log(error);
            })
        }

        


    </script>
@endsection