@extends('layouts.app')

@section('title', 'Cart | Emedishop')

@section('content')

<!-- Navbar Start -->
@include('emedishop.navbar')
<!-- Navbar End -->

<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 180px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Shopping Cart</h1>
        <div class="d-inline-flex my-4">
            <p class="m-0" style="color: #4BB8A9; font-size: 18px;"><sup style="border: 1px solid #4BB8A9; padding: 3px; border-radius: 3px;">1</sup> LOGIN</p>
            <div class="m-0 px-2" style="color: #4BB8A9; font-size: 80px; line-height: 0.1">&#8702;</div>
            <p class="m-0" style="color: #4BB8A9; font-size: 18px;"><sup style="border: 1px solid #4BB8A9;; padding: 3px; border-radius: 3px;">2</sup> CART</p>
            <p class="m-0 px-2" style="color: rgb(51, 51, 51); line-height: 0.1">&#8692;</p>
            <p class="m-0" style="color: rgb(51, 51, 51); font-size: 18px;"><sup style="border: 1px solid rgb(51, 51, 51); border-radius: 3px; padding: 3px;">3</sup> CHECKOUT</p>
            <p class="m-0 px-2" style="color: rgb(51, 51, 51); font-size: 80px; line-height: 0.1">&#8702;</p>
            <p class="m-0" style="color: rgb(51, 51, 51); font-size: 18px;"><sup style="border: 1px solid rgb(51, 51, 51); border-radius: 3px; padding: 3px;">4</sup> DELIVERY</p>
        </div>
    </div>
</div>
<!-- Page Header End -->

{{-- if empty cart --}}
<div class="text-danger text-center empty_cart_title d-none">
    <h2>Cart is empty!</h2>
</div>

<!-- Cart Start -->
<div class="container-fluid pt-5 cart_products">
    <div class="row px-xl-5">
        {{-- loadng --}}
        <button class="btn text-danger col-lg-8" id="loading" type="button" disabled>
            <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
            Loading...
        </button>
        <div class="col-lg-8 table-responsive mb-5 d-none" id="loadTable">
            <table class="table table-bordered text-center mb-0">
                <thead class="bg-secondary text-dark">
                    <tr>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle" id="tableBody">

                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <form class="mb-5" action="">
                <div class="input-group">
                    <input type="text" class="form-control p-4" placeholder="Coupon Code">
                    {{-- <div class="input-group-append">
                        <button class="btn border">Apply Coupon</button>
                    </div> --}}
                </div>
            </form>
            <div class="card border-secondary mb-5">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3 pt-1">
                        <h6 class="font-weight-medium">Subtotal</h6>
                        <h4 class="font-weight-medium"> <span id="subtotal"> </span> <sup>BDT</sup></h4>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h4 class="font-weight-medium"> <span id="shipping"> </span> <sup>BDT</sup></h4>
                    </div>
                </div>
                <div class="card-footer border-secondary bg-transparent">
                    <div class="d-flex justify-content-between mt-2">
                        <h5 class="font-weight-bold">Total</h5>
                        <h4 class="font-weight-bold"> <span id="total_price"> </span> <sup>BDT</sup></h4>
                    </div>
                    <a href="{{route('user.checkout')}}" onclick="proceed()" class="btn btn-block border text-dark my-3 py-3 btnClr">Proceed To Checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->

@endsection

