@extends(Theme::path('auth.wrapper'))

@section('title', __('auth.reauth'))

@section('container')
    <div class="flex flex-col justify-center items-center px-6 pt-8 mx-auto md:h-screen pt:mt-0 dark:bg-gray-900">
        <a href="../../" class="flex justify-center items-center mb-8 text-2xl font-semibold lg:mb-10 dark:text-white">
            @if (Settings::has('logo'))
                <img src="@settings('logo')" class="mr-4 h-12 rounded" alt="@settings('app_name', 'WemX') Logo" />
            @endif
            <span>@settings('app_name', 'WemX')</span>
        </a>
        <!-- Card -->
        @include(Theme::path('layouts.alerts'))

        <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-screen-sm xl:p-0 dark:bg-gray-800">
            <div class="p-6 w-full sm:p-8 md:p-16">
                <div class="flex space-x-4">
                    @if (auth()->user()->avatar !== null)
                        <img class="w-10 h-10 rounded-full" src="{{ auth()->user()->avatar() }}" alt="user photo">
                    @else
                        <div
                            class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                            <span
                                class="font-medium text-gray-600 dark:text-gray-300">{{ substr(auth()->user()->first_name, 0, 1) . substr(auth()->user()->last_name, 0, 1) }}</span>
                        </div>
                    @endif
                    <h2 class="mb-3 text-2xl font-bold text-gray-900 lg:text-3xl dark:text-white">
                        {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h2>
                </div>
                <p class="text-base font-normal text-gray-500 dark:text-gray-400">
                    {!! __('auth.re_authenticate_account_desc', ['email' => auth()->user()->email]) !!}
                </p>
                <form class="mt-8 space-y-6" method="POST"
                    @if ($is_admin) action="{{ route('reauthenticate.submit', ['redirect' => $redirect]) }}" @else action="{{ route('client.reauthenticate.post', ['device' => $device->id]) }}" @endif>
                    @csrf
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            {!! __('auth.your_password') !!}</label>
                        <input type="password" name="password" id="password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="••••••••" required="">
                    </div>
                    @if(auth()->user()->TwoFa()->exists())
                    <div>
                        <label for="opt"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{!! __('auth.2fa_code') !!}</label>
                        <input type="text" name="OPT" id="opt"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                            placeholder="XXXXXX" required="">
                    </div>
                    <div class="flex justify-between items-start">
                        <div class="flex items-center justify-end">
                            <a href="{{ route('2fa.recover') }}"
                               class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">
    
                                 {!! __('auth.lost_access_to_device') !!}
                            </a>
                        </div>
                    </div>
                    @endif
                    <button type="submit"
                        class="inline-flex justify-center items-center py-3 px-5 w-full text-base font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        <svg class="mr-2 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
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
