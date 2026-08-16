
@section('sidebar')
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <form action="search.html" class="mobile-view">
                <input class="form-control" type="text" placeholder="Search here">
                <button class="btn" type="button"><i class="fa fa-search"></i></button>
            </form>
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <li class="nav-item nav-profile">
                        <a href="#" class="nav-link">
                            {{-- <div class="nav-profile-image">
                                <img src="../assets/img/profiles/avatar-17.jpg" alt="profile">
                            </div> --}}
                            <div class="nav-profile-text d-flex flex-column">
                                <span class="font-weight-bold mb-2">{{ Auth::guard('admin')->user()->name }}</span>
                                <span class="text-white text-small">Admin</span>
                            </div>
                            <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                        </a>
                    </li>
                    <li class="menu-title">
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="bi bi-house"></i><span> Dashboard</span> <span
                                class="menu-arrow"></span></a>
                        <ul class="sub-menus">
                            <li><a class="active" href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            {{-- <li><a href="../template/projects-dashboard.html">Projects Dashboard</a></li>
                            <li><a href="../template/leads-dashboard.html">Leads Dashboard</a></li> --}}
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#" class="">
                            <i class="fa-regular fa-square-check"></i>
                            <span>Company Management</span> 
                            <span class="menu-arrow"></span></a>
                            <ul class="sub-menus">
                                <li><a href="{{route('admin.company.create')}}">Create Company</a></li>
                                <li><a href="{{route('admin.company.index')}}">All Comapny</a></li>
                            </ul>
                    </li>
                    <li class="submenu">
                        <a href="#" ><i class="bi bi-person"></i><span>Users</span> <span
                                class="menu-arrow"></span></a>
                                <ul class="sub-menus">
                                    {{-- <li class="submenu sidebar_user_admin">
                                        <a href="#">Admin<span
                                            class="menu-arrow"></span></a>
                                        <ul class="sub-menus">
                                            <li><a href="create_admin.html">Create Admin</a></li>
                                            <li><a href="all_admin.html">All Admin</a></li>
                                        </ul>
                                    </li> --}}
                                    <li class="submenu">
                                        <a href="#">Customer<span
                                            class="menu-arrow"></span></a>
                                        <ul class="sub-menus">
                                            <li><a href="{{ route('admin.users.customers.create') }}">Create Customer</a></li>
                                            <li><a href="{{route('admin.users.customers.index')}}">All Customer</a></li>
                                        </ul>
                                    </li>
                                    <li class="submenu">
                                        <a href="#" >vendor<span
                                            class="menu-arrow"></span></a>
                                        <ul class="sub-menus">
                                            <li><a href="{{route('admin.users.vendors.create')}}">Create vendor</a></li>
                                            <li><a href="{{route('admin.users.vendors.index')}}">All vendor</a></li>
                                        </ul>
                                    </li>
                                    <li class="submenu">
                                        <a href="#">Resource<span
                                            class="menu-arrow"></span></a>
                                        <ul class="sub-menus">
                                            <li><a href="{{route('admin.users.Resources.create')}}">Create Resource</a></li>
                                            <li><a href="{{route('admin.users.Resources.index')}}">All Resource</a></li>
                                        </ul>
                                    </li>
                                    {{-- <li class="submenu">
                                        <a href="#">Project Manager<span
                                            class="menu-arrow"></span></a>
                                        <ul class="sub-menus">
                                            <li>
                                                <a href="{{route('admin.users.ProjectManager.index')}}">All Project Manager</a>
                                            </li>
                                            <li><a href="{{route('admin.users.ProjectManager.create')}}">Create Project Manager</a></li>
                                        </ul>
                                    </li> --}}
                                </ul>
                    </li>
                    
                    <li class="submenu">
                        <a href="#" class=""><i class="bi bi-grid"></i><span>Project Management
                        </span> <span
                                class="menu-arrow"></span></a>
                        <ul class="sub-menus">
                            <li><a class="" href="{{route('admin.projects.index')}}">All Project</a></li>
                            <li><a href="{{route('admin.projects.create')}}">Create Project</a></li>
                            <li><a href="{{route('admin.projects.milestonecreate')}}">Create Milestone</a></li>
                            <li><a href="{{route('admin.projects.assignteam.create')}}">Assign To Team</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#" >
                            <i class="fa-regular fa-square-check"></i><span>Task Management
                        </span> <span
                                class="menu-arrow"></span></a>
                                <ul class="sub-menus">
                                    <li><a  href="{{route('admin.tasks.index')}}">All Tasks</a></li>
                                    <li><a href="{{route('admin.tasks.create')}}">Create Task</a></li>
                                </ul>
                    </li>
                    <li class="submenu">
                        <a href="#" class=""><i class="bi bi-house"></i><span>Resource Management
                        </span> <span
                                class="menu-arrow"></span></a>
                        <ul class="sub-menus">
                            <li><a class="" href="{{route('admin.assigntask.index')}}">All Resource</a></li>
                            <li><a href="{{route('admin.assigntask.create')}}">Assigntask To Resource</a></li>
                            <li><a href="{{route('admin.attendance')}}" class="">Attendance</a></li>
                            <li><a href="{{route('admin.leave')}}" class="">Leave</a></li>
                        </ul>
                    </li>
                    {{-- <li class="submenu">
                        <a href="#" class="">
                            <i class="fa-regular fa-square-check"></i>
                            <span>Timeline Management</span> 
                            <span class="menu-arrow"></span></a>
                            <ul class="sub-menus">
                                <li><a href="../template/tasks.html">All Timeline</a></li>
                                <li><a href="create_timeline.html">Create Timeline</a></li>
                            </ul>
                    </li> --}}
                    
                    <li class="submenu">
                        <a href="#"><i class="bi bi-clipboard"></i><span>Invoices Management</span> <span
                                class="menu-arrow"></span></a>
                        <ul class="sub-menus">
                            <li><a href="{{route('admin.invoice.index')}}">Invoices List</a></li>
                            {{-- <li><a href="../invoice/invoice-grid.html">Invoices Grid</a></li> --}}
                            <li><a href="{{route('admin.invoice.create')}}">Add Invoices</a></li>
                            {{-- <li><a href="../invoice/edit-invoice.html">Edit Invoices</a></li>
                            <li><a href="../invoice/invoice-detiels.html">Invoices Details</a></li>
                            <li><a href="../invoice/invoices-settings.html">Invoices Settings</a></li> --}}
                        </ul>
                    </li>

                    <!-- new pr 7-7-25 -->
                    <li class="submenu">
                        <a href="#" >
                            <i class="fa-regular fa-square-check"></i><span>Reports
                        </span> <span
                                class="menu-arrow"></span></a>
                                <ul class="sub-menus">
                                    <li><a  href="{{route('admin.reports.timesheet.project')}}">Timesheet Project Report</a></li>
                                    <li><a  href="{{route('admin.reports.timesheet.resource')}}">Timesheet Resource Report</a></li>
                                    <li><a  href="{{route('admin.reports.timesheet.company')}}">Timesheet Company Report</a></li>
                                </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div> 
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var currentUrl = window.location.href;
            
            document.querySelectorAll(".sidebar-menu ul li a").forEach(function (link) {
                if (link.href === currentUrl) {
                    link.classList.add("active");
                }
            });
        });
    </script>
@endsection