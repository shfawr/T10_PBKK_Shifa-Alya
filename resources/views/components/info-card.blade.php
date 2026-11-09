@props([
    'label',
    'value'
])

<div {{ $attributes->merge(['class' => 'rounded-xl border border-slate-200 bg-slate-50/60 px-4 py-3.5']) }}>
    <div class="text-xs font-medium uppercase tracking-wide text-slate-500">
        {{ $label }}
    </div>

    <div class="mt-1 font-semibold text-slate-900">
        {{ $value }}
    </div>
</div>
