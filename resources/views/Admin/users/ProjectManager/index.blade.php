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
                        </span> All Project Manager
                    </h3>
                </div>
                <div class="col p-0 text-end">
                    <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">All Project Managers</li>
                    </ul>
                </div>
            </div>

            <!-- Page Header -->
            <div class="page-header pt-3 mb-0 ">
                <div class="row">
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
                        <ul class="list-inline-item ps-0">
                            <li class="list-inline-item">
                                <!-- <button class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded" id="add-task" data-bs-toggle="modal" data-bs-target="#add_project">New Project</button> -->
                                <a class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded" href="{{route('admin.users.ProjectManager.trash')}}">All Trash</a>
                                <a class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded" href="{{route('admin.users.ProjectManager.create')}}">Create ProjectManager</a>
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
                                <table class="table table-striped table-nowrap custom-table mb-0 datatable mydata-table addexamplesearch">
                                    <thead class="text-center">
                                        <tr>
                                            {{-- <th class="checkBox">
                                                <label class="container-checkbox">
                                                    <input type="checkbox">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </th> --}}
                                            <th>Sr.</th>
                                            <th class="checkBox sorting">Manager ID</th>
                                            <th class="checkBox sorting" style="width: 25%;">Profile</th>
                                            <th class="checkBox sorting" style="width: 25%;">Name</th>
                                            <th class="checkBox sorting" style="width: 25%;">Email</th>
                                            <th class="checkBox sorting" style="width: 25%;">Phone Number</th>
                                            <th class="checkBox sorting" style="width: 25%;">Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                        @php
                                        $sr = 1;
                                    @endphp
                                    <tbody class="text-center">
                                        @foreach ($ProjectManagers as $ProjectManager)
                                        <tr>
                                            <td>{{ $sr++ }}</td>
                                            <td>{{$ProjectManager->username}}</td>
                                            <td>
                                                @if($ProjectManager->profile_picture)
                                                    <img src="{{ asset('uploads/ProjectManager/' . $ProjectManager->profile_picture) }}" class="avatar" alt="vendor Photo" />
                                                @else
                                                    <img src="{{ asset('/assets/img/user_profile.png') }}" class="avatar" alt="Default Photo" />
                                                @endif
                                            </td>
                                            <td>{{ $ProjectManager->first_name }} {{$ProjectManager->last_name}}</td>
                                            <td>
                                                <div class="user-email">
                                                    <a href="mailto:{{$ProjectManager->email}}">{{$ProjectManager->email}}</a>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="tel:{{$ProjectManager->phone_number}}">{{$ProjectManager->phone_number}}</a>
                                            </td>
                                            <td>
                                                @if ($ProjectManager->status === 'inactive')
                                                    <lable class="badge bg-danger">inactiv<span class="d-none">at</span>e</lable>
                                                @else
                                                    <label class="badge badge-gradient-success">Active</lable> 
                                                @endif
                                            </td>
                                            <td class="text-center d-flex">
                                                <a href="#" class="ms-2 p-2 fs-6 my_icons edit-PM"  data-bs-toggle="modal" data-id="{{ $ProjectManager->id }}" data-bs-target="#edit-form-PM">
                                                    <i class="fa-solid fa-pen-to-square text-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"></i>
                                                </a>
                                                {{-- <a href="#" class="ms-2 p-2 fs-6 my_icons"><i class="fa-solid fa-pen-to-square text-dark" data-bs-toggle="tooltip" data-bs-target="#edit-form-PM" data-bs-placement="top" title="Edit"></i></a> --}}
                                                <a href="#" class="ms-2 p-2 fs-6 my_icons"><i class="fa-solid fa-eye view-PM text-success" data-id="{{ $ProjectManager->id }}" data-bs-toggle="modal" data-bs-target="#PM-details-modal" data-bs-placement="top" title="View"></i></a>
                                                <form action="{{ route('admin.users.ProjectManager.destroy', $ProjectManager->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to move this vendor to trash?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="ms-2 p-2 fs-6 my_icons btn btn-link text-danger">
                                                        <i class="fa-solid fa-trash" data-bs-toggle="tooltip" data-bs-placement="top" title="Trash"></i>
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
                    <!-- <nav aria-label="Table pagination ">
                        <ul class="pagination justify-content-end mt-3 mypagination">
                           
                        </ul>
                    </nav> -->
                </div>
            </div>
            <!-- /Content End -->
        </div>
        <!-- /Page Content -->
    </div>
    <!-- /Page Wrapper -->
    <!--user Details Modal -->
        <div class="modal right fade" id="PM-details-modal" tabindex="-1" role="dialog" aria-modal="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="row w-100">
                            <div class="col-md-7 account d-flex">
                                <div>
                                    <!-- vendor Profile Picture -->
                                    <img src="{{ asset('/assets/img/user_profile.png') }}" class="avatar vendor-avatar" alt="vendor Photo" />
                                    <!-- vendor Name -->
                                    <span class="username">Project Manager Name</span> <!-- Will be updated dynamically -->
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
                                            <div class="accordion-header js-accordion-header">ProjectManager Details</div>
                                            <div class="accordion-body js-accordion-body">
                                                <div class="accordion-body__contents">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td class="border-0">ProjectManager status</td>
                                                                <td class="border-0 status">Loading...</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border-0">Name</td>
                                                                <td class="border-0 modal-title">Loading...</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border-0">Email</td>
                                                                <td class="border-0 PM-email">Loading...</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border-0">National ID</td>
                                                                <td class="border-0 PM-nationalID">Loading...</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border-0">Phone Number</td>
                                                                <td class="border-0 PM-phone">Loading...</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border-0">Address</td>
                                                                <td class="border-0 PM-address">Loading...</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border-0">PAN NO</td>
                                                                <td class="border-0 pan-no">Loading...</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border-0">Birth date</td>
                                                                <td class="border-0 birth-date">Loading...</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border-0">Skills</td>
                                                                <td class="border-0 skill">Loading...</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border-0">Payment type</td>
                                                                <td class="border-0 PT">Loading...</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border-0">Rate/Cost</td>
                                                                <td class="border-0 rate-cost">Loading...<span>Rs.</span></td>
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
     <!-- edit/update PM form -->
     <div class="modal right fade" id="edit-form-PM" tabindex="-1" role="dialog" aria-modal="true">
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
                            <form  method="POST" id="ManagerUpdate" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
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
                                        <div class="col-md-5">
                                            <label class="col-form-label">First Name<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="first_name" required placeholder="First Name">
                                        </div>
                                        <div class="col-md-5">
                                            <label class="col-form-label">Last Name<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="last_name" required placeholder="Last Name">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="col-form-label">status<span class="text-danger">*</span></label>
                                            <select class="form-control js-states single" name="status">
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                            </select>
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
                                                <div class="col-md-4">
                                                    <label class="col-form-label" for="">payment type<span class="text-danger">*</span></label>
                                                    <select class="form-control form-select js-states single" name="payment_type"  required id="">
                                                        <option value="hourly">Hourly</option>
                                                        <option value="monthly">Monthly</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-8">
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
                                                <input type="text" class="inputtag form-control" id="UpdateskillsInput" placeholder="Enter your Skills">
                                                <div class="tags clear"><span class="text-danger" id="error-msg"></span></div>
                                                <input type="hidden" name="skills" id="Updateskills" required> <!-- Hidden input to store skills as JSON -->
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
                                            <input class="form-control PMphone"   type="text" name="phone_number" value="{{ old('phone_number') }}">
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
                                        <button type="button" id="Updatesubmit-btn"
                                            class="border-0 btn btn-primary btn-gradient-primary btn-rounded">Update</button>&nbsp;&nbsp;
                                        {{-- <button type="cancle" class="btn btn-secondary btn-rounded">Cancel</button> --}}
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
    <!-- end edit/update PM form -->
@endsection