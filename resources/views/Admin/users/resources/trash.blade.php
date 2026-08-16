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
                        </span> Trashed Resources
                    </h3>
                </div>
                <div class="col p-0 text-end">
                    <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.users.Resources.index')}}">Dashboard</a></li>
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
                                <a class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded" href="{{route('admin.users.Resources.trash')}}">All Trash</a>
                                <a class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded" href="{{route('admin.users.Resources.create')}}">Create ProjectManager</a>
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
                                            <th>Sr.No</th>
                                            <th class="checkBox sorting">Resource ID</th>
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
                                        @foreach ($Resources as $Resource)
                                        <tr>
                                            <td>{{ $sr++ }}</td>
                                            <td>{{$Resource->username}}</td>
                                            <td>
                                                @if($Resource->profile_picture)
                                                    <img src="{{ asset('uploads/resources/' . $Resource->profile_picture) }}" class="avatar" alt="ProjectManager Photo" />
                                                @else
                                                    <img src="{{ asset('/assets/img/user_profile.png') }}" class="avatar" alt="Default Photo" />
                                                @endif
                                            </td>
                                            <td>{{ $Resource->first_name }} {{$Resource->last_name}}</td>
                                            <td>
                                                <div class="user-email">
                                                    <a href="mailto:{{$Resource->email}}">{{$Resource->email}}</a>
                                                </div>
                                            </td>
                                            <td>
                                                @if ($Resource->status === 'inactive')
                                                    <lable class="badge bg-danger">inactiv<span class="d-none">at</span>e</lable>
                                                @else
                                                    <label class="badge badge-gradient-success">Active</lable> 
                                                @endif
                                            </td>
                                            <td class="text-center d-flex">
                                                <form action="{{ route('admin.users.Resources.restore', $Resource->id) }}" method="POST" >
                                                    @csrf
                                                    <button type="button" onclick="confirmRestore(this)" class="ms-2 fs-6 my_icons mailstone-action btn " style="padding:6px 10px;">
                                                        <i class="bi bi-cloud-download" data-bs-toggle="tooltip" data-bs-placement="top" title="Recover"></i>
                                                    </button>
                                                </form>

                                                <form action="{{ route('admin.users.Resources.force-delete', $Resource->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to Permanent Delete to ProjectManager?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="ms-2 p-2 fs-6 my_icons btn btn-link btn-danger delete-action">
                                                        <i class="fa-solid fa-trash text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"></i>
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
                                            text: "Do you want to restore this Resource?",
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
                                                    text: "The Resource has been successfully restored.",
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