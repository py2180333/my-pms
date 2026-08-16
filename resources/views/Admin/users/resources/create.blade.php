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
                        </span>Create Resource
                    </h3>
                </div>
                <div class="col p-0 text-end">
                    <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.users.Resources.index')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Create Resource</li>
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
                    <form 
                    action="{{route('admin.users.Resources.store')}}"  
                    method="POST" id="ResourceCreate" class="needs-validation card" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div >
                            <div class="d-flex mb-4 position-relative">
                                <img id="selectedAvatar" src="{{asset('/assets/img/user_profile.png')}}"
                                class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;" alt="example placeholder" />
                                <label class="form-label uplode text-white m-1" for="customFile2">Choose file</label>
                                <input type="file" class="form-control d-none" name="profile_picture" id="customFile2" onchange="displaySelectedImage(event, 'selectedAvatar')" />
                            </div>
                            <!-- <div>
                                <select name="company_ids[]" multiple>
                                    <option disabled>select companies</option>
                                    @foreach ($companys as $company)
                                        <option value="{{$company->id}}">{{$company->company_name}}</option>
                                    @endforeach
                                </select>
                            </div> -->
                        </div>
                    </div>
                    <div class="row">
                                    <div class="col-4">
                                    <!-- <select  name="company_ids[]" multiple>
                                        <option disabled>select companies</option>
                                        @foreach ($companys as $company)
                                            <option value="{{$company->id}}">{{$company->company_name}}</option>
                                        @endforeach
                                    </select> -->
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
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="col-form-label">First Name<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="first_name" value="{{ old('first_name') }}" required placeholder="First Name">
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label">Last Name<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="last_name" value="{{ old('last_name') }}" required placeholder="Last Name">
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label">Designation<span class="text-danger">*</span></label>
                                <select class="form-control form-select" name="role">
                                    <option value="consultant" {{ old('role') === 'consultant' ? 'selected' : '' }}>Consultant</option>
                                    <option value="senior_consultant" {{ old('role') === 'senior_consultant' ? 'selected' : '' }}>Senior Consultant</option>
                                    <option value="team_lead" {{ old('role') === 'team_lead' ? 'selected' : '' }}>Team Lead</option>
                                    <option value="senior_team_lead" {{ old('role') === 'senior_team_lead' ? 'selected' : '' }}>Senior Team Lead</option>
                                    <option value="project_manager" {{ old('role') === 'project_manager' ? 'selected' : '' }}>Project Manager</option>
                                    <option value="senior_project_manager" {{ old('role') === 'senior_project_manager' ? 'selected' : '' }}>Senior Project Manager</option>
                                    <option value="program_manager" {{ old('role') === 'program_manager' ? 'selected' : '' }}>Program Manager</option>
                                    <option value="senior_program_manager" {{ old('role') === 'senior_program_manager' ? 'selected' : '' }}>Senior Program Manager</option>
                                    <option value="vice_president" {{ old('role') === 'vice_president' ? 'selected' : '' }}>Vice President</option>
                                    <option value="director" {{ old('role') === 'director' ? 'selected' : '' }}>Director</option>
                                    <option value="ceo" {{ old('role') === 'ceo' ? 'selected' : '' }}>Ceo</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label class="col-form-label">Birth Date</label>
                                <div>
                                    <input type="date" class="form-control" max="{{ date('Y-m-d', strtotime('-18 years')) }}" style="text-transform: uppercase;" name="birth_date" value="{{ old('birth_date') }}" placeholder="MM/DD/YYYY">
                                </div>
                            </div>
                            <div class="col-md-4">
                                        <label class="col-form-label" for="">Payment Type</label>
                                        <select class="form-control form-select js-states single" name="payment_type" requred id="">
                                            <option value="Hourly" {{ old('payment_type') === 'Hourly' ? 'selected' : '' }}>Hourly</option>
                                            <option value="Monthly" {{ old('payment_type') === 'Monthly' ? 'selected' : '' }}>Monthly</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <label class="col-form-label" for="">Rate/Cost</label>
                                        <input class="form-control" placeholder="Only INR" type="text" name="rate" value="{{ old('rate') }}">
                                    </div>
                           
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="inputArea">
                                    <label class="col-form-label">Skills</label>
                                    <input type="text" class="inputtag form-control" id="skillsInput" placeholder="Enter your Skills">
                                    <div class="tags clear"><span class="text-danger" id="error-msg"></span></div>
                                    <input type="hidden" name="skills" id="skills" > <!-- Hidden input to store skills as JSON -->
                                </div>
                            </div>
                            <div class="col-md-6 mynumber">
                                <label class="col-form-label">Phone number<span class="text-danger">*</span></label>
                                <input class="form-control phone" type="text" name="phone_number">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="col-form-label">Email</label>
                                <input class="form-control" type="email" name="email" value="{{ old('email') }}" pattern="[^@\s]+@[^@\s]+" placeholder="Example@gmail.com">
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label">National ID</label>
                                <input class="form-control" type="number" name="national_id" value="{{ old('national_id') }}" placeholder="National ID  ">
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label">Role</label>
                                <input class="form-control" type="text" name="designation" value="{{ old('designation') }}" placeholder="Eg: WordPress Developer">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="col-form-label">PAN No</label>
                                <input class="form-control" type="text" name="pan_number" value="{{ old('pan_number') }}" placeholder="AAAPA1234A">
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label">Address</label>
                                <textarea class="form-control" name="address" style="height: 41px;" rows="3" type="text" placeholder="Address">{{ old('address') }}</textarea>
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
                            <!-- submit to button change by pranv because 
                                when clicking on Enter in the "skill" field, it focuses on the "password" field
                                26-9-25 -->
                            <button type="button" onclick="this.form.submit()"
                                class="border-0 btn btn-primary btn-gradient-primary btn-rounded">Create
                                Resource</button>&nbsp;&nbsp;
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