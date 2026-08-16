@extends('Admin.layouts.master')
@include('Admin.layouts.sidebar')
@include('Admin.layouts.headerMenu')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper create_p">
        <!-- Page Content -->
        <div class="content container-fluid">
            <div class="crms-title row bg-white">
                <div class="col p-0">
                    <h3 class="page-title m-0">
                        <span class="page-title-icon bg-gradient-primary text-white me-2">
                            <i class="bi bi-grid"></i>
                        </span>Create Project 
                    </h3>
                </div>
                <div class="col p-0 text-end">
                    <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Projects</li>
                    </ul>
                </div>
            </div>

            <!-- Content Starts -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <form action="{{ route('admin.projects.store') }}" class="needs-validation card"  method="POST" enctype="multipart/form-data" id="projectdetails">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="col-form-label">Project Name<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" required name="name" value="{{ old('name') }}" placeholder="Project Name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label">Project Description</label>
                                <textarea style="height:41px;" class="form-control" placeholder="Project Description"  name="description">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="col-form-label">Company<span class="text-danger">*</span></label>
                                <select class="form-control form-select js-states single rd-company-project" required name="company_id">
                                    <option value="">Select Company</option>
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}> {{$company->company_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label">Customer<span class="text-danger">*</span></label>
                                <select class="form-control form-select js-states single customer-id" required name="customer_id">
                                    <option value="" disabled>Select Customer</option>
                                    {{-- use ajax for display customer based on company --}}
                                </select>
                                @error('customer_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label">Vendor</label>
                                <select class="form-control form-select js-states single vendor-id"  name="vendor_id">
                                    <option value="">Select Vendor</option>
                                    {{-- use ajax for display vendor based on company --}}
                                </select>
                                @error('vendor_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="col-form-label">Start Date<span class="text-danger">*</span></label>
                                <input id="start_date" class="form-control" style="text-transform: uppercase;" type="date" name="start_date" required value="{{ old('start_date') }}">
                                @error('start_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label">Forcasting Date<span class="text-danger">*</span></label>
                                <input id="end_date" class="form-control" style="text-transform: uppercase;" type="date" name="end_date" required value="{{ old('end_date') }}">
                                @error('end_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="col-form-label">Project Manager<span class="text-danger">*</span></label>
                                <select class="form-control form-select js-states single project_manager_id" required name="project_manager_id">
                                    <option value="">Select Project Manager</option>
                                    {{-- use ajax for display Project Manager based on company --}}
                                </select>
                                @error('project_manager_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label">Status<span class="text-danger">*</span></label>
                                <select class="form-control form-select js-states single" required name="status">
                                    <option value="">Select Status</option>
                                    <option value="planning" {{ old('status') == 'planning' ? 'selected' : '' }}>Planning</option>
                                    <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="hold" {{ old('status') == 'hold' ? 'selected' : '' }}>Hold</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="col-form-label">Project Value<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" required name="project_value" value="{{ old('project_value') }}" placeholder="Project value">
                                @error('project_value')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="currency-dropdown">Choose Currency<span class="text-danger">*</span></label>
                                <select class="form-control form-select" required id="currency-dropdown" name="currency"> <!-- pr -->
                                    <!-- Options will be dynamically populated -->
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label">Document</label>
                                <input class="form-control" type="file" name="documents[]" accept=".pdf,.jpg,.png,.docx" id="attachment" multiple>
                                <p id="files-area">
                                    <span id="filesList">
                                        <span id="files-names"></span>
                                    </span>
                                </p>
                                <p class="m-0" id="file-count">No files selected</p>

                                @error('documents')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label class="col-form-label">Notes/Comments</label>
                                <textarea class="form-control" rows="3" name="notes">{{ old('notes') }}</textarea>
                            </div>
                        </div>

                        <div class="text-center py-3">
                            <button type="submit" class="border-0 btn btn-primary btn-gradient-primary btn-rounded">Save</button>
                            &nbsp;&nbsp;
                            <button type="button" class="btn btn-secondary btn-rounded">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper end -->
@endsection
@section('script')
<script src="{{asset('/assets/js/companybased.js')}}"></script>
@endsection
