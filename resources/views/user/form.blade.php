<form action="{{route('submit')}}" method="post">
@csrf
<div class="form-group">
    <label>Lokasi Server</label>
    <select name="serv" class="form-control selectpicker show-tick" title="Pilih Server" data-live-search="true" required>
        @foreach($server as $row)
        <option value="{{$row->id}}">{{$row->host}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <div class="input-group mb-1">
        <div class="input-group-prepend">
        <span class="input-group-text bg-secondary">Username {{env('APP_NAME')}} Client</span>
        </div>
        <input type="text" class="form-control" name="username" placeholder="Username" required>
    </div>  
    <div class="input-group">
        <div class="input-group-prepend">
        <span class="input-group-text bg-secondary">Password {{env('APP_NAME')}} Client</span>
        </div>
        <input type="password" class="form-control" name="password" placeholder="Password" required>
    </div>             
</div>

<div class="form-group">
    <button type="submit" class="btn btn-dark">Submit</button>
</div>

<div class="alert alert-danger">
    <p>PERINGATAN : Username dan Password {{env('APP_NAME')}} jangan samakan dengan username dan password mikrotik Anda</p>
</div>
</form>
