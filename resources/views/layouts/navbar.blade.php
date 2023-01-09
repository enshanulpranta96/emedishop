 <!-- Navbar Start -->
 <div class="container-fluid mb-5">
     <div class="row border-top px-xl-5">
         <div class="col-lg-3 d-none d-lg-block">
             <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                 <h6 class="m-0">Categories</h6>
                 <i class="fa fa-angle-down text-dark"></i>
             </a>
             <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical">
                 @include('layouts.nav.sidebar')
             </nav>
         </div>
         @include('layouts.nav.topbar')

         {{-- Advertisement start--}}
         <div id="header-carousel" class="carousel slide" data-ride="carousel">
             <div class="carousel-inner">
                 <div class="carousel-item active" style="height: 410px;">
                     <img class="img-fluid" src="{{asset('images/featured/featured-3.jpg')}}" alt="Image">
                     <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                         <div class="p-3" style="max-width: 700px;">
                             <h2 class="text-light text-uppercase font-weight-medium mb-3">GET GREATE MEDICIE DEAL WITHIN COUNTRY</h2>
                             <h4 class="display-5 text-white font-weight-semi-bold mb-4">IN DHAKA 24 HOUR AND OUTSIDE DHAKA 48 HOUR COMITED DELIVERY</h6>
                                 <a href="{{route('medi_store')}}" class="btn btn-light py-2 px-3">Shop Now</a>
                         </div>
                     </div>
                 </div>
                 <div class="carousel-item" style="height: 410px;">
                     <img class="img-fluid" src="{{asset('images/featured/featured-1.jpg')}}" alt="Image">
                     <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                         <div class="p-3" style="max-width: 700px;">
                             <h4 class="text-light text-uppercase font-weight-medium mb-3">10% Off Your First Order</h4>
                             <h3 class="display-4 text-white font-weight-semi-bold mb-4">Reasonable Price</h3>
                             <a href="{{route('medi_store')}}" class="btn btn-light py-2 px-3">Shop Now</a>
                         </div>
                     </div>
                 </div>
             </div>
             <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                 <div class="btn btn-dark" style="width: 45px; height: 45px;">
                     <span class="carousel-control-prev-icon mb-n2"></span>
                 </div>
             </a>
             <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                 <div class="btn btn-dark" style="width: 45px; height: 45px;">
                     <span class="carousel-control-next-icon mb-n2"></span>
                 </div>
             </a>
         </div>
         {{-- Advertisement end--}}
     </div>
 </div>
 <!-- Navbar End -->
