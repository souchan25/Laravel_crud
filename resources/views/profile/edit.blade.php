<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-2xl text-zinc-900 leading-tight">
                {{ __('Profile') }}
            </h2>
            <p class="mt-1 text-sm text-zinc-600">{{ __('Manage your account and security settings.') }}</p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="overflow-hidden rounded-2xl border border-zinc-200/90 bg-white/90 p-6 sm:p-8 shadow-premium backdrop-blur-sm">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="overflow-hidden rounded-2xl border border-zinc-200/90 bg-white/90 p-6 sm:p-8 shadow-premium backdrop-blur-sm">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="overflow-hidden rounded-2xl border border-zinc-200/90 bg-white/90 p-6 sm:p-8 shadow-premium backdrop-blur-sm">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
