@extends('layout.base')
@section('main')
<div class="pagetitle">
    <h4>Config Device</h4>
</div>

<section class="section dashboard">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
            <!--<button class="btn btn-danger btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#myModal">Tambah Port</button>-->
            @foreach($da->devices->port as $p)        
            <div class="card mb-3">                     
                <div class="card-body">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">                            
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$p->id}}" aria-expanded="false" aria-controls="flush-collapse{{$p->id}}">
                                    Account
                                </button>                                
                            </h2>
                            <div id="flush-collapse{{$p->id}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$p->id}}" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
<!--<form onsubmit="return confirm('Apakah Anda Yakin Menghapus ?');" action="{{ route('removePort', $p->id) }}" method="POST">    -->
<!--    @csrf    -->
<!--    <button type="submit" class="btn btn-sm btn-danger float-end"><i class="bi bi-trash"></i></button>-->
<!--</form>                                    -->
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
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
            @endforeach

        </div><!-- End Left side columns -->
    <!-- Right side columns -->
    </div>
</section>


<!-- The Modal -->
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