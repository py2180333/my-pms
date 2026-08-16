@extends('Admin.layouts.master')
@include('Admin.layouts.sidebar')
@include('Admin.layouts.headerMenu')

@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper milnewpopup create_p">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Title -->
            <div class="crms-title row bg-white">
                <div class="col p-0">
                    <h3 class="page-title m-0">Create Milestone</h3>
                </div>
                <div class="col p-0 text-end">
                    <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                        <li class="breadcrumb-item"><a href="index.html">Milestone</a></li>
                        <li class="breadcrumb-item active">Create Milestone</li>
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
            <!-- Content Starts -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <form action="{{ route('admin.milestones.store') }}" class="needs-validation card" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Project Name<span class="text-danger">*</span></label>
                                <select class="form-select form-control" id="projectselectmil" required name="project_id">
                                    <option value="" disabled selected>Select Project</option>
                                    @foreach($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Milestone Name<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="milestone_name" value="{{ old('milestone_name') }}" required id="milestoneName" placeholder="Milestone Name">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Milestone Date<span class="text-danger">*</span></label>
                                <input  class="form-control" style="text-transform: uppercase;" required type="date" name="milestone_date" id="milestoneDateCreate" disabled> <!-- pr add 9-9-25 project range app.js 1300 -->
                            </div>
                        </div>

                        <div class="row mb-3">
                           
                            <div class="col-md-4">
                                <label class="form-label">Forecasting Date<span class="text-danger">*</span></label>
                                <input  class="form-control" style="text-transform: uppercase;" type="date" required name="forecasting_date" id="forecastingDateCreate" disabled> <!-- pr add 9-9-25 project range app.js 1300 -->
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Milestone Amount<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="amount" value="{{ old('amount') }}" required pattern="^\d{1,13}(\.\d{1,2})?$" placeholder="Milestone Amount">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Status<span class="text-danger">*</span></label>
                                <select class="form-select form-control" name="status" required id="milestoneStatus">
                                    <option value="" disabled selected>Select Status</option>
                                    <option value="Planning" {{ old('status') === 'Planning' ? 'selected' : '' }}>Planning</option>
                                    <option value="In Progress" {{ old('status') === 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="Completed" {{ old('status') === 'Completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            
                            <div class="col-md-12">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="description" id="milestoneDescription">{{ old('description') }}</textarea>
                            </div>
                        </div>

                        <div class="py-3">
                            <button type="submit" class="btn btn-primary btn-gradient-primary btn-rounded">Create Milestone</button>
                        </div>        
                    </form>
                     <!-- Milestones Table -->
                        <div class="card-body card" id="milestone-section" style="display: none;">
                            <h4 class="mt-3">Milestones</h4>
                            <table class="table table-striped table-nowrap custom-table mb-0 datatable addexamplesearch dataTable no-footer" id="milestone-table">
                                <thead>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Milestone Name</th>
                                        <th class="text-center">Milestone Date</th>
                                        <th class="text-center">Forecasting Date</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Dynamic data will apper here app.js -->
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
