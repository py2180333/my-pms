<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from crms-html.dreamstechnologies.com/template/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 19 Jan 2024 05:01:56 GMT -->

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<meta name="description" content="CRMS - Bootstrap Admin Template">
	<meta name="keywords"
		content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
	<meta name="author" content="Dreamguys - Bootstrap Admin Template">
	<meta name="robots" content="noindex, nofollow">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>Dashboard - CRMS admin template</title>

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="{{asset('/assets/img/tqt/Q.png') }}">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{asset('/assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet"
		href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" />
	<!-- Fontawesome CSS -->
	<!-- <link rel="stylesheet" href="assets/css/Font-Awesomeall.min.css" /> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
	<!-- <link rel="stylesheet" href="assets/css/font-awesome.min.css"> -->
	<!-- Feathericon CSS -->
	<!-- <link rel="stylesheet" href="assets/css/feather.css"> -->

	<!--font style-->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@24.5.0/build/css/intlTelInput.css"> --}}
    {{-- <link rel="stylesheet" href="{{asset('/assets/css/intlTelInput.css')}}"/> --}}
	<!-- Lineawesome CSS -->
	<link rel="stylesheet" href="{{asset('/assets/css/line-awesome.min.css')}}">

	<!-- Select2 CSS -->
	<link rel="stylesheet" href="{{asset('/assets/css/select2.min.css')}}">

	<!-- Datetimepicker CSS -->
	<link rel="stylesheet" href="{{asset('/assets/css/bootstrap-datetimepicker.min.css')}}">

	<!-- Datatable CSS -->
	<link rel="stylesheet" href="{{asset('/assets/css/dataTables.bootstrap4.min.css')}}">

	<!-- Theme CSS -->
	<link rel="stylesheet" href="{{asset('/assets/css/theme-settings.css')}}">
	<!-- Main CSS -->
	<!-- <link rel="stylesheet" href="../assets/css/style.css" class="themecls"> -->
	<link rel="stylesheet" href="{{asset('/assets/css/style.css')}}">
	@yield('style')
</head>

<body>
	<!-- Main Wrapper -->
	<div class="main-wrapper">

		<!-- Header -->
		<div class="header" id="heading">

			<!-- Logo -->
			<div class="header-left">
				<a href=" index.html" class="logo">
					<img src="{{asset('/assets/img/tqt/theqt-logo.png')}}" alt="Logo" class="sidebar-logo">
					<img src="{{asset('/assets/img/tqt/Q.png')}}" alt="Logo" class="mini-sidebar-logo">
				</a>
			</div>
			<!-- /Logo -->

			<a id="toggle_btn" class="toggle-arrow" href="javascript:void(0);">
				<span class="bar-icon">
					<span></span>
					<span></span>
					<span></span>
				</span>
			</a>

			<a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>

			<!-- Header Menu -->
                @yield('headerMenu')
			
			<!-- /Header Menu -->

			<!-- Mobile Menu -->
			<div class="dropdown mobile-user-menu">
				<a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i
						class="fa fa-ellipsis-v"></i></a>
				<div class="dropdown-menu dropdown-menu-right">
					<a class="dropdown-item" href="{{asset('/template/profile.html')}}">My Profile</a>
					<a class="dropdown-item" href="{{asset('/setting/settings.html')}}">Settings</a>
					<a class="dropdown-item" href="../template/login.html">Logout</a>
				</div>
			</div>
			<!-- /Mobile Menu -->

		</div>
		<!-- /Header -->

	 <!-- Sidebar -->
     @yield('sidebar')
	 
	 <!-- /Sidebar -->

		<!-- Page Wrapper -->
        @yield('content')
		
		<!-- /Page Wrapper -->

	<!-- /Main Wrapper -->
	<!-- jQuery -->

	<script src="{{asset('/assets/js/jquery-3.6.0.min.js')}}"></script>
		
	<!-- number split -->
	
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"></script>

    {{-- <script src="{{asset('/assets/js/intlTelInput.min.js')}}"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@24.5.0/build/js/intlTelInput.min.js"></script> --}}
    

    <!-- Bootstrap Core JS -->
	<script src="{{asset('/assets/js/bootstrap.bundle.min.js')}}"></script>

	<!-- Slimscroll JS -->
	<script src="{{asset('/assets/js/jquery.slimscroll.min.js')}}"></script>

	<!-- Datatable JS -->
	<script src="{{asset('/assets/js/dataTables.min.js')}}"></script>
	{{-- <script src="{{asset('/assets/js/moment.min.js')}}"></script> --}}
	<script src="{{asset('/assets/js/dataTables.bootstrap4.min.js')}}"></script>

	<!-- new grap -->
	{{-- <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
	<script src="https://www.amcharts.com/lib/3/pie.js"></script>
	<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
	<script src="https://www.amcharts.com/lib/4/core.js"></script>
	<script src="https://www.amcharts.com/lib/4/charts.js"></script>
	<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script> --}}
	{{-- <script src="/template/js/my-grap.js"></script> --}}


	{{-- <script src="https://www.amcharts.com/lib/3/serial.js"></script> --}}
	<!-- theme JS -->
	<script src="{{asset('/assets/js/theme-settings.js')}}"></script>
	<!-- Include the CDN JavaScript file -->
    <script src="{{asset('/assets/js/currency.js')}}"></script>

	<!-- new pr 12-8-25 -->
	<!-- notification -->
	<script src="{{ asset('/assets/js/customer/notification.js') }}"></script>

	<!-- page based js files -->
	@yield('script')

	<!-- Custom JS -->
	<script src="{{asset('/assets/js/app.js')}}"></script>
	<script src="{{asset('/assets/js/select2.min.js')}}"></script>
	
</body>
</html>