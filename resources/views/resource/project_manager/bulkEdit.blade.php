@extends('resource.master')
@include('resource.sidebar')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <div class="crms-title row bg-white mb-4">
            <div class="col  p-0">
                <h3 class="page-title m-0">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="bi bi-grid"></i>
                    </span> Timesheet Bulk Edit </h3>
            </div>
            <div class="col p-0 text-end">
                <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                    <li class="breadcrumb-item"><a href="{{ route('resource.timesheet.project_manager.show') }}">Back To Timesheet</a></li>
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
            </div>
            <div class="row">
                <div class="col">
                </div>
            </div>
        </div>
        <!-- /Page Header -->
      
        <form action="{{ route('resource.timesheet.projectManager.bulkEdit.store') }}" method="post">
            @csrf
            @method('PUT')

            <!-- Drop Downs -->
                <div class="crms-title row bg-white mb-4 rounded">
                     <div class="rs-bulk-edit ">
                <select name="project" class="form-select dropDown w-auto" id="projectId">
                    <option value="all">All Projects</option>
                    @foreach($project as $p)
                        <option value="{{ $p->id }}">{{ $p->project_name }}</option>
                    @endforeach
                </select>

                <select name="resource" class="form-select dropDown ms-2 w-auto" id="resourceId">
                    <option value="all">All Resources</option>
                    @foreach($resource as $r)
                        <option value="{{ $r->id }}">{{ $r->first_name }} {{ $r->last_name }}</option>
                    @endforeach
                </select>

                <select name="week" class="form-select dropDown ms-2 w-auto" id="week">
                    <option value="1">1 week</option>
                    <option value="2">2 week</option>
                    <option value="3">3 week</option>
                    <option value="4">4 week</option>
                    <option value="5">5 week</option>
                </select>

                <input type="hidden" name="startDate" id="start-date">
                <input type="hidden" name="endDate" id="end-date">

                <select name="status" class="form-select dropDown ms-2 w-auto" id="status">
                    <option value="pending">Pending</option>
                    <option value="approve">Approve</option>
                    <option value="recheck">Recheck</option>
                    <option value="reject">Reject</option>
                </select>

                <button type="submit" name="allAction" value="approve" class="ms-2 p-2 fs-6 btn btn-success all-btn btn-approve w-auto">All Approve</button>
                <button type="submit" name="allAction" value="recheck" class="ms-2 p-2 fs-6 btn btn-warning all-btn btn-recheck w-auto">All Recheck</button>
                <button type="submit" name="allAction" value="reject" class="ms-2 p-2 fs-6 btn btn-danger all-btn btn-reject w-auto">All Reject</button>
                
            </div>
                </div>
           
            <!-- /Drop Downs -->

            <!-- Content Starts -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="mainTable" class="table table-striped table-nowrap custom-table mb-0 datatable addexamplesearch">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                <input type="checkbox" id="selectAll" />
                                                Select all
                                            </th>
                                            <th class="text-center">
                                                Sr.
                                            </th>
                                            <th class="text-center">Project Name</th>
                                            <th class="text-center">Task Name</th>
                                            <th class="text-center">Resources Name</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- dynamic row apper here from timesheet_bulk_edit -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Content End -->

        </form>

    </div>
    <!-- /Page Content -->

</div>
<!-- /Page Wrapper end -->
@endsection
@section('script') <!-- this is for bulkedit -->
    <script src="{{asset('/assets/js/timesheet_bulk_edit.js')}}"></script> <!-- pranav -->
@endsection
