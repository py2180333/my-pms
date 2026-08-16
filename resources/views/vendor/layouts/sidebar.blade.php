
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
                            <div class="nav-profile-text d-flex flex-column">
                                <span class="font-weight-bold mb-2">{{ Auth::guard('vendor')->user()->name }}</span>
                                <span class="text-white text-small">vendor</span>
                            </div>
                            <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                        </a>
                    </li>
                    <li class="menu-title">
                    </li>

                    <!-- Dashboard -->
                    <li class="submenu">
                        <a href="#"><i class="bi bi-house"></i><span> Dashboard</span> <span
                                class="menu-arrow"></span></a>
                        <ul class="sub-menus">
                            <li><a class="active" href="{{route('vendor.dashboard')}}">Dashboard</a></li>
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