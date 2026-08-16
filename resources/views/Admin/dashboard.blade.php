<!-- resources/views/admin/dashboard.blade.php -->
@extends('Admin.layouts.master')
@include('Admin.layouts.sidebar')
@include('Admin.layouts.headerMenu')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="crms-title row bg-white mb-4">
                <div class="col">
                    <h3 class="page-title">
                        <span class="page-title-icon bg-gradient-primary text-white me-2">
                            <i class="bi bi-table"></i>
                        </span> <span>Deals Dashboard</span>
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

            <!-- show dorpdown filter -pr -->
            <div class="d-flex flex-wrap align-items-center gap-2 mb-4">

                <!-- Company Filter -->
                <select id="company-filter-dashboard" class="form-select form-select-sm w-auto">
                    <option value="all" selected>All Companies</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                    @endforeach
                </select>

            </div>
            <!-- /show dorpdown filter -pr -->

            <div class="row graphs">
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title">Total Projects: <sapn id="allProjects">-</sapn> </h3>
                            <canvas id="pie-chart" width="800" height="450"></canvas>
                            <!-- <div id="circlechart"></div> -->
                        </div>
                    </div>
                </div>
                <!-- new pr 25-7-25 -->
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title">Total Invoices: <sapn id="allInvoices">-</sapn> </h3>
                            <canvas id="pie-chart-invoice" width="800" height="450"></canvas>
                        </div>
                    </div>
                </div>
                <!-- new pr 25-7-25 -->
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <!-- new pr 28-7-25 -->
                            <h3 class="card-title">Total Resources: <sapn id="allresources">-</sapn> </h3>
                            <!-- <h3 class="card-title">Total Active Resources: <sapn id="allActive">-</sapn> </h3>
                            <canvas id="pie-chart-resource-active" width="800" height="450"></canvas>
                            <h3 class="card-title">Total Inactive Resources: <sapn id="allInactive">-</sapn> </h3>
                            <canvas id="pie-chart-resource-inactive" width="800" height="450"></canvas> -->
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="card-title">Active: <sapn id="allActive">-</sapn> </h3>
                                    <canvas id="pie-chart-resource-active" width="400" height="225"></canvas>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="card-title">Inactive: <sapn id="allInactive">-</sapn> </h3>
                                    <canvas id="pie-chart-resource-inactive" width="400" height="225"></canvas>
                                </div>
                            </div>
                            <!-- /new pr 28-7-25 -->
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title">Project Count</h3>
                            <canvas id="bar-chart-horizontal" width="800" height="450"></canvas>
                            <!-- <div id="secondgrap"></div> -->
                                            
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
	<script src="{{asset('/assets/js/piechart.js')}}"></script>
	<script src="{{asset('/assets/js/apex.min.js')}}"></script>
@endsection