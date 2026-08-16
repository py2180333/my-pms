@extends('Admin.layouts.master')
@include('Admin.layouts.sidebar')
@include('Admin.layouts.headerMenu')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <div class="crms-title row bg-white">
                <div class="col  p-0">
                    <h3 class="page-title m-0">
                        <span class="page-title-icon bg-gradient-primary text-white me-2">
                            <i class="bi bi-grid"></i>
                        </span>Trashed Projects </h3>
                </div>
                <div class="col p-0 text-end">
                    <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.projects.index')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Trashed Projects</li>
                    </ul>
                </div>
            </div>

            <!-- Page Header -->
            <div class="page-header pt-3 mb-0 ">
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
                <div class="row">
                    <div class="col">
                    </div>
                    <div class="col text-end">
                        <ul class="list-inline-item ps-0">
                            <li class="list-inline-item">
                                <a class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded" href="#">All Trash</a>
                                <a class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded" href="{{ route('admin.projects.create') }}">New Project</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <!-- Content Starts -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-nowrap custom-table mb-0 datatable addexamplesearch">
                                    <thead>
                                        <tr>
                                            <th class="checkBox">
                                                Sr.
                                            </th>
                                            <th class="text-center">Unique Name</th>
                                            <th class="text-center">Project Name</th>
                                            <th class="text-center">Customer</th>
                                            <th class="text-center">Vendor</th>
                                            <th class="text-center">Manager</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Start Date</th>
                                            <th class="text-center">End Date</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($projects as $project)
                                        <tr>
                                            <td class="checkBox">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="text-center">{{ $project->uniquename }}</td>
                                            <td>{{ $project->project_name }}</td>
                                            <td class="text-center">
                                                {{ $project->customer->first_name ?? 'No Customer' }}
                                                 {{ $project->customer->last_name ?? '' }}
                                                 <p>{{ $project->customer->email ?? '' }}</p>
                                            </td>
                                            <td class="text-center">
                                                {{ $project->vendor->first_name ?? 'No Vendor' }}
                                                {{ $project->vendor->last_name ?? '' }}
                                                <p>{{ $project->vendor->email ?? '' }}</p>
                                            </td>
                                            <td class="text-center">
                                                {{ $project->manager->first_name ?? 'No Manager' }} 
                                                {{ $project->manager->last_name ?? '' }}
                                                <p>{{ $project->manager->email ?? '' }}</p>
                                            </td>



                                            <td class="text-center">
                                                <label class="badge badge-gradient-{{ $project->status == 'completed' ? 'success' : 'warning' }}">
                                                    {{ ucfirst($project->status) }}
                                                </label>
                                            </td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($project->start_date)->format('d-m-Y') }}</td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($project->end_date)->format('d-m-Y') }}</td>
                                            <td class="text-center d-flex">
                                                <form action="{{ route('admin.projects.restore', $project->id) }}" method="POST" >
                                                    @csrf
                                                    <button type="button" onclick="confirmRestore(this)" class="ms-2 p-2 fs-6 my_icons btn btn-link text-dark">
                                                        <i class="bi bi-cloud-download" data-bs-toggle="tooltip" data-bs-placement="top" title="Recover"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{-- add better popup --}}
                                <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&display=swap" rel="stylesheet">
                                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                <script>
                                    function confirmRestore(button) {
                                        Swal.fire({
                                            title: "Are you sure?",
                                            text: "Do you want to restore this Project?",
                                            icon: "warning",
                                            showCancelButton: true,
                                            confirmButtonColor: "#3085d6",
                                            cancelButtonColor: "#d33",
                                            confirmButtonText: "Yes, restore it!",
                                            cancelButtonText: "No, cancel!"
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                Swal.fire({
                                                    title: "Restored!",
                                                    text: "The Project has been successfully restored.",
                                                    icon: "success"
                                                }).then(() => {
                                                    // Submit the form after confirmation
                                                    // document.getElementById('restoreForm').submit();
                                                    button.closest('form').submit(); // new -pr 17-7-25
                                                });
                                            }
                                        });
                                    }
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Content End -->
        </div>
        <!-- /Page Content -->
    </div>
    <!-- /Page Wrapper end -->
@endsection