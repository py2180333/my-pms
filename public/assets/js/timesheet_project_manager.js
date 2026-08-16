// this is for project manager

var currentDate = ''; // used as start date in startDate() function

var cId = 0; // consultant id

var statusColorMap = {
        pending: "yellow", // yellow
        approve: "green", // green
        recheck: "orange", // orange
        reject: "red", // red
        none: "gray" // gray
    };

var statusInputMap = {
        pending: "readonly", // readonly
        approve: "readonly", // readonly
        recheck: "", // blank
        reject: "readonly", // readonly
        none: "" // blank
    };

$(document).ready(function(){

    $('#consultant_id').val($('#selected_consultant').val());
    consultantId();
    sidebarData();
    startDate();
    fetchAndRenderTimesheet();

    $('#selected_consultant').on('change', function () {
        $('#consultant_id').val($(this).val());
        consultantId();
        sidebarData();
        fetchAndRenderTimesheet();
    });

    $(document).on('click change', '#rs-next-date-timesheet, #rs-prev-date-timesheet, #rs-mydate-timesheet', function () {
        startDate();
        fetchAndRenderTimesheet();
    });

    $(document).on('change', '.itemCheckbox', function () {

        const checkbox = $(this);
        const at_id = checkbox.val();

        if ($(this).is(':checked')) {

            checkbox.prop('disabled', true); // disable untill fetch new -pr 29-7-25

            // TimesheetController -> taskRow
            fetch(`/resource/timesheet/task/row/${at_id}/${currentDate}/${6}`)
            .then((response) => {
                return response.json();
            })
            .then((data) => {

                if (!checkbox.is(':checked')) {
                    return;
                }

                let tdInputs = ''; // make weekwise input field
                data.tasks.forEach((item) => {
                    
                    // Skip if this task row already exists to prevent duplicates new -pr 29-7-25
                    if ($(`#task-row-${item.id}`).length > 0) {
                        return; // Prevent duplicate appending
                    }

                    item.dates.forEach((item) => {
                        /* show pending because this function is call when user what add data so when user is store or update the data then default status is pending */
                        tdInputs += populateInputField(item.date, item.id, "none", "NA");
                    });
                    populateRow(item.id, item.project_name, item.task_name, "none", tdInputs, 0);
                });

                // updateStatusAndSubmitVisibility();

            }) // end fetch(`/resource/timesheet/sidebar/task/row/${at_id}/${currentDate}/${6}`)
            .catch(error => console.error('Fetch error:', error))
            .finally(() => checkbox.prop('disabled', false)); // enable after fetch new -pr 29-7-25

        } else {
            $(`#task-row-${at_id}`).remove();
            // updateStatusAndSubmitVisibility();
        }

        $('#selected_status').show();
        $('.task-row').each(function () {
            if ($(this).data('status') === 'none') {
                $('#selected_status').hide();
                return;
            }
        });

        if($('.itemCheckbox:checked').length > 0){
            $('#submit').show();
            $('#no-data-row').hide(); // new
            $('#selected_status').show(); // new
        } else {
            $('#selected_status, #submit').hide();
            $('#no-data-row').show(); // new
        }

    }); // end $(document).on('change', '.itemCheckbox', function ()

    // Before form submission
    $('#ts-form').on('submit', function (e) {
        
        // then "NA" field is filled with blank
        $('.hour-date').each(function () {
            if ($(this).val().trim() === 'NA') {
                $(this).val('');
            }
        });

    });

}); // end $(document).ready(function() 

function sidebarData(){

    $('#time_sheet_task').empty();

    // TimesheetController -> getSidebarTask
    fetch(`/resource/timesheet/sidebar/${cId}`)
    .then((response) => {
        return response.json();
    })
    .then((data) => {

        data.sidebartasks.forEach((item) => { 
            
            // sidetask is not show the task which is completed

            // project == hold -> not add timesheet change -pr 29-7-25
            if(item.project.status === "hold"){
                $('#time_sheet_task').append(`
                    <li class="sidebardata">
                        <input type="checkbox" name="" class="itemCheckbox disabled" id="assigntasks-id-${item.id}" value="${item.id}" disabled>
                        <label style="background-color: red; color: white;">${item.task.task_name}</label>
                    </li>
                `);
            } else {
                $('#time_sheet_task').append(`
                    <li class="sidebardata">
                        <input type="checkbox" name="" class="itemCheckbox" id="assigntasks-id-${item.id}" value="${item.id}">
                        <label for="assigntasks-id-${item.id}">${item.task.task_name}</label>
                    </li>
                `);
            }
        });

    }) // end fetch(`/resource/timesheet/sidebar/${id}`)
    .catch(error => console.error('Fetch error:', error));
}

