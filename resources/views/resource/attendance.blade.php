@extends('resource.master')
@include('resource.sidebar')
@section('style')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" rel="stylesheet" />
    <style>
       .fc-agendaDay-button,.fc-agendaWeek-button {
        display:none;
       }
       /* soheb changes */
       ul.rs-status-show {
    list-style: none;
    display: flex;
    justify-content: center;
}

ul.rs-status-show li {
    margin: 0 19px;
}

ul.rs-summary-show {
    list-style: none;
    display: flex;
    justify-content: space-between;
}

ul.rs-summary-show li {
}
.rs-attendance {
    display: flex;
    justify-content: center;
}

.rs-attendance form {
    margin: 0 10px;
}
</style>
@endsection
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div>
                <div class="container card text-center bg-white p-4 mb-4">
                    <h2 class="mb-4">Attendance for {{ now()->toFormattedDateString() }}</h2>

                    @php
                        use Carbon\Carbon;

                        $checkIn = $attendance->check_in ? Carbon::parse($attendance->check_in) : null;
                        $checkOut = $attendance->check_out ? Carbon::parse($attendance->check_out) : null;
                        $now = Carbon::now();

                        $totalMinutes = 0;
                        if ($checkIn && $checkOut) {
                            $totalMinutes = $checkOut->diffInMinutes($checkIn);
                        } elseif ($checkIn) {
                            $totalMinutes = $now->diffInMinutes($checkIn);
                        }

                        $productiveMinutes = max(0, $totalMinutes - $attendance->break_minutes);
                        $onBreak = $attendance->current_break_start !== null;
                        
                    @endphp
                    <div class="rs-attendance mb-4 mt-4">
                        {{-- Check In --}}
                        @if (!$checkIn)
                            <form method="POST" action="{{ route('resource.attendance.checkin') }}">
                                @csrf
                                <button class="btn btn-success moff">Check In</button>
                            </form>
                        @endif

                        {{-- Break In/Out --}}
                        @if ($checkIn && !$checkOut)
                            @if (!$onBreak)
                                <form method="POST" action="{{ route('resource.attendance.breakin') }}">
                                    @csrf
                                    <button class="btn btn-warning text-white mt-2 moff">Break In</button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('resource.attendance.breakout') }}">
                                    @csrf
                                    <button class="btn btn-info text-white mt-2 moff">Break Out</button>
                                </form>
                            @endif
                        @endif

                        {{-- Check Out --}}
                        @if ($checkIn && !$checkOut)
                            <form method="POST" action="{{ route('resource.attendance.checkout') }}">
                                @csrf
                                <button class="btn btn-danger mt-2 moff">Check Out</button>
                            </form>
                        @endif
                    </div>

                    <h4 class="mb-4"><strong>Status</strong></h4>
                    <ul class="rs-status-show p-0 mb-4">
                        <li><h4><strong>Check In:</strong> {{ $checkIn ? $checkIn->format('h:i A') : '— / —' }}</h4></li>
                        <li><h4><strong>Break Time:</strong> <span id="break-time">{{ floor($attendance->break_minutes / 60) }}h {{ $attendance->break_minutes % 60 }}m</span> </h4></li> <!-- pr add id="break-time" 25-9-25 -->
                        <li><h4><strong>Check Out:</strong> {{ $checkOut ? $checkOut->format('h:i A') : '— / —' }}</h4></li>
                    </ul>

                    <h4 class="text-start mb-4"><strong>Summary</strong></h4>
                    <ul class="rs-summary-show p-0 mb-4">
                        <li><h4><strong>Productive Time:</strong> {{ floor($productiveMinutes / 60) }}h {{ $productiveMinutes % 60 }}m</h4></li>
                        <li><h4><strong>Total Time:</strong> {{ floor($totalMinutes / 60) }}h {{ $totalMinutes % 60 }}m</h4></li>
                    </ul>
                </div>
            </div>
            {{-- attandence calendor --}}
            <div class='col-12'>
                <div id='wrap'>
                <div id='calendar' class="card p-4 bg-white"></div>
                <div style='clear:both'></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script>
    $(document).ready(function () {
        $('#calendar').fullCalendar({
            header: {
                left: 'title',
                center: 'agendaDay,agendaWeek,month',
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

                Promise.all([
                    fetch(`/resource/leave/calendar-data?start=${startDate}&end=${endDate}`)
                        .then(response => response.json()),
                    fetch(`/resource/attendance/calendar?start=${startDate}&end=${endDate}`)
                        .then(response => response.json())
                ])
                .then(([leaveData, attendanceData]) => {
                    callback([...leaveData, ...attendanceData]);
                })
                .catch(error => console.error('Calendar fetch error:', error));
            },
            eventRender: function (event, element) {
                element.attr('title', event.title); // Tooltip for event description
            }
        });
        var project_manager = @json(Auth::guard('resource')->user()->role == 'consultant' ? 1 : 0);
        console.log(project_manager);
        // Block mobile users
            if(project_manager == 1){
                        // Block mobile users
            const userAgent = navigator.userAgent || navigator.vendor || window.opera;
            const isTouch = 'ontouchstart' in window || navigator.maxTouchPoints > 0;
            const isMobileUA = /android|iphone|ipad|ipod/i.test(userAgent);
            const isLikelyMobile = isTouch && (isMobileUA || window.innerWidth <= 1024);

            if (isLikelyMobile) {
                document.querySelectorAll('.moff').forEach(el => {
                    el.style.display = 'none';
                });
            }
        }

        // pr add 25-9-25
        const onBreak = @json($onBreak);
        const breakStartTime = new Date(@json( $attendance->current_break_start ));
        const previousBreakMinutes = @json( $attendance->break_minutes );

        if(onBreak){
            breakTimeCount(breakStartTime, previousBreakMinutes);
            setInterval(function () {
                breakTimeCount(breakStartTime, previousBreakMinutes);
            }, 1000);
        }

        function breakTimeCount(breakStartTime, previousBreakMinutes){
            let currentTime = new Date();

            let diffMs = Math.abs(currentTime - breakStartTime);

            // add previous Break Minutes in current Time
            diffMs += previousBreakMinutes * 1000 * 60;

            let hours = Math.floor(diffMs / (1000 * 60 * 60));
            let minutes = Math.floor((diffMs % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((diffMs % (1000 * 60)) / 1000);

            $('#break-time').text(`${hours}h ${minutes}m`);
        }
        // /pr add 25-9-25
    });
</script>
@endsection
