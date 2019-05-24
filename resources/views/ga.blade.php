@extends('layouts.app')

@section('content')
	<h3>Testing features</h3>
	
	<a href="/back">Back</a>

	{{-- <flash-message></flash-message> --}}

	{{-- @if( session('message') )
		<div class="bg-blue">
			{{ session('message') }}
		</div>
	@endif
	@if( session('warning') )
		<div class="bg-yellow">
			{{ session('warning') }}
		</div>
	@endif
	@if( session('error') )
		<div class="bg-red-050">
			{{ session('error') }}
			<br>
			{{ session('type') }}
		</div>
	@endif --}}
@endsection