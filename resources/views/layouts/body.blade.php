@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="min-h-screen md:flex">
            <aside class="bg-blue flex-no-shrink p-3">
                @yield('body-sidebar')
            </aside>
            <main class="p-3 md:flex-1">
                @yield('body-main')
            </main>
        </div>
    </div>
@endsection