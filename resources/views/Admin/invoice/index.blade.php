@extends('Admin.layouts.master')
@include('Admin.layouts.sidebar')
@include('Admin.layouts.headerMenu')
@section('style')
<link rel="stylesheet" href="{{asset('/assets/multi-calendar/dist/daterangepicker.min.css')}}"/> <!-- pr -->

<link rel="stylesheet" href="{{asset('/assets/css/vit-template.css')}}">
<link rel="stylesheet" href="{{asset('/assets/css/vivak_fzco.css')}}">

    <style>
				.rs-popup-view{
			max-width: 100% !important;
			width:1100px !important ;
			}
			/* invoice template */


			:root {
				--theme-color: #2D7CFE;
				--title-color: #111111;
				--body-color: #6E6E6E;
				--smoke-color: #f3f3f3;
				--smoke-dark: #E1ECFF;
				--black-color: #000000;
				--white-color: #ffffff;
				--light-color: #72849B;
				--border-color: #E3E3E3;
				--title-font: 'Inter', sans-serif;
				--body-font: 'Inter', sans-serif;
				--main-container: 1380px;
				--container-gutters: 24px;
				--section-space: 50px;
				--section-title-space: 70px;
				--ripple-ani-duration: 5s
			}
			.invoice-font{
				font-size: 14px;
			}
			ol {
				list-style-type: decimal
			}
			
			table.table-style9{
				margin: 0 0 1.5em;
				width: 100%;
				border-collapse: collapse;
				border-spacing: 0;
				border: 1px solid var(--border-color)
			}
			
			table.table-style9 th {
				font-weight: 700;
				color: var(--title-color)
			}
			
			table.table-style9 td,
			th {
				/ border: 1px solid var(--border-color); /
				padding: 9px 20px
			}
			
			
			.invoice-container {
				width: 880px;
				padding: 20px 15px;
				margin: 15px auto;
				position: relative;
				z-index: 5
			}
			
			.invoice-container-wrap {
				overflow: auto;
				
			}
			
			
			.tqt-invoice {
				position: relative;
				z-index: 4;
				background-color: var(--white-color)
			}
			
			.tqt-invoice .download-inner {
				padding: 50px
			}
			
			.tqt-invoice b {
				color: var(--title-color)
			}
			
			.tqt-invoice .big-title {
				font-size: 44px;
				margin-bottom: 0;
				text-align: right
			}
			
			.tqt-invoice address {
				margin-bottom: 0
			}
			
			.invoice-table {
				border: none;
				margin-bottom: 25px
			}
			
			.invoice-table th {
				color: var(--title-color)
			}
			
			.invoice-table td,
			.invoice-table th {
				padding: 11px 20px;
				border: none
			}
			
			.invoice-table td:last-child,
			.invoice-table th:last-child {
				text-align: right
			}
			
			.invoice-table tr {
				border-bottom: 1px solid var(--border-color);
				position: relative
			}
			
			.invoice-table thead td,
			.invoice-table thead th {
				background-color: var(--smoke-dark)
			}
			
			.invoice-table thead td:first-child,
			.invoice-table thead th:first-child {
				border-radius: 0
			}
			
			.invoice-table thead td:last-child,
			.invoice-table thead th:last-child {
				border-radius: 0
			}
			
			.invoice-table thead tr {
				border-bottom: none
			}
			
			.total-table {
				border: none;
				margin-bottom: 0;
				margin-top: -4px
			}
			
			.total-table td,
			.total-table th {
				border: none;
				padding: 4px 20px
			}
			
			.total-table td:nth-child(2),
			.total-table th:nth-child(2) {
				text-align: right
			}
			
			.total-table tr:last-child {
				border-top: 1px solid var(--border-color)
			}
			
			.total-table tr:last-child td,
			.total-table tr:last-child th {
				padding: 15px 20px
			}
			
			.total-table tr:nth-last-child(2) td,
			.total-table tr:nth-last-child(2) th {
				padding: 4px 20px 16px 20px
			}
			
			hr.style1 {
				margin-top: 24px;
				margin-bottom: 24px;
				background-color: var(--border-color);
				opacity: 1
			}
			
			.table-title {
				font-size: 16px;
				margin-bottom: 7px
			}
			
			.text-title {
				color: var(--title-color);
				font-weight: 500
			}
			
			.invoice-note {
				border-top: 1px solid var(--border-color);
				border-bottom: 1px solid var(--border-color);
				padding-top: 15px;
				padding-bottom: 15px;
				text-align: center
			}
			
			.invoice-note svg {
				margin-right: 5px;
				margin-top: -3px
			}
			
			.invoice-note b {
				margin-right: 5px
			}
			
			.invoice-buttons {
				display: -webkit-box;
				display: -webkit-flex;
				display: -ms-flexbox;
				display: flex;
				-webkit-box-align: center;
				-webkit-align-items: center;
				-ms-flex-align: center;
				align-items: center;
				-webkit-box-pack: center;
				-webkit-justify-content: center;
				-ms-flex-pack: center;
				justify-content: center;
				gap: 3px;
				padding: 3px;
				overflow: hidden;
				margin-top: 12px;
				position: relative;
				top: -50px;
				background-color: var(--white-color);
				box-shadow: 0 0 15px rgba(119, 119, 119, .25);
				border-radius: 10px;
				max-width: 129px;
				margin-left: auto;
				margin-right: auto
			}
			
			.invoice-buttons a,
			.invoice-buttons button {
				border: none;
				height: 40px;
				width: 60px;
				line-height: 37px;
				text-align: center;
				background-color: #cfffea;
				border-radius: 7px 0 0 7px;
				-webkit-transition: .3s ease-in-out;
				transition: .3s ease-in-out
			}
			
			.invoice-buttons a svg path,
			.invoice-buttons button svg path {
				-webkit-transition: .3s ease-in-out;
				transition: .3s ease-in-out
			}
			
			.invoice-buttons a:hover,
			.invoice-buttons button:hover {
				background-color: #00c764
			}
			
			.invoice-buttons a:hover svg path,
			.invoice-buttons button:hover svg path {
				fill: #fff
			}
			
			.invoice-buttons .download_btn {
				background-color: #2250b0;
				border-radius: 0 7px 7px 0
			}
			
			.invoice-buttons .download_btn:hover {
				background-color: var(--theme-color)
			}
			
			
			table.table-style9 thead tr th {
				background-color: #2250b0;
			}
			.invoice_style1 {
				padding-bottom: 1px
			}
			
			.invoice-number {
				margin-bottom: 0
			}
			
			.invoice-date {
				margin-bottom: 0
			}
			
			.invoice_style1 .invoice-note {
				position: relative;
				z-index: 2;
				margin-bottom: 0;
				border-top: none;
				border-bottom: none;
				padding-top: 0;
				padding-bottom: 0;
				text-align: left
			}
			
			.invoice_style1 .invoice-note:before {
				content: '';
				height: 30px;
				width: 77px;
				background-color: var(--smoke-color);
				position: absolute;
				top: -4px;
				left: -50px;
				border-radius: 0 99px 99px 0;
				z-index: -1
			}
			
			.invoice_style1 .invoice-note svg {
				margin-right: 24px
			}
			
			.invoice_style1 .invoice-buttons {
				margin-bottom: 16px;
				margin-top: 30px
			}
			
			.invoice_style2 .invoice-note {
				padding-top: 0;
				padding-bottom: 0;
				border-top: none;
				border-bottom: 1px solid var(--border-color);
				padding-bottom: 20px;
				margin-bottom: 20px;
				margin-top: 20px
			}
			
			.invoice_style2 .invoice-table td:nth-child(2),
			.invoice_style2 .invoice-table th:nth-child(2) {
				text-align: center
			}
			
			.address-left {
				border-right: none;
				border-radius: 10px 0 0 10px
			}
			
			.invoice_style3 {
				padding-bottom: 30px
			}
			
			.invoice_style3 .big-title {
				font-size: 40px
			}
			
			.header-layout4 {
				border-bottom: 1px solid var(--border-color);
				padding-bottom: 25px;
				margin-bottom: 25px
			}
			
			.header-layout4 .big-title {
				font-size: 24px;
				margin-bottom: 5px
			}
			
			.header-layout4 span {
				display: block;
				text-align: right
			}
			
			.table-style1 {
				border: 1px solid var(--smoke-color);
				margin-top: -10px
			}
			
			.table-style1 tr td,
			.table-style1 tr th {
				text-align: left !important;
				border-radius: 0 !important;
				border-bottom: 1px solid var(--smoke-color);
				width: 32.9%
			}
			
			.table-style1 thead td,
			.table-style1 thead th {
				border-right: 1px solid var(--border-color)
			}
			
			.table-style1 thead td:last-child,
			.table-style1 thead th:last-child {
				border-right: none
			}
			
			.table-style2 b,
			.table-style2 th {
				font-weight: 600
			}
			
			.table-style2 td,
			.table-style2 th {
				border-radius: 0 !important;
				border-right: 1px solid var(--smoke-color);
				padding: 4px 20px
			}
			
			.table-style2 td:first-child,
			.table-style2 th:first-child {
				border-left: 1px solid var(--smoke-color)
			}
			
			.table-style2 td {
				font-size: 12px
			}
			
			.table-style2 td:last-child {
				text-align: left
			}
			
			.table-style2 tr {
				border-bottom: none
			}
			
			.table-style2 tr:last-child {
				border-bottom: 1px solid var(--smoke-color)
			}
			
			.table-style2 tr:last-child td,
			.table-style2 tr:last-child th {
				padding-bottom: 15px
			}
			
			.table-style2 tr:first-child {
				border-top: 1px solid var(--smoke-color)
			}
			
			.table-style2 tr:first-child td,
			.table-style2 tr:first-child th {
				padding-top: 15px
			}
			
			.total-table2 {
				border: none
			}
			
			.total-table2 td,
			.total-table2 th {
				border: none;
				padding: 5px 20px
			}
			
			.total-table2 td:last-child,
			.total-table2 th:last-child {
				text-align: right
			}
			
			.invoice_style7 .address-left {
				border-right: none;
				border-radius: 0
			}
			
			.invoice_style7 .table2 {
				margin-top: 30px
			}
			
			.header-layout5 {
				margin-bottom: 25px
			}
			
			.header-layout5 .big-title {
				font-size: 24px;
				margin-bottom: 6px
			}
			
			.header-layout5 span {
				display: block;
				text-align: right
			}
			
			.table-style3 {
				border: 1px solid var(--smoke-color)
			}
			
			.table-style3 tr {
				border-bottom: 1px solid var(--smoke-color)
			}
			
			.table-style3 tr:nth-child(odd) td,
			.table-style3 tr:nth-child(odd) th {
				background-color: var(--smoke-color)
			}
			
			.table-style3 td,
			.table-style3 th {
				border-right: 1px solid var(--border-color);
				width: 27%;
				padding: 11px
			}
			
			.table-style3 td:last-child,
			.table-style3 th:last-child {
				border-right: none;
				text-align: left
			}
			
			.table-style3 td:first-child,
			.table-style3 th:first-child {
				width: 19%
			}
			
			.header-layout6 {
				margin-bottom: 30px
			}
			
			.header-layout6 .big-title {
				font-size: 24px;
				margin-bottom: 6px
			}
			
			.table-style4 {
				border: 1px solid var(--smoke-color)
			}
			
			.table-style4 thead tr {
				border-bottom: 1px solid var(--smoke-dark)
			}
			
			.table-style4 thead th {
				border-radius: 0 !important
			}
			
			.table-style4 tr {
				border-bottom: none
			}
			
			.table-style4 td,
			.table-style4 th {
				text-align: center;
				border-right: 1px solid var(--border-color);
				width: 21%
			}
			
			.table-style4 td:last-child,
			.table-style4 th:last-child {
				border-right: none;
				text-align: center
			}
			
			.table-style4 td:first-child,
			.table-style4 th:first-child {
				width: 37%
			}
			
			.invoice_style9 {
				padding-bottom: 15px
			}
			
			.header-layout7 {
				margin-bottom: 48px
			}
			
			.header-layout7 .big-title {
				font-size: 24px;
				margin-bottom: 6px
			}
			
			.header-layout7 span {
				display: block;
				text-align: right
			}
			
			.invoice_style10 .header-layout7 {
				padding-right: 65px
			}
			
			.table-style5 {
				border: 1px solid var(--smoke-color)
			}
			
			.table-style5 thead td,
			.table-style5 thead th {
				background-color: var(--smoke-dark)
			}
			
			.table-style5 thead td:first-child,
			.table-style5 thead th:first-child {
				border-radius: 0
			}
			
			.table-style5 thead td:last-child,
			.table-style5 thead th:last-child {
				border-radius: 0
			}
			
			.table-style5 td,
			.table-style5 th {
				border-right: 1px solid var(--smoke-color)
			}
			
			.table-style5 td:first-child,
			.table-style5 th:first-child {
				width: 55%
			}
			
			.table-style5 td:last-child,
			.table-style5 th:last-child {
				border-right: none
			}
			
			.table-style5 tr {
				border-bottom: none;
				border-top: 1px solid var(--smoke-color)
			}
			
			.table-style5 tr:last-child {
				background-color: var(--smoke-color)
			}
			
			.table-style5 tr:last-child td {
				text-align: right
			}
			
			.table-style5 tr:last-child td:first-child {
				padding-right: 0
			}
			
			.header-layout8 .big-title {
				font-size: 40px;
				text-transform: uppercase;
				margin-bottom: 0
			}
			
			.header-layout10 .big-title {
				font-size: 40px;
				text-transform: uppercase;
				margin-bottom: 6px
			}
			
			.header-layout10 span {
				display: block;
				text-align: right
			}
			
			.table-style6 {
				border: 1px solid var(--smoke-color)
			}
			
			.table-style6 tr {
				border-top: 1px solid var(--smoke-color);
				border-bottom: none
			}
			
			.table-style6 tr:nth-child(odd) {
				background-color: var(--smoke-color)
			}
			
			.table-style6 td,
			.table-style6 th {
				border-right: 1px solid var(--border-color);
				width: 25%
			}
			
			.table-style6 td:last-child,
			.table-style6 th:last-child {
				text-align: left;
				border-right: none
			}
			
			.table-style7 {
				border: 1px solid var(--smoke-color)
			}
			
			.table-style7 tr {
				border-bottom: none
			}
			
			.table-style7 tr:nth-child(odd) td {
				background-color: var(--smoke-color)
			}
			
			.table-style7 td {
				border-right: 1px solid var(--border-color);
				width: 50%
			}
			
			.table-style7 td:last-child {
				border-right: none;
				text-align: left
			}
			
			.invoice_style14 {
				padding-bottom: 30px
			}
			
			.invoice_style15 {
				padding-bottom: 15px
			}
			
			.header-layout11 {
				padding-top: 20px;
				padding-bottom: 20px;
				margin-bottom: 45px
			}
			
			.header-layout11 .big-title {
				font-size: 24px;
				text-transform: uppercase;
				margin-bottom: 6px
			}
			
			.header-layout11 span {
				display: block;
				text-align: right
			}
			
			.table-style8 {
				border: 1px solid #e7e9ed
			}
			
			.table-style8 tr {
				border-bottom: 1px solid #e7e9ed
			}
			
			.table-style8 td,
			.table-style8 th {
				border-right: 1px solid #e7e9ed;
				padding: 11px 15px
			}
			
			.table-style8 td:last-child,
			.table-style8 th:last-child {
				text-align: left;
				border-right: none
			}
			
			.header-layout12 .big-title {
				font-size: 24px;
				text-transform: uppercase;
				margin-bottom: 6px
			}
			
			.header-layout12 span {
				display: block;
				text-align: right
			}
			
			.invoice_style19 .total-table2 {
				margin-bottom: 8px
			}
			
			hr.style2 {
				margin-top: 8px;
				margin-bottom: 12px;
				background-color: var(--border-color);
				opacity: 1
			}
			
			.table-style9 {
				border: 1px solid var(--smoke-color)
			}
			
			.table-style9 thead td,
			.table-style9 thead th {
				background-color: var(--smoke-dark)
			}
			
			.table-style9 thead td:first-child,
			.table-style9 thead th:first-child {
				border-radius: 0
			}
			
			.table-style9 thead td:last-child,
			.table-style9 thead th:last-child {
				border-radius: 0
			}
			
			.table-style9 tr {
				border-bottom: none;
				border-top: 1px solid var(--smoke-color)
			}
			
			.table-style9 td,
			.table-style9 th {
				border-right: 1px solid var(--smoke-color)
			}
			
			.table-style9 td:last-child,
			.table-style9 th:last-child {
				border-right: none
			}
			
			.header-layout13 .big-title {
				font-size: 40px;
				text-transform: uppercase;
				margin-bottom: 0
			}
			
			hr.style3 {
				margin: 9px 0;
				background-color: var(--border-color);
				opacity: 1
			}
			
			[dir=rtl] .invoice-buttons {
				-webkit-box-orient: horizontal;
				-webkit-box-direction: reverse;
				-webkit-flex-direction: row-reverse;
				-ms-flex-direction: row-reverse;
				flex-direction: row-reverse
			}
			
			[dir=rtl] .invoice-buttons button svg {
				margin-left: 6px;
				margin-right: 0
			}
			
			[dir=rtl] .header-layout12 .big-title {
				text-align: left;
				font-size: 40px
			}
			
			[dir=rtl] .header-layout12 span {
				text-align: left
			}
			
			[dir=rtl] .table-style9 td:last-child,
			[dir=rtl] .table-style9 th:last-child {
				border-right: 1px solid var(--smoke-color);
				text-align: left
			}
			
			[dir=rtl] .total-table2 td:last-child,
			[dir=rtl] .total-table2 th:last-child {
				text-align: left
			}
			
			.header-logo img {
				width: 150px
			}	
			table.table-style9 thead tr th {
				font-size: 14px;
			}

			@media print {
				.invoice-buttons {
					display: none !important;
				}
			
				.tqt-invoice .download-inner {
					padding: 20px;
				}
			
				.invoice-container {
					width: 100%;
					max-width: 880px;
					padding: 0px 0px !important;
					margin:0;
				}
				.invoice-container-wrap {
					overflow-x: hidden;
				}
			
				table.table-style9 thead tr th {
					background-color: #2250b0 !important;
					-webkit-print-color-adjust: exact;
					color-adjust: exact; 
				}
				hr.style3 {
					margin: 9px 0;
					background-color: var(--border-color);
					opacity: 1;
					-webkit-print-color-adjust: exact;
					color-adjust: exact; 
				}
			}
			/* 30/06/2025 in public\assets\css\style.css .paid, .pending */
			.paid{
				background: #2250b0 !important;
			}
			.pending{
				background:chocolate;
			}
			.filter-data .multipleSelection{
				margin: 10px 0 10px 0;
			}
			
    </style>
