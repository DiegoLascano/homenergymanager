@section('sidebar')
    <aside class="sidebar md:fixed md:h-full md:flex-none">
        <ul class="sidebar-list list-reset flex flex-col">
            <h5 class="font-thin text-xs text-grey-050 pl-5 pt-6 pb-2">Dashboards</h5>
            <li class="sidebar-item {{Request::is('dashboard') ? 'active' : ''}}">
                <a href="/dashboard" class="sidebar-link">
                    @svg('icon-dashboard', ['class' => 'icon-24 -my-1 mr-3'])Dashboard
                </a>
            </li>
            <li class="sidebar-item {{Request::is('historical') ? 'active' : ''}}">
                <a href="/historical" class="sidebar-link">
                    @svg('icon-clouds', ['class' => 'icon-24 -my-1 mr-3'])Historico
                </a>
            </li>
            <li class="sidebar-item {{Request::is('trends') ? 'active' : ''}}">
                <a href="/trends" class="sidebar-link">
                    @svg('icon-chart', ['class' => 'icon-24 -my-1 mr-3'])Trends
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
    </aside>
@show