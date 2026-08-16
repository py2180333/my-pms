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
                            <i class="bi bi-buildings"></i>
                        </span> All Company
                    </h3>
                </div>
                <div class="col p-0 text-end">
                    <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">All Company</li>
                    </ul>
                </div>
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
            <!-- Page Header -->
            <div class="page-header pt-3 mb-0 ">
                <div class="row">
                    
                    <div class="col text-end">
                        <ul class="list-inline-item ps-0">
                            
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
                                    <table class="table table-striped table-nowrap custom-table mb-0 datatable mydata-table addexamplesearch">
                                        <thead class="text-center">
                                            <tr>
                                                <th class="checkBox ">
                                                    Sr.No
                                                </th>
                                                <th class="checkBox sorting" style="width: 25%;">Company Name</th>
                                                <th class="checkBox sorting" style="width: 25%;">Email</th>
                                                <th class="checkBox sorting" style="width: 25%;">Phone Number</th>
                                                <th class="checkBox sorting" style="width: 25%;">PAN No</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($companys as $company)
                                            <tr class="text-center">
                                                <td class="checkBox">
                                                    {{$loop->iteration}}
                                                    
                                                </td>
                                                <td>{{$company->company_name}}</td>
                                                <td>
                                                    <a href="mailto:{{$company->email}}" class="text-decoration-none">{{$company->email}}</a>
                                                </td>
                                                <td>
                                                    <a href="tel:{{$company->phone_number}}">{{$company->phone_number}}</a>
                                                </td>
                                                <td>{{$company->pan_number}}</td>
                                                <td class="text-center d-flex">
                                                    <a href="#" class="ms-2 p-2 fs-6 my_icons edit-action" data-bs-toggle="modal" data-bs-target="#company-update-user-{{$company->id}}"><i class="fa-solid fa-pen-to-square text-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Edit" aria-label="Edit"></i></a>
                                                    </a>
                                                    <!-- new rd 16-7-25 -->
                                                    <button class="ms-2 p-2 fs-6 btn btn-link my_icons view-action view text-success" data-bs-toggle="modal" data-bs-target="#company-details-modal-{{$company->id}}">
                                                        <i class="fa-solid fa-eye" data-bs-placement="top" title="View"></i>
                                                    </button>
                                                    <form action="{{route('admin.company.delete', $company->id)}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this company?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="ms-2 p-2 fs-6 my_icons btn btn-link text-danger delete-action">
                                                            <i class="fa-solid fa-trash" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                    <nav aria-label="Table pagination ">
                        <ul class="pagination justify-content-end mt-3 mypagination">
                            <!-- Pagination items will be dynamically generated here -->
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /Content End -->
        </div>
        <!-- /Page Content -->
    </div>
    <!-- /Page Wrapper -->
    <!-- view signle company -->
    @foreach ($companys as $company)
        <div class="modal right fade" id="company-details-modal-{{$company->id}}" tabindex="-1" role="dialog" aria-modal="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="row w-100">
                            <div class="col-md-7 account d-flex">
                                <div>
                                    <!-- vendor Profile Picture -->
                                    <img src="{{ asset('uploads/logos/' . $company->logo) }}" class="" width="150" alt="Photo" />
                                    <!-- vendor Name -->
                                    <span class="m-2 modal-title">{{$company->company_name}}</span> <!-- Will be updated dynamically -->
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
                                            <div class="accordion-header js-accordion-header">Company Details</div>
                                            <div class="accordion-body js-accordion-body">
                                                <div class="accordion-body__contents">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td class="border-0">company GST No.</td>
                                                                <td class="border-0">{{$company->gst_number}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border-0">Status</td>
                                                                <td class="border-0">{{$company->status}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border-0">Email</td>
                                                                <td class="border-0">{{$company->email}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border-0">Phone Number</td>
                                                                <td class="border-0">{{$company->phone_number}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border-0">Address</td>
                                                                <td class="border-0">{{$company->address}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border-0">PAN NO</td>
                                                                <td class="border-0">{{$company->pan_number}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tasks__item crms-task-item">
                                            <div class="accordion-header js-accordion-header">Company Invoice Information</div>
                                            <div class="accordion-body js-accordion-body">
                                                <div class="accordion-body__contents">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td class="border-0">Company Prefix</td>
                                                                <td class="border-0 company-name">{{$company->prefix}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border-0">Signature Name</td>
                                                                <td class="border-0 website">{{$company->signname}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border-0">Signature</td>
                                                                <td class="border-0 tax_number"><img src="{{asset('uploads/logos/'.$company->sign)}}" alt="sign"/></td>
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
                                                                <td class="border-0">{{$company->bank_name}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border-0">Account Number</td>
                                                                <td class="border-0">{{$company->bank_account_no}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border-0">Account Holder Name</td>
                                                                <td class="border-0">{{$company->account_holder_name}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border-0">Branch Name</td>
                                                                <td class="border-0">{{$company->branch_name}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border-0">SWIFT code</td>
                                                                <td class="border-0">{{$company->swift_code}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border-0">IFSC code</td>
                                                                <td class="border-0">{{$company->ifsc_code}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border-0">IBAN code</td>
                                                                <td class="border-0">{{$company->iban_code}}</td>
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
    @endforeach
    <!-- end single company -->
    <!-- company update model -->
    @foreach ($companys as $company)
        <div class="modal right fade" id="company-update-user-{{$company->id}}" tabindex="-1" aria-modal="true" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="row w-100">
                            <div class="col  p-0">
                                <h3 class="page-title m-0">
                                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                                        <i class="bi bi-buildings"></i>
                                    </span>Update Company  Details </h3>
                            </div>
                        </div>

                        <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>

                    </div>
                    <div class="modal-body">
                        <div class="task-infos">
                            <div class="tab-content">
                                <div class="content container-fluid">
                                    <!-- Content Starts -->
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <form method="POST" action="{{ route('admin.company.update', $company->id) }}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h5>Company Logo</h5>
                                                        <div class="form-group service-upload company-logo">
                                                            {{-- <label>Upload Logo</label> --}}
                                                            <input type="file" name="logo" id="logoInput-{{ $company->id }}" 
                                                            onchange="previewLogo(this, '{{ $company->id }}')" class="form-control">
                                                            <img src="{{ $company->logo ? asset('uploads/logos/' . $company->logo) : '' }}" alt="Company Logo" id="logoPreview-{{ $company->id }}" class="img-fluid mt-2" style="max-height: 100px;">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h5>Signature</h5>
                                                        <div class="form-group service-upload company-logo">
                                                            {{-- <label>Upload Logo</label> --}}
                                                            <input type="file" name="sign" id="SingInput-{{ $company->id }}" 
                                                            onchange="previewSign(this, '{{ $company->id }}')" class="form-control">
                                                            <img src="{{ $company->logo ? asset('uploads/logos/' . $company->sign) : '' }}" alt="Company Logo" id="SignPreview-{{ $company->id }}" class="img-fluid mt-2" style="max-height: 100px;">
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col-md-6">
                                                        <label class="col-form-label" for="">Resource ID</label>
                                                        <input class="form-control" type="text" name="" id="">
                                                    </div> -->
                                                </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <label class="col-form-label">Company Name<span class="text-danger">*</span></label>
                                                            <input class="form-control" type="text" name="update_name" value="{{$company->company_name}}" required="" placeholder="Company Name">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="col-form-label">Email</label>
                                                            <input class="form-control" type="email" value="{{$company->email}}" name="update_email" pattern="[^@\s]+@[^@\s]+"  placeholder="example@gmail.com">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-6 mynumber">
                                                            <label class="col-form-label ">Phone Number<span class="text-danger">*</span></label>
                                                            <input class="form-control phone" name="update_number" type="text" oninput="this.value = this.value.replace(/[^+\d]/g, '');" required value="{{$company->phone_number}}" placeholder=" +91">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="col-form-label">PAN.No</label>
                                                            <input class="form-control" name="update_pan" type="text"  value="{{$company->pan_number}}" placeholder="BAJPC4350M">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <label class="col-form-label">GST.No</label>
                                                            <input class="form-control" type="text" name="update_gst"  value="{{$company->gst_number}}" placeholder="24AAACH7409R2Z6">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="col-form-label">Address</label>
                                                            <textarea class="form-control" name="update_address" style="height: 41px;"  rows="3" type="text" placeholder="Address">{{$company->address}}</textarea>
                                                        </div>
                                                    </div>
                                                <h4>Company Bank Details</h4>
                                                <div class="form-group row">
                                                    <div class="col-lg-6 col-md-6">
                                                        <label class="col-form-label">Account Number<span class="text-danger">*</span></label>
                                                        <input type="text" name="update_account_nu" value="{{$company->bank_account_no}}" required placeholder="Account Number" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="col-form-label">Account Holder Name<span class="text-danger">*</span></label>
                                                    <input type="text" name="update_holder_name" class="form-control" required value="{{$company->account_holder_name}}" placeholder="Holder Name">
                                                </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-lg-6 col-md-6">
                                                        <label class="col-form-label">Bank Name<span class="text-danger">*</span></label>
                                                        <input type="text" name="update_bank_name" class="form-control" required value="{{$company->bank_name}}" placeholder="Bank name">
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <label class="col-form-label">Branch Name<span class="text-danger">*</span></label>
                                                        <input type="text" name="update_branch_name" class="form-control" required value="{{$company->branch_name}}" placeholder="Branch Name" >
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <label class="col-form-label">Prefix<span class="text-danger">*</span></label>
                                                            <input class="form-control" name="update_prefix" type="text" value="{{$company->prefix}}" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="col-form-label">Signature Name</label>
                                                            <input class="form-control" name="update_signname" value="{{$company->signname}}" type="text" >
                                                        </div>
                                                    </div>
                                                <div class="form-group row">
                                                    <div class="col-lg-4 col-md-6">
                                                        <label class="col-form-label">IFSC Code<span class="text-danger"></span></label>
                                                        <input type="text " name="update_ifsc" class="form-control" min="8" max="11"  value="{{$company->ifsc_code}}" placeholder="Enter IFSC Code">
                                                    </div>
                                                    <div class="col-lg-4 col-md-6">
                                                        <label class="col-form-label">SWIFT Code<span class="text-danger"></span></label>
                                                        <input type="text " name="update_swift" class="form-control" min="8" max="11"  value="{{$company->swift_code}}" placeholder="Enter IFSC Code">
                                                    </div>
                                                    <div class="col-lg-4 col-md-6">
                                                        <label class="col-form-label">IBAN Code<span class="text-danger"></span></label>
                                                        <input type="text " name="update_iban" class="form-control" min="8" max="11"  value="{{$company->iban_code}}" placeholder="Enter IFSC Code">
                                                    </div>
                                                </div>
                                                    <div class="py-3">
                                                        <button type="submit" class="border-0 btn btn-primary btn-gradient-primary btn-rounded">Update
                                                            Details</button>&nbsp;&nbsp;
                                                        <!-- <button type="cancle" class="btn btn-secondary btn-rounded">Cancel</button> -->
                                                    </div>
                                            </form>
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
    @endforeach
    <!-- company update model End -->
    <script>
        function previewLogo(input, companyId) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
    
                reader.onload = function (e) {
                    const imgElement = document.getElementById('logoPreview-' + companyId);
                    imgElement.src = e.target.result; // Set the preview image src to the uploaded file
                };
    
                reader.readAsDataURL(input.files[0]); // Read the file as a data URL
            }
        }
        function previewSign(input, companyId) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
    
                reader.onload = function (e) {
                    const imgElement = document.getElementById('SignPreview-' + companyId);
                    imgElement.src = e.target.result; // Set the preview image src to the uploaded file
                };
    
                reader.readAsDataURL(input.files[0]); // Read the file as a data URL
            }
        }
    </script>
@endsection