@endsection
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <div class="crms-title row bg-white">
                <div class="col  p-0">
                    <h3 class="page-title m-0">
                        <span class="page-title-icon bg-gradient-primary text-white me-2">
                            <i class="fa fa-file" aria-hidden="true"></i>
                        </span> Invoice
                    </h3>
                </div>
                <div class="col p-0 text-end">
                    <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Invoice</li>
                    </ul>
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col">
                    @if(session('success'))
                        <div class="alert alert-success" id="success-alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger" id="error-alert">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="col-auto py-3">
                    <a href="invoices.html" class="invoices-links active">
                        <i data-feather="list"></i>
                    </a>
                    <a href="invoice-grid.html" class="invoices-links">
                        <i data-feather="grid"></i>
                    </a>
                </div>
            </div>
            <div class="row">

                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card inovices-card">
                        <div class="card-body">
                            <div class="inovices-widget-header">
                                <span class="inovices-widget-icon">
                                    <img src="{{asset('/assets/img/invoices-icon1.svg')}}" alt="">
                                </span>
                                <div class="inovices-dash-count">
                                    <div class="inovices-amount" id="allInvoice">-</div>
                                </div>
                            </div>
                            <p class="inovices-all">All Invoices <span></span></p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card inovices-card">
                        <div class="card-body">
                            <div class="inovices-widget-header">
                                <span class="inovices-widget-icon">
                                    <img src="{{asset('/assets/img/invoices-icon2.svg')}}" alt="">
                                </span>
                                <div class="inovices-dash-count">
                                    <div class="inovices-amount" id="paidInvoice">-</div>
                                </div>
                            </div>
                            <p class="inovices-all">Paid Invoices <span></span></p>
                        </div>
                    </div>
                </div>

				<div class="col-xl-3 col-sm-6 col-12">
                    <div class="card inovices-card">
                        <div class="card-body">
                            <div class="inovices-widget-header">
                                <span class="inovices-widget-icon">
                                    <img src="{{asset('/assets/img/invoices-icon1.svg')}}" alt="">
                                </span>
                                <div class="inovices-dash-count">
                                    <div class="inovices-amount" id="overdueInvoice">-</div>
                                </div>
                            </div>
                            <p class="inovices-all">Overdue Invoices <span></span></p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card inovices-card">
                        <div class="card-body">
                            <div class="inovices-widget-header">
                                <span class="inovices-widget-icon">
                                    <img src="{{asset('assets/img/invoices-icon3.svg')}}" alt="">
                                </span>
                                <div class="inovices-dash-count">
                                    <div class="inovices-amount" id="pendingInvoice">-</div>
                                </div>
                            </div>
                            <p class="inovices-all">Pending Invoices <span></span></p>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Report Filter -->
            <div class="crms-title row bg-white align-items-center" style="margin-bottom:20px;">
                <div class="col-md-9 align-items-center">
                    <ul class="d-flex justify-content-start align-items-center gap-2 p-0 filter-data mb-0 m-0 list-unstyled">
                        <!-- Company Filter -->
                        <li>
                            <div class="multipleSelection m-0">
                                <select id="company-filter" class="form-select">
                                    <option value="all" selected>All Companies</option>
                                    @foreach ($companys as $company)
                                        <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </li>
                
                        <!-- Status Filter -->
                        <li>
                            <div class="multipleSelection m-0">
                                <select id="status-filter" class="form-select">
                                    <option value="all" selected>All Status</option>
                                    <option value="paid">Paid</option>
                                    <option value="overdue">Overdue</option>
                                    <option value="pending">Pending</option>
                                </select>
                            </div>
                        </li>
                
                        <!-- Invoice Type Filter -->
                        <li>
                            <div class="multipleSelection m-0">
                                <select id="invoice-type-filter" class="form-select">
                                    <option value="all" selected>All Invoices</option>
                                    <option value="milestone">Milestone Based</option>
                                    <option value="custom">Custom Based</option>
                                </select>
                            </div>
                        </li>

						<!-- Date Range -pr -->
						<div id="date-inputs" class="d-flex align-items-center gap-2">
							<span style="font-size: 16px;">From</span>
							<input id="start-date" class="form-control form-control-sm rs-att-date"  readonly placeholder="Start Date">
							<span style="font-size: 16px;">To</span>
							<input id="end-date" class="form-control form-control-sm rs-att-date" readonly placeholder="End Date">
							<button id="clear" class="btn btn-sm btn-outline-secondary rs-clear-btn">Clear</button>
						</div>
                    </ul>
                </div>
                <div class="col-md-3 text-end">
                    <a class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn"  href="{{route('admin.invoice.create')}}">New Invoice</a>
                </div>
            </div>
            <div class="card report-card">
                <div class="card-body pb-0">
                    <div class="table-responsive">
                                                
                        <!-- Table -->
                        <table class="table table-striped table-nowrap custom-table mb-0 datatable mydata-table invoicesearch">
                            <thead class="thead-light">
                                <tr>
									<th class="text-center">Sr.</th>
                                    <th class="text-center">Invoice No</th>
                                    <th class="text-center">Created On</th>
                                    <th class="text-center">Invoice To</th>
                                    <th class="text-center">Amount</th>
                                    <th class="text-center">Due date</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="invoice-data" class="text-center">
                                <!-- Dynamic rows will be appended here -->
                            </tbody>
                        </table>
                            {{-- </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
    </div>
    <!-- /Page Wrapper -->
    <!-- edit invoice -->
	<div class="modal right fade" id="edit-form-invoice" tabindex="-1" role="dialog" aria-modal="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title text-center">Edit Invoice</h4>
					<button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">
					<!-- Content Starts -->
					<div class="row mt-4">
						<div class="col-md-12">
							<form method="POST" id="edit-customer-form">
								@csrf
								@method('PATCH') <!-- Use PATCH for updating -->
								<h3>Invoice Details</h3>
								<div class="form-group row">
									<div class="col-md-6">
										<label class="col-form-label">status<span class="text-danger">*</span></label>
										<select class="form-control js-states single" name="status">
											<option value="paid">Paid</option>
											<option value="pending">Pending</option>
											<option value="overdue">Overdue</option>
										</select>
									</div>
									<div class="py-3">
										<button type="submit"
											class="border-0 btn btn-primary btn-gradient-primary btn-rounded">Update
											Invoice</button>&nbsp;&nbsp;
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- /Content End -->
				</div>
			</div>
			<!-- modal-content -->
		</div>
	</div>
	<!-- edit invoice -->
    
    <!-- view invoice pr change 17-9-25 -->
    	@include('components.invoice.modal')
    <!-- end invoice view -->
	
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script src="{{asset('/assets/js/invoiceview.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.16.0/moment.min.js" type="text/javascript"></script> <!-- pr -->
<script src="{{asset('/assets/multi-calendar/src/jquery.daterangepicker.js')}}"></script> <!-- pr -->
<!-- pr -->
<script>
    $(function()
    {
        $('#date-inputs').dateRangePicker(
        {
            autoClose: true,
            separator : ' to ',
            getValue: function()
            {
                if ($('#start-date').val() && $('#end-date').val() )
                    return $('#start-date').val() + ' to ' + $('#end-date').val();
                else
                    return '';
            },
            setValue: function(s,s1,s2)
            {
                $('#start-date').val(s1);
                $('#end-date').val(s2).trigger('customDateChanged');
            }
        });

        $('#clear').click(function(evt)
        {
            evt.stopPropagation();
            $('#date-inputs').data('dateRangePicker').clear();
        });
    });
</script>
@endsection