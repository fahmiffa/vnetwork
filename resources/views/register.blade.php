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
            <!--<span class="d-none d-lg-block">vNetwork</span>-->
          </a>
        </div><!-- End Logo -->

        <div class="card mb-3">

          <div class="card-body">

            <div class="pt-4 pb-2">
              <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
              <p class="text-center small">Enter your personal details to create account</p>
            </div>

            <form method="POST" action="{{route('reg')}}" class="row g-3 needs-validation" novalidate>
            @csrf
            <div class="col-12">
                <label for="yourUsername" class="form-label">Username</label>
                <input id="username" type="text" class="form-control" value="{{old('username')}}" name="username" required autofocus>
                    <div class="invalid-feedback">
                      Please fill in your Username
                    </div>
                    @error('username')<div class='small text-danger text-left'>{{$message}}</div>@enderror
              </div>
              
              <div class="col-12">
                <label for="yourName" class="form-label">Email</label>
                <input id="email" type="email" class="form-control" value="{{$email}}" name="email" required>
                    <div class="invalid-feedback">
                      Please fill in your email
                    </div>
                    @error('email')<div class='small text-danger text-left'>{{$message}}</div>@enderror
              </div>

              <div class="col-12">
                <label for="yourEmail" class="form-label">Phone Number</label>
                <input id="no" type="number" class="form-control" value="{{old('hp')}}" name="hp" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Please fill in your Phone Number
                    </div>
                    @error('hp')<div class='small text-danger text-left'>{{$message}}</div>@enderror
              </div>

              

              <div class="col-12">
                <label for="yourPassword" class="form-label">Password</label>
                <input id="password" type="password" class="form-control" name="password" required>
                    <div class="invalid-feedback">
                      please fill in your password
                    </div>
                    @error('password')<div class='small text-danger text-left'>{{$message}}</div>@enderror
              </div>

              <div class="col-12">
                <button class="btn btn-primary w-100" type="submit">Create Account</button>
              </div>
              <div class="col-12">
                <p class="small mb-0">Already have an account? <a href="{{route('login')}}">Log in</a></p>
              </div>
            </form>

          </div>
        </div>

        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
        <!--  Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>-->
        </div>

      </div>
    </div>
  </div>

</section>

</div>
@endsection