@extends('vendor.layouts.master')
@include('vendor.layouts.sidebar')
@include('vendor.layouts.headerMenu')
@section('content') 
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="crms-title row bg-white">
            <div class="col  p-0">
                <h3 class="page-title m-0">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="bi bi-person"></i>
                    </span> Vendor Profile
                </h3>
            </div>
            <div class="col p-0 text-end">
                <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                    <li class="breadcrumb-item"><a href="{{ route('vendor.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Vendor Profile</li>
                </ul>
            </div>
        </div>

        <x-alert /> <!-- \views\components\alert to show the errors. -->
        
        <div class="page-header pt-3 mb-0">
            <div class="card ">
                <div class="card-body">
                    <div class="row bg-white">
                        <div class="col-md-12">
                            <div class="profile-view">
                                <div class="profile-img-wrap">
                                    <div class="profile-img">
                                        @if ($data->profile_picture) 
                                            <a href = "#"> 
                                                <img alt ="" id="originalImage" src = "{{ asset('uploads/vendors/' . $data->profile_picture) }}" > 
                                            </a>
                                        @else
                                            <a href="#"><img alt="" id="originalImage" src="{{ asset('/assets/img/user_profile.png ') }}"></a>
                                        @endif
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <a class="" href="">
                                                    <h3 class="user-name m-t-0 mb-0"> 
                                                        <span id="original_first_name">{{$data->first_name}}</span> 
                                                        <span id="original_last_name">{{$data->last_name}}</span>
                                                    </h3>
                                                </a>
                                                <div class="title mt-2">Email</div>
                                                <div class="text">
                                                    <a class="text-muted" href="">
                                                        <span id="original_email">{{$data->email}}</span>
                                                    </a>
                                                </div>
                                                <div class="title mt-2">Phone Number</div>
                                                <div class="text">
                                                    <a class="text-muted" href="">
                                                        <span id="original_phone_number">{{$data->phone_number}}</span>
                                                    </a>
                                                </div>
                                                <div class="title mt-2">National Id</div>
                                                <div class="text">
                                                    <a class="text-muted" href="">
                                                        {{$data->national_id}}
                                                    </a>
                                                </div>
                                                <div class="title mt-2">Address</div>
                                                <div class="text">
                                                    <a class="text-muted" href="">
                                                        <span id="original_address">{{$data->address}}</span>
                                                    </a>
                                                </div>
                                                <div class="title mt-2">Status</div>
                                                <div class="text">
                                                    <a class="text-muted" href="">
                                                        {{$data->status}}
                                                    </a>
                                                </div>
                                                <div class="title mt-2">Bank Account Number</div>
                                                <div class="text">
                                                    <a class="text-muted" href="">
                                                        <span id="original_bank_account_no">{{$data->bank_account_no}}</span>
                                                    </a>
                                                </div>
                                                <div class="title mt-2">Account Holder Name</div>
                                                <div class="text">
                                                    <a class="text-muted" href="">
                                                        <span id="original_account_holder_name">{{$data->account_holder_name}}</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="title mt-2">Company Name</div>
                                            <div class="text">
                                                <a class="text-muted" href="">
                                                    {{$data->company_name}}
                                                </a>
                                            </div>
                                            <div class="title mt-2">Website</div>
                                            <div class="text">
                                                <a class="text-muted" href="">
                                                    <span id="original_website">{{$data->website}}</span>
                                                </a>
                                            </div>
                                            <div class="title mt-2">Pan Number</div>
                                            <div class="text">
                                                <a class="text-muted" href="">
                                                    <span id="original_pan_number">{{$data->pan_number}}</span>
                                                </a>
                                            </div>
                                            <div class="title mt-2">Tax Number</div>
                                            <div class="text">
                                                <a class="text-muted" href="">
                                                    <span id="original_tax_number">{{$data->Tax_number}}</span>
                                                </a>
                                            </div>
                                            <div class="title mt-2">Branch Name</div>
                                            <div class="text">
                                                <a class="text-muted" href="">
                                                    <span id="original_branch_name">{{$data->branch_name}}</span>
                                                </a>
                                            </div>
                                            <div class="title mt-2">Bank Name</div>
                                            <div class="text">
                                                <a class="text-muted" href="">
                                                    <span id="original_bank_name">{{$data->bank_name}}</span>
                                                </a>
                                            </div>
                                            <div class="title mt-2">Code Type</div>
                                            <div class="text">
                                                <a class="text-muted" href="">
                                                    <span id="original_code_type">{{$data->code_type}}</span>
                                                </a>
                                            </div>
                                            <div class="title mt-2"> IFSC Code</div>
                                            <div class="text">
                                                <a class="text-muted" href="">
                                                    <span id="original_ifsc_code">{{$data->ifsc_code}}</span>
                                                </a>
                                            </div>
                                            <div class="title mt-2">SWIFT Code</div>
                                            <div class="text">
                                                <a class="text-muted" href="">
                                                    <span id="original_swift_code">{{$data->swift_code}}</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pro-edit">
                                    <a data-bs-toggle="modal" data-bs-target="#update-resource" onclick="resetVndForm()" class="edit-icon" href="#" id="view-vendor-profile">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </div>
                                <div class="modal right fade" id="update-resource" tabindex="-1" role="dialog" aria-modal="true">
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
                                                        <!-- use Auth::id(); to update the details. -->
                                                        <form action="{{ route('vendor.update') }}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PATCH')
                                                            <div class="row">
                                                                <div>
                                                                    <div class="d-flex mb-4 position-relative">
                                                                        @if($data->profile_picture)
                                                                            <img id="selectedVndAvatar" src="{{ asset('uploads/vendors/' . $data->profile_picture) }}"
                                                                                    class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;" alt="example placeholder" />
                                                                        @else
                                                                            <img id="selectedVndAvatar" src="{{asset('/assets/img/user_profile.png')}}" 
                                                                                class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;" alt="example placeholder" />
                                                                        @endif    
                                                                        <label class="form-label uplode text-white m-1" for="customFile2">Choose file</label>
                                                                        <input type="file" class="form-control d-none" name="profile_picture" id="customFile2" onchange="displaySelectedVndImage(event)" />
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <h3>Vendor Details</h3>
                                                            <div class="form-group row">
                                                                <div class="col-md-6">
                                                                    <label class="col-form-label">First Name<span class="text-danger">*</span></label>
                                                                    <input class="form-control" id="first_name" type="text" name="first_name" value="{{ $data->first_name }}" placeholder="First Name">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="col-form-label">Last Name<span class="text-danger">*</span></label>
                                                                    <input class="form-control" id="last_name" type="text" name="last_name" value="{{ $data->last_name }}" placeholder="Last Name">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-6 mynumber">
                                                                    <label class="col-form-label">Phone Number</label>
                                                                    <input class="form-control phone" id="phone_number"  type="text" name="phone_number" value="{{ $data->phone_number }}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="col-form-label">Email</label>
                                                                    <input class="form-control" id="email" type="email" name="email" value="{{ $data->email }}" pattern="[^@\s]+@[^@\s]+"  placeholder="example@gmail.com">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-6">
                                                                    <label class="col-form-label">PAN.No</label>
                                                                    <input class="form-control" id="pan_number" type="text" name="pan_number" value="{{ $data->pan_number }}" placeholder="PAN.NO">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="col-form-label">Address</label>
                                                                    <textarea class="form-control" id="address" name="address" style="height: 41px;"  rows="3" type="text" placeholder="Address">{{ $data->address }}</textarea>
                                                                </div>
                                                            </div>

                                                            <h3>Company Details</h3>
                                                            <div class="form-group row">
                                                                <div class="col-md-6 mynumber">
                                                                    <label class="col-form-label ">Company Website Url</label>
                                                                    <input class="form-control" id="website" name="website" value="{{ $data->website }}" type="text" placeholder=" ">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="col-form-label">TAX.No</label>
                                                                    <input class="form-control" id="tax_number" type="text" name="tax_number" value="{{ $data->Tax_number }}" placeholder="TAX.NO">
                                                                </div>
                                                            </div>

                                                            <h3>Bank Details</h3>
                                                            <div class="form-group row">
                                                                <div class="col-lg-6 col-md-6">
                                                                        <label class="col-form-label">Account Number</label>
                                                                        <input type="text" oninput="this.value = this.value.replace(/[^+\d]/g, '');" placeholder="Account Number" name="bank_account_no" id="bank_account_no" value="{{ $data->bank_account_no }}" class="form-control">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="col-form-label">Account Holder Name</label>
                                                                    <input type="text" class="form-control" name="account_holder_name" id="account_holder_name" value="{{ $data->account_holder_name }}" required placeholder="Holder Name">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-lg-6 col-md-6">
                                                                    <label class="col-form-label">Bank Name</label>
                                                                    <input type="text" class="form-control" name="bank_name" id="bank_name" value="{{ $data->bank_name }}" required placeholder="Bank name">
                                                                </div>
                                                                <div class="col-lg-6 col-md-6">
                                                                    <label class="col-form-label">Branch Name</label>
                                                                    <input type="text" class="form-control" name="branch_name" id="branch_name" value="{{ $data->branch_name }}" required placeholder="Branch Name" name="" id="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-lg-4 col-md-4">
                                                                    <label class="col-form-label">Select Code Type</label>
                                                                    <select id="codeType" name="code_type" class="form-control form-select js-states single">
                                                                        <option value="both" {{ $data->code_type === 'both' ? 'selected' : '' }} >IFSC & SWIFT Code</option> <!-- Set as default --> <!-- change pr 22-9-25 -->
                                                                        <option value="IFSC" {{ $data->code_type === 'IFSC' ? 'selected' : '' }} >IFSC Code</option> <!-- change pr 18-9-25 --> <!-- change pr 22-9-25 -->
                                                                        <option value="Swift" {{ $data->code_type === 'Swift' ? 'selected' : '' }} >Swift Code</option> <!-- change pr 18-9-25 --> <!-- change pr 22-9-25 -->
                                                                    </select>
                                                                </div>
                                                            
                                                                <!-- Input field for IFSC Code -->
                                                                <div class="col-lg-4 col-md-4" id="ifscInputField">
                                                                    <label class="col-form-label" id="ifscLabel">IFSC Code</label>
                                                                    <input type="text" id="ifscInput" class="form-control" name="ifsc_code" value="{{ $data->ifsc_code }}" min="8" max="11" placeholder="Enter IFSC Code"> <!-- change pr 18-9-25 -->
                                                                </div>
                                                            
                                                                <!-- Input field for Swift Code -->
                                                                <div class="col-lg-4 col-md-4" id="swiftInputField">
                                                                    <label class="col-form-label" id="swiftLabel">SWIFT Code</label>
                                                                    <input type="text" id="swiftInput" class="form-control" name="swift_code" value="{{ $data->swift_code }}" min="8" max="11" placeholder="Enter Swift Code"> <!-- change pr 18-9-25 -->
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <div class="col-md-6">
                                                                    <label class="col-form-label">Password<span class="text-danger">*</span></label>
                                                                    <input id="password" class="form-control" type="password"
                                                                    name="password"  placeholder="Password">
                                                                        <i class="toggle-password cursor-pointer fa fa-fw fa-eye-slash"></i>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="col-form-label">Confirm Password<span class="text-danger">*</span></label>
                                                                    <input id="confirm_password" class="form-control" type="password" name="password_confirmation"
                                                                        placeholder="Confirm Password">
                                                                        <i class="toggle-password cursor-pointer fa fa-fw fa-eye-slash"></i>
                                                                </div>
                                                            </div>
                                                            <div class="py-3">
                                                                <button type="submit"
                                                                    class="border-0 btn btn-primary btn-gradient-primary btn-rounded">Update</button>&nbsp;&nbsp;
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- /Content End -->
                                            </div>
                                        </div>
                                        <!-- modal-content -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<!-- new pr 23-7-25-->
