<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('dashboard/css/bootstrap.min.css')}}">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('dashboard/css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/css/sidebar.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('dashboard/css/all.min.css')}}"> --}}
    <link rel="stylesheet" href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css')}}">
    <script src="{{asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>
    <link rel="stylesheet" href="{{asset('https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css')}}">

    <title>@yield('title')</title>
</head>
<style>
     .swal-wide{
    width:850px !important;
}
::-webkit-scrollbar {
  width: 5px;
}
/* Track */
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px grey; 
  border-radius: 10px;
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: rgb(92, 114, 173); 
  border-radius: 10px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #4a3c7c; 
}

.gradient-custom {
/* fallback for old browsers */
background: #fccb90;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to bottom right, rgba(252, 203, 144, 1), rgba(213, 126, 235, 1));

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to bottom right, rgba(252, 203, 144, 1), rgba(213, 126, 235, 1))
}

.mask-custom {
background: rgba(24, 24, 16, .2);
border-radius: 2em;
backdrop-filter: blur(15px);
border: 2px solid rgba(255, 255, 255, 0.05);
background-clip: padding-box;
box-shadow: 10px 10px 10px rgba(46, 54, 68, 0.03);
}
</style>
<body id="body-pd">

    {{-- @include('layouts.topbar') --}}
    @include('dashboard.admin.layouts.sidebar')

    {{-- @include('layouts.sidebar') --}}

    <div class="height-90 bg-color">
        @yield('content')
    </div>

    @include('dashboard.admin.layouts.footer')

    <script src="{{asset('dashboard/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('https://code.jquery.com/jquery-3.6.0.min.js')}}" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js')}}"></script>
    <script src="{{asset('dashboard/js/sweetalert2.all.min')}}"></script>
    <script src="{{asset('dashboard/js/sidebar.js')}}"></script>
    <script type="text/javascript" charset="utf8" src="cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('dashboard/js/axios.min.js')}}"></script>
    <script src="{{asset('https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js')}}"></script>
    {{-- <script type="text/javascript">
        $(window).on('click', function() {
            $('#deleteModal').modal('show');
        });

    </script> --}}
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "order": [
                    [3, "desc"]
                ]
            });
        });

    </script>
    <script src="{{asset('js/custom.js')}}"></script>
    @yield('javascript')
    <script>
        toastr.options = {
            "progressBar": true
        }
        @if(Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}"
        switch (type) {
            case 'info':
                toastr.info(" {{ Session::get('message ') }} ");
                break;
            case 'success':
                toastr.success(" {{ Session::get('message') }} ");
                break;
            case 'warning':
                toastr.warning(" {{ Session::get('message') }} ");
                break;
            case 'error':
                toastr.error(" {{ Session::get('message') }} ");
                break;
        }
        @endif

    </script>

</body>
</html>
