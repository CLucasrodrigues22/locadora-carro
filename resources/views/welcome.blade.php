<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Locadora Carros | Início</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
      <!-- style css -->
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
      <!-- Responsive-->
      <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
      <!-- fevicon -->
      <link rel="icon" href="images/fevicon.png" type="image/gif" />
      <!-- font css -->
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&family=Raleway:wght@400;500;600;700;800&display=swap" rel="stylesheet">
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="{{ asset('assets/css/jquery.mCustomScrollbar.min.css') }}">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
   </head>
   <body>
      <!-- header section start -->
      <div class="header_section">
         <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="{{ url('/') }}" style="color: #fff">Rent Cars BSB</a>
               <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav ml-auto">
                     <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Inicio</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="about.html">Sobre</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="services.html">Serviços</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="gallery.html">Veiculos</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="contact.html">Contato</a>
                     </li>
                     
                  </ul>
               </div>
               @if (Route::has('login'))
                <div class="nav-item" style="flex: 0 0 auto; margin-left: 10%">
                    @auth
                        <a href="{{ url('/home') }}" class="link-danger">Inicio</a>
                    @else
                        <a href="{{ route('login') }}" class="m-2" style="color: #fff">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="m-2" style="color: #fff">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
            </nav>
         </div>
      </div>
      <!-- header section end -->
      <div class="call_text_main">
         <div class="container">
            <div class="call_taital">
               <div class="call_text"><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i><span class="padding_left_15">Brasília</span></a></div>
               <div class="call_text"><a href="#"><i class="fa fa-phone" aria-hidden="true"></i><span class="padding_left_15">(61) 3333-3333</span></a></div>
               <div class="call_text"><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i><span class="padding_left_15">locadora@dominio.com.br</span></a></div>
            </div>
         </div>
      </div>
      <!-- banner section start --> 
      <div class="banner_section layout_padding">
         <div class="container">
            <div class="row">
               <div class="col-md-6">
                  <div id="banner_slider" class="carousel slide" data-ride="carousel">
                     <div class="carousel-inner">
                        <div class="carousel-item active">
                           <div class="banner_taital_main">
                              <h1 class="banner_taital">Cars Rent BSB <br><span style="color: #fe5b29;">For You</span></h1>
                              <p class="banner_text">There are many variations of passages of Lorem Ipsum available, but the majority</p>
                              <div class="btn_main">
                                 <div class="contact_bt"><a href="#">Read More</a></div>
                                 <div class="contact_bt active"><a href="#">Contact Us</a></div>
                              </div>
                           </div>
                        </div>
                        <div class="carousel-item">
                           <div class="banner_taital_main">
                              <h1 class="banner_taital">Car Rent <br><span style="color: #fe5b29;">For You</span></h1>
                              <p class="banner_text">There are many variations of passages of Lorem Ipsum available, but the majority</p>
                              <div class="btn_main">
                                 <div class="contact_bt"><a href="#">Read More</a></div>
                                 <div class="contact_bt active"><a href="#">Contact Us</a></div>
                              </div>
                           </div>
                        </div>
                        <div class="carousel-item">
                           <div class="banner_taital_main">
                              <h1 class="banner_taital">Car Rent <br><span style="color: #fe5b29;">For You</span></h1>
                              <p class="banner_text">There are many variations of passages of Lorem Ipsum available, but the majority</p>
                              <div class="btn_main">
                                 <div class="contact_bt"><a href="#">Read More</a></div>
                                 <div class="contact_bt active"><a href="#">Contact Us</a></div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <a class="carousel-control-prev" href="#banner_slider" role="button" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                     </a>
                     <a class="carousel-control-next" href="#banner_slider" role="button" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                     </a>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="banner_img"><img src="images/banner-img.png"></div>
               </div>
            </div>
         </div>
      </div>
      <!-- banner section end -->
      <!-- about section start -->
      <div class="about_section layout_padding">
         <div class="container">
            <div class="about_section_2">
               <div class="row">
                  <div class="col-md-6"> 
                     <div class="image_iman"><img src="images/about-img.png" class="about_img"></div>
                  </div>
                  <div class="col-md-6"> 
                     <div class="about_taital_box">
                        <h1 class="about_taital">About <span style="color: #fe5b29;">Us</span></h1>
                        <p class="about_text">going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined </p>
                        <div class="readmore_btn"><a href="#">Read More</a></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- about section end -->
      <div class="search_section">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <h1 class="search_taital">Search Your Best Cars</h1>
                  <p class="search_text">Using 'Content here, content here', making it look like readable</p>
                  <!-- select box section start -->
                  <div class="container">
                     <div class="select_box_section">
                        <div class="select_box_main">
                           <div class="row">
                              <div class="col-md-3 select-outline">
                                 <select class="mdb-select md-form md-outline colorful-select dropdown-primary">
                                    <option value="" disabled selected>Any Brand</option>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                    <option value="3">Option 3</option>
                                 </select>
                              </div>
                              <div class="col-md-3 select-outline">
                                 <select class="mdb-select md-form md-outline colorful-select dropdown-primary">
                                    <option value="" disabled selected>Any type</option>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                    <option value="3">Option 3</option>
                                 </select>
                              </div>
                              <div class="col-md-3 select-outline">
                                 <select class="mdb-select md-form md-outline colorful-select dropdown-primary">
                                    <option value="" disabled selected>Price</option>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                    <option value="3">Option 3</option>
                                 </select>
                              </div>
                              <div class="col-md-3">
                                 <div class="search_btn"><a href="#">Search Now</a></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- select box section end -->
               </div>
            </div>
         </div>
      </div>
      <!-- gallery section start -->
      <div class="gallery_section layout_padding">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <h1 class="gallery_taital">Our best offers</h1>
               </div>
            </div>
            <div class="gallery_section_2">
               <div class="row">
                  <div class="col-md-4">
                     <div class="gallery_box">
                        <div class="gallery_img"><img src="images/img-1.png"></div>
                        <h3 class="types_text">Toyota car</h3>
                          <p class="looking_text">Start per day $4500</p>
                        <div class="read_bt"><a href="#">Book Now</a></div>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="gallery_box">
                        <div class="gallery_img"><img src="images/img-2.png"></div>
                        <h3 class="types_text">Toyota car</h3>
                          <p class="looking_text">Start per day $4500</p>
                        <div class="read_bt"><a href="#">Book Now</a></div>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="gallery_box">
                        <div class="gallery_img"><img src="images/img-3.png"></div>
                        <h3 class="types_text">Toyota car</h3>
                          <p class="looking_text">Start per day $4500</p>
                        <div class="read_bt"><a href="#">Book Now</a></div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="gallery_section_2">
               <div class="row">
                  <div class="col-md-4">
                     <div class="gallery_box">
                        <div class="gallery_img"><img src="images/img-1.png"></div>
                        <h3 class="types_text">Toyota car</h3>
                          <p class="looking_text">Start per day $4500</p>
                        <div class="read_bt"><a href="#">Book Now</a></div>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="gallery_box">
                        <div class="gallery_img"><img src="images/img-2.png"></div>
                        <h3 class="types_text">Toyota car</h3>
                          <p class="looking_text">Start per day $4500</p>
                        <div class="read_bt"><a href="#">Book Now</a></div>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="gallery_box">
                        <div class="gallery_img"><img src="images/img-3.png"></div>
                        <h3 class="types_text">Toyota car</h3>
                          <p class="looking_text">Start per day $4500</p>
                        <div class="read_bt"><a href="#">Book Now</a></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- gallery section end -->
      <!-- choose section start -->
      <div class="choose_section layout_padding">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <h1 class="choose_taital">WHY CHOOSE US</h1>
               </div>
            </div>
            <div class="choose_section_2">
               <div class="row">
                  <div class="col-sm-4">
                     <div class="icon_1"><img src="images/icon-1.png"></div>
                     <h4 class="safety_text">SAFETY & SECURITY</h4>
                     <p class="ipsum_text">variations of passages of Lorem Ipsum available, but the majority have </p>
                  </div>
                  <div class="col-sm-4">
                     <div class="icon_1"><img src="images/icon-2.png"></div>
                     <h4 class="safety_text">Online Booking</h4>
                     <p class="ipsum_text">variations of passages of Lorem Ipsum available, but the majority have </p>
                  </div>
                  <div class="col-sm-4">
                     <div class="icon_1"><img src="images/icon-3.png"></div>
                     <h4 class="safety_text">Best Drivers</h4>
                     <p class="ipsum_text">variations of passages of Lorem Ipsum available, but the majority have </p>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- choose section end -->
      <!-- contact section start -->
      <div class="contact_section layout_padding">
         <div class="container">
            <div class="row">
               <div class="col-sm-12">
                  <h1 class="contact_taital">Get In Touch</h1>
               </div>
            </div>
         </div>
         <div class="container">
            <div class="contact_section_2">
               <div class="row">
                  <div class="col-md-12">
                     <div class="mail_section_1">
                        <input type="text" class="mail_text" placeholder="Name" name="Name">
                        <input type="text" class="mail_text" placeholder="Email" name="Email">
                        <input type="text" class="mail_text" placeholder="Phone Number" name="Phone Number">
                        <textarea class="massage-bt" placeholder="Massage" rows="5" id="comment" name="Massage"></textarea>
                        <div class="send_bt"><a href="#">Send</a></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- contact section end -->
      <!-- copyright section start -->
      <div class="copyright_section">
         <div class="container">
            <div class="row">
               <div class="col-sm-12">
                  <p class="copyright_text">2023 All Rights Reserved. Design by <a href="https://html.design">Free Html Templates</a> Distributed By <a href="https://themewagon.com">ThemeWagon</a></p>
               </div>
            </div>
         </div>
      </div>
      <!-- copyright section end -->
      <!-- Javascript files-->
      <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
      <script src="{{ asset('assets/js/popper.min.js') }}"></script>
      <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('assets/js/jquery-3.0.0.min.js') }}"></script>
      <script src="{{ asset('assets/js/plugin.js') }}"></script>
      <!-- sidebar -->
      <script src="{{ asset('assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
      <script src="{{ asset('assets/js/custom.js') }}"></script>
   </body>
</html>