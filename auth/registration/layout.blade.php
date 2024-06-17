@extends(Theme::path('auth.wrapper'))

@section('container')
    <section class="bg-white py-8 dark:bg-gray-900 lg:py-0">
        <div class="lg:flex">
            <div class="bg-primary-600 hidden w-full max-w-md p-12 lg:block lg:h-screen">
                <div class="mb-8 flex items-center space-x-4">
                    <a href="#" class="flex items-center text-2xl font-semibold text-white">
                        <img class="mr-2 h-8 w-8" src="@settings('logo', '/assets/core/img/logo.png')" />
                        @settings('app_name', 'WemX')
                    </a>
                    @guest
                    <a href="{{ route('login') }}" class="text-primary-100 inline-flex items-center text-sm font-medium hover:text-white">
                        <svg class="mr-1 h-6 w-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        {!! __('auth.back_to_login') !!}
                    </a>
                    @endguest
                </div>
                <div class="bg-primary-500 block rounded-lg p-8 text-white">
                    <h2 class="mb-1 text-2xl font-semibold">@settings('theme::default::auth::title', 'Your Game, Our World: Hosting Perfected')
                    </h2>
                    <p class="text-primary-100 mb-4 font-light sm:text-lg">
                        @settings('theme::default::auth::description', 'Here you might want to explain how everything works. You can edit this
                        in Admin -> configuration -> Theme Settings')</p>
                </div>
            </div>
            <div class="mx-auto flex items-center px-4 md:w-[42rem] md:px-8 xl:px-0">
                @yield('content')
            </div>
        </div>
    </section>
@endsection
