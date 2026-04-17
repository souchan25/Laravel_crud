<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:justify-between sm:items-center">
            <h2 class="font-bold text-2xl text-zinc-900 leading-tight flex items-center gap-3">
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-100 text-indigo-700 ring-1 ring-indigo-200/80">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6"></path></svg>
                </span>
                {{ __('Tickets board') }}
            </h2>
            <a href="{{ route('tickets.create') }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 px-4 py-2.5 text-xs font-semibold uppercase tracking-wide text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                {{ __('New ticket') }}
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">

                @php
                    $columns = [
                        'open' => [
                            'title' => 'Open',
                            'tickets' => $tickets->where('status', 'open'),
                            'dotClass' => 'bg-blue-500 ring-2 ring-blue-500/25',
                            'countClass' => 'bg-blue-100 text-blue-800 ring-1 ring-blue-200/80',
                            'columnClass' => 'rounded-2xl border border-zinc-200/90 bg-white/70 shadow-premium backdrop-blur-sm',
                            'headClass' => 'border-b border-zinc-200/80 bg-white/90',
                            'scrollClass' => 'bg-zinc-50/40',
                            'cardHoverClass' => 'hover:border-blue-300 hover:shadow-premium hover:ring-1 hover:ring-blue-400/25',
                        ],
                        'in-progress' => [
                            'title' => 'In progress',
                            'tickets' => $tickets->where('status', 'in-progress'),
                            'dotClass' => 'bg-amber-500 ring-2 ring-amber-500/25',
                            'countClass' => 'bg-amber-100 text-amber-900 ring-1 ring-amber-200/80',
                            'columnClass' => 'rounded-2xl border border-zinc-200/90 bg-white/70 shadow-premium backdrop-blur-sm',
                            'headClass' => 'border-b border-zinc-200/80 bg-white/90',
                            'scrollClass' => 'bg-zinc-50/40',
                            'cardHoverClass' => 'hover:border-amber-300 hover:shadow-premium hover:ring-1 hover:ring-amber-400/25',
                        ],
                        'resolved' => [
                            'title' => 'Resolved',
                            'tickets' => $tickets->where('status', 'resolved'),
                            'dotClass' => 'bg-emerald-500 ring-2 ring-emerald-500/25',
                            'countClass' => 'bg-emerald-100 text-emerald-900 ring-1 ring-emerald-200/80',
                            'columnClass' => 'rounded-2xl border border-zinc-200/90 bg-white/70 shadow-premium backdrop-blur-sm',
                            'headClass' => 'border-b border-zinc-200/80 bg-white/90',
                            'scrollClass' => 'bg-zinc-50/40',
                            'cardHoverClass' => 'hover:border-emerald-300 hover:shadow-premium hover:ring-1 hover:ring-emerald-400/25',
                        ],
                    ];
                @endphp

                @foreach($columns as $col)
                    <div class="flex flex-col min-h-[500px] h-[calc(100vh-14rem)] {{ $col['columnClass'] }}">
                        <div class="p-4 rounded-t-2xl flex justify-between items-center sticky top-0 z-10 {{ $col['headClass'] }}">
                            <h3 class="text-sm font-bold text-zinc-800 flex items-center gap-2.5">
                                <span class="h-3 w-3 shrink-0 rounded-full {{ $col['dotClass'] }}"></span>
                                {{ $col['title'] }}
                            </h3>
                            <span class="text-xs font-bold tabular-nums px-2.5 py-1 rounded-full {{ $col['countClass'] }}">{{ $col['tickets']->count() }}</span>
                        </div>

                        <div class="p-3 flex-1 overflow-y-auto space-y-3 custom-scrollbar rounded-b-2xl {{ $col['scrollClass'] }}">
                            @forelse($col['tickets'] as $ticket)
                                <a href="{{ route('tickets.show', $ticket) }}" class="block group">
                                    <div class="rounded-xl border border-zinc-200/90 bg-white p-4 shadow-sm ring-1 ring-black/[0.03] transition-all duration-200 group-hover:-translate-y-0.5 {{ $col['cardHoverClass'] }}">
                                        <div class="flex justify-between items-start mb-2 gap-2">
                                            <div>
                                                @if($ticket->type === 'bug')
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-semibold bg-red-50 text-red-800 border border-red-200/80">
                                                        <svg class="mr-1 h-3 w-3 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                                        BUG
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-semibold bg-emerald-50 text-emerald-800 border border-emerald-200/80">
                                                        <svg class="mr-1 h-3 w-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                                        FEATURE
                                                    </span>
                                                @endif
                                            </div>
                                            <span class="text-xs text-zinc-400 font-medium tabular-nums">#{{ $ticket->id }}</span>
                                        </div>

                                        <h4 class="font-bold text-zinc-900 group-hover:text-indigo-700 transition-colors duration-200 mb-1 line-clamp-2 text-sm">{{ $ticket->title }}</h4>
                                        <p class="text-xs text-zinc-500 line-clamp-2 mb-4">{{ $ticket->description }}</p>

                                        <div class="flex items-center justify-between border-t border-zinc-100 pt-3 mt-2">
                                            <div>
                                                @if($ticket->priority === 'high')
                                                    <span class="bg-red-50 text-red-800 border border-red-200/80 px-2 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider" title="{{ __('High priority') }}">HIGH</span>
                                                @elseif($ticket->priority === 'medium')
                                                    <span class="bg-orange-50 text-orange-800 border border-orange-200/80 px-2 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider" title="{{ __('Medium priority') }}">MED</span>
                                                @else
                                                    <span class="bg-blue-50 text-blue-800 border border-blue-200/80 px-2 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider" title="{{ __('Low priority') }}">LOW</span>
                                                @endif
                                            </div>

                                            <div class="flex items-center justify-end gap-2">
                                                <div class="flex items-center gap-1 text-zinc-400">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                                                    <span class="text-[10px] font-bold tabular-nums">{{ $ticket->comments->count() }}</span>
                                                </div>

                                                <div class="h-7 w-7 rounded-full bg-indigo-600 text-white flex items-center justify-center text-[10px] font-bold border-2 border-white shadow-sm ring-1 ring-zinc-200 uppercase" title="{{ $ticket->assignee ? $ticket->assignee->name : __('Unassigned') }}">
                                                    {{ $ticket->assignee ? substr($ticket->assignee->name, 0, 1) : '?' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="text-center p-6 rounded-xl border border-dashed border-zinc-300/90 bg-white/60">
                                    <p class="text-sm text-zinc-500">{{ __('No tickets here.') }}</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
