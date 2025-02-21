@props(['active'])

@php
    $classes = ($active ?? false)
        ? 'bg-gray-50 text-primary-500'
        : 'text-gray-950 hover:bg-gray-50 hover:text-primary-500';
@endphp

<a {{ $attributes->merge(['class' => 'flex items-center p-2 rounded-md gap-x-3 ' . $classes]) }}>
    {{ $slot }}
</a>
