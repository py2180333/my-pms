$(document).ready(function () {

    // pr add 10-10-25
    async function setDataFromUrl() {
        const urlParams = new URLSearchParams(window.location.search);
        const project = urlParams.get('project'); // Retrieve project from the URL
        const statusData = urlParams.get('status'); // Retrieve status from the URL
        const startDate = urlParams.get('stDate'); // Retrieve stDate from the URL
        const endDate = urlParams.get('endDate'); // Retrieve endDate from the URL
        // Set the initial value of the company filter dropdown
        if (project) $('#customer-filter-project').val(project);
        if (statusData) $('#status-filter-project').val(statusData);
        if (startDate) $('#start-date').val(startDate);
        if (endDate) $('#end-date').val(endDate);
    }
    // /pr add 10-10-25

    function formatDate(dateStr) {
        const d = new Date(dateStr);
        const day = String(d.getDate()).padStart(2, '0');
        const month = String(d.getMonth() + 1).padStart(2, '0'); // Months are 0-based
        const year = d.getFullYear();
        return `${day}-${month}-${year}`;
    }

    function fetchProjects() {
        // pr add || 10-10-25
        const project = $('#customer-filter-project').val() || $('#customer-filter-project').val('all').val(); // Get selected customer
        const statusData = $('#status-filter-project').val() || $('#status-filter-project').val('all').val(); // Get selected status
        const startDate = $('#start-date').val(); // Get selected start date
        const endDate = $('#end-date').val(); // Get selected end date

        $.ajax({
            url: '/customer/projects/filter',
            method: "GET",
            data: { 
                project: project,
                status: statusData,
                stDate: startDate,
                endDate: endDate,
             },
            success: function (response) {
                $('#allProjects').text(response.count);
                $('#value').text(response.totalValue);
                $('#progress').text(response.progress);
                $('#planning').text(response.planning);
                $('#completed').text(response.completed);
                $('#hold').text(response.hold);
                let rows = '';
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                response.data.forEach(function (project, index) {
                    
                    rows += `
                        <tr>
                            <td class="checkBox">
                                ${index + 1}
                            </td>
                            <td class="text-center">${ project.uniquename }</td>
                            <td>${ project.project_name }</td>
                            <td class="text-center">
                                ${ project.customer?.first_name ?? 'No Customer' }
                                ${ project.customer?.last_name ?? '' }
                                <p class="m-0">${ project.customer?.email ?? '' }</p>
                            </td>
                            <td class="text-center">
                                ${ project.vendor?.first_name ?? 'No Vendor' }
                                ${ project.vendor?.last_name ?? '' }
                                <p class="m-0">${ project.vendor?.email ?? '' }</p>
                            </td>
                            <td class="text-center">
                                ${ project.manager?.first_name ?? 'No Manager' } 
                                ${ project.manager?.last_name ?? '' }
                                <p class="m-0">${ project.manager?.email ?? '' }</p>
                            </td>

                            <td class="text-center">
                                <label class="badge badge-gradient-${ project.status == 'completed' ? 'success' : 'warning' }">
                                    ${ project.status.charAt(0).toUpperCase() + project.status.slice(1).replace(/_/g, ' ') }
                                </label>
                            </td>
                            <td class="text-center">${ formatDate(project.start_date) }</td>
                            <td class="text-center">${ formatDate(project.end_date) }</td>
                            <td class="text-center d-flex">
                                <a href="#" class="ms-2 p-2 fs-6 my_icons view-action" data-bs-toggle="modal" data-bs-target="#system-user-${ project.id }">
                                    <i class="fa-solid fa-eye view text-success" data-bs-placement="top" title="View"></i>
                                </a>
                            </td>
                        </tr>
                    `;
                });

                if ($.fn.DataTable.isDataTable('.projectsearch')) {
                    $('.projectsearch').DataTable().destroy();
                }

                //2. this is work when company dropdown is use.
                $('#project-data').html(rows);

                //3. this is work when search is use.
                $('.projectsearch').DataTable({
                    "buttons": []
                });

                // pr add 10-10-25
                // set data in Url
                let query = new URLSearchParams;
                if (project && project !== 'all') query.set('project', project);
                if (statusData && statusData !== 'all') query.set('status', statusData);
                if (startDate) query.set('stDate', startDate);
                if (endDate) query.set('endDate', endDate);

                // Reset to the base URL when no company filter is selected
                const newUrl = `${window.location.origin}/customer/projects/index${query.toString() ? `?${query.toString()}` : ''}`;
                history.pushState({ path: newUrl }, '', newUrl);
                // /pr add 10-10-25
            },
            error: function (error) {
                console.error("Error fetching resouces:", error);
            },
        });
    }

    // Trigger fetch on company filter change
    $('#company-filter-project, #customer-filter-project, #status-filter-project, #start-date, #end-date').change(function () {
        fetchProjects();
    });

    $('#start-date, #end-date').on('customDateChanged', function() {
        fetchProjects();
    });

    // back and forward buttons of browser is click pr add 10-10-25
    $(window).on('popstate', function(){
        setDataFromUrl();
        // Initial fetch
        fetchProjects();
    });

    setDataFromUrl();
    // Initial fetch
    fetchProjects();
});
