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
                                <a href="{{route('addRemote')}}" class="btn btn-primary btn-sm">Tambah Data</a>
                            </div>
                        </div>    

                        <table class="table dt-responsive nowrap" id="tabel">
                        <thead>
                            <tr>                            
                            <th scope="col">Service</th>      
                            <th scope="col">Server</th>      
                            <th scope="col">Price + <small>PPN {{ENV('PPN')}} %</small></th>     
                            <th scope="col">Status</th>         
                            <th scope="col">Action</th>         
                            </tr>
                        </thead>
                        <tbody>                        
                            @foreach($da as $row)         
                                @if($row->services->cat == 'Remote')
                                <tr>                                         
                                <td>{{$row->services->lay}}</td>       
                                <td>{{$row->services->ser->name}}</td>       
                                <td>{{number_format($row->netto, 0, ",", ".")}}</td>
                                <td>{!!status($row->status)!!}</td>      
                                <td>
                                    @if($row->status != 2)
                                    <a href="{{route('payment',['id'=>$row->id])}}" class="btn btn-dark">Payment</a>
                                    @else                                                                        
                                    <a href="{{route('orderRemote',['id'=>$row->id])}}" class="btn btn-primary btn-sm"><i class="ri-router-line"></i></a>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#myModal{{$row->id}}">Tambah Port</button>
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

    @foreach($da as $row)     
    <div class="modal fade" id="myModal{{$row->id}}">
        <div class="modal-dialog">
          <div class="modal-content">
      
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Tambah Port</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
      
            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{route('addPort',['id'=>$row->id])}}" class="py-3" method="post">
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
console.log(jQuery('#myModal{{$row->id}}').modal('show'));
}
</script>
@enderror

    @endforeach        

</section>


@endsection