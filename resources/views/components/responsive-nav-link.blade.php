@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full pl-3 pr-4 py-2 border-l-4 border-indigo-600 text-left text-base font-semibold text-indigo-800 bg-indigo-50/80 focus:outline-none focus:text-indigo-900 focus:bg-indigo-100 focus:border-indigo-700 transition duration-150 ease-in-out rounded-r-lg'
            : 'block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-left text-base font-medium text-zinc-600 hover:text-zinc-900 hover:bg-zinc-50 hover:border-zinc-200 focus:outline-none focus:text-zinc-900 focus:bg-zinc-50 focus:border-zinc-300 transition duration-150 ease-in-out rounded-r-lg';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
