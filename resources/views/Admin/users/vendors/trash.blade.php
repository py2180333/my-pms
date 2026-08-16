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
                        </span> Trashed Vendors
                    </h3>
                </div>
                <div class="col p-0 text-end">
                    <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.users.vendors.index')}}">Vendor Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.users.vendors.trash')}}">Trashed</a></li>
                    </ul>
                </div>
            </div>
            <!-- Content Starts -->
            <div class="row mt-4">
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
                                            <th>Vendors Profile</th>
                                            <th class="checkBox sorting" style="width: 25%;">Vendor Name</th>
                                            <th class="checkBox sorting" style="width: 25%;">Email</th>
                                            <th class="checkBox sorting" style="width: 25%;">Phone Number</th>
                                            <th class="checkBox sorting" style="width: 25%;">Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $sr = 1;
                                    @endphp
                                    <tbody class="text-center">
                                        @foreach ($vendors as $vendor)
                                        <tr>
                                            {{-- <td class="checkBox">
                                                <label class="container-checkbox">
                                                    <input type="checkbox">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td> --}}
                                            <th>{{ $sr++ }}</th>
                                            <td>
                                                @if($vendor->profile_picture)
                                                    <img src="{{ asset('uploads/vendors/' . $vendor->profile_picture) }}" class="avatar" alt="vendor Photo" />
                                                @else
                                                    <img src="{{ asset('/assets/img/user_profile.png') }}" class="avatar" alt="Default Photo" />
                                                @endif
                                            <td>
                                                <a href="#" class="text-decoration-none">{{ $vendor->first_name }} {{$vendor->last_name}}</a>
                                            </td>
                                            <td>
                                                <div class="user-email">
                                                    <a href="mailto:{{ $vendor->email }}">{{ $vendor->email }}</a>
                                                </div>
                                            </td>
                                            <td>{{ $vendor->phone_number }}</td>
                                            <td>
                                                @if ($vendor->status === 'inactive')
                                                <lable class="badge bg-danger">inactiv<span class="d-none">at</span>e</lable>
                                                @else
                                                <label class="badge badge-gradient-success">Active</lable> 
                                                @endif
                                            </td>
                                            <td class="text-center d-flex">
                                                <form action="{{ route('admin.users.vendors.restore', $vendor->id) }}" method="POST" >
                                                    @csrf
                                                    <button type="button" onclick="confirmRestore(this)" class="ms-2 fs-6 my_icons mailstone-action btn " style="padding:6px 10px;">
                                                        <i class="bi bi-cloud-download" data-bs-toggle="tooltip" data-bs-placement="top" title="Recover"></i>
                                                    </button>
                                                </form>
                                                
                                                <form action="{{ route('admin.users.vendors.force-delete', $vendor->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to Permanent Delete to Vendor?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="ms-2 p-2 fs-6 my_icons btn btn-link btn-danger delete-action">
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
                                {{-- add better popup --}}
                                <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&display=swap" rel="stylesheet">
                                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                <script>
                                    function confirmRestore(button) {
                                        Swal.fire({
                                            title: "Are you sure?",
                                            text: "Do you want to restore this vendor?",
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
                                                    text: "The vendor has been successfully restored.",
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
    <!-- /Page Wrapper -->

    <!--user Details Modal -->
    {{-- <div class="modal right fade" id="user-details-modal" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row w-100">
                        <div class="col-md-7 account d-flex">
                            <div>
                                <p class="mb-0">Customer</p>
                                <span class="modal-title">Soiabkhan</span>
                                <span class="rating-star"><i class="fa fa-star" aria-hidden="true"></i></span>
                                <span class="lock"><i class="fa fa-lock" aria-hidden="true"></i></span>
                            </div>

                        </div>
                    </div>
                    <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="task-infos">
                        <div class="tab-content">
                            <div class="tab-pane show active" id="tasks-details">
                                <div class="crms-tasks">
                                    <div class="tasks__item crms-task-item active">
                                        <div class="accordion-header js-accordion-header">Name</div>
                                        <div class="accordion-body js-accordion-body">
                                            <div class="accordion-body__contents">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td class="border-0">Customer ID</td>
                                                            <td class="border-0"> Name</td>
                                                            <td class="border-0">Company</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border-0">SOH1002</td>
                                                            <td class="border-0">SohebKhan Rangrej</td>
                                                            <td class="border-0">xyz</td>
                                                        </tr>
                                                    
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tasks__item crms-task-item">
                                        <div class="accordion-header js-accordion-header"> Contact Information</div>
                                        <div class="accordion-body js-accordion-body">
                                            <div class="accordion-body__contents">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td class="border-0">Email</td>
                                                            <td class="border-0">soheb@gmail.com</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border-0">Phone Number</td>
                                                            <td class="border-0">8585858585</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border-0">National Id</td>
                                                            <td class="border-0">254569875621</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border-0">Address</td>
                                                            <td class="border-0">123, CG Road, Ahmedabad, Gujarat - 380009, India</td>
                                                        </tr>
                                                    
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>  
                                    <div class="tasks__item crms-task-item">
                                        <div class="accordion-header js-accordion-header">Company Contact Information</div>
                                        <div class="accordion-body js-accordion-body">
                                            <div class="accordion-body__contents">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td class="border-0">Company Email</td>
                                                            <td class="border-0">company@gmail.com</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border-0">Company Phone Number</td>
                                                            <td class="border-0">8585858585</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border-0">PAN NO</td>
                                                            <td class="border-0">BAJPC4350M</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border-0">TEX NO</td>
                                                            <td class="border-0">ABC123456TAX</td>
                                                            </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <!-- modal-content -->
        </div>
        <!-- modal-dialog -->
    </div> --}}
    <!-- user Details Modal -->
@endsection