<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-zinc-900 leading-tight">
            {{ __('Edit ticket') }} — {{ $ticket->title }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-2xl border border-zinc-200/90 bg-white/90 shadow-premium-lg backdrop-blur-sm">
                <div class="border-b border-zinc-200/80 bg-zinc-50/80 px-6 py-4">
                    <p class="text-sm text-zinc-600">{{ __('Update details and move the card across the board.') }}</p>
                </div>
                <div class="p-6 sm:p-8">
                    <form method="POST" action="{{ route('tickets.update', $ticket) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" class="mt-1 block w-full" type="text" name="title" required :value="old('title', $ticket->title)" autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="5" required
                                class="mt-1 block w-full border-zinc-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm">{{ old('description', $ticket->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div>
                                <x-input-label for="type" :value="__('Type')" />
                                <select id="type" name="type" class="mt-1 block w-full border-zinc-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm">
                                    <option value="bug" {{ old('type', $ticket->type) == 'bug' ? 'selected' : '' }}>{{ __('Bug') }}</option>
                                    <option value="feature" {{ old('type', $ticket->type) == 'feature' ? 'selected' : '' }}>{{ __('Feature') }}</option>
                                </select>
                            </div>
                            <div>
                                <x-input-label for="priority" :value="__('Priority')" />
                                <select id="priority" name="priority" class="mt-1 block w-full border-zinc-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm">
                                    <option value="low" {{ old('priority', $ticket->priority) == 'low' ? 'selected' : '' }}>{{ __('Low') }}</option>
                                    <option value="medium" {{ old('priority', $ticket->priority) == 'medium' ? 'selected' : '' }}>{{ __('Medium') }}</option>
                                    <option value="high" {{ old('priority', $ticket->priority) == 'high' ? 'selected' : '' }}>{{ __('High') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div>
                                <x-input-label for="status" :value="__('Status')" />
                                <select id="status" name="status" class="mt-1 block w-full border-zinc-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm">
                                    <option value="open" {{ old('status', $ticket->status) == 'open' ? 'selected' : '' }}>{{ __('Open') }}</option>
                                    <option value="in-progress" {{ old('status', $ticket->status) == 'in-progress' ? 'selected' : '' }}>{{ __('In progress') }}</option>
                                    <option value="resolved" {{ old('status', $ticket->status) == 'resolved' ? 'selected' : '' }}>{{ __('Resolved') }}</option>
                                </select>
                            </div>
                            <div>
                                <x-input-label for="assignee_id" :value="__('Assignee')" />
                                <select id="assignee_id" name="assignee_id" class="mt-1 block w-full border-zinc-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm">
                                    <option value="">{{ __('Unassigned') }}</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('assignee_id', $ticket->assignee_id) == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:items-center sm:justify-between pt-2">
                            <a class="text-center text-sm font-semibold text-indigo-600 hover:text-indigo-800" href="{{ route('tickets.show', $ticket) }}">
                                {{ __('Cancel') }}
                            </a>
                            <x-primary-button type="submit">
                                {{ __('Save changes') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
