@props([
    'type' => 'info'
])

@php
    $classes = [
        'success' => 'border-emerald-200 bg-emerald-50 text-emerald-800',
        'warning' => 'border-amber-200 bg-amber-50 text-amber-800',
        'error'   => 'border-rose-200 bg-rose-50 text-rose-800',
        'info'    => 'border-indigo-200 bg-indigo-50 text-indigo-800',
    ];

    $class = $classes[$type] ?? $classes['info'];
@endphp

<div {{ $attributes->merge(['class' => "rounded-xl border px-4 py-3 text-sm $class"]) }} role="alert">
    {{ $slot }}
</div>
