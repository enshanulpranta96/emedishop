@extends('layouts.app')
@section('title', 'Chekcout | UAESHOP')

@section('content')
    @php
        function generateInvoice()
        {
            return (rand(1000, 100000000));
        };
    @endphp
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 180px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">CHECKOUT</h1>
            <div class="d-inline-flex my-4">
                <p class="m-0" style="color: #4BB8A9; font-size: 18px;"><sup style="border: 1px solid #4BB8A9; padding: 3px; border-radius: 3px;">1</sup> LOGIN</p>
                <div class="m-0 px-2" style="color: #4BB8A9; font-size: 80px; line-height: 0.1">&#8702;</div>
                <p class="m-0" style="color: #4BB8A9; font-size: 18px;"><sup style="border: 1px solid #4BB8A9;; padding: 3px; border-radius: 3px;">2</sup> CART</p>
                <p class="m-0 px-2" style="color: #4BB8A9; font-size: 80px; line-height: 0.1">&#8702;</p>
                <p class="m-0" style="color: #4BB8A9; font-size: 18px;"><sup style="border: 1px solid #4BB8A9; border-radius: 3px; padding: 3px;">3</sup> CHECKOUT</p>
                <p class="m-0 px-2" style="color: rgb(51, 51, 51); font-size: 80px; line-height: 0.1">&#8692;</p>
                <p class="m-0" style="color: rgb(51, 51, 51); font-size: 18px;"><sup style="border: 1px solid rgb(51, 51, 51); border-radius: 3px; padding: 3px;">4</sup> DELIVERY</p>
            </div>
        </div>
    </div>
<!-- Page Header End -->


<!-- Checkout Start -->

<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg-8 border p-3">
            <div class="d-flex form-group">
                <h4 class="font-weight-semi-bold mb-4 mr-5 mt-2">Upload Prescription</h4>
                <input class="form-control w-50" type="file" id="prescription" name="prescription" accept="image/*">
            </div>
            <span class="text-danger" id="prescriptionErr"></span>
            <hr>
            <div class="mb-4">
                <h4 class="font-weight-semi-bold mb-4">Shipping Address</h4>
                <hr>
                <div class="row">
                    @csrf
                    <div class="col-md-6 form-group">
                        <label>Name</label>
                        <input class="form-control" type="text" name="name" id="name" value="{{Auth::user()->name}}" placeholder="John">
                        <span class="text-danger" id="nameErr"></span>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>E-mail</label>
                        <input class="form-control" type="email" name="email" id="email" placeholder="Email" value="{{Auth::user()->email}}" placeholder="example@email.com">
                            <span class="text-danger" id="emailErr"></span>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Whats App</label>
                        <input class="form-control" type="number" name="whatsapp" id="whatsapp" placeholder="+123 456 789">
                        <span class="text-danger" id="whatsappErr"></span>
                    </div>

                    <div class="col-md-6 form-group" id="mobileno">
                        <input type="checkbox" id="sameaswp" name="sameaswp" aria-label="Checkbox for following text input">
                        <label>Contact Same as Whats App</label>
                        <input class="form-control" type="number" name="mobile" id="mobile" placeholder="+123 456 789">
                        <span class="text-danger" id="mobileErr"></span>
                    </div>

                    <div class="col-md-6 form-group">
                        <label>State</label>
                        <select class="custom-select" id="state" name="state">
                            <option value="Barishal">Barishal</option>
                            <option value="Chattogram">Chattogram</option>
                            <option value="Dhaka">Dhaka</option>
                            <option value="Khulna">Khulna</option>
                            <option value="Mymensingh">Mymensingh</option>
                            <option value="Rajshahi">Rajshahi</option>
                            <option value="Rangpur">Rangpur</option>
                            <option value="Sylhet">Sylhet</option>
                        </select>
                        <span class="text-danger" id="stateErr"></span>
                    </div>

                    {{-- @include('emedishop.pages.city_options') --}}

                    <div class="col-md-6 form-group">
                        <label>City</label>
                        <input class="form-control" type="text" id="city" name="city" placeholder="Your City">
                        <span class="text-danger" id="cityErr"></span>
                    </div>

                    <div class="col-md-6 form-group">
                        <label>ZIP Code(Not Recommended)</label>
                        <input class="form-control" type="text" name="zip_code" id="zip_code" placeholder="123">
                        <span class="text-danger" id="zip_codeErr"></span>
                    </div>

                    <div class="col-md-6 form-group">
                        <label>Address</label>
                        <input class="form-control" type="text" id="address" name="address" placeholder="123 Street">
                        <span class="text-danger" id="addressErr"></span>
                    </div> <br>

                    <hr>
                </div>
            </div>
        </div>
        <div class="col-lg-4 border">
            <div class="card border-secondary my-3">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0">Order Total</h4>
                </div>
                <div class="card-body">
                    <h5 class="font-weight-medium mb-3">Products</h5>
                    
                    <div id="loopProduct">

                    </div>
                    {{-- <div class="d-flex justify-content-between" >
                        <p>Colorful Stylish Shirt 3</p>
                        <p>$150</p>
                    </div> --}}

                    <hr class="mt-0">
                    <div class="d-flex justify-content-between mb-3 pt-1">
                        <h6 class="font-weight-medium">Subtotal</h6>
                        <h6 class="font-weight-medium"> <span id="subtotal"></span> <sup>BDT</sup></h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium"> <span id="shipping"></span> <sup>BDT</sup></h6>
                    </div>
                </div>
                <div class="card-footer border-secondary bg-transparent">
                    <div class="d-flex justify-content-between mt-2">
                        <h5 class="font-weight-bold">Total</h5>
                        <h5 class="font-weight-bold"> <span id="total"></span> <sup>BDT</sup></h5>
                    </div>
                </div>
            </div>
            <div class="card border-secondary mb-5">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0">Payment</h4>
                </div>
           
                <div class="text-center p-3">
                    <input type="radio" id="BKASH" value="BKASH" name="payment_method" aria-label="Checkbox for following text input" style="color: rgb(80, 94, 156);">
                    <small class="mr-3">BKASH</small>

                    <input type="radio" id="PAYPAL" value="PAYPAL" name="payment_method" aria-label="Checkbox for following text input" style="color: rgb(80, 94, 156);">
                    <small class="mr-3">PAYPAL</small>

                    <input type="radio" id="CASH ON DELIVERY" value="CASH ON DELIVERY" name="payment_method" aria-label="Checkbox for following text input" style="color: rgb(80, 94, 156);">
                    <small>CASH ON DELIVERY</small> <br>

                    <div id="paypal-button-container" class="d-none paypalBtn"></div>
                </div>
                
                <span id="payment_methodErr" class="text-danger text-center"></span>
        
                <div class="card-footer bg-transparent" id="placeOrder">
                    <div id="paypal-button-container"></div>
                    <button class="btn btn-lg btn-block font-weight-bold py-3" style="background-color:#B9C3E9" onclick="placeOrder()">Place Order</button>
                </div>
               
            </div>
        </div>

    </div>
