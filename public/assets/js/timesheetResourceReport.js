// new pr 11-7-25
$(document).ready(function () {

    // new pr 11-7-25
    function fetchResources() {
        const company = $('#company-filter-report').val();
        const params = new URLSearchParams({
            company: company
        });

        fetch(`/admin/reports/get-resource-by-company?${params.toString()}`)
            .then(response => response.json())
            .then(data => {
                let options = '<option value="" selected disabled>-- select Resource --</option>';

                data.resource.forEach(item => {
                    options += `<option value="${item.id},${item.role}">${item.name}</option>`;
                });

                $('#resource-filter-report').html(options);
            })
            .catch(error => console.error("error for fetching projects: ", error));

        $('#resource-filter-report').prop('disabled', false);
    }

    // new pr 11-7-25
    function fetchProjects() {
        const [resourceId, resourceRole] = $('#resource-filter-report').val().split(',');
        const params = new URLSearchParams({
            resourceId: resourceId, // id
            role: resourceRole // consultant, project_manager etc
        });

        fetch(`/admin/reports/get-project-by-resource?${params.toString()}`)
            .then(response => response.json())
            .then(data => {
                let options = '<option value="all" selected>All Projects</option>';
                let table = '<table> <tbody>';

                data.project.forEach(item => {
                    options += `<option value="${item.id}">${item.project_name}</option>`;
                });

                data.companies.forEach((item, index) => {
                    table += `
                        <tr>
                            <td>
                                <strong>Company ${index + 1}:</strong>
                                <span>${item}</span>
                            </td>
                        </tr>
                    `;
                });

                table += '</tbody> </table>';

                $('#resourceName').html(data.resourceName);
                $('#resourceStatus').html(data.resourceStatus);
                $('#salary').html(data.salary);
                $('#companies').html(table);

                $('#date-inputs').data('dateRangePicker').setStartLimit(data.startDate);
                $('#project-filter-report').html(options);
            })
            .catch(error => console.error("error for fetching projects: ", error));

        $('#project-filter-report').prop('disabled', false);
    }

    // new pr 11-7-25
    function fetchTimesheetResourceReport() {
        const [resourceId] = $('#resource-filter-report').val().split(',');
        const project = $('#project-filter-report').val();
        const startDate = $('#start-date').val();
        const endDate = $('#end-date').val();

        const params = new URLSearchParams({
            resource: resourceId,
            project: project,
            startDate: startDate,
            endDate: endDate
        });

        // console.log(`${window.location.origin}/admin/reports/get-timesheet-resource-report?${params.toString()}`);

        fetch(`/admin/reports/get-timesheet-resource-report?${params.toString()}`)
            .then(response => response.json())
            .then(data => {
                if(data.report.length === 0){
                    $('#row').html(`
                        <tr>
                            <td colspan="5">No Data Available</td>
                        </tr>    
                    `);
                    $('#weekendHours').html('');
                    $('#projectHours').html('');
                    $('#totalHours').html('');
                } else {
                    let row = '';
                    data.report.forEach((item,index) => {
                        row += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${item.project}</td>
                                <td>${item.milestone}</td>
                                <td>${item.task}</td>
                                <td>${item.hours}</td>
                            </tr>
                        `;
                    });
                    $('#row').html(row);
                    $('#weekendHours').html(data.weekendHours);
                    $('#projectHours').html(data.projectHours);
                    $('#totalHours').html(data.totalHours);
                }
            })
            .catch(error => console.error('error for fetching report: ', error));
    }

    // new -pr 11-7-25
    function clearReport(){
        $('#resourceName').html('');
        $('#weekendHours').html('');
        $('#resourceStatus').html('');
        $('#projectHours').html('');
        $('#salary').html('');
        $('#totalHours').html('');
        $('#companies').html('');
        $('#row').html(`
            <tr>
                <td colspan="5">No Data Available</td>
            </tr>    
        `);
    }

    $('#company-filter-report').on('change', function (event) {

        /* set filter */
        $('#project-filter-report').html('<option value="all" selected>All Projects</option>');
        $('#project-filter-report').prop('disabled', true);
        $('#date-inputs').data('dateRangePicker').setStartLimit(false);
        event.stopPropagation();
        $('#date-inputs').data('dateRangePicker').clear();

        /* set report */
        clearReport();

        fetchResources();
    });

    $('#resource-filter-report').on('change', function (event) {
        
        /* set filter */
        event.stopPropagation();
        $('#date-inputs').data('dateRangePicker').clear();

        /* set report */
        clearReport();

        fetchProjects();
    });

    $('#project-filter-report').on('change', function () {

        /* set report */
        $('#row').html(`
            <tr>
                <td colspan="5">No Data Available</td>
            </tr>    
        `);
        $('#weekendHours').html('');
        $('#projectHours').html('');
        $('#totalHours').html('');

    })

    $('#generate').on('click', function () {
        const company = $('#company-filter-report').val();
        const resource = $('#resource-filter-report').val();
        if((!company) || (!resource)){
            $('#errorMesage').html(`
                <div class="alert alert-danger">
                    <ul>
                        <li>Plese select the company and resource.</li>
                    </ul>
                </div>
            `);

            setTimeout(function () {
                $('#errorMesage').html('');
            }, 3000);
        } else {
            fetchTimesheetResourceReport();
        }
    });
});