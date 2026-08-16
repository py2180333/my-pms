@extends('resource.master')
@include('resource.sidebar')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper create_p">
    <!-- Page Content -->
    <div class="content container-fluid">
        <div class="crms-title row bg-white">
            <div class="col p-0">
                <h3 class="page-title m-0">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="bi bi-grid"></i>
                    </span>Assign Resource
                </h3>
            </div>
            <div class="col p-0 text-end">
                <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Assign Resource</li>
                </ul>
            </div>
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
        <!-- Content Starts -->
        <div class="row mt-4">
            <div class="col-md-12">
                <form method="POST" class="needs-validation card" action="{{route('resource.projects.assignteam.store')}}" >
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label class="col-form-label">Select Project<span class="text-danger">*</span></label>
                            <select class="form-control form-select js-states single" id="projectSelectresource" name="project_id" required>
                                <option value="" disabled selected>Select Project</option>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="col-form-label">Select Resource<span class="text-danger">*</span></label>
                            <select class="form-control form-select js-states single" id="assigned-toresource" name="team_id" required disabled>
                                <!-- dynamic data will be appear here using below js -->
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label class="col-form-label">Designation</label>
                            <input type="text" class="form-control" id="resourceDesig" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label class="col-form-label">Name<span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="resourceName" disabled required>
                        </div>
                        <div class="col-md-4">
                            <label class="col-form-label">Email<span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="resourceEmail" disabled required>
                        </div>
                        <div class="col-md-4">
                            <label class="col-form-label">Rate<span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="resourcePay" disabled required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label class="col-form-label">Notes/Comments</label>
                            <textarea class="form-control" rows="3" id="description" name="description" placeholder=""></textarea>
                        </div>
                    </div>
                    <div class="text-center py-3">
                        <button type="submit" class="border-0 btn btn-primary btn-gradient-primary btn-rounded">Assign Team</button>
                    </div>
                  
                </form>
                  <!-- Milestones Table -->
                <div class="card-body card" id="Asigned-team-section" style="display: none;">
                    <h4 class="mt-3">Project Consultant</h4>
                    <table class="table table-striped table-nowrap" id="asigned-table">
                        <thead>
                            <tr>
                                <th class="text-center">Sr</th>
                                <th class="text-center">Project Name</th>
                                <th class="text-center">Consultant Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Rate</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /Content End -->
    </div>
</div>
<!-- page Wrapper end -->
    
    
<script>
document.getElementById('projectSelectresource').addEventListener('change', function() {
    const projectId = this.value;
    document.getElementById('assigned-toresource').disabled = false;

    // Fetch available consultants
    fetch(`/resource/projects/pm/getAvailableConsultants?project_id=${projectId}`)
        .then(response => response.json())
        .then(data => {
            const consultantDropdown = document.getElementById('assigned-toresource');
            consultantDropdown.innerHTML = '<option value="" disabled selected>Select Resource</option>';

            data.forEach(resource => {
                consultantDropdown.innerHTML += `<option data-name="${resource.first_name} ${resource.last_name}" 
                                                    data-email="${resource.email}" data-designation="${resource.designation}"
                                                    data-payment="${resource.rate} ${resource.payment_type}"
                                                    value="${resource.id}">${resource.username} (${resource.email})</option>`;
            });
        });

    fetch(`/resource/projects/pm/getAssignedConsultants?project_id=${projectId}`)
        .then(response => response.json())
        .then(data => {
            const assignedTableBody = document.getElementById('asigned-table').querySelector('tbody');
            assignedTableBody.innerHTML = ''; // Clear existing rows

            if (data.length > 0) {
                data.forEach((item, index) => {
                    const row = `<tr>
                        <td class="text-center">${index + 1}</td>
                        <td class="text-center">${item.project.project_name}</td>
                        <td class="text-center">${item.consultant.first_name} ${item.consultant.last_name}</td>
                        <td class="text-center">${item.consultant.email}</td>
                        <td class="text-center">${item.consultant.rate} ${item.consultant.payment_type}</td>
                        <td class="text-center">
                            <form action="/resource/assignteam/${item.id}/softdelete" method="POST" onsubmit="return confirm('Are you sure you want to Trash This?');">
                                <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fa-solid fa-trash" data-bs-toggle="tooltip" data-bs-placement="top" title="Trash"></i> Remove
                                </button>
                            </form>
                        </td>
                    </tr>`;
                    assignedTableBody.innerHTML += row;
                });

            // Show the assigned section
            document.getElementById('Asigned-team-section').style.display = 'block';
        } else {
            document.getElementById('Asigned-team-section').style.display = 'none';
        }
    });

});

document.getElementById('assigned-toresource').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    
    const resourceName = selectedOption.getAttribute('data-name');
    const resourceEmail = selectedOption.getAttribute('data-email');
    const resourceDesig = selectedOption.getAttribute('data-designation');
    const resourcePay = selectedOption.getAttribute('data-payment');
    
    document.getElementById('resourceName').value = resourceName;
    document.getElementById('resourceEmail').value = resourceEmail;
    document.getElementById('resourceDesig').value = resourceDesig;
    document.getElementById('resourcePay').value = resourcePay;
});
</script>
@endsection
