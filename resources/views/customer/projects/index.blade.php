@extends('customer.layouts.master')
@include('customer.layouts.sidebar')
@include('customer.layouts.headerMenu')
@section('style')
<link rel="stylesheet" href="{{asset('/assets/multi-calendar/dist/daterangepicker.min.css')}}"/> <!-- pr -->
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
                        <li class="breadcrumb-item"><a href="{{ route('customer.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Projects</li>
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

                        <!-- Project Filter -->
                        <li>
                            <div class="multipleSelection m-0">
                                <select id="customer-filter-project" class="form-select">
                                    <option value="all" selected>All Projects</option>
                                    @foreach($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->project_name }}</option>
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
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
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

@endsection
@section('script')
<script src="{{asset('/assets/js/customer/projectview.js')}}"></script>
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