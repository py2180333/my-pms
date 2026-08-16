@extends('resource.master')
@include('resource.sidebar')
@section('content')
     <!-- Page Wrapper -->
     <div class="page-wrapper create_p">
        <!-- Page Content -->
        <div class="content container-fluid">
            <div class="crms-title row bg-white">
                <div class="col  p-0">
                    <h3 class="page-title m-0">
                        <span class="page-title-icon bg-gradient-primary text-white me-2">
                            <i class="fa-regular fa-square-check"></i>
                        </span>Create Task
                    </h3>
                </div>
                <div class="col p-0 text-end">
                    <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Create Task</li>
                    </ul>
                </div>
            </div>

            <div class="row">
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
            </div>

            <!-- Content Starts -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <form action="{{ route('resource.tasks.store') }}" class="needs-validation card" method="POST">
                        @csrf
                        <h4>Task Details</h4>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label class="col-form-label"> Select Project<span class="text-danger">*</span></label>
                                <select class="form-control form-select js-states single " name="project_id" id="projectSelect" required>
                                    <option value="">Select Project</option>
                                    @foreach($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <div class="inputArea">
                                    <label class="col-form-label">Milestone<span class="text-danger">*</span></label>
                                    <select class="form-control form-select js-states single" name="milestone_id" required id="milestonesDropdown" disabled>
                                        <option value="">Select Milestone</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label class="col-form-label">Task Name<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="task_name" value="{{ old('task_name') }}" id="task-name" required
                                    placeholder="Task Name">
                            </div>
                        </div>
                        <div class="form-group row">
                          
                            <div class="col-sm-4">
                                <label class="col-form-label">Task Description</label>
                                <textarea class="form-control" style="height: 41px;" name="task_discription" id="" placeholder="Task Description">{{ old('task_discription') }}</textarea>
                            </div>
                            <div class="col-sm-4">
                                <label class="col-form-label">Task Status<span class="text-danger">*</span></label>
                                <select class="form-control form-select js-states single" required>
                                    <option>Select Status</option>
                                    <option value="To Do">To Do</option>
                                    <option value="In Progress">In Progress</option>
                                    <option value="Completed">Completed</option>

                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label class="col-form-label ">Priority<span class="text-danger">*</span></label>
                                <select class="form-control form-select js-states single" name="priority" placeholder="Priority">
                                    <option>Select Priority</option>
                                    <option value="low" {{ old('priority') === 'low' ? 'selected' : '' }}>Low</option>
                                    <option value="medium" {{ old('priority') === 'medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="high" {{ old('priority') === 'high' ? 'selected' : '' }}>High</option>

                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label class="col-form-label">Start Date<span class="text-danger">*</span></label>
                                <input id="start_date" class="form-control" style="text-transform: uppercase;" type="date" name="start_date" value="{{ old('start_date') }}" required placeholder="MM/DD/YY">
                            </div>
            
                            <div class="col-sm-4">
                                <label class="col-form-label">End Date<span class="text-danger">*</span></label>
                                <input id="end_date" class="form-control" style="text-transform: uppercase;" type="date" name="end_date" value="{{ old('end_date') }}" required placeholder="MM/DD/YY">
                            </div>
                            <div class="col-sm-4">
                                <label class="col-form-label">Estimated Hours<span class="text-danger">*</span></label>
                                <div class="cal-icon clock">
                                    <div class="timepicker">
                                        <input type="text" name="estimate_hours" value="{{ old('estimate_hours') }}" required class="form-control bg-white" placeholder="Estimated Hours">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label class="col-form-label">Dependencies</label>
                                <input class="form-control" type="text" name="dependencies" value="{{ old('dependencies') }}" id="" placeholder="Dependencies">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label class="col-form-label">Comments/Notes</label>
                                <textarea class="form-control" name="notes" rows="3" id="description" placeholder="Comments/Notes">{{ old('notes') }}</textarea>
                            </div>
                        </div>
                        <div class="text-center py-3">
                            <button type="button" class="btn btn-secondary btn-rounded">Reset</button>
                            <button type="submit"
                                class="border-0 btn btn-primary btn-gradient-primary btn-rounded">Save</button>&nbsp;&nbsp;
                           
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Content End -->
    </div>
    <!-- page Wrapper end -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const projectSelect = document.getElementById("projectSelect");
        const milestonesDropdown = document.getElementById("milestonesDropdown");
        const createMilestoneLink = document.createElement("div");

        // Create a link for creating a new milestone
        createMilestoneLink.innerHTML = `<a href="/resource/projects/milestonecreate" style="color: blue; text-decoration: underline;">Create a new milestone</a>`;
        createMilestoneLink.style.display = "none"; // Initially hidden
        milestonesDropdown.parentNode.appendChild(createMilestoneLink);

        projectSelect.addEventListener("change", function() {
            const projectId = projectSelect.value;

            // Disable and reset the milestones dropdown
            milestonesDropdown.disabled = true;
            milestonesDropdown.innerHTML = '<option value="">Select milestone</option>';
            createMilestoneLink.style.display = "none";

            if (projectId) {
                // Fetch milestones for the selected project
                fetch(`/resource/tasks/${projectId}/milestones`)
                    .then(response => response.json())
                    .then(milestones => {
                        milestonesDropdown.disabled = false;

                        if (milestones.length === 0) {
                            // Show "no milestone" message if none are found
                            milestonesDropdown.innerHTML = '<option value="">No milestones in this project</option>';
                            createMilestoneLink.style.display = "block"; // Show the create milestone link
                        } else {
                            // Populate milestones if available
                            milestones.forEach(milestone => {
                                const option = document.createElement("option");
                                option.value = milestone.id;
                                option.textContent = milestone.milestone_name;
                                milestonesDropdown.appendChild(option);
                            });
                        }
                    })
                    .catch(error => console.error('Error fetching milestones:', error));
            }
        });
    });
    </script>
    
@endsection