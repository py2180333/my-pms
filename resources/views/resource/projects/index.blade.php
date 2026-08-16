@extends('resource.master')
@include('resource.sidebar')
@section('style')
<link rel="stylesheet" href="{{asset('/assets/multi-calendar/dist/daterangepicker.min.css')}}"/> <!-- pr -->
<!-- use when number of milestones are 12 or more new -pr 22-7-25 -->
<style>
    .milestone-table-scroller {
        max-height: 550px;
        overflow-y: auto;
    }

    .milestone-table thead {
        position: sticky;
        top: 0;
        z-index: 1;
    }
</style>
@endsection
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
                        </span> Projects </h3>
                </div>
                <div class="col p-0 text-end">
                    <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                        <li class="breadcrumb-item"><a href="{{ route('resource.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Projects</li>
                    </ul>
                </div>
            </div>

            @if(Auth::guard('resource')->user()->role == "project_manager")
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
                                        <div class="inovices-amount" id="allProjects">-</div>
                                    </div>
                                </div>
                                <p class="inovices-all">All Projects <span></span></p>
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
                                        <div class="inovices-amount" id="value">-</div>
                                    </div>
                                </div>
                                <p class="inovices-all">Total Value <span></span></p>
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
                                        <div class="inovices-amount" id="progress">-</div>
                                    </div>
                                </div>
                                <p class="inovices-all">In Progress<span></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6 col-12">
                        <div class="card inovices-card">
                            <div class="card-body">
                                <div class="inovices-widget-header">
                                    <span class="inovices-widget-icon">
                                        <img src="{{asset('/assets/img/invoices-icon1.svg')}}" alt="">
                                    </span>
                                    <div class="inovices-dash-count">
                                        <div class="inovices-amount" id="planning">-</div>
                                    </div>
                                </div>
                                <p class="inovices-all">Planning<span></span></p>
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
                                        <div class="inovices-amount" id="completed">-</div>
                                    </div>
                                </div>
                                <p class="inovices-all">Completed<span></span></p>
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
                                        <div class="inovices-amount" id="hold">-</div>
                                    </div>
                                </div>
                                <p class="inovices-all">Hold<span></span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /show count data -pr -->

                <!-- show dorpdown filter -pr -->
                 <div class="crms-title row bg-white">
                    <div class="col-md-12">
                        <ul class="d-flex justify-content-start align-items-center filter-data p-0 m-0 gap-2" style="list-style: none;">

                            <!-- Customer Filter -->
                            <li>
                                <div class="multipleSelection m-0">
                                    <select id="customer-filter-project" class="form-select">
                                        <option value="all" selected>All Customer</option>
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->first_name }} {{ $customer->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </li>
                    
                            <!-- Status Filter -->
                            <li>
                                <div class="multipleSelection m-0">
                                    <select id="status-filter-project" class="form-select">
                                        <option value="all" selected>All Status</option>
                                        <option value="in_progress">In Progress</option>
                                        <option value="planning">Planning</option>
                                        <option value="completed">Completed</option>
                                        <option value="hold">Hold</option>
                                    </select>
                                </div>
                            </li>

                            <!-- Date Range -->
                            <li>
                                <div id="date-inputs" class="d-flex align-items-center gap-2">
                                    <input id="start-date" class="form-control form-control-sm rs-att-date" value="" placeholder="Start Date" readonly>
                                    <span class="text-capitalize" style="font-size: 16px;">to</span>
                                    <input id="end-date" class="form-control form-control-sm rs-att-date" value="" placeholder="End Date" readonly>
                                    <button id="clear" class="btn btn-sm btn-outline-secondary rs-clear-btn">Clear</button>
                                </div>
                            </li>
                        </ul>
                    </div>
                 </div>
               
                <!-- /show dorpdown filter -pr -->
            @endif

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

                        @if (session('error'))
                            <div class="alert alert-danger" id="error-alert">
                                {{ session('error') }}
                            </div>
                        @endif

                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col">
                    </div>
                    <div class="col text-end">
                        @if(Auth::guard('resource')->user()->role == "project_manager")
                        <ul class="list-inline-item ps-0">
                            <li class="list-inline-item">
                                {{-- <a class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded" href="{{route('resource.projects.trash')}}">All Trash</a> --}}
                            </li>
                        </ul>
                        @endif
                    </div>
                </div> -->
            </div>
            <!-- /Page Header -->
            <!-- Content Starts -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-nowrap custom-table mb-0 datatable addexamplesearch projectsearch">
                                    <thead>
                                        <tr>
                                            <th class="checkBox">
                                                Sr.
                                            </th>
                                            <th class="text-center">Unique Name</th>
                                            <th class="text-center">Project Name</th>
                                            <th class="text-center">Customer</th>
                                            <th class="text-center">Vendor</th>
                                            <th class="text-center">Manager</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Start Date</th>
                                            <th class="text-center">End Date</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="project-data">
                                        <!-- Data will be inserted here via AJAX -pr -->
                                        @if(Auth::guard('resource')->user()->role == "consultant")
                                        @foreach($projects as $project)
                                        <tr>
                                            <td class="checkBox">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="text-center">{{ $project->uniquename }}</td>
                                            <td>{{ $project->project_name }}</td>
                                            <td class="text-center">
                                                {{ $project->customer->first_name ?? 'No Customer' }}
                                                {{ $project->customer->last_name ?? '' }}
                                                <p class="m-0">{{ $project->customer->email ?? '' }}</p>
                                            </td>
                                            <td class="text-center">
                                                {{ $project->vendor->first_name ?? 'No Vendor' }}
                                                {{ $project->vendor->last_name ?? '' }}
                                                <p class="m-0">{{ $project->vendor->email ?? '' }}</p>
                                            </td>
                                            <td class="text-center">
                                                {{ $project->manager->first_name ?? 'No Manager' }} 
                                                {{ $project->manager->last_name ?? '' }}
                                                <p class="m-0">{{ $project->manager->email ?? '' }}</p>
                                            </td>



                                            <td class="text-center">
                                                <label class="badge badge-gradient-{{ $project->status == 'completed' ? 'success' : 'warning' }}">
                                                    {{ ucfirst($project->status) }}
                                                </label>
                                            </td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($project->start_date)->format('d-m-Y') }}</td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($project->end_date)->format('d-m-Y') }}</td>
                                            <td class="text-center d-flex">

                                                <!-- @if(Auth::guard('resource')->user()->role == "project_manager")
                                                <a href="#" class="ms-2 p-2 fs-6 my_icons mailstone-action" data-bs-toggle="modal" data-bs-target="#mailstone-user-{{ $project->id }}">
                                                    <i class="fas fa-history"  data-bs-toggle="tooltip" data-bs-placement="top" title="Milestone"></i>
                                                </a>

                                                <a href="#" class="ms-2 p-2 fs-6 my_icons projectUpdatedoc edit-action" data-bs-toggle="modal" data-bs-target="#update-project-{{$project->id}}" data-id="{{ $project->id }}">
                                                    <i class="fa-solid fa-pen-to-square text-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"></i>
                                                </a>
                                                @endif -->

                                                <a href="#" class="ms-2 p-2 fs-6 my_icons view-action" data-bs-toggle="modal" data-bs-target="#system-user-{{ $project->id }}">
                                                    <i class="fa-solid fa-eye view text-success" data-bs-placement="top" title="View"></i>
                                                </a>

                                                <!-- @if(Auth::guard('resource')->user()->role == "project_manager")
                                                <form action="{{ route('resource.projects.index.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to move this Project to trash?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="ms-2 p-2 fs-6 my_icons btn btn-link text-danger delete-action">
                                                        <i class="fa-solid fa-trash" data-bs-toggle="tooltip" data-bs-placement="top" title="Trash"></i>
                                                    </button>
                                                </form>
                                                @endif -->

                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Content End -->
        </div>
        <!-- /Page Content -->
    </div>
    <!-- /Page Wrapper end -->

    @if(Auth::guard('resource')->user()->role == "project_manager")
        <!-- project update section -->
        @foreach($projects as $project)
            <div class="modal right fade " id="update-project-{{$project->id}}" tabindex="-1" role="dialog" aria-modal="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="row w-100">
                                <div class="col  p-0">
                                    <h3 class="page-title m-0">
                                        <span class="page-title-icon bg-gradient-primary text-white me-2">
                                            <i class="bi bi-grid"></i>
                                        </span>Update Project </h3>
                                </div>
                            </div>

                            <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>

                        </div>
                        <div class="modal-body">
                            <div class="task-infos">
                                <div class="tab-content">
                                    <div class="content container-fluid">
                                        <!-- Content Starts -->
                                        <div class="row mt-4">
                                            <div class="col-md-12">
                                                {{-- <form action="{{route('')}}" id="updateprojectdetails"> --}}
                                                <form action="{{ route('resource.projects.index.update', $project->id) }}" method="POST" id="updateprojectdetails" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PATCH')
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <label class="col-form-label">Project Name <span class="text-danger">*</span></label>
                                                            <input class="form-control" type="text" required value="{{$project->project_name}}" name="project_name">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="col-form-label">Project Description</label>
                                                            <textarea style="height:41px;"class="form-control" type="text" name="description" id="">{{$project->description}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <label class="col-form-label">Start Date<span class="text-danger">*</span></label>
                                                            <input id="start_date" class="form-control" required type="date" name="start_date" value="{{$project->start_date}}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="col-form-label">Forcasting Date<span class="text-danger">*</span></label>
                                                            <input id="end_date" class="form-control" required type="date" name="end_date" value="{{$project->end_date}}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-4">
                                                            <label class="col-form-label">Project Value<span class="text-danger">*</span></label>
                                                            <input class="form-control" type="text" required name="project_value" value="{{ $project->project_value }}">                                                    
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="col-form-label" for="currency-dropdown-{{$project->id}}">Choose Currency<span class="text-danger">*</span></label>
                                                            <select class="form-control form-select" name="currency" required id="currency-dropdown-{{$project->id}}" data-stored-currency="{{ $project->currency }}">
                                                                <!-- Options will be dynamically populated -->
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="col-form-label">Status<span class="text-danger">*</span></label>
                                                            <select class="form-control form-select" required name="status">
                                                                <option value="in_progress" {{$project->status == 'in_progress' ? 'selected' : ''}}>In Progress</option> 
                                                                <option value="completed" {{ $project->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                                                <option value="hold" {{ $project->status == 'hold' ? 'selected' : '' }} >Hold</option>
                                                                <option  value="planning" {{$project->status == 'planning' ? 'selected' : ''}}>Planning</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <label class="col-form-label">Document</label>
                                                            <input class="form-control" type="file" name="files[]"  id="updateattachment-{{$project->id}}" multiple >
                                                            <p id="files-area-{{$project->id}}">
                                                                <span id="filesList-{{$project->id}}">
                                                                    <span id="files-names-update-{{$project->id}}"></span>
                                                                </span>
                                                            </p>
                                                            <p id="file-count-update-{{$project->id}}">No files selected</p>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <label class="col-form-label">Notes/Comments</label>
                                                            <textarea class="form-control" name="notes" rows="3" id="description" placeholder="">{{$project->notes}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="text-center py-3">
                                                        <button type="submit" class="border-0 btn btn-primary btn-gradient-primary btn-rounded" >Update</button>&nbsp;&nbsp;
                                                        
                                                    </div>
                                                </form>
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
        @endforeach
        <!--/project update section end -->
    @endif

     <!--project detelis Modal -->
     @foreach($projects as $project)
        <div class="modal right fade" id="system-user-{{ $project->id }}" tabindex="-1" role="dialog" aria-modal="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="row w-100">
                            <div class="col-md-7 account d-flex">
                                <div>
                                    <p class="mb-0">Project Name</p>
                                    <span class="modal-title">{{$project->project_name}}</span>
                                    <span class="rating-star"><i class="fa fa-star" aria-hidden="true"></i></span>
                                    <span class="lock"><i class="fa fa-lock" aria-hidden="true"></i></span>
                                </div>

                            </div>
                        </div>
                        <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="task-infos">
                            <div class="tab-content">
                                <div class="tab-pane show active" id="task-details">
                                    <div class="crms-tasks">
                                        <div class="tasks__item crms-task-item active">
                                            <div class="accordion-header js-accordion-header">Name</div>
                                            <div class="accordion-body js-accordion-body">
                                                <div class="accordion-body__contents">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td class="border-0">Project ID</td>
                                                                <td class="border-0">{{$project->uniquename}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border-0">Project Name</td>
                                                                <td class="border-0">{{$project->project_name}}</td>
                                                            </tr>
                                                            @if(Auth::guard('resource')->user()->role == "project_manager")
                                                                <tr>
                                                                    <td class="border-0">Customer Name</td>
                                                                    <td class="border-0">{{ $project->customer->first_name ?? 'No Customer' }}
                                                                        {{ $project->customer->last_name ?? '' }}
                                                                        <span>(Email : {{ $project->customer->email ?? '' }} )</span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="border-0">Vendor Name</td>
                                                                    <td class="border-0">{{ $project->vendor->first_name ?? 'No vendor' }}
                                                                        {{ $project->vendor->last_name ?? '' }}
                                                                        <span>(Email : {{ $project->vendor->email ?? '' }} )</span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="border-0">Manager Name</td>
                                                                    <td class="border-0">{{ $project->manager->first_name ?? 'No manager' }}
                                                                        {{ $project->manager->last_name ?? '' }}
                                                                        <span>(Email : {{ $project->manager->email ?? '' }} )</span></td>
                                                                </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        @if(Auth::guard('resource')->user()->role == "project_manager")
                                        <div class="tasks__item crms-task-item active">
                                            <div class="accordion-header js-accordion-header">Status</div>
                                            <div class="accordion-body js-accordion-body">
                                                <div class="accordion-body__contents">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td class="border-0 ">{{$project->status}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tasks__item crms-task-item active">
                                            <div class="accordion-header js-accordion-header">Date</div>
                                            <div class="accordion-body js-accordion-body">
                                                <div class="accordion-body__contents">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td class="border-0">Start Date</td>
                                                                <td class="border-0">{{ \Carbon\Carbon::parse($project->start_date)->format('d-m-Y') }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border-0">End Date</td>
                                                                <td class="border-0">{{ \Carbon\Carbon::parse($project->end_date)->format('d-m-Y') }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="tasks__item crms-task-item active">
                                            <div class="accordion-header js-accordion-header">Milestones</div>
                                            <div class="accordion-body js-accordion-body">
                                                <div class="accordion-body__contents">
                                                    <table class="table">
                                                        @if ($project->milestones->isEmpty())
                                                                <tr>
                                                                    <td colspan="6" class="text-center">No milestones created</td>
                                                                </tr>
                                                            @else
                                                            <thead>
                                                                <tr>
                                                                    <th class="border-0">Sr</th>
                                                                    <th class="border-0">Name</th>
                                                                    <th class="border-0">Milestone Date</th>
                                                                    <th class="border-0">Forecasting Date</th>
                                                                    <th class="border-0">Status</th>
                                                                    <th class="border-0">Description</th>
                                                                </tr>
                                                            <thead>
                                                            <tbody>
                                                                @foreach ($project->milestones as $milestone)
                                                                <tr>
                                                                    <th class="border-0">{{ $loop->iteration }}</th> <!-- Increment based on the loop -->
                                                                    <th class="border-0">{{ $milestone->milestone_name }}</th>
                                                                    <td class="border-0">{{ $milestone->milestone_date }}</td>
                                                                    <td class="border-0">{{ $milestone->forecasting_date }}</td>
                                                                    <td class="border-0">{{ $milestone->status }}</td>
                                                                    <td class="border-0">{{ $milestone->description }}</td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        @endif
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="tasks__item crms-task-item active">
                                            <div class="accordion-header js-accordion-header">Project Value</div>
                                            <div class="accordion-body js-accordion-body">
                                                <div class="accordion-body__contents">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td class="border-0">{{$project->project_value}} {{$project->currency}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                        @endif
                                        <div class="tasks__item crms-task-item active">
                                            <div class="accordion-header js-accordion-header">Project Description and Note</div>
                                            <div class="accordion-body js-accordion-body">
                                                <div class="accordion-body__contents">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td class="border-0">Description</td>
                                                                <td class="border-0">{{$project->description}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border-0">Note</td>
                                                                <td class="border-0">{{$project->notes}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        @if(Auth::guard('resource')->user()->role == "project_manager")
                                        <div class="tasks__item crms-task-item active">
                                            <div class="accordion-header js-accordion-header">Documents</div>
                                            <div class="accordion-body js-accordion-body">
                                                <div class="accordion-body__contents">
                                                    <table class="table">
                                                        <tbody>
                                                            <p>Documents</p>
                                                            @if(is_array($project->documents))
                                                            @foreach($project->documents as $document)
                                                                <a href="{{ asset('storage/' . $document) }}" target="_blank">{{ basename($document) }}</a><br>
                                                                {{-- <a href=" {{ dd(asset('storage/' . $document)) }}">click</a> --}}
                                                            @endforeach
                                                        @else
                                                            No documents uploaded.
                                                        @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
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
     @endforeach
    <!--/project detelis end modal -->

    @if(Auth::guard('resource')->user()->role == "project_manager")
        <!--show all milestone project wise-->
        @foreach ($projects as $project)
            <div class="modal right fade" id="mailstone-user-{{ $project->id }}" tabindex="-1" role="dialog" aria-modal="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
                        </div>
                            <div class="content container-fluid">
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                                <div class="crms-title row bg-white">
                                    <div class="col  p-0">
                                        <h3 class="page-title m-0">
                                            <span class="page-title-icon bg-gradient-primary text-white me-2">
                                                <i class="fas fa-history"></i>
                                            </span> Milestone
                                        </h3>
                                    </div>
                                    <div class="col text-end">
                                        <ul class="list-inline-item ps-0">
                                            <li class="list-inline-item">
                                                <a class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded"
                                                    href="#" 
                                                    data-url="{{ route('resource.projects.milestone.trashed', $project->id) }}" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#mailstone-user-deleted"
                                                    onclick="trashedMilestone(event); this.blur();">All Trash</a>
                                                <a class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded"
                                                    href="{{route('resource.projects.milestonecreate')}}">New Milestone</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- Content Starts -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card mb-0">
                                            <div class="card-body">
                                                <div class="table-responsive milestone-table-scroller">
                                                    
                                                        <table class="table table-striped table-nowrap custom-table mb-0 datatable milestone-table">
                                                            @if ($project->milestones->isEmpty())
                                                                <tr>
                                                                    <td colspan="7" class="text-center">No milestones created</td>
                                                                </tr>
                                                            @else
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-center">Sr.</th>
                                                                        <th class="text-center">Name</th>
                                                                        <th class="text-center">Milestone Date</th>
                                                                        <th class="text-center">Forecasting Date</th>
                                                                        <th class="text-center">Status</th>
                                                                        <th class="text-center">Description</th>
                                                                        <th class="text-center">Cost</th>
                                                                        <th class="text-center">Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($project->milestones as $milestone)
                                                                        <tr>
                                                                            <th class="text-center">{{ $loop->iteration }}</th> <!-- Increment based on the loop -->
                                                                            <th class="text-center">{{ $milestone->milestone_name }}</th>
                                                                            <td class="text-center">{{ $milestone->milestone_date }}</td>
                                                                            <td class="text-center">{{ $milestone->forecasting_date }}</td>
                                                                            <td class="text-center">{{ $milestone->status }}</td>
                                                                            <td class="text-center">{{ $milestone->description }}</td>
                                                                            <td class="text-center">{{ $milestone->amount }}</td>
                                                                            <td class="text-center d-flex">
                                                                                <a href="#" class="ms-2 p-2 fs-6 my_icons edit-action" data-bs-toggle="modal" 
                                                                                    data-bs-target="#update-milestone-{{$milestone->id}}">
                                                                                        <i class="fa-solid fa-pen-to-square text-dark" 
                                                                                        data-bs-toggle="tooltip" data-bs-placement="top" 
                                                                                        title="Edit"></i>
                                                                                </a>
                                                                                <!-- pr change and add 17-9-25 -->
                                                                                @if (!is_null($milestone->document))
                                                                                    @if ($milestone->invoice()->exists())
                                                                                        <a href="#" data-bs-toggle="modal" data-id="{{ $milestone->invoice->id }}" class="invoice-view my_icons ms-2 p-2 fs-6 view-action" data-bs-target="#invoice-view-user">
                                                                                    @else
                                                                                        <a href="{{route('resource.projects.milestone.invoice',$milestone->id)}}" class="ms-2 p-2 fs-6 my_icons milestone-base">
                                                                                    @endif
                                                                                            <i class="fa-solid bi bi-file-text text-dark" 
                                                                                            data-bs-placement="top" 
                                                                                            title="Invoice"></i>
                                                                                        </a>
                                                                                @endif
                                                                                
                                                                                <a href="#" class="ms-2 p-2 fs-6 my_icons upload-action " data-bs-toggle="modal" 
                                                                                    data-bs-target="#milestone-conformation-{{$milestone->id}}">
                                                                                        <i class="fa-solid bi bi-upload text-dark" 
                                                                                        data-bs-toggle="tooltip" data-bs-placement="top" 
                                                                                        title="conformation"></i>
                                                                                </a>
                                                                                <form action="{{ route('resource.projects.milestone.destroy', $milestone->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to move this milestone to trash?');">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button type="submit" class="ms-2 p-2 fs-6 my_icons btn btn-link text-danger delete-action">
                                                                                        <i class="fa-solid fa-trash" data-bs-toggle="tooltip" data-bs-placement="top" title="Trash"></i>
                                                                                    </button>
                                                                                </form>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            @endif
                                                        </table>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Content End -->
                            </div>
                            <!-- /Page Content -->
                        
                    </div>
                    <!-- modal-content -->
                </div>
                <!-- modal-dialog -->
            </div>
        @endforeach
        <!--/show all milestone project wise end  -->

        <!-- invoice modal pr add 17-9-25 -->
            @include('components.invoice.modal')
        <!-- /invoice modal -->

        <!--show all deleted milestone project wise -->
        <div class="modal right fade" id="mailstone-user-deleted" tabindex="-1" role="dialog" aria-modal="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
                    </div>
                    <!-- code -->
                    <div class="content container-fluid">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="crms-title row bg-white">
                            <div class="col  p-0">
                                <h3 class="page-title m-0">
                                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                                        <i class="fas fa-history"></i>
                                    </span> Deleted Milestone
                                </h3>
                            </div>
                        </div>
                        <!-- Content Starts -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-0">
                                    <div class="card-body">
                                        <div class="table-responsive milestone-table-scroller">
                                            
                                                <table class="table table-striped table-nowrap custom-table mb-0 datatable milestone-table">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Sr.</th>
                                                            <th class="text-center">Name</th>
                                                            <th class="text-center">Milestone Date</th>
                                                            <th class="text-center">Forecasting Date</th>
                                                            <th class="text-center">Status</th>
                                                            <th class="text-center">Description</th>
                                                            <th class="text-center">Cost</th>
                                                            <th class="text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="trashed-milestones-container">
                                                        <!-- Loaded dynamically via JS in below script -->
                                                    </tbody>
                                                </table>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Content End -->
                    </div>
                    <!-- /Page Content -->
                    
                </div>
                <!-- modal-content -->
            </div>
            <!-- modal-dialog -->
        </div>
        <!--/show all deleted milestone project wise end -->

        <!-- mailstone update start -->
        @foreach ($projects as $project)
            @foreach ($project->milestones as $milestone)
                <div class="modal right fade" id="update-milestone-{{$milestone->id}}" 
                    tabindex="-1" role="dialog" aria-labelledby="milestoneModalLabel{{$milestone->id}}" 
                    aria-modal="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close xs-close" 
                                data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                                <div class="content container-fluid">
                                    <div class="crms-title row bg-white">
                                        <div class="col  p-0">
                                            <h3 class="page-title m-0">
                                                <span class="page-title-icon bg-gradient-primary text-white me-2">
                                                    <i class="fas fa-history"></i>
                                                </span>Update Milestone
                                            </h3>
                                        </div>
                                        {{-- <div class="col text-end">
                                            <ul class="list-inline-item ps-0">
                                                <li class="list-inline-item">
                                                    <a class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded"
                                                        href="../template/projects_trash.html">All Trash</a>
                                                    <a class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded"
                                                        href="../template/create_project.html">New Milestone</a>
                                                </li>
                                            </ul>
                                        </div> --}}
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
                            <form action="{{ route('resource.projects.milestone.update', $milestone->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Project Name<span class="text-danger">*</span></label>
                                        <input type="text"class="form-control" required disabled value="{{$project->project_name}}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Milestone Name<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" required value="{{$milestone->milestone_name}}" name="milestone_name" id="milestoneName">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Milestone Date<span class="text-danger">*</span></label>
                                        <input  class="form-control" type="date" required value="{{$milestone->milestone_date}}" name="milestone_date" min="{{ $project->start_date }}" max="{{ $project->end_date }}"> <!-- pr add 9-9-25 min max -->
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Forecasting Date<span class="text-danger">*</span></label>
                                        <input  class="form-control " type="date" required value="{{ $milestone->forecasting_date }}" name="forecasting_date" min="{{ $project->start_date }}" max="{{ $project->end_date }}"> <!-- pr add 9-9-25 min max -->
                                    </div>
                                
                                </div>

                                <div class="row mb-3">
                                <div class="col-md-6">
                                        <label class="form-label">Milestone Amount<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="cost" value="{{$milestone->amount}}" required pattern="^\d{1,13}(\.\d{1,2})?$">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Status<span class="text-danger">*</span></label>
                                        <select class="form-select form-control" name="status">
                                            <option value="Completed" {{ $milestone->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="Planning" {{ $milestone->status == 'Planning' ? 'selected' : '' }}>Planning</option>
                                            <option value="In Progress" {{ $milestone->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                <label class="form-label">Description</label>
                                    <textarea class="form-control" name="description" >{{ $milestone->description }}</textarea>
                                </div>
                                <div class="py-3">
                                    <button type="submit" class="btn btn-primary btn-gradient-primary btn-rounded">Update Milestone</button>
                                </div>

                            </form>
                        </div>
                    </div>
                                    <!-- /Content End -->
                                </div>
                                <!-- /Page Content -->
                        </div>
                        <!-- modal-content -->
                    </div>
                    <!-- modal-dialog -->
                </div>
            @endforeach
        @endforeach
        <!-- /mailestone update end -->
        <!-- conformation form for invoice -->
        @foreach ($projects as $project)
            @foreach ($project->milestones as $milestone)
                <div class="modal right fade" id="milestone-conformation-{{$milestone->id}}" 
                    tabindex="-1" role="dialog" aria-labelledby="milestoneModalLabel{{$milestone->id}}" 
                    aria-modal="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close xs-close" 
                                data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="content container-fluid">
                                    <div class="crms-title row bg-white">
                                        <div class="col  p-0">
                                            <h3 class="page-title m-0">
                                                <span class="page-title-icon bg-gradient-primary text-white me-2">
                                                    <i class="fas fa-history"></i>
                                                </span>Upload document
                                            </h3>
                                        </div>
                                    </div>    
                                    <!-- Content Starts -->
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <form action="
                                            {{ route('resource.projects.milestone.doc.docupload', $milestone->id) }}
                                            " method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PATCH')
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label">Upload Approval</label>
                                                        <input type="file" name="approvaldoc" class="form-control" accept=".pdf">
                                                    </div>
                                                </div>
                                                <div class="py-3">
                                                    <button type="submit" class="btn btn-primary btn-gradient-primary btn-rounded">Update Milestone</button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                    <!-- /Content End -->
                            </div>
                                <!-- /Page Content -->
                        </div>
                        <!-- modal-content -->
                    </div>
                    <!-- modal-dialog -->
                </div>
                
            @endforeach
        @endforeach
        <!-- /conformation form for invoice -->
    @endif

<script>
function trashedMilestone(e){
    e.preventDefault();

    const url = e.currentTarget.getAttribute('data-url');
    const container = document.querySelector('#trashed-milestones-container');

    container.innerHTML = '<tr><td colspan="7" class="text-center">Loading...</td></tr>';

    fetch(url)
        .then(response => response.json())
        .then(milestones => {
            container.innerHTML = '';
            if (milestones.length === 0) {
                container.innerHTML = `
                    <tr>
                        <td colspan="8" class="text-center text-muted">No milestones are deleted for this project.</td>
                    </tr>
                `;
                return;
            }

            milestones.forEach((milestone, index) => {
                container.innerHTML += `
                    <tr>
                        <th class="text-center">${ index + 1 }</th> <!-- Increment based on the loop -->
                        <th class="text-center">${ milestone.milestone_name }</th>
                        <td class="text-center">${ milestone.milestone_date }</td>
                        <td class="text-center">${ milestone.forecasting_date }</td>
                        <td class="text-center">${ milestone.status }</td>
                        <td class="text-center">${ milestone.description }</td>
                        <td class="text-center">${ milestone.amount }</td>
                        <td class="text-center d-flex">
                            <form action="/resource/projects/milestone/${milestone.id}/restore" method="POST" onsubmit="return confirm('Do you want to restore this milestone?');">
                                @csrf
                                <button type="submit" class="ms-2 p-2 fs-6 my_icons btn btn-link text-dark">
                                    <i class="bi bi-cloud-download" data-bs-toggle="tooltip" data-bs-placement="top" title="Recover"></i>
                                </button>
                            </form>
                            <form action="/resource/projects/milestone/${milestone.id}/force-delete" method="POST" onsubmit="return confirm('Do you want to permanent delete this milestone?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="ms-2 p-2 fs-6 my_icons btn btn-link text-danger delete-action">
                                    <i class="fa-solid fa-trash" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                `;

            });
        })
        .catch(error => {
            console.error("Error fetching milestones:", error);
            container.innerHTML = `
                <tr>
                    <td colspan="8" class="text-center text-danger">
                        Failed to load milestones. Please refresh the page.
                    </td>
                </tr>
            `;
        });
}
</script>
@endsection
@section('script')
@if(Auth::guard('resource')->user()->role == "project_manager")
<script src="{{asset('/assets/js/resources/projectview.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.16.0/moment.min.js" type="text/javascript"></script> <!-- pr -->
<script src="{{asset('/assets/multi-calendar/src/jquery.daterangepicker.js')}}"></script> <!-- pr -->
<!-- pr -->
<script>
    $(function()
    {
        $('#date-inputs').dateRangePicker(
        {
            autoClose: true,
            separator : ' to ',
            getValue: function()
            {
                if ($('#start-date').val() && $('#end-date').val() )
                    return $('#start-date').val() + ' to ' + $('#end-date').val();
                else
                    return '';
            },
            setValue: function(s,s1,s2)
            {
                $('#start-date').val(s1);
                $('#end-date').val(s2).trigger('customDateChanged');
            }
        });

        $('#clear').click(function(evt)
        {
            evt.stopPropagation();
            $('#date-inputs').data('dateRangePicker').clear();
        });
    });
</script>
@endif
@endsection