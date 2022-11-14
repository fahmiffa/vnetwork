@extends('layout.base')
@section('main')
<section class="section">
    <div class="pagetitle">
        <h1>{{$data}}</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title py-3">SCAN QRCODE NUMBER {{env('WA_NOMOR')}}</h5>       
                  <button class="btn btn-danger d-none mb-3" id="logout" onclick="logout({{env('WA_NOMOR')}})">Logout</button>
                  <div class="row">
                      <div class="col-sm-6">
                          <div id="log">
                              <h5>Logs:</h3>
                              <ul class="logs"></ul>
                          </div>                
                      </div>
                      <div class="col-sm-6">
                          <div id="done">
                              <p class="small">Silahkan Reload jika qrcode tidak muncul</p>
                              <img src="" alt="QR Code" id="qrcode">
                          </div>
        
                          <div id="test" class="d-none">
                              <form action="{{ route('send')}}" method="post" id="form" class="needs-validation" novalidate="">
                                  @csrf
                                  <div class="form-group">
                                      <input type="hidden" name="number" value="{{env('WA_NOMOR')}}">
                                      <label for="No">Number Handphone Receiver:</label>
                                      <small class="text-danger">format : 628xxx</small>
                                      <input type="number" class="form-control" placeholder="Enter Number Handphone" name="to" tabindex="1" required autofocus>
        
                                      <div class="invalid-feedback">
                                          Please fill in your Number
                                      </div>
                                  </div>
        
                                  <div class="form-group">
                                      <label for="No">Text:</label>            
                                      <input type="text" class="form-control" placeholder="Enter message" name="message" required>
        
                                      <div class="invalid-feedback">
                                          Please fill in your text
                                      </div>
                                  </div>
        
                                  
                                  <button type="submit" class="btn btn-primary">send</button>
                              </form>
                          </div>
                      </div>          
                  </div>
                </div>     
            </div>    
        </div>
    </div>

    
</section>


@push('js')
<script src="https://cdn.socket.io/4.4.1/socket.io.min.js"></script>
    <script>

            var socket = io('https://api.stiker-label.com', {
                withCredentials: true,
              });
            

            socket.emit('StartConnection','{{env('WA_NOMOR')}}');
            socket.on('message', function (msg) {

                console.log(msg);
                $('.logs').append($('<li>').text(msg));
            });

            socket.on('qr', function (src) {
                $('#qrcode').attr('src', src);
                $('#qrcode').show();
            });

            socket.on('ready', function (data) {               
                $('#qrcode').hide();
                $('#done').hide();
                $('#test').removeClass('d-none');
                $('#logout').removeClass('d-none');
            });

            function logout(device){
            socket.emit('LogoutDevice',device)
            }        

    </script>
@endpush
@endsection