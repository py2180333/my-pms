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
                            <i class="bi bi-buildings"></i>
                        </span>Company Details
                    </h3>
                </div>
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
                <div class="col p-0 text-end">
                    <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                        <li class="breadcrumb-item"><a href="#">Invoice</a></li>
                        <li class="breadcrumb-item active">Company Details</li>
                    </ul>
                </div>
            </div>
            <!-- Content Starts -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <form action="{{route('admin.company.store')}}"  class="needs-validation card" method="post" enctype="multipart/form-data">
                        @csrf
                       <div class="row">
                        <div class="col-md-6">
                            <div class="form-group service-upload company-logo">
                                <span>Upload logo</span>
                                <input type="file"  name="logo">
                                <div id="image-preview" class="image-preview-logo"></div>
                            </div>
                        </div>
                        
                       </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="col-form-label">Company Name<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="company_name" value="{{ old('company_name') }}" required placeholder="Company Name">
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label">Email</label>
                                <input class="form-control" type="email" name="email" value="{{ old('email') }}" pattern="[^@\s]+@[^@\s]+"  placeholder="example@gmail.com">
                            </div>
                            <div class="col-md-4 mynumber">
                                <label class="col-form-label ">Phone Number</label>
                                <input class="form-control phone" name="phone_number" type="text" oninput="this.value = this.value.replace(/[^+\d]/g, '');" pattern="{0-9}"  placeholder="">
                            </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-md-4">
                                <label class="col-form-label">PAN No</label>
                                <input class="form-control" name="pan_number" value="{{ old('pan_number') }}" type="text" pattern="[A-Za-z0-9]+" style="text-transform: uppercase;"  placeholder="BAJPC4350M">
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label">GST No</label>
                                <input class="form-control" name="gst_number" value="{{ old('gst_number') }}" type="text" pattern="[A-Za-z0-9]+" placeholder="24AAACH7409R2Z6">
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label">Address</label>
                                <textarea class="form-control" name="address" style="height: 41px;" rows="3" type="text" placeholder="Address">{{ old('address') }}</textarea>
                            </div>
                        </div>
                       <h4>Company Bank Details</h4>
                       <div class="form-group row">
                        <div class="col-lg-6 col-md-6">
                            <label class="col-form-label">Account Number<span class="text-danger">*</span></label>
                            <input type="number" name="bank_account_no" value="{{ old('bank_account_no') }}" required placeholder="Account Number" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="col-form-label">Account Holder Name<span class="text-danger">*</span></label>
                        <input type="text" name="account_holder_name" value="{{ old('account_holder_name') }}" class="form-control" required placeholder="Holder Name">
                    </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6 col-md-6">
                            <label class="col-form-label">Bank Name<span class="text-danger">*</span></label>
                            <input type="text" name="bank_name" value="{{ old('bank_name') }}" class="form-control" required placeholder="Bank name">
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <label class="col-form-label">Branch Name<span class="text-danger">*</span></label>
                            <input type="text" name="branch_name" value="{{ old('branch_name') }}" class="form-control" required placeholder="Branch Name" name="" id="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="clo-lg-4 col-md-4">
                            <label class="col-form-label">Prefix<span class="text-danger">*</span></label>
                            <input type="text" name="prefix" value="{{ old('prefix') }}" class="form-control" required>
                        </div>
                        <div class="clo-lg-4 col-md-4">
                            <label class="col-form-label">Signature Name</label>
                            <input type="text" name="signname" value="{{ old('signname') }}" class="form-control" min="3" max="10" >
                        </div>
                        <div class="clo-lg-4 col-md-4">
                            <label class="col-form-label">Upload Signature</label>
                            <input type="file" name="sign" class="form-control" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-4 col-md-4">
                            <label class="col-form-label">SWIFT Code</label>
                            <input type="text" name="swift_code" value="{{ old('swift_code') }}" class="form-control" min="8" max="12"  placeholder="Enter SWIFT Code">
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <label class="col-form-label">IFSC Code</label>
                            <input type="text " name="ifsc_code" value="{{ old('ifsc_code') }}" class="form-control" min="8" max="11"  placeholder="Enter IFSC Code">
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <label class="col-form-label">IBAN Code</label>
                            <input type="text " name="iban_code" value="{{ old('iban_code') }}" class="form-control" min="8" max="11" placeholder="Enter IBAN Code">
                        </div>
                        
                    </div>
                        <div class="py-3">
                            <button type="submit"
                                class="border-0 btn btn-primary btn-gradient-primary btn-rounded">Save
                                Details</button>&nbsp;&nbsp;
                            <!-- <button type="cancle" class="btn btn-secondary btn-rounded">Cancel</button> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Content End -->
    </div>
    <!-- /Page Wrappe end -->
@endsection