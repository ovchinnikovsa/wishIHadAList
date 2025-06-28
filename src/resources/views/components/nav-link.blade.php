@props(['active'])

@php
$classes = ($active ?? false)
            ? 'active'
            : '';
$classes .= ' nav-link';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
