@section('sidebar')
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
           
                <ul>
                    <li class="nav-item nav-profile">
                        <a href="#" class="nav-link">
                            {{-- <div class="nav-profile-image">
                                <img src="../assets/img/profiles/avatar-17.jpg" alt="profile">
                            </div> --}}
                            <div class="nav-profile-text d-flex flex-column">
                                <span class="font-weight-bold mb-2">{{ Auth::guard('resource')->user()->first_name }}</span>
                                <span class="text-white text-small"></span>
                            </div>
                            <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                        </a>
                    </li>
                    <!-- <div class="p-3">
                        <form action="">
                            <input type="search" aria-controls="DataTables_Table_0" id="taskSearch" class="form-control" placeholder="Search tasks...">
                        </form>
                    </div>
                    <li>
                        <div class="d-flex justify-content-evenly mb-4 mt-4">
                            <div data-filter="task" class="rs-task-timesheet-filtter rs-active-filtter">
                                <span >Task</span>
                            </div>
                            <div class="rs-task-timesheet-filtter " data-filter="group-task">
                                <span >Group Task</span>
                            </div>
                            <div class="rs-task-timesheet-filtter" data-filter="other">
                                <span >Other</span>
                            </div>
                        </div>
                    </li> -->
                    <li class="menu-title">
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="bi bi-house"></i><span> Dashboard</span> <span class="menu-arrow"></span></a>
                        <ul class="sub-menus">
                            <li><a href="{{ url("/resource/dashboard") }}">Dashboard</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="bi bi-house"></i><span> Resource</span> <span class="menu-arrow"></span></a>
                        <ul class="sub-menus">
                            <li><a href="{{ route('resource.attendance.index')}}">Attandence</a></li>
                            <li><a href="{{ route('resource.attendance.create')}}">Leave</a></li> <!-- pr -->
                            <!--<li class="submenu">
                                <a class="rs-timesheet-menu" href="{{ url("/resource/timesheet/") }}">Timesheet <span
                                    class="menu-arrow"></span></a>
                                <ul class="sub-menus">
                                    @isset($assignedTasks)
                                    @foreach($assignedTasks as $task)
                                    <li class="mb-2">
                                        <div data-tags="task" class="task-rs-first">
                                            <h5>{{ $task->task->name ?? 'No Task' }}</h5>
                                            <div> 
                                                <p class="4-Low">{{ $task->task->priority ?? 'N/A' }}</p>
                                                <p class="Work-in-progress">{{ $task->status ?? 'N/A' }}</p>
                                                <p class="rs-date-time-task">{{ optional($task->task)->start_date }}</p> 
                                            </div>
                                            <p class="rs-tm">{{ optional($task->task)->end_date }}</p>
                                            <p class="rs-task-name">{{ optional($task->project)->project_name }}</p>
                                        </div>
                                    </li>
                                    @endforeach
                                    @endisset
                                </ul>
                            </li>-->
                        </ul>
                    </li>

                    {{-- pranav --}}
                    <li class="submenu">
                        <a href="#"><i class="bi bi-grid"></i><span>Timesheet</span> <span class="menu-arrow"></span></a>
                        <ul class="sub-menus">
                            @if(Auth::guard('resource')->user()->role == "consultant")
                                <li id="time_sheet_task"><a href="{{route('resource.timesheet.show')}}">Timesheet</a></li>
                                <!-- time_sheet_task to add dynamic data from sidebar_timesheet.js -pranav -->
                            @elseif(Auth::guard('resource')->user()->role == "project_manager")
                                <li id="time_sheet_task"><a href="{{route('resource.timesheet.project_manager.show')}}">Timesheet</a></li>
                                <!-- time_sheet_task to add dynamic data from timesheet_project_manager.js -pranav -->
                            @endif
                        </ul>
                    </li>

                    {{-- pranav --}}
                    <li class="submenu">
                        <a href="#"><i class="bi bi-grid"></i><span>Project Management</span> <span class="menu-arrow"></span></a>
                        <ul class="sub-menus">
                            <li><a href="{{ route('resource.projects.index') }}">All Projects</a></li>
                            @if(Auth::guard('resource')->user()->role == "project_manager")
                                <li><a href="{{route('resource.projects.milestonecreate')}}">Create Milestone</a></li>
                                <li><a href="{{route('resource.projects.assignteam.pm.create')}}">Assign To Team</a></li>
                            @endif
                        </ul>
                    </li>

                    {{-- pranav --}}
                    <li class="submenu">
                        <a href="#"><i class="fa-regular fa-square-check"></i><span>Task Management</span> <span class="menu-arrow"></span></a>
                        <ul class="sub-menus">
                            <li><a href="{{route('resource.tasks.index')}}">All Tasks</a></li>
                            @if(Auth::guard('resource')->user()->role == "project_manager")
                                <li><a href="{{route('resource.tasks.create')}}">Create Task</a></li>
                            @endif
                        </ul>
                    </li>

                    {{-- pranav --}}
                    @if(Auth::guard('resource')->user()->role == "project_manager")
                    <li class="submenu">
                        <a href="#"><i class="bi bi-house"></i><span>Resource Management</span> <span class="menu-arrow"></span></a>
                        <ul class="sub-menus">
                            <li><a href="{{route('resource.assigntask.index')}}">All Resource</a></li>
                            <li><a href="{{route('resource.assigntask.create')}}">Assigntask To Resource</a></li>
                        </ul>
                    </li>
                    @endif

                    {{-- pranav new 31-7-25 --}}
                    @if(Auth::guard('resource')->user()->role == "project_manager")
                    <li class="submenu">
                        <a href="#"><i class="bi bi-clipboard"></i><span>Invoices Management</span> <span class="menu-arrow"></span></a>
                        <ul class="sub-menus">
                            <li><a href="{{ route('resource.invoice.index') }}">Invoices List</a></li>
                        </ul>
                    </li>
                    @endif

                </ul>
            </div>
        </div>
    </div> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" ></script>
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