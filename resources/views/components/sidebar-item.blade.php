@props(['icon', 'link', 'name'])

@php
    $routeName = Request::url();
    $active = str_contains($routeName, strtolower($link));
    $classes = $active ? 'mm-active' : '';
@endphp

<li class="{{ $classes }} {{ $slot->isEmpty() ? '' : 'has-sub' }}">
    <a href="{{ $slot->isEmpty() ? $link : '#' }}" class="{{ $slot->isEmpty() ? '' : 'has-arrow' }}">
        <i class="{{ $icon }}" style="font-size: 1.4rem;"></i>
        <span>{{ $name }}</span>
    </a>
    @if (!$slot->isEmpty())
        <ul>
            {{ $slot }}
        </ul>
    @endif
</li>
