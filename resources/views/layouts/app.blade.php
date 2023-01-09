<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="E Medi Shop" name="keywords">
    <meta content="E Medi Shop" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    {{-- sweetalert2 --}}
    <script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset("css/owl.carousel.min.css")}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset("css/custom.css")}}" rel="stylesheet">
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

<body>

    @include('layouts.header')

    @yield('content')

    @include('layouts.footer')

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset("js/easing.min.js")}}"></script>
    <script src="{{asset("js/owl.carousel.min.js")}}"></script>
    <script src="{{asset("js/axios.min.js")}}"></script>

    <!-- Contact Javascript File -->
    <script src="{{asset("js/email/jqBootstrapValidation.min.js")}}"></script>
    <script src="{{asset("js/email/contact.js")}}"></script>

    <!-- Template Javascript -->
    <script src="{{asset("js/main.js")}}"></script>
    <script src="{{asset("js/custom.js")}}"></script>

    @yield('javascript')
    @yield('navJavaScript')
</body>

</html>
