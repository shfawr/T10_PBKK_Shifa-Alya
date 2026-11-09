<x-app-layout>
    <x-slot name="title">Pengaturan Akun</x-slot>

    <x-slot name="header">
        <x-page-header eyebrow="Akun" title="Pengaturan Akun"
                       subtitle="Kelola informasi profil, password, dan keamanan akunmu." />
    </x-slot>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
      <div class="max-w-3xl space-y-6">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 sm:p-8 shadow-sm">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 sm:p-8 shadow-sm">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="rounded-2xl border border-rose-200 bg-white p-6 sm:p-8 shadow-sm">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
      </div>
    </div>
</x-app-layout>
