@extends('Admin.layouts.master')
@include('Admin.layouts.sidebar')
@include('Admin.layouts.headerMenu')
@section('style')
<link rel="stylesheet" href="{{asset('/assets/multi-calendar/dist/daterangepicker.min.css')}}"/> <!-- pr -->
@endsection
@section('content')
     <!-- index Page -->
     <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">

            <div class="crms-title row bg-white">
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
            <div class="row mt-4">

                <!-- all task -->
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card inovices-card mb-0">
                        <div class="card-body">
                            <div class="inovices-widget-header">
                                <span class="inovices-widget-icon">
                                    <img src="{{asset('/assets/img/invoices-icon1.svg')}}" alt="">
                                </span>
                                <div class="inovices-dash-count">
                                    <div class="inovices-amount" id="allTasks">-</div>
                                </div>
                            </div>
                            <p class="inovices-all">All Tasks <span></span></p>
                        </div>
                    </div>
                </div>

                <!-- To do -->
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card inovices-card">
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
                
                <!-- completed -->
                <div class="col-xl-3 col-sm-6 col-12">
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

            </div>
            <!-- /show count data -pr -->
            <!-- Page Header -->
            <div class="page-header pt-3 mb-0 ">
                <div class="row">
                    <div class="col text-end">
                        <ul class="list-inline-item ps-0">
                            <li class="list-inline-item">
                                    {{-- <a class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded"
                                     href="../template/../template/task_trash.html">All Trash</a> --}}
                                    <a class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded"
                                    id="add-task" href="../template/create_task.html">New Task</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Page Header -->
            <!-- show dorpdown filter -pr -->
            <div class="crms-title row bg-white d-flex flex-wrap align-items-center gap-2 mb-4 ps-4">

                <!-- Project Filter -->
                <select id="project-filter-task" class="form-select form-select-sm" style="width: 140px;">
                    <option value="all" selected>All Projects</option>
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                    @endforeach
                </select>

                <!-- Milestone Filter -->
                <select id="milestone-filter-task" class="form-select form-select-sm" style="width: 140px;">
                    <!-- Option will be inserted here via AJAX -pr -->
                </select>

                <!-- if no milestone is available of selected project -->
                <div id="no-milestone">
                    <!-- <a href="/admin/projects/milestonecreate" style="color: blue; text-decoration: underline;">Create a new milestone</a> -->
                </div>

                <!-- Priority Filter -->
                <select id="priority-filter-task" class="form-select form-select-sm" style="width: 140px;">
                    <option value="all" selected>All Prioritys</option>
                    <option value="high">High</option>
                    <option value="medium">Medium</option>
                    <option value="low">Low</option>
                </select>

                <!-- Status Filter -->
                <select id="status-filter-task" class="form-select form-select-sm" style="width: 140px;">
                    <option value="all" selected>All Status</option>
                    <option value="To Do">To Do</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Completed">Completed</option>
                </select>

                <!-- Date Range -->
                <div id="date-inputs" class="d-flex align-items-center gap-2 w-auto">
                    <span style="font-size: 16px;">From</span>
                    <input id="start-date" class="form-control form-control-sm rs-att-date"  readonly placeholder="Start Date">
                    <span style="font-size: 16px;">To</span>
                    <input id="end-date" class="form-control form-control-sm rs-att-date"  readonly placeholder="End Date">
                    <button id="clear" class="btn btn-sm btn-outline-secondary rs-clear-btn">Clear</button>
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
            <!-- Content Starts -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-nowrap custom-table mb-0 datatable addexamplesearch tasksearch">
                                    <thead>
                                        <tr>
                                            <th class="checkBox">Sr.No</th>
                                            <th class="checkBox sorting" style="width: 35px;">Task Name</th>
                                            <th class="checkBox sorting" style="width: 35px;">Priority</th>
                                            <th class="checkBox sorting" style="width: 35px;">Estimated Hours</th>
                                            <th class="checkBox sorting" style="width: 35px;">Milestone (Project)</th>
                                            <th class="checkBox sorting" style="width: 35px;">Start Date</th>
                                            <th class="checkBox sorting" style="width: 35px;">Due Date</th>
                                            <th class="checkBox sorting" style="width: 35px;">Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="task-data">
                                        <!-- Dyanmic data will apper here. -pr -->
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
    <!-- /index Page -->
    <!-- task details   -->
    @foreach ($tasks as $task)
    <div class="modal right fade" id="task-details-modal-{{$task->id}}" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row w-100">
                        <div class="col-md-7 account d-flex">
                            <div>
                                <p class="mb-0">Task Name</p>
                                <span class="modal-title">{{$task->task_name}}</span>
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
                                        <div class="accordion-header js-accordion-header">Task Name</div>
                                        <div class="accordion-body js-accordion-body">
                                            <div class="accordion-body__contents">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>Task Name</td>
                                                            <td>{{$task->task_name}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Created By</td>
                                                            <td>{{$task->created_by}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tasks__item crms-task-item">
                                        <div class="accordion-header js-accordion-header">Task Description</div>
                                        <div class="accordion-body js-accordion-body">
                                            <div class="accordion-body__contents">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td class="border-0">Description</td>
                                                            <td class="border-0">{{$task->task_description}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tasks__item crms-task-item">
                                        <div class="accordion-header js-accordion-header">Task Status</div>
                                        <div class="accordion-body js-accordion-body">
                                            <div class="accordion-body__contents">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td class="border-0">Status</td>
                                                            <td class="border-0">{{$task->status}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tasks__item crms-task-item">
                                        <div class="accordion-header js-accordion-header">Priority Level</div>
                                        <div class="accordion-body js-accordion-body">
                                            <div class="accordion-body__contents">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td class="border-0">Priority Level</td>
                                                            <td class="border-0">{{$task->priority}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tasks__item crms-task-item">
                                        <div class="accordion-header js-accordion-header">Dates</div>
                                        <div class="accordion-body js-accordion-body">
                                            <div class="accordion-body__contents">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td class="border-0">Start Date</td>
                                                            <td class="border-0">{{$task->start_date}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border-0">Due Date</td>
                                                            <td class="border-0">{{$task->end_date}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tasks__item crms-task-item">
                                        <div class="accordion-header js-accordion-header">Hours</div>
                                        <div class="accordion-body js-accordion-body">
                                            <div class="accordion-body__contents">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td class="border-0">Estimated Hours</td>
                                                            <td class="border-0">{{$task->estimated_hours}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tasks__item crms-task-item">
                                        <div class="accordion-header js-accordion-header">Dependencies</div>
                                        <div class="accordion-body js-accordion-body">
                                            <div class="accordion-body__contents">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td class="border-0">Dependencies</td>
                                                            <td class="border-0">{{$task->dependencies}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tasks__item crms-task-item">
                                        <div class="accordion-header js-accordion-header">Milestones</div>
                                        <div class="accordion-body js-accordion-body">
                                            <div class="accordion-body__contents">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td class="border-0">Milestones</td>
                                                            <td class="border-0">{{$task->milestone->milestone_name}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tasks__item crms-task-item">
                                        <div class="accordion-header js-accordion-header">Comments/Notes</div>
                                        <div class="accordion-body js-accordion-body">
                                            <div class="accordion-body__contents">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td class="border-0">Comments/Notes</td>
                                                            <td class="border-0">{{$task->comments}}</td>
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
    @endforeach
    
    <!-- /task details -->
    <!-- task update module -->
    @foreach ($tasks as $task)
    <div class="modal right fade " id="task-update-{{$task->id}}" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row w-100">
                        <div class="col  p-0">
                            <h3 class="page-title m-0">
                                <span class="page-title-icon bg-gradient-primary text-white me-2">
                                    <i class="bi bi-grid"></i>
                                </span>Update Task </h3>
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
                                        <form action="{{ route('admin.tasks.index.update', $task->id) }}" 
                                        method="POST" id="updateprojectdetails" enctype="multipart/form-data">
                                                @csrf
                                                @method('PATCH')
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label class="col-form-label">Task Name <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text" value="{{$task->task_name}}" required name="task_name">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="col-form-label">Task Description</label>
                                                    <textarea style="height:41px;"class="form-control" type="text" name="description" id="">{{$task->task_description}}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label class="col-form-label">Start Date<span class="text-danger">*</span></label>
                                                    <input id="start_date" class="form-control" required type="date" name="start_date" value="{{$task->start_date}}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="col-form-label">End Date<span class="text-danger">*</span></label>
                                                    <input id="end_date" class="form-control" type="date" required name="end_date" value="{{$task->end_date}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label class="col-form-label">Status<span class="text-danger">*</span></label>
                                                    <select class="form-control form-select" name="status">
                                                        <option value="In Progress" {{$task->status == 'In Progress' ? 'selected' : ''}}>In Progress</option> 
                                                        <option value="Completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                                        <option value="To Do" {{ $task->status == 'To Do' ? 'selected' : '' }} >To Do</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="col-form-label ">Priority<span class="text-danger">*</span></label>
                                                    <select class="form-control js-states single" name="priority" placeholder="Priority">
                                                        <option value="low" {{$task->priority == 'Low' ? 'selected' : ''}}>Low</option>
                                                        <option value="medium" {{$task->priority == 'Medium' ? 'selected' : ''}}>Medium</option>
                                                        <option value="high" {{$task->priority == 'High' ? 'selected' : ''}}>High</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label class="col-form-label">Estimated Hours<span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text" name="estimated_hours" value="{{ $task->estimated_hours }}">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="col-form-label">Dependencies</label>
                                                    <input class="form-control" type="text" name="dependencies" value="{{$task->dependencies}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <label class="col-form-label">Notes/Comments</label>
                                                    <textarea class="form-control" name="comments" rows="3" id="description" placeholder="">{{$task->comments}}</textarea>
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
    <!-- task update end -->

@endsection
@section('script')
<script src="{{asset('/assets/js/taskview.js')}}"></script> <!-- pr -->
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
@endsection