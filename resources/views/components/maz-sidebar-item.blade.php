@props(['icon', 'link', 'name'])

@php
    $routeName = Request::url();
    $active = str_contains($routeName, strtolower($link));
    $classes = $active ? 'sidebar-item active' : 'sidebar-item';
@endphp

<li class="{{ $classes }} {{ $slot->isEmpty() ? '' : 'has-sub' }}">
    <a href="{{ $slot->isEmpty() ? $link : '#' }}" class='sidebar-link'>
        <i class="{{ $icon }}"></i>
        <span>{{ $name }}</span>
    </a>
    @if (!$slot->isEmpty())
        <ul class="submenu" style="display: {{ $active ? 'block' : 'none' }};">
            {{ $slot }}
        </ul>
    @endif
</li>
