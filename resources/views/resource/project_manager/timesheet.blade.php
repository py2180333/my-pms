@extends('resource.master')
@include('resource.sidebar')
@section('content')

<style>
    /* timesheet start */
.rs-header-timesheet {
    display: flex;
    justify-content: space-evenly;
    align-items: center;
    margin-bottom: 30px;
    padding: 10px;
    background-color: #fff
}
.rs-hrs-timesheet {
    width: 100%;
    background-color: #fff;
    text-align: center;
    margin: 0px 15px 0 15px;
    box-shadow: 0rem 0.3125rem 0.3125rem 0rem rgb(34 80 176 / 55%);
}
.rs-timesheet-task {
    background: #2250b0;
    color: #fff;
}
.rs-dat-timesheet p {
    margin: 5px 0;
}
.rs-hrs2-timesheet h5, p {
    margin: 0 0;
}
.rs-hrs2-timesheet{
    margin-bottom: 10px;
}
.rs-dat-timesheet {
    border-bottom: 2px solid #2250b0a3;
    margin-bottom: 10px;
    border-radius: 12px;
    box-shadow: rgba(0, 0, 0, 0.1) 0px 20px 25px -5px, rgba(0, 0, 0, 0.04) 0px 10px 10px -5px;
    transition: 0.5s;
}
.rs-hrs-timesheet:hover .rs-dat-timesheet {
    box-shadow: none;
}

a.rs-total-timesheet-project {
    background: #2250b0;
    padding: 11px 80px;
    color: #fff;
    text-align: center;
    box-shadow: rgba(0, 0, 0, 0.1) 0px 20px 25px -5px, rgba(0, 0, 0, 0.04) 0px 10px 10px -5px;
}

a.rs-total-timesheet-weekend {
    background-color: #ffffff;
    color: #2250b0;
    padding: 10px 80px;
    text-align: center;
    box-shadow: rgba(0, 0, 0, 0.1) 0px 20px 25px -5px, rgba(0, 0, 0, 0.04) 0px 10px 10px -5px;
}
.rs-main-total-timesheet .row {
    background-color: #fff;
    padding-bottom: 10px;
    padding-top: 10px;
}
.timesheet-breakdown h6 {
    margin: 0;
    color: #2250b0;
}
.timesheet-breakdown h6 span {
    background-color: #2250b0;
    padding: 8px 8px;
    color: #fff;
    border-radius: 8px;
    font-size: 12px;
}
.rs-hrs-timesheet.active-date .rs-dat-timesheet {
    color: #2250b0;
}

.task-rs-first {
    background-color: #2250b042;
    border: 1px solid #eee;
    padding: 10px;
    border-radius: 12px;
}

.task-rs-first h5 {
    font-size: 14px;
}
.task-rs-first p {
    color: #000;
    font-size: 12px;
}
p.rs-task-name::before {
    content: "";
    border-top: 1px solid #fff;
    width: 108%;
    margin: 0;
    position: absolute;
    left: -10px;
    right: 0;
    top: -7px;
    bottom: 0;
    padding: 18px;
}

