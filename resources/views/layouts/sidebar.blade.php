<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme no-print">
    <div class="app-brand demo ">
        <a href="" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{asset('assets/img/logo-sjgu.png')}}" height="44">
            </span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Menu</span>
        </li>
        <li class="menu-item  {{ Request::is('home') ? 'active' : '' }}">
            <a href="home" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Dashboards">home</div>
            </a>

        
        </li>
        <li class="menu-item  {{ Request::is('calendar') ? 'active' : '' }}">
        <a href="{{ route('calendar') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-calendar"></i>
            <div data-i18n="Dashboards">Calendar</div>
        </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Service and Package </span>
        </li>
        <li class="menu-item  {{ Request::is('package*') ? 'active' : '' }}">
            <a href="{{ route('package') }}" class="menu-link">
                <i class="menu-icon tf-icons bx  bx-box"></i>
                <div data-i18n="Dashboards">Package</div>
            </a>
        </li>
        <li class="menu-item  {{ Request::is('service*') ? 'active' : '' }}">
            <a href="{{ route('service') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-unite"></i>
                <div data-i18n="Dashboards">Service</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Book</span>
        </li>
        <li class="menu-item  {{ Request::is('event*') ? 'active' : '' }}">
            <a href="{{ route('event') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-calendar"></i>
                <div data-i18n="Dashboards">Events</div>
            </a>
        </li>

        <li class="menu-item  {{ Request::is('booking*') ? 'active' : '' }}">
            <a href="{{ route('booking') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-book-bookmark"></i>
                <div data-i18n="Dashboards">Booking</div>
            </a>
        </li>
       
       

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Config</span>
        </li>
      
        <li class="menu-item  {{ Request::is('roles','profile') ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon bx bxs-lock-alt'></i>
                <div data-i18n="Dashboards">Konfigurasi</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item  {{ Request::is('roles') ? 'active' : '' }}">
                    <a href="/roles" class="menu-link">
                        <div>Roles</div>
                      </a>
                </li>
                <li class="menu-item  {{ Request::is('profile') ? 'active' : '' }}">
                    <a href="{{ url('profile') }}" class="menu-link">
                        <div>User</div>
                      </a>
                </li>
            </ul>
        </li>


    
    
    
        
                
    </ul>



</aside>
<!-- / Menu -->
