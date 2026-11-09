@php
    $user = Auth::user();
    $initials = $user
        ? collect(explode(' ', $user->name))->filter()->take(2)
            ->map(fn ($part) => mb_strtoupper(mb_substr($part, 0, 1)))->implode('')
        : null;
    $isStaff = $user?->hasAnyRole(['Admin', 'Staf']) ?? false;

    // Menu web profile (publik)
    $profileLinks = [
        ['label' => 'Beranda',          'route' => 'home'],
        ['label' => 'Profil Mahasiswa', 'route' => 'student'],
        ['label' => 'Proyek',           'route' => 'project'],
        ['label' => 'Agentic AI',       'route' => 'agent'],
        ['label' => 'Tentang',          'route' => 'about'],
    ];

    // Menu fitur akademik (wajib login)
    $appLinks = [
        ['label' => 'Dashboard',      'route' => 'dashboard',  'active' => ['dashboard']],
        ['label' => 'Kalkulator IPK', 'route' => 'ipk.form',   'active' => ['ipk', 'ipk.form']],
        ['label' => 'Kalkulator',     'route' => 'calculator', 'active' => ['calculator']],
    ];

    $profileRoutes = array_column($profileLinks, 'route');
@endphp

<nav x-data="{ open: false }" class="sticky top-0 z-40 bg-white/90 backdrop-blur border-b border-slate-200/70">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-8">
                <!-- Brand -->
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 shrink-0">
                    <x-application-logo class="h-9 w-9" />
                    <span class="hidden sm:block leading-tight">
                        <span class="block text-sm font-bold text-slate-900">ITS Academic</span>
                        <span class="block text-[11px] text-slate-500">Shifa Alya Dewi</span>
                    </span>
                </a>

                <!-- Navigation Links (desktop) -->
                <div class="hidden lg:flex items-center gap-1">
                    @auth
                        @foreach ($appLinks as $link)
                            <x-nav-link :href="route($link['route'])" :active="request()->routeIs(...$link['active'])">
                                {{ $link['label'] }}
                            </x-nav-link>
                        @endforeach

                        <!-- Web profile dikelompokkan di dropdown agar navbar tidak penuh -->
                        <x-dropdown align="left" width="w-56">
                            <x-slot name="trigger">
                                <button @class([
                                    'inline-flex items-center gap-1 rounded-lg px-3 py-2 text-sm transition',
                                    'font-semibold text-indigo-700 bg-indigo-50' => request()->routeIs(...$profileRoutes),
                                    'font-medium text-slate-600 hover:text-slate-900 hover:bg-slate-100' => ! request()->routeIs(...$profileRoutes),
                                ])>
                                    Web Profile
                                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                @foreach ($profileLinks as $link)
                                    <x-dropdown-link :href="route($link['route'])">{{ $link['label'] }}</x-dropdown-link>
                                @endforeach
                            </x-slot>
                        </x-dropdown>
                    @else
                        @foreach ($profileLinks as $link)
                            <x-nav-link :href="route($link['route'])" :active="request()->routeIs($link['route'])">
                                {{ $link['label'] }}
                            </x-nav-link>
                        @endforeach
                    @endauth
                </div>
            </div>

            <!-- Right side (desktop) -->
            <div class="hidden lg:flex items-center gap-3">
                @auth
                    @if ($isStaff)
                        <a href="{{ route('admin.dashboard') }}"
                           class="inline-flex items-center gap-2 rounded-lg bg-slate-900 px-3.5 py-2 text-sm font-semibold text-white hover:bg-slate-700 transition">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7" /></svg>
                            Admin Panel
                        </a>
                    @endif

                    <x-dropdown align="right" width="w-60">
                        <x-slot name="trigger">
                            <button class="flex items-center gap-2 rounded-full p-1 pe-3 hover:bg-slate-100 transition">
                                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-indigo-100 text-xs font-bold text-indigo-700">{{ $initials }}</span>
                                <span class="text-sm font-medium text-slate-700">{{ \Illuminate\Support\Str::words($user->name, 2, '') }}</span>
                                <svg class="h-4 w-4 text-slate-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="px-4 py-3 border-b border-slate-100">
                                <p class="text-sm font-semibold text-slate-900 truncate">{{ $user->name }}</p>
                                <p class="text-xs text-slate-500 truncate">{{ $user->email }}</p>
                            </div>
                            <x-dropdown-link :href="route('profile.edit')">Pengaturan Akun</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" class="!text-rose-600"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    Keluar
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="rounded-lg px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100 transition">
                        Masuk
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500 transition">
                            Daftar
                        </a>
                    @endif
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="flex items-center lg:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-slate-500 hover:bg-slate-100 transition" aria-label="Menu">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden border-t border-slate-200/70 bg-white">
        @auth
            <div class="px-4 pt-3 pb-2 space-y-1">
                <p class="px-3 pb-1 text-[11px] font-semibold uppercase tracking-wider text-slate-400">Akademik</p>
                @foreach ($appLinks as $link)
                    <x-responsive-nav-link :href="route($link['route'])" :active="request()->routeIs(...$link['active'])">{{ $link['label'] }}</x-responsive-nav-link>
                @endforeach
                @if ($isStaff)
                    <x-responsive-nav-link :href="route('admin.dashboard')">Admin Panel &rarr;</x-responsive-nav-link>
                @endif
            </div>
        @endauth

        <div class="px-4 pt-3 pb-3 space-y-1">
            <p class="px-3 pb-1 text-[11px] font-semibold uppercase tracking-wider text-slate-400">Web Profile</p>
            @foreach ($profileLinks as $link)
                <x-responsive-nav-link :href="route($link['route'])" :active="request()->routeIs($link['route'])">{{ $link['label'] }}</x-responsive-nav-link>
            @endforeach
        </div>

        <div class="px-4 py-3 border-t border-slate-200/70">
            @auth
                <div class="flex items-center gap-3 px-3 pb-3">
                    <span class="flex h-9 w-9 items-center justify-center rounded-full bg-indigo-100 text-xs font-bold text-indigo-700">{{ $initials }}</span>
                    <div class="min-w-0">
                        <div class="text-sm font-semibold text-slate-900 truncate">{{ $user->name }}</div>
                        <div class="text-xs text-slate-500 truncate">{{ $user->email }}</div>
                    </div>
                </div>
                <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">Pengaturan Akun</x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        Keluar
                    </x-responsive-nav-link>
                </form>
            @else
                <div class="grid grid-cols-2 gap-2">
                    <a href="{{ route('login') }}" class="rounded-lg border border-slate-200 px-4 py-2 text-center text-sm font-semibold text-slate-700">Masuk</a>
                    <a href="{{ route('register') }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-center text-sm font-semibold text-white">Daftar</a>
                </div>
            @endauth
        </div>
    </div>
</nav>
