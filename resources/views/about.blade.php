<x-public-layout :title="__('About Us')">
    <div class="relative overflow-hidden">
        <div class="pointer-events-none absolute inset-0 -z-10">
            <div class="absolute top-0 left-1/2 h-[28rem] w-[48rem] -translate-x-1/2 rounded-full bg-indigo-400/20 blur-3xl"></div>
            <div class="absolute bottom-0 right-0 h-64 w-64 rounded-full bg-violet-300/15 blur-3xl"></div>
        </div>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 sm:pt-14 pb-16 sm:pb-20">
            {{-- Hero --}}
            <div class="relative overflow-hidden rounded-3xl border border-indigo-200/60 bg-gradient-to-br from-indigo-600 via-indigo-700 to-violet-800 p-8 sm:p-12 text-center shadow-premium-lg ring-1 ring-white/10">
                <div class="absolute top-4 right-4 h-24 w-24 rounded-full bg-white/10 blur-2xl sm:top-8 sm:right-8"></div>
                <div class="absolute bottom-4 left-4 h-20 w-20 rounded-full bg-violet-400/20 blur-xl"></div>
                <div class="relative">
                    <span class="inline-flex items-center gap-2 rounded-full bg-white/15 px-4 py-1.5 text-xs font-semibold uppercase tracking-wider text-indigo-100 ring-1 ring-white/20">
                        <svg class="h-4 w-4 text-indigo-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        {{ __('Our team') }}
                    </span>
                    <h1 class="mt-6 text-3xl sm:text-5xl font-bold text-white tracking-tight">
                        {{ __('About Us') }}
                    </h1>
                    <p class="mx-auto mt-4 max-w-2xl text-base sm:text-lg text-indigo-100/95 leading-relaxed">
                        {{ __('We built this application together—blending design, engineering, and data so you can manage work with clarity.') }}
                    </p>
                    @if (count($members) > 0)
                        <p class="mt-6 inline-flex items-center gap-2 rounded-full bg-black/20 px-4 py-2 text-sm font-medium text-white ring-1 ring-white/15">
                            <span class="flex h-2 w-2 rounded-full bg-emerald-400 shadow-[0_0_8px_rgba(52,211,153,0.8)]"></span>
                            {{ count($members) }} {{ count($members) === 1 ? __('team member') : __('team members') }}
                        </p>
                    @endif
                </div>
            </div>

            {{-- Team grid --}}
            <div class="mt-12 sm:mt-16">
                <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-8">
                    <div>
                        <h2 class="text-2xl font-bold text-zinc-900">{{ __('Meet the group') }}</h2>
                        <p class="mt-1 text-zinc-600">{{ __('Names and roles for everyone who contributed to the project.') }}</p>
                    </div>
                </div>

                @php
                    $avatarTones = [
                        'bg-indigo-100 text-indigo-800 ring-indigo-300/50',
                        'bg-violet-100 text-violet-800 ring-violet-300/50',
                        'bg-emerald-100 text-emerald-800 ring-emerald-300/50',
                        'bg-amber-100 text-amber-900 ring-amber-300/50',
                        'bg-rose-100 text-rose-800 ring-rose-300/50',
                    ];
                @endphp

                @if (count($members) > 0)
                    <ul class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3" role="list">
                        @foreach ($members as $index => $member)
                            @php
                                $words = preg_split('/\s+/', trim($member['name']), -1, PREG_SPLIT_NO_EMPTY);
                                $initials = '?';
                                if (count($words) >= 2) {
                                    $initials = strtoupper(mb_substr($words[0], 0, 1) . mb_substr(end($words), 0, 1));
                                } elseif (count($words) === 1 && $words[0] !== '') {
                                    $initials = strtoupper(mb_substr($words[0], 0, min(2, mb_strlen($words[0]))));
                                }
                                $tone = $avatarTones[$index % count($avatarTones)];
                            @endphp
                            <li class="group relative">
                                <div class="h-full rounded-2xl border border-zinc-200/90 bg-white/90 p-6 shadow-premium backdrop-blur-sm ring-1 ring-black/[0.03] transition duration-300 hover:-translate-y-1 hover:shadow-premium-lg hover:border-indigo-200/80 hover:ring-indigo-500/10">
                                    <div class="flex items-start gap-4">
                                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl text-lg font-bold ring-2 ring-offset-2 ring-offset-white {{ $tone }}">
                                            {{ $initials }}
                                        </div>
                                        <div class="min-w-0 flex-1 pt-0.5">
                                            <p class="text-lg font-bold text-zinc-900 leading-snug group-hover:text-indigo-800 transition-colors">
                                                {{ $member['name'] }}
                                            </p>
                                            <p class="mt-3 inline-flex items-center gap-1.5 rounded-lg bg-indigo-50 px-3 py-1.5 text-xs font-semibold uppercase tracking-wide text-indigo-800 ring-1 ring-indigo-200/80">
                                                <svg class="h-3.5 w-3.5 text-indigo-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                </svg>
                                                {{ $member['role'] }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="pointer-events-none absolute inset-x-0 bottom-0 h-1 rounded-b-2xl bg-gradient-to-r from-indigo-500/0 via-indigo-500/40 to-violet-500/0 opacity-0 transition duration-300 group-hover:opacity-100"></div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="rounded-2xl border border-dashed border-zinc-300 bg-zinc-50/80 px-8 py-16 text-center shadow-inner">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-zinc-200/80 text-zinc-500">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <p class="mt-4 text-lg font-semibold text-zinc-800">{{ __('No team members yet') }}</p>
                        <p class="mt-2 text-sm text-zinc-600 max-w-md mx-auto">
                            {{ __('Add your group in') }} <code class="rounded-md bg-white px-2 py-0.5 text-xs font-mono text-zinc-800 ring-1 ring-zinc-200">config/team.php</code>
                        </p>
                    </div>
                @endif
            </div>

            {{-- Bottom CTA strip --}}
            <div class="mt-14 sm:mt-16 rounded-2xl border border-zinc-200/90 bg-white/80 p-6 sm:p-8 shadow-premium backdrop-blur-sm sm:flex sm:items-center sm:justify-between gap-6">
                <div>
                    <h3 class="text-lg font-bold text-zinc-900">{{ __('Explore the app') }}</h3>
                    <p class="mt-1 text-sm text-zinc-600">{{ __('See the ticket board and dashboard your team built.') }}</p>
                </div>
                <div class="mt-4 sm:mt-0 flex flex-wrap gap-3">
                    @auth
                        <a href="{{ route('tickets.index') }}" class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            {{ __('Open tickets') }}
                        </a>
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center rounded-xl border border-zinc-300 bg-white px-5 py-2.5 text-sm font-semibold text-zinc-800 shadow-sm hover:bg-zinc-50">
                            {{ __('Dashboard') }}
                        </a>
                    @else
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                {{ __('Log in') }}
                            </a>
                        @endif
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-xl border border-zinc-300 bg-white px-5 py-2.5 text-sm font-semibold text-zinc-800 shadow-sm hover:bg-zinc-50">
                                {{ __('Register') }}
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-public-layout>