</div>

<!-- Checkout End -->
@endsection

@section('javascript')


<script>
    // $('#paypal-button-container').addClass('d-none');

    var myCheckbox=$("input[name='sameaswp']");

    myCheckbox.change(function(){
        var whatsapp = $('#whatsapp').val();
        var mobile = $('#mobile').val();
        if(this.checked){
          $('#mobile').val(whatsapp);
          $("#mobile").prop('readonly', true);
        } else {
            $("#mobile").prop('readonly', false);
        }
    });

    var orderDetails = JSON.parse(localStorage.getItem('orderDetails'));
    console.log(orderDetails);

    productData = orderDetails.product_data;

    if(orderDetails.product_data.length > 0) {
        orderDetails.product_data.forEach((item, index) => {
            console.log(item.product_name);
                $('#loopProduct').append(
                    '<div class="d-flex justify-content-between" >'+
                    '<p>'+ item.product_name+'</p>'+
                    '<p>'+ item.quantity +' x '+ item.price+' <sup> BDT </sup></p>'+
                    '</div>'
                );
            });
            $('#subtotal').html(orderDetails.subtotal);
            $('#shipping').html(orderDetails.shipping);
            $('#total').html(orderDetails.total);

            //set data 
            

            // $('.subtotal').val(orderDetails.shipping);
            // $('.shipping').val(orderDetails.subtotal);
            // $('.total').val(orderDetails.total);
            // $('.size').val(orderDetails.size);
            // $('.quantity').val(orderDetails.quantity);
    }

    
    function successAlert(){
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })

            Toast.fire({
            icon: 'success',
            title: 'Order Successfull'
        })
    }

    
    //insert data by axios
    function placeOrder(){
        let subtotal = orderDetails.subtotal;
        let shipping = orderDetails.shipping;
        let total = orderDetails.total;
        let name = $('#name').val();
        let email = $('#email').val();
        let whatsapp = $('#whatsapp').val();
        let mobile = $('#mobile').val();
        let state = $('#state').val();
        let city = $('#city').val();
        let zip_code = $('#zip_code').val();
        let address = $('#address').val();
        let prescription = $('#prescription').val();
        let payment_method =  $("input[name='payment_method']:checked").val();
        let trans_id = null;

        function store(trans){
            axios.post('/user/create-address', {
            'subtotal': subtotal,
            'shipping': shipping,
            'total': total,
            'name': name,
            'email': email,
            'whatsapp': whatsapp,
            'mobile': mobile,
            'state': state,
            'city': city,
            'zip_code': zip_code,
            'address': address,
        }).then(function (response) 
        {
            console.log(response.data);
            if (response.status == 200){
                let productId;
                let order_details = [];
                orderDetails.product_data.forEach((item, index) => {
                    if(productId != item.product_id){
                        productId = item.product_id;
                        // order_details.push(['product_id' => item.product_id, 'quantity' => item.quantity]);
                        
                        order_details.push({
                            product_id: item.product_id, 
                            quantity:  item.quantity,
                            vendor_id:  parseInt(item.vendor_id)
                        });
                    }
                });
                //  console.log('QUANTITY: ', item.quantity);
                
                    axios.post('/user/create-order', {
                    'product_details': order_details,
                    'payment_method': 'bkash',
                    'payment_status': 'paid',
                    'subtotal': subtotal,
                    'shipping': shipping,
                    'total': total,
                    'address_id': response.data,
                    'payment_method': payment_method,
                    'trans_id': trans,
                    'invoice': parseInt(`{{generateInvoice()}}`),
                }).then(resp => {
                    if(resp.status == 200) {
                        console.log(resp);

                        let data = new FormData();
                        data.append('image', document.getElementById('prescription').files[0]);
                        data.append('order_id', resp.data);

                        axios.post('/upload/prescription',data).then(function (response) {
                            console.log(response.data);
                            window.location.href = "{{ route('user.profile')}}";
                        });
                    }
                }).catch(error => {
                    console.log(error);
                });
                
            }
        }).catch(function (error) {
            console.log(error);
        });
        }
        



        // let imagefile = document.querySelector('#prescription').files[0];

        $('#nameErr').empty();
        $('#emailErr').empty();
        $('#whatsappErr').empty();
        $('#mobileErr').empty();
        $('#stateErr').empty();
        $('#cityErr').empty();
        $('#zip_codeErr').empty();
        $('#addressErr').empty();
        $('#prescriptionErr').empty();
        $('#payment_methodErr').empty();

        if(!prescription){
            $('#prescriptionErr').html('Please add your prescription!');
            $('#prescription').focus();
        } else if(!name) {
            $('#nameErr').html('Please fill your name!');
            $('#name').focus();
        } else if(!email){
            $('#emailErr').html('Please fill your email!');
            $('#email').focus();
        } else if(!whatsapp){
            $('#whatsappErr').html('Please fill your whatsapp!');
            $('#whatsapp').focus();
        } else if(!mobile){
            $('#mobileErr').html('Please fill your mobile!');
            $('#mobile').focus();
        } else if(!state){
            $('#stateErr').html('Please fill your state!');
            $('#state').focus();
        } else if(!city){
            $('#cityErr').html('Please fill your city!');
            $('#city').focus();
        } else if(!zip_code){
            $('#zip_codeErr').html('Please fill your zip code!');
            $('#zip_code').focus();
        } else if(!address){
            $('#addressErr').html('Please fill your address!');
            $('#address').focus();
        }  else if(!payment_method){
            $('#payment_methodErr').html('You must choose a payment method!');
            $('#payment_method').focus();
        } else {
            let trans_id = null;
            if(payment_method == 'BKASH'){
            Swal.fire({
                title: `Bkash`,
                input: 'text',
                inputLabel: `BkashSend ${total} BDT To 01689086951 and Enter Bkash Trans Id`,
                inputLabel: `BkashSend ${total} BDT To 01689086951 and Enter Bkash Trans Id`,
                showCancelButton: true,
                inputValidator: (value) => {
                    if (!value) {
                        return 'Please type your payment trans id!'
                    } else {
                        trans_id = value;
                        successAlert();
                        store(trans_id);
                    }
                }
            })
            } else if(payment_method == 'PAYPAL'){
               $('.paypalBtn').removeClass('d-none');
               $('#placeOrder').addClass('d-none');
            } else if(payment_method == 'CASH ON DELIVERY'){
                successAlert();
                store(trans_id);
            }

        }

    }

    function disen(id){
        $(`#${id}`).prop( "disabled", false );
        $(`#${id}`).removeClass( "d-none");
    }

    function city_options(){
        let state = $('#state').val();

        $(`#Abu-Dhabi`).prop( "disabled", true );
        $(`#Abu-Dhabi`).addClass( "d-none");

        $(`#Ajman`).prop( "disabled", true );
        $(`#Ajman`).addClass( "d-none");

        $(`#Dubai`).prop( "disabled", true );
        $(`#Dubai`).addClass( "d-none");

        $(`#Fujairah`).prop( "disabled", true );
        $(`#Fujairah`).addClass( "d-none");

        $(`#Ras-al-Khaimah`).prop( "disabled", true );
        $(`#Ras-al-Khaimah`).addClass( "d-none");

        $(`#Sharjah`).prop( "disabled", true );
        $(`#Sharjah`).addClass( "d-none");

        $(`#Umm-al-Quwain`).prop( "disabled", true );
        $(`#Umm-al-Quwain`).addClass( "d-none");
        
        disen(state);
    }

