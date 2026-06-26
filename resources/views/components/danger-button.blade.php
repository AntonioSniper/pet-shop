<button {{ $attributes->merge(['type' => 'submit']) }}
    style="background:#dc2626; color:white; padding:9px 15px; border:none; border-radius:8px; cursor:pointer; font-weight:600;">
    {{ $slot }}
</button>