@extends('layout.base')
@section('main')
<section class="section">
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title py-3">{{$data}}</h5>
                    <table class="table dt-responsive nowrap" id="tabel">
                    <thead>
                        <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Nama</th>    
                        <th scope="col">Kategori</th>    
                        <th scope="col">Service</th>           
                        <th scope="col">Price + <small>PPN {{ENV('PPN')}} %</small></th>           
                        <th scope="col">Status</th>             
                        <th scope="col">Action</th>             
                        </tr>
                    </thead>
                    <tbody>                        
                        @foreach($da as $row)                                
                            <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$row->users->name}}</td>          
                            <td>{{$row->services->cat}}</td>        
                            <td>{{$row->services->lay}}</td>        
                            <td>{{number_format($row->netto, 0, ",", ".")}}</td>
                            <td>{!!status($row->status)!!}</td>       
                                                            <td>
                            <form onsubmit="return confirm('Apakah Anda Yakin Menghapus ?');" action="{{ route('order.destroy', $row->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                            </form>
                        </td>                  
                            </tr>                                
                        @endforeach                                                           
                    </tbody>
                    </table>
                </div>
            </div>
        </div>     
    </div>    
</section>
@endsection