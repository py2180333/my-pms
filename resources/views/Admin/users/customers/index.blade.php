
@extends('Admin.layouts.master')
@include('Admin.layouts.sidebar')
@include('Admin.layouts.headerMenu')
@section('content')
      <!-- Page Wrapper -->
    <div class="page-wrapper">
            <!-- Page Content -->
        <div class="content container-fluid">

                <div class="crms-title row bg-white">
                    <div class="col  p-0">
                        <h3 class="page-title m-0">
                            <span class="page-title-icon bg-gradient-primary text-white me-2">
                                <i class="bi bi-grid"></i>
                            </span> All Customer
                        </h3>
                    </div>
                    
                    <div class="col p-0 text-end">
                        <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.users.customers.index')}}">Customers Dashboard</a></li>
                        </ul>
                    </div>
                </div>

                <!-- show count data -pr -->
                <div class="row mt-4">
                    <div class="col-xl-4 col-sm-6 col-12">
                        <div class="card inovices-card">
                            <div class="card-body">
                                <div class="inovices-widget-header">
                                    <span class="inovices-widget-icon">
                                        <img src="{{asset('/assets/img/invoices-icon1.svg')}}" alt="">
                                    </span>
                                    <div class="inovices-dash-count">
                                        <div class="inovices-amount" id="allCustomers">-</div>
                                    </div>
                                </div>
                                <p class="inovices-all">All Customers <span></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6 col-12">
                        <div class="card inovices-card">
                            <div class="card-body">
                                <div class="inovices-widget-header">
                                    <span class="inovices-widget-icon">
                                        <img src="{{asset('/assets/img/invoices-icon2.svg')}}" alt="">
                                    </span>
                                    <div class="inovices-dash-count">
                                        <div class="inovices-amount" id="active">-</div>
                                    </div>
                                </div>
                                <p class="inovices-all">Active <span></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6 col-12">
                        <div class="card inovices-card">
                            <div class="card-body">
                                <div class="inovices-widget-header">
                                    <span class="inovices-widget-icon">
                                        <img src="{{asset('assets/img/invoices-icon3.svg')}}" alt="">
                                    </span>
                                    <div class="inovices-dash-count">
                                        <div class="inovices-amount" id="inactive">-</div>
                                    </div>
                                </div>
                                <p class="inovices-all">Inactive <span></span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /show count data -pr -->

            <!-- Page Header -->
        <div class="page-header pt-3 mb-0 ">
            <div class="crms-title row bg-white mb-4">
                <div class="col-md-4">
                    <ul class="filter-data m-0 p-0">
                        <!-- Company Filter -->
                        <li style="list-style:none;">
                            <div class="multipleSelection m-0">
                                <select id="company-filter" name="company_id" class="form-select">
                                    <option value="all" {{ request('company_id') == 'all' ? 'selected' : '' }}>All Companies</option>
                                    @foreach ($companys as $company)
                                        <option value="{{$company->id}}" {{ request('company_id') == $company->id ? 'selected' : '' }}>{{$company->company_name}}</option>
                                    @endforeach
                                </select> 
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    @if(session('success'))
                        <div class="alert alert-success mb-0" id="success-alert">
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
                {{-- for isset get value --}}
                @foreach ($customers as $customer)
                @endforeach
                <div class="col text-end">
                    <ul class="list-inline-item ps-0 m-0">
                    
                        <li class="list-inline-item">
                            <!-- <button class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded" id="add-task" data-bs-toggle="modal" data-bs-target="#add_project">New Project</button> -->
                            <a class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded" href="{{route('admin.users.customers.trash')}}">All Trash</a>
                            <a class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded" href="{{route('admin.users.customers.create')}}">Create Customer</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
                <!-- Content Starts -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-0">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-nowrap custom-table mb-0 datatable mydata-table customersearch">
                                        <thead class="text-center">
                                            <tr>
                                                <th class="checkBox">
                                                    Sr.No
                                                </th>
                                                <th class="checkBox sorting" style="width: 25%;">Company Name</th>
                                                <th class="checkBox sorting" style="width: 25%;">Customer Name</th>
                                                <th class="checkBox sorting" style="width: 25%;">Email</th>
                                                <th class="checkBox sorting" style="width: 25%;">Phone Number</th>
                                                <th class="checkBox sorting" style="width: 25%;">Status</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody id="customer-data" class="text-center">
                                            <!-- Data will be inserted here via AJAX -->
                                        </tbody>
                                    </table>
                                    
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Content End -->
        </div>
            <!-- /Page Content -->
    </div>
    <!-- /Page Wrapper -->
    <!--user Details Modal -->
    <div class="modal right fade" id="user-details-modal" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row w-100">
                        <div class="col-md-7 account d-flex">
                            <div>
                                <!-- Customer Profile Picture -->
                                <img src="{{ asset('/assets/img/user_profile.png') }}" class="avatar customer-avatar" alt="Customer Photo" />
                                <!-- Customer Name -->
                                <span class="modal-title">Customer Name</span> <!-- Will be updated dynamically -->
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="task-infos">
                        <div class="tab-content">
                            <div class="tab-pane show active" id="tasks-details">
                                <div class="crms-tasks">
                                    <div class="tasks__item crms-task-item active">
                                        <div class="accordion-header js-accordion-header">Name</div>
                                        <div class="accordion-body js-accordion-body">
                                            <div class="accordion-body__contents">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td class="border-0">Customer ID</td>
                                                            <td class="border-0 customer-id">Loading...</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border-0">Name</td>
                                                            <td class="border-0 modal-title">Loading...</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border-0">Email</td>
                                                            <td class="border-0 customer-email">Loading...</td>
                                                        </tr>
                                                        <tr>
                                                            {{-- <td class="border-0">National ID</td> --}}
                                                            <td class="border-0 customer-nationalID">Loading...</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border-0">Phone Number</td>
                                                            <td class="border-0 customer-phone">Loading...</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border-0">Address</td>
                                                            <td class="border-0 customer-address">Loading...</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tasks__item crms-task-item">
                                        <div class="accordion-header js-accordion-header">Company Contact Information</div>
                                        <div class="accordion-body js-accordion-body">
                                            <div class="accordion-body__contents">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td class="border-0">Company Name</td>
                                                            <td class="border-0 company-name">Loading...</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border-0">Company Email</td>
                                                            <td class="border-0 company-email">Loading...</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border-0">Company Phone Number</td>
                                                            <td class="border-0 company-phone">Loading...</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border-0">PAN NO</td>
                                                            <td class="border-0 pan-no">Loading...</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border-0">TAX NO</td>
                                                            <td class="border-0 tax-no">Loading...</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal-content -->
        </div>
        <!-- modal-dialog -->
    </div>
    <!-- end user details modal -->

    <!-- edit/update customer form -->
    <div class="modal right fade" id="edit-form-customer" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center">Edit Customer</h4>
                    <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Content Starts -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <form  method="POST" id="edit-customer-form" enctype="multipart/form-data">

                            {{-- <form action="{{ route('admin.users.customers.index' $customer->id) }}" method="POST" id="edit-customer-form"> --}}
                                @csrf
                                @method('PATCH') <!-- Use PATCH for updating -->
                                <div >
                                    <div class="d-flex mb-4 position-relative">
                                        <img id="selectedAvatar" 
                                             src="{{ old('profile_picture') ? asset('uploads/customers/' . old('profile_picture')) : asset('/assets/img/user_profile.png') }}" 
                                             class="rounded-circle" 
                                             style="width: 100px; height: 100px; object-fit: cover;" 
                                             alt="empty" />
                                        
                                        <label class="form-label uplode text-white m-1" for="customFile2">Choose file</label>
                                        <input type="file" class="form-control d-none" name="profile_picture" id="customFile2" 
                                               onchange="displaySelectedImage(event, 'selectedAvatar')" />
                                        
                                        <!-- Display validation error -->
                                        @if ($errors->has('profile_picture'))
                                            <div id="error-message" style="color: red;">
                                                {{ $errors->first('profile_picture') }}
                                            </div>
                                        @else
                                            <div id="error-message" style="color: red; display: none;"></div>
                                        @endif
                                    </div>
                                </div>
                                <h3>Company Details</h3>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label class="col-form-label">Company Name<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" required name="company_name" value="{{old('company_name' ,$customer->company_name)}}"  >
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-form-label">Status<span class="text-danger">*</span></label>
                                            <select class="form-control form-select js-states single" required name="status">
                                                <option value="active">Active</option>
                                                <option value="deactive">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6 mynumber">
                                            <label class="col-form-label ">Phone Number</label>
                                            <input class="form-control Cphone" name="company_phone_number" value="{{old('company_phone_number', $customer->company_phone_number)}}" type="text" oninput="this.value = this.value.replace(/[^+\d]/g, '');" placeholder=" ">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-form-label">Company Email</label>
                                            <input class="form-control" type="text" name="company_email" value="{{old('company_email', $customer->company_email)}}" pattern="[^@\s]+@[^@\s]+"  placeholder="@gmail.com">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label class="col-form-label">PAN No</label>
                                            <input class="form-control" type="text" name="pan_number" value="{{old('pan_number',$customer->pan_number)}}" placeholder="PAN No">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-form-label">Tax No</label>
                                            <input class="form-control" type="text" name="tax_number" value="{{old('tax_number', $customer->tax_number)}}" placeholder="Eg: GST,VAT.etc">
                                        </div>
                                    </div>
                                   
                                <h3>Customer Details</h3>
                                
                                @isset($customer)
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label class="col-form-label">First Name</label>
                                            <input class="form-control" type="text"  name="first_name" value="{{ old('first_name', $customer->first_name )}}" placeholder="First Name">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-form-label">Last Name</label>
                                            <input class="form-control" type="text"  name="last_name" value="{{ old('last_name', $customer->last_name)}}" placeholder="Last Name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label class="col-form-label">Customer Designation</label>
                                            <textarea class="form-control" name="description" value="{{ old('description', $customer->description)}}" style="height: 41px;" id="" placeholder="Customer Designation"></textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-form-label">Email</label>
                                            <input class="form-control" type="text" name="email" value="{{ old('email', $customer->email)}}" pattern="[^@\s]+@[^@\s]+"  placeholder="@gmail.com">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6 mynumber">
                                            <label class="col-form-label ">Phone Number</label>
                                            <input class="form-control Uphone"  type="text" name="phone_number" value="{{ old('phone_number', $customer->phone_number)}}" placeholder=" ">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-form-label">Address</label>
                                            <textarea class="form-control" name="address" value="{{old('address' ,$customer->address)}}" style="height: 41px;" type="text" placeholder="Address"></textarea>
                                        </div>
                                        {{-- <div class="col-md-6">
                                            <label class="col-form-label">National ID<span class="text-danger">*</span></label>
                                            <input class="form-control" type="number" name="national_id" value="{{old('national_id',$customer->national_id)}}" placeholder="National ID">
                                        </div> --}}
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label class="col-form-label">Password<span class="text-danger">*</span></label>
                                            <input id="password" class="form-control" type="password" name="password" 
                                                placeholder="Password"><i class="toggle-password cursor-pointer fa fa-fw fa-eye-slash"></i>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-form-label">Confirm Password<span class="text-danger">*</span></label>
                                            <input id="confirm_password" class="form-control" type="password" name="password_confirmation"
                                            placeholder="Confirm Password"><i class="toggle-password cursor-pointer fa fa-fw fa-eye-slash"></i>
                                        </div>
                                    </div>
                                @endisset
                                    <div class="py-3">
                                        <button type="submit"
                                            class="border-0 btn btn-primary btn-gradient-primary btn-rounded">Update
                                            Customer</button>&nbsp;&nbsp;
                                        </button>
                                    </div>
                                        <!-- <button type="cancle" class="btn btn-secondary btn-rounded">Cancel</button> -->
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
    <!-- end edit/update customer form -->
@endsection
@section('script')
<script src="{{asset('/assets/js/customerview.js')}}"></script>
@endsection