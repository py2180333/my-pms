$(document).ready(function () {

    // pr add 10-10-25
    async function setDataFromUrl() {
        const urlParams = new URLSearchParams(window.location.search);
        const project = urlParams.get('project_id'); // Retrieve project from the URL
        const milestone = urlParams.get('milestone_id'); // Retrieve milestone from the URL
        const priority = urlParams.get('priority'); // Retrieve priority from the URL
        const status = urlParams.get('status'); // Retrieve status from the URL
        const startDate = urlParams.get('startDate'); // Retrieve startDate from the URL
        const endDate = urlParams.get('endDate'); // Retrieve endDate from the URL
        // Set the initial value of the company filter dropdown
        if (project) $('#project-filter-task').val(project);
        // Initial fetch
        await fetchMilestone();
        if (milestone) $('#milestone-filter-task').val(milestone);
        if (priority) $('#priority-filter-task').val(priority);
        if (status) $('#status-filter-task').val(status);
        if (startDate) $('#start-date').val(startDate);
        if (endDate) $('#end-date').val(endDate);
        return;
    }
    // /pr add 10-10-25

    function fetchMilestone() {
        const projectId = $('#project-filter-task').val(); // Get selected project

        if(projectId == 'all'){
            $('#milestone-filter-task').html('<option>All Milestones</option>');
            $('#milestone-filter-task').prop('disabled',true);
            $('#milestone-filter-task').toggle(true);
            $('#no-milestone').toggle(false);
            $('#milestone-filter-task').html('<option value="all" selected>All Milestones</option>');
            return;
        } else {
            $('#milestone-filter-task').prop('disabled',false);

            return $.ajax({
                url: `/admin/tasks/${projectId}/milestones`,
                method: "GET",
                success: function (response) {
                    if(response.length === 0){
                        $('#no-milestone').toggle(true);
                        $('#milestone-filter-task').toggle(false);
                        $('#no-milestone').html('<a href="/admin/projects/milestonecreate" style="color: blue; text-decoration: underline;">Create a new milestone</a>');
                    } else {
                        $('#milestone-filter-task').toggle(true);
                        $('#no-milestone').toggle(false);
                        let options = '<option value="all" selected>All Milestones</option>';
                        response.forEach(function (milestone) {
                            options += `<option value="${milestone.id}">${milestone.milestone_name}</option>`;
                        })
                        $('#milestone-filter-task').html(options);
                    }
                },
                error: function (error) {
                    console.error("Error fetching milestone dropdown:", error);
                },
            });
        }
    }

    function fetchTasks() {
        // pr add || 10-10-25
        const project = $('#project-filter-task').val() || $('#project-filter-task').val('all').val(); // Get selected project
        const milestone = $('#milestone-filter-task').val() || $('#milestone-filter-task').val('all').val(); // Get selected milestone
        const priority = $('#priority-filter-task').val() || $('#priority-filter-task').val('all').val(); // Get selected priority
        const status = $('#status-filter-task').val() || $('#status-filter-task').val('all').val(); // Get selected status
        const startDate = $('#start-date').val(); // Get selected start date
        const endDate = $('#end-date').val(); // Get selected end date

        $.ajax({
            url: '/admin/tasks/filter',
            method: "GET",
            data: { 
                project_id: project,
                milestone_id: milestone,
                priority: priority,
                status: status,
                startDate: startDate,
                endDate: endDate,
             },
            success: function (response) {
                $('#allTasks').text(response.count);
                $('#todo').text(response.todo);
                $('#progress').text(response.progress);
                $('#completed').text(response.completed);
                let rows = '';
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                response.data.forEach(function (task, index) {
                    
                    rows += `
                        <tr>
                            <td class="checkBox">${index + 1}</td>
                            <td>${task.task_name}</td>
                            <td>${task.priority}</td>
                            <td>${task.estimated_hours}</td>
                            <td>${ task.milestone ? task.milestone.milestone_name : 'N/A' } ( ${task.project ? task.project.project_name : ''} )</td>
                            <td>${task.start_date}</td>
                            <td>${task.end_date}</td>
                            <td><label class="badge ${task.status}">${task.status}</label></td>
                            <td class="text-center d-flex">
                                <a href="#" class="ms-2 p-2 fs-6 my_icons edit-action" data-bs-toggle="modal" data-bs-target="#task-update-${task.id}" data-id="${task.id}"><i class="fa-solid fa-pen-to-square text-dark"  data-bs-placement="top" title="Edit"></i></a>
                                <a href="#" class="ms-2 p-2 fs-6 my_icons view-action" data-bs-toggle="modal" data-bs-target="#task-details-modal-${task.id}" data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i class="fa-solid fa-eye view text-success"></i></a>
                                <form action="/admin/tasks/${task.id}/force-delete" method="POST" onsubmit="return confirm('Are you sure you want to delete Task?');">
                                    <input type="hidden" name="_token" value="${csrfToken}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="ms-2 p-2 fs-6 my_icons btn btn-link btn-danger delete-action">
                                        <i class="fa-solid fa-trash text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    `;
                });

                if ($.fn.DataTable.isDataTable('.tasksearch')) {
                    $('.tasksearch').DataTable().destroy();
                }

                //2. this is work when company dropdown is use.
                $('#task-data').html(rows);

                //3. this is work when search is use.
                $('.tasksearch').DataTable({
                    "buttons": []
                });

                // pr add 10-10-25
                // set data in Url
                let query = new URLSearchParams;
                if (project && project !== 'all') query.set('project_id', project);
                if (milestone && milestone !== 'all') query.set('milestone_id', milestone);
                if (priority && priority !== 'all') query.set('priority', priority);
                if (status && status !== 'all') query.set('status', status);
                if (startDate) query.set('startDate', startDate);
                if (endDate) query.set('endDate', endDate);

                // Reset to the base URL when no company filter is selected
                const newUrl = `${window.location.origin}/admin/tasks/index${query.toString() ? `?${query.toString()}` : ''}`;
                history.pushState({ path: newUrl }, '', newUrl);
                // /pr add 10-10-25
            },
            error: function (error) {
                console.error("Error fetching resouces:", error);
            },
        });
    }

    function loading() {
        let table = $('.tasksearch').DataTable();
        table.clear();
        table.row.add(['', '', '', '<div class="text-center">Loading...</div>', '', '', '', '', '']);
        table.draw();
    }

    // Trigger fetch on project filter change
    $('#project-filter-task').change(async function () {
        loading();
        $('#milestone-filter-task').html('<option select>Loading...</option>');
        await fetchMilestone();
        $('#milestone-filter-task').val('all');
        fetchTasks();
    });

    $('#milestone-filter-task, #priority-filter-task, #status-filter-task').change(function () {
        loading();
        fetchTasks();
    });

    $('#start-date, #end-date').on('customDateChanged', function() {
        loading();
        fetchTasks();
    });

    // back and forward buttons of browser is click pr add 10-10-25
    $(window).on('popstate', function(){
        init();
    });

    async function init(){
        loading();
        await setDataFromUrl(); // <- fetchMilestone()
        // Initial fetch
        fetchTasks();
    }

    init();
});
