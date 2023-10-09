@extends(Theme::path('auth.wrapper'))

@section('container')
    <section class="bg-white dark:bg-gray-900">
        <div class="grid lg:h-screen lg:grid-cols-2">
            <div class="flex items-center justify-center px-4 py-6 lg:py-0 sm:px-0">

                <form method="POST" action="{{ route('forgot-password.send-email') }}" class="w-full max-w-md space-y-4 md:space-y-6 xl:max-w-xl">
                    @csrf
                    <h1 class="text-xl font-bold text-gray-900 dark:text-white">{!! __('auth.forgot_password') !!}</h1>

                    {{-- include alerts --}}
                    @include(Theme::path('layouts.alerts'))

                    <div>
                        <label for="email"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{!! __('auth.email') !!}</label>
                        <input type="email" name="email" id="email"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                               placeholder="{!! __('auth.enter_email') !!}" required="">
                    </div>

                    <button type="submit"
                            class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        {!! __('auth.request_reset_password') !!}
                    </button>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        {!! __('auth.remember_password') !!}
                        <a href="{{ route('login') }}"
                           class="font-medium text-primary-600 hover:underline dark:text-primary-500">
                            {!! __('auth.sign_in') !!}
                        </a>
                    </p>
                </form>
            </div>
            <div class="flex items-center justify-center px-4 py-6 bg-primary-600 lg:py-0 sm:px-0">
                <div class="max-w-md xl:max-w-xl">
                    <a href="#" class="flex items-center mb-4 text-2xl font-semibold text-white">
                        <img class="w-8 h-8 mr-2" src="@settings('logo', 'https://imgur.com/oJDxg2r.png')"
                             alt="logo">
                        @settings('app_name', 'WemX')
                    </a>
                    <h1 class="mb-4 text-3xl font-extrabold leading-none tracking-tight text-white xl:text-5xl">@settings('theme::default::auth::title', 'Your Game, Our World: Hosting Perfected')</h1>
                    <p class="mb-4 font-light text-primary-200 lg:mb-8">@settings('theme::default::auth::description', 'Here you might want to explain how everything works. You can edit this in Admin -> configuration -> Theme Settings')
                    </p>
                    <div class="flex items-center divide-x divide-primary-500">
                        <div class="flex pr-3 -space-x-4 sm:pr-5">
                            <img class="w-10 h-10 border-2 border-white rounded-full"
                                 src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/bonnie-green.png"
                                 alt="bonnie avatar">
                            <img class="w-10 h-10 border-2 border-white rounded-full"
                                 src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png"
                                 alt="jese avatar">
                            <img class="w-10 h-10 border-2 border-white rounded-full"
                                 src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/roberta-casas.png"
                                 alt="roberta avatar">
                            <img class="w-10 h-10 border-2 border-white rounded-full"
                                 src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/thomas-lean.png"
                                 alt="thomas avatar">
                        </div>
                        <div class="pl-3 text-white sm:pl-5 dark:text-white">
                            <span
                                class="text-sm text-primary-200">@settings('theme::default::auth::customers', 'Join over 3.2k members')</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
