@extends('Admin.layouts.master')
@include('Admin.layouts.sidebar')
@include('Admin.layouts.headerMenu')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper create_p">
        <!-- Page Content -->
        <div class="content container-fluid">
            <div class="crms-title row bg-white">
                <div class="col  p-0">
                    <h3 class="page-title m-0">
                        <span class="page-title-icon bg-gradient-primary text-white me-2">
                            <i class="bi bi-grid"></i>
                        </span>Create vendor
                    </h3>
                </div>
                <div class="col p-0 text-end">
                    <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.users.vendors.index')}}">vendor</a></li>
                        <li class="breadcrumb-item active">Create vendor</li>
                    </ul>
                </div>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- Content Starts -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <form action="{{route('admin.users.vendors.store')}}" method="POST" class="needs-validation card" id="projectdetails" enctype="multipart/form-data">
                        @csrf    
                        <div class="">
                                <div class="d-flex mb-4 position-relative">
                                    <img id="selectedAvatar" src="{{asset('/assets/img/user_profile.png')}}"
                                    class="rounded-circle " style="width: 100px; height: 100px; object-fit: cover;" alt="example placeholder" />
                                    <label class="form-label uplode text-white m-1" for="customFile2">Choose file</label>
                                        <input type="file" class="form-control d-none" name="profile_picture" id="customFile2" onchange="displaySelectedImage(event, 'selectedAvatar')" />
                                </div>
                                <!-- <select name="company_ids[]" multiple>
                                    <option disabled>select companies</option>
                                    @foreach ($companys as $company)
                                        <option value="{{$company->id}}">{{$company->company_name}}</option>
                                    @endforeach
                                </select> -->
                            </div>
                            <div class="row">
                                    <div class="col-4">
                                    <div class="multipleSelection">
                                            <div class="selectBox">
                                                <p class="mb-0"> Select Companies</p>
                                                <span class="down-icon"><i class="fa fa-angle-down" aria-hidden="true"></i></span>
                                            </div>
                                            <div id="checkBoxes">
                                                    <p class="checkbox-title">Select companies</p>
                                                    <div class="selectBox-cont">
                                                    @foreach ($companys as $company)
                                                        <label class="custom_check w-100">
															<input value="{{$company->id}}" name="company_ids[]" {{ in_array($company->id, old('company_ids', [])) ? 'checked' : '' }} type="checkbox">{{$company->company_name}}
															<span class="checkmark"></span>
														</label>
                                                    @endforeach
                                                    </div>
                                            </div>
                                        </div>
                                </div>
                            <h4>Vendor Details</h4>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label class="col-form-label">First Name</label>
                                    <input class="form-control" type="text" name="first_name" value="{{old('first_name')}}"  placeholder="First Name" oninvalid="this.setCustomValidity('Enter your first name')">
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label">Last Name</label>
                                    <input class="form-control" type="text" name="last_name" value="{{old('last_name')}}"  placeholder="Last Name">
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label">Email</label>
                                    <input class="form-control" type="email" name="email" value="{{old('email')}}"  pattern="[^@\s]+@[^@\s]+"  placeholder="Example@gmail.com">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4 mynumber">
                                    <label class="col-form-label">Phone Number</label>
                                    <input class="form-control phone" type="text" name="phone_number">
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label">National ID</label>
                                    <input class="form-control" type="text" name="national_id" value="{{old('national_id')}}"  placeholder="National ID">
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label">PAN No</label>
                                    <input class="form-control" type="text" name="pan_number" value="{{old('pan_number')}}"  placeholder="AAAPA1234A">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label class="col-form-label">Address</label>
                                    <input class="form-control" type="text" name="address" value="{{old('address')}}"  placeholder="Address">
                                </div>
                            </div>
                            <h4>Company Details</h4>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4">
                                    <label class="col-form-label">Company Name<span class="text-danger">*</span></label>
                                    <input type="text" name="company_name" placeholder="Company Name" value="{{old('company_name')}}" required class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label">Tax No</label>
                                <input type="text" class="form-control" name="Tax_number" value="{{old('Tax_number')}}"  placeholder="Eg:09AAACH7409R1ZZ">
                            </div>
                            <div class="col-lg-4 col-md-4">
                                    <label class="col-form-label">Company Website Url</label>
                                    <input type="text" name="website" class="form-control" value="{{old('website')}}"  placeholder="Url">
                                </div>
                            </div>
                            <h4>Bank Details</h4>
                        <div class="form-group row">
                            <div class="col-lg-6 col-md-6">
                                <label class="col-form-label">Account Number</label>
                                <input type="number" placeholder="Account Number" name="bank_account_no" value="{{old('bank_account_no')}}" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="col-form-label">Account Holder Name</label>
                            <input type="text" class="form-control" name="account_holder_name" value="{{old('account_holder_name')}}"  placeholder="Holder Name">
                        </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6 col-md-6">
                                <label class="col-form-label">Bank Name</label>
                                <input type="text" class="form-control" name="bank_name" value="{{old('bank_name')}}"  placeholder="Bank Name">
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <label class="col-form-label">Branch Name</label>
                                <input type="text" class="form-control" name="branch_name" value="{{old('branch_name')}}"  placeholder="Branch Name" name="" id="">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4">
                                <label class="col-form-label">Select Code Type</label>
                                <select id="codeType" name="code_type" class="form-control form-select js-states single">
                                    <option value="both" selected>IFSC & SWIFT Code</option> <!-- Set as default -->
                                    <option value="IFSC">IFSC Code</option> <!-- change pr 18-9-25 -->
                                    <option value="Swift">SWIFT Code</option> <!-- change pr 18-9-25 -->
                                </select>
                            </div>
                        
                            <!-- Input field for IFSC Code -->
                            <div class="col-lg-4 col-md-4" id="ifscInputField">
                                <label class="col-form-label" id="ifscLabel">IFSC Code</label>
                                <input type="text" id="ifscInput" class="form-control" name="ifsc_code" min="8" max="11"  placeholder="Enter IFSC Code">
                            </div>
                        
                            <!-- Input field for Swift Code -->
                            <div class="col-lg-4 col-md-4" id="swiftInputField">
                                <label class="col-form-label" id="swiftLabel">SWIFT Code</label>
                                <input type="text" id="swiftInput" class="form-control" name="swift_code" min="8" max="11"  placeholder="Enter SWIFT Code">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="col-form-label">Password<span class="text-danger">*</span></label>
                                <input id="password" class="form-control" type="password" name="password"
                                     required placeholder="Password"> <i class="toggle-password cursor-pointer fa fa-fw fa-eye-slash"></i>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="col-form-label">Confirm Password<span class="text-danger">*</span></label>
                                <input id="confirm_password" class="form-control" type="password" name="password_confirmation"
                                     required placeholder="Confirm Password"> <i class="toggle-password cursor-pointer fa fa-fw fa-eye-slash"></i>
                            </div>
                        </div>
                        <div class="py-3">
                            <button type="submit"
                                class="border-0 btn btn-primary btn-gradient-primary btn-rounded">Create
                                Vendor</button>&nbsp;&nbsp;
                            <!-- <button type="cancle" class="btn btn-secondary btn-rounded">Cancel</button> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Content End -->
    </div>
    <!-- /Page Content -->
@endsection