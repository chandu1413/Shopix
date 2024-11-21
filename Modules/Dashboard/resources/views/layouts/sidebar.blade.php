<div class="container">
    <div class="inner-div">
        {{-- <a href="/" class="link">
            <span class="d-none d-sm-inline">Menu</span>
        </a> --}}

         <!-- Logo -->
         <a class="navbar-brand mb-3" href="{{ route('dashboard') }}">
            <img src="path-to-logo" alt="Logo" class="d-inline-block align-top" height="30">
        </a>

        <ul class="nav" id="menu">
            <li class="nav-item">
                <a href="{{url('/dashboard')}}" class="nav-link">
                    <i class='bx bx-pie-chart-alt icon'></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                </a>
            </li>
            @can('view users')
            <li>
                <a href="#submenu1" data-bs-toggle="collapse" class="nav-link">
                    <i class='bx bx-pie-chart-alt icon'></i> <span class="ms-1 d-none d-sm-inline">Users</span>
                </a>
                <ul class="collapse nav" id="submenu1" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href="{{ route('users.index') }}" class="nav-link"> <span class="d-none d-sm-inline">List</span></a>
                    </li>
                    <li>
                        <a href="{{ route('users.create') }}" class="nav-link"> <span class="d-none d-sm-inline">Create</span></a>
                    </li>
                </ul>
            </li>
            @endcan
            @can('view roles')
            <li>
                <a href="#roles" data-bs-toggle="collapse" class="nav-link">
                    <i class='bx bx-pie-chart-alt icon'></i> <span class="ms-1 d-none d-sm-inline">Roles</span>
                </a>
                <ul class="collapse nav" id="roles" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href="{{ route('roles.index') }}" class="nav-link"> <span class="d-none d-sm-inline">List</span></a>
                    </li>
                    <li>
                        <a href="{{ route('roles.create') }}" class="nav-link"> <span class="d-none d-sm-inline">Create</span></a>
                    </li>
                </ul>
            </li>
           @endcan
           <li>
            <a href="#company" data-bs-toggle="collapse" class="nav-link">
                <i class='bx bx-pie-chart-alt icon'></i> <span class="ms-1 d-none d-sm-inline">Company</span>
            </a>
            <ul class="collapse nav" id="company" data-bs-parent="#menu">
                <li class="w-100">
                    <a href="{{ route('company.index') }}" class="nav-link"> <span class="d-none d-sm-inline">List</span></a>
                </li>
                <li>
                    <a href="{{ route('company.create') }}" class="nav-link"> <span class="d-none d-sm-inline">Create</span></a>
                </li>
                <li>
                    <a href="{{ route('department.index') }}" class="nav-link"> <span class="d-none d-sm-inline">Department Index</span></a>
                </li>
                <li>
                    {{-- <a href="{{ route('department.create') }}" class="nav-link"> <span class="d-none d-sm-inline">Department Create</span></a> --}}
                </li>
            </ul>
        </li>
            @can('view permissions')
            <li>
                <a href="#submenu2" data-bs-toggle="collapse" class="nav-link">
                    <i class='bx bx-pie-chart-alt icon'></i> <span class="ms-1 d-none d-sm-inline">Permissions</span>
                </a>
                <ul class="collapse nav" id="submenu2" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href="{{ route('permission.index') }}" class="nav-link"> <span class="d-none d-sm-inline">List</span></a>
                    </li>
                    <li>
                        <a href="{{ route('permission.create') }}" class="nav-link"> <span class="d-none d-sm-inline">Create</span></a>
                    </li>
                </ul>
            </li>
            @endcan
        </ul>
        <hr>
        <div class="dropdown">
            <a href="#" class="link dropdown-toggle" id="dropdownUser 1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
                <span class="d-none d-sm-inline ms-1">loser</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                <li><a class="dropdown-item" href="#">New project...</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                {{-- <li><a class="dropdown-item" href="#">Sign out</a></li> --}}
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</a>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>