<div class="col-lg-9">
    <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
        <a href="{{asset('/')}}" class="text-decoration-none d-block d-lg-none">
            <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>MEDISHOP</h1>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        @php
            $all_products = "all-products"
        @endphp
        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
            <div class="navbar-nav mr-auto py-0">
                <a href="{{asset('/')}}" class="nav-item nav-link active">HOME</a>
                <a href="{{asset('/category/'.$all_products)}}" class="nav-item nav-link">ALL PRODUCTS</a>
                {{-- <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu rounded-0 m-0">
                        <a href="cart.html" class="dropdown-item">Shopping Cart</a>
                        <a href="checkout.html" class="dropdown-item">Checkout</a>
                    </div>
                </div> --}}
                <a href="{{route('contact')}}" class="nav-item nav-link">CONTACT</a>
            </div>
            @if (Auth::user())
            <div class="navbar-nav ml-auto py-0">
                {{-- <a href="" class="nav-item nav-link">MY ORDERS</a> --}}
                <a href="{{route('user.profile')}}" class="nav-item nav-link">PROFILE</a>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{Auth::user()->name}}</a>
                <div class="dropdown-menu rounded-0 m-0">
                    {{-- <p class="dropdown-item">Profile</p> --}}

                    <a href="{{route('user.logout')}}" class="dropdown-item" onclick="event.preventDefault();document.getElementById('user-logout').submit();"><i class='bx bx-log-out nav_icon'></i> <span class="nav_name">Logout</span></a>
                    <form action="{{route('user.logout')}}" method="post" id="user-logout" class="d-none">@csrf</form>
                </div>
            </div>
            @else
            <div class="navbar-nav ml-auto py-0">
                <a href="{{route('user.login')}}" class="nav-item nav-link">Login</a>
                <a href="{{route('user.register')}}" class="nav-item nav-link">Register</a>
            </div>
            @endif

        </div>
    </nav>


    {{-- </div> --}}
