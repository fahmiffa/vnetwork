@extends('layout.base')
@section('main')
<section class="section">    
        <div class="card card-body">     
            <div class="row">
                <div class="col-md-6">                
                <form action="{{route('premote')}}" class="py-3" method="post">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label>Lokasi Server</label>
                        </div>
                        <div class="col-sm-6">
                            <select name="server" id="server"  class="form-control select-field" data-placeholder="Pilih Server"  required>
                                <option></option>
                                @foreach($server as $row)                                    
                                    <option value="{{$row->id}}">{{$row->name}}</option>                                    
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label>Pilih Layanan</label>
                        </div>
                        <div class="col-sm-6">
                            <select name="serv" id="serv" class="form-control select-field" data-placeholder="Pilih Layanan"  required>
                                <option></option>          
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-6">                        
                            <label>Port</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" min="1" name="port" value="{{old('port')}}" required>
                            @error('port')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label>Waktu</label>
                        </div>
                        <div class="col-sm-6">
                            <select name="time" class="form-control select-field" data-placeholder="Pilih Waktu"  required>
                                <option></option>
                                @php $time=subscribeTime(); @endphp
                               @for($i=0;$i < count($time); $i++)
                               <option value="{{$time[$i]}}"> {{$time[$i]}} Day</option>
                               @endfor
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">                 
                        <div class="col-sm-12">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text alert-info">Username</span>
                                </div>
                                <input type="text" class="form-control" name="username" placeholder="Username" required>
                            </div>  
                                @error('username')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                        </div>
                    </div>

                    <div class="row mb-3">                 
                        <div class="col-sm-12">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text alert-info">Password</span>
                                </div>
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                            </div>             
                               @error('password')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <button type="submit" class="btn btn-dark">Submit</button>
                    </div>

                    <div class="alert alert-danger">
                        <p>PERINGATAN : Username dan Password jangan samakan dengan username dan password mikrotik Anda</p>
                    </div>
                    </form>

                </div>

            </div>
        </div>         
</section>

@push('js')
<script>
    $( '.select-field' ).select2( {
    theme: 'bootstrap-5'
});


$('#server').on('change',function(e){        
        e.preventDefault();

        var val = $(this).val();
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },    
            type:'POST',
            url:"{{ route('services') }}",
            data:{id:val,cat:"Remote"},
            success:function(data){
                    console.log(data);
                    $('#serv option:gt(0)').remove();
                    $.each(data, function(i,field){  
                        if(field.pool === true)
                        {
                            $('#serv').append('<option value="'+field.id+'">'+field.name+'</option>');                         
                        }
                    });
                    
                }
            });
    });
</script>
@endpush
@endsection