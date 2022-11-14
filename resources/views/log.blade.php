@extends('auth.layout')
@section('main')
<div class="container">

  <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

          <div class="d-flex justify-content-center py-4">
            <a href="{{route('home')}}" class="logo d-flex align-items-center w-auto">
              <img src="assets/img/vpn.png" class="img-fluid" alt="">
                <!--<span class="d-none d-lg-block">{{env('APP_NAME')}}</span>-->
            </a>
          </div><!-- End Logo -->

          <div class="card mb-3">

            <div class="card-body">

              <div class="pt-4 pb-2">
                <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                <p class="text-center small">Enter your Email & password to login</p>
              </div>

              <form method="POST" class="row g-3 needs-validation"  action="{{route('log')}}" novalidate>
              @csrf
                <div class="col-12">
                  <label for="yourUsername" class="form-label">Email</label>
                  <div class="input-group has-validation">                        
                    <input type="email" name="email" class="form-control" id="email" required>
                    <div class="invalid-feedback">Please enter your email</div>
                  </div>
                  @error('email')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                </div>

                <div class="col-12">
                  <label for="yourPassword" class="form-label">Password</label>
                  <input type="password" name="password" class="form-control" id="yourPassword" required>
                  <div class="invalid-feedback">Please enter your password!</div>
                </div>   

                
                <div class="col-12">
                  <a class="text-decoration-none" href="{{route('forget')}}">Forgot Password ?</a>
                </div>
                <div class="col-12">
                  <button class="btn btn-primary w-100 p-1 mb-3" type="submit">Login</button> 
                       <hr class="dropdown-divider">
                  <h6 class="mx-auto d-block text-center">Login With </h4>
                  <a href="/auth/google" class="btn btn-danger btn-circle mx-auto d-block"><i class="ri-google-fill"></i></a>            
                </div>
                <div class="col-12">
                  <p class="small mb-0">Don't have account? <a href="{{route('register')}}">Create an account</a></p>
                </div>
              </form>

            </div>
          </div>

          <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>-->
          </div>

        </div>
      </div>
    </div>

  </section>

</div>
@endsection