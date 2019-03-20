@extends('layouts.app')

@section('content')
    <h1>This is for testing</h1>
    <a href="/schedules">Index</a>
    <form action="/schedules" method="POST">
        @csrf
        <button type="submit">Iniciar</button>
    </form>
@endsection