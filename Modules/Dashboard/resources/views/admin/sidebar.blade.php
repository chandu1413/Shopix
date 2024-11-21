{{-- <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
        <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-5 d-none d-sm-inline">Menu</span>
        </a>
        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
            <li class="nav-item">
                <a href="{{url('/dashboard')}}" class="nav-link align-middle px-0">
                    <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                    <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Users</span> </a>
                <ul class="collapse   nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href="{{ route('users.index') }}" class="nav-link px-0"> <span class="d-none d-sm-inline">List</span>  </a>
                    </li>
                    <li>
                        <a href="{{ route('users.create') }}" class="nav-link px-0"> <span class="d-none d-sm-inline">Create</span>  </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#roles" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                    <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Roles</span> </a>
                <ul class="collapse  nav flex-column ms-1" id="roles" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href="{{ route('roles.index') }}" class="nav-link px-0"> <span class="d-none d-sm-inline">List</span>  </a>
                    </li>
                    <li>
                        <a href="{{ route('roles.create') }}" class="nav-link px-0"> <span class="d-none d-sm-inline">Create</span>  </a>
                    </li>
                </ul>
            </li> --}}
            {{-- <li>
                <a href="#" class="nav-link px-0 align-middle">
                    <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Orders</span></a>
            </li> --}}
            {{-- <li>
                <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                    <i class="fs-4 bi-bootstrap"></i> <span class="ms-1 d-none d-sm-inline">Permissions</span></a>
                <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href="{{ route('permission.index') }}" class="nav-link px-0"> <span class="d-none d-sm-inline">List</span> </a>
                    </li>
                    <li>
                        <a href="{{ route('permission.create') }}" class="nav-link px-0"> <span class="d-none d-sm-inline">Create</span>  </a>
                    </li>
                </ul>
            </li> --}}
            
            {{-- <li>
                <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                    <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Products</span> </a>
                    <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 1</a>
                    </li>
                    <li>
                        <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 2</a>
                    </li>
                    <li>
                        <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 3</a>
                    </li>
                    <li>
                        <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 4</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#" class="nav-link px-0 align-middle">
                    <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Customers</span> </a>
            </li> --}}
        {{-- </ul>
        <hr>
        <div class="dropdown pb-4">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
                <span class="d-none d-sm-inline mx-1">loser</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                <li><a class="dropdown-item" href="#">New project...</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Sign out</a></li>

               
            </ul>
        </div>
    </div>
</div> --}}


 
 
   
{{-- <s cript>
function myAccFunc() {
  var x = document.getElementById("demoAcc");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    x.previousElementSibling.className += " w3-green";
  } else { 
    x.className = x.className.replace(" w3-show", "");
    x.previousElementSibling.className = 
    x.previousElementSibling.className.replace(" w3-green", "");
  }
}

function myDropFunc() {
  var x = document.getElementById("demoDrop");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    x.previousElementSibling.className += " w3-green";
  } else { 
    x.className = x.className.replace(" w3-show", "");
    x.previousElementSibling.className = 
    x.previousElementSibling.className.replace(" w3-green", "");
  }
}
</script>

  --}}


  <nav class="sidebar close">
    <header>
      <div class="image-text">
        <span class="image">
          <img src="https://i.postimg.cc/jqgkqhSb/cast-11.jpg" alt="image gallery">
        </span>
  
        <div class="text logo-text">
          <span class="name">ICOM DIGITAL </span>
          <span class="profession">Development</span>
        </div>
      </div>
  
      <i class='bx bx-chevron-right toggle'></i>
    </header>
  
    <div class="menu-bar">
      <div class="menu">
  
        {{-- <li class="search-box">
          <i class='bx bx-search icon'></i>
          <input type="text" placeholder="Search...">
        </li> --}}
  
        <ul class="menu-links">
          <li class="nav-link">
            <a href="#">
              <i class='bx bx-home-alt icon'></i>
              <span class="text nav-text">Dashboard</span>
            </a>
          </li>
  
          <li class="nav-link">
            <a href="{{ route('users.index') }}">
              <i class='bx bxs-user' style='color:#030303' ></i>
              <span class="text nav-text">Users</span>
            </a>
          </li>
          <li>
            <div class="dropdown show">
              <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown link
              </a>
            
              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </div>
          </li>
          <li class="nav-link">
            <a href="#submenu1" data-bs-toggle="collapse" class="">
             <i class='bx bxs-user icon' style='color:#030303' ></i> Users </a>
            <ul class="collapse  " id="submenu1" data-bs-parent="#menu">
                <li class="w-100">
                    <a href="{{ route('users.index') }}" class="   0"> <span class=" ">List</span>  </a>
                </li>
                <li>
                    <a href="{{ route('users.create') }}" class="  "> <span class=" ">Create</span>  </a>
                </li>
            </ul>
          </li>
  
          <li class="nav-link">
            <a class="btn " href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class='bx bx-pie-chart-alt icon'></i>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </a>
          </li>
  
          <li class="nav-link">
            <a href="#">
              <i class='bx bx-heart icon'></i>
              <span class="text nav-text">Likes</span>
            </a>
          </li>
  
          <li class="nav-link">
            <a href="#">
              <i class='bx bx-wallet icon'></i>
              <span class="text nav-text">Wallets</span>
            </a>
          </li>
  
        </ul>
      </div>
  
      <div class="bottom-content">
        <li class="">
          <a href="#">
            <i class='bx bx-log-out icon'></i>
            <span class="text nav-text">Logout</span>
          </a>
        </li>
  
        <li class="mode">
          <div class="sun-moon">
            <i class='bx bx-moon icon moon'></i>
            <i class='bx bx-sun icon sun'></i>
          </div>
          <span class="mode-text text">Dark mode</span>
  
          <div class="toggle-switch">
            <span class="switch"></span>
          </div>
        </li>
  
      </div>
    </div>
  
  </nav>