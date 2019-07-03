@section('sidebar')
    <aside class="sidebar md:fixed md:h-full md:flex-none">
        <sidebar-menu>
            <ul class="sidebar-list list-reset flex flex-col">
                <h5 class="font-thin text-xs text-grey-050 pl-5 pt-6 pb-2">Dashboards</h5>
                <li class="sidebar-item {{Request::is('dashboard') ? 'active' : ''}}">
                    <a href="/dashboard" class="sidebar-link">
                        @svg('icon-dashboard', ['class' => 'icon-24 -my-1 mr-3'])Hoy
                    </a>
                </li>
                <li class="sidebar-item {{Request::is('historical') ? 'active' : ''}}">
                    <a href="/historical" class="sidebar-link">
                        @svg('icon-history', ['class' => 'icon-24 -my-1 mr-3'])Histórico
                    </a>
                </li>
                <li class="sidebar-item {{Request::is('trends') ? 'active' : ''}}">
                    <a href="/trends" class="sidebar-link">
                        @svg('icon-trending-up', ['class' => 'icon-24 -my-1 mr-3'])Gráficas
                    </a>
                </li>
                <li class="sidebar-item {{Request::is('appliances', 'appliances/create') ? 'active' : ''}}">
                    <a href="/appliances" class="sidebar-link">
                        @svg('icon-home', ['class' => 'icon-24 -my-1 mr-3'])Mi instalación
                    </a>
                </li>
                <li class="sidebar-item {{Request::is('schedules') ? 'active' : ''}}">
                    <a href="/schedules" class="sidebar-link">
                        @svg('icon-calendar', ['class' => 'icon-24 -my-1 mr-3'])Mis cronogramas
                    </a>
                </li>
                {{-- <li class="sidebar-item {{Request::is('trends') ? 'active' : ''}}">
                    <svg-icon icon="icon-dots-horizontal" class="icon-24"></svg-icon>
                </li> --}}
                {{-- <li class="sidebar-item {{Request::is('trends') ? 'active' : ''}}">
                    <a href="/dashboard" class="sidebar-link">
                        <svg-icon icon="icon-calendar" class="icon-24 -my-1"></svg-icon>Prueba
                    </a>
                </li> --}}
                {{-- <li class="sidebar-item {{Request::is('trends') ? 'active' : ''}}">
                    <a href="/dashboard" class="sidebar-link">
                        <svg-icon icon="icon-calendar" class="icon-24 -my-1"></svg-icon>Prueba
                    </a>
                    <sidebar-item icon="icon-dashboard" name="Dashboard">Dashboard</sidebar-item>
                </li> --}}
                
            </ul>
        </sidebar-menu>
    </aside>
@show