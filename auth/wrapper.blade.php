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
    <meta property="og:title" content="@settings('seo::title', 'WemX')">
    <meta property="og:description"
        content="{{ $meta_description ?? settings('seo::description', 'Manage your orders with an easy-to-use Dashboard') }}">
    <meta property="og:image" content="@settings('seo::image', '/static/wemx.png')">

    <link rel="icon" href="@settings('favicon', '/assets/core/img/logo.png')">
    @include(Theme::path('layouts.tailwind'))

    @if (Settings::getJson('encrypted::captcha::cloudflare', 'is_enabled', false))
        @turnstileScripts()
    @endif
</head>

<body class="bg-gray-100 dark:bg-gray-900">
    <div class="app">
        @yield('container')
    </div>
</body>

</html>
