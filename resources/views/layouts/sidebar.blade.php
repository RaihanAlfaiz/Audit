<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme no-print">
    <div class="app-brand demo ">
        <a href="{{ route('home') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{asset('assets/img/home-ballroom.png')}}" height="auto" width="250px">
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
            <a href="{{ route('home') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Dashboards">Home</div>
            </a>

        
        </li>
        <li class="menu-item  {{ Request::is('calendar') ? 'active' : '' }}">
        <a href="{{ route('calendar') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-calendar"></i>
            <div data-i18n="Dashboards">Schedule</div>
        </a>
        </li>
     
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Book</span>
        </li>
   

        <li class="menu-item  {{ Request::is('event*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-calendar"></i>
                <div data-i18n="Dashboards">Events</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item  {{ Request::is('event') ? 'active' : '' }}">
                    <a href="{{ route('event') }}" class="menu-link">
                        <div>Events</div>
                      </a>
                </li>
                <li class="menu-item  {{ Request::is('event/audit','event/create', 'event/edit/*','event/show/*') ? 'active' : '' }}">
                    <a href="{{ route('event.audit') }}" class="menu-link">
                        <div>Auditorium</div>
                      </a>
                </li>
                <li class="menu-item  {{ Request::is('event/lecture','event/createlecture', 'event/lecture/edit/*') ? 'active' : '' }}">
                    <a href="{{ route('event.lecture') }}" class="menu-link">
                        <div>Lecture Theatre</div>
                      </a>
                </li>
              
            </ul>
        </li>

        

        <li class="menu-item  {{ Request::is('booking*') ? 'active' : '' }}">
            <a href="{{ route('booking') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-book-bookmark"></i>
                <div data-i18n="Dashboards">Booking</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Building Management</span>
        </li>

        <li class="menu-item  {{ Request::is('tools*') ? 'active' : '' }}">
            <a href="{{ route('tools') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-buildings"></i>
                <div data-i18n="Dashboards">Tools</div>
            </a>
        </li>
       
       
        {{-- <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Service and Package </span>
        </li> --}}
      
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Config</span>
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
        @if(Auth::user()->hasRole('AD'))
        <li class="menu-item  {{ Request::is('roles*','profile*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon bx bxs-lock-alt'></i>
                <div data-i18n="Dashboards">Configuration</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item  {{ Request::is('roles','roles/edit/*') ? 'active' : '' }}">
                    <a href="/roles" class="menu-link">
                        <div>Roles</div>
                      </a>
                </li>
                <li class="menu-item  {{ Request::is('profile*') ? 'active' : '' }}">
                    <a href="{{ url('profile') }}" class="menu-link">
                        <div>User</div>
                      </a>
                </li>
            </ul>
        </li>
        @endif

    
    
    
        
                
    </ul>



</aside>
<!-- / Menu -->
