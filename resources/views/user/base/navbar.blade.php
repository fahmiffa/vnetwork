<div class="mr-auto">
    <ul class="navbar-nav mr-3">
    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>    
    </ul>
</div>
<ul class="navbar-nav navbar-right">
    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
    <img alt="image" src="{{asset('img/avatar/avatar-1.png')}}" class="rounded-circle mr-1">
    <div class="d-sm-none d-lg-inline-block">{{Auth()->user()->name}}</div></a>
    <div class="dropdown-menu dropdown-menu-right">
        <a href="{{route('set')}}" class="dropdown-item has-icon">
        <i class="fas fa-cog"></i> Settings
        </a>
        <div class="dropdown-divider"></div>
        <a href="{{route('logout')}}" class="dropdown-item has-icon text-danger">
        <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>
    </li>
</ul>
    