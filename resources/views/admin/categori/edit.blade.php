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
                <form action="{{route('categori.update', $da->id)}}" method="post">                               
                    @csrf           
                    @method('PUT')                     
                    <div class="card-body">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="name" value="{{$da->name}}" class="form-control">
                            @error('name')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                        </div>     
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Save</button>
                        <a class="btn btn-danger" href="{{route('categori.index')}}">Back</a>
                    </div>
                </form>
                </div>                  
            </div>                 
        </div>
    </div>
</section>
@endsection