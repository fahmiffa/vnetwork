@extends('layout.base')
@section('main')

<section class="section">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">                            
            <div class="card mb-3">                     
                <div class="card-body">
                    <div class="d-flex justify-content-between py-3">
                        <div class="p-2">
                            <h5 class="card-title">{{$data}}</h5>
                        </div>
                        <div class="p-2">
                            <button class="btn btn-danger btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#myModal">Tambah Port</button>
                        </div>
                    </div>    
                    <table class="table dt-responsive nowrap" id="tabel">
                        <thead>
                            <tr>                            
                            <th scope="col">No.</th>      
                            <th scope="col">Port</th>      
                            <th scope="col">Price + <small>PPN {{ENV('PPN')}} %</small></th>     
                            <th scope="col">Status</th>         
                            <th scope="col">Action</th>         
                            </tr>
                        </thead>
                        <tbody>            
                            @foreach($da->devices->port as $r)                                                                           
                                <tr>                                         
                                    <td>{{$loop->iteration}}</td>       
                                    <td>{{$r->port}}</td>       
                                    <td>{{($r->orderPort != null) ? number_format($r->orderPort->price, 0, ",", ".") : null}}</td>                                    
                                    <td>{!!status(($r->orderPort != null) ? $r->orderPort->status : 2)!!}</td>      
                                    <td>       
                                        <form onsubmit="return confirm('Apakah Anda Yakin Menghapus ?');" action="{{ route('removePort', $r->id) }}" method="POST"> 
                                            @if($r->orderPort != null && $r->orderPort->status != 2 )
                                            <a href="{{route('payPort',['id'=>$r->orderPort->id])}}" class="btn btn-dark btn-sm"><i class="ri-bank-card-fill"></i></a>
                                            @else
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#myModal{{$r->id}}"><i class="bi bi-gear"></i></button>                                     
                                            @endif

                                            @csrf  
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                        </form>   
                                    </td>                                
                                </tr>      
                            @endforeach                                                                            
                        </tbody>
                    </table>     
                </div>
            </div>

        </div><!-- End Left side columns -->
    <!-- Right side columns -->
    </div>
</section>

@foreach($da->devices->port as $p)    
<div class="modal fade" id="myModal{{$p->id}}">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Account</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body"> 
<pre>
Tipe VPN  : VPN {{$da->services->cat}}
Username   : {{$da->devices->user}}
Password   : {{$da->devices->password}}
Status     : active 
Created On : {{$da->created_at}}
Last Login : {{lastLogin($da)}}
Last IP    : {{lastIp($da)}}
@if($da->active != null)
expired Layanan : {{date('Y-m-d', strtotime($da->active . " +".ENV('EXP_SER')." days"))}}
@endif

IP Netwatch : {{$da->devices->local}}

Server    : {{$da->services->ser->host}}
IP VPN    : {{$da->services->ser->ip}}
Remote    : {{$da->services->ser->ip}}:{{$p->dstPort}} <---> {{$da->services->ser->host}}:{{$p->dstPort}}
Port      : {{$p->port}}
</pre>      
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>
@endforeach    


<div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Port</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
            <form action="{{route('addPort',['id'=>$da->id])}}" class="py-3" method="post">
                @csrf

                <div class="form-group mb-3">              
                    <label>Port</label>
                    <input type="number" class="form-control w-25" min="1" name="port" value="{{old('port')}}" required>
                    @error('port')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-dark">Submit</button>
                </div>

            </form>
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
  
      </div>
    </div>
</div>

@error('port')
<script>
window.onload = function() {
console.log(jQuery('#myModal').modal('show'));
}
</script>
@enderror
@endsection