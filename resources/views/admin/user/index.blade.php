@extends('layout.base')
@section('main')
<section class="section">
    <div class="row">
        <div class="col-12">
            <div class="card">  
                <div class="card-body">
                    <div class="d-flex justify-content-between py-3">
                        <div class="p-2">
                            <h5 class="card-title">{{$data}}</h5>
                        </div>
                        <div class="p-2">
                            <a href="{{route('user.create')}}" class="btn btn-primary btn-sm">Tambah Data</a>
                        </div>
                    </div>           
                    <table class="table dt-responsive nowrap" id="tabel">
                    <thead>
                        <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Nama</th>        
                        <th scope="col">HP</th>     
                        <th scope="col">Email</th>         
                        <th scope="col">Level</th>         
                        <th scope="col">Action</th>            
                        </tr>
                    </thead>
                    <tbody>                        
                        @foreach($da as $row)       
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$row->name}}</td>   
                                <td>{{$row->hp}}</td>                    
                                <td>{{$row->email}}</td>     
                                <td>{{$row->level}}</td>     
                                <td>
                                        <form onsubmit="return confirm('Apakah Anda Yakin Menghapus ?');" action="{{ route('user.destroy', $row->id) }}" method="POST">
                                            <a href="{{ route('user.edit', $row->id) }}" class="btn btn-sm btn-primary">EDIT</a>
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