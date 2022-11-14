@extends('base.auth')
@section('main')
<section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">

            <div class="card card-primary">
              <div class="card-header"><h4>Register</h4></div>

              <div class="card-body">                
                <form method="POST" action="{{route('reg')}}" class="needs-validation" novalidate="">
                @csrf
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" type="text" class="form-control" value="{{old('username')}}" name="username" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Please fill in your Username
                    </div>
                    @error('username')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                  </div>

                  <div class="form-group">
                    <label for="no">No HP</label><br>
                    <input id="no" type="number" class="form-control" value="{{old('hp')}}" name="hp" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Please fill in your No HP
                    </div>
                    @error('hp')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                  </div>

                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" value="{{$email}}" name="email" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Please fill in your email
                    </div>
                    @error('email')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">Password</label>    
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                      please fill in your password
                    </div>
                    @error('password')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                  </div>


                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Register
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