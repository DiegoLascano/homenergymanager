@component('mail::message')
# Hey

A new Schedule was just generated

{{ $newSchedule }}

@component('mail::button', ['url' => ''])
Home Energy Manager System
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
