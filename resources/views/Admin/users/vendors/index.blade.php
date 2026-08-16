
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
                            </span> All Vendors
                        </h3>
                    </div>
                    
                    <div class="col p-0 text-end">
                        <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.users.vendors.index')}}">Vendor Dashboard</a></li>
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
                                        <div class="inovices-amount" id="allVendors">-</div>
                                    </div>
                                </div>
                                <p class="inovices-all">All Vendors <span></span></p>
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
                <!-- pr -->
                <div class="col-md-4 p-0 ">
                    <ul class="filter-data m-0 p-0">
                        <li style="list-style:none;">
                            <div class="multipleSelection m-0">
                                <!-- Company Filter -->
                                <select id="company-filter-vendor" class="form-select">
                                    <option value="all" selected="">All Companies</option>
                                    @foreach ($companys as $company)
                                        <option value="{{$company->id}}">{{$company->company_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- /pr -->
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
                <div class="col text-end">
                    <ul class="list-inline-item ps-0 m-0">
                    
                        <li class="list-inline-item">
                            <!-- <button class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded" id="add-task" data-bs-toggle="modal" data-bs-target="#add_project">New Project</button> -->
                            <a class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded" href="{{route('admin.users.vendors.trash')}}">All Trash</a>
                            <a class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded" href="{{route('admin.users.vendors.create')}}">Create Vendors</a>
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
                                    <table class="table table-striped table-nowrap custom-table mb-0 datatable mydata-table addexamplesearch vendorsearch">
                                        <thead class="text-center">
                                            <tr>
                                                {{-- <th class="checkBox">
                                                    <label class="container-checkbox">
                                                        <input type="checkbox">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </th> --}}
                                                <th>Sr.No</th>
                                                <th>Vendor Photo</th>
                                                <th class="checkBox sorting" style="width: 25%;">Vendor Name</th>
                                                <th class="checkBox sorting" style="width: 25%;">Email</th>
                                                <th class="checkBox sorting" style="width: 25%;">Phone Number</th>
                                                <th class="checkBox sorting" style="width: 25%;">Status</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center" id="vendor-data">
                                            <!-- Data will be inserted here via AJAX -pr -->
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
    <div class="modal right fade" id="vendor-details-modal" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row w-100">
                        <div class="col-md-7 account d-flex">
                            <div>
                                <!-- vendor Profile Picture -->
                                <img src="{{ asset('/assets/img/user_profile.png') }}" class="avatar vendor-avatar" alt="vendor Photo" />
                                <!-- vendor Name -->
                                <span class="modal-title">Vendor Name</span> <!-- Will be updated dynamically -->
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
                                        <div class="accordion-header js-accordion-header">Vendor Details</div>
                                        <div class="accordion-body js-accordion-body">
                                            <div class="accordion-body__contents">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td class="border-0">Vendor status</td>
                                                            <td class="border-0 status">Loading...</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border-0">Name</td>
                                                            <td class="border-0 modal-title">Loading...</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border-0">Email</td>
                                                            <td class="border-0 vendor-email">Loading...</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border-0">National ID</td>
                                                            <td class="border-0 vendor-nationalID">Loading...</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border-0">Phone Number</td>
                                                            <td class="border-0 vendor-phone">Loading...</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border-0">Address</td>
                                                            <td class="border-0 vendor-address">Loading...</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border-0">PAN NO</td>
                                                            <td class="border-0 pan-no">Loading...</td>
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
                                                            <td class="border-0">Company Website</td>
                                                            <td class="border-0 website">Loading...</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border-0">TAX NO</td>
                                                            <td class="border-0 tax_number">Loading...</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tasks__item crms-task-item">
                                        <div class="accordion-header js-accordion-header">Bank Information</div>
                                        <div class="accordion-body js-accordion-body">
                                            <div class="accordion-body__contents">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td class="border-0">Bank Name</td>
                                                            <td class="border-0 bankname">Loading...</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border-0">Account Number</td>
                                                            <td class="border-0 bank-account-no">Loading...</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border-0">Branch Name</td>
                                                            <td class="border-0 bank-branch">Loading...</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border-0">Code-type</td>
                                                            <td class="border-0 code-type">Loading...</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border-0">IFSC code</td>
                                                            <td class="border-0 ifsc-code">Loading...</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border-0">SWIFT code</td>
                                                            <td class="border-0 swift-code">Loading...</td>
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

    <!-- edit/update vendor form -->
    <div class="modal right fade" id="edit-form-vendors" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center">Edit Vendor</h4>
                    <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Content Starts -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <form  method="POST"  enctype="multipart/form-data">
                                @csrf
                                <!-- Use PATCH for updating -->
                                <!-- value is dynamicaly fetch from app.js > edit-vendor -->
                                @method('PATCH')
                                <div >
                                    <div class="d-flex mb-4 position-relative">
                                        <img id="selectedAvatar" 
                                             class="rounded-circle" 
                                             style="width: 100px; height: 100px; object-fit: cover;" 
                                             alt="vendor_profile" />
                                        
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
                                <h3>Vendor Details</h3>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label class="col-form-label">First Name</label>
                                        <input class="form-control" type="text" name="first_name" placeholder="First Name">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-form-label">Last Name</label>
                                        <input class="form-control" type="text" name="last_name" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label class="col-form-label">PAN No</label>
                                        <input class="form-control" type="text" name="pan_number" placeholder="PAN No">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-form-label">Email</label>
                                        <input class="form-control" type="text" name="email" pattern="[^@\s]+@[^@\s]+"  placeholder="@gmail.com">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6 mynumber">
                                        <label class="col-form-label ">Phone Number</label>
                                        <input class="form-control Vphone"  type="text" oninput="this.value = this.value.replace(/[^+\d]/g, '');"  name="phone_number" placeholder=" ">
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label class="col-form-label">National ID</label>
                                        <input class="form-control" type="text" name="national_id" placeholder="National ID">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label class="col-form-label">Address</label>
                                        <textarea class="form-control" name="address" style="height: 41px;" type="text" placeholder="Address"></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-form-label">Status<span class="text-danger">*</span></label>
                                        <select class="form-control form-select js-states single" name="status">
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <h3>Company Details</h3>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label class="col-form-label">Company Name<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" required name="company_name">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-form-label">Tax No</label>
                                        <input class="form-control" type="number" name="Tax_number" placeholder="eg: GST,VAT.etc">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6 mynumber">
                                        <label class="col-form-label ">Company Website Url</label>
                                        <input class="form-control" name="website" type="text" placeholder=" ">
                                    </div>
                                </div>
                                <h3>Bank Details</h3>
                                <div class="form-group row">
                                    <div class="col-lg-6 col-md-6">
                                        <label class="col-form-label">Account Number</label>
                                        <input type="text" oninput="this.value = this.value.replace(/[^+\d]/g, '');" placeholder="Account Number" name="bank_account_no" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="col-form-label">Account Holder Name</label>
                                    <input type="text" class="form-control" name="account_holder_name" required placeholder="Holder Name">
                                </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6 col-md-6">
                                        <label class="col-form-label">Bank Name</label>
                                        <input type="text" class="form-control" name="bank_name" required placeholder="Bank name">
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <label class="col-form-label">Branch Name</label>
                                        <input type="text" class="form-control" name="branch_name" required placeholder="Branch Name" name="" id="">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <div class="col-lg-4 col-md-4">
                                        <label class="col-form-label">Select Code Type</label>
                                        <select id="codeType" name="code_type" class="form-control form-select js-states single">
                                            <option value="both" selected>IFSC & SWIFT Code</option> <!-- Set as default -->
                                            <option value="IFSC">IFSC Code</option> <!-- change pr 18-9-25 -->
                                            <option value="Swift">Swift Code</option> <!-- change pr 18-9-25 -->
                                        </select>
                                    </div>
                                
                                    <!-- Input field for IFSC Code -->
                                    <div class="col-lg-4 col-md-4" id="ifscInputField">
                                        <label class="col-form-label" id="ifscLabel">IFSC Code</label>
                                        <input type="text" id="ifscInput" class="form-control" name="ifsc_code" min="8" max="11" placeholder="Enter IFSC Code"> <!-- change pr 18-9-25 -->
                                    </div>
                                
                                    <!-- Input field for Swift Code -->
                                    <div class="col-lg-4 col-md-4" id="swiftInputField">
                                        <label class="col-form-label" id="swiftLabel">SWIFT Code</label>
                                        <input type="text" id="swiftInput" class="form-control" name="swift_code" min="8" max="11" placeholder="Enter Swift Code"> <!-- change pr 18-9-25 -->
                                    </div>
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
                                    <div class="py-3">
                                        <button type="submit"
                                            class="border-0 btn btn-primary btn-gradient-primary btn-rounded">Update
                                            </button>&nbsp;&nbsp;
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
    <!-- end edit/update vendor form -->
@endsection
@section('script')
<script src="{{asset('/assets/js/vendorview.js')}}"></script> <!-- pr -->
@endsection