<script>

function displaySelectedVndImage(event) {
    const file = event.target.files[0]; // Get the selected file
    const imageElement = document.getElementById('selectedVndAvatar');

    // Validate the file type
    if (file && file.type.match('image.*')) {
        const reader = new FileReader();
        reader.onload = function(e) {
            imageElement.src = e.target.result; // Update the image source
        }
        reader.readAsDataURL(file); // Read the file as a Data URL
    } else {
        // Reset to default image if no valid file is selected
        imageElement.src = '/assets/img/user_profile.png';
    }
}  
function resetVndForm() {
    var imageEle = document.getElementById('selectedVndAvatar');
    var originalImage = document.getElementById('originalImage');
    imageEle.src = originalImage.src;
    document.getElementById('first_name').value = document.getElementById('original_first_name').innerText;
    document.getElementById('last_name').value = document.getElementById('original_last_name').innerText;
    document.getElementById('phone_number').value = document.getElementById('original_phone_number').innerText;
    document.getElementById('email').value = document.getElementById('original_email').innerText;
    document.getElementById('pan_number').value = document.getElementById('original_pan_number').innerText;
    document.getElementById('address').value = document.getElementById('original_address').innerText;
    document.getElementById('website').value = document.getElementById('original_website').innerText;
    document.getElementById('tax_number').value = document.getElementById('original_tax_number').innerText;
    document.getElementById('bank_account_no').value = document.getElementById('original_bank_account_no').innerText;
    document.getElementById('account_holder_name').value = document.getElementById('original_account_holder_name').innerText;
    document.getElementById('bank_name').value = document.getElementById('original_bank_name').innerText;
    document.getElementById('branch_name').value = document.getElementById('original_branch_name').innerText;
    document.getElementById('codeType').value = document.getElementById('original_code_type').innerText;
    document.getElementById('ifscInput').value = document.getElementById('original_ifsc_code').innerText;
    document.getElementById('swiftInput').value = document.getElementById('original_swift_code').innerText;
}
</script>
@endsection