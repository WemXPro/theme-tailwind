<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="WemX Billing System">
    <meta name="keywords" content="WemX Panel, Billing Panel,  @yield('keywords')">
    <meta name="author" content="WemX">
    <title>@yield('title') - @settings('app_name', 'WemX')</title>
    <link rel="icon" href="@settings('favicon', 'https://imgur.com/oJDxg2r.png')">
    <!-- Custom CSS -->
    {{-- @vite(['resources/css/app.css','resources/js/app.js']) --}}
    <link rel="stylesheet" href="{{ Theme::get('Default')->assets }}assets/css/custom.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    @include(Theme::path('layouts.tailwind'))
    @yield('header')
</head>

@include(Theme::path('layouts.widgets.require_address'))

<body class="bg-white dark:bg-gray-900" style="min-height: 100vh;display: flex;flex-direction: column;">

    @include(Theme::path('layouts.header'))

    <div class="container mx-auto mt-10 mb-10 mx-auto max-w-screen-xl px-4 md:px-6">
        @include(Theme::path('layouts.alerts'))
        <div class="app">
            @stack('widgets')
            @yield('container')
        </div>
    </div>

    @include(Theme::path('layouts.footer'))
    
</body>

</html>
