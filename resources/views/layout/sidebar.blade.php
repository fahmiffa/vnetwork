<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
    <a class="nav-link " href="{{route('dashboard')}}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
    </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item"> 
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#" aria-expanded="false"> 
            <i class="bi bi-layout-text-window-reverse"></i><span>Master</span><i class="bi bi-chevron-down ms-auto"></i> 
        </a>
        <ul id="tables-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav" style="">
            <li> <a href="{{route('user.index')}}"> <i class="bi bi-circle"></i><span>User</span> </a></li>
            <li> <a href="{{route('server.index')}}"> <i class="bi bi-circle"></i><span>Server</span> </a></li>
            <li> <a href="{{route('service.index')}}"> <i class="bi bi-circle"></i><span>Service</span> </a></li>            
        </ul>
    </li>

    <li class="nav-item">
        <a class="nav-link " href="{{route('wa')}}">
            <i class="bi bi-whatsapp"></i>
            <span>Whatsapp</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link " href="{{route('order.index')}}">
            <i class="bi bi-cart"></i>
            <span>Order</span>
        </a>
    </li>

</ul>

</aside>
<!-- End Sidebar-->