@extends('layout.base')
@section('main')

<div class="pagetitle">
      <h1>Profile</h1>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link {{(count($errors) > 0) ? null : 'active'}}" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link {{(session('user') == true) ? 'active' : null}}" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link {{(session('pass') == true) ? 'active' : null}}" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade {{(count($errors) > 0) ? null : 'show active'}}" id="profile-overview">
             
                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Username</div>
                    <div class="col-lg-9 col-md-8">{{$da->name}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8">{{$da->hp}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8">{{$da->email}}</div>
                  </div>

                </div>

                <div class="tab-pane fade {{(session('user') == true) ? 'show active' : null}} pt-3" id="profile-edit">                            

                  <form action="{{route('setting.store')}}" method="post">
                  @csrf        
                    <div class="row mb-3">
                      <label for="user" class="col-md-4 col-lg-3 col-form-label">Username</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="user" type="text" class="form-control" id="user" value="{{$da->name}}" required>
                        @error('user')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                      </div>
                    </div>


                    <div class="row mb-3">
                      <label for="hp" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="hp" type="number" class="form-control" id="hp" value="{{$da->hp}}" required>
                        @error('hp')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="Email" value="{{$da->email}}" required>
                        @error('email')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                      </div>
                    </div>                

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade {{(session('pass') == true) ? 'show active' : null}} pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form action="{{route('up')}}" method="post">
                  @csrf     

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="pass" type="password" class="form-control" id="currentPassword" required>
                        @error('pass')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="newPassword">
                        @error('password')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password_confirmation" type="password" class="form-control" id="renewPassword">
                        @error('password_confirmation')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>
@endsection