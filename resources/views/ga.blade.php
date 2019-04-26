@extends('layouts.app')

@section('content')
	<div class="container">
		<form method="POST" action="/schedules">
			@csrf
			<button class="btn btn-outline" type="submit">Run GA</button>
		</form>
		@include('partials.errors')
	</div>
@endsection