@section('javascript')
<script>
    localStorage.removeItem("orderDetails");
    function summery(total_price) {
        let shipping = 90;
        $('#subtotal').html(total_price);
        $('#shipping').html(shipping);
        $('#total_price').html(total_price+shipping);
    }

    let productData = [];

    //get getCartList
    function getCartList() {
        countCart();
        var totalp = 0;
        $('#loadTable').addClass('d-none');
        $('#loading').removeClass('d-none');

        axios.get('/getCartList').then(resp => {

            if (resp.status == 200) {
                //to avoid duplicate table 
                $('#tableBody').empty();

                if (resp.data.length == 0) {
                    $('.empty_cart_title').removeClass('d-none');
                    $('.cart_products').addClass('d-none');
                } else {
                    $('.empty_cart_title').addClass('d-none');
                    $('.cart_products').removeClass('d-none');
                }

                let data = resp.data;
                let preProductId;
                $.each(data, function(i, item) {
                    var minusaction = data[i].quantity > 1 ? "" : "disabled";
                    $('<tr>').html(
                        '<td class="align-middle"><img src="img/product-1.jpg" alt="" style="width: 50px;">  ' + data[i].product_name + '</td>' +
                        '<td class="align-middle">BDT ' + data[i].price + '</td>' +
                        '<td class="align-middle">' +
                        '<div class="input-group quantity mx-auto" style="width: 100px;">' +
                        '<div class="input-group-btn">' +
                        '<button onclick="reduceQuantity(' + `${data[i].id},${data[i].price},${data[i].quantity}` + ')" class="btn btn-sm border btn-minus" ' + `${minusaction}` + '>' +
                        '<i class="fa fa-minus"></i>' +
                        '</button>' +
                        '</div>' +
                        '<input id="'+`quan${data[i].id}`+'" type="text" class="form-control form-control-sm bg-secondary text-center" value="' + data[i].quantity + '" readonly>' +
                        '<div class="input-group-btn">' +
                        '<button onclick="addQuantity(' + `${data[i].id},${data[i].price},${data[i].quantity}, ${data[i].total}` + ')" class="btn btn-sm border btn-plus">' +
                        '<i class="fa fa-plus"></i>' +
                        '</button>' +
                        '</div>' +
                        '</div>' +
                        '</td>' +
                        '<td class="align-middle">BDT <span id="'+ `${data[i].id}` +'">' + data[i].total + '</span></td>' +
                        '<td class="align-middle"><button onclick="removeFromCart(' + data[i].id + ')" class="btn btn-sm border"><i class="fa fa-times"></i></button></td>'
                    ).appendTo('#tableBody');

                    totalp = totalp + parseFloat(data[i].total);

                    //store product name and price to object
                    let quantity = $(`#quan${data[i].id}`).val();
                    if(preProductId != data[i].id){
                        preProductId = data[i].id;
                        productData.push({
                        'product_name' : data[i].product_name,
                        'product_id' : data[i].product_id,
                        'price' : data[i].price, 
                        'product_size': data[i].product_size,
                        'quantity': quantity,
                        'vendor_id': data[i].vendor_id,
                        });
                    }
                });

                $('#loadTable').removeClass('d-none');
                $('#loading').addClass('d-none');

                summery(totalp);

                // //remove loading class and show table class
                // $('#mainDiv').removeClass('d-none');
                // $('#loadingDiv').addClass('d-none');

                // //adding table js
                // $('.tbl').attr('id', 'example');
                // $(document).ready(function() {
                //     $('#example').DataTable();
                // });
            } else {
                // $('#loadingDiv').addClass('d-none');
                // $('#wrongDiv').removeClass('d-none');
            }
        }).catch(err => {
            console.log(err)
            // $('#loadingDiv').addClass('d-none');
            // $('#wrongDiv').removeClass('d-none');
        })
    }

    getCartList();

    function removeFromCart(id) {
        //here id is cart id
        axios.post('/removeFromCart', {
            'id': id
        }).then(resp => {
            console.log('removeFromCart: ', resp);
            if (resp.status == 200) {
                getCartList();
            }
        }).catch(error => {
            console.log(error)
        });
    }

    function addQuantity(id, price, quantity, total) {
        // alert(id)
        //here id is cart id,cart price and cart quantity
        axios.post('/addQuantity', {
            'id': id
            , 'price': price
            , 'quantity': quantity
        }).then(resp => {
            console.log('addquantity: ', resp);
            if (resp.status == 200) {
                window.location.reload();
                // getCartList();
                // $('#id').html = total+price;
            }
        }).catch(error => {
            console.log(error)
        });
    }

    function reduceQuantity(id, price, quantity) {
        // alert(price)
        axios.post('/reduceQuantity', {
            'id': id
            , 'price': price
            , 'quantity': quantity
        }).then(resp => {
            console.log('reduceQuantity: ', resp);
            if (resp.status == 200) {
                window.location.reload();
                // getCartList();
            }
        }).catch(error => {
            console.log(error)
        });
    }
    

    function proceed(){
        let subtotal = $('#subtotal').html();
        let shipping = $('#shipping').html();
        let total = $('#total_price').html();
        let orderDetails = {
                'subtotal': subtotal,
                'shipping': shipping,
                'total': total,
                'product_data': productData,
            };

            console.log(orderDetails)

            localStorage.setItem('orderDetails', JSON.stringify(orderDetails));
    }

</script>
@endsection
