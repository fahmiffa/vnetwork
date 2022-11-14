@extends('layout.base')
@section('main')
<section class="section">    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
            <form action="{{route('server.update', $da->id)}}" method="post">                               
                @csrf           
                @method('PUT')                     
                <div class="card-body">
                    <h5 class="card-title py-3">{{$data}}</h5>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-6">
                        <input type="text" name="name" value="{{$da->name}}"   class="form-control" id="inputText">
                        @error('name')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                        </div>
                    </div>  

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">User Name</label>
                        <div class="col-sm-6">
                        <input type="text" name="user" value="{{$da->user}}"   class="form-control" id="inputText">
                        @error('user')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                        </div>
                    </div>  

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-6">
                        <input type="text" name="pass" value="{{$da->pass}}"   class="form-control" id="inputText">
                        @error('pass')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                        </div>
                    </div>  

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Host</label>
                        <div class="col-sm-6">
                        <input type="text" name="host" value="{{$da->host}}"   class="form-control" id="inputText">
                        @error('host')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                        </div>
                    </div>  

                    
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Port</label>
                        <div class="col-sm-6">
                        <input type="text" name="port" value="{{$da->port}}"   class="form-control" id="inputText">
                        @error('port')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                        </div>
                    </div>  

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">IP</label>
                        <div class="col-sm-6">
                        <input type="text" name="ip" value="{{$da->ip}}"   class="form-control" id="inputText">
                        @error('ip')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                        </div>
                    </div>  

                    <div class="row mb-3 align-items-center">
                        <label class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-6">
                          <div class="form-check form-switch my-auto">
                            <input class="form-check-input" name="status" type="checkbox" {{($da->status == 1) ? 'checked' : null}} >                            
                          </div>     
                        </div>
                      </div>

                </div>

                
                <div class="card-footer text-right">
                    <button class="btn btn-primary">Save</button>
                    <a class="btn btn-danger" href="{{route('server.index')}}">Back</a>
                </div>
            </form>
            </div>                  
        </div>                 
    </div>    
</section>
@endsection