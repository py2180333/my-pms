@extends('resource.master')
@include('resource.sidebar')
@section('style')
<link rel="stylesheet" href="{{asset('/assets/multi-calendar/dist/daterangepicker.min.css')}}"/>
@endsection
@section('content')
     <!-- index Page -->
     <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">

            <div class="crms-title row bg-white mb-4">
                <div class="col  p-0">
                    <h3 class="page-title m-0">
                        <span class="page-title-icon bg-gradient-primary text-white me-2">
                            <i class="fa-regular fa-square-check"></i>
                        </span> Tasks
                    </h3>
                </div>
                <div class="col p-0 text-end">
                    <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Task</li>
                    </ul>
                </div>
            </div>

            <!-- show count data -pr -->
            <div class="row d-flex justify-content-between align-items-center">

                <!-- all resources -->
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card inovices-card m-0">
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

                <!-- To do -->
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card inovices-card m-0">
                        <div class="card-body">
                            <div class="inovices-widget-header">
                                <span class="inovices-widget-icon">
                                    <img src="{{asset('/assets/img/invoices-icon2.svg')}}" alt="">
                                </span>
                                <div class="inovices-dash-count">
                                    <div class="inovices-amount" id="todo">-</div>
                                </div>
                            </div>
                            <p class="inovices-all">To Do <span></span></p>
                        </div>
                    </div>
                </div>

                <!-- In progress -->
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card inovices-card m-0">
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
                
                <!-- completed -->
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card inovices-card m-0">
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

            </div>
            <!-- /show count data -pr -->

            <!-- Page Header -->
            <div class="page-header pt-3 mb-0 ">
                <div class="row">
                    <div class="col text-end">
                        <ul class="list-inline-item ps-0">
                            <li class="list-inline-item">
                                    <a class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded"
                                    id="add-task" href="{{route('resource.assigntask.create')}}">Assign Task</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Page Header -->
            <!-- show dorpdown filter -pr -->
            <div class="crms-title row bg-white mb-4">
                <div class="d-flex flex-wrap align-items-center gap-1">

                    <!-- Project Filter -->
                    <select id="project-filter-at-task" class="form-select text-capitalize" style="width: 140px;">
                        <option value="all" selected>All Projects</option>
                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                        @endforeach
                    </select>

                    <!-- Milestone Filter -->
                    <select id="milestone-filter-at-task" class="form-select text-capitalize" style="width: 140px;">
                        <!-- Option will be inserted here via AJAX -pr -->
                    </select>
                    
                    <!-- Task Filter -->
                    <select id="task-filter-at-task" class="form-select text-capitalize" style="width: 140px;">
                        <!-- Option will be inserted here via AJAX -pr -->
                    </select>

                    <!-- Resource Filter -->
                    <select id="resource-filter-at-task" class="form-select text-capitalize" style="width: 140px;">
                        <!-- Option will be inserted here via AJAX -pr -->
                    </select>

                    <!-- Status Filter -->
                    <select id="status-filter-at-task" class="form-select text-capitalize" style="width: 140px;">
                        <option value="all" selected>All Status</option>
                        <option value="To Do">To Do</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Completed">Completed</option>
                    </select>

                    <!-- Date Range -->
                    <div id="date-inputs" class="d-flex align-items-center gap-1">
                        <span style="font-size: 14px;">From</span>
                        <input id="start-date" class="form-control form-control-sm rs-att-date" style="width: 110px;" readonly placeholder="Start Date">
                        <span style="font-size: 14px;">To</span>
                        <input id="end-date" class="form-control form-control-sm rs-att-date" style="width: 110px;" readonly placeholder="End Date">
                        <button id="clear" class="btn btn-sm btn-outline-secondary rs-clear-btn m-0">Clear</button>
                    </div>

                </div>
            </div>
            <!-- /show dorpdown filter -pr -->

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
            <!-- Page Header -->
            <!-- Content Starts -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-nowrap custom-table mb-0 datatable addexamplesearch assigntaskssearch">
                                    <thead>
                                        <tr>
                                            <th class="checkBox">Sr</th>
                                            <th class="checkBox sorting" style="width: 35px;">Project Name</th>
                                            <th class="checkBox sorting" style="width: 35px;">Milestone Name</th>
                                            <th class="checkBox sorting" style="width: 35px;">Task Name</th>
                                            <th class="checkBox sorting" style="width: 35px;">Resource Name</th>
                                            <th class="checkBox sorting" style="width: 35px;">Start Date</th>
                                            <th class="checkBox sorting" style="width: 35px;">Estimated hours</th>
                                            <th class="checkBox sorting" style="width: 35px;">Status</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="assigntasks-data">
                                        <!-- Dynamic data will apper here. -pr -->
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

       <!-- assigned resources details -pranav -->
        @foreach ($assigntasks as $assigntask)
        <div class="modal right fade" id="task-details-modal-{{$assigntask->id}}" tabindex="-1" role="dialog" aria-modal="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="row w-100">
                            <div class="col-md-7 account d-flex">
                                <div>
                                    <p class="mb-0">Assigntask Name</p>
                                    <span class="modal-title">{{$assigntask->project->project_name}}</span>
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
                                <div class="tab-pane show active" id="tasks-details">
                                    <div class="crms-tasks">
                                        <div class="tasks__item crms-task-item">
                                            <!-- <div class="accordion-header js-accordion-header">Task Name</div> -->
                                            <!-- <div class="accordion-body js-accordion-body"> -->
                                            <!-- <div class="accordion-body__contents"> -->
                                            <div class="task-details__contents">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>Project Name</td>
                                                            <td>{{ $assigntask->project->project_name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Milestone Name</td>
                                                            <td>{{ $assigntask->milestone->milestone_name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Task Name</td>
                                                            <td>{{ $assigntask->task->task_name }}</td>
                                                        </tr>
                                                        @if($assigntask->consultant)
                                                        <tr>
                                                            <td>Consultant Name</td>
                                                            <td>{{ $assigntask->consultant->first_name }} {{ $assigntask->consultant->last_name }}</td>
                                                        </tr>
                                                        @endif
                                                        @if($assigntask->project->manager)
                                                        <tr>
                                                            <td>Project Manager Name</td>
                                                            <td>{{ $assigntask->project->manager->first_name }} {{ $assigntask->project->manager->last_name }}</td>
                                                        </tr>
                                                        @endif
                                                        <tr>
                                                            <td>Status</td>
                                                            <td>{{ $assigntask->status }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- </div> -->
                                            <!-- </div> -->
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
        <!-- /assigned resources details -pranav -->

        <!-- assigned resources update module -pranav -->
        @foreach ($assigntasks as $assigntask)
        <div class="modal right fade" id="task-update-{{$assigntask->id}}" tabindex="-1" role="dialog" aria-modal="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="row w-100">
                            <div class="col  p-0">
                                <h3 class="page-title m-0">
                                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                                        <i class="bi bi-grid"></i>
                                    </span>
                                    Update Assigned Resource 
                                </h3>
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
                                            <form action="{{ route('resource.assigntask.index.update', $assigntask->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <label class="col-form-label">Status<span class="text-danger">*</span></label>
                                                        <select class="form-control form-select" name="status">
                                                            <option value="In Progress" {{$assigntask->status == 'In Progress' ? 'selected' : ''}}>In Progress</option> 
                                                            <option value="Completed" {{ $assigntask->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                                            <option value="To Do" {{ $assigntask->status == 'To Do' ? 'selected' : '' }} >To Do</option>
                                                        </select>
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
                    <!-- modal-content -->
                </div>
                <!-- modal-dialog -->
            </div>
        </div>
        @endforeach
        <!-- /assigned resources update end -pranav -->

    </div>
    <!-- /index Page -->
@endsection
@section('script')
<script src="{{asset('/assets/js/resources/assigntaskview.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.16.0/moment.min.js" type="text/javascript"></script>
<script src="{{asset('/assets/multi-calendar/src/jquery.daterangepicker.js')}}"></script>
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
@endsection