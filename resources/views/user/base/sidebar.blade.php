<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="{{route('user')}}">{{Auth()->user()->name}}</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{route('user')}}">DS</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Layanan</li>
        <li class=active><a class="nav-link" href="{{route('remote')}}"><i class="fa-solid fa-ethernet"></i><span>Remote</span></a></li>
        <li class=active><a class="nav-link" href="{{route('tunnel')}}"><i class="fa-solid fa-diagram-project"></i><span>Tunnel</span></a></li>
    </ul> 
 </aside>
