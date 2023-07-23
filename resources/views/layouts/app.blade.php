<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>eRPS - @yield('title')</title>

    <!-- Styles -->
    @include('layouts.partials.styles')
</head>

<body class="crm_body_bg">
    <div id="app">
        @include('layouts.partials.sidebar')

        <section class="main_content dashboard_part">
            @include('layouts.partials.header')

            @yield('content')

            @include('layouts.partials.footer')
        </section>
    </div>

    <!-- Scripts -->
    @include('layouts.partials.scripts')

</body>

</html>
