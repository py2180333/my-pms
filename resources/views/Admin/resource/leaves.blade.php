@extends('Admin.layouts.master')
@include('Admin.layouts.sidebar')
@include('Admin.layouts.headerMenu')
@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" rel="stylesheet" />
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
                        </span> Leaves
                    </h3>
                </div>
                <div class="col p-0 text-end">
                    <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Leaves</li>
                    </ul>
                </div>
            </div>

            <!-- show count data -pr -->
            <div class="row mt-4">

                <!-- Total Leaves -->
                <div class="col-xl-4 col-sm-6 col-12">
                    <div class="card inovices-card">
                        <div class="card-body">
                            <div class="inovices-widget-header">
                                <span class="inovices-widget-icon">
                                    <img src="{{asset('/assets/img/invoices-icon1.svg')}}" alt="">
                                </span>
                                <div class="inovices-dash-count">
                                    <div class="inovices-amount" id="totalLeaves">-</div>
                                </div>
                            </div>
                            <p class="inovices-all">Total Leaves<span></span></p>
                        </div>
                    </div>
                </div>

                <!-- Paid Leaves -->
                <div class="col-xl-4 col-sm-6 col-12">
                    <div class="card inovices-card">
                        <div class="card-body">
                            <div class="inovices-widget-header">
                                <span class="inovices-widget-icon">
                                    <img src="{{asset('/assets/img/invoices-icon2.svg')}}" alt="">
                                </span>
                                <div class="inovices-dash-count">
                                    <div class="inovices-amount" id="paidLeaves">-</div>
                                </div>
                            </div>
                            <p class="inovices-all">Paid Leaves<span></span></p>
                        </div>
                    </div>
                </div>

                <!-- Unpaid Leaves -->
                <div class="col-xl-4 col-sm-6 col-12">
                    <div class="card inovices-card">
                        <div class="card-body">
                            <div class="inovices-widget-header">
                                <span class="inovices-widget-icon">
                                    <img src="{{asset('assets/img/invoices-icon3.svg')}}" alt="">
                                </span>
                                <div class="inovices-dash-count">
                                    <div class="inovices-amount" id="unpaidLeaves">-</div>
                                </div>
                            </div>
                            <p class="inovices-all">Unpaid Leaves<span></span></p>
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
                        <select id="resource-filter-leave" class="form-select form-select-sm w-auto">
                            <option value="all" selected>All Resources</option>
                            @foreach ($resources as $r)
                                <option value="{{ $r->resource->id }}">{{ $r->resource->first_name }} {{ $r->resource->last_name }}</option>
                            @endforeach
                        </select>

                        <!-- Status Filter -->
                        <select id="status-filter-leave" class="form-select form-select-sm" style="width: 140px; margin:0 10px;">
                            <option value="all" selected>All Status</option>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>

                        <!-- Leave Type -->
                        <select id="type-filter-leave" class="form-select form-select-sm" style="width: 140px; margin:0px 10px 0 0px;">
                            <option value="all" selected>All Types</option>
                            <option value="paid">Paid</option>
                            <option value="unpaid">Unpaid</option>
                        </select>

                        <!-- Date Range -->
                        <div id="date-inputs" class="d-flex align-items-center gap-2">
                            <span style="font-size: 16px;">From</span>
                            <input id="start-date" class="form-control form-control-sm rs-att-date"  readonly placeholder="Start Date">
                            <span style="font-size: 16px;">To</span>
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
                            <!-- <form method="GET" action="" class="mb-3">
                                <div class="input-group">
                                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search by name or date">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </form> -->
                            <div class="table-responsive">
                                <table class="table table-striped table-nowrap custom-table mb-0 datatable addexamplesearch leavesearch">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Reason</th>
                                            <th>Total leave</th>
                                            <th>Paid leave</th>
                                            <th>UnPaid leave</th>
                                            <th>status</td>
                                            <th>Action</th>
                                        </tr>
                                    <thead>
                                    <tbody id="leave-data">
                                        <!-- Data will be inserted here via AJAX -pr -->
                                        {{--@foreach ($leaves as $leave)
                                        <tr>
                                           <td>{{ $leave->resource->first_name}}</td>
                                           <td> {{ $leave->reason_for_leave}}</td>
                                           <td> {{$leave->total_days}}</td>
                                           <td>{{$leave->paid_days}}</td>
                                           <td>{{$leave->unpaid_days}}</td>
                                           <td>{{ $leave->status }}</td>
                                           <td class="d-flex">
                                                <button class="btn btn-info btn-sm view-calendar" data-leave-id="{{ $leave->id }}">View</button>
                                                <button class="btn btn-sm btn-primary edit-leave" data-id="{{ $leave->id }}" data-status="{{ $leave->status }}">Edit</button>
                                                <form method="POST" action="{{ route('admin.leaves.destroy', $leave->id) }}" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this leave?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                                                </form>
                                           </td>
                                        </tr>
                                        @endforeach--}}
                                    </tbody>
                                </table>
                                <!-- <div class="d-flex justify-content-center mt-3">
                                    {{-- {{ $attendances->links() }} --}}
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <!-- <nav aria-label="Table pagination ">
                        <ul class="pagination justify-content-end mt-3 mypagination">
                           
                        </ul>
                    </nav> -->
                </div>
            </div>
            <!-- Calendar Modal -->
            <div class="modal fade" id="calendarModal" tabindex="-1" role="dialog" aria-labelledby="calendarModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Leave Calendar</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div id="calendar-popup"></div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- edit status --}}
            <!-- Edit Status Modal -->
            <div class="modal fade" id="editLeaveModal" tabindex="-1" role="dialog" aria-labelledby="editLeaveModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form id="editLeaveForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title">Edit Leave Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                    <div class="form-group">
                        <label for="status">Select Status</label>
                        <select name="status" id="leave-status" class="form-control">
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                        </select>
                    </div>
                    </div>
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </div>
                </form>
            </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('/assets/js/leaveview.js')}}"></script> <!-- pr -->
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
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
   <script>
        $(document).ready(function () {
            let calendar;

            // $('.view-calendar').click(function () { // rd
            $(document).on('click', '.view-calendar', function () { // pr
                const leaveId = $(this).data('leave-id');

                $('#calendarModal').modal('show');
                if ($('#calendar-popup').hasClass('fc')) {
                    $('#calendar-popup').fullCalendar('destroy');
                    $('#calendar-popup').html(''); // Clear leftover markup
                }

                setTimeout(() => {
                    if (calendar) {
                        calendar.fullCalendar('destroy');
                    }

                    $('#calendar-popup').fullCalendar({
                        header: {
                            left: 'title',
                            center: 'month,agendaWeek,agendaDay',
                            right: 'prev,next today'
                        },
                        editable: false,
                        droppable: false,
                        selectable: false,
                        defaultView: "month",
                        firstDay: 1,
                        allDaySlot: true,
                        events: function (start, end, timezone, callback) {
                            const startDate = moment(start).format('YYYY-MM-DD');
                            const endDate = moment(end).format('YYYY-MM-DD');

                            fetch(`/admin/leaves/calendar-data/${leaveId}?start=${startDate}&end=${endDate}`)
                                .then(response => response.json())
                                .then(data => callback(data))
                                .catch(error => console.error('Calendar fetch error:', error));
                        },
                        eventRender: function (event, element) {
                            element.attr('title', event.title);
                        }
                    });
                }, 300);
            });
        });
    </script> 
    <script>
        $(document).ready(function () {
            // Edit button click
            // $('.edit-leave').on('click', function () { // rd
            $(document).on('click', '.edit-leave', function () { // pr
                const leaveId = $(this).data('id');
                const currentStatus = $(this).data('status');

                $('#leave-status').val(currentStatus);
                $('#editLeaveForm').attr('action', `/admin/leaves/update-status/${leaveId}`);
                $('#editLeaveModal').modal('show');
            });
        });
    </script>
@endsection