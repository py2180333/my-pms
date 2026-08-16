@extends('resource.master')
@include('resource.sidebar')
@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" rel="stylesheet" />
@endsection
@section('content')
        <div class="page-wrapper">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="content container-fluid">
               <div class="card-body crms-title row bg-white mb-4" style="border-radius: 1.25rem !important;">
                 <form  action="{{ route('resource.attendance.leave.store') }}" id="leave-form" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="hidden" name="resource_id" value="{{Auth::user()->id}}">
                        <label for="reason_for_leave" class="form-label">Reason For Leave</label>
                        <textarea name="reason_for_leave" id="reason_for_leave" class="form-control" required></textarea>
                    </div>
                    <div id="leave-details-wrapper">
                        <h4>Leave Ranges</h4>
                        <div class="leave-detail p-3 mb-4">
                            <div class="row">
                                <!-- 1 duration by pr 29-9-25 -->
                                <div class="col-md-3">
                                    <label>Duration</label>
                                    <select name="leave_details[0][leave_duration]" class="form-control" required>
                                        <option value="fullday">Full Day</option>
                                        <option value="halfday">Half Day</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Leave Type</label>
                                    <select name="leave_details[0][leave_type]" class="form-control" required>
                                        <option value="unpaid">Unpaid</option>
                                        <option value="paid">Paid</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Start Date</label>
                                    <input type="date" name="leave_details[0][start_date]" class="form-control" min="{{ $min }}" max="{{ $max }}" required><!-- min add pr 1-10-25 -->
                                </div>
                                <div class="col-md-3">
                                    <label>End Date</label>
                                    <input type="date" name="leave_details[0][end_date]" class="form-control" min="{{ $min }}" max="{{ $max }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary rs-clear-btn mb-4" onclick="addLeaveRow()">+ Add Another Range</button>
                    <button type="submit" class="btn btn-primary rs-clear-btn mb-4">Submit Leave Request</button>
                </form>
               </div>
                <div class="crms-title card-body row bg-white" style="border-radius: 1.25rem !important;">
                     <!-- <h1>calendar</h1> -->
            <div id="calendar-leave" class="pt-4 pb-4"></div>
                </div>
            </div>
           
        </div>
