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
                        </span> Trashed Project Manager
                    </h3>
                </div>
                <div class="col p-0 text-end">
                    <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.users.ProjectManager.index')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Trashed</li>
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
                    <div class="col text-end">
                        <ul class="list-inline-item ps-0">
                            <li class="list-inline-item">
                                <!-- <button class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded" id="add-task" data-bs-toggle="modal" data-bs-target="#add_project">New Project</button> -->
                                <a class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded" href="{{route('admin.users.ProjectManager.trash')}}">All Trash</a>
                                <a class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded" href="{{route('admin.users.ProjectManager.create')}}">Create ProjectManager</a>
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
                                <table class="table table-striped table-nowrap custom-table mb-0 datatable mydata-table addexamplesearch">
                                    <thead class="text-center">
                                        <tr>
                                            {{-- <th class="checkBox">
                                                <label class="container-checkbox">
                                                    <input type="checkbox">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </th> --}}
                                            <th>Sr.</th>
                                            <th class="checkBox sorting">Manager ID</th>
                                            <th class="checkBox sorting" style="width: 25%;">Profile</th>
                                            <th class="checkBox sorting" style="width: 25%;">Name</th>
                                            <th class="checkBox sorting" style="width: 25%;">Email</th>
                                            <th class="checkBox sorting" style="width: 25%;">Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                        @php
                                        $sr = 1;
                                    @endphp
                                    <tbody class="text-center">
                                        @foreach ($ProjectManagers as $ProjectManager)
                                        <tr>
                                            <td>{{ $sr++ }}</td>
                                            <td>{{$ProjectManager->username}}</td>
                                            <td>
                                                @if($ProjectManager->profile_picture)
                                                    <img src="{{ asset('uploads/ProjectManager/' . $ProjectManager->profile_picture) }}" class="avatar" alt="ProjectManager Photo" />
                                                @else
                                                    <img src="{{ asset('/assets/img/user_profile.png') }}" class="avatar" alt="Default Photo" />
                                                @endif
                                            </td>
                                            <td>{{ $ProjectManager->first_name }} {{$ProjectManager->last_name}}</td>
                                            <td>
                                                <div class="user-email">
                                                    <a href="mailto:{{$ProjectManager->email}}">{{$ProjectManager->email}}</a>
                                                </div>
                                            </td>
                                            <td>
                                                @if ($ProjectManager->status === 'inactive')
                                                    <lable class="badge bg-danger">inactiv<span class="d-none">at</span>e</lable>
                                                @else
                                                    <label class="badge badge-gradient-success">Active</lable> 
                                                @endif
                                            </td>
                                            <td class="text-center d-flex">
                                                <form id="restoreForm" action="{{ route('admin.users.ProjectManager.restore', $ProjectManager->id) }}" method="POST" >
                                                    @csrf
                                                    <button type="button" onclick="confirmRestore()" class="ms-2 p-2 fs-6 my_icons btn btn-link text-dark">
                                                        <i class="bi bi-cloud-download" data-bs-toggle="tooltip" data-bs-placement="top" title="Recover"></i>
                                                    </button>
                                                </form>
                                                {{-- add better popup --}}
                                                <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&display=swap" rel="stylesheet">
                                                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                                <script>
                                                    function confirmRestore() {
                                                        Swal.fire({
                                                            title: "Are you sure?",
                                                            text: "Do you want to restore this ProjectManager?",
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
                                                                    text: "The ProjectManager has been successfully restored.",
                                                                    icon: "success"
                                                                }).then(() => {
                                                                    // Submit the form after confirmation
                                                                    document.getElementById('restoreForm').submit();
                                                                });
                                                            }
                                                        });
                                                    }
                                                </script>

                                                <form action="{{ route('admin.users.ProjectManager.force-delete', $ProjectManager->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to Permanent Delete to ProjectManager?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="ms-2 p-2 fs-6  btn btn-link btn-danger">
                                                        <i class="fa-solid fa-trash text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"></i>
                                                    </button>
                                                </form>

                                                {{-- <a href="#" class="ms-2 p-2 fs-6 my_icons"><i class="bi bi-cloud-download text-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="Recover"></i></a> --}}
                                                {{-- <a href="#" class="ms-2 p-2 fs-6 my_icons"><i class="fa-solid fa-trash text-danger"data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"></i></a> --}}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <!-- <nav aria-label="Table pagination ">
                        <ul class="pagination justify-content-end mt-3 mypagination">
                           
                        </ul>
                    </nav> -->
                </div>
            </div>
            <!-- /Content End -->

        </div>
        <!-- /Page Content -->

    </div>
    <!-- /Page Wrapper -->
@endsection