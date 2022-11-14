@extends('layout.base')
@section('main')
<div class="pagetitle">
    <h1>Dashboard</h1>
</div>

<section class="section dashboard">
    <div class="row">

    <!-- Left side columns -->
    <div class="col-lg-8">
        <div class="row">

        <!-- Sales Card -->
        <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">

            <div class="card-body">
                <h5 class="card-title py-3">Sales</h5>

                <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-cart"></i>
                </div>
                <div class="ps-3">
                    <h6>{{$order->count()}}</h6>                    
                </div>
                </div>
            </div>

            </div>
        </div><!-- End Sales Card -->

        <!-- Revenue Card -->
        <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card">

            <div class="card-body">
                <h5 class="card-title py-3">Revenue</h5>

                <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-currency-dollar"></i>
                </div>
                <div class="ps-3">
                    @php
                    $sum = 0;
                    @endphp
                    @foreach($order as $row)
                    @php
                    if($row->status == 2)
                    {
                    $sum += $row->netto;
                    }
                    @endphp
                    @endforeach
                    <h6>{{"Rp. " .number_format($sum, 0, ",", ".")}}</h6>         

                </div>
                </div>
            </div>

            </div>
        </div><!-- End Revenue Card -->

        <!-- Customers Card -->
        <div class="col-xxl-4 col-xl-12">

            <div class="card info-card customers-card">

            <div class="card-body">
                <h5 class="card-title py-3">Customers</h5>

                <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                </div>
                <div class="ps-3">
                    <h6>{{$user->count()}}</h6>                    

                </div>
                </div>

            </div>
            </div>

        </div><!-- End Customers Card -->

        </div>
    </div><!-- End Left side columns -->

    <!-- Right side columns -->
    </div>
</section>
@endsection