<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Auditorium | JGU  </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/logo-jgu-white.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet"
        href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/fullcalendar/fullcalendar.css">
    <link rel="stylesheet"
        href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/flatpickr/flatpickr.css">
    <link rel="stylesheet"
        href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/select2/select2.css">
    <link rel="stylesheet"
        href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/@form-validation/form-validation.css">

    {{-- page --}}
    <link rel="stylesheet"
        href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/css/pages/app-calendar.css">
  <!-- Vendor CSS Files -->
  <link href="landingpage/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="landingpage/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="landingpage/aos/aos.css" rel="stylesheet">
  <link href="landingpage/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="landingpage/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="landingpage/main.css" rel="stylesheet">
  <style>
    .hidden-checkbox {
    display: none;
}
  </style>
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="{{route('welcome')}}" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="assets/img/logo-jgu-white.png" alt="">
        <h1 class="sitename">ballroom</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#home" class="">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="#portfolio">Portfolio</a></li>
          <li><a href="#footer">Contact us</a></li>
  
          <li class="dropdown"><a href="#"><span>Sign In</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/home') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
                    @else
                        <li><a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Sign In</a></li>

                  @if (Route::has('register'))
                            <li><a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a></li>
                        @endif
                    @endauth
                </div>
            @endif     
          </div>
        </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="home" class="hero section">
    <meta content="">
    <style>
      body {
        background-image: url('assets/img/ball.back.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh;
        width: 100vw;
      }
      header {
        background: rgba(255,255,225, 0.5);
      }
    </style>

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="zoom-out">
            <h1>BALLROOM | JGU</h1>
            <p><span>Auditorium adalah sebuah ruangan besar yang dirancang untuk mengadakan berbagai acara seperti Graduation, Seminar, Meeting, Dan Lainnya. Ballrom Jakarta Global University
               Dikelola Oleh PT. MOON EVENT.</span></p>
           
               <div class="d-flex">
              <a href="#about" class="btn-get-started">Services</a>
              <a href="https://youtu.be/rqhoknKEqEA?si=wQJVvYUTpbIBFMLM" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
            </div>
          </div>
          <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="200">
            <img src="assets/img/ballroom.png" class="img-fluid animated" alt="">
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>KAMI MELAYANI</h2>
      </div><!-- End Section Title -->

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
          </div>
    <!-- Why Us Section -->
    <section id="why-us" class="section why-us" data-builder="section">

      <div class="container-fluid">

        <div class="row gy-4">

          <div class="col-lg-7 d-flex flex-column justify-content-center order-2 order-lg-1">

            <div class="content px-xl-5" data-aos="fade-up" data-aos-delay="100">
              <h4><span>JGU BALLROOM </span><strong>(1500M2) Convention Centre (MICE)</strong></h4>
              <p>
               Auditorium Jakarta Global University Melayani Produk atau Layanan Untuk Event :
              </p>
            </div>

            <div class="faq-container px-xl-5" data-aos="fade-up" data-aos-delay="200">

              <div class="faq-item faq-active">

                <h3><span>01</span> Weeding</h3>
                <div class="faq-content">
                  <p>layanan pernikahan profesional yang berdedikasi untuk menciptakan momen-momen tak terlupakan pada hari istimewa Anda. Dengan tim ahli yang berpengalaman dan kreatif, kami menawarkan berbagai layanan pernikahan yang dirancang untuk memenuhi kebutuhan dan keinginan Anda.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3><span>02</span> Graduation</h3>
                <div class="faq-content">
                <p>perayaan kelulusan profesional yang berdedikasi untuk menciptakan momen-momen berkesan pada hari penting Anda. Dengan tim ahli yang berpengalaman dan kreatif, kami menawarkan berbagai layanan perayaan kelulusan yang dirancang untuk memenuhi kebutuhan dan keinginan Anda.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3><span>03</span> Seminar</h3>
                <div class="faq-content">
                <p>penyelenggaran acara seminar terkemuka yang siap membantu Anda mengatur acara seminar yang informatif dan berkesan. Kami mengerti bahwa seminar adalah kesempatan untuk berbagi pengetahuan, memperluas jaringan, dan menginspirasi audiens Anda. Dengan pengalaman kami yang luas dalam industri acara, kami menawarkan berbagai layanan yang dirancang untuk memenuhi kebutuhan unik dari setiap seminar. </p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3><span>04</span>Meeting</h3>
                <div class="faq-content">
                  <p>Kami menyediakan layanan penyelenggaraan acara meeting  yang siap membantu Anda mengatur acara meeting yang profesional dan berkesan. Kami mengerti bahwa meeting adalah kesempatan untuk berdiskusi, membuat keputusan penting, dan membangun kolaborasi yang kuat. Dengan pengalaman kami yang luas dalam industri acara, kami menawarkan berbagai layanan yang dirancang untuk memenuhi kebutuhan untuk meeting yang nyaman dan aman.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3><span>05</span>Exhibition dll</h3>
                <div class="faq-content">
                <p>Kami juga menyediakan berbagai macam layanan yang tidak bisa kami lampirkan semuanya disini. Tetapi jika anda tertarik silahkan hubungi nomor whatsapp yang tertera atau akun instagram kami!</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

            </div>

          </div>

          <div class="col-lg-5 order-1">
            <img src="assets/img/lol6-2.png" class="img-fluid" alt="" data-aos="zoom-in" data-aos-delay="100">
          </div>
        </div>

      </div>

    </section><!-- /Why Us Section -->

    <!-- Skills Section -->
   
    
    <!-- Services Section -->
    <section id="services" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Package</h2>
        <p>Berikut adalah package yang tersedia di Ballroom Jakarta Global University</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">
          @foreach($package as $pck)
          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item position-relative">
              <div class="icon"><i class="bi bi-activity icon"></i></div>
              <h4><a class="stretched-link">{{ $pck->Name }}</a></h4>
              <p>{!! $pck->service !!}{!! $pck->item !!}</p>
            </div>
          </div><!-- End Service Item -->
          @endforeach
      

        </div>

      </div>

    </section><!-- /Services Section -->

    <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section">

      <img src="assets/img/jgu.jpg" alt="">

      <div class="container">

        <div class="row" data-aos="zoom-in" data-aos-delay="100">
          <div class="col-xl-9 text-center text-xl-start">
            <h3>Jakarta Global University</h3>
            <p>Kampus C (Utama) Grand Depok City, Jl. Boulevard Raya No. 2 Kota Depok 16412, Jawa Barat Indonesia</p>
            <h3><b><i>| "Mengubah Hidup, Memperkaya Masa Depan"</i></b></h3>
          </div>
          <div class="col-xl-3 cta-btn-container text-center">
            <a class="cta-btn align-middle" href="#">ABOUT US</a>
          </div>
        </div>

      </div>

    </section><!-- /Call To Action Section -->

    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Portofolio</h2>
        <p>Berikut adalah dokumentasi mengenai beberapa acara yang terdapat pada Ballroom dan Lacture Jakarta Global University</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

          <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
            <li data-filter="*" class="filter-active">All</li>
            <li data-filter=".filter-app">Weeding</li>
            <li data-filter=".filter-product">Graduation</li>
            <li data-filter=".filter-branding">Others</li>
          </ul><!-- End Portfolio Filters -->

          <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
              <img src="assets/img/masonry-portfolio/masonry-portfolio-1.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Wedding Auditorium</h4>
                <p>Photo taken By Ballrom | JGU</p>
                <a href="assets/img/masonry-portfolio/masonry-portfolio-1.jpg" title="" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
              <img src="assets/img/masonry-portfolio/masonry-portfolio-2.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Graduation Auditorium</h4>
                <p>Photo taken By Ballrom | JGU</p>
                <a href="assets/img/masonry-portfolio/masonry-portfolio-2.jpg" title="" data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
              <img src="assets/img/masonry-portfolio/masonry-portfolio-3.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Seminar Auditorium</h4>
                <p>Photo taken By Ballrom | JGU</p>
                <a href="assets/img/masonry-portfolio/masonry-portfolio-3.jpg" title="" data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
              <img src="assets/img/masonry-portfolio/masonry-portfolio-4.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Weeding Auditorium 2</h4>
                <p>Photo taken By Ballrom | JGU</p>
                <a href="assets/img/masonry-portfolio/masonry-portfolio-4.jpg" title="" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
              <img src="assets/img/masonry-portfolio/masonry-portfolio-5.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Graduation Auditorium 2</h4>
                <p>Photo taken By Ballrom | JGU</p>
                <a href="assets/img/masonry-portfolio/masonry-portfolio-5.jpg" title="" data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
              <img src="assets/img/masonry-portfolio/masonry-portfolio-6.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Seminar Auditorium 2</h4>
                <p>Photo taken By Ballrom | JGU</p>
                <a href="assets/img/masonry-portfolio/masonry-portfolio-6.jpg" title="" data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
              <img src="assets/img/masonry-portfolio/masonry-portfolio-7.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Weeding Auditorium 3</h4>
                <p>Photo taken By Ballrom | JGU</p>
                <a href="assets/img/masonry-portfolio/masonry-portfolio-7.jpg" title="" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
              <img src="assets/img/masonry-portfolio/masonry-portfolio-8.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Graduation Auditorium 3</h4>
                <p>Photo taken By Ballrom | JGU</p>
                <a href="assets/img/masonry-portfolio/masonry-portfolio-8.jpg" title="" data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
              <img src="assets/img/masonry-portfolio/masonry-portfolio-9.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Seminar Auditorium 3</h4>
                <p>Photo taken By Ballrom | JGU</p>
                <a href="assets/img/masonry-portfolio/masonry-portfolio-9.jpg" title="" data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
              <img src="assets/img/masonry-portfolio/masonry-portfolio-13.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Weeding Lecture</h4>
                <p>Photo taken By Ballrom | JGU</p>
                <a href="assets/img/masonry-portfolio/masonry-portfolio-13.jpg" title="" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
              </div>
            </div><!-- End Portfolio Item --> 
            
            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
              <img src="assets/img/masonry-portfolio/masonry-portfolio-11.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Graduation Lacture</h4>
                <p>Photo taken By Ballrom | JGU</p>
                <a href="assets/img/masonry-portfolio/masonry-portfolio-11.jpg" title="" data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
              <img src="assets/img/masonry-portfolio/masonry-portfolio-12.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Meeting Lacture</h4>
                <p>Photo taken By Ballrom | JGU</p>
                <a href="assets/img/masonry-portfolio/masonry-portfolio-12.jpg" title="" data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
              <img src="assets/img/masonry-portfolio/masonry-portfolio-10.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Weeding Lacture 2</h4>
                <p>Photo taken By Ballrom | JGU</p>
                <a href="assets/img/masonry-portfolio/masonry-portfolio-10.jpg" title="" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
              <img src="assets/img/masonry-portfolio/masonry-portfolio-14.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Graduation Lacture 2</h4>
                <p>Photo taken By Ballrom | JGU</p>
                <a href="assets/img/masonry-portfolio/masonry-portfolio-14.jpg" title="" data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
              <img src="assets/img/masonry-portfolio/masonry-portfolio-15.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Meeting Lacture 2</h4>
                <p>Photo taken By Ballrom | JGU</p>
                <a href="assets/img/masonry-portfolio/masonry-portfolio-15.jpg" title="" data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
              <img src="assets/img/masonry-portfolio/masonry-portfolio-16.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Weeding Lacture 3</h4>
                <p>Photo taken By Ballrom | JGU</p>
                <a href="assets/img/masonry-portfolio/masonry-portfolio-16.jpg" title="" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
              <img src="assets/img/masonry-portfolio/masonry-portfolio-17.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Graduation Lacture 3</h4>
                <p>Photo taken By Ballrom | JGU</p>
                <a href="assets/img/masonry-portfolio/masonry-portfolio-17.jpg" title="" data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
              <img src="assets/img/masonry-portfolio/masonry-portfolio-18.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Meeting Lacture 3</h4>
                <p>Photo taken By Ballrom | JGU</p>
                <a href="assets/img/masonry-portfolio/masonry-portfolio-18.jpg" title="" data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
              </div>
            </div><!-- End Portfolio Item -->

          </div><!-- End Portfolio Container -->

        </div>

      </div>

    </section><!-- /Portfolio Section -->

    <!-- Team Section -->
    {{-- <section id="calendar" class="team section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Calendar</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title --> --}}

      {{-- <div class="container"> --}}
       
        <div class="card app-calendar-wrapper">
          <div class="row g-0">
              <!-- Calendar Sidebar -->
              <div class="col app-calendar-sidebar" id="app-calendar-sidebar">
                  <div class="border-bottom p-4 my-sm-0 mb-3">
                      <div class="d-grid">
                          <h3 class="text-center">Calendar Event</h3>
                      </div>
                  </div>
                  <div class="p-4">
                      <!-- inline calendar (flatpicker) -->
                      <div class="ms-n2">
                          <div class="inline-calendar"></div>
                      </div>
  
                      <hr class="container-m-nx my-4">
  
                      <!-- Filter -->
                      <div class="hidden-checkbox">
          
                        <div class="mb-4">
                            <small class="text-small text-muted text-uppercase align-middle">Filter</small>
                        </div>
    
                        <div class="form-check mb-2">
                            <input class="form-check-input select-all" type="checkbox" id="selectAll" data-value="all" checked>
                            <label class="form-check-label" for="selectAll">View All</label>
                        </div>
    
                        <div class="app-calendar-events-filter">
                            
                            <div class="form-check mb-2">
                                <input class="form-check-input input-filter" type="checkbox" id="select-business"
                                    data-value="business" checked>
                                <label class="form-check-label" for="select-business">Event</label>
                            </div>
                            <div class="form-check form-check-warning mb-2">
                                <input class="form-check-input input-filter" type="checkbox" id="select-family"
                                    data-value="family" checked>
                                <label class="form-check-label" for="select-family">Gehearsals Date</label>
                            </div>
                        
                          
                        </div>
                      </div>
                  </div>
              </div>
              <!-- /Calendar Sidebar -->
  
              <!-- Calendar & Modal -->
              <div class="col app-calendar-content">
                  <div class="card shadow-none border-0">
                      <div class="card-body pb-0">
                          <!-- FullCalendar -->
                          <div id="calendar"></div>
                      </div>
                  </div>
                  <div class="app-overlay"></div>
                 
              </div>
              <!-- /Calendar & Modal -->
          </div>
      </div>
       
    {{-- </section><!-- /Team Section --> --}}

  <footer id="footer" class="footer">

    

        
    <!-- Team Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact us</h2>
        <p> Jika Anda tertarik untuk melakukan reservasi atau booking Auditorium-JGU Ballroom, hubungi kami melalui WhatsApp atau Instagram yang tertera di bawah ini. </p>
        <p> Jangan Lupa Follow Instagram Kami Untuk Mendaptakan Informasi Terbaru!</P>
      </div><!-- End Section Title -->
      
    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="{{route('welcome')}}" class="d-flex align-items-center">
            <span class="sitename">Ballroom | JGU</span>
          </a>
          <div class="footer-contact pt-3">
            <p>Manage by PT.MOON EVENT</p>
            <p>Jakarta Global University, Grand Depok City, Jl. Boulevard No. 2, Tirtajaya, Sukmajaya, Depok, Indonesia 16412</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
            <p><strong>Email:</strong> <span>info@example.com</span></p>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>About Ballroom</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="#home">Home</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#about">About us</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#service">Services</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#portofolio">Portofolio</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="#about">Weeding</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#about">Graduation</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#about">Seminar</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#about">Meeting</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#about">Exhibition dll</a></li>
          </ul>
        </div>
        
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Contact Us</title>
            <style>
                .social-links {
                    display: flex;
                    flex-direction: column;
                }

                .social-link {
                    display: flex;
                    align-items: center;
                    margin-bottom: 10px; /* untuk mengatrur jarak antar icon */
                }

                .social-link a {
                    margin-right: 10px; /* untuk mengatur jarak antara icon dan label */
                }

                .social-link span {
                    font-size: 14px; /* untuk mengatur ukuran teks label */
                }
            </style>
        </head>
        <body>
            <div class="col-lg-2 col-md-12">
                <h4>Contact Us</h4>
                <div class="social-links d-flex flex-column">
                    <div class="social-link">
                        <a href="https://www.instagram.com/jgu_ballroom/"><i class="bi bi-instagram"></i></a>
                        <span>Instagram</span>
                    </div>
                    <div class="social-link">
                        <a href="https://wa.me/6281573321581"><i class="bi bi-whatsapp"></i></a>
                        <span>Admin 1</span>
                    </div>
                    <div class="social-link">
                        <a href="https://wa.me/6281573321581"><i class="bi bi-whatsapp"></i></a>
                        <span>Admin 2</span>
                    </div>
                    <div class="social-link">
                        <a href="https://wa.me/6281573321581"><i class="bi bi-whatsapp"></i></a>
                        <span>Admin 3</span>
                    </div>
                </div>
            </div>
        </body>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Developed by :</h4>
          <div class="col-lg-8" data-aos="zoom-out" data-aos-delay="200">
          <img src="assets/img/lolp.png" class="img-fluid animated" alt="">
          </div>
        </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">2024 |</strong> <span>Jakarta Global University</span></p>
      <div class="credits">
      </div>
    </div>
  </footer>

  <!-- Scroll Top -->
  <a href="" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

  <!-- Vendor JS Files -->
  <script src="landingpage/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="landingpage/aos/aos.js"></script>
  <script src="landingpage/glightbox/js/glightbox.min.js"></script>
  <script src="landingpage/swiper/swiper-bundle.min.js"></script>
  <script src="landingpage/waypoints/noframework.waypoints.js"></script>
  <script src="landingpage/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="landingpage/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="landingpage/main.js"></script>
  <script
  src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/fullcalendar/fullcalendar.js">
</script>
<script
  src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/select2/select2.js">
</script>
<script src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/moment/moment.js">
</script>
<script
  src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/flatpickr/flatpickr.js">
</script>

{{-- page --}}
<script src="{{ asset('') }}assets/js/app-calendar-events.js"></script>
<script src="{{ asset('') }}assets/js/appcalendar.js"></script>
<script>
  window.events =  [
      @foreach($events as $event){
id:  "{{ $event->id }}",
url:  "",
title:  "BOOKED",
tenant_name:  "{{ $event->tenant_name }}",
start:  "{{ $event->start }}",
end:  "{{ $event->end }}",
location:  "{{ $event->location }}",
phone:  "{{ $event->phone }}",
capacity:  "{{ $event->capacity }}",
allDay:  ! 1,
extendedProps:  {
   calendar:  "{{ $event->type }}"
}
}, @endforeach

  ];

</script>
</body>

</html>