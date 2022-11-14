@extends('user.base.layout')
@section('main')
<section class="section">
    <div class="section-header">
        <h1>{{$data}}</h1>        
        <a href="{{route('services')}}" class="btn btn-primary btn-sm ml-auto">Tambah Layanan</a>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table" id="tabel">
                        <thead>
                            <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama</th>    
                            <th scope="col">Service</th>           
                            <th scope="col">Price + <small>PPN {{ENV('PPN')}} %</small></th>     
                            <th scope="col">Status</th>         
                            <th scope="col">Payment</th>         
                            </tr>
                        </thead>
                        <tbody>                        
                            @foreach($da as $row)                                
                                <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$row->users->name}}</td>          
                                <td>{{$row->serv->name}}</td>                                        
                                <td>{{number_format($row->services->price+$row->services->price*ENV('PPN')/100, 0, ",", ".")}}</td>
                                <td>{!!status($row->status)!!}</td>      
                                <td><a href="{{route('payment',['id'=>$row->id])}}" class="btn btn-dark">Payment</a></td>                                
                                </tr>                                
                            @endforeach                                                           
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>     
        </div>
    </div>
</section>
@endsection