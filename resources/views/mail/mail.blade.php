@php
    $user = auth()->user();
@endphp

@if ($user)
    <span class="admin_name">
        Hey, {{ $user->name }}, you are authenticated.
    </span>
@else
    <span class="admin_name">
        Hey, guest, you are not authenticated.
    </span>
@endif
