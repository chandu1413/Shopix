<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    {{-- <div class="container-fluid"> --}}
        <!-- Logo -->
        {{-- <a class="navbar-brand" href="{{ route('dashboard') }}">
            <img src="path-to-logo" alt="Logo" class="d-inline-block align-top" height="30">
        </a> --}}
        <a class="nav-link @if(request()->routeIs('dashboard')) active @endif" href="{{ route('dashboard') }}">Dashboard</a>
        <!-- Hamburger -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Navigation Links and Settings Dropdown -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    {{-- <a class="nav-link @if(request()->routeIs('dashboard')) active @endif" href="{{ route('dashboard') }}">Dashboard</a> --}}
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
                        </li>
                        @can('view company')
                        <li class=" ">
                            <a href="{{ route('company.index') }}" class="dropdown-item"> <span class="d-none d-sm-inline">Company</span></a>
                        </li>
                        @endcan
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</a>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        {{-- </div> --}}
    </div>
    