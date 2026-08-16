@extends('Admin.layouts.master')
@include('Admin.layouts.sidebar')
@include('Admin.layouts.headerMenu')
@section('content')
    <div class="page-wrapper create_p" style="min-height: 262px;">
        <!-- Page Content -->
        <div class="content container-fluid">
            <div class="crms-title row bg-white">
                <div class="col  p-0">
                    <h3 class="page-title m-0">
                        <span class="page-title-icon bg-gradient-primary text-white me-2">
                            <i class="bi bi-grid"></i>
                        </span>Assigntask To Resource
                    </h3>
                </div>
                <div class="col">
                    @if(session('success'))
                        <div class="alert alert-success" id="success-alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger" id="error-alert">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="col p-0 text-end">
                    <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Assign Resource</li>
                    </ul>
                </div>
            </div>
            <!-- Content Starts -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <form action="{{ route('admin.assigntask.store') }}" class="needs-validation card" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label class="col-form-label"> Select Project<span class="text-danger">*</span></label>
                                <select class="form-control form-select" name="project_id" id="projectSelect" required>
                                    <option value="">Select Project</option>
                                    @foreach($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label class="col-form-label">Milestone<span class="text-danger">*</span></label>
                                <select class="form-control form-select" name="milestone_id" id="milestonesDropdown" disabled required>
                                    <option value="">Select Milestone</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label class="col-form-label">Task<span class="text-danger">*</span></label>
                                <select class="form-control form-select" name="task_id" id="tasksDropdown" disabled required>
                                    <option value="">Select Task</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="col-form-label">Select Resource<span class="text-danger">*</span></label>
                                <select class="form-control form-select" name="resource_id" id="assigned-toresource" required disabled>
                                    <option value="">Select Resource</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label">Name<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="resourceName" disabled="" required="">
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label">Email<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="resourceEmail" disabled="" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-sm-4">
                                <label class="col-form-label" for="role_position">Designation<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="resourceDesignation" disabled="" required="">
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label">Status<span class="text-danger">*</span></label>
                                <select class="form-control form-select" name="status">
                                    <option>To Do</option>
                                    <option> In Progress</option>
                                    <option>Completed</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="col-form-label">Notes/Comments</label>
                                <textarea class="form-control" rows="3" name="notes" id="description" placeholder=""></textarea>
                            </div>
                        </div>
                        <div class="text-center py-3">
                            <button type="reset" class="btn btn-secondary btn-rounded">Reset</button>
                            <button type="save" class="border-0 btn btn-primary btn-gradient-primary btn-rounded">Save</button>&nbsp;&nbsp;
                            
                        </div>
                    </form>
                </div>
            </div>
            <!-- /Content End -->
            <!-- Milestones Table -->
            <div class="card-body card" id="Asigned-team-section" style="display:none;">
                <h4 class="mt-3">Assigned Tasks</h4>
                <table class="table table-striped table-nowrap" id="asigned-table">
                    <thead>
                        <tr>
                            <th class="text-center">Sr</th>
                            <th class="text-center">Project Name</th>
                            <th class="text-center">Task name</th>
                            <th class="text-center">Consultant Name</th>
                            <th class="text-center">Email</th>
                            {{-- <th class="text-center">Rate</th> --}}
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="assignedResourcesTableBody"></tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
    // pr change 24-9-25
    let projectId;
    let milestoneId;
    let taskId;

    // pr change 24-9-25
    const resourcesDropdown = document.getElementById('assigned-toresource');

    document.addEventListener('DOMContentLoaded', function () {
        const projectSelect = document.getElementById('projectSelect');
        const milestonesDropdown = document.getElementById('milestonesDropdown');
        const tasksDropdown = document.getElementById('tasksDropdown');
        // const resourcesDropdown = document.getElementById('assigned-toresource'); rd
        const resourceName = document.getElementById('resourceName');
        const resourceEmail = document.getElementById('resourceEmail');
        const resourceDesignation = document.getElementById('resourceDesignation');

        projectSelect.addEventListener('change', function () {
            // const projectId = this.value; // rd
            projectId = this.value; // pr change 24-9-25

            // Reset all dependent dropdowns
            milestonesDropdown.innerHTML = '<option value="">Select milestone</option>';
            milestonesDropdown.disabled = true;
            tasksDropdown.innerHTML = '<option value="">Select Task</option>';
            tasksDropdown.disabled = true;
            resourcesDropdown.innerHTML = '<option value="">Select Resource</option>';
            resourcesDropdown.disabled = true;

            if (projectId) {
                // Fetch Milestones
                fetch(`/admin/get-milestones/${projectId}`)
                    .then(response => response.json())
                    .then(data => {
                        let options = '<option value="">Select milestone</option>';
                        data.forEach(milestone => {
                            options += `<option value="${milestone.id}">${milestone.milestone_name}</option>`;
                        });
                        milestonesDropdown.innerHTML = options;
                        milestonesDropdown.disabled = false;
                    })
                    .catch(error => console.error('Error fetching milestones:', error));

                // remove by pr 24-9-25 and add in task drop down
                // // Fetch Resources
                // fetch(`/admin/get-resources/${projectId}`)
                //     .then(response => response.json())
                //     .then(data => {
                //         let options = '<option value="">Select Resource</option>';
                        
                //         // data.resources.forEach(resource => {
                //         //    options += `<option value="${resource.consultant_id}">${resource.consultant.first_name} ${resource.consultant.last_name} (${resource.consultant.email}) ${resource.consultant.username}</option>`;
                //         //     options  += `<option value="${resource.project.project_manager_id}">Project Manager</option>`; //after added 
                //         // }); // RD

                //         /* pranav */
                //         data.resources.forEach((item) => {
                //             options += `<option value="${item.consultant_id}">${item.consultant.first_name} ${item.consultant.last_name} (${item.consultant.email}) ${item.consultant.username}</option>`;
                //         });

                //         data.resourcesPM.forEach((item) => {
                //             options += `<option value="${item.project.project_manager_id}">${item.project.manager.first_name} ${item.project.manager.last_name} (${item.project.manager.email}) ${item.project.manager.username} (PM)</option>`;
                //         }); 
                //         /* /pranav */
                //         resourcesDropdown.innerHTML = options;
                //         resourcesDropdown.disabled = false;
                //     })
                //     .catch(error => console.error('Error fetching resources:', error));
            }
        });

        milestonesDropdown.addEventListener('change', function () {
            // const milestoneId = this.value; // rd
            milestoneId = this.value; // pr change 24-9-25

            // Reset tasks dropdown
            tasksDropdown.innerHTML = '<option value="">Select Task</option>';
            tasksDropdown.disabled = true;

            if (milestoneId) {
                fetch(`/admin/get-tasks/${milestoneId}`)
                    .then(response => response.json())
                    .then(data => {
                        let options = '<option value="">Select Task</option>';
                        data.forEach(task => {
                            options += `<option value="${task.id}">${task.task_name}</option>`;
                        });
                        tasksDropdown.innerHTML = options;
                        tasksDropdown.disabled = false;
                    })
                    .catch(error => console.error('Error fetching tasks:', error));
            }
        });
        
        // Resource change event
        resourcesDropdown.addEventListener('change', function () {
            const consultantId = this.value;
            const role = this.options[this.selectedIndex].dataset.role; // pr add 25-9-25

            // Clear fields
            resourceName.value = '';
            resourceEmail.value = '';
            resourceDesignation.value = '';

            if (consultantId) {
                fetch(`/admin/get-resource-details/${consultantId}/${role}`) // pr add role 25-9-25
                    .then(response => response.json())
                    .then(data => {
                        // Now `data` directly contains consultant details
                        resourceName.value = data.first_name || '';
                        resourceEmail.value = data.email || '';
                        resourceDesignation.value = data.designation || '';
                    })
                    .catch(error => console.error('Error fetching resource details:', error));
            }
        });

    });
    tasksDropdown.addEventListener('change', function () {
        // const taskId = this.value; // rd
        taskId = this.value; // pr change 24-9-25

        // add pr 24-9-25
        let params = new URLSearchParams({
            project_id: projectId,
            milestone_id: milestoneId,
            task_id: taskId
        });

        if (params) {
            // Fetch Resources
            fetch(`/admin/get-resources?${params.toString()}`)
                .then(response => response.json())
                .then(data => {
                    let options = '<option value="">Select Resource</option>';
                    
                    // data.resources.forEach(resource => {
                    //    options += `<option value="${resource.consultant_id}">${resource.consultant.first_name} ${resource.consultant.last_name} (${resource.consultant.email}) ${resource.consultant.username}</option>`;
                    //     options  += `<option value="${resource.project.project_manager_id}">Project Manager</option>`; //after added 
                    // }); // RD

                    /* pranav */
                    data.resources.forEach((item) => {
                        options += `<option value="${item.consultant_id}" data-role="consultant">${item.consultant.first_name} ${item.consultant.last_name} (${item.consultant.email}) ${item.consultant.username}</option>`;
                    });

                    data.resourcesPM.forEach((item) => {
                        options += `<option value="${item.project.project_manager_id}" data-role="project_manager">${item.project.manager.first_name} ${item.project.manager.last_name} (${item.project.manager.email}) ${item.project.manager.username} (PM)</option>`;
                    }); 
                    /* /pranav */
                    resourcesDropdown.innerHTML = options;
                    resourcesDropdown.disabled = false;
                })
                .catch(error => console.error('Error fetching resources:', error));
        }
        // /add pr 24-9-25

        if (taskId) {
            fetch(`/admin/get-assigned-tasks/${taskId}`)
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.getElementById('assignedResourcesTableBody');
                    tableBody.innerHTML = ''; // Clear previous data

                    data.forEach((task, index) => {
                        const row = `<tr>
                            <td class="text-center">${index + 1}</td>
                            <td class="text-center">${task.project_name}</td>
                            <td class="text-center">${task.task_name}</td>
                            <td class="text-center">${task.consultant_name}</td>
                            <td class="text-center">${task.consultant_email}</td>
                            <td class="text-center">
                                <form action="/admin/delete-assigned-task/${task.id}" method="POST" onsubmit="return confirm('Are you sure you want to Delete This?');">
                                        <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fa-solid fa-trash" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"></i> Remove
                                        </button>
                                </form>
                            </td>
                        </tr>`;
                        tableBody.insertAdjacentHTML('beforeend', row);
                    });
                    
                    document.getElementById('Asigned-team-section').style.display = 'block';
                })
                .catch(error => console.error('Error fetching assigned tasks:', error));
        } else {
            document.getElementById('Asigned-team-section').style.display = 'none';
        }
    });

    </script>
@endsection
