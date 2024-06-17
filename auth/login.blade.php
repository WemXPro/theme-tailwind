@extends(Theme::path('auth.wrapper'))

@section('title', __('client.login'))

@section('container')
    <section class="bg-white dark:bg-gray-900">
        <div class="grid lg:h-screen lg:grid-cols-2">
            <div class="flex items-center justify-center px-4 py-6 sm:px-0 lg:py-0">

                <form method="POST" action="{{ route('login.authenticate') }}" class="w-full max-w-md space-y-4 md:space-y-6 xl:max-w-xl">
                    @csrf
                    <h1 class="text-xl font-bold text-gray-900 dark:text-white">{!! __('auth.welcome_back') !!}</h1>
                    <div class="items-center space-x-0 space-y-3 sm:flex sm:space-x-4 sm:space-y-0">

                        @if (Settings::getJson('oauth::google', 'allow_login', false))
                            <a href="{{ route('oauth.login', 'google') }}"
                                class="inline-flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-gray-900 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
                                <svg class="mr-2 h-5 w-5" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_13183_10121)">
                                        <path
                                            d="M20.3081 10.2303C20.3081 9.55056 20.253 8.86711 20.1354 8.19836H10.7031V12.0492H16.1046C15.8804 13.2911 15.1602 14.3898 14.1057 15.0879V17.5866H17.3282C19.2205 15.8449 20.3081 13.2728 20.3081 10.2303Z"
                                            fill="#3F83F8" />
                                        <path
                                            d="M10.7019 20.0006C13.3989 20.0006 15.6734 19.1151 17.3306 17.5865L14.1081 15.0879C13.2115 15.6979 12.0541 16.0433 10.7056 16.0433C8.09669 16.0433 5.88468 14.2832 5.091 11.9169H1.76562V14.4927C3.46322 17.8695 6.92087 20.0006 10.7019 20.0006V20.0006Z"
                                            fill="#34A853" />
                                        <path
                                            d="M5.08857 11.9169C4.66969 10.6749 4.66969 9.33008 5.08857 8.08811V5.51233H1.76688C0.348541 8.33798 0.348541 11.667 1.76688 14.4927L5.08857 11.9169V11.9169Z"
                                            fill="#FBBC04" />
                                        <path
                                            d="M10.7019 3.95805C12.1276 3.936 13.5055 4.47247 14.538 5.45722L17.393 2.60218C15.5852 0.904587 13.1858 -0.0287217 10.7019 0.000673888C6.92087 0.000673888 3.46322 2.13185 1.76562 5.51234L5.08732 8.08813C5.87733 5.71811 8.09302 3.95805 10.7019 3.95805V3.95805Z"
                                            fill="#EA4335" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_13183_10121">
                                            <rect width="20" height="20" fill="white" transform="translate(0.5)" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                {!! __('auth.sign_in_google') !!}
                            </a>
                        @endif
                        @if (Settings::getJson('oauth::discord', 'allow_login', false))
                            <a href="{{ route('oauth.login', 'discord') }}"
                                class="inline-flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-gray-900 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-6 w-6" viewBox="0 0 24 24"
                                    style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;">
                                    <path
                                        d="M14.82 4.26a10.14 10.14 0 0 0-.53 1.1 14.66 14.66 0 0 0-4.58 0 10.14 10.14 0 0 0-.53-1.1 16 16 0 0 0-4.13 1.3 17.33 17.33 0 0 0-3 11.59 16.6 16.6 0 0 0 5.07 2.59A12.89 12.89 0 0 0 8.23 18a9.65 9.65 0 0 1-1.71-.83 3.39 3.39 0 0 0 .42-.33 11.66 11.66 0 0 0 10.12 0q.21.18.42.33a10.84 10.84 0 0 1-1.71.84 12.41 12.41 0 0 0 1.08 1.78 16.44 16.44 0 0 0 5.06-2.59 17.22 17.22 0 0 0-3-11.59 16.09 16.09 0 0 0-4.09-1.35zM8.68 14.81a1.94 1.94 0 0 1-1.8-2 1.93 1.93 0 0 1 1.8-2 1.93 1.93 0 0 1 1.8 2 1.93 1.93 0 0 1-1.8 2zm6.64 0a1.94 1.94 0 0 1-1.8-2 1.93 1.93 0 0 1 1.8-2 1.92 1.92 0 0 1 1.8 2 1.92 1.92 0 0 1-1.8 2z">
                                    </path>
                                </svg>
                                {!! __('auth.sign_in_discord') !!}
                            </a>
                        @endif
                        @if (Settings::getJson('oauth::github', 'allow_login', false))
                            <a href="{{ route('oauth.login', 'github') }}"
                                class="inline-flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-gray-900 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
                                <svg class="-ml-1 mr-2 h-5 w-5" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="github"
                                    role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512">
                                    <path fill="currentColor"
                                        d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3 .3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5 .3-6.2 2.3zm44.2-1.7c-2.9 .7-4.9 2.6-4.6 4.9 .3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3 .7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3 .3 2.9 2.3 3.9 1.6 1 3.6 .7 4.3-.7 .7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3 .7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3 .7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z">
                                    </path>
                                </svg>
                                {!! __('auth.sign_in_github') !!}
                            </a>
                        @endif
                    </div>
                    {{-- <div class="flex items-center">
                        <div class="h-0.5 w-full bg-gray-200 dark:bg-gray-700"></div>
                        <div class="px-5 text-center text-gray-500 dark:text-gray-400">or</div>
                        <div class="h-0.5 w-full bg-gray-200 dark:bg-gray-700"></div>
                    </div> --}}

                    {{-- include alerts --}}
                    @include(Theme::path('layouts.alerts'))

                    <div>

                        <label for="username"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-gray-300">{!! __('auth.email_or_username') !!}</label>
                        <input type="text" name="username" id="username"
                            class="focus:ring-primary-500 focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                            placeholder="{!! __('auth.enter_email_username') !!}" required="">
                    </div>
                    <div>
                        <label for="password"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-gray-300">{!! __('auth.password') !!}</label>
                        <input type="password" name="password" id="password" placeholder="••••••••"
                            class="focus:ring-primary-500 focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                            required="">
                    </div>
                    <div class="flex items-start justify-between">
                        @if (Settings::getJson('encrypted::captcha::cloudflare', 'page_login', false))
                            <div class="flex items-center justify-start">
                                <x-turnstile />
                            </div>
                        @endif
                        <div class="flex items-center justify-end">
                            <a href="{{ route('forgot-password') }}"
                                class="text-primary-600 dark:text-primary-500 text-sm font-medium hover:underline">
                                {!! __('auth.forgot_password') !!}</a>
                        </div>
                    </div>
                    <button type="submit"
                        class="bg-primary-600 hover:bg-primary-700 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 w-full rounded-lg px-5 py-2.5 text-center text-sm font-medium text-white focus:outline-none focus:ring-4">
                        {!! __('auth.sign_in_account') !!}
                    </button>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        {!! __('auth.no_account') !!}
                        <a href="{{ route('register') }}" class="text-primary-600 dark:text-primary-500 font-medium hover:underline">
                            {!! __('auth.sign_up') !!}
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
                                src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/bonnie-green.png"
                                alt="{!! __('bonnie avatar') !!}">
                            <img class="h-10 w-10 rounded-full border-2 border-white"
                                src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png"
                                alt="{!! __('jese avatar') !!}">
                            <img class="h-10 w-10 rounded-full border-2 border-white"
                                src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/roberta-casas.png"
                                alt="{!! __('roberta avatar') !!}">
                            <img class="h-10 w-10 rounded-full border-2 border-white"
                                src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/thomas-lean.png"
                                alt="{!! __('thomas avatar') !!}">
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
