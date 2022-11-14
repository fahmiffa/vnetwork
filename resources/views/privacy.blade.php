<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>{{env('APP_NAME')}} Privacy</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link rel="icon" type="image/x-icon" href="{{asset('icon.png')}}"/>    

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,700|Roboto:300,400,700&display=swap"
    rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('assets/vendor/icofont/icofont.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/line-awesome/css/line-awesome.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
  
  <style>
      pre {
  word-wrap: normal;
  overflow-x: auto;
  white-space: pre;
}
  </style>

</head>

<body data-spy="scroll" data-target=".navbar" data-offset="50">

  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icofont-close js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>

    <header class="site-navbar js-sticky-header site-navbar-target" role="banner">

      <div class="container">
        <div class="row align-items-center">

          <div class="col-6 col-lg-2">
            <h1 class="mb-0 site-logo"><a href="{{route('home')}}" class="mb-0 font-weight-bold">{{env('APP_NAME')}}</a></h1>
          </div>

          <div class="col-12 col-md-10 d-none d-lg-block">
            <nav class="site-navigation position-relative text-right" role="navigation">            
            <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
              <li class="active"><a href="#home" class="nav-link">Home</a></li>
              <li><a href="#services" class="nav-link">Services</a></li>
              <li><a href="#pricing" class="nav-link">Why Us?</a></li>

                  @auth        
                      @if(Auth()->user()->level == 'user')
                      <li><a href="{{route('user')}}" class="nav-link">{{ucfirst(Auth()->user()->name)}}</a></li>
                      @else
                      <li><a href="{{route('dashboard')}}" class="nav-link">{{ucfirst(Auth()->user()->name)}}</a></li>
                      @endif
                  <li><a href="{{route('logout')}}" class="nav-link">Logout</a></li>
                  @endauth

                  @guest
                  <li><a href="{{route('login')}}" class="nav-link">Login</a></li>
                  <li><a href="{{route('register')}}" class="nav-link">Register</a></li>
                  @endguest

            </ul>
            </nav>
          </div>


          <div class="col-6 d-inline-block d-lg-none ml-md-0 py-3" style="position: relative; top: 3px;">

            <a href="#" class="burger site-menu-toggle js-menu-toggle" data-toggle="collapse"
              data-target="#main-navbar">
              <span></span>
            </a>
          </div>

        </div>
      </div>

    </header>


    <main id="main">
        <div class="hero-section inner-page">
                <div class="wave">
                  
                  <svg width="1920px" height="265px" viewBox="0 0 1920 265" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <g id="Apple-TV" transform="translate(0.000000, -402.000000)" fill="#FFFFFF">
                              <path d="M0,439.134243 C175.04074,464.89273 327.944386,477.771974 458.710937,477.771974 C654.860765,477.771974 870.645295,442.632362 1205.9828,410.192501 C1429.54114,388.565926 1667.54687,411.092417 1920,477.771974 L1920,667 L1017.15166,667 L0,667 L0,439.134243 Z" id="Path"></path>
                          </g>
                      </g>
                  </svg>
        
                </div>
        
                <div class="container">
                  <div class="row align-items-center">
                    <div class="col-12">
                      <div class="row justify-content-center">
                        <div class="col-md-7 text-center hero-text">
                          <h1 data-aos="fade-up" data-aos-delay="" class="aos-init aos-animate">Privacy</h1>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
              </div>
        <div class="site-section pb-0">
                <div class="container">
                  <div class="row align-items-center">
                    <div class="col-md-12">
                    <pre>
Privacy Policy 
This Privacy Policy is prepared by {{env('app_name')}} and whose registered address is Indonesia
(“We”) are committed to protecting and preserving the privacy of our visitors 
when visiting our site or communicating electronically with us.
This policy sets out how we process any personal data we collect from you 
or that you provide to us through our website and social media sites. 
We confirm that we will keep your information secure and 
comply fully with all applicable [ORIGIN COUNTRY] Data Protection legislation and regulations. 
Please read the following carefully to understand what happens 
to personal data that you choose to provide to us, or that we collect from you when you visit our sites. 
By submitting information you are accepting and consenting to the practices described in this policy.
Types of information we may collect from you
We may collect, store and use the following kinds of personal information 
about individuals who visit and use our website and social media sites:
Information you supply to us. You may supply us with information about you by filling in forms on our website or social media. 
This includes information you provide when you submit a contact/inquiry form. 
The information you give us may include but is not limited to, your name, address, e-mail address, and phone number.
How we may use the information we collect
We use the information in the following ways:
Information you supply to us. We will use this information:
to provide you with information and/or services that you request from us;
To contact you to provide the information requested.
Disclosure of your information
Any information you provide to us will either be emailed directly to us or may be stored on a secure server.
We do not rent, sell or share personal information about you with other people or non-affiliated companies.
We will use all reasonable efforts to ensure that your personal data is not disclosed 
to regional/national institutions and authorities unless required by law or other regulations.
Unfortunately, the transmission of information via the internet is not completely secure. 
Although we will do our best to protect your personal data, 
we cannot guarantee the security of your data transmitted to our site; any transmission is at your own risk. 
Once we have received your information, we will use strict procedures and security features to try to prevent unauthorized access.
Your rights – access to your personal data
You have the right to ensure that your personal data is being processed lawfully (“Subject Access Right”). 
Your subject access right can be exercised in accordance with data protection laws and regulations. 
Any subject access request must be made in writing to [insert contact details].
We will provide your personal data to you within the statutory time frames. 
To enable us to trace any of your personal data that we may be holding, we may need to request further information from you. 
If you complain about how we have used your information, you have the right to complain to the Information Commissioner’s Office (ICO).
Changes to our privacy policy
Any changes we may make to our privacy policy in the future will be posted on this page and, where appropriate, notified to you by e-mail. 
Please check back frequently to see any updates or changes to our privacy policy.
Contact
Questions, comments, and requests regarding this privacy policy are welcomed and should be addressed to {{env('MAIL_FROM_ADDRESS')}}.


                    </pre>
                    </div>
                  </div>
                </div>
              </div>

    </main>
    <footer class="footer" role="contentinfo">
      <div class="container">
        <div class="row">
          <div class="col-md-4 mb-4 mb-md-0">
            <h3>About {{env('APP_NAME')}}</h3>
            <p>Present to provide solutions to Mini ISPs. to provide the best service to your clients</p>
            <p class="social">
              <a href="#"><span class="icofont-twitter"></span></a>
              <a href="#"><span class="icofont-facebook"></span></a>
              <a href="#"><span class="icofont-dribbble"></span></a>
              <a href="#"><span class="icofont-behance"></span></a>
            </p>
          </div>
        </div>

        <div class="row justify-content-center text-center">
          <div class="col-md-7">
            <p class="copyright">&copy; Copyright vNetwork. All Rights Reserved</p>
          </div>
        </div>

      </div>
    </footer>
  </div> <!-- .site-wrap -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('assets/vendor/jquery/jquery-migrate.min.js')}}"></script>
  <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/vendor/easing/easing.min.js')}}"></script>
  <script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{asset('assets/vendor/sticky/sticky.js')}}"></script>
  <script src="{{asset('assets/vendor/aos/aos.js')}}"></script>
  <script src="{{asset('assets/vendor/owlcarousel/owl.carousel.min.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('assets/js/main.js')}}"></script>

  @include('sweetalert::alert')

</body>

</html>
