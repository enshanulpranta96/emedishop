<header class="header bg-light" id="header">
    <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
    <div class="text-dark">{{Auth::guard('vendor')->user()->shopname}} | Vendor Panel </div>
</header>
<div class="l-navbar" id="nav-bar">
    <nav class="nav">
        <div>
            <a href="{{route('vendor.home')}}" class="nav_logo"> <img src="https://img.icons8.com/dusk/29/000000/huawei-logo.png" /><span class="nav_logo-name"> Vendor</span> </a>
            <div class="nav_list">
                <a href="{{route('vendor.home')}}" class="nav_link {{ Request::is('vendor/home') ? 'active' : '' }}"> <i class='bx bxs-dashboard nav_icon'></i> <span class="nav_name">Dashboard</span> </a>
                {{-- <a href="{{asset('/visitors')}}" class="nav_link"> <i class='bx bx-user nav_icon'></i> <span class="nav_name">Visitors</span> </a> --}}
                <a href="{{route('vendor.products')}}" class="nav_link {{ Request::is('vendor/products') ? 'active' : '' }}"> <i class='bx bxl-product-hunt nav_icon'></i> <span class="nav_name">Products</span> </a>
                <a href="{{route('vendor.manage.orders')}}" class="nav_link"> <i class='bx bxs-cart nav_icon'></i> <span class="nav_name">Orders</span> </a>
                <a href="{{route('vendor_chat')}}" class="nav_link {{ Request::is('vendor_chat') ? 'active' : '' }}"> <i class=' bx bx-list-check nav_icon'></i> <span class="nav_name">Conversations</span> </a>
                {{-- <a href="{{asset('/contacts')}}" class="nav_link"> <i class='bx bx-bar-chart-alt-2 nav_icon'></i> <span class="nav_name">Contacts</span> </a>
                <a href="{{asset('/gallery')}}" class="nav_link"> <i class='bx bx-bar-chart-alt-2 nav_icon'></i> <span class="nav_name">Contacts</span> </a> --}}
            </div>

        </div>
        <a href="{{route('vendor.logout')}}" class="nav_link" onclick="event.preventDefault();document.getElementById('user-logout').submit();"><i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span></a>
        <form action="{{route('vendor.logout')}}" method="post" id="user-logout" class="d-none">@csrf</form>

    </nav>
</div>
<!--Container Main start-->
