@extends(Theme::path('auth.wrapper'))

@section('container')
    <section>
        <div class="grid lg:h-screen lg:grid-cols-2">
            <div class="flex items-center justify-center px-4 py-6 sm:px-0 lg:py-0">
                <form method="POST" action="{{ route('2fa.validate.check') }}" class="w-full max-w-md space-y-4 md:space-y-6 xl:max-w-xl">
                    @csrf
                    <div class="flex flex-col items-center space-x-0 space-y-3">
                        <h1 class="mb-6 text-xl font-bold text-gray-900 dark:text-white">{!! __('auth.two_factor_authentication') !!}</h1>
                    </div>

                    @include(Theme::path('layouts.alerts'))

                    <div>

                        <label for="opt"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-gray-300">{!! __('auth.2fa_code') !!}</label>
                        <input type="text" name="OPT" id="opt"
                            class="focus:ring-primary-500 focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                            placeholder="XXXXXX" required="">
                    </div>
                    <div class="flex items-start justify-between">
                        <div class="flex items-center justify-end">
                            <a href="{{ route('2fa.recover') }}"
                                class="text-primary-600 dark:text-primary-500 text-sm font-medium hover:underline">

                                {!! __('auth.lost_access_to_device') !!}
                            </a>
                        </div>
                    </div>
                    <button type="submit"
                        class="bg-primary-600 hover:bg-primary-700 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 w-full rounded-lg px-5 py-2.5 text-center text-sm font-medium text-white focus:outline-none focus:ring-4">
                        {!! __('auth.verify_2fa_code') !!}
                    </button>
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

    <style>
        svg {
            border-radius: 0.25rem;
            width: 250px;
            height: 250px;
        }
    </style>
@endsection
