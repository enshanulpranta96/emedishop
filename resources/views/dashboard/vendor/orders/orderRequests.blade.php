@extends('dashboard.vendor.layouts.app')

@section('title', 'Orders | Vendor')

@section('content')

<div>
    <div class="container" id="mainDiv">
        <div class="row justify-content-center">
            <div class="col-md-12 my-5 card p-4">
                <h4>Request Users</h4>
                <div>
                    <a href="{{route('vendor.manage.orders')}}" class="btn btn-primary">Back</a>
                </div>
                
            <hr>
            <div class="table-responsive text-center" id="table">
                <table id="example" class="table table-striped tbl" id="tbl" style="width:100%">
                    <thead>
                        <tr>
                            <th><small>#</small></th>
                            <th><small>Invoice</small></th>
                            <th><small>Price</small></th>
                            <th><small>Payment</small></th>
                            <th><small>Prescription</small></th>
                            <th><small>Order Details</small></th>
                            <th><small>Status</small></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($filteredOrder as $item)
                        {{-- {{$item->product_details[2]}}
                        @if ($item->product_details[3] == Auth::guard('vendor')->user()->id)
                            {{$item->product_details[2]}}
                        @endif --}}
                        @if ($item->status == 'PENDING')
                    

                        @foreach (json_decode($item->product_details) as $otherItems)
                        @php
                          $vendor_id = $otherItems->vendor_id;
                          $payment_status = strval($item->payment_status);

      $data = [
        'vendor_id' => $vendor_id,
        'user_id' => $item->user_id,
        'quantity' => $otherItems->quantity,
        'product_id' => $otherItems->product_id,
        'address_id' => $item->address_id,
        'order_id' => $item->id,
        'invoice' => $item->invoice,
        'payment_status' => $payment_status,
        'orderDate' => $item->created_at->format('d/m/Y'),

      ];
                        @endphp
                        @if ($vendor_id == Auth::guard('vendor')->user()->id)
                        <tr>
                            <td><small>{{ $loop->index+1 }}</small></td>
                            <td><small>{{$item->invoice}}</small></td>
                            
            
                            
                            <td><small>{{$item->total}}</small></td>
                            <td><small class="badge bg-primary text-light">PAID</small></td>
                            
                            <td style="cursor: zoom-in">
                                <img style="width: 80px" src="{{URL('images/prescription/'.$item->prescription)}}" id="prescription{{$item->id}}" onclick="img_increase('prescription{{$item->id}}')" onmouseout="img_decrease('prescription{{$item->id}}')" alt="prescription">
                            </td>
                          
                            <th><small class="badge bg-info text-light p-2" style="cursor: pointer" onclick="details({{ json_encode($data,TRUE)}})"> <b>VIEW DETAILS</b> </small></th>
                            {{-- <th><small class="badge bg-info text-light p-2" style="cursor: pointer" onclick="details({{$vendor_id}}, {{$item->user_id}}, {{$otherItems->quantity}}, {{$otherItems->product_id}}, {{$item->address_id}}, {{$item->invoice}}, {{$item->id}}, {{$payment_status}}, {{$item->created_at->format('d/m/Y')}})"> <b>VIEW DETAILS</b> </small></th> --}}
                            
                            {{-- <td>{{$item->status}}</td> --}}
                            <td style="width: 150px; font-size: 14px;">
                                <form action="{{route('vendor.order.status')}}" method="post">
                                    @csrf
                                    <input class="d-none" type="text" name="id" value="{{$item->id}}" >
                                    <select class="form-select form-control bg-dark text-light statusChange" name="status" id="statusChange" aria-label="Default select example" style="width: 165px; font-size: 12px">
                                        <option selected value="{{$item->status}}">{{$item->status}}</option>
                                        <option value="ORDER CONFIRMED"><small>CONFIRM ORDER</small></option>
                                      </select>
                                </form>
                        </td>
                            {{-- <td><a href="{{route('admin.users.action', ['id' => $item->id, 'acc_status' => $item->acc_status == 'deactivated'? 'active': 'deactivated'])}}" class='btn btn-warning'>{{$item->acc_status == 'deactivated'? 'Active this user': 'Deactivate this user'}}</a></td> --}}
                        </tr>
                        @endif
                           
                        @endforeach
               
                        {{-- @php
                            $img = explode("|", $item->image);
                        @endphp --}}
                       
                        @endif
                        @endforeach

                    </tbody>

                </table>
            </div>

            <div class="d-none" id="details">
                <div class="card">
                    <div class="card-body">
                      <div class="container mb-5 mt-3">
                        <div class="row d-flex align-items-baseline">
                          <div class="col-xl-9">
                            <p style="color: #7e8d9f;font-size: 20px;">Invoice >> <strong><span id="invoice"></span></strong></p>
                          </div>
                          <div class="col-xl-3 float-end">
                            <a class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark"><i
                                class="fas fa-print text-primary"></i> Print</a>
                            <button class="btn btn-light text-capitalize text-danger" data-mdb-ripple-color="dark" id="closeDetails" onclick="closeDetails()"><i class="fa fa-times-circle" aria-hidden="true"></i> Close</button>
                          </div>
                          <hr>
                        </div>
                  
                        <div class="container">
                          <div class="col-md-12">
                            <div class="text-center">
                              <h4 class="fa-2x ms-0" style="color:#5d9fc5 ;"><b>E M E D I S H O P</b></h4>
                              <p class="pt-0">EMEDISHOP.COM</p>
                            </div>
                  
                          </div>
                  
                  
                          <div class="row">
                            <div class="col-xl-8">
                              <ul class="list-unstyled">
                                <li class="text-muted">To: <span style="color:#5d9fc5 ;" id="username"></span></li>
                                <li class="text-muted"><i class="fa fa-location-arrow" aria-hidden="true"></i> <span id="address"></span></li>
                                <li class="text-muted"><span id="city"></span>, <span id="state"></span></li>
                                <li class="text-muted"></li>
                                <li class="text-muted">Zip Code: <span id="zip_code"></span></li>
                                <li class="text-muted"><i class="fa fa-envelope" aria-hidden="true"></i> <span id="email"></span></li>
                                <li class="text-muted"><i class="fas fa-phone"></i> <span id="mobile"></span></li>
                              </ul>
                            </div>
                            <div class="col-xl-4">
                              <p class="text-muted">Invoice</p>
                              <ul class="list-unstyled">
                                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                    class="fw-bold">ID:</span><span id="order_id"></span></li>
                                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                    class="fw-bold">Creation Date: </span><span id="orderDate"></span></li>
                                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                    class="me-1 fw-bold">Status:</span><span class="badge bg-warning text-dak fw-bold" id="payment_status" >
                                    Unpaid</span></li>
                              </ul>
                            </div>
                          </div>
                  
                          <div class="row my-2 mx-1 justify-content-center">
                            <table class="table table-striped table-borderless">
                              <thead style="background-color:#84B0CA ;" class="text-white">
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Product</th>
                                  <th scope="col">Qty</th>
                                  <th scope="col">Unit Price</th>
                                  <th scope="col">Amount</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <th scope="row">1</th>
                                  <td id="prodcut_name"></td>
                                  <td id="quantity"></td>
                                  <td id="unit_price"></td>
                                  <td id="amount"></td>
                                </tr>
                              </tbody>
                  
                            </table>
                          </div>
                          <div class="row">
                            <div class="col-xl-8">
                              {{-- <p class="ms-3">Add additional notes and payment information</p> --}}
                  
                            </div>
                            <div class="col-xl-3">
                              <ul class="list-unstyled">
                                <li class="text-muted ms-3"><span class="text-dak me-4">SubTotal</span><span id="subtotal" style="margin-left: 20px"></span> BDT</li>
                                <li class="text-muted ms-3 mt-2"><span class="text-dak me-4">Delivery</span><span id="delivery_charge" style="margin-left: 18px"></span> BDT</li>
                              </ul>
                              <p class="text-dak float-start"><span class="text-dak me-3"> Total Amount</span><span
                                  style="font-size: 25px; margin-left: 20px" id="total" ></span> BDT</p>
                            </div>
                          </div>
                          <hr>
                          <div class="row">
                            <div class="col-xl-10">
                              <p>Thank you for your purchase</p>
                            </div>
                            <div class="col-xl-2">
                              <button type="button" class="btn btn-primary text-capitalize"
                                style="background-color:#60bdf3 ;">STAY WITH US</button>
                            </div>
                          </div>
                  
                        </div>
                      </div>
                    </div>
                  </div>
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
    //     function statusChange(){
        
    // }

    $('.statusChange').on('change', function(e){
        $(this).closest('form').submit();
    });


    function details(data){

      // vendor_id, user_id, quantity, product_id, address_id, invoice, order_id, payment_status, orderDate
        console.log(data);
        var content = $('#content').html();
        // var txt = "custoom text";
        axios.post('/getOrderDetails', {
          product_id: data.product_id,
          address_id: data.address_id,
        }).then(resp => {
          console.log(resp.data);
          let address = resp.data.address;
          let product = resp.data.product;
          $('#invoice').html(data.invoice);
          $('#username').html(address.name);
          $('#address').html(address.address);
          $('#city').html(address.city);
          $('#state').html(address.state);
          $('#zip_code').html(address.zip_code);
          $('#email').html(address.email);
          $('#mobile').html(address.mobile);
          $('#order_id').html(data.order_id);
          $('#orderDate').html(data.orderDate);
          $('#payment_status').html(data.payment_status.toUpperCase());
          $('#prodcut_name').html(product.product_name);
          $('#quantity').html(parseInt(data.quantity));
          $('#unit_price').html(parseInt(product.price));
          $('#amount').html(parseInt(data.quantity)*parseInt(product.price));
          $('#subtotal').html(parseInt(data.quantity)*parseInt(product.price));
          $('#delivery_charge').html(parseInt(90));
          $('#total').html(parseInt(data.quantity)*parseInt(product.price)+parseInt(90));
          
        }).catch(err => {
          console.log(err);
        })
        $('#details').removeClass('d-none');
        $('#table').addClass('d-none');
    }

    function closeDetails(){
        $('#table').removeClass('d-none');
        $('#details').addClass('d-none');
    }

    // prescription
    $('.statusChange').on('change', function(e){
        $(this).closest('form').submit();
    });

      //iamge
      function img_increase(id) {
            document.getElementById(id).style.width = "600px";
            document.getElementById(id).style.height = "600px";
        }

        function img_decrease(id) {
            document.getElementById(id).style.width = "80px";
            document.getElementById(id).style.height = "54px";
        }


    </script>
@endsection


