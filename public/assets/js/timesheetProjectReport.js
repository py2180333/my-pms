// new pr 7-7-25
$(document).ready(function () {

    // new pr 8-7-25
    function fetchProjects() {
        const company = $('#company-filter-report').val();
        const params = new URLSearchParams({
            company: company
        });

        fetch(`/admin/reports/get-project-by-company?${params.toString()}`)
            .then(response => response.json())
            .then(data => {
                let options = '<option value="" selected disabled>-- select Project --</option>';

                data.projects.forEach(item => {
                    options += `<option value="${item.id}">${item.project_name}</option>`;
                });

                $('#project-filter-report').html(options);
            })
            .catch(error => console.error("error for fetching projects: ", error));

        $('#project-filter-report').prop('disabled', false);
    }

    // new pr 8-7-25
    function fetchResources() {
        const project = $('#project-filter-report').val();
        const params = new URLSearchParams({
            project: project
        });

        fetch(`/admin/reports/get-resource-by-project?${params.toString()}`)
            .then(response => response.json())
            .then(data => {
                let options = '<option value="all" selected>All Resources</option>';

                data.consultants.forEach(item => {
                    options += `<option value="${item.id}">${item.first_name} ${item.last_name}</option>`;
                });

                data.projectManager.forEach(item => {
                    options += `<option value="${item.id}">${item.first_name} ${item.last_name} (Project Manager)</option>`;
                });

                $('#projectName').html(data.projectName);
                $('#projectValue').html(data.projectValue);
                $('#projectStatus').html(data.projectStatus);
                $('#customerName').html(data.customerName);

                $('#date-inputs').data('dateRangePicker').setStartLimit(data.startDate);
                $('#resource-filter-report').html(options);
            })
            .catch(error => console.error("error for fetching projects: ", error));

        $('#resource-filter-report').prop('disabled', false);
    }

    // new pr 9-7-25
    function fetchTimesheetProjectReport() {
        const project = $('#project-filter-report').val();
        const resource = $('#resource-filter-report').val();
        const startDate = $('#start-date').val();
        const endDate = $('#end-date').val();

        const params = new URLSearchParams({
            project: project,
            resource: resource,
            startDate: startDate,
            endDate: endDate
        });

        fetch(`/admin/reports/get-timesheet-project-report?${params.toString()}`)
            .then(response => response.json())
            .then(data => {
                if(data.report.length === 0){
                    $('#row').html(`
                        <tr>
                            <td colspan="5">No Data Available</td>
                        </tr>    
                    `);
                } else {
                    let row = '';
                    data.report.forEach((item,index) => {
                        row += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${item.resource}</td>
                                <td>${item.milestone}</td>
                                <td>${item.task}</td>
                                <td>${item.hours}</td>
                            </tr>
                        `;
                    });
                    $('#row').html(row);
                }
            })
            .catch(error => console.error('error for fetching report: ', error));
    }

    // new -pr 10-7-25
    function clearReport(){
        $('#projectName').html('');
        $('#projectValue').html('');
        $('#projectStatus').html('');
        $('#customerName').html('');
        $('#row').html(`
            <tr>
                <td colspan="5">No Data Available</td>
            </tr>    
        `);
    }

    $('#company-filter-report').on('change', function (event) {

        /* set filter */
        $('#resource-filter-report').html('<option value="all" selected>All Resources</option>');
        $('#resource-filter-report').prop('disabled', true);
        $('#date-inputs').data('dateRangePicker').setStartLimit(false);
        event.stopPropagation();
        $('#date-inputs').data('dateRangePicker').clear();

        /* set report */
        clearReport();

        fetchProjects();
    });

    $('#project-filter-report').on('change', function (event) {
        
        /* set filter */
        event.stopPropagation();
        $('#date-inputs').data('dateRangePicker').clear();

        /* set report */
        clearReport();

        fetchResources();
    });

    $('#resource-filter-report').on('change', function () {

        /* set report */
        $('#row').html(`
            <tr>
                <td colspan="5">No Data Available</td>
            </tr>    
        `);

    })

    $('#generate').on('click', function () {
        const company = $('#company-filter-report').val();
        const project = $('#project-filter-report').val();
        if((!company) || (!project)){
            $('#errorMesage').html(`
                <div class="alert alert-danger">
                    <ul>
                        <li>Plese select the company and project.</li>
                    </ul>
                </div>
            `);

            setTimeout(function () {
                $('#errorMesage').html('');
            }, 3000);
        } else {
            fetchTimesheetProjectReport();
        }
    });
});