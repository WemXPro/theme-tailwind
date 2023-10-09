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
