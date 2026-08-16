@extends('customer.layouts.master')
@include('customer.layouts.sidebar')
@include('customer.layouts.headerMenu')
@section('content') 
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="crms-title row bg-white">
            <div class="col  p-0">
                <h3 class="page-title m-0">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="bi bi-person"></i>
                    </span> Customer Profile
                </h3>
            </div>
            <div class="col p-0 text-end">
                <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                    <li class="breadcrumb-item"><a href="{{ route('customer.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Customer Profile</li>
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
                                                <img alt ="" id="originalImage" src = "{{ asset('uploads/customers/' . $data->profile_picture) }}" > 
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
                                                <div class="title mt-2">Designation</div>
                                                <div class="text">
                                                    <a class=""  href="">
                                                        <span class="text-muted" id="original_description">{{$data->description}}</span>
                                                    </a>
                                                </div>
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
                                                <div class="title mt-2">Status</div>
                                                <div class="text">
                                                    <a class="text-muted" href="">
                                                        {{$data->status}}
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
                                            <div class="title mt-2">Company Phone Number</div>
                                            <div class="text">
                                                <a class="text-muted" href="">
                                                    {{$data->company_phone_number}}
                                                </a>
                                            </div>
                                            <div class="title mt-2">Company Email</div>
                                            <div class="text">
                                                <a class="text-muted" href="">
                                                    {{$data->company_email}}
                                                </a>
                                            </div>
                                            <div class="title mt-2">Pan Number</div>
                                            <div class="text">
                                                <a class="text-muted" href="">
                                                    <span id="original_pan_number">{{$data->pan_number}}</span>
                                                </a>
                                            </div>
                                            <div class="title mt-2">TAX Number</div>
                                            <div class="text">
                                                <a class="text-muted" href="">
                                                    <span id="original_tax_number">{{$data->tax_number}}</span>
                                                </a>
                                            </div>
                                            <div class="title mt-2">Address</div>
                                            <div class="text">
                                                <a class="text-muted" href="">
                                                    <span id="original_address">{{$data->address}}</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pro-edit">
                                    <a data-bs-toggle="modal" data-bs-target="#update-resource" onclick="resetCusForm()" class="edit-icon" href="#">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </div>
                                <div class="modal right fade" id="update-resource" tabindex="-1" role="dialog" aria-modal="true">
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
                                                        <!-- use Auth::id(); to update the details. -->
                                                        <form action="{{ route('customer.update') }}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PATCH')
                                                            <div class="row">
                                                                <div>
                                                                    <div class="d-flex mb-4 position-relative">
                                                                        @if($data->profile_picture)
                                                                            <img id="selectedCusAvatar" src="{{ asset('uploads/customers/' . $data->profile_picture) }}"
                                                                                    class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;" alt="example placeholder" />
                                                                        @else
                                                                            <img id="selectedCusAvatar" src="{{asset('/assets/img/user_profile.png')}}" 
                                                                                class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;" alt="example placeholder" />
                                                                        @endif    
                                                                        <label class="form-label uplode text-white m-1" for="customFile2">Choose file</label>
                                                                        <input type="file" class="form-control d-none" name="profile_picture" id="customFile2" onchange="displaySelectedCusImage(event)" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <h3>Company Details</h3>
                                                            <div class="form-group row">
                                                                <div class="col-md-6">
                                                                    <label class="col-form-label">PAN.No</label>
                                                                    <input class="form-control" id="pan_number" type="text" name="pan_number" value="{{ $data->pan_number }}" placeholder="PAN.NO">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="col-form-label">TAX.No</label>
                                                                    <input class="form-control" id="tax_number" type="text" name="tax_number" value="{{ $data->tax_number }}" placeholder="TAX.NO">
                                                                </div>
                                                            </div>

                                                            <h3>Customer Details</h3>
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
                                                                <div class="col-md-6">
                                                                    <label class="col-form-label">Designation</label>
                                                                    <textarea class="form-control" id="description" name="description" style="height: 41px;"  rows="3" type="text" placeholder="Designation">{{ $data->description }}</textarea>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="col-form-label">Email</label>
                                                                    <input class="form-control" id="email" type="email" name="email" value="{{ $data->email }}" pattern="[^@\s]+@[^@\s]+"  placeholder="example@gmail.com">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-6 mynumber">
                                                                    <label class="col-form-label">Phone Number</label>
                                                                    <input class="form-control phone" id="phone_number"  type="text" name="phone_number" value="{{ $data->phone_number }}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="col-form-label">Address</label>
                                                                    <textarea class="form-control" id="address" name="address" style="height: 41px;"  rows="3" type="text" placeholder="Address">{{ $data->address }}</textarea>
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
function displaySelectedCusImage(event) {
    const file = event.target.files[0]; // Get the selected file
    const imageElement = document.getElementById('selectedCusAvatar');

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
function resetCusForm() {
    var imageEle = document.getElementById('selectedCusAvatar');
    var originalImage = document.getElementById('originalImage');
    imageEle.src = originalImage.src;
    document.getElementById('first_name').value = document.getElementById('original_first_name').innerText;
    document.getElementById('last_name').value = document.getElementById('original_last_name').innerText;
    document.getElementById('description').value = document.getElementById('original_description').innerText;
    document.getElementById('email').value = document.getElementById('original_email').innerText;
    document.getElementById('phone_number').value = document.getElementById('original_phone_number').innerText;
    document.getElementById('pan_number').value = document.getElementById('original_pan_number').innerText;
    document.getElementById('tax_number').value = document.getElementById('original_tax_number').innerText;
    document.getElementById('address').value = document.getElementById('original_address').innerText;
}
</script>
@endsection