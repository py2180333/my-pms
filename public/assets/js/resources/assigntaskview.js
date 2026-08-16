$(document).ready(function () {

    // pr add 10-10-25
    async function setDataFromUrl() {
        const urlParams = new URLSearchParams(window.location.search);
        const project = urlParams.get('project_id'); // Retrieve project from the URL
        const milestone = urlParams.get('milestone_id'); // Retrieve milestone from the URL
        const task = urlParams.get('task_id'); // Retrieve task from the URL
        const resource = urlParams.get('resource_id'); // Retrieve resource from the URL
        const status = urlParams.get('status'); // Retrieve status from the URL
        const startDate = urlParams.get('startDate'); // Retrieve startDate from the URL
        const endDate = urlParams.get('endDate'); // Retrieve endDate from the URL
        // Set the initial value of the company filter dropdown
        if (project) $('#project-filter-at-task').val(project);
        // Initial fetch
        await fetchMilestone();
        if (milestone) $('#milestone-filter-at-task').val(milestone);
        // Initial fetch
        await fetchTask();
        if (task) $('#task-filter-at-task').val(task);
        // Initial fetch
        await fetchResources();
        if (resource) $('#resource-filter-at-task').val(resource);
        if (status) $('#status-filter-at-task').val(status);
        if (startDate) $('#start-date').val(startDate);
        if (endDate) $('#end-date').val(endDate);
        return;
    }
    // /pr add 10-10-25

    function fetchMilestone() {
        const projectId = $('#project-filter-at-task').val();

        if(projectId == 'all'){
            $('#milestone-filter-at-task').html('<option value="all" selected>All Milestones</option>');
            $('#task-filter-at-task').html('<option value="all" selected>All Tasks</option>');
            $('#milestone-filter-at-task, #task-filter-at-task').prop('disabled',true);
            return;
        } else {
            $('#milestone-filter-at-task').prop('disabled',false);

            return $.ajax({
                url: `/resource/get-milestones/${projectId}`,
                method: "GET",
                success: function (response) {
                    let options = '<option value="all" selected>All Milestones</option>';
                    response.forEach(function (milestone) {
                        options += `<option value="${milestone.id}">${milestone.milestone_name}</option>`;
                    })
                    $('#milestone-filter-at-task').html(options);
                },
                error: function (error) {
                    console.error("Error fetching milestone dropdown:", error);
                },
            });
        }
    }

    function fetchTask() {
        const milestoneId = $('#milestone-filter-at-task').val();

        if(milestoneId == 'all'){
            $('#task-filter-at-task').html('<option value="all" selected>All Tasks</option>');
            $('#task-filter-at-task').prop('disabled',true);
            return;
        } else {
            $('#task-filter-at-task').prop('disabled',false);

            return $.ajax({
                url: `/resource/get-tasks/${milestoneId}`,
                method: "GET",
                success: function (response) {
                    let options = '<option value="all" selected>All Tasks</option>';
                    response.forEach(function (task) {
                        options += `<option value="${task.id}">${task.task_name}</option>`;
                    })
                    $('#task-filter-at-task').html(options);
                },
                error: function (error) {
                    console.error("Error fetching task dropdown:", error);
                },
            });
        }
    }

    function fetchResources(){
        const projectId = $('#project-filter-at-task').val();

        if(projectId == 'all'){

            return $.ajax({
                url: `/resource/assigntask/filter/resources`,
                method: "GET",
                success: function (response) {
                    let options = '<option value="all" selected>All Resources</option>';
                    response.consultants.forEach(function (c) {
                        options += `<option value="${c.consultant.id}">
                            ${c.consultant.first_name} 
                            ${c.consultant.last_name} 
                            (${c.consultant.email}) 
                            ${c.consultant.username}
                        </option>`;
                    })
                    $('#resource-filter-at-task').html(options);
                },
                error: function (error) {
                    console.error("Error fetching resource dropdown:", error);
                },
            });
           
        } else {

            return $.ajax({
                url: `/resource/get-resources/filter/${projectId}`,
                method: "GET",
                success: function (response) {
                    let options = '<option value="all" selected>All Resources</option>';
                    response.resources.forEach(function (item) {
                        options += `<option value="${item.consultant_id}">
                            ${item.consultant.first_name} 
                            ${item.consultant.last_name} 
                            (${item.consultant.email}) 
                            ${item.consultant.username}
                        </option>`;
                    });
                    $('#resource-filter-at-task').html(options);
                },
                error: function (error) {
                    console.error("Error fetching resource dropdown:", error);
                },
            });
        }
    }

    function fetchAssignTasks() {
        // pr add || 10-10-25
        const project = $('#project-filter-at-task').val() || $('#project-filter-at-task').val('all').val(); // Get selected project
        const milestone = $('#milestone-filter-at-task').val() || $('#milestone-filter-at-task').val('all').val(); // Get selected milestone
        const task = $('#task-filter-at-task').val() || $('#task-filter-at-task').val('all').val(); // Get selected task
        const resource = $('#resource-filter-at-task').val() || $('#resource-filter-at-task').val('all').val(); // Get selected resource
        const status = $('#status-filter-at-task').val() || $('#status-filter-at-task').val('all').val(); // Get selected status
        const startDate = $('#start-date').val(); // Get selected start date
        const endDate = $('#end-date').val(); // Get selected end date

        $.ajax({
            url: '/resource/assigntask/filter',
            method: "GET",
            data: { 
                project_id: project,
                milestone_id: milestone,
                task_id: task,
                resource_id: resource,
                status: status,
                startDate: startDate,
                endDate: endDate,
             },
            success: function (response) {
                $('#allResources').text(response.count);
                $('#todo').text(response.todo);
                $('#progress').text(response.progress);
                $('#completed').text(response.completed);
                let rows = '';
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                response.data.forEach(function (assigntask, index) {
                    
                    rows += `
                        <tr>
                            <td class="checkBox">${index + 1}</td>
                            <td>${assigntask.project.project_name}</td>
                            <td>${assigntask.milestone.milestone_name}</td>
                            <td>${assigntask.task.task_name}</td>
                            <td>${assigntask.consultant.first_name ?? assigntask.project.manager.first_name} ${assigntask.consultant.last_name ?? assigntask.project.manager.last_name}</td>
                            <td>${assigntask.task.start_date}</td>
                            <td>${assigntask.task.estimated_hours}</td>
                            <td><label class="badge ${assigntask.status}">${assigntask.status}</label></td>
                            <td class="text-center d-flex">
                                <a href="#" class="ms-2 p-2 fs-6 my_icons edit-action" data-bs-toggle="modal" data-bs-target="#task-update-${assigntask.id}"><i class="fa-solid fa-pen-to-square text-dark" data-bs-placement="top" title="Edit"></i></a>
                                <a href="#" class="ms-2 p-2 fs-6 my_icons view-action" data-bs-toggle="modal" data-bs-target="#task-details-modal-${assigntask.id}" data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i class="fa-solid fa-eye view text-success"></i></a>
                                <form action="/resource/delete-assigned-task/${assigntask.id}" method="POST" onsubmit="return confirm('Are you sure you want to delete Task?');">
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

                if ($.fn.DataTable.isDataTable('.assigntaskssearch')) {
                    $('.assigntaskssearch').DataTable().destroy();
                }

                //2. this is work when company dropdown is use.
                $('#assigntasks-data').html(rows);

                //3. this is work when search is use.
                $('.assigntaskssearch').DataTable({
                    "buttons": []
                });

                // pr add 10-10-25
                // set data in Url
                let query = new URLSearchParams;
                if (project && project !== 'all') query.set('project_id', project);
                if (milestone && milestone !== 'all') query.set('milestone_id', milestone);
                if (task && task !== 'all') query.set('task_id', task);
                if (resource && resource !== 'all') query.set('resource_id', resource);
                if (status && status !== 'all') query.set('status', status);
                if (startDate) query.set('startDate', startDate);
                if (endDate) query.set('endDate', endDate);

                // Reset to the base URL when no company filter is selected
                const newUrl = `${window.location.origin}/resource/assigntask/index${query.toString() ? `?${query.toString()}` : ''}`;
                history.pushState({ path: newUrl }, '', newUrl);
                // /pr add 10-10-25
            },
            error: function (error) {
                console.error("Error fetching resouces:", error);
            },
        });
    }

    function loading(){
        let table = $('.assigntaskssearch').DataTable();
        table.clear();
        table.row.add(['', '', '', '', '<div class="text-center w-100" colspan="9">Loading...</div>', '', '', '', '']);
        table.draw();
    }

    $('#project-filter-at-task').change(async function () {
        loading();
        $('#milestone-filter-at-task, #task-filter-at-task, #resource-filter-at-task').html('<option selected>Loading...</option>');
        await fetchMilestone();
        $('#milestone-filter-at-task').val('all');
        await fetchTask();
        $('#task-filter-at-task').val('all');
        await fetchResources();
        $('#resource-filter-at-task').val('all');
        fetchAssignTasks();
    });

    $('#milestone-filter-at-task').change(async function () {
        loading();
        $('#task-filter-at-task').html('<option selected>Loading...</option>');
        await fetchTask();
        $('#task-filter-at-task').val('all');
        fetchAssignTasks();
    });

    $('#task-filter-at-task, #resource-filter-at-task, #status-filter-at-task').change(async function () {
        loading();
        fetchAssignTasks();
    });

    $('#start-date, #end-date').on('customDateChanged', function() {
        loading();
        fetchAssignTasks();
    });

    // back and forward buttons of browser is click pr add 10-10-25
    $(window).on('popstate', function(){
        init();
    });

    async function init(){
        loading();
        $('#milestone-filter-at-task, #task-filter-at-task, #resource-filter-at-task').html('<option selected>Loading...</option>');
        await setDataFromUrl(); // <- fetchMilestone()
        // <- fetchTask()
        // <- fetchResources()
        fetchAssignTasks();
    }

    init();

});
