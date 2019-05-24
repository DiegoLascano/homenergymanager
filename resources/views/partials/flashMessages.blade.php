@if( session('message') )
    <div class="bg-blue">
        {{ session('message') }}
    </div>
@endif