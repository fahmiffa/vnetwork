@extends('layout.base')
@section('main')
<section class="section">    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
            <form action="{{route('service.store')}}" method="post">                               
                @csrf                            
                <div class="card-body">
                    <h5 class="card-title py-3">{{$data}}</h5>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-6">
                        <input type="text" name="name" value="{{old('name')}}" class="form-control" id="inputText">
                        @error('name')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                        </div>
                    </div>  

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Harga</label>
                        <div class="col-sm-6">
                        <input type="text" name="price" id="price" value="{{old('price')}}" class="form-control" id="inputText">
                        @error('price')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                        </div>
                    </div>  

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Categori</label>
                        <div class="col-sm-6">
                            <select class="form-control select-field" data-placeholder="Pilih Categori" name="cat" required>
                                <option></option>
                                @php $cat =config('categori.val');  @endphp
                                @for($i=0;$i < count($cat); $i++)
                                    <option value="{{$cat[$i]}}">{{$cat[$i]}}</option>                                
                                @endfor                                           
                                </select>
                                @error('cat')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                        </div>
                    </div>  

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Server Mikrotik</label>
                        <div class="col-sm-6">                            
                            <select class="form-control select-field" title="Pilih Server" id="ser" name="ser" data-placeholder="Choose one thing"  required>
                            <option></option>
                            @foreach($ser as $row)                                
                            <option value="{{$row->id}}">{{$row->name}}</option>                                
                            @endforeach
                            </select>
                            @error('ser')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                        </div>
                    </div>  

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Layanan</label>
                        <div class="col-sm-6">                            
                            <select class="form-control select-field" title="Pilih Layanan" id="lay" name="lay" required>               
                            </select>
                            @error('layanan')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                        </div>
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