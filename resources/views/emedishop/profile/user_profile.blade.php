@extends('layouts.app')
@section('title', 'Profile | EMEDISHOP')

@section('content')
    @include('emedishop.navbar')

    <div class="container-fluid bg-secondary mb-3">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 100px">
            <h2 class="font-weight-semi-bold text-uppercase">USER PROFILE</h2>
            {{-- <div class="d-inline-flex">
                <p class="m-0"><a href="{{asset('/')}}">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">BEAUTY CARE</p>
            </div> --}}
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="row px-xl-5 justify-content-center">
            <div class="col-md-3 mb-3" style="margin-left: 200px">
                <p class="ml-3">Manage Profile</p>
                
                <div>
                    <button class="btn border w-50" type="button" onclick="edit_profle()"><small>Edit Profile</small></button>
                </div>
                <div>
                    <button class="btn border w-50" type="button" onclick="my_orders()"><small>My Orders</small></button>
                </div>
                <div>
                    <button class="btn border w-50" type="button" onclick="conversations()"><small>conversations</small></button>
                </div>
                {{-- <div>
                    <button class="btn border w-50" type="button"><small>Track My Order</small></button>
                </div> --}}
            </div>

            <div class="col-lg-7 border w-100" id="edit_profle">
                <h4 class="mt-2 ml-5 mt-3">Edit Profile<span id="updatedProfile" class="text-success ml-2 d-none"><small>Profile Updated</small></span></h4>
                <hr>
                <div class="row px-xl-5 mx-auto">
                    <div class="col-md-6 form-group">
                        <label>Name</label>
                        <input class="form-control" type="text" name="name" id="name" value="{{Auth::user()->name}}" placeholder="John" required>
                        <span class="text-danger" id="nameErr"></span>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>E-mail</label>
                        <input class="form-control" type="email" name="email" id="email" placeholder="Email" value="{{Auth::user()->email}}" required>
                        <span class="text-danger" id="emailErr"></span>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Number</label>
                        <input class="form-control" type="number" name="phone" id="phone"  value="{{Auth::user()->phone}}" placeholder="+88-017.." required>
                        <span class="text-danger" id="phoneErr"></span>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Change Password</label>
                        <input class="form-control" type="password" name="password" id="password" placeholder="Type new password" required>
                        <span class="text-danger" id="passwordErr"></span>
                    </div>

                    <div class="col-md-6 mb-3">
                        <button type="button" class="btn btn-outline-dark bg-dark text-light" style="border-radius: 4px;border: 2px solid rgb(255, 255, 255); background-color: transparent;" onclick="updaateProfile()">UPDATE PROFILE</button>
                    </div>
                    
                </div>
            </div>

            <div class="col-lg-7 border w-100 d-none" id="my_orders">
                <h4 class="mt-3">Recent Orders</h4>
                <hr>
                <div class="bg-light">
                    <table class="table text-center" id="tblOne">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col"><small>#</small></th>
                            <th scope="col"><small>INVOICE</small></th>
                            <th scope="col"><small>STATUS</small></th>
                            <th scope="col"><small>PAYMENT STATUS</small></th>
                            <th scope="col"><small>PRICE</small></th>
                            {{-- <th scope="col"><small>ORDER DETAILS</small></th> --}}
                          </tr>
                        </thead>
                        <tbody id="tableData">
                          
                        </tbody>
                      </table>
                </div>
            </div>

            <div class="col-lg-7 border w-100 d-none" id="conversationsId">
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
@endsection

@section('javascript')


