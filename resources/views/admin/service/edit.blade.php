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
                <form action="{{route('service.update', $da->id)}}" method="post">                               
                    @csrf           
                    @method('PUT')                     
                    <div class="card-body">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="name" value="{{$da->name}}" class="form-control">
                            @error('name')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                        </div>  
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="text" name="price" id="price" value="{{"Rp. " .number_format($da->price, 0, ",", ".")}}" class="form-control">
                            @error('price')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                        </div>  
                        <div class="form-group">
                            <label>Categori</label>                            
                            <select class="form-control select-field" title="Pilih Categori" name="cat" data-live-search="true" required>
                            @php $cat =config('categori.val');  @endphp
                            @for($i=0;$i < count($cat); $i++)
                                <option value="{{$cat[$i]}}" {{($cat[$i]==$da->cat) ? 'selected' : null}}>{{$cat[$i]}}</option>                                
                            @endfor                                           
                            </select>
                            @error('cat')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                        </div>    
                        <div class="form-group">
                            <label>Server Mikrotik</label>
                            <p class="small text-danger">Layanan dari Mikrotik</p>
                            <select class="form-control select-field" title="Pilih Server" id="ser" name="ser" data-live-search="true" required>
                            @foreach($ser as $row)                                
                            <option value="{{$row->id}}" {{($row->id==$da->server) ? 'selected' : null}} >{{$row->name}}</option>                                
                            @endforeach
                            </select>
                            @error('ser')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                        </div>         
                        <div class="form-group">
                            <label>Layanan</label>                            
                            <select class="form-control select-field" title="Pilih Layanan" id="lay" name="lay" data-live-search="true" required>               
                            @foreach($lay as $row)
                                @if($row['name'] != 'default' && $row['name'] != 'default-encryption')
                            <option value="{{$row['name']}}" {{($row['name']==$da->lay) ? 'selected' : null}} >{{$row['name']}}</option>
                                @endif
                            @endforeach
                            </select>
                            @error('layanan')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                        </div>           
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Save</button>
                        <a class="btn btn-danger" href="{{route('service.index')}}">Back</a>
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
});

    $('#ser').on('change',function(e){        
        e.preventDefault();

        var val = $(this).val();
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },    
            type:'POST',
            url:"{{ route('layanan') }}",
            data:{id:val},
            success:function(data){
                    console.log(data);
                    $('#lay option:gt(0)').remove();
                    $.each(data, function(i,field){  
                        if(field.name !== 'default' && field.name !== 'default-encryption')
                        {
                            $('#lay').append('<option value="'+field.name+'">'+field.name+'</option>');                         
                        }
                    });

                    $('#lay').selectpicker('refresh');
                }
            });
    });

    var dengan_rupiah = document.getElementById('price');
    dengan_rupiah.addEventListener('keyup', function(e)
    {
        dengan_rupiah.value = formatRupiah(this.value, 'Rp. ');
    });
    function formatRupiah(angka, prefix)
    {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>
@endpush
@endsection