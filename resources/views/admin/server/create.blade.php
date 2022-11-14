@extends('layout.base')
@section('main')
<section class="section">    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
            <form action="{{route('server.store')}}" method="post">                               
                @csrf                            
                <div class="card-body">
                    <h5 class="card-title py-3">{{$data}}</h5>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-6">
                        <input type="text" name="name" value="{{old('name')}}"  class="form-control" id="inputText">
                        @error('name')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                        </div>
                    </div>  

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-6">
                        <input type="text" name="name" value="{{old('user')}}"  class="form-control" id="inputText">
                        @error('name')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                        </div>
                    </div>  


                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-6">
                        <input type="text" name="pass" value="{{old('pass')}}"  class="form-control" id="inputText">
                        @error('pass')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                        </div>
                    </div>  

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Host</label>
                        <div class="col-sm-6">
                        <input type="text" name="host" value="{{old('host')}}"  class="form-control" id="inputText">
                        @error('host')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                        </div>
                    </div>  

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Port</label>
                        <div class="col-sm-6">
                        <input type="text" name="port" value="{{old('port')}}"  class="form-control" id="inputText">
                        @error('port')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                        </div>
                    </div>  

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">IP</label>
                        <div class="col-sm-6">
                        <input type="text" name="ip" value="{{old('ip')}}"  class="form-control" id="inputText">
                        @error('ip')<div class='small text-danger text-left'>{{$message}}</div>@enderror
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