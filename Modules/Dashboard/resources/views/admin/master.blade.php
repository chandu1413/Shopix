 
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href=" ">
    <link href="https p" rel="stylesheet" />
      <!-- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

      <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="{{Module::asset('dashboard:css/main.css')}}">
    <link rel="stylesheet" href="{{Module::asset('dashboard:css/sidebar.css')}}">

    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css'>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&amp;display=swap'><link rel="stylesheet" href="./style.css">

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <style>
        /* Custom CSS if needed */
        /* .navbar-brand img {
            height: 30px;
        } */
    
    </style>
    
  

       {{-- Vite CSS  
     { { module_vite('build-dashboard', 'resources/assets/sass/app.scss') }}    --}}
</head>

<body>
    
    @include('dashboard::admin.sidebar')
    
      
      <section class="home">
        <div class="text">Dashboard Sidebar</div>
        @yield('content')
      </section>
      <!-- partial -->
        <script  src="./script.js"></script>
      

{{-- 
    <div class="container-fluid">
        <div class="row flex-nowrap">
            @ include('dashboard::admin.sidebar')
            <div class="col py-3">

                <div>
                    @ include('dashboard::admin.navigation')
                </div>
                <div class="container-fluid">
                    <header class="d-flex justify-content-between align-items-center py-3">
                        <h2 class="font-weight-semibold text-xl text-dark">
                            {{ __('Admin Dashboard') }}
                        </h2>
                        <div>
                            @can('view users')
                                <a href="{{ route('users.index') }}" class="btn btn-slate-700 btn-sm">Users</a>
                            @endcan
                            @can('view roles')
                                <a href="{{ route('roles.index') }}" class="btn btn-slate-700 btn-sm">Roles</a>
                            @endcan
                            @can('view permissions')
                                <a href="{{ route('permission.index') }}" class="btn btn-slate-700 btn-sm">Permissions</a>
                            @endcan
                        </div>
                    </header>
                
                    <div class="py-4">
                        <div class="container">
                            @ yield('content')
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
    </div> --}}
 
    
 

    {{-- Vite JS --}}
    {{-- {{ module_vite('build-dashboard', 'resources/assets/js/app.js') }} --}}

    <!-- partial -->
  {{-- <script  src="{{Module::asset('dashboard:js/sidebarscript.css')}}"></script> --}}
  <script>
    const body = document.querySelector("body"),
  sidebar = body.querySelector("nav"),
  toggle = body.querySelector(".toggle"),
//   menulinks = body.querySelector(".menu-links"),
  searchBtn = body.querySelector(".search-box"),
  modeSwitch = body.querySelector(".toggle-switch"),
  modeText = body.querySelector(".mode-text");

toggle.addEventListener("click", () => {
  sidebar.classList.toggle("close");
});

// menulinks.addEventListener("click", () => {
//   sidebar.classList.toggle("close");
// });

searchBtn.addEventListener("click", () => {
  sidebar.classList.remove("close");
});

modeSwitch.addEventListener("click", () => {
  body.classList.toggle("dark");

  if (body.classList.contains("dark")) {
    modeText.innerText = "Light mode";
  } else {
    modeText.innerText = "Dark mode";
  }
});
  </script>
</body>
</html>
