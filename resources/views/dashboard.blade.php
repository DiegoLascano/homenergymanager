@extends('layouts.app')

@section('content')
<header>
    <div class="container">
        <div class="header-top">
            <h1>HEMS</h1>
            <a href="#">Sign in</a>
        </div>
        <nav>
            <a href="#">Catalog</a>
            <a href="#">Series</a>
            <a href="#">Podcast</a>
            <a href="#">Discussions</a>
        </nav>
    </div>
</header>
@endsection

{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Wellcome to the Dashboard
                </div>
            </div>
        </div>
    </div>
</div> --}}
