@extends('base.auth')
@section('main')
<section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">

            <div class="card card-primary shadow-sm rounded-0">
              <div class="card-header"><h4>{{$data}}</h4></div>

              <div class="card-body">                
                <form method="POST" action="{{route('pverif',['id'=>$da->user_id])}}" class="needs-validation" novalidate="">
                @csrf          

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">New Password</label>    
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                      please fill in your password
                    </div>
                    @error('password')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">Confirm Password</label>    
                    </div>
                    <input id="password" type="password" class="form-control" name="password_confirmation" tabindex="2" required>
                    <div class="invalid-feedback">
                      please fill in your confirm password
                    </div>
                    @error('password_confirmation')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Submit
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