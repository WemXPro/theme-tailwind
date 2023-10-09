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
    @include(Theme::path('layouts.tailwind'))

    @if(Settings::getJson('encrypted::captcha::cloudflare', 'is_enabled', false))
        @turnstileScripts()
    @endif
</head>

<body class="dark:bg-gray-900">
    <div class="app">
        @yield('container')
    </div>
</body>

</html>
