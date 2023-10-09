@extends(Theme::path('auth.wrapper'))

@section('container')
    <section class="py-8 bg-white dark:bg-gray-900 lg:py-0">
        <div class="lg:flex">
            <div class="hidden w-full max-w-md p-12 lg:h-screen lg:block bg-primary-600">
                <div class="flex items-center mb-8 space-x-4">
                    <a href="#" class="flex items-center text-2xl font-semibold text-white">
                        <img class="w-8 h-8 mr-2" src="@settings('logo', 'https://imgur.com/oJDxg2r.png')" />
                        @settings('app_name', 'WemX')
                    </a>
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center text-sm font-medium text-primary-100 hover:text-white">
                        <svg class="w-6 h-6 mr-1" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        {!! __('auth.back_to_login') !!}
                    </a>
                </div>
                <div class="block p-8 text-white rounded-lg bg-primary-500">
                    <h2 class="mb-1 text-2xl font-semibold">@settings('theme::default::auth::title', 'Your Game, Our World: Hosting Perfected')</h2>
                    <p class="mb-4 font-light text-primary-100 sm:text-lg">
                        @settings('theme::default::auth::description', 'Here you might want to explain how everything works. You can edit this in Admin -> configuration -> Theme Settings')</p>
                </div>
            </div>
            <div class="flex items-center mx-auto md:w-[42rem] px-4 md:px-8 xl:px-0">
                @yield('content')
            </div>
        </div>
    </section>
@endsection
