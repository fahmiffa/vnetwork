@extends('layout.base')
@section('main')
<div class="pagetitle">
    <h1>Dashboard</h1>
</div>

@php
$on = 0;
$off = 0;
@endphp
@foreach($or as $row)
@php
$on += $row->statusOn;
$off += $row->statusOff;
@endphp
@endforeach
<section class="section dashboard">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-4">
                <div class="card info-card sales-card">

                <div class="card-body">
                    <h5 class="card-title py-3">Pembelian</h5>

                    <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                        <h6>{{$or->count()}}</h6>                        
                    </div>
                    </div>
                </div>

                </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-4">
                <div class="card info-card revenue-card">

                <div class="card-body">
                    <h5 class="card-title py-3">Service ON</h5>

                    <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="ri-navigation-fill"></i>
                    </div>
                    <div class="ps-3">
                        <h6>{{$on}}</h6>                        
                    </div>
                    </div>
                </div>

                </div>
            </div><!-- End Revenue Card -->


            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-4">
                <div class="card info-card customers-card">

                <div class="card-body">
                    <h5 class="card-title py-3">Service OFF</h5>

                    <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="ri-navigation-fill"></i>
                    </div>
                    <div class="ps-3">
                        <h6>{{$off}}</h6>                        
                    </div>
                    </div>
                </div>

                </div>
            </div><!-- End Revenue Card -->

            </div>
        </div><!-- End Left side columns -->
    <!-- Right side columns -->
    </div>

    <div class="h-100 py-5"></div>
</section>
@endsection