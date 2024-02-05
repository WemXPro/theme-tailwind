@extends(Theme::path('auth.wrapper'))

@section('title', __('auth.reauth'))

@section('container')
    <div class="pt:mt-0 mx-auto flex flex-col items-center justify-center px-6 pt-8 dark:bg-gray-900 md:h-screen">
        <a href="../../" class="mb-8 flex items-center justify-center text-2xl font-semibold dark:text-white lg:mb-10">
            @if (Settings::has('logo'))
                <img src="@settings('logo')" class="mr-4 h-12 rounded" alt="@settings('app_name', 'WemX')" />
            @endif
            <span>@settings('app_name', 'WemX')</span>
        </a>

        <!-- Card -->
        @include(Theme::path('layouts.alerts'))

        <div class="w-full rounded-lg bg-white shadow dark:bg-gray-800 sm:max-w-screen-sm md:mt-0 xl:p-0">
            <div class="w-full p-6 sm:p-8 md:p-16">
                <div class="flex space-x-4">
                    @if (auth()->user()->avatar !== null)
                        <img class="h-10 w-10 rounded-full" src="{{ auth()->user()->avatar() }}" alt="user photo">
                    @else
                        <div
                            class="relative inline-flex h-10 w-10 items-center justify-center overflow-hidden rounded-full bg-gray-100 dark:bg-gray-600">
                            <span class="font-medium text-gray-600 dark:text-gray-300">
                                {{ substr(auth()->user()->first_name, 0, 1) . substr(auth()->user()->last_name, 0, 1) }}
                            </span>
                        </div>
                    @endif
                    <h2 class="mb-3 text-2xl font-bold text-gray-900 dark:text-white lg:text-3xl">
                        {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                    </h2>
                </div>
                <p class="text-base font-normal text-gray-500 dark:text-gray-400">
                    {!! __('auth.re_authenticate_account_desc', ['email' => auth()->user()->email]) !!}
                </p>
                <form class="mt-8 space-y-6" method="POST"
                    @if ($is_admin) action="{{ route('reauthenticate.submit', ['redirect' => $redirect]) }}"
                    @else action="{{ route('client.reauthenticate.post', ['device' => $device->id]) }}" @endif>
                    @csrf
                    <div>
                        <label for="password" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                            {!! __('auth.your_password') !!}</label>
                        <input type="password" name="password" id="password"
                            class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:text-sm"
                            placeholder="••••••••" required="">
                    </div>
                    @if (auth()->user()->TwoFa()->exists())
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
                    @endif
                    <button type="submit"
                        class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 inline-flex w-full items-center justify-center rounded-lg px-5 py-3 text-center text-base font-medium text-white focus:ring-4 sm:w-auto">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10 2a5 5 0 00-5 5v2a2 2 0 00-2 2v5a2 2 0 002 2h10a2 2 0 002-2v-5a2 2 0 00-2-2H7V7a3 3 0 015.905-.75 1 1 0 001.937-.5A5.002 5.002 0 0010 2z">
                            </path>
                        </svg>
                        {!! __('auth.unlock') !!}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
