<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-zinc-500">{{ __('Ticket') }} #{{ $ticket->id }}</p>
                <h2 class="font-bold text-xl text-zinc-900 sm:text-2xl leading-tight mt-0.5">
                    {{ $ticket->title }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-8 sm:py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex flex-col gap-3 sm:flex-row sm:flex-wrap sm:items-center sm:justify-between">
                <a href="{{ route('tickets.index') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-indigo-600 hover:text-indigo-800">
                    <span aria-hidden="true">&larr;</span>
                    {{ __('Back to board') }}
                </a>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('tickets.edit', $ticket) }}" class="inline-flex items-center justify-center rounded-lg border border-zinc-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-wide text-zinc-800 shadow-sm hover:bg-zinc-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        {{ __('Edit') }}
                    </a>
                    <form action="{{ route('tickets.destroy', $ticket) }}" method="POST" onsubmit="return confirm(@json(__('Delete this ticket?')));" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center justify-center rounded-lg border border-red-200 bg-red-50 px-4 py-2 text-xs font-semibold uppercase tracking-wide text-red-800 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                            {{ __('Delete') }}
                        </button>
                    </form>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                <div class="lg:col-span-2 space-y-6">
                    <div class="rounded-2xl border border-zinc-200/90 bg-white/90 p-6 sm:p-8 shadow-premium backdrop-blur-sm">
                        <h3 class="text-sm font-bold uppercase tracking-wider text-zinc-500">{{ __('Description') }}</h3>
                        <div class="mt-3">
                            <p class="whitespace-pre-wrap text-zinc-800 leading-relaxed">{{ $ticket->description }}</p>
                        </div>
                    </div>

                    <div class="rounded-2xl border border-zinc-200/90 bg-white/90 shadow-premium backdrop-blur-sm overflow-hidden">
                        <div class="border-b border-zinc-200/80 bg-zinc-50/80 px-6 py-4">
                            <h3 class="text-lg font-bold text-zinc-900">{{ __('Comments') }}</h3>
                        </div>
                        <div class="p-6 sm:p-8 space-y-4">
                            @forelse($ticket->comments as $comment)
                                <div class="rounded-xl border border-zinc-200/80 bg-zinc-50/50 p-4">
                                    <div class="flex flex-wrap justify-between gap-2 text-sm mb-2">
                                        <span class="font-semibold text-zinc-900">{{ $comment->author->name }}</span>
                                        <time class="text-zinc-500 text-xs" datetime="{{ $comment->created_at->toIso8601String() }}">{{ $comment->created_at->diffForHumans() }}</time>
                                    </div>
                                    <p class="text-zinc-700 whitespace-pre-wrap text-sm leading-relaxed">{{ $comment->content }}</p>
                                </div>
                            @empty
                                <p class="text-sm text-zinc-500">{{ __('No comments yet.') }}</p>
                            @endforelse

                            <form method="POST" action="{{ route('comments.store', $ticket) }}" class="pt-4 border-t border-zinc-200/80 space-y-4">
                                @csrf
                                <div>
                                    <x-input-label for="content" :value="__('Add a comment')" />
                                    <textarea id="content" name="content" rows="3" required placeholder="{{ __('Write a comment…') }}"
                                        class="mt-1 block w-full border-zinc-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm"></textarea>
                                    <x-input-error :messages="$errors->get('content')" class="mt-2" />
                                </div>
                                <div class="flex justify-end">
                                    <x-primary-button type="submit">{{ __('Post comment') }}</x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <aside class="space-y-4">
                    <div class="rounded-2xl border border-zinc-200/90 bg-white/90 p-6 shadow-premium backdrop-blur-sm">
                        <h3 class="text-xs font-bold uppercase tracking-wider text-zinc-500 mb-4">{{ __('Details') }}</h3>
                        <dl class="space-y-4 text-sm">
                            <div>
                                <dt class="font-medium text-zinc-500">{{ __('Reporter') }}</dt>
                                <dd class="mt-0.5 text-zinc-900">{{ $ticket->reporter->name }}</dd>
                            </div>
                            <div>
                                <dt class="font-medium text-zinc-500">{{ __('Assignee') }}</dt>
                                <dd class="mt-0.5 text-zinc-900">{{ $ticket->assignee ? $ticket->assignee->name : __('Unassigned') }}</dd>
                            </div>
                            <div>
                                <dt class="font-medium text-zinc-500">{{ __('Status') }}</dt>
                                <dd class="mt-0.5">
                                    <span class="inline-flex rounded-lg bg-zinc-100 px-2.5 py-1 text-xs font-semibold capitalize text-zinc-800 ring-1 ring-zinc-200/80">{{ str_replace('-', ' ', $ticket->status) }}</span>
                                </dd>
                            </div>
                            <div>
                                <dt class="font-medium text-zinc-500">{{ __('Priority') }}</dt>
                                <dd class="mt-0.5 capitalize text-zinc-900">{{ $ticket->priority }}</dd>
                            </div>
                            <div>
                                <dt class="font-medium text-zinc-500">{{ __('Type') }}</dt>
                                <dd class="mt-0.5 capitalize text-zinc-900">{{ $ticket->type }}</dd>
                            </div>
                        </dl>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</x-app-layout>
