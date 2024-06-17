@extends(Theme::path('auth.wrapper'))

@section('title', __('auth.forgot_password'))

@section('container')
    <section class="bg-white dark:bg-gray-900">
        <div class="grid lg:h-screen lg:grid-cols-2">
            <div class="flex items-center justify-center px-4 py-6 sm:px-0 lg:py-0">
                <form method="POST" action="{{ route('forgot-password.send-email') }}" class="w-full max-w-md space-y-4 md:space-y-6 xl:max-w-xl">
                    @csrf
                    <h1 class="text-xl font-bold text-gray-900 dark:text-white">{!! __('auth.forgot_password') !!}</h1>

                    {{-- include alerts --}}
                    @include(Theme::path('layouts.alerts'))

                    <div>
                        <label for="email"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-gray-300">{!! __('auth.email') !!}</label>
                        <input type="email" name="email" id="email"
                            class="focus:ring-primary-500 focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                            placeholder="{!! __('auth.enter_email') !!}" required="">
                    </div>

                    <button type="submit"
                        class="bg-primary-600 hover:bg-primary-700 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 w-full rounded-lg px-5 py-2.5 text-center text-sm font-medium text-white focus:outline-none focus:ring-4">
                        {!! __('auth.request_reset_password') !!}
                    </button>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        {!! __('auth.remember_password') !!}
                        <a href="{{ route('login') }}" class="text-primary-600 dark:text-primary-500 font-medium hover:underline">
                            {!! __('auth.sign_in') !!}
                        </a>
                    </p>
                </form>
            </div>
            <div class="bg-primary-600 flex items-center justify-center px-4 py-6 sm:px-0 lg:py-0">
                <div class="max-w-md xl:max-w-xl">
                    <a href="#" class="mb-4 flex items-center text-2xl font-semibold text-white">
                        <img class="mr-2 h-8 w-8" src="@settings('logo', '/assets/core/img/logo.png')" alt="logo">
                        @settings('app_name', 'WemX')
                    </a>
                    <h1 class="mb-4 text-3xl font-extrabold leading-none tracking-tight text-white xl:text-5xl">
                        @settings('theme::default::auth::title', 'Your Game, Our World: Hosting Perfected')</h1>
                    <p class="text-primary-200 mb-4 font-light lg:mb-8">@settings('theme::default::auth::description', 'Here you might want to
                        explain how everything works. You can edit this in Admin -> configuration -> Theme Settings')
                    </p>
                    <div class="divide-primary-500 flex items-center divide-x">
                        <div class="flex -space-x-4 pr-3 sm:pr-5">
                            <img class="h-10 w-10 rounded-full border-2 border-white"
                                src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/bonnie-green.png" alt="bonnie avatar">
                            <img class="h-10 w-10 rounded-full border-2 border-white"
                                src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png" alt="jese avatar">
                            <img class="h-10 w-10 rounded-full border-2 border-white"
                                src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/roberta-casas.png" alt="roberta avatar">
                            <img class="h-10 w-10 rounded-full border-2 border-white"
                                src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/thomas-lean.png" alt="thomas avatar">
                        </div>
                        <div class="pl-3 text-white dark:text-white sm:pl-5">
                            <span class="text-primary-200 text-sm">@settings('theme::default::auth::customers', 'Join over 3.2k members')</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
