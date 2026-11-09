@props([
    'title',
    'subtitle' => null,
    'eyebrow' => null,
])

<div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
    <div>
        @if ($eyebrow)
            <p class="text-xs font-semibold uppercase tracking-wider text-indigo-600">{{ $eyebrow }}</p>
        @endif
        <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">{{ $title }}</h1>
        @if ($subtitle)
            <p class="mt-1 text-sm text-slate-500">{{ $subtitle }}</p>
        @endif
    </div>

    @if (trim($slot) !== '')
        <div class="flex items-center gap-2">{{ $slot }}</div>
    @endif
</div>
