@extends('admin.base.layout')
@section('main')
<section class="section">
    <div class="section-header">
        <h1>{{$data}}</h1>        
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card">
                <form action="{{route('setting.store')}}" method="post">                               
                    @csrf                                       
                    <div class="card-body">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="user" value="{{$da->name}}" class="form-control">
                            @error('name')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                        </div>      

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="pass" value="" class="form-control" required>
                            @error('pass')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                        </div>    
                        
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Update</button>                        
                    </div>
                </form>
                </div>                  
            </div>                 
        </div>
    </div>
</section>
@endsection