@endsection
@section('script')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const form = document.getElementById('leave-form');

            if (!form) {
                console.error("Form with ID 'leave-form' not found.");
                return;
            }

            // comment
                // form.addEventListener('submit', function (e) {
                //     e.preventDefault();

                //     const leaveDetails = [...document.querySelectorAll('.leave-detail')];

                //     let requestedPaidLeaves = 0;
                //     let latestRequestedDate = null;

                //     leaveDetails.forEach(row => {
                //         const type = row.querySelector('select[name$="[leave_type]"]').value;
                //         const duration = row.querySelector('select[name$="[leave_duration]"]').value;

                //         if (type === 'paid') {
                //             const start = new Date(row.querySelector('input[name$="[start_date]"]').value);
                //             const end = new Date(row.querySelector('input[name$="[end_date]"]').value);
                //             const days = Math.floor((end - start) / (1000 * 60 * 60 * 24)) + 1;
                //             const total = duration === 'halfday' ? 0.5 * days : days;
                //             requestedPaidLeaves += total;

                //             // Track latest end date
                //             if (!latestRequestedDate || end > latestRequestedDate) {
                //                 latestRequestedDate = end;
                //             }
                //         }
                //     });

                //     if (!latestRequestedDate) {
                //         alert("No paid leave selected.");
                //         return;
                //     }

                //     // Format latest date as Y-m-d
                //     const latestDateString = latestRequestedDate.toISOString().split('T')[0];

                //     $.ajax({
                //         url: "{{ route('resource.attendance.leave.checkPaidLeave') }}",
                //         method: 'GET',
                //         data: { latest_requested_date: latestDateString },
                //         success: function (res) {
                //             if (requestedPaidLeaves > res.remaining_paid_leaves) {
                //                 alert(`You are requesting ${requestedPaidLeaves} paid leave(s), but only ${res.remaining_paid_leaves} are available (earned from Jan to ${latestDateString.slice(0, 7)}).`);
                //             } else {
                //                 form.submit();
                //             }
                //         },
                //         error: function () {
                //             alert("Error validating paid leave. Please try again.");
                //         }
                //     });
                // });
            // /comment

            // comment 2
                // form.addEventListener('submit', function (e) {
                //     e.preventDefault();
                //     const btn = form.querySelector('button[type="submit"]'); // pr add 6-10-25
                //     btn.disabled = true; // pr add 6-10-25

                //     const leaveDetails = [...document.querySelectorAll('.leave-detail')];

                //     let requestedPaidLeaves = 0;
                //     let requestedFuturePaidLeaves = 0; // pr add 6-10-25
                //     let latestRequestedDate = null;
                //     let futureRequestedDate = null; // pr add 3-10-25

                //     const rows = []; // pr add 7-10-25
                //     leaveDetails.forEach(row => {
                //         const type = row.querySelector('select[name$="[leave_type]"]').value;
                //         const duration = row.querySelector('select[name$="[leave_duration]"]').value;

                //         const startInput = row.querySelector('input[name$="[start_date]"]');
                //         const endInput = row.querySelector('input[name$="[end_date]"]');
                //         if (!startInput || !endInput) return;

                //         const start = new Date(startInput.value);
                //         const end = new Date(endInput.value);

                //         if (type === 'paid') {
                //             rows.push({'start':startInput.value, 'end':endInput.value, 'duration':duration}); // pr add 7-10-25

                //             const days = Math.floor((end - start) / (1000 * 60 * 60 * 24)) + 1;
                //             const total = duration === 'halfday' ? 0.5 * days : days;
                //             // requestedPaidLeaves += total; // rd

                //             // rd
                //             // // Set latest requested date if paid leave
                //             // if (!latestRequestedDate || end > latestRequestedDate) {
                //             //     latestRequestedDate = end;
                //             // }
                //             // /rd

                //             // pr add 3-10-25
                //             const current = new Date();
                //             if (end.getFullYear() === current.getFullYear()){
                //                 // rd
                //                 requestedPaidLeaves += total;

                //                 // Set latest requested date if paid leave
                //                 if (!latestRequestedDate || end > latestRequestedDate) {
                //                     latestRequestedDate = end;
                //                 }
                //                 // /rd
                //             } else if(end.getFullYear() > current.getFullYear()){
                //                 // different year
                //                 requestedFuturePaidLeaves += total;
                                
                //                 // Set latest requested date if paid leave
                //                 if (!futureRequestedDate || end > futureRequestedDate) {
                //                     futureRequestedDate = end;
                //                 }
                //             } 
                //             // /pr add 3-10-25
                //         }
                //     });

                //     // ✅ If no paid leave rows, just submit without AJAX check
                //     // if (rows.length === 0) { // pr add rows.length 9-10-25
                //     if (requestedPaidLeaves === 0 && requestedFuturePaidLeaves === 0) {
                //         console.log("No paid leave in this request, submitting directly.");
                //         form.submit();
                //         return;
                //     }

                //     // Format latest date
                //     const latestDateString = latestRequestedDate?.toISOString().split('T')[0] ?? null; // pr add ?. and ?? 6-10-25
                //     // Format future date
                //     const futureDateString = futureRequestedDate?.toISOString().split('T')[0] ?? null; // pr add 3-10-25
                //     // Send to controller for balance check
                //     $.ajax({
                //         url: "{{ route('resource.attendance.leave.checkPaidLeave') }}",
                //         method: 'GET',
                //         data: { 
                //             latest_requested_date: latestDateString, // rd
                //             future_requested_date: futureDateString, // pr add 3-10-25
                //             // days_in_month: daysInMonth, // pr add 7-10-25
                //             // rows: rows // pr add rows 7-10-25
                //         },
                //         success: function (res) {
                //             // // pr add for rows 9-10-25
                //             // if(res.status){
                //             //     form.submit();
                //             // } else {
                //             //     alert(res.message);
                //             // }
                //             // // /pr add for rows 9-10-25
                            
                //             // rd
                //             if (requestedPaidLeaves > res.remaining_paid_leaves) {
                //                 alert(`You are requesting ${requestedPaidLeaves} paid leave(s), but only ${res.remaining_paid_leaves} are available.`);
                //             } else if (requestedFuturePaidLeaves > res.remaining_future_paid_leaves) { // pr add 6-10-25
                //                 alert(`You are requesting ${requestedFuturePaidLeaves} paid leave(s), but only ${res.remaining_future_paid_leaves} are available in this year.`);
                //             } else {
                //                 form.submit();
                //             }
                //             // /rd

                //             btn.disabled = false; // pr add 6-10-25
                //         },
                //         error: function () {
                //             alert("Error validating paid leave. Please try again.");
                //         }
                //     });
                // });
            // /comment 2

            form.addEventListener('submit', function (e) {
                e.preventDefault();
                const btn = form.querySelector('button[type="submit"]'); // pr add 6-10-25
                btn.disabled = true; // pr add 6-10-25

                const leaveDetails = [...document.querySelectorAll('.leave-detail')];

                const rows = []; // pr add 7-10-25
                leaveDetails.forEach(row => {
                    const type = row.querySelector('select[name$="[leave_type]"]').value;
                    const duration = row.querySelector('select[name$="[leave_duration]"]').value;

                    const startInput = row.querySelector('input[name$="[start_date]"]');
                    const endInput = row.querySelector('input[name$="[end_date]"]');
                    if (!startInput || !endInput) return;

                    if (type === 'paid') {
                        rows.push({'start':startInput.value, 'end':endInput.value, 'duration':duration}); // pr add 7-10-25
                    }
                });

                // ✅ If no paid leave rows, just submit without AJAX check
                if (rows.length === 0) { // pr add rows.length 9-10-25
                    console.log("No paid leave in this request, submitting directly.");
                    form.submit();
                    return;
                }

                // Send to controller for balance check
                $.ajax({
                    url: "{{ route('resource.attendance.leave.checkPaidLeave') }}",
                    method: 'GET',
                    data: { 
                        rows: rows // pr add rows 7-10-25
                    },
                    success: function (res) {
                        // pr add and change for rows 9-10-25
                        if(res.status){
                            form.submit();
                        } else {
                            alert(res.message);
                        }
                        // /pr add and change for rows 9-10-25
                        
                        btn.disabled = false; // pr add 6-10-25
                    },
                    error: function () {
                        alert("Error validating paid leave. Please try again.");
                    }
                });
            });
        });
    </script>
    <script>
        let leaveIndex = 1;
        const max = @json($max); // pr add 3-10-25
        function addLeaveRow() {
            const prevRowStartDate = document.querySelector(`input[name="leave_details[${leaveIndex-1}][start_date]"]`); // pr add 26-9-25
            const prevRowEndDate = document.querySelector(`input[name="leave_details[${leaveIndex-1}][end_date]"]`);
            
            // pr add 26-9-25
            if (!prevRowStartDate || !prevRowStartDate.value) {
                alert('Please select the start date for the previous row before adding a new one.');
                return;
            }
            // /pr add 26-9-25
            
            if (!prevRowEndDate || !prevRowEndDate.value) {
                alert('Please select the end date for the previous row before adding a new one.');
                return;
            }

            let nextStartDate = new Date(prevRowEndDate.value);
            nextStartDate.setDate(nextStartDate.getDate() + 1);
            let formattedNextStartDate = nextStartDate.toISOString().split('T')[0];

            const wrapper = document.getElementById('leave-details-wrapper');
            if (!wrapper) {
                console.error("Element #leave-details-wrapper not found!");
                return;
            }

            // pr add 30-9-25
            let dataCheck = 0;
            // current row is 2 or 3, 4...
            if((leaveIndex) > 1){
                const prevRowDuration = document.querySelector(`select[name="leave_details[${leaveIndex-1}][leave_duration]"]`);
                if(prevRowDuration.value === 'halfday'){
                    // end date of prev row of prev row.
                    const prev2RowEndDate = document.querySelector(`input[name="leave_details[${leaveIndex-2}][end_date]"]`);
                    // if end dates of prev row and prev row of prev row are same.
                    if(prevRowEndDate.value === prev2RowEndDate.value){
                        // then data-check of current row is 1 otherwise 0.
                        dataCheck = 1;
                    }
                }
            }
            // /pr add 30-9-25

            const html = `
            <div class="leave-detail border p-3 mb-2" id="leave-row-${leaveIndex}">
                <div class="row">
                    <div class="col-md-3">
                        <label>Duration</label>
                        <select name="leave_details[${leaveIndex}][leave_duration]" class="form-control" data-check="${dataCheck}" required>
                            <option value="fullday">Full Day</option>
                            <option value="halfday">Half Day</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Leave Type</label>
                        <select name="leave_details[${leaveIndex}][leave_type]" class="form-control" required>
                            <option value="unpaid">Unpaid</option>
                            <option value="paid">Paid</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Start Date</label>
                        <input type="date" name="leave_details[${leaveIndex}][start_date]" class="form-control" min="${formattedNextStartDate}" max="${max}" required>
                    </div>
                    <div class="col-md-3">
                        <label>End Date</label>
                        <input type="date" name="leave_details[${leaveIndex}][end_date]" class="form-control" max="${max}" required>
                    </div>
                    <div class="col-md-12 text-right">
                        <button type="button" class="btn btn-danger" data-remove-btn="${leaveIndex}" onclick="removeLeaveRow(${leaveIndex})">Remove</button>
                    </div>
                </div>
            </div>`;
            wrapper.insertAdjacentHTML('beforeend', html);

            // disabled previous date pr add 26-9-25
            document.querySelectorAll(`select[name^="leave_details[${leaveIndex-1}]"]`)
                .forEach((element) => {
                    element.addEventListener('mousedown', blockSelectEvent);
                    element.addEventListener('keydown', blockSelectEvent);
                });
            document.querySelectorAll(`input[type="date"][name^="leave_details[${leaveIndex-1}]"]`)
                .forEach(element => element.readOnly = true);
            document.querySelector(`button[type="button"][data-remove-btn="${leaveIndex-1}"]`)
                ?.setAttribute('disabled', true);
            // /disabled previous date pr add 26-9-25

            leaveIndex++;
        }

        document.addEventListener("DOMContentLoaded", function () {
            leaveIndex = document.querySelectorAll('.leave-detail').length; 
        });
        function removeLeaveRow(index) {
            const rowToRemove = document.getElementById(`leave-row-${index}`);
            if (rowToRemove) {
                rowToRemove.remove();
            }

            // Get all remaining rows
            const remainingRows = document.querySelectorAll('.leave-detail');

            remainingRows.forEach((row, i) => {
                if (row) { 
                    row.id = `leave-row-${i}`;

                    let startDate = row.querySelector('input[name^="leave_details"][name$="[start_date]"]');
                    let endDate = row.querySelector('input[name^="leave_details"][name$="[end_date]"]');
                    let leaveType = row.querySelector('select[name^="leave_details"][name$="[leave_type]"]'); // pr add 26-9-25
                    let leaveDuration = row.querySelector('select[name^="leave_details"][name$="[leave_duration]"]'); // pr add 26-9-25
                    let removeButton = row.querySelector('button.btn-danger');

                    if (startDate) startDate.name = `leave_details[${i}][start_date]`;
                    if (endDate) endDate.name = `leave_details[${i}][end_date]`;
                    if (leaveType) leaveType.name = `leave_details[${i}][leave_type]`; // pr add 26-9-25
                    if (leaveDuration) leaveDuration.name = `leave_details[${i}][leave_duration]`; // pr add 26-9-25
                    if (removeButton) removeButton.setAttribute("onclick", `removeLeaveRow(${i})`);

                    // Update start date of the next row to match previous end date
                    if (i > 0) {
                        let prevEndDate = remainingRows[i - 1].querySelector('input[name^="leave_details"][name$="[end_date]"]').value;
                        if (prevEndDate) {
                            let newStartDate = new Date(prevEndDate);
                            newStartDate.setDate(newStartDate.getDate() + 1);
                            startDate.min = newStartDate.toISOString().split('T')[0];
                        }
                    }
                }
            });

            leaveIndex = remainingRows.length;
            
            durationMng();
            
            // enabled last disabled date pr add 26-9-25
            document.querySelectorAll(`select[name^="leave_details[${leaveIndex-1}]"]`)
                .forEach((element) => {
                    element.removeEventListener('mousedown', blockSelectEvent);
                    element.removeEventListener('keydown', blockSelectEvent);
                });
            document.querySelectorAll(`input[type="date"][name^="leave_details[${leaveIndex-1}]"]`)
                .forEach(element => element.readOnly = false);
            document.querySelector(`button[type="button"][data-remove-btn="${leaveIndex-1}"]`)
                ?.removeAttribute('disabled');
            // /enabled last disabled date pr add 26-9-25
        }

        function validateEndDate(input) {
            const startDate = input.closest('.row').querySelector('input[name^="leave_details"][name$="[start_date]"]').value;
            if (startDate && input.value < startDate) {
                alert('End date cannot be before start date.');
                input.value = startDate;
            }
        }

        // pr add 30-9-25
        function durationMng(){
            let prevRowDuration = document.querySelector(`select[name="leave_details[${leaveIndex - 2}][leave_duration]"]`);
            let prevRowEndDate = document.querySelector(`input[name="leave_details[${leaveIndex - 2}][end_date]"]`);

            let crntRowDuration = document.querySelector(`select[name="leave_details[${leaveIndex - 1}][leave_duration]"]`);
            let crntRowStartDate = document.querySelector(`input[name="leave_details[${leaveIndex - 1}][start_date]"]`);

            let prd = prevRowDuration?.value ?? null;
            let crd = crntRowDuration?.value ?? null;

            // if end dates of prev row and prev row of prev row are same.
            // then data-check of current row is 1 otherwise 0.
            let check = crntRowDuration.dataset.check;
            
            // prev row is half day
            if(prd === 'halfday'){
                // crnt row is full day 
                // or end dates of prev row and prev row of prev row are same.
                if(crd === 'fullday'){
                    let newDate = new Date(prevRowEndDate.value);
                    newDate.setDate(newDate.getDate() + 1);
                    crntRowStartDate.min = newDate.toISOString().split('T')[0];
                }
                // note = if i remove this "|| check === '1'" from the else is then 
                // it is take default full day behaviour which is also work well.

                // crnt row is half day 
                // and end dates of prev row and prev row of prev row are not same.
                else if(crd === 'halfday' && check === '0'){
                    crntRowStartDate.min = prevRowEndDate.value;
                }                 
            }
        }
        // /pr add 30-9-25

        document.addEventListener('change', function (event) {
            if (event.target.matches('input[name^="leave_details"][name$="[end_date]"]')) {
                validateEndDate(event.target);
            }

            // pr add 29-9-25
            if(event.target.matches('select[name^="leave_details"][name$="[leave_duration]"]')) { // select select tag
                // clear the date value
                event.target.closest('.row').querySelectorAll('input[type="date"][name^="leave_details"]')
                    .forEach(element => element.value = '');
                if(event.target.name !== 'leave_details[0][leave_duration]'){ // not select 1 row
                    durationMng();
                }
            }
            // /pr add 29-9-25
        });

        // pr add 6-10-25
        function blockSelectEvent(event){
            event.preventDefault();
        }
        // /pr add 6-10-25
        
    </script>
    <script>
            $(document).ready(function () {
            $('#calendar-leave').fullCalendar({
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

                    fetch(`{{ route('resource.attendance.leave.calendarData') }}?start=${startDate}&end=${endDate}`)
                        .then(response => response.json())
                        .then(data => {
                            // Optional: log or clean data if needed
                            callback(data);
                        })
                        .catch(error => console.error('Calendar fetch error:', error));
                },
                eventRender: function (event, element) {
                    // Tooltip with full description
                    element.attr('title', event.title);
                }
            });
        });

        // Disable mobile users
        document.addEventListener("DOMContentLoaded", function () {
            const userAgent = navigator.userAgent || navigator.vendor || window.opera;
            const isTouch = 'ontouchstart' in window || navigator.maxTouchPoints > 0;
            const isMobileUA = /android|iphone|ipad|ipod/i.test(userAgent);
            const isLikelyMobile = isTouch && (isMobileUA || window.innerWidth <= 1024);

            if (isLikelyMobile) {
                document.querySelectorAll('.moff').forEach(el => {
                    el.style.display = 'none';
                });
            }
        });
    </script>
@endsection