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

@if(Settings::get('default::layout', 'stacked') == 'stacked')
    @include(Theme::path('layouts.wrappers.stacked'))
@elseif(Settings::get('default::layout', 'stacked') == 'sidebar')
    @include(Theme::path('layouts.wrappers.sidebar'))
@endif

</html>
