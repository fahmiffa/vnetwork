@extends('layout.base')
@section('main')

<section class="section">    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title py-3">{{$data}}</h5>

                    <form action="{{route('user.store')}}" method="post">                               
                        @csrf           
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-6">
                            <input type="text" name="name"  class="form-control" id="inputText">
                            @error('name')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>  
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-6">
                            <input type="email" name="email" class="form-control" id="inputText">
                            @error('email')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>   
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">No. HP</label>
                            <div class="col-sm-6">
                            <input type="number" name="hp" value="{{old('hp')}}" class="form-control" id="inputText">
                            @error('hp')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>                              
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Level</label>
                            <div class="col-sm-6">
                                <select class="form-control select-field" data-placeholder="Choose one thing" name="level" required>
                                    <option></option>
                                    @php $lev = levelUser(); @endphp
                                    @for($i=0;$i < count($lev); $i++)
                                    <option value="{{$lev[$i]}}">{{$lev[$i]}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>          

                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Save</button>
                            <a class="btn btn-danger" href="{{route('user.index')}}">Back</a>
                        </div>
                    </form>
                </div>
            </div>                  
        </div>                 
    </div>    
</section>

@push('js')
<script>
    $( '.select-field' ).select2( {
    theme: 'bootstrap-5'
} );
</script>
@endpush

@endsection