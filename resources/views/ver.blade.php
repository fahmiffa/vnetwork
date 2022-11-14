@extends('auth.layout')
@section('main')
<div class="container">

  <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

          <div class="d-flex justify-content-center py-4">
            <a href="{{route('home')}}" class="logo d-flex align-items-center w-auto">
              <img src="{{asset('assets/img/logo.png')}}" alt="">
                <span class="d-none d-lg-block">{{env('APP_NAME')}}</span>
            </a>
          </div><!-- End Logo -->

          <div class="card mb-3">

            <div class="card-body">

              <div class="pt-4 pb-2">
                <h5 class="card-title text-center pb-0 fs-4">{{$data}}</h5>                
              </div>

              <form method="POST" class="row g-3 needs-validation"  action="{{route('pverif',['id'=>$da->user_id])}}" novalidate>
              @csrf
                <div class="col-12">
                  <label for="yourUsername" class="form-label">New Password</label>
                  <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                  <div class="invalid-feedback">
                    please fill in your password
                  </div>
                  @error('password')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                </div>

                <div class="col-12">
                  <label for="yourPassword" class="form-label">Confirm Password<</label>
                  <input id="password" type="password" class="form-control" name="password_confirmation" tabindex="2" required>
                  <div class="invalid-feedback">
                    please fill in your confirm password
                  </div>
                  @error('password_confirmation')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                </div>   
  
                <div class="col-12">
                  <button class="btn btn-primary w-100 p-1" type="submit">Submit</button>                                       
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