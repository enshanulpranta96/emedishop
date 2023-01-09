@extends('layouts.app')
@section('title', 'CHAT | EMEDISHOP')

@section('content')
    @include('emedishop.navbar')

    <div class="container-fluid bg-secondary mb-3">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 100px">
            <h2 class="font-weight-semi-bold text-uppercase">EMEDISHOP CHAT</h2>
            {{-- <div class="d-inline-flex">
                <p class="m-0"><a href="{{asset('/')}}">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">BEAUTY CARE</p>
            </div> --}}
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="row px-xl-5 justify-content-center">
            <div class="col-lg-7 border w-100" id="conversationsId">
                <section class="gradient-custom">
                    <div class="container py-5">
                  
                      <div class="row justify-content-center">
                        <div class="col-md-6 col-lg-8 col-xl-8 bg-transparent ">
                  
                          <ul class="list-unstyled text-white">
                            <div id="chats" style="overflow-y: scroll; max-height: 600px;">

                                <div class="chats">
                                    
                                </div>
                                {{-- <div class="leftChat">
                                    
                                </div>
                                    
                                
                               <div class="rightChat">
                               
                               </div> --}}
                            </div>
                            <li class="mb-3">
                              <div class="form-outline form-white">
                                <textarea class="form-control msg" rows="4" id="msg"></textarea>
                                <label class="form-label" for="textAreaExample3">Message</label>
                              </div>
                            </li>
                            <button type="button" class="btn btn-light btn-lg btn-rounded float-end" style="border-radius: 6px;" onclick="submit()">Send</button>
                          </ul>
                  
                        </div>
                  
                      </div>
                  
                    </div>
                  </section>
            </div>
        </div>
    </div>


@endsection

@section('javascript')
    <script>
      
    let ticket_id = `{{$ticket_id}}`;

        function getConversation(){
        
            $('.chats').empty();
            axios.post('/get-chat', {
                'ticket_id': ticket_id,
            }).then(response => {                 
                // console.log(response);
                if(response.status == 200) {
                    console.log(response);
                    // let reversed = new Array(response.data.reverse());
                    response.data.forEach((item, index) => {
                    // let name = item.sent_by == "OWNER"? item.name : "SUPPORT TEAM";
                    let dateTime = new Date(item.updated_at);
                    let date = dateTime.toLocaleDateString();
                    let time = dateTime.toLocaleTimeString();
                    console.log(date);
                    // time = "{{ date('d/m/y H:i:s', strtotime("+item.updated_at+")) }}";
                    
                    // let miniBg = item.sent_by == "OWNER"? "bg-success": "bg-dark"
                    if(item.sent_by == 'User'){
                        $('.chats').append(
                        '<li class="d-flex justify-content-between mb-4">'+
                        '<p alt="avatar" class="rounded-circle d-flex align-self-start me-3 shadow-1-strong" width="60"><i class="fas fa-user-astronaut" style="font-size: 60px; margin-right: 5px"></i></p>'+
                        '<div class="card mask-custom w-100">'+
                        '<div class="card-header d-flex justify-content-between p-3" style="border-bottom: 1px solid rgba(255,255,255,.3);">'+
                        '<p class="fw-bold mb-0">'+item.user1_name+'</p>'+
                        '<p class="text-light small mb-0"><i class="far fa-clock"></i> '+time+'</p>'+
                        '</div>'+
                        '<div class="card-body">'+
                        '<p class="mb-0">'+item.message+'</p>'+
                        '</div>'+
                        '</div>'+
                        '</li>'
                    );
                    }

                    if(item.sent_by == 'Vendor'){
                        $('.chats').append(
                        '<li class="d-flex justify-content-center mb-4">'+
                        '<div class="card mask-custom w-100">'+
                        '<div class="card-header d-flex justify-content-between p-3" style="border-bottom: 1px solid rgba(255,255,255,.3);">'+
                        '<p class="fw-bold mb-0">'+item.user2_name+'</p>'+
                        '<p class="text-light small mb-0"><i class="far fa-clock"></i> '+time+'</p>'+
                        '</div>'+
                        '<div class="card-body">'+
                        '<p class="mb-0">'+ item.message+'</p>'+
                        '</div>'+
                        '</div>'+
                        '<p alt="avatar" class="rounded-circle d-flex align-self-start me-3 shadow-1-strong" width="60"><i class="fas fa-user-astronaut" style="font-size: 60px; margin-right: 5px"></i></p>'+
                        '</li>'
                        );
                    }
                     
                });
                var chatList = document.getElementById("chats");
	            chatList.scrollTop = chatList.scrollHeight;
                }
            }).catch(error => {
                console.log(error);
            })
        }
        getConversation();
        

        function submit(){
            let message = $('textarea.msg').val();
            let user_id = {{Auth::user()->id}};
            let name = `{{Auth::user()->name}}`;
            let sent_by = 'User';
            console.log(message);
            axios.post('/replay-message', {    
                'ticket_id': parseInt(ticket_id),
                'message': message,
                'user_id': parseInt(user_id),
                'name': name,
                'sent_by': sent_by
            }).then(response => {
                console.log(response);
                $('textarea.msg').val('');
                getConversation();
            }).catch(error => {
                console.log(error);
            })
        }



    //      function sendMsg(vendor_id){
    //     let message = $('textarea#message').val();
    //     axios.post('/sendMsg', {
    //         message: message,
    //         ticket_id: 'none',
    //         sent_by: 'User',
    //         name: `{{Auth::user()->name}}`,
    //         user1_id: {{Auth::user()->id}},
    //         user1_name: `{{Auth::user()->name}}`,
    //         user2_id: vendor_id,
    //     }).then(resp => {
    //         console.log(resp);
    //         if(resp.data == 200){
    //             $('textarea#message').val('');
    //         }
    //     })
    //     // alert(message);
    // }
    </script>
@endsection