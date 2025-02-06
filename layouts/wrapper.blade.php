<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>@yield('title') - @settings('app_name', 'WemX')</title>
    <link rel="icon" href="@settings('favicon', '/assets/core/img/logo.png')">

    {{-- meta tags --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Meta Description Tag: Affects click-through rates from search results -->
    <meta name="description"
          content="{{ $meta_description ?? settings('seo::description', 'Manage your orders with an easy-to-use Dashboard') }}">
    <meta name="theme-color" content="@settings('seo::color', '#4f46e5')">
    <meta name="keywords" content="{{ $meta_keywords ?? settings('seo::keywords', '') }}">

    <!-- Meta Robots Tag: Controls search engine crawling and indexing -->
    <meta name="robots" content="@settings('seo::robots', 'index, follow')">

    <!-- Open Graph Tags: Enhances visibility and engagement on social media platforms -->
    <meta property="og:title" content="{{ trim($__env->yieldContent('title')) }} - @settings('seo::title', 'WemX')">
    <meta property="og:description"
          content="{{ $meta_description ?? settings('seo::description', 'Manage your orders with an easy-to-use Dashboard') }}">
    <meta property="og:image" content="@settings('seo::image', '/static/wemx.png')">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ theme()::assets('css/custom.css')  }}">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    @if (settings('google::analytics_code'))
        <!-- Google tag (gtag.js) -->
        <script async
                src="https://www.googletagmanager.com/gtag/js?id={{ settings('google::analytics_code') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }

            gtag('js', new Date());

            gtag('config', '{{ settings('google::analytics_code') }}');
        </script>
    @endif

    @include('layouts::tailwind')
    @yield('header')
</head>

<body class="bg-gray-100 dark:bg-gray-900" style="min-height: 100vh;display: flex;flex-direction: column;">
@if(settings('theme::default::navigation', 'navbar') == 'navbar')
    @include('layouts::elements.navbar')
@endif

<div class="container mx-auto mb-10 mt-10 max-w-screen-xl">
    @if(settings('theme::default::navigation', 'navbar') == 'sidebar')
        @include('layouts::elements.sidebar')
    @endif
    @include('layouts::elements.alerts')
    <div class="app">
        @yield('container')
    </div>
</div>



@if (settings('footer::enabled', 1))
    @include('layouts::footer')
@endif

@include('layouts::elements.balance-drawer')
@include('layouts::elements.cookie')
</body>

</html>
