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
                        </span>Create Project Manager
                    </h3>
                </div>
                <div class="col p-0 text-end">
                    <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.users.ProjectManager.index')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Create Manager</li>
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
                    <form action="{{route('admin.users.ProjectManager.store')}}"  method="POST" id="ManagerCreate" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div >
                            <div class="d-flex mb-4 position-relative">
                                <img id="selectedAvatar" src="{{asset('/assets/img/user_profile.png')}}"
                                class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;" alt="example placeholder" />
                                <label class="form-label uplode text-white m-1" for="customFile2">Choose file</label>
                                <input type="file" class="form-control d-none" name="profile_picture" id="customFile2" onchange="displaySelectedImage(event, 'selectedAvatar')" />
                            </div>
                        </div>
                    </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="col-form-label">First Name<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="first_name" required placeholder="First Name">
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label">Last Name<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="last_name" required placeholder="Last Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label class="col-form-label">Birth Date<span class="text-danger">*</span></label>
                                <div>
                                    <input type="date" class="form-control" required  name="birth_date" placeholder="MM/DD/YY">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label class="col-form-label" for="">payment type<span class="text-danger">*</span></label>
                                        <select class="form-control form-select js-states single" name="payment_type" required id="">
                                            <option value="Hourly">Hourly</option>
                                            <option value="Monthly">Monthly</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-form-label" for="">Rate/Cost<span class="text-danger">*</span></label>
                                        <input class="form-control" placeholder="Put only INR" type="text" name="rate">
                                    </div>
                            </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="inputArea">
                                    <label class="col-form-label">Skills<span class="text-danger">*</span></label>
                                    <input type="text" class="inputtag form-control" id="skillsInput" placeholder="Enter your Skills">
                                    <div class="tags clear"><span class="text-danger" id="error-msg"></span></div>
                                    <input type="hidden" name="skills" id="skills" required> <!-- Hidden input to store skills as JSON -->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label">Email<span class="text-danger">*</span></label>
                                <input class="form-control" type="email" name="email" pattern="[^@\s]+@[^@\s]+" required placeholder="example@gmail.com">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 mynumber">
                                <label class="col-form-label ">Phone number<span class="text-danger">*</span></label>
                                <input class="form-control phone"   type="text" name="phone_number" value="{{ old('phone_number') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label">National ID<span class="text-danger">*</span></label>
                                <input class="form-control" type="number" name="national_id" required placeholder="National ID  ">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="col-form-label">PAN.No<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="pan_number" required placeholder="PAN.NO">
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label">Address<span class="text-danger">*</span></label>
                                <textarea class="form-control" name="address" style="height: 41px;" required rows="3" type="text" placeholder="Address"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="col-form-label">Password<span class="text-danger">*</span></label>
                                <input id="password" class="form-control" type="password"
                                   name="password" required placeholder="Password">
                                   {{-- <i class="toggle-password cursor-pointer fa fa-fw fa-eye-slash"></i> --}}
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label">Confirm Password<span class="text-danger">*</span></label>
                                <input id="confirm_password" class="form-control" type="password" name="password_confirmation"
                                     required placeholder="Confirm Password">
                                     {{-- <i class="toggle-password cursor-pointer fa fa-fw fa-eye-slash"></i> --}}
                            </div>
                        </div>
                    <div class="form-group row">
                    
                        
                    </div>
                        <div class="py-3">
                            <button type="submit"
                                class="border-0 btn btn-primary btn-gradient-primary btn-rounded">Create
                                </button>&nbsp;&nbsp;
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