function startDate(){
    let value = $('#start-date').text();
    let date = new Date(value);

    // Format the date as YYYY-MM-DD
    let year = date.getFullYear();
    let month = String(date.getMonth() + 1).padStart(2, '0');
    let day = String(date.getDate()).padStart(2, '0');

    currentDate = `${year}-${month}-${day}`;
}

function consultantId(){
    cId = $('#selected_consultant').val();
}

function populateInputField(date, id, status, value){

    let inpAttr = statusInputMap[status]; // default input attribute

    let data = `
        <td>
            <input type="hidden" name="selected_date[]" class="hidden-date-input" value="${date}">
            <input type="hidden" name="assigntask_id[]" class="hidden-id-input digvijay" value="${id}">
            <input type="text" class="form-control form-control-sm hour-date status-${status}" data-task="${id}" data-date="${date}" name="hour[]" maxlength="1" value="${value}" ${inpAttr}>
        </td>
    `;

    return data;

}

function populateRow(id, projectName, taskName, status, inputField, weekTotal){

    let color = statusColorMap[status]; // default color

    $("#timesheet_data").append(`
        <tr class="task-row" id="task-row-${id}" data-status="${status}">
            <td class="checkBox">
                <label class="container-checkbox">
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
            </td>
            <td>${projectName}</td>
            <td>${taskName}</td>
            <td>weekend</td>
            <td>Stander</td>
            ${inputField}
            <td>${weekTotal}</td>
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

    // this is validation user can not type or copy pest any alpabet or special character.
    $(document).on('input', '.hour-date', function () {
        
        //if input not between 1 to 8 globaly on any string it is replace with null.
        $(this).val($(this).val().replace(/[^1-8]/g, ''));
    });

}

function handleDateStatus(status) {
    const isDisabled = (status === 'past' || status === 'future');
    $('.itemCheckbox').prop('checked', false).prop('disabled', isDisabled);
    // new -pr 29-7-25
    if ($('.itemCheckbox').hasClass('disabled')) {
        $('.disabled').prop('disabled', true);
    }

    $('#selected_status, #submit').toggle(!isDisabled);
    $('#selected_status').prop('disabled', isDisabled);
}

function resetTimesheetDOM() {
    $('.task-row').remove();
    $('.common-day h5').text("-NA-");
    $('.common-day .rs-timesheet-task span').text(0);
    $('#ts-breakdown').text("16 hrs");
    $('#project-task').text(0);
    $('#weekend-task').text(16);
    $('#no-data').empty();
}

function showNoDataAlert() {
    $('#timesheet_data').html(`
        <tr id="no-data-row">
            <td colspan="14" style="text-align: center; padding: 20px;">
                Timesheet data is not available.
            </td>
        </tr>
    `);
}

function fetchAndRenderTimesheet() {
    // TimesheetController -> getTimesheetData
    fetch(`/resource/timesheet/${cId}/${currentDate}/${6}`)
    .then((response) => {
        return response.json();
    })
    .then((data) => {

        if(data.info === 'assigntasks_empty'){
            $('.task-row').remove();
            $('.itemCheckbox').remove();
            $('.common-day h5').text("-NA-");
            $('.common-day .rs-timesheet-task span').text(0);
            $('#ts-breakdown').text(16 + " hrs");
            $('#project-task').text(0);
            $('#weekend-task').text(16);
            $('#selected_status').remove();
            $('#submit').remove();
            $('#timesheet_data').html(`
                <tr id="no-at-data-row">
                    <td colspan="14" style="text-align: center; padding: 20px;">
                        Assigntesk data is not available.
                    </td>
                </tr>
            `);

        } else {

            // Handle checkbox and submit button visibility
            handleDateStatus(data.dateStatus);

            // Reset DOM elements
            resetTimesheetDOM();

            $('#no-at-data-row').remove();

            if(data.info === 'timesheet_empty'){

                // Show alert
                showNoDataAlert();

                $('#selected_status, #submit').hide();

            } else {

                // Only show alert for future timesheet
                if (data.dateStatus === 'future') {
                    showNoDataAlert();
                }

                $('#no-data-row').remove();

                // Populate date-wise task headers
                data.dateWiseData.forEach((item)=> {
                    $(`#date-wise-total-${item.date} h5`).text(item.hours);
                    $(`#date-wise-total-${item.date} .rs-timesheet-task span`).text(item.count);
                });
    
                // let tdInputs = ''; // make weekwise input field
                data.result.forEach((item) => {
                    
                    let tdInputs = ''; // make weekwise input field

                    item.entries.forEach((item) => {
                        tdInputs += populateInputField(item.date, item.atId, item.status, item.hours);
                    });
                    
                    populateRow(item.atId, item.project, item.task, item.status, tdInputs, item.weekTotal);
                    $(`#assigntasks-id-${item.atId}`).prop('checked', true).prop('disabled', true);
                });
    
                $('#ts-breakdown').text(data.summary.total + " hrs");
                $('#project-task').text(data.summary.weekdayTotal);
                $('#weekend-task').text(data.summary.weekendTotal);

                // $('#selected_status, #submit').show();
                // hasCheck = false;

                // check box is enable. 
                // fetch row id check box disable and checked.
                // dropdown and submit is toggle(true) = display.
                // dropdown is prop('disabled', false) = enabled.
                if (data.dateStatus === 'current') {
                    if(data.defaultStatus === 'pending'){
                        // $('#selected_status').toggle(true).prop('disabled', false).val('pending');
                        // $('#submit').toggle(true);
                        $('#selected_status').val('pending');
                    } else if (data.defaultStatus === 'approve'){
                        // $('#selected_status').toggle(true).prop('disabled', true).val('approve');
                        // $('#submit').toggle(false);
                        // $('.itemCheckbox').prop('disabled', true);
                        $('#selected_status').val('approve');
                    } else if (data.defaultStatus === 'recheck'){
                        // $('#selected_status').toggle(true).prop('disabled', false).val('recheck');
                        // $('#submit').toggle(true);
                        $('#selected_status').val('recheck');
                    } else if (data.defaultStatus === 'reject'){
                        // $('#selected_status').toggle(true).prop('disabled', true).val('reject');
                        // $('#submit').toggle(false);
                        // $('.itemCheckbox').prop('disabled', true);
                        // $('.common-day h5').text("-NA-");
                        // $('.common-day .rs-timesheet-task span').text(0);
                        // $('#ts-breakdown').text("16 hrs");
                        // $('#project-task').text(0);
                        // $('#weekend-task').text(16);
                        $('#selected_status').val('reject');
                        $('.common-day h5').text("-NA-");
                        $('.common-day .rs-timesheet-task span').text(0);
                        $('#ts-breakdown').text("16 hrs");
                        $('#project-task').text(0);
                        $('#weekend-task').text(16);
                    }

                }

                // check box is disable. 
                // fetch row id check box disable and checked.
                // dropdown and submit is toggle(false) = hide.
                // dropdown is prop('disabled', true) = disabled.
                if (data.dateStatus === 'past') {
                    if(data.defaultStatus === 'pending'){
                        $('#selected_status').toggle(true).val('pending');
                    } else if (data.defaultStatus === 'approve'){
                        $('#selected_status').toggle(true).val('approve');
                    } else if (data.defaultStatus === 'recheck'){
                        $('#selected_status').toggle(true).val('recheck');
                    } else if (data.defaultStatus === 'reject'){
                        $('#selected_status').toggle(true).val('reject');
                        $('.common-day h5').text("-NA-");
                        $('.common-day .rs-timesheet-task span').text(0);
                        $('#ts-breakdown').text("16 hrs");
                        $('#project-task').text(0);
                        $('#weekend-task').text(16);
                    }

                }
            }
        }

    }) // end fetch(`/resource/timesheet/${id}/${currentDate}/${6}`)
    .catch(error => console.error('Fetch error:', error));
}

// function updateStatusAndSubmitVisibility() {
//     let hasNone = false;

//     $('.task-row').each(function () {
//         if ($(this).data('status') === 'none') {
//             hasNone = true;
//             return false; // break loop
//         }
//     });

//     if (hasNone) {
//         $('#selected_status').hide();
//     } else {
//         $('#selected_status').show();
//     }

//     if ($('.itemCheckbox:checked').length > 0) {
//         $('#submit').show();
//     } else {
//         $('#submit, #selected_status').hide();
//     }
// }
