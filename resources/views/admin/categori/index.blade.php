@extends('admin.base.layout')
@section('main')
<section class="section">
    <div class="section-header">
        <h1>{{$data}}</h1>
        <a href="{{route('categori.create')}}" class="btn btn-primary btn-sm ml-auto">Tambah Data</a>
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
                            <th scope="col">Action</th>            
                            </tr>
                        </thead>
                        <tbody>                        
                            @foreach($da as $row)                                
                                <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$row->name}}</td>                                                   
                                <td>
                                <form onsubmit="return confirm('Apakah Anda Yakin Menghapus ?');" action="{{ route('categori.destroy', $row->id) }}" method="POST">
                                    <a href="{{ route('categori.edit', $row->id) }}" class="btn btn-sm btn-primary">EDIT</a>
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
    </div>
</section>
@endsection