</script>

<script src="https://www.paypal.com/sdk/js?client-id=test&currency=USD&intent=capture"></script>

<script>
    const fundingSources = [
      paypal.FUNDING.PAYPAL,
        paypal.FUNDING.CARD
      ]

       $('#paypal-button-container').addClass('d-none');

    //   let subtotal = orderDetails.subtotal;
    //     let shipping = orderDetails.shipping;
        let total = orderDetails.total;
        // let name = $('#name').val();
        // let email = $('#email').val();
        // let whatsapp = $('#whatsapp').val();
        // let mobile = $('#mobile').val();
        // let state = $('#state').val();
        // let city = $('#city').val();
        // let zip_code = $('#zip_code').val();
        // let address = $('#address').val();
        // let prescription = $('#prescription').val();
        // let payment_method =  $("input[name='payment_method']:checked").val();
        // let trans_id = null;

        // function store(trans){
        //     axios.post('/user/create-address', {
        //     'subtotal': subtotal,
        //     'shipping': shipping,
        //     'total': total,
        //     'name': name,
        //     'email': email,
        //     'whatsapp': whatsapp,
        //     'mobile': mobile,
        //     'state': state,
        //     'city': city,
        //     'zip_code': zip_code,
        //     'address': address,
        // }).then(function (response) 
        // {
        //     console.log(response.data);
        //     if (response.status == 200){
        //         let productId;
        //         let order_details = [];
        //         orderDetails.product_data.forEach((item, index) => {
        //             if(productId != item.product_id){
        //                 productId = item.product_id;
        //                 // order_details.push(['product_id' => item.product_id, 'quantity' => item.quantity]);
                        
        //                 order_details.push({
        //                     product_id: item.product_id, 
        //                     quantity:  item.quantity,
        //                     vendor_id:  parseInt(item.vendor_id)
        //                 });
        //             }
        //         });
        //         //  console.log('QUANTITY: ', item.quantity);
                
        //             axios.post('/user/create-order', {
        //             'product_details': order_details,
        //             'payment_method': 'bkash',
        //             'payment_status': 'paid',
        //             'subtotal': subtotal,
        //             'shipping': shipping,
        //             'total': total,
        //             'address_id': response.data,
        //             'payment_method': payment_method,
        //             'trans_id': trans,
        //             'invoice': parseInt(`{{generateInvoice()}}`),
        //         }).then(resp => {
        //             if(resp.status == 200) {
        //                 console.log(resp);

        //                 let data = new FormData();
        //                 data.append('image', document.getElementById('prescription').files[0]);
        //                 data.append('order_id', resp.data);

        //                 axios.post('/upload/prescription',data).then(function (response) {
        //                     console.log(response.data);
        //                     window.location.href = "{{ route('user.profile')}}";
        //                 });
        //             }
        //         }).catch(error => {
        //             console.log(error);
        //         });
                
        //     }
        // }).catch(function (error) {
        //     console.log(error);
        // });
        // }
        



        // let imagefile = document.querySelector('#prescription').files[0];

        // $('#nameErr').empty();
        // $('#emailErr').empty();
        // $('#whatsappErr').empty();
        // $('#mobileErr').empty();
        // $('#stateErr').empty();
        // $('#cityErr').empty();
        // $('#zip_codeErr').empty();
        // $('#addressErr').empty();
        // $('#prescriptionErr').empty();
        // $('#payment_methodErr').empty();

        // if(!prescription){
        //     $('#prescriptionErr').html('Please add your prescription!');
        //     $('#prescription').focus();
        // } else if(!name) {
        //     $('#nameErr').html('Please fill your name!');
        //     $('#name').focus();
        // } else if(!email){
        //     $('#emailErr').html('Please fill your email!');
        //     $('#email').focus();
        // } else if(!whatsapp){
        //     $('#whatsappErr').html('Please fill your whatsapp!');
        //     $('#whatsapp').focus();
        // } else if(!mobile){
        //     $('#mobileErr').html('Please fill your mobile!');
        //     $('#mobile').focus();
        // } else if(!state){
        //     $('#stateErr').html('Please fill your state!');
        //     $('#state').focus();
        // } else if(!city){
        //     $('#cityErr').html('Please fill your city!');
        //     $('#city').focus();
        // } else if(!zip_code){
        //     $('#zip_codeErr').html('Please fill your zip code!');
        //     $('#zip_code').focus();
        // } else if(!address){
        //     $('#addressErr').html('Please fill your address!');
        //     $('#address').focus();
        // }  

    let bdtToDollar = parseInt(total/92);

    for (const fundingSource of fundingSources) {
      const paypalButtonsComponent = paypal.Buttons({
        fundingSource: fundingSource,

        // optional styling for buttons
        // https://developer.paypal.com/docs/checkout/standard/customize/buttons-style-guide/
        style: {
          shape: 'rect',
          height: 40,
        },

        // set up the transaction
        createOrder: (data, actions) => {
          // pass in any options from the v2 orders create call:
          // https://developer.paypal.com/api/orders/v2/#orders-create-request-body
          const createOrderPayload = {
            purchase_units: [
              {
                amount: {
                  value: bdtToDollar,
                },
              },
            ],
          }

          return actions.order.create(createOrderPayload)
        },

        // finalize the transaction
        onApprove: (data, actions) => {
          const captureOrderHandler = (details) => {
            const payerName = details.payer.name.given_name
            console.log('Transaction completed!')

            //store data
            let subtotal = orderDetails.subtotal;
            let shipping = orderDetails.shipping;
            let total = orderDetails.total;
            let name = $('#name').val();
            let email = $('#email').val();
            let whatsapp = $('#whatsapp').val();
            let mobile = $('#mobile').val();
            let state = $('#state').val();
            let city = $('#city').val();
            let zip_code = $('#zip_code').val();
            let address = $('#address').val();
            let prescription = $('#prescription').val();
            let payment_method =  $("input[name='payment_method']:checked").val();
            let trans_id = null;


          

            function asstore(trans){
               
            axios.post('/user/create-address', {
            'subtotal': subtotal,
            'shipping': shipping,
            'total': total,
            'name': name,
            'email': email,
            'whatsapp': whatsapp,
            'mobile': mobile,
            'state': state,
            'city': city,
            'zip_code': zip_code,
            'address': address,
        }).then(function (response) 
        {
            console.log(response.data);
            if (response.status == 200){
                let productId;
                let order_details = [];
                orderDetails.product_data.forEach((item, index) => {
                    if(productId != item.product_id){
                        productId = item.product_id;
                        // order_details.push(['product_id' => item.product_id, 'quantity' => item.quantity]);
                        
                        order_details.push({
                            product_id: item.product_id, 
                            quantity:  item.quantity,
                            vendor_id:  parseInt(item.vendor_id)
                        });
                    }
                });
                //  console.log('QUANTITY: ', item.quantity);
                
                    axios.post('/user/create-order', {
                    'product_details': order_details,
                    'payment_method': 'bkash',
                    'payment_status': 'paid',
                    'subtotal': subtotal,
                    'shipping': shipping,
                    'total': total,
                    'address_id': response.data,
                    'payment_method': 'PAYPAL',
                    'trans_id': trans,
                    'invoice': parseInt(`{{generateInvoice()}}`),
                }).then(resp => {
                    if(resp.status == 200) {
                        console.log(resp);

                        let data = new FormData();
                        data.append('image', document.getElementById('prescription').files[0]);
                        data.append('order_id', resp.data);

                        axios.post('/upload/prescription',data).then(function (response) {
                            console.log(response.data);
                            window.location.href = "{{ route('user.profile')}}";
                        });
                    }
                }).catch(error => {
                    console.log(error);
                });
                
            }
        }).catch(function (error) {
            console.log(error);
        });
        }
        successAlert();
            asstore(trans_id);
    }

           
          return actions.order.capture().then(captureOrderHandler)
        },

        // handle unrecoverable errors
        onError: (err) => {
          console.error(
            'An error prevented the buyer from checking out with PayPal',
          )
        },
      })

      if (paypalButtonsComponent.isEligible()) {
        paypalButtonsComponent
          .render('#paypal-button-container')
          .catch((err) => {
            console.error('PayPal Buttons failed to render')
          })
      } else {
        console.log('The funding source is ineligible')
      }
    }

    

  </script>

    
@endsection
