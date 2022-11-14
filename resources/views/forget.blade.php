@extends('auth.layout')
@section('main')
<section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">

            <div class="card card-primary shadow-sm rounded-0">
              <div class="card-header"><h4>Forget Password</h4></div>

              <div class="card-body">                
                <form method="POST" action="{{route('pforget')}}" class="needs-validation" novalidate="">
                @csrf
                <p class="text-muted">We will send a link to reset your password</p>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Please fill in your email
                    </div>
                    @error('email')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                  </div>


                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                    Forget Password
                    </button>
                  </div>
                </form>
              </div>
            </div>     
          </div>
        </div>
      </div>
</section>
@endsection