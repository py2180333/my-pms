// new pr 24-7-25
$(document).ready(function () {

    // new pr 24-7-25
    /* function fetchProjects() {
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
    } */

    // new pr 24-7-25
    function fetchTimesheetCompanyReport() {
        const company = $('#company-filter-report').val();
        const startDate = $('#start-date').val();
        const endDate = $('#end-date').val();

        const params = new URLSearchParams({
            company: company,
            startDate: startDate,
            endDate: endDate
        });

        // console.log(`/admin/reports/get-timesheet-company-report?${params.toString()}`);

        fetch(`/admin/reports/get-timesheet-company-report?${params.toString()}`)
            .then(response => response.json())
            .then(data => {

                $('#companyName').text(data.company.company_name);
                $('#companyPAN').text(data.company.pan_number);
                $('#companyEmail').text(data.company.email);
                $('#companyGST').text(data.company.gst_number);
                $('#companyAddress').text(data.company.address);
                $('#companyNumber').text(data.company.phone_number);

                if (typeof data.message !== 'undefined') {
                    $('#row').html(`
                        <tr>
                            <td colspan="6">${data.message}</td>
                        </tr>    
                    `);
                } else {
                    let row = '';
                    data.project.forEach((item,index) => {
                        row += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${item.project_name}</td>
                                <td>${item.status}</td>
                                <td>${item.start_date}</td>
                                <td>${item.end_date}</td>
                                <td>${item.total_hours}</td>
                            </tr>
                        `;
                    });
                    $('#row').html(row);
                }
            })
            .catch(error => console.error('error for fetching report: ', error));
    }

    // new -pr 24-7-25
    function clearReport(){
        $('#companyName').html('');
        $('#companyPAN').html('');
        $('#companyEmail').html('');
        $('#companyGST').html('');
        $('#companyAddress').html('');
        $('#companyNumber').html('');
        $('#row').html(`
            <tr>
                <td colspan="6">No Data Available</td>
            </tr>    
        `);
    }

    $('#company-filter-report').on('change', function (event) {

        /* set filter */
        $('#date-inputs').data('dateRangePicker').setStartLimit(false);
        event.stopPropagation();
        $('#date-inputs').data('dateRangePicker').clear();

        /* set report */
        clearReport();

    });

    $('#generate').on('click', function () {
        const company = $('#company-filter-report').val();
        if(!company){
            $('#errorMesage').html(`
                <div class="alert alert-danger">
                    <ul>
                        <li>Plese select the company.</li>
                    </ul>
                </div>
            `);

            setTimeout(function () {
                $('#errorMesage').html('');
            }, 3000);
        } else {
            fetchTimesheetCompanyReport();
        }
    });
});