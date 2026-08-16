@extends('Admin.layouts.master')
@include('Admin.layouts.sidebar')
@include('Admin.layouts.headerMenu')
@section('style')
<link rel="stylesheet" href="{{asset('/assets/multi-calendar/dist/daterangepicker.min.css')}}"/> <!-- pr -->
@endsection
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
                        </span> Attendance
                    </h3>
                </div>
                <div class="col p-0 text-end">
                    <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Attendance</li>
                    </ul>
                </div>
            </div>

            <!-- show count data -pr -->
            <div class="row mt-4"> <!-- rs bootstrap class add -->

                <!-- Working Days -->
                <div class="col-xl-4 col-sm-6 col-12">
                    <div class="card inovices-card">
                        <div class="card-body">
                            <div class="inovices-widget-header">
                                <span class="inovices-widget-icon">
                                    <img src="{{asset('/assets/img/invoices-icon1.svg')}}" alt="">
                                </span>
                                <div class="inovices-dash-count">
                                    <div class="inovices-amount" id="workingDays">-</div>
                                </div>
                            </div>
                            <p class="inovices-all">Working Days<span></span></p>
                        </div>
                    </div>
                </div>

                <!-- Working Hours -->
                <div class="col-xl-4 col-sm-6 col-12">
                    <div class="card inovices-card">
                        <div class="card-body">
                            <div class="inovices-widget-header">
                                <span class="inovices-widget-icon">
                                    <img src="{{asset('/assets/img/invoices-icon2.svg')}}" alt="">
                                </span>
                                <div class="inovices-dash-count">
                                    <div class="inovices-amount" id="totalWorkigHours">-</div>
                                </div>
                            </div>
                            <p class="inovices-all">Total Working Hours<span></span></p>
                        </div>
                    </div>
                </div>

                <!-- Break Hours -->
                <div class="col-xl-4 col-sm-6 col-12">
                    <div class="card inovices-card">
                        <div class="card-body">
                            <div class="inovices-widget-header">
                                <span class="inovices-widget-icon">
                                    <img src="{{asset('assets/img/invoices-icon3.svg')}}" alt="">
                                </span>
                                <div class="inovices-dash-count">
                                    <div class="inovices-amount" id="totalBreakHours">-</div>
                                </div>
                            </div>
                            <p class="inovices-all">Total Break Hours<span></span></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /show count data -pr -->

            <!-- show dorpdown filter -pr -->
            <div class="d-flex flex-wrap align-items-center gap-2">
              <div class="crms-title row bg-white w-100">
               <div class="col-12 d-flex">
                   <!-- Resource Filter -->
                <select id="resource-filter-attendance" class="form-select form-select-sm w-auto">
                    <option value="all" selected>All Resources</option>
                    @foreach ($attendanceResources as $ar)
                        <option value="{{ $ar->resource->id }}">{{ $ar->resource->first_name }} {{ $ar->resource->last_name }}</option>
                    @endforeach
                </select>

                <!-- Date Range -->
                <div id="date-inputs" class="d-flex align-items-center gap-2">
                    <span style="font-size: 16px; margin:0 10px;">From</span>
                    <input id="start-date" class="form-control form-control-sm rs-att-date" readonly placeholder="Start Date">
                    <span style="font-size: 16px; margin:0 10px;">To</span>
                    <input id="end-date" class="form-control form-control-sm rs-att-date"  readonly placeholder="End Date">
                    <button id="clear" class="btn btn-sm btn-outline-secondary rs-clear-btn">Clear</button>
                </div>

               </div>
              </div>
            </div>
            <!-- /show dorpdown filter -pr -->

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <!-- <form method="GET" action="{{ route('admin.attendance') }}" class="mb-3">
                                <div class="input-group">
                                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search by name or date">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </form> -->
                            <!-- sr -->
                            <style>
                                .sorting:after{
                                    display:none !important;
                                }
                                .sorting:before{
                                    display:none !important;
                                }
                                .sorting_desc:after{
                                    display:none !important;
                                }
                                .sorting_desc:before{
                                    display:none !important;
                                }
                                 .sorting_asc:after{
                                    display:none !important;
                                 }
                                 .sorting_asc:before{
                                    display:none !important;
                                 }
                            </style>
                            <div class="table-responsive">
                                <table class="table table-striped table-nowrap custom-table mb-0 datatable addexamplesearch attendancesearch">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <!-- <th class="rs">Date</th> -->
                                            <th>Date</th>
                                            <th>Login In</th>
                                            <th>Log Out</th>
                                            <th>Break</th>
                                            <th>Working Hours</th>
                                            <th>Action</th>
                                        </tr>
                                    <thead>
                                    <tbody id="attendance-data">
                                        {{--@foreach ($attendances as $attendance)
                                            <tr>
                                                <td>{{ $attendance->resource->first_name}}</td>
                                                <td>{{ $attendance->date }}</td>
                                                
                                                <td>{{ $attendance->check_in ? \Carbon\Carbon::parse($attendance->check_in)->format('H:i') : 'NA' }}</td>
                                                <td>{{ $attendance->check_out ? \Carbon\Carbon::parse($attendance->check_out)->format('H:i') : 'NA' }}</td>
                                                <td> {{ $attendance->break_minutes}}</td>
                                                <td>
                                                    @if(!is_null($attendance->check_in) && !is_null($attendance->check_out))
                                                        @php
                                                            $checkIn = \Carbon\Carbon::parse($attendance->check_in);
                                                            $checkOut = \Carbon\Carbon::parse($attendance->check_out);
                                                            $workingHours = $checkOut->diffInMinutes($checkIn) - $attendance->break_minutes;
                                                            $formattedWorkingHours = floor($workingHours / 60) . ':' . str_pad($workingHours % 60, 2, '0', STR_PAD_LEFT);
                                                        @endphp
                                                        {{ $formattedWorkingHours }}
                                                    @else
                                                        NA
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="#" class="ms-2 p-2 fs-6 my_icons edit-action" data-bs-toggle="modal" data-bs-target="#update-attendance-{{$attendance->id}}" data-id="{{ $attendance->id }}"><i
                                                        class="fa-solid fa-pen-to-square text-dark"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Edit"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach--}}
                                    </tbody>
                                </table>
                                {{-- <div class="d-flex justify-content-center mt-3">
                                    {{ $attendances->links() }}
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <!-- <nav aria-label="Table pagination ">
                        <ul class="pagination justify-content-end mt-3 mypagination">
                           
                        </ul>
                    </nav> -->
                </div>
            </div>
        </div>
    </div>
    @foreach($attendances as $attendance)
        <div class="modal right fade " id="update-attendance-{{$attendance->id}}" tabindex="-1" role="dialog" aria-modal="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="row w-100">
                            <div class="col  p-0">
                                <h3 class="page-title m-0">
                                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                                        <i class="bi bi-grid"></i>
                                    </span>Update Attendance 
                                </h3>
                            </div>
                        </div>
                        <button type="button" class="btn-close xs-close" data-bs-dismiss="modal" onclick="this.blur();"></button> 
                    </div>
                    <div class="modal-body">
                        <div class="task-infos">
                            <div class="tab-content">
                                <div class="content container-fluid">
                                    <!-- Content Starts -->
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <form action="{{ route('admin.attendance.update', $attendance->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        <label class="col-form-label">Login In<span class="text-danger">*</span></label>
                                                        <input class="form-control" type="time" value="{{ $attendance->check_in ? \Carbon\Carbon::parse($attendance->check_in)->format('H:i') : null }}" name="check_in">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="col-form-label">Log Out<span class="text-danger">*</span></label>
                                                        <input class="form-control" type="time" value="{{ $attendance->check_out ? \Carbon\Carbon::parse($attendance->check_out)->format('H:i') : null }}" name="check_out">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="col-form-label">Break Time<span class="text-danger">*</span></label>
                                                        <input class="form-control" type="number" min="0" max="60" value="{{ $attendance->break_minutes}}" name="break_minutes">
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
                    </div><!-- modal-content -->
                </div><!-- modal-dialog -->
            </div>
    @endforeach
@endsection
@section('script')
<script src="{{asset('/assets/js/attendanceview.js')}}"></script> <!-- pr -->
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