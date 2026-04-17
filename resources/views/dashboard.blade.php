<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-2xl text-zinc-900 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <p class="mt-1 text-sm text-zinc-600">{{ __('Overview of your ticket board.') }}</p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                <div class="rounded-2xl border border-zinc-200/90 bg-white/90 p-6 shadow-premium backdrop-blur-sm ring-1 ring-black/[0.03]">
                    <p class="text-xs font-bold uppercase tracking-wider text-blue-700">{{ __('Open') }}</p>
                    <p class="mt-2 text-3xl font-bold tabular-nums text-zinc-900">{{ $openCount }}</p>
                </div>
                <div class="rounded-2xl border border-zinc-200/90 bg-white/90 p-6 shadow-premium backdrop-blur-sm ring-1 ring-black/[0.03]">
                    <p class="text-xs font-bold uppercase tracking-wider text-amber-800">{{ __('In progress') }}</p>
                    <p class="mt-2 text-3xl font-bold tabular-nums text-zinc-900">{{ $inProgressCount }}</p>
                </div>
                <div class="rounded-2xl border border-zinc-200/90 bg-white/90 p-6 shadow-premium backdrop-blur-sm ring-1 ring-black/[0.03]">
                    <p class="text-xs font-bold uppercase tracking-wider text-emerald-800">{{ __('Resolved') }}</p>
                    <p class="mt-2 text-3xl font-bold tabular-nums text-zinc-900">{{ $resolvedCount }}</p>
                </div>
            </div>

            <div class="overflow-hidden rounded-2xl border border-zinc-200/90 bg-gradient-to-br from-indigo-600 to-indigo-800 p-8 text-white shadow-premium-lg">
                <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h3 class="text-lg font-bold">{{ __('Tickets board') }}</h3>
                        <p class="mt-1 text-sm text-indigo-100 max-w-xl">{{ __('Open the kanban to create, move, and discuss work in one place.') }}</p>
                    </div>
                    <a href="{{ route('tickets.index') }}" class="inline-flex shrink-0 items-center justify-center rounded-lg bg-white px-5 py-2.5 text-sm font-semibold text-indigo-800 shadow-sm hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-indigo-700">
                        {{ __('Go to board') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
