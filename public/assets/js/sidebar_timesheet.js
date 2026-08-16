// this is for consultant

$(document).ready(function(){

    let tsDataGlobal = []; // Store globally for use in all events

    var arrCurrentDate = []; // take currennt week dates. when page is referesh it is set in current week.

    var arrPastDate = []; // take one past week dates. when page is referesh it is set in one past week.

    var dateHourTotals = {}; // {} make object to count total hour date wise

    var countsDate = {}; // {} make object to count total task date wise

    var statusColorMap = {
        pending: "yellow", // yellow
        approve: "green", // green
        recheck: "orange", // orange
        reject: "red", // red
        none: "gray" // gray
    };

    for (let i = 1; i <= 7; i++) {
        let value = $(`#day-${i}`).text();
        let date = new Date(value);

        // Format the date as YYYY-MM-DD
        let year = date.getFullYear();
        let month = String(date.getMonth() + 1).padStart(2, '0');
        let day = String(date.getDate()).padStart(2, '0');

        let formattedCurrent = `${year}-${month}-${day}`;
        arrCurrentDate.push(formattedCurrent);

        // Get past date (7 days before current)
        let pastDate = new Date(formattedCurrent);
        pastDate.setDate(pastDate.getDate() - 7);

        let pastYear = pastDate.getFullYear();
        let pastMonth = String(pastDate.getMonth() + 1).padStart(2, '0');
        let pastDay = String(pastDate.getDate()).padStart(2, '0');
        let formattedPast = `${pastYear}-${pastMonth}-${pastDay}`;
        arrPastDate.push(formattedPast);
    }

    //used to compare array.
    function arraysEqual(a, b) {
        if (a.length !== b.length) return false;
        for (let i = 0; i < a.length; i++) {
            if (a[i] !== b[i]) return false;
        }
        return true;
    }    

    // calculate total when user input // calulate total when display from the database
    function calculateTotal(taskId) {
        let total = 0;

        // loop throught all input field who's "taskId" is same
        $(`.hour-date[data-task="${taskId}"]`).each(function () {
            let val = $(this).val().trim();

            // validate value of input
            if (val !== '' && val !== 'NA') {
                let num = Number(val); // convert in number
                if (!isNaN(num)) total += num; // validate it is number than add to total
            }
        });
    
        $(`#total-${taskId}`).text(total); // display the value of total
    }

    function calculateTotalDate(date, hour) {

        if(hour == "-NA-"){
            $(`#total-date-${date}`).text(hour);
            $(`#total-task-date-${date}`).text(0);
        } else {

            // Received hour: 7 for date: 2025-04-27
            const numericHour = Number(hour) || 0;

            let total_date = 0;

            // loop throught all input field who's "date" is same
            $(`.hour-date[data-date="${date}"]`).each(function () {
                let val = $(this).val().trim();

                // validate value of input
                if (val !== '' && val !== 'NA') {
                    let num = Number(val); // convert in number
                    if (!isNaN(num)) total_date += num; // validate it is number than add to total
                }
            });

            // $(`#total-date-${date}`).text(total_date); // display the value of total

            // Initializing 2025-04-27 to 0
            if (!dateHourTotals[date]) {
                dateHourTotals[date] = 0;
            }

            // Before adding, dateHourTotals[2025-04-27] = 0 without if condition it is set to undefine and undefine + 2 = NaN
            // After adding, dateHourTotals[2025-04-27] = 7
            dateHourTotals[date] += numericHour;

            // Update the DOM with the total for that date
            $(`#total-date-${date}`).text(dateHourTotals[date] + total_date);

        }

    }

    function timeSheetBreakdown(){
        var weekend_total = 16;
        var workingday_total = 0;

        // $('.weekend').each(function () {
        //     var val = $(this).text();
        //     var num = Number(val);
        //     if(!isNaN(num)) weekend_total += Number(num);
        // });

        $('.workingday').each(function () {
            var val = $(this).text();
            var num = Number(val);
            if(!isNaN(num)) workingday_total += Number(num);
        });

        $('#weekend_total').text(weekend_total); // Weekend Task
        $('#workingday_total').text(workingday_total); // project Task
        $('#total_work').text((weekend_total+workingday_total) + " hrs"); // total work
    }

    // add a rows
    function populateRow(id, project, task, status){
        var weekDates = wd; // window.wd from timesheet.blade - take weekwise date
        var tdInputs = ''; // make weekwise input field
        let color = statusColorMap[status]; // default color

        for (var i = 0; i < 7; i++) {
            tdInputs += `
                    <td>
                        <input type="hidden" name="selected_date[]" class="hidden-date-input" value="${weekDates[i]}">
                        <input type="hidden" name="assigntask_id[]" class="hidden-id-input digvijay" value="${id}">
                        <input type="text" class="form-control form-control-sm hour-date status-${status}" data-task="${id}" data-date="${weekDates[i]}" name="hour[]" maxlength="1" >
                    </td>
                `;
        }

        // <tr id="task-row-${item.id}"> is used to remove row when check box is unchecked.
        $("#timesheet_data").append(`
            <tr id="task-row-${id}">
                <td class="checkBox">
                    <label class="container-checkbox">
                        <input type="checkbox">
                        <span class="checkmark" style="background-color: ${color};"></span>
                    </label>
                </td>
                <td>${project}</td>
                <td>${task}</td>
                <td>weekend</td>
                <td>Stander</td>
                ${tdInputs}
                <td id="total-${id}"></td>
                <td class="text-center">
                    <div class="dropdown dropdown-action">
                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="edit-invoice.html"><i class="far fa-edit me-2"></i>Edit</a>
                            <a class="dropdown-item" href="view-invoice.html"><i class="far fa-eye me-2"></i>View</a>
                            <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-trash-alt me-2"></i>Delete</a>
                        </div>
                    </div>
                </td>
            </tr>
        `);

        // validate input hour
        $('.hour-date').each(function () {

            //default value is 'NA'
            if ($(this).val().trim() === '') {
                $(this).val('NA');
            }

            // Clear value only if it's NA when clicked/focused
            $(this).on('focus', function () {
                if ($(this).val() === 'NA') {
                    $(this).val('');
                }
            });
        });

        // real time trigger on input event
        $(document).on('input', `.hour-date[data-task="${id}"]`, function () {
            let taskId = $(this).data('task');
            calculateTotal(taskId); // calculate total when user input
        });

    } // end function populateRow(id, project, task, status)

    // manage "select all" check box.
    function toggleSelectAll(){
        const total = $('.itemCheckbox').length;
        const checked = $('.itemCheckbox:checked').length;
    
        // If not all are checked, uncheck Select All
        if (checked < total) {
            $('#task-all').prop('checked', false);
        }
    
        // If all are checked, check Select All
        else if (checked === total) {
            $('#task-all').prop('checked', true);
        }
    }

    //append "select all" check box
    $('#time_sheet_task').append(`
        <li>
            <input type="checkbox" name="" id="task-all">
            <label for="task-all">select all</label>
        </li>
    `);

    //"select all" check box is checked
    $(document).on('change', '#task-all', function () {

        //remove all previous row which is come from individual check box.
        $('#timesheet_data').empty();

        //mark checked and trigger document change event.
        $('.itemCheckbox:not(:disabled)').prop('checked', $(this).is(':checked')).trigger('change');
    });

    $(document).on('change', '.itemCheckbox', function () {
        toggleSelectAll();
    });

    //ResourceController -> sidebar_timesheet
    fetch('/resource/sidebar_timesheet')
    .then((response) => {
        return response.json();
    })
    .then((data) => {
        tsDataGlobal = data.tsData; // assign once

        tsDataGlobal.forEach((item2) => {
            countsDate[item2.date] = (countsDate[item2.date] || 0) + 1;
            calculateTotalDate(item2.date, item2.hours);
        });

        data.assigntask.forEach((item) => {

            // //if status is completed than populate row by default.
            // if(item.status === "Completed"){
            //     populateRow(item.id, item.project.project_name, item.task.task_name);
            // }
            
            // item.id is id in assigntask table
            //this is perform in sidebar - individual check box
            if(item.status !== "Completed"){ // if status is "Completed" than not show in sidebar
                
                // $('#time_sheet_task').append(`
                //     <li>
                //         <input type="checkbox" name="" class="itemCheckbox" id="task-${item.id}" data-id="${item.id}">
                //         <label for="task-${item.id}">${item.task.task_name}</label>
                //     </li>
                // `);
                
                // project == hold -> not add timesheet change -pr 29-7-25
                if(item.project.status === "hold"){
                    $('#time_sheet_task').append(`
                        <li>
                            <input type="checkbox" name="" class="itemCheckbox disabled" id="task-${item.id}" data-id="${item.id}" disabled>
                            <label style="background-color: red; color: white;">${item.task.task_name}</label>
                        </li>
                    `);
                } else {
                    $('#time_sheet_task').append(`
                        <li>
                            <input type="checkbox" name="" class="itemCheckbox" id="task-${item.id}" data-id="${item.id}">
                            <label for="task-${item.id}">${item.task.task_name}</label>
                        </li>
                    `);
                }
            }

            //this is perform in table. if document change event is call in "select all" check box than this code is run.
            $(document).on("change", "#task-"+item.id, function () {
                
                // if check box is checked.
                if ($(this).is(':checked')) {

                    populateRow(item.id, item.project.project_name, item.task.task_name, "none");

                    // // real time trigger on input event
                    // $(document).on('input', `.hour-date[data-task="${item.id}"]`, function () {
                    //     let taskId = $(this).data('task');
                    //     calculateTotal(taskId); // calculate total when user input
                    // });
                    
                    // use tsDataGlobal below
                    tsDataGlobal.forEach((item2) => {

                        // display the hour data from the timesheet table from the data base.
                        $(`.hour-date[data-task="${item2.assigntask_id}"][data-date="${item2.date}"]`).val(item2.hours);

                        // calulate total when display from the database
                        calculateTotal(item2.assigntask_id);
                    });

                } else {
                    // remove row when check box is unchecked.
                    $("#task-row-"+item.id).remove();
                } // end if ($(this).is(':checked'))

            }); // end $(document).on("change", "#task-"+item.id, function ()

        }); // end data.assigntask.forEach((item)

    }) // end fetch('/resource/sidebar_timesheet')
    .catch(error => console.error('Fetch error:', error));

    // this is validation user can not type or copy pest any alpabet or special character.
    $(document).on('input', '.hour-date', function () {
        
        //if input not between 1 to 8 globaly on any string it is replace with null.
        $(this).val($(this).val().replace(/[^1-8]/g, ''));
    });

    // ONE handler - runs once per click
    $(document).on('click change', '#rs-next-date-timesheet, #rs-prev-date-timesheet, #rs-mydate-timesheet', function () {

        $('#timesheet_data').empty(); // first empty all data.
        dateHourTotals = {}; // clear the past total hours value for date

        var arrDate = []; // store week dates.
        const usedTaskIds = new Set(); // task id is must be unique

        //store week dates.
        for (let i = 1; i <= 7; i++) {
            let value = $(`#day-${i}`).text();
            let date = new Date(value);

            // Format the date as YYYY-MM-DD
            let year = date.getFullYear();
            let month = String(date.getMonth() + 1).padStart(2, '0'); // + 1 set month date from 1 to 12 insted of 0 to 11. padStart is conver 1, 2, 3... into 01, 02, 03...
            let day = String(date.getDate()).padStart(2, '0');

            let formatted = `${year}-${month}-${day}`;
            arrDate.push(formatted);
            calculateTotalDate(formatted, "-NA-");
        }

        var arrEqual = arraysEqual(arrDate, arrCurrentDate); // check both array is equal or not. // check this week is current week
        var arrEqual_past = arraysEqual(arrDate, arrPastDate); // check both array is equal or not. // check this week is one week past then current week

        tsDataGlobal.forEach(item => {

            if (arrDate.includes(item.date)) { // if item.date is include in arrDate
                
                calculateTotalDate(item.date, item.hours);

                $.each(countsDate, function (key, value) {
                    // Update the DOM with the total for that date
                    $(`#total-task-date-${key}`).text(value);
                });
                
                if(!usedTaskIds.has(item.assigntask_id)){ // if task id unique in each row then show the data.
                    
                    populateRow(item.assigntask_id, item.assigntask.project.project_name, item.assigntask.task.task_name, item.status);
                    $(`#task-${item.assigntask_id}`).prop('checked', true).prop('disabled', true); // checked the check box.
                    usedTaskIds.add(item.assigntask_id); // mark as used
                }
            }
        });

        // arrEqual - true meance this week is current week. arrEqual_past - true meance this week is past week from cuurent week.
        if(arrEqual || arrEqual_past){
            // $('.itemCheckbox, #task-all').prop('disabled', false); // if both array is same then enable check box
            
            // First, enable the Select All checkbox unconditionally
            $('#task-all').prop('disabled', false);
            
            // Then process each individual checkbox
            let hasAvailableCheckboxes = false;
            
            $(".itemCheckbox").each(function (){
                const checkboxId = $(this).data('id');
                /* let bgColor = let bgColor = $('.checkmark').first().css('background-color'); */

                if(usedTaskIds.has(checkboxId)){
                    $(`#task-${checkboxId}`).prop('checked', true).prop('disabled', true);
                } else {

                    // the below commented code is use to if task is aproved then not allow to add more task from side bar check box.
                    // and i cosider that is approve then all task is aprrove of week from admin.

                    /* // Check for different representations of "green"
                    if (bgColor.toLowerCase() === 'green') {
                        $(`#task-${checkboxId}`).prop('checked', true).prop('disabled', true);
                    } else {
                        $(`#task-${checkboxId}`).prop('checked', false).prop('disabled', false);
                    }
                    hasAvailableCheckboxes = true; */

                    // new -pr 29-7-25
                    if ($(`#task-${checkboxId}`).hasClass('disabled')) {
                        $(`#task-${checkboxId}`).prop('checked', false).prop('disabled', true);
                    } else {
                        $(`#task-${checkboxId}`).prop('checked', false).prop('disabled', false);
                    }
                    hasAvailableCheckboxes = true;
                }
            });

            // If there are no available checkboxes, disable the Select All checkbox
            if (!hasAvailableCheckboxes && $('.itemCheckbox').length > 0) {
                $('#task-all').prop('disabled', true);
            }

        } else {
            $('.itemCheckbox, #task-all').prop('checked', false).prop('disabled', true); // otherwise disable and unchecked.
            $(".itemCheckbox").each(function (){
                const checkboxId = $(this).data('id');
                if(usedTaskIds.has(checkboxId)){
                    $(`#task-${checkboxId}`).prop('checked', true);
                }
            });
        }

        $('.hour-date').each(function () {
            const task = $(this).attr("data-task");
            const date = $(this).attr("data-date");
            const match = tsDataGlobal.find(x => x.assigntask_id == task && x.date == date);
            $(this).val(match ? match.hours : 'NA'); // if not match with data then value is "NA"
            // if(arrEqual){
            //     $(this).prop('readonly', false); // if both array is same then allow to edit.
            // }else{
                $(this).prop('readonly', true); // otherwise not allow to edit.
                $('.status-recheck').prop('readonly', false);
            // }
            calculateTotal(task);
        });

        timeSheetBreakdown();

        toggleSelectAll();

    }); // end $(document).on('click change', '#rs-next-date-timesheet, #rs-prev-date-timesheet, #rs-mydate-timesheet', function ()

    // // ONE handler - runs once per change
    // $(document).on('change', '#rs-mydate-timesheet', function () {
    //     $('.hour-date').each(function () {
    //         const task = $(this).attr("data-task");
    //         const date = $(this).attr("data-date");
    //         const match = tsDataGlobal.find(x => x.assigntask_id == task && x.date == date);
    //         $(this).val(match ? match.hour : 'NA');
    //         calculateTotal(task);
    //     });
    // });

    // Before form submission
    $('#ts-form').on('submit', function (e) {
        let isValid = true; // validate input
        let isBlank = false; // if submit without input

        // check enter any input or not
        $('.hour-date').each(function () {
            let val = $(this).val().trim();

            if (val !== '' && val !== 'NA') {
                isBlank = true;
                return false; // This breaks out of .each()
            }
        });

        // if enter one or more input field
        if(isBlank === true){

            // check input value must be an integer and between 1 to 8.
            $('.hour-date').each(function () {
                let val = $(this).val().trim();

                // Skip "NA" or empty, they will be handled separately
                if (val === '' || val === 'NA') {
                    return;
                }

                let num = Number(val);
                if (!Number.isInteger(num) || num < 1 || num > 8) {
                    $(this).focus();
                    isValid = false;
                    return false; // break the .each loop
                }

                // store value with number type.
                $(this).val(num);
            });
        }

        // if any one is false
        if(isValid === false || isBlank === false){

            // then blank field is filled with "NA"
            $('.hour-date').each(function () {

                if ($(this).val().trim() === '') {
                    $(this).val('NA');
                }
            });
            alert("Please enter a whole number between 1 and 8. And enter at least one input.");
            e.preventDefault(); // stop form submission
        }

        // if both is true
        if (isBlank === true && isValid === true) {

            // then "NA" field is filled with blank
            $('.hour-date').each(function () {
                if ($(this).val().trim() === 'NA') {
                    $(this).val('');
                }
            });
        }

    });// end  $('#ts-form').on('submit', function (e) {

    // first call this to run $(document).on('click change', '#rs-next-date-timesheet, #rs-prev-date-timesheet, #rs-mydate-timesheet', function ()
    // Wait a tiny bit to ensure all #day-N elements are filled (if they’re rendered late)
    setTimeout(function () {
        $('#rs-mydate-timesheet').trigger('change');
    }, 550);

});// end $(document).ready(function(){