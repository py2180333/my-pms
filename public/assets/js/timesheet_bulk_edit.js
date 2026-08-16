// this is bulkedit for project manager

$(document).ready(function() {

    // Initially disable all buttons
    $('.all-btn').prop('disabled', true);

    // Handle "Select All" checkbox
    $('#selectAll').on('change', function(){
        const isChecked = $(this).is(':checked');
        $('.row-checkbox').prop('checked', isChecked);
        updateBtns(isChecked);
    });

    // Delegate change event to dynamically added checkboxes
    $('#mainTable').on('change', '.row-checkbox', function () {
        const checkboxes = $('.row-checkbox').toArray();

        const allChecked = checkboxes.every(cb => cb.checked);
        const anyChecked = checkboxes.some(cb => cb.checked);

        $('#selectAll').prop('checked', allChecked);
        updateBtns(anyChecked);

    });

    insertRows();

    $('.dropDown').on('change', function () {
        insertRows();
        $('#selectAll').prop('checked', false);
        $('.all-btn').prop('disabled', true);
    });

    $('#mainTable').on('click', '.on-submit', function () {
        // Uncheck all checkboxes first
        $('.row-checkbox').prop('checked', false);

        // Check the checkbox in the same row as the clicked button
        $(this).closest('tr').find('.row-checkbox').prop('checked', true);
    });

});


function insertRows(){

    let projectId = $('#projectId').val();
    let resourceId = $('#resourceId').val();
    let week = $('#week').val();
    let status = $('#status').val();

    let statusColorMap = {
        pending: "warning",
        approve: "success",
        recheck: "warning",
        reject: "danger",
    };

    // TimesheetController -> bulkEditFilter
    fetch(`/resource/timesheet/projectManager/bulkEdit/filter/${projectId}/${resourceId}/${week}/${status}`)
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            let insertRow = '';

            data.atData.forEach(function(item, index){

                insertRow += `
                    <tr>
                        <td class="text-center">
                            <input type="checkbox" class="row-checkbox" name="atId[]" value="${item.id}" />
                        </td>
                        <td class="text-center">${index + 1}</td>
                        <td class="text-center">${item.project.project_name}</td>
                        <td class="text-center">${item.task.task_name}</td>
                        <td class="text-center">${item.consultant.first_name} ${item.consultant.last_name}</td>
                        <td class="text-center">
                            <label class="badge badge-gradient-${statusColorMap[status]}">
                                ${status}
                            </label>
                        </td>
                        <td class="text-center d-flex">

                            <button type="submit" name="allAction" value="approve" class="ms-2 p-2 fs-6 btn btn-success on-submit" ${status === 'approve' ? 'disabled' : ''}>Approve</button>
                            <button type="submit" name="allAction" value="recheck" class="ms-2 p-2 fs-6 btn btn-warning on-submit" ${status === 'recheck' ? 'disabled' : ''}>Recheck</button>
                            <button type="submit" name="allAction" value="reject" class="ms-2 p-2 fs-6 btn btn-danger on-submit" ${status === 'reject' ? 'disabled' : ''}>Reject</button>
                            
                        </td>
                    </tr>
                `;

            });

            if(insertRow === ''){
                $('#selectAll').prop('disabled', true);
            } else {
                $('#selectAll').prop('disabled', false);
            }

            $('#mainTable').DataTable().destroy();
            $('#mainTable tbody').html(insertRow);
            $('#mainTable').DataTable();

            $('#start-date').val(data.start);
            $('#end-date').val(data.end);
            
        }) // end fetch(`/resource/timesheet/projectManager/bulkEdit/filter/${projectId}/${resourceId}/${week}/${status}`)
    .catch(error => console.error('Fetch error:', error));

}

function updateBtns(boxChecked){
    $('.all-btn').prop('disabled', !boxChecked);

    if(boxChecked){
        let val = $('#status').val();
        $('.btn-approve').prop('disabled', (val === 'approve'));
        $('.btn-recheck').prop('disabled', (val === 'recheck'));
        $('.btn-reject').prop('disabled', (val === 'reject'));
    }
}