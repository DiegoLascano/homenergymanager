<nav class="h-16 bg-white flex flex-no-wrap justify-between items-center">
    <div class="h-full w-16 md:w-64 flex justify-start items-center bg-cyan-600">
        <a class="mr-1 ml-4" href="{{ url('/dashboard') }}">
            @svg('icon-launch', ['class' => 'icon-36 icon-launch'])
        </a>
        <a class="text-white text-3xl no-underline hidden md:block" href="{{ url('/dashboard') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
    </div>
    <div class="flex flex-1 justify-between mx-6">
        <div class="flex items-center">
            <p class="header-title bg-grey-050 rounded-sm text-grey-400 text-md p-3 hidden lg:block">
                Home Energy Management System
            </p>
        </div>
        <div class="flex items-center">
            @guest
            <div>
                <a class="authentication-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </div>
            <div>
                @if (Route::has('register'))
                    <a class="authentication-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                @endif
            </div>
            @else
                <div class="user-name flex justify-center items-center mx-2 px-2 py-1">
                    <user-control class="relative" url="/api/userControl" icon="icon-user-circle">{{ Auth::user()->name }}</user-control>
                    {{-- <user-control class="relative" url="{{ route('logout') }}" :items="['Appliances', 'Sign Out']" icon="icon-user-circle">{{ Auth::user()->name }}</user-control> --}}
                </div>
                <div>
                    {{-- <a class="text-grey-900 no-underline hover:underline hover:text-grey lowercase" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a> --}}

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            @endguest
            
            <sidebar-button>@svg('icon-menu', ['class' => 'icon-24 icon-menu'])</sidebar-button>
            {{-- <sidebar-button :icon="<h1>Header 1</h1>"></sidebar-button> --}}
        </div>
    </div>
    {{-- </ul> --}}
    {{-- <a href="#" class="text-grey no-underline hover:text-white uppercase text-sm">Sign in</a> --}}
</nav>