<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="{{route('dashboard')}}">Dashboard</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">DS</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Master</li>
        <li class="dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Master</span></a>
            <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{route('user.index')}}">User</a></li>
            <li><a class="nav-link" href="{{route('server.index')}}">Server</a></li>
            <li><a class="nav-link" href="{{route('service.index')}}">Service</a></li>
            </ul>
        </li>        
        <li class="dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-gear"></i> <span>Config</span></a>
            <ul class="dropdown-menu">                
                <li><a class="nav-link" href="{{route('wa')}}">Whatsapp</a></li>                                                           
            </ul>
        </li>
        <li class=""><a class="nav-link" href="{{route('order.index')}}"><i class="fa-solid fa-cart-shopping"></i><span>Order</span></a></li>
    </ul> 
 </aside>
