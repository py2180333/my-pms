<!-- new -pr 10-7-25 -->
@extends('Admin.layouts.master')
@include('Admin.layouts.sidebar')
@include('Admin.layouts.headerMenu')
@section('style')
<link rel="stylesheet" href="{{asset('/assets/multi-calendar/dist/daterangepicker.min.css')}}"/>
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
                        </span> Timesheet Resource Report
                    </h3>
                </div>
                <div class="col p-0 text-end">
                    <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Timesheet Resource Report</li>
                    </ul>
                </div>
            </div>

            <div id="errorMesage">

            </div>

            <!-- show dorpdown filter -pr -->
            <div class="crms-title d-flex bg-white  align-items-center gap-2 mt-4">

                <!-- Company Filter -->
                <select id="company-filter-report" class="form-select form-select-sm">
                    <option value="" selected disabled>-- Select Company --</option>
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                    @endforeach
                </select>

                <!-- Resource Filter -->
                <select id="resource-filter-report" class="form-select form-select-sm " disabled>
                    <option value="" selected disabled>-- Select Resource --</option>
                    <!-- Dynamic data will appear here. -pr -->
                </select>

                <!-- Project Filter -->
                <select id="project-filter-report" class="form-select form-select-sm " disabled>
                    <option value="all" selected>All Projects</option>
                    <!-- Dynamic data will appear here. -pr -->
                </select>

                <!-- Date Range -->
                <div id="date-inputs" class="d-flex align-items-center gap-2">
                    <span style="font-size: 16px;">From</span>
                    <input id="start-date" class="form-control form-control-sm rs-att-date" style="width: 110px;" readonly placeholder="Start Date">
                    <span style="font-size: 16px;">To</span>
                    <input id="end-date" class="form-control form-control-sm rs-att-date" style="width: 110px;" readonly placeholder="End Date">
                    <button id="clear" class="btn  btn-outline-secondary rs-clear-btn">Clear</button>
                </div>

                <button class="btn btn-primary" id="generate">Generate</button>
            </div>
            <!-- /show dorpdown filter -pr -->

            <!-- Content Starts new -pr 10-7-25 -->
            <style>
                .no-border td {
                    border: none !important;
                }

                .middle {
                    text-align: center;
                }
            </style>
            <div class="container  my-4 p-0 " id="reportContent">

                <!-- Report Title and Project Info -->
                <table class="table card bg-white rs-timeline-table">
                    <tbody>
                        <tr class="no-border middle pt-2">
                            <td class="mb-2 mt-3" colspan="5"><strong style="font-size: 16px;">Timesheet Resource Report</strong></td>
                        </tr>
                        <tr class="no-border">
                            <td>
                                <strong>Resource Name:</strong>
                                <span id="resourceName"></span>
                            </td>
                            
                            <td>
                                <strong>Weekend Hours:</strong>
                                <span id="weekendHours"></span>
                            </td>
                        </tr>
                        <tr class="no-border">
                            <td>
                                <strong>Resource Status:</strong>
                                <span id="resourceStatus"></span>
                            </td>
                            

                            <td>
                                <strong>Project Hours:</strong>
                                <span id="projectHours"></span>
                            </td>
                        </tr>
                        <tr class="no-border">
                            <td>
                                <strong>Salary:</strong>
                                <span id="salary"></span>
                            </td>

                            <td>
                                <strong>Total Hours:</strong>
                                <span id="totalHours"></span>
                            </td> 
                        </tr>
                    </tbody>
                </table>
                <div class="crms-title bg-white" id="companies">
                    <!-- Dynamic data will apper here -pr -->
                </div>

                <!-- Data Table Starts -->
                <table class="table table-bordered table-striped mt-3 bg-white">
                    <thead class="bg-primary text-center">
                        <tr>
                            <th class="text-white">Sr</th>
                            <th class="text-white">Project Name</th>
                            <th class="text-white">Milestone Name</th>
                            <th class="text-white">Task Name</th>
                            <th class="text-white">Project Work Hours</th>
                        </tr>
                    </thead>
                    <tbody id="row" class="text-center">
                        <!-- Dynamic rows will appear here -->
                        <tr>
                            <td colspan="5">No Data Available</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="container text-end mb-4">
                <button class="btn btn-primary" id="downloadBtn" onclick="printSection('reportContent')">Download PDF</button>
            </div>
            <!-- new -pr 31-7-25 -->
            <script>
                function printSection(sectionId){
                    const printContent = document.getElementById(sectionId).innerHTML;
                    const originalContent = document.body.innerHTML;

                    document.body.innerHTML = printContent;
                    window.print();

                    document.body.innerHTML = originalContent;
                    location.reload(true);
                }
            </script>
            <!-- /Content End -->

        </div>
        <!-- /Page Content -->
    </div>
    <!-- /index Page -->
@endsection
@section('script')
<script src="{{asset('/assets/js/timesheetResourceReport.js')}}"></script> <!-- pr -->
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