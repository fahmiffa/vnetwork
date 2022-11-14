@extends('layout.base')
@section('main')
<section class="section">

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">  
                        
                        <div class="d-flex justify-content-between py-3">
                            <div class="p-2">
                                <h5 class="card-title">{{$data}}</h5>
                            </div>
                            <div class="p-2">
                                <a href="{{route('addTunnel')}}" class="btn btn-primary btn-sm">Tambah Data</a>
                            </div>
                        </div>    
                        <table class="table dt-responsive nowrap" id="tabel">
                        <thead>
                            <tr>                            
                            <th scope="col">Service</th>      
                            <th scope="col">Price + <small>PPN {{ENV('PPN')}} %</small></th>     
                            <th scope="col">Status</th>         
                            <th scope="col">Action</th>         
                            </tr>
                        </thead>
                        <tbody>                        
                            @foreach($da as $row)   
                                @if($row->services->cat == 'Tunnel')                             
                                <tr>                                
                                <td>{{$row->services->name}}</td>   
                                <td>{{number_format($row->netto, 0, ",", ".")}}</td>
                                <td>{!!status($row->status)!!}</td>      
                                <td>
                                    @if($row->status != 2)
                                    <a href="{{route('payment',['id'=>$row->id])}}" class="btn btn-dark">Payment</a>
                                    @else
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal{{$row->id}}">Config</button>                                     
                                    @endif
                                </td>                                 
                                </tr>         
                                @endif                       
                            @endforeach                                                           
                        </tbody>
                        </table>                    
                    </div>
                </div>
            </div>     
        </div>
    </div>
</section>

@foreach($da as $rows) 
<!-- The Modal -->
<div class="modal fade" id="myModal{{$rows->id}}">
<div class="modal-dialog modal-lg">
<div class="modal-content">

  <!-- Modal Header -->
  <div class="modal-header">
    <h4 class="modal-title">Account</h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
  </div>

  <!-- Modal body -->
  <div class="modal-body">
<pre>Tipe VPN  : VPN {{$rows->services->cat}}

Server     : {{$rows->services->ser->host}}
Username   : {{$rows->devices->user}}
Password   : {{$rows->devices->password}}
Status     : active 
Created On : {{$rows->created_at}}
Last Login : {{lastLogin($rows)}}
@if($rows->active != null)
expired Layanan : {{date('Y-m-d', strtotime($rows->active . " +".ENV('EXP_SER')." days"))}}
@endif
</pre>
  </div>

  <!-- Modal footer -->
  <div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
  </div>

</div>
</div>
</div>
@endforeach

@push('js')
<script>        
        $(document).ready(function() {
            $('#tabel').DataTable();
        });
</script>
@endpush
@endsection