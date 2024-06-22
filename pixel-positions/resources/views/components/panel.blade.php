@php
    $defaultClasses =
        'group rounded-xl border border-transparent bg-white/5 p-4 transition-colors duration-300 hover:cursor-pointer hover:border-blue-800';
@endphp

<div {{ $attributes(['class' => $defaultClasses]) }}>
    {{ $slot }}
</div>