p.rs-task-name {
    position: relative;
    margin-top: 10px;
}
.rs-task-timesheet-filtter {
    background-color: #2250b0;
    padding: 5px 20px;
    border-radius: 12px;
    color: #fff;
    transition: 0.5s;
    cursor: pointer;
}
.rs-task-timesheet-filtter:hover {
    background-color: #c6d2eb;
    color: #000;
}
.rs-task-timesheet-filtter.rs-active-filtter{
    background-color: #c6d2eb;
    color: #000;
}
/* timesheet end */
</style>
<!-- /Sidebar -->
<!-- Page Wrapper -->
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- pranav -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="crms-title row mb-4 bg-white" >
            <div class="col-md-2 w-auto p-0">
                <form action="{{ route('resource.projectManagerStore') }}" method="POST" id="ts-form"><!-- TimesheetController -> store -->
                @csrf
                    <div class="row gap-2 mt-3 mb-3">
                        <div class="col-md-2">
                            <!-- project manager can select the consultant -pranav -->
                            <select class="form-control text-capitalize w-auto" id="selected_consultant" value="{{ session('c_id', '') }}">
                                {{-- Always show current user first --}}
                            <option value="{{ Auth::id() }}">
                                {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} (You)
                            </option>
                            
                            {{-- Show other consultants (excluding the current user) --}}
                            @foreach($consultant as $c)
                                @if($c && $c->id != Auth::id())
                                    <option value="{{ $c->id }}" {{ session('c_id') == $c->id ? 'selected' : '' }}>
                                        {{ $c->first_name }} {{ $c->last_name }}
                                    </option>
                                @endif
                            @endforeach
                            </select>
                        </div>

                        <div class="col-md-2 ps-2">
                            <a class="rs-bulk-btn" href="{{ route('resource.timesheet.projectManager.bulkEdit.show') }}">Bulk Edit</a> <!-- pr -->
                        </div>
                    </div>

                    <div class="crms-title row bg-white">
                        <div class="col  p-0">
                            <h3 class="page-title m-0">
                                <span class="page-title-icon bg-gradient-primary text-white me-2">
                                    <i class="bi bi-grid"></i>
                                </span> Time Sheet
                            </h3>
                        </div>
                        <div class="col p-0 d-flex align-items-center justify-content-evenly" >
                            <i id="rs-prev-date-timesheet" class="fa-solid fa-chevron-left"></i>
                            {{-- value={{...}} class=calender -pranav --}}
                            <input type="date" id="rs-mydate-timesheet" class="form-control calender" style="width: 150px; border: none;" placeholder="dd/mm/yyyy">
                            <input type="hidden" class="hidden-calender" value="{{ session('fill_date', '') }}"> <!-- pranav -->
                            <i id="rs-next-date-timesheet" class="fa-solid fa-chevron-right"></i>
                            <!-- End of Week Date Input (Readonly) -->
                            <input type="text" id="rs-endofweek-date" class="form-control" style="width: 180px; border: none; background: transparent;" readonly placeholder="End of Week Date">
                        </div>
                        <div class="col p-0 text-end">
                            <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Time sheet</li>
                            </ul>
                        </div>
                    </div>

                    <div class="row mt-4 mb-4">
                        <div class="col-md-12">
                            <!-- class="day-0 to 6" - pranav -->
                            <!-- class="common-day" set commvalue when user in future data in timesheet_project_manager.js - pranav -->
                            <div class="rs-header-timesheet">
                                <div class="rs-hrs-timesheet common-day day-0">
                                    <div class="rs-dat-timesheet">
                                        <p id="start-date">Sun <span>13</span></p> <!-- id="start-date" use in timesheet_project_manager.js -pranav -->
                                    </div>
                                    <div class="rs-hrs2-timesheet">
                                        <h5>-NA-</h5>
                                        <p>Hrs</p>
                                    </div>
                                    <div class="rs-timesheet-task"><span>0</span>
                                        Task
                                    </div>
                                </div>
                                <div class="rs-hrs-timesheet common-day day-1">
                                    <div class="rs-dat-timesheet">
                                        <p>Mon <span>14</span></p>
                                    </div>
                                    <div class="rs-hrs2-timesheet">
                                        <h5>-NA-</h5>
                                        <p>Hrs</p>
                                    </div>
                                    <div class="rs-timesheet-task"><span>0</span>
                                        Tsk
                                    </div>
                                </div>
                                <div class="rs-hrs-timesheet common-day day-2">
                                    <div class="rs-dat-timesheet">
                                        <p>Tue <span>15</span></p>
                                    </div>
                                    <div class="rs-hrs2-timesheet">
                                        <h5>-NA-</h5>
                                        <p>Hrs</p>
                                    </div>
                                    <div class="rs-timesheet-task"><span>0</span>
                                        Tsk
                                    </div>
                                </div>
                                <div class="rs-hrs-timesheet common-day day-3">
                                    <div class="rs-dat-timesheet">
                                        <p>Wed <span>16</span></p>
                                    </div>
                                    <div class="rs-hrs2-timesheet">
                                        <h5>-NA-</h5>
                                        <p>Hrs</p>
                                    </div>
                                    <div class="rs-timesheet-task"><span>0</span>
                                        Tsk
                                    </div>
                                </div>
                                <div class="rs-hrs-timesheet common-day day-4">
                                    <div class="rs-dat-timesheet">
                                        <p>Thu <span>17</span></p>
                                    </div>
                                    <div class="rs-hrs2-timesheet">
                                        <h5>-NA-</h5>
                                        <p>Hrs</p>
                                    </div>
                                    <div class="rs-timesheet-task"><span>0</span>
                                        Tsk
                                    </div>
                                </div>
                                <div class="rs-hrs-timesheet common-day day-5">
                                    <div class="rs-dat-timesheet">
                                        <p>Fri <span>18</span></p>
                                    </div>
                                    <div class="rs-hrs2-timesheet">
                                        <h5>-NA-</h5>
                                        <p>Hrs</p>
                                    </div>
                                    <div class="rs-timesheet-task"><span>0</span>
                                        Tsk
                                    </div>
                                </div>
                                <div class="rs-hrs-timesheet common-day day-6">
                                    <div class="rs-dat-timesheet">
                                        <p>Sta <span>19</span></p>
                                    </div>
                                    <div class="rs-hrs2-timesheet">
                                        <h5>-NA-</h5>
                                        <p>Hrs</p>
                                    </div>
                                    <div class="rs-timesheet-task"><span>0</span>
                                        Tsk
                                    </div>
                                </div>
                            </div>
                            <div class="rs-main-total-timesheet">
                        
                                <div class="crms-title row bg-white">
                                    <div class="col d-flex align-items-center  p-0">
                                        <div class="timesheet-breakdown">
                                            <h6>Time sheet Breakdown <span id="ts-breakdown">0 hrs</span></h6> <!-- id="total_work" -pranav -->
                                        </div>
                                    </div>
                        
                                    <div class="col p-0 text-end">
                                        <div class="ts-total-timesheet d-flex justify-content-end">
                                            <a class="rs-total-timesheet-project" href="">
                                                <p>project Task</p>
                                                <p>(<span id="project-task">0</span> hrs)</p> <!-- id="workingday_total" -pranav -->
                                            </a>
                                            <a class="rs-total-timesheet-weekend" href="">
                                                <p>Weekend Hours</p>
                                                <p>(<span id="weekend-task">0</span> hrs)</p> <!-- id="weekend_total" -pranav -->
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->
                    <!-- Content Starts -->
                    <!-- Timeline Content Starts pranav -->
                    @if ($errors->has('hour.*'))
                        <div class="alert alert-danger" id="message">
                            <strong>{{ $errors->first('hour.*') }}</strong>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger" id="message">
                            <strong>{{ session('error') }}</strong>
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success" id="message">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <input type="hidden" name="c_id" id="consultant_id"> <!-- store the consultant id to redirect back after successfull submission update in timesheet_project_manager.js -pranav -->
                                        <input type="hidden" name="fill_date" id="filleupDate"> <!-- store the starting date to redirect back after successfull submission update in this file js -pranav -->
                                        <table class="table table-striped table-nowrap custom-table mb-0 datatable">
                                            <thead>
                                                <tr>
                                                    <th class="checkbox sorting" style="width: 35px;">State</th>
                                                    <th class="checkBox sorting" style="width: 35px;">Project</th>
                                                    <th class="checkBox sorting" style="width: 35px;">Task</th>
                                                    <th class="checkBox sorting" style="width: 35px;">Comment</th>
                                                    <th class="checkBox sorting" style="width: 35px;">Rate type</th>
                                                    <th class="checkBox sorting" style="width: 35px;">Sun <span class="date" data-index="0"></span></th>
                                                    <th class="checkBox sorting" style="width: 35px;">Mon <span class="date" data-index="1"></span></th>
                                                    <th class="checkBox sorting" style="width: 35px;">Tue <span class="date" data-index="2"></span></th>
                                                    <th class="checkBox sorting" style="width: 35px;">Wed <span class="date" data-index="3"></span></th>
                                                    <th class="checkBox sorting" style="width: 35px;">Thu <span class="date" data-index="4"></span></th>
                                                    <th class="checkBox sorting" style="width: 35px;">Fri <span class="date" data-index="5"></span></th>
                                                    <th class="checkBox sorting" style="width: 35px;">Sta <span class="date" data-index="6"></span></th>
                                                    <th class="checkBox sorting" style="width: 35px;">Total</th>
                                                    <th class="text-end">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="timesheet_data"><!-- timesheet_project_manager.js -pranav -->
                                                <!-- pranav -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row bg-white mt-4">
                        <div class="col-1">
                        <!-- project manager can select the status -pranav -->
                            <select name="status" class="form-control text-capitalize w-auto" id="selected_status">
                                <option value="pending">pending</option>
                                <option value="approve">approve</option>
                                <option value="recheck">recheck</option>
                                <option value="reject">reject</option>
                            </select>   
                        </div>
                        <div class="col">
                            <button class="rs-bulk-btn" type="submit" id="submit">submit</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /Timeline Content End pranav-->
        </div>
    </div>
    <!-- /Page Content -->
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" ></script>
<script>
        
    $(document).ready(function () {
        const $dateInput = $('#rs-mydate-timesheet');
        const $endOfWeekInput = $('#rs-endofweek-date');
        const $days = $('.rs-header-timesheet .rs-hrs-timesheet');
    
        const dayNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    
        function formatDate(date) {
            const day = String(date.getDate()).padStart(2, '0');
            const month = monthNames[date.getMonth()];
            const year = date.getFullYear();
            return `${day} ${month} ${year}`;
        }
    
        function updateWeekView(dateStr) {
            const selectedDate = new Date(dateStr);
            if (isNaN(selectedDate)) return;

            const startOfWeek = new Date(selectedDate);
            startOfWeek.setDate(selectedDate.getDate() - selectedDate.getDay()); // Sunday
            const date_day = []; //pranav

            $days.each(function (index) {
                const currentDate = new Date(startOfWeek);
                currentDate.setDate(startOfWeek.getDate() + index);

                const isActive = currentDate.toDateString() === selectedDate.toDateString();
                const display = `${dayNames[currentDate.getDay()]} <span>${formatDate(currentDate)}</span>`;
                
                $(this)
                    .find('.rs-dat-timesheet p').html(display).end()
                    .toggleClass('active-date', isActive);

                date_day.push(String(currentDate.getDate()).padStart(2, '0')); // add in table columne -pranav
                $('.day-' + index).attr('id', 'date-wise-total-' + (currentDate.toISOString().split('T')[0])); // -pranav
                $('#filleupDate').val(currentDate.toISOString().split('T')[0]); // -pranav
            });

            // Step 2: Populate inputs for each row -pranav
            $('table tbody tr').each(function () {
                const $row = $(this);
            });

            // Change date in column -pranav
            $('.date').each(function() {
                const i = $(this).data('index');
                $(this).text(date_day[i] || '');
            });

            const endOfWeek = new Date(startOfWeek);
            endOfWeek.setDate(startOfWeek.getDate() + 6);
            $endOfWeekInput.val(formatDate(endOfWeek));
        }
    
        function shiftDate(days) {
            const current = new Date($dateInput.val());
            if (isNaN(current)) return;
            current.setDate(current.getDate() + days);
            $dateInput.val(current.toISOString().split('T')[0]);
            updateWeekView(current);
        }
    
        $dateInput.on('change', function () {
            updateWeekView(this.value);
        });
    
        $('#rs-prev-date-timesheet').on('click', () => shiftDate(-7)); // 7 week backward
        $('#rs-next-date-timesheet').on('click', () => shiftDate(7)); // 7 week forward
    
        var today = new Date();
        // $dateInput.val(today.toISOString().split('T')[0]); // sr
        /* pranav */
        if($('.hidden-calender').val() !== ''){
            today = new Date($('.hidden-calender').val());
            // $('.calender').val($('.hidden-calender').val());
            $dateInput.val(today.toISOString().split('T')[0]);
        } else {
            $dateInput.val(today.toISOString().split('T')[0]);
        }
        /* /pranav */
        updateWeekView(today); // sr
    });

    
    //   task filter
    document.querySelectorAll('[data-filter]').forEach(filterBtn => {
        filterBtn.addEventListener('click', function () {
            // Remove rs-active-filtter class from all filters
            document.querySelectorAll('[data-filter]').forEach(btn => btn.classList.remove('rs-active-filtter'));
            this.classList.add('rs-active-filtter');

            const filter = this.getAttribute('data-filter');
            document.querySelectorAll('[data-tags]').forEach(item => {
                const tags = item.getAttribute('data-tags').split(',');
                if (!filter || tags.includes(filter)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });

    /* pranav */
    setTimeout(function() {
        $('#message').remove(); // Removes the element after delay
    }, 3000); // 3000ms = 3 seconds

</script>
@endsection
@section('script') <!-- this is for project manager -->
    <script src="{{asset('/assets/js/timesheet_project_manager.js')}}"></script> <!-- pranav -->
@endsection