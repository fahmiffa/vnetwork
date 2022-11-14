@extends('layout.base')
@section('main')
<section class="section">    
        <div class="card card-body">     
            <div class="row">
                <div class="col-sm-12 col-md-6">                           
                        <div class="form-group">
                            <h4 class="card-title py-3">PAYMENT ORDER PORT DETAILS :</h4>                            
                            <!-- <div class="table-responsive"> -->
                                <table class="table table-bordered table-sm">                                             
                                    <tr>       
                                        <td class="font-weight-bold">Port</td>                                  
                                        <td>{{$order->port->port}}</td>
                                    </tr>                         
                                    <tr>
                                        <td class="font-weight-bold">Price + PPN 11%</td>
                                        <td>{{number_format($order->price, 0, ",", ".")}}</td>      
                                    </tr>                                                                                            
                                </table>
                            <!-- </div> -->
                        </div>

                        <div class="form-group d-none" id="res">
                            <!-- <div id="result-json"></div> -->
                            <!-- <div class="table-responsive"> -->
                                <table class="table table-bordered table-sm">                                             
                                    <tr>       
                                        <td class="font-weight-bold">Payment Type</td>                                  
                                        <td id="type"></td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Status</td>
                                        <td id="stat"></td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Guide</td>
                                        <td><a target="_blank" href="#" id="guide">Open</a></td>      
                                    </tr>                                                                             
                                </table>
                            <!-- </div> -->
                        </div>       

                        <div class="form-group">
                            <button class="btn btn-primary" id="pay-button">Payment</button>
                        </div>                                    
                </div>

            </div>
        </div>         
</section>

@push('js')
@if(env('APP_DEBUG'))
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
@else
<script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
@endif
    <script>
        const payButton = document.querySelector('#pay-button');
        payButton.addEventListener('click', function(e) {
            e.preventDefault();

            var element = document.getElementById("res");
                element.classList.remove("d-none");
 
            snap.pay('{{ $snapToken }}', {
                // Optional
                onSuccess: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log(result.payment_type);
                },
                // Optional
                onPending: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    // console.log(result);
                    document.getElementById('type').innerHTML = result.payment_type;
                    document.getElementById('stat').innerHTML = result.transaction_status;
                    document.getElementById('guide').href = result.pdf_url;
                },
                // Optional
                onError: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log(result)
                }

              
            });
        });
    </script>
@endpush
@endsection