<script>
// Swal.fire({
//   title: 'Error!',
//   text: 'Do you want to continue',
//   icon: 'error',
//   confirmButtonText: 'Cool'
// })
     

    function edit_profle(){
        $('#updatedProfile').addClass('d-none');

        $('#edit_profle').removeClass('d-none');
        $('#my_orders').addClass('d-none');
        $('#conversationsId').addClass('d-none');
    }
    function my_orders(){
        $('#updatedProfile').addClass('d-none'); 

        $('#my_orders').removeClass('d-none');
        $('#edit_profle').addClass('d-none');
        $('#conversationsId').addClass('d-none');
    }
    // function track_order(){
    //     $('#updatedProfile').addClass('d-none');
        
    //     $('#conversationsId').removeClass('d-none');
    //     $('#edit_profle').addClass('d-none');
    //     $('#my_orders').addClass('d-none');
    // }

    function conversations(){
        $('#updatedProfile').addClass('d-none');
        
        $('#conversationsId').removeClass('d-none');
        $('#edit_profle').addClass('d-none');
        $('#my_orders').addClass('d-none');
    }
    //order list
    function getOrderList() {
        axios.get('/getOrders').then(resp => {

            let count = 1;
            let data = resp.data.slice().reverse();
                let preProductId;
                $.each(data, function(i, item) {
                    // var minusaction = data[i].quantity > 1 ? "" : "disabled";
                    $('<tr>').html(
                        '<td scope="row"><small>'+ parseInt(count) +'</small></th>'+
                '<td><small>'+ data[i].invoice +'</small></td>'+
                '<td><small>'+ data[i].status +'</small></td>'+
               
                '<td><small>'+ data[i].payment_status +'</small></td>'+
                '<td><small>'+ data[i].total +'</small></td> <br>'
                // '<td><small class="badge bg-info text-light p-2" onclick="productDetails('+ `${data[i].product_details}` +')" style="cursor: pointer"> VIEW DETAILS </small></td>'
                    ).appendTo('#tableData');

                    count++;

                })



            
            // console.log(resp)
            // resp.data.slice().reverse().forEach((item, index) => {
            //     let details = item.product_details;
            //     // let data = {};
            //     // details.forEach((item, index) => {
            //     //     data.data = item;
            //     // })
            //     console.log(details)
            //     $('#tableData').append(
            //     '<tr>'+
            //     '<th scope="row"><small>'+ parseInt(index+1) +'</small></th>'+
            //     '<td><small>'+ item.invoice +'</small></td>'+
            //     '<td><small>'+ item.status +'</small></td>'+
               
            //     '<td><small>'+ item.payment_status +'</small></td>'+
            //     '<td><small>'+ item.total +'</small></td> <br>'+
            //     '<td><small class="badge bg-info text-light p-2" onclick="productDetails('+ `${details}` +')" style="cursor: pointer"> VIEW DETAILS </small></td>'+
            //     '</tr>'
            // )
            // })
            
        }).catch(err => console.log(err));
    }
    getOrderList();

    function updaateProfile() {
        let name = $('#name').val();
        let email = $('#email').val();
        let phone = $('#phone').val();
        let password = $('#password').val();
        axios.post('/update-profile', {
        'name': name,
        'email': email,
        'phone': phone,
        'password': password
    }).then(resp => {
        console.log(resp);
        $('#updatedProfile').removeClass('d-none');
    }).catch(err => {
        console.log(err);
    })
    }

    function productDetails(details){
        console.log(details);
    }

//     //get members
//     axios.post('/getMembers',{
//         user_id: {{Auth::user()->id}}
//     }).then(resp => {
//         console.log(resp);
//     }).catch(err => {
//         console.log(err);
//     });

//     //chat
//     function openConv(user2_id){
//     axios.post('/getChat',{
//         user1_id: {{Auth::user()->id}},
//         user2_id: user2_id,
//     }).then(resp => {
//         console.log(resp);
//     }).catch(err => {
//         console.log(err);
//     });
// }


    function sendMsg(){
        let message = $('textarea#message').val();
        axios.post('/sendMsg', {
            message: message,
            ticket_id: 'none',
            sent_by: 'User',
            name: `{{Auth::user()->name}}`,
            user1_id: {{Auth::user()->id}},
            user1_name: `{{Auth::user()->name}}`,
            user2_id: 2,
        }).then(resp => {
            console.log(resp);
            if(resp.data == 200){
                $('textarea#message').val('');
            }
        })
        // alert(message);
    }
    
</script>

@endsection