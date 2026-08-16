@extends('Admin.layouts.master')
@include('Admin.layouts.sidebar')
@include('Admin.layouts.headerMenu')
@section('content') 
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="crms-title row bg-white">
            <div class="col  p-0">
                <h3 class="page-title m-0">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="bi bi-person"></i>
                    </span> Admin Profile
                </h3>
            </div>
            <div class="col p-0 text-end">
                <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Admin Profile</li>
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
                                
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <a class="" href="">
                                                    <h3 class="user-name m-t-0 mb-0"> 
                                                        <span id="original_name">{{$data->name}}</span> 
                                                    </h3>
                                                </a>
                                                <div class="title mt-2">Username</div>
                                                <div class="text">
                                                    <a class=""  href="">
                                                        <span class="text-muted">{{$data->username}}</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="title mt-2">Email</div>
                                            <div class="text">
                                                <a class="text-muted" href="">
                                                    <span id="original_email">{{$data->email}}</span>
                                                </a>
                                            </div>
                                            <div class="title mt-2">Phone Number</div>
                                            <div class="text">
                                                <a class="text-muted" href="">
                                                    <span id="original_phone_number">{{$data->phoneNumber}}</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pro-edit">
                                    <a data-bs-toggle="modal" data-bs-target="#update-resource" onclick="resetAdminForm()" class="edit-icon" href="#">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </div>
                                <div class="modal right fade" id="update-resource" tabindex="-1" role="dialog" aria-modal="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title text-center">Edit Admin</h4>
                                                <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Content Starts -->
                                                <div class="row mt-4">
                                                    <div class="col-md-12">
                                                        <!-- use Auth::id(); to update the details. -->
                                                        <form action="{{ route('admin.update') }}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PATCH')

                                                            <h3>Admin Details</h3>
                                                            <div class="form-group row">
                                                                <div class="col-md-6">
                                                                    <label class="col-form-label">Name<span class="text-danger">*</span></label>
                                                                    <input class="form-control" id="name" type="text" name="name" value="{{ $data->name }}" placeholder="First Name">
                                                                </div>
                                                                <div class="col-md-6 mynumber">
                                                                    <label class="col-form-label">Phone Number</label>
                                                                    <input class="form-control phone" id="phone_number"  type="text" name="phoneNumber" value="{{ $data->phoneNumber }}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-6">
                                                                    <label class="col-form-label">Email</label>
                                                                    <input class="form-control" id="email" type="email" name="email" value="{{ $data->email }}" pattern="[^@\s]+@[^@\s]+"  placeholder="example@gmail.com">
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
function resetAdminForm() {
    document.getElementById('name').value = document.getElementById('original_name').innerText;
    document.getElementById('email').value = document.getElementById('original_email').innerText;
    document.getElementById('phone_number').value = document.getElementById('original_phone_number').innerText;
}
</script>
@endsection