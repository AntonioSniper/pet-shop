<button {{ $attributes->merge(['type' => 'button']) }}
    style="background:#6b7280; color:white; padding:9px 15px; border:none; border-radius:8px; cursor:pointer; font-weight:600;">
    {{ $slot }}
</button>