<!-- resources/views/admin/dashboard.blade.php -->
@extends('customer.layouts.master')
@include('customer.layouts.sidebar')
@include('customer.layouts.headerMenu')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="crms-title row bg-white mb-4">
                <div class="col">
                    <h3 class="page-title">
                        <span class="page-title-icon bg-gradient-primary text-white me-2">
                            <i class="bi bi-table"></i>
                        </span> <span>Deals Dashboard Customer</span>
                    </h3>
                </div>
                <div class="col text-end">
                    <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                        <li class="breadcrumb-item"><a class="active" href=" index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Deals Dashboard</li>
                    </ul>
                </div>
            </div>

            <!-- /Page Header -->

            <div class="row graphs">
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title">Total Lead</h3>
                            <canvas id="pie-chart" width="800" height="450"></canvas>
                            <!-- <div id="circlechart"></div> -->
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title">Products Yearly Sales</h3>
                            <canvas id="bar-chart-horizontal" width="800" height="450"></canvas>		
                            <!-- <div id="secondgrap"></div>		 -->
                                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="row graphs">
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title">Sales Overview</h3>
                            <div id="line-charts"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">

                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title">Total Sales</h3>
                            <div id="chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row graphs">
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title">Yearly Projects</h3>
                            <canvas id="bar-chart" width="800" height="550"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title">Total Revenue</h3>
                            <div id="bar-charts"></div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row graphs">
                <div class="col-md-6 mb-0">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title">Sales Statistics</h3>
                            <canvas id="bar-chart-grouped" width="800" height="450"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-0">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title">Completed Tasks</h3>
                            <canvas id="mixed-chart" width="800" height="450"></canvas>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>    
@endsection
 
@section('script')
    	<!-- Chart JS -->
	<script src="{{asset('/assets/js/morris.js')}}"></script>
	<script src="{{asset('/assets/js/raphael.min.js')}}"></script>
	<script src="{{asset('/assets/js/chart.js')}}"></script>
	<script src="{{asset('/assets/js/linebar.min.js')}}"></script>
	<!-- <script src="{{asset('/assets/js/piechart.js')}}"></script> -->
	<script src="{{asset('/assets/js/resources/piechart.js')}}"></script> <!-- new -pr 16-7-25 -->
	<script src="{{asset('/assets/js/apex.min.js')}}"></script>
@endsection