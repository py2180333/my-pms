@extends('Admin.layouts.master')
@include('Admin.layouts.sidebar')
@include('Admin.layouts.headerMenu')
@section('content')
    <!-- Page Wrapper show all resources -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">

            <div class="crms-title row bg-white mb-4">
                <div class="col  p-0">
                    <h3 class="page-title m-0">
                        <span class="page-title-icon bg-gradient-primary text-white me-2">
                            <i class="bi bi-grid"></i>
                        </span> All Resources
                    </h3>
                </div>
                <div class="col p-0 text-end">
                    <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">All Resources</li>
                    </ul>
                </div>
            </div>
            
            <!-- show count data -pr -->
            <div class="row">
                <div class="col-xl-4 col-sm-6 col-12">
                    <div class="card inovices-card">
                        <div class="card-body">
                            <div class="inovices-widget-header">
                                <span class="inovices-widget-icon">
                                    <img src="{{asset('/assets/img/invoices-icon1.svg')}}" alt="">
                                </span>
                                <div class="inovices-dash-count">
                                    <div class="inovices-amount" id="allResources">-</div>
                                </div>
                            </div>
                            <p class="inovices-all">All Resources <span></span></p>
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
                    <div class="col-4 p-0">
                        <ul class="app-listing justify-content-start filter-data m-0">
                            <!-- Company Filter -->
                            <li class="w-100">
                                <div class="multipleSelection m-0">
                                    <select id="company-filter-resouces" class="form-select">
                                        <option value="all" selected>All Companies</option>
                                        @foreach ($companys as $company)
                                            <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </li>
                    
                            <!-- Designation Filter -->
                            <li class="w-100">
                                <div class="multipleSelection m-0">
                                    <select id="status-filter-resouces" class="form-select">
                                        <option value="all" selected>All Designation</option>
                                        <option value="consultant">consultant</option>
                                        <option value="senior_consultant">Senior Consultant</option>
                                        <option value="team_lead">Team Lead</option>
                                        <option value="senior_team_lead">Senior Team Lead</option>
                                        <option value="project_manager">Project Manager</option>
                                        <option value="senior_project_manager">Senior Project Manager</option>
                                        <option value="program_manager">Program Manager</option>
                                        <option value="senior_program_manager">Senior Program Manager</option>
                                        <option value="vice_president">Vice President</option>
                                        <option value="director">Director</option>
                                        <option value="ceo">Ceo</option>
                                    </select>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- /pr -->
                    <div class="col-4">
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

                    <div class="col-4 text-end">
                        <ul class="list-inline-item ps-0 m-0">
                            <li class="list-inline-item">
                                <!-- <button class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded" id="add-task" data-bs-toggle="modal" data-bs-target="#add_project">New Project</button> -->
                                <a class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded" href="{{route('admin.users.Resources.trash')}}">All Trash</a>
                                <a class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded" href="{{route('admin.users.Resources.create')}}">Create Resource</a>
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
                                <table class="table table-striped table-nowrap custom-table mb-0 datatable mydata-table addexamplesearch resourcesearch">
                                    <thead class="text-center">
                                        <tr>
                                            {{-- <th class="checkBox">
                                                <label class="container-checkbox">
                                                    <input type="checkbox">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </th> --}}
                                            <th>Sr.No</th>
                                            <th class="checkBox sorting">Manager ID</th>
                                            <th class="checkBox sorting" style="width: 25%;">Profile</th>
                                            <th class="checkBox sorting" style="width: 25%;">Name</th>
                                            <th class="checkBox sorting" style="width: 25%;">Email</th>
                                            <th class="checkBox sorting" style="width: 25%;">Phone Number</th>
                                            <th class="checkBox sorting" style="width: 25%;">Designation</th>
                                            <th class="checkBox sorting" style="width: 25%;">Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                        @php
                                        $sr = 1;
                                    @endphp
                                    <tbody class="text-center" id="resource-data">
                                        <!-- Data will be inserted here via AJAX -pr -->
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
    <!-- /Page Wrapper show all resources-->
    <!--user resource Details Modal -->
    <div class="modal right fade" id="resource-details-modal" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row w-100">
                        <div class="col-md-7 account d-flex">
                            <div>
                                <!-- vendor Profile Picture -->
                                <img src="{{ asset('/assets/img/user_profile.png') }}" class="avatar vendor-avatar" alt="vendor Photo" />
                                <!-- vendor Name -->
                                <span class="username">resource UserName</span> <!-- Will be updated dynamically -->
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
                                        <div class="accordion-header js-accordion-header">Resource Details</div>
                                        <div class="accordion-body js-accordion-body">
                                            <div class="accordion-body__contents">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td class="border-0">Resource status</td>
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
                                                            <td class="border-0">Designation</td>
                                                            <td class="border-0 role">Loading...</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border-0">Work</td>
                                                            <td class="border-0 Designation">Loading...</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border-0">Payment type</td>
                                                            <td class="border-0 PT">Loading...</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border-0">Rate/Cost</td>
                                                            <td class="border-0 rate-cost">Loading...<span>Rs.</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border-0">Created By</td>
                                                            <td class="border-0 created-by">Loading...</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border-0">Created At</td>
                                                            <td class="border-0 created-at">Loading...</td>
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
    <!-- end user resource details modal -->
    <!-- edit/update Resource form -->
    <div class="modal right fade" id="edit-form-resource" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center">Edit Resource</h4>
                    <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Content Starts -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <form  method="POST" id="ResourceUpdate" enctype="multipart/form-data">
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

                                        <!-- pr new 4-9-25 -->
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
                                                                <input value="{{$company->id}}" name="company_ids[]" type="checkbox">{{$company->company_name}}
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /pr new 4-9-25 -->

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
                                        <div class="col-md-6">
                                            <label class="col-form-label">status<span class="text-danger">*</span></label>
                                            <select class="form-control form-select js-states single" name="status">
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-form-label">Birth Date</label>
                                            <input type="date" class="form-control"   name="birth_date" placeholder="MM/DD/YY">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label class="col-form-label" for="">payment Type</label>
                                            <select class="form-control form-select js-states single" name="payment_type" id="">
                                                <option value="hourly">Hourly</option>
                                                <option value="monthly">Monthly</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-form-label" for="">Rate/Cost</label>
                                            <input class="form-control" placeholder="Put only INR" type="text" name="rate">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label class="col-form-label">Designation<span class="text-danger">*</span></label>
                                            <select class="form-control form-select" required name="role">
                                                <option value="consultant">consultant</option>
                                                <option value="senior_consultant">Senior Consultant</option>
                                                <option value="team_lead">Team Lead</option>
                                                <option value="senior_team_lead">Senior Team Lead</option>
                                                <option value="project_manager">Project Manager</option>
                                                <option value="senior_project_manager">Senior Project Manager</option>
                                                <option value="program_manager">Program Manager</option>
                                                <option value="senior_program_manager">Senior Program Manager</option>
                                                <option value="vice_president">Vice President</option>
                                                <option value="director">Director</option>
                                                <option value="ceo">Ceo</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-form-label">Role</label>
                                            <input class="form-control" type="text" name="designation" placeholder="Ex. Wordpress Developer">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label class="col-form-label">Email</label>
                                            <input class="form-control" type="email" name="email" pattern="[^@\s]+@[^@\s]+"  placeholder="example@gmail.com">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-form-label">National ID</label>
                                            <input class="form-control" type="number" name="national_id"  placeholder="National ID  ">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6 mynumber">
                                            <label class="col-form-label ">Phone Number</label>
                                            <input class="form-control PMphone"  type="text" name="phone_number" value="{{ old('phone_number') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="inputArea">
                                                <label class="col-form-label">Skills</label>
                                                <input type="text" class="inputtag form-control" id="Resourceskills" placeholder="Enter your Skills">
                                                <div class="tags clear resource-skill"><span class="text-danger" id="Rs-error-msg"></span></div>
                                                <input type="hidden" name="skills" id="ResourceUpdateskills" required> <!-- Hidden input to store skills as JSON -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label class="col-form-label">PAN.No</label>
                                            <input class="form-control" type="text" name="pan_number"  placeholder="PAN.NO">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-form-label">Address</label>
                                            <textarea class="form-control" name="address" style="height: 41px;"  rows="3" type="text" placeholder="Address"></textarea>
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
                                        <button type="button" id="UpdateResource-submit-btn"
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
    <!-- end edit/update resource form -->
@endsection
@section('script')
<script src="{{asset('/assets/js/resourceview.js')}}"></script> <!-- pr -->
@endsection