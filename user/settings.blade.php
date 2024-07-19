@extends(Theme::wrapper())
@section('title', __('client.profile'))
@section('container')
    <div class="grid grid-cols-1 px-4 pt-6 dark:bg-gray-900 xl:grid-cols-3 xl:gap-4">

        <!-- Right Content -->
        <div class="col-span-full xl:col-auto">
            <div class="mb-4 rounded-lg bg-white p-4 shadow dark:bg-gray-800 sm:p-6 xl:p-8">
                <div class="items-center sm:flex sm:space-x-4 xl:block xl:space-x-0 2xl:flex 2xl:space-x-4"
                    style="display: flex;justify-content: space-evenly;">
                    @if (auth()->user()->avatar !== null)
                        <img class="mb-4 h-28 w-28 rounded-lg sm:mb-0 xl:mb-4 2xl:mb-0" src="{{ auth()->user()->avatar() }}" alt="user photo">
                    @else
                        <div
                            class="relative mb-4 inline-flex h-28 w-28 items-center justify-center overflow-hidden rounded-full rounded-lg bg-gray-100 dark:bg-gray-600 sm:mb-0 xl:mb-4 2xl:mb-0">
                            <span class="font-medium text-gray-600 dark:text-gray-300">
                                {{ substr(auth()->user()->first_name, 0, 1) . substr(auth()->user()->last_name, 0, 1) }}
                            </span>
                        </div>
                    @endif
                    <div>
                        <h3 class="mb-1 text-2xl font-bold text-gray-900 dark:text-white">{{ auth()->user()->first_name }}
                            {{ auth()->user()->last_name }}</h3>
                        <div class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">
                            {!! __('client.client') !!}
                        </div>
                    </div>
                </div>

                @if(settings('allow_custom_avatars', true))
                <form action="{{ route('upload-profile-picture') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="dropzone-file"
                        class="dark:hover:bg-bray-800 mb-4 mt-4 flex h-20 w-full cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 hover:bg-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                        <div class="flex flex-col items-center justify-center pb-6 pt-5">
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                {!! __('client.drag_and_drop') !!}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, JPEG (MAX. 800x400px)</p>
                        </div>
                        <input id="dropzone-file" type="file" name="avatar" accept="image/*" required class="hidden">
                    </label>
                    <button type="submit"
                        class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 inline-flex items-center rounded-lg px-3 py-2 text-center text-sm font-medium text-white focus:ring-4">
                        <svg class="-ml-1 mr-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z">
                            </path>
                            <path d="M9 13h2v5a1 1 0 11-2 0v-5z"></path>
                        </svg>
                        {!! __('client.upload') !!}
                    </button>
                </form>
                @endif
            </div>
            <div class="mb-4 rounded-lg bg-white p-4 shadow dark:bg-gray-800 sm:p-6 xl:p-8">
                <h3 class="text-xl font-bold dark:text-white">{!! __('client.two_factor_authentication') !!}</h3>
                <p class="mt-2 text-sm font-normal text-gray-500 dark:text-gray-400">
                    {!! __('client.two_factor_authentication_desc') !!}
                </p>
                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                    <li class="py-4">
                        <div class="flex justify-end space-x-4">
                            <div class="inline-flex items-center">
                                @if (!Auth::user()->TwoFa()->exists())
                                    <a href="{{ route('2fa.setup') }}"
                                        class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 mb-2 mr-2 rounded-lg px-5 py-2.5 text-sm font-medium text-white focus:outline-none focus:ring-4">
                                        {!! __('client.enable') !!}
                                    </a>
                                @else
                                    <button type="button" data-modal-target="disableTwoFA" data-modal-toggle="disableTwoFA"
                                        class="mb-2 mr-2 rounded-lg bg-red-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                        {!! __('client.disable') !!}
                                    </button>
                                @endif
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="mb-4 rounded-lg bg-white p-4 shadow dark:bg-gray-800 sm:p-6 xl:p-8">
                <div class="flow-root">
                    <h3 class="text-xl font-bold dark:text-white">{!! __('client.social_accounts') !!}</h3>
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                        @if (Settings::getJson('encrypted::oauth::google', 'is_enabled', false))
                            <li class="pb-6 pt-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <i class='bx bxl-google dark:text-white' style="font-size: 1.75rem;"></i>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <span class="block truncate text-base font-semibold text-gray-900 dark:text-white">
                                            {!! __('client.google_account') !!}
                                        </span>
                                        <span class="block flex items-center truncate text-sm font-normal text-gray-500 dark:text-gray-400">
                                            @if (Auth::user()->oauthService('google')->exists())
                                                {{ Auth::user()->oauthService('google')->first()->email }} <i
                                                    class='bx bxs-badge-check ml-1'></i>
                                            @else
                                                {!! __('client.not_connected') !!}
                                            @endif
                                        </span>
                                    </div>
                                    <div class="inline-flex items-center">
                                        @if (Auth::user()->oauthService('google')->exists())
                                            <a href="{{ route('oauth.remove', 'google') }}"
                                                class="mb-2 mr-3 rounded-lg border border-red-700 px-3 py-2 text-center text-sm font-medium text-red-700 hover:bg-red-800 hover:text-white focus:outline-none focus:ring-4 focus:ring-red-300 dark:border-red-500 dark:text-red-500 dark:hover:bg-red-600 dark:hover:text-white dark:focus:ring-red-900">
                                                {!! __('client.remove') !!}
                                            </a>
                                        @else
                                            <a href="{{ route('oauth.connect', 'google') }}"
                                                class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 mr-3 rounded-lg px-3 py-2 text-center text-sm font-medium text-white focus:ring-4">
                                                {!! __('client.connect') !!}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endif
                        @if (Settings::getJson('encrypted::oauth::github', 'is_enabled', false))
                            <li class="pb-6 pt-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <i class='bx bxl-github dark:text-white' style="font-size: 1.75rem;"></i>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <span class="block truncate text-base font-semibold text-gray-900 dark:text-white">
                                            {!! __('client.github_account') !!}
                                        </span>
                                        <span class="block truncate text-sm font-normal text-gray-500 dark:text-gray-400">
                                            @if (Auth::user()->oauthService('github')->exists())
                                                <a class="text-primary-500"
                                                    href="{{ Auth::user()->oauthService('github')->first()->external_profile }}"
                                                    target="_blank">{{ Auth::user()->oauthService('github')->first()->external_profile }}</a>
                                            @else
                                                {!! __('client.not_connected') !!}
                                            @endif
                                        </span>
                                    </div>
                                    <div class="inline-flex items-center">
                                        @if (Auth::user()->oauthService('github')->exists())
                                            <a href="{{ route('oauth.remove', 'github') }}"
                                                class="mb-2 mr-3 rounded-lg border border-red-700 px-3 py-2 text-center text-sm font-medium text-red-700 hover:bg-red-800 hover:text-white focus:outline-none focus:ring-4 focus:ring-red-300 dark:border-red-500 dark:text-red-500 dark:hover:bg-red-600 dark:hover:text-white dark:focus:ring-red-900">
                                                {!! __('client.remove') !!}
                                            </a>
                                        @else
                                            <a href="{{ route('oauth.connect', 'github') }}"
                                                class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 mr-3 rounded-lg px-3 py-2 text-center text-sm font-medium text-white focus:ring-4">
                                                {!! __('client.connect') !!}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endif
                        @if (Settings::getJson('encrypted::oauth::discord', 'is_enabled', false))
                            <li class="pb-6 pt-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <i class='bx bxl-discord-alt dark:text-white' style="font-size: 1.75rem;"></i>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <span class="block truncate text-base font-semibold text-gray-900 dark:text-white">
                                            {!! __('client.discord_account') !!}
                                        </span>
                                        <span class="block flex items-center truncate text-sm font-normal text-gray-500 dark:text-gray-400">
                                            @if (Auth::user()->oauthService('discord')->exists())
                                                {{ Auth::user()->oauthService('discord')->first()->data->username }} <i
                                                    class='bx bxs-badge-check ml-1'></i>
                                            @else
                                                {!! __('client.not_connected') !!}
                                            @endif
                                        </span>
                                    </div>
                                    <div class="inline-flex items-center">
                                        @if (Auth::user()->oauthService('discord')->exists())
                                            <a href="{{ route('oauth.remove', 'discord') }}"
                                                class="mb-2 mr-3 rounded-lg border border-red-700 px-3 py-2 text-center text-sm font-medium text-red-700 hover:bg-red-800 hover:text-white focus:outline-none focus:ring-4 focus:ring-red-300 dark:border-red-500 dark:text-red-500 dark:hover:bg-red-600 dark:hover:text-white dark:focus:ring-red-900">
                                                {!! __('client.remove') !!}
                                            </a>
                                        @else
                                            <a href="{{ route('oauth.connect', 'discord') }}"
                                                class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 mr-3 rounded-lg px-3 py-2 text-center text-sm font-medium text-white focus:ring-4">
                                                {!! __('client.connect') !!}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endif
                    </ul>
                    <div></div>
                </div>
            </div>
            <div class="mb-4 rounded-lg bg-white p-4 shadow dark:bg-gray-800 sm:p-6 xl:p-8">
                <h3 class="text-xl font-bold dark:text-white">{!! __('client.sessions') !!}</h3>
                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach (auth()->user()->devices()->latest()->paginate(5) as $device)
                        <li class="py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    @if ($device->device_name == 'Phone')
                                        <svg class="h-6 w-6 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    @else
                                        <svg class="h-6 w-6 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    @endif
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="truncate text-base font-semibold text-gray-900 dark:text-white">
                                        {{ $device->device_type }}
                                    </p>
                                    <p class="truncate text-sm font-normal text-gray-500 dark:text-gray-400">
                                        {{ $device->device_name }} ({{ $device->ip_address }}) <br>
                                        {!! __('client.last_seen') !!}: {{ $device->last_login_at->diffForHumans() }}
                                    </p>
                                </div>
                                <div class="inline-flex items-center">
                                    @if (!$device->is_revoked)
                                        <a href="{{ route('revoke', ['device' => $device->id]) }}"
                                            class="focus:ring-primary-300 mb-3 mr-3 rounded-lg border border-gray-300 bg-white px-3 py-2 text-center text-sm font-medium text-gray-900 hover:bg-gray-100 focus:ring-4 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                            {!! __('client.revoke') !!}
                                        </a>
                                    @else
                                        <a href="{{ route('revoke', ['device' => $device->id]) }}"
                                            class="mb-3 mr-3 rounded-lg border border-red-700 px-3 px-5 py-2 text-center text-sm font-medium text-red-700 hover:bg-red-800 hover:text-white focus:outline-none focus:ring-4 focus:ring-red-300 dark:border-red-500 dark:text-red-500 dark:hover:bg-red-600 dark:hover:text-white dark:focus:ring-red-900">
                                            {!! __('client.revoked') !!}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </li>
                    @endforeach
                    <div class="pagination pt-6">
                        {{ auth()->user()->devices()->latest()->paginate(5)->links(Theme::pagination()) }}
                    </div>
                </ul>
                <div>
                    {{-- <button class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        See more
                    </button> --}}
                </div>
            </div>
            @if (settings('download_user_data', true))
                <div class="mb-4 rounded-lg bg-white p-4 shadow dark:bg-gray-800 sm:p-6 xl:p-8">
                    <h3 class="text-xl font-bold dark:text-white">{!! __('client.download_my_data') !!}</h3>
                    <p class="mt-2 text-sm font-normal text-gray-500 dark:text-gray-400">
                        {!! __('client.download_data_description') !!}
                    </p>
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                        <li class="py-4">
                            <div class="flex justify-end space-x-4">
                                <div class="inline-flex items-center">
                                    <button type="button" data-modal-target="downloadUserData" data-modal-toggle="downloadUserData"
                                        class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 mb-2 mr-2 rounded-lg px-5 py-2.5 text-sm font-medium text-white focus:outline-none focus:ring-4">
                                        {!! __('client.download') !!}
                                    </button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            @endif
        </div>
        <div class="col-span-2">
            <div class="mb-4 rounded-lg bg-white p-4 shadow dark:bg-gray-800 sm:p-6 xl:p-8">
                <h3 class="mb-4 text-xl font-bold dark:text-white">{!! __('client.general_information') !!}</h3>
                <form method="post" action="{{ route('update-username') }}">
                    @csrf
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="first-name"
                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">{!! __('auth.username') !!}</label>
                            <input type="text" value="{{ auth()->user()->username }}" name="username" required="" id="first-name"
                                class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:text-sm"
                                placeholder="">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="last-name"
                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">{!! __('auth.email') !!}</label>
                            <input type="text" placeholder="{{ auth()->user()->email }}" disabled="" id="last-name"
                                class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full cursor-not-allowed rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:text-sm"
                                required>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="first-name" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                {!! __('auth.first_name') !!}
                            </label>
                            <input type="text" placeholder="{{ auth()->user()->first_name }}" disabled="" id="first-name"
                                class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full cursor-not-allowed rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:text-sm">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="last-name" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                {!! __('auth.last_name') !!}
                            </label>
                            <input type="text" placeholder="{{ auth()->user()->last_name }}" disabled="" id="last-name"
                                class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full cursor-not-allowed rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:text-sm">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="organization" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                {!! __('client.organization') !!} {!! __('client.optional') !!}
                            </label>
                            <input type="text" name="company_name" value="{{ auth()->user()->address->company_name ?? '' }}" id="organization"
                                class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:text-sm">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="countries" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                {{ __('client.select_an_option') }}
                            </label>
                            <select id="countries" name="country"
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500">
                                @foreach (config('utils.countries') as $key => $country)
                                    <option value="{{ $key }}" @if (auth()->user()->address->country == $key) selected @endif>
                                        {{ $country }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="address" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                {!! __('auth.address') !!}
                            </label>
                            <input type="text" name="address" value="{{ auth()->user()->address->address ?? '' }}" id="address"
                                class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:text-sm">
                        </div>
                        {{-- <div class="col-span-6 sm:col-span-3">
                            <label for="address_2" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                Address 2 (optional)
                            </label>
                            <input type="text" placeholder="address 2" name="address_2" value="{{ auth()->user()->address->address_2 }}"
                                id="address_2"
                                class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:text-sm">
                        </div> --}}
                        <div class="col-span-6 sm:col-span-3">
                            <label for="city" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                {!! __('admin.city') !!}
                            </label>
                            <input type="text" placeholder="{{ __('client.city') }}" name="city"
                                value="{{ auth()->user()->address->city ?? '' }}" id="city"
                                class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:text-sm">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="zip_code" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                {!! __('auth.zip_code') !!}
                            </label>
                            <input type="text" placeholder="{{ __('client.zip_code') }}" name="zip_code"
                                value="{{ auth()->user()->address->zip_code ?? '' }}" id="zip_code"
                                class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:text-sm">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="region" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                {!! __('client.state_region_provice') !!}
                            </label>
                            <input type="text" placeholder="{{ __('client.region') }}" name="region"
                                value="{{ auth()->user()->address->region ?? '' }}" id="region"
                                class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:text-sm">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label class="relative inline-flex cursor-pointer items-center">
                                <input type="checkbox" value="1" name="is_subscribed" class="peer sr-only"
                                    @if (auth()->user()->is_subscribed) checked @endif />
                                <div
                                    class="peer h-6 w-11 rounded-full bg-gray-200 after:absolute after:left-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-primary-600 peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary-300 dark:border-gray-600 dark:bg-gray-700 dark:peer-focus:ring-primary-800">
                                </div>
                                <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    {!! __('client.subscribe_to_emails') !!}
                                </span>
                            </label>
                        </div>
                        <div class="sm:col-full col-span-6">
                            <button
                                class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 rounded-lg px-5 py-2.5 text-center text-sm font-medium text-white focus:ring-4"
                                type="submit">
                                {!! __('client.save_all') !!}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="mb-4 rounded-lg bg-white p-4 shadow dark:bg-gray-800 sm:p-6 xl:p-8">
                <h3 class="mb-4 text-xl font-bold dark:text-white">{!! __('auth.update_email') !!}</h3>
                <form method="post" action="{{ route('update-email') }}" autocomplete="off">
                    @csrf
                    <div class="">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="current-password" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                {!! __('auth.current_password') !!}
                            </label>
                            <input type="password" name="current_password" id="current-password"
                                class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:text-sm"
                                placeholder="••••••••" required>
                        </div>
                        <div class="col-span-6 mb-6 mt-6 sm:col-span-3">
                            <label for="new_email" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                {!! __('auth.new_email') !!}
                            </label>
                            <input type="email" name="new_email" id="new_email"
                                class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:text-sm"
                                required>
                        </div>
                        <div class="sm:col-full col-span-6">
                            <button
                                class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 rounded-lg px-5 py-2.5 text-center text-sm font-medium text-white focus:ring-4"
                                type="submit">{!! __('client.save_all') !!}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="mb-4 rounded-lg bg-white p-4 shadow dark:bg-gray-800 sm:p-6 xl:p-8">
                <h3 class="mb-4 text-xl font-bold dark:text-white">{!! __('auth.update_password') !!}</h3>
                <form method="post" action="{{ route('update-password') }}">
                    @csrf
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="current-password" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                {!! __('auth.current_password') !!}
                            </label>
                            <input type="password" name="current_password" id="current-password"
                                class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:text-sm"
                                placeholder="••••••••" required>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="new-password" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                {!! __('auth.new_password') !!}
                            </label>
                            <input type="password" name="new_password" id="new-password"
                                class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:text-sm"
                                placeholder="••••••••" required>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="confirm-password" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                {!! __('auth.confirm_password') !!}
                            </label>
                            <input type="password" name="new_password_confirmation" id="confirm-password"
                                class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:text-sm"
                                placeholder="••••••••" required>
                        </div>
                        <div class="col-span-full">
                            <div class="text-sm font-medium dark:text-white">{!! __('auth.password_recommended_requirements') !!}:</div>
                            <div class="mb-1 text-sm font-normal text-gray-500 dark:text-gray-400">
                                {!! __('auth.password_recommended_requirements_desc') !!}:
                            </div>
                            <ul class="space-y-1 pl-4 text-gray-500 dark:text-gray-400">
                                <li class="text-xs font-normal">{!! __('auth.password_recommended_requirements_chracters') !!}</li>
                                <li class="text-xs font-normal">{!! __('auth.at_least_lowercase_character') !!}</li>
                                <li class="text-xs font-normal">{!! __('auth.inclusion_least_special_character') !!}
                                    ?
                                </li>
                            </ul>
                        </div>
                        <div class="sm:col-full col-span-6">
                            <button
                                class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 rounded-lg px-5 py-2.5 text-center text-sm font-medium text-white focus:ring-4"
                                type="submit">
                                {!! __('client.save_all') !!}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            @if (settings('delete_user_account', true))
                <div class="mb-4 rounded-lg bg-white p-4 shadow dark:bg-gray-800 sm:p-6 xl:p-8">
                    <h3 class="text-xl font-bold dark:text-white">{!! __('client.delete_my_account') !!}</h3>
                    <p class="mt-2 text-sm font-normal text-gray-500 dark:text-gray-400">
                        {!! __('client.delete_account_description') !!}
                    </p>
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                        <li class="py-4">
                            <div class="flex justify-end space-x-4">
                                <div class="inline-flex items-center">
                                    @if ($request = auth()->user()->deletion_requests()->first())
                                        <a href="{{ route('user.cancel-removal') }}"
                                            class="mb-2 mr-2 rounded-lg border border-red-700 px-5 py-2.5 text-center text-sm font-medium text-red-700 hover:bg-red-800 hover:text-white focus:outline-none focus:ring-4 focus:ring-red-300 dark:border-red-500 dark:text-red-500 dark:hover:bg-red-600 dark:hover:text-white dark:focus:ring-red-900">{!! __('client.cancel') !!}</a>
                                    @else
                                        <button type="button" data-modal-target="deleteAccountModal" data-modal-toggle="deleteAccountModal"
                                            class="mb-2 mr-2 rounded-lg border border-red-700 px-5 py-2.5 text-center text-sm font-medium text-red-700 hover:bg-red-800 hover:text-white focus:outline-none focus:ring-4 focus:ring-red-300 dark:border-red-500 dark:text-red-500 dark:hover:bg-red-600 dark:hover:text-white dark:focus:ring-red-900">{!! __('client.delete_account') !!}</button>
                                    @endif
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            @endif
        </div>

    </div>

    @if (Auth::user()->TwoFa()->exists())
        <!-- Disable 2FA modal -->
        <div id="disableTwoFA" tabindex="-1" aria-hidden="true"
            class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full overflow-y-auto overflow-x-hidden p-4 md:inset-0">
            <div class="relative max-h-full w-full max-w-2xl">
                <!-- Modal content -->
                <form action="{{ route('2fa.disable') }}" method="POST">
                    @csrf
                    <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-start justify-between rounded-t border-b p-4 dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                {!! __('client.two_factor_authentication') !!}
                            </h3>
                            <button type="button"
                                class="ml-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="disableTwoFA">
                                <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">{{ __('client.disable') }}</span>
                            </button>
                        </div>

                        <!-- Modal body -->
                        <div class="space-y-6 p-6">
                            <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                {!! __('client.two_factor_authentication_desc') !!}
                            </p>
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
                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center justify-end space-x-2 rounded-b border-t border-gray-200 p-6 dark:border-gray-600">
                            <button type="submit"
                                class="rounded-lg bg-red-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">{!! __('client.disable') !!}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Disable 2FA modal -->
    @endif

    <!-- Download User Data modal -->
    <div id="downloadUserData" tabindex="-1" aria-hidden="true"
        class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full overflow-y-auto overflow-x-hidden p-4 md:inset-0">
        <div class="relative max-h-full w-full max-w-2xl">
            <!-- Modal content -->
            <form action="{{ route('user.download-data') }}" method="POST">
                @csrf
                <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between rounded-t border-b p-4 dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            {!! __('client.download_my_data') !!}
                        </h3>
                        <button type="button"
                            class="ml-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="downloadUserData">
                            <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">{{ __('client.close_menu') }}</span>
                        </button>
                    </div>

                    <!-- Modal body -->
                    <div class="space-y-6 p-6">
                        <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                            {!! __('client.download_data_description') !!}
                        </p>
                        <div class="">
                            <label for="confirm-password" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                {!! __('auth.confirm_password') !!}
                            </label>
                            <input type="password" name="current_password" id="confirm-password"
                                class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:text-sm"
                                placeholder="••••••••" required>
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
                    </div>

                    <!-- Modal footer -->
                    <div class="flex items-center justify-end space-x-2 rounded-b border-t border-gray-200 p-6 dark:border-gray-600">
                        <button data-modal-hide="downloadUserData" type="submit"
                            class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 rounded-lg px-5 py-2.5 text-center text-sm font-medium text-white focus:outline-none focus:ring-4">{!! __('client.download') !!}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Download User Data modal -->

    <!-- User Deletion modal -->
    <div id="deleteAccountModal" tabindex="-1" aria-hidden="true"
        class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full overflow-y-auto overflow-x-hidden p-4 md:inset-0">
        <div class="relative max-h-full w-full max-w-2xl">
            <!-- Modal content -->
            <form action="{{ route('user.request-removal') }}" method="POST">
                @csrf
                <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between rounded-t border-b p-4 dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            {!! __('client.delete_my_account') !!}
                        </h3>
                        <button type="button"
                            class="ml-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="deleteAccountModal">
                            <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">{{ __('client.close_menu') }}</span>
                        </button>
                    </div>

                    <!-- Modal body -->
                    <div class="space-y-6 p-6">
                        <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                            {!! __('client.delete_account_description') !!}
                        </p>
                        <div class="">
                            <label for="confirm-password" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                {!! __('auth.confirm_password') !!}
                            </label>
                            <input type="password" name="current_password" id="confirm-password"
                                class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:text-sm"
                                placeholder="••••••••" required>
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
                        <div class="flex">
                            <div class="flex h-5 items-center">
                                <input id="helper-checkbox" aria-describedby="helper-checkbox-text" name="disclosure" type="checkbox"
                                    value="1" required
                                    class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600">
                            </div>
                            <div class="ml-2 text-sm">
                                <label for="helper-checkbox" class="font-medium text-gray-900 dark:text-gray-300"></label>
                                <p id="helper-checkbox-text" class="text-xs font-normal text-gray-500 dark:text-gray-300">
                                    {!! __('client.delete_account_disclosure') !!}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="flex items-center justify-end space-x-2 rounded-b border-t border-gray-200 p-6 dark:border-gray-600">
                        <button data-modal-hide="deleteAccountModal" type="button"
                            class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 rounded-lg px-5 py-2.5 text-center text-sm font-medium text-white focus:outline-none focus:ring-4">{!! __('client.cancel') !!}</button>
                        <button type="submit"
                            class="rounded-lg border border-red-700 px-5 py-2.5 text-center text-sm font-medium text-red-700 hover:bg-red-800 hover:text-white focus:outline-none focus:ring-4 focus:ring-red-300 dark:border-red-500 dark:text-red-500 dark:hover:bg-red-600 dark:hover:text-white dark:focus:ring-red-900">{!! __('client.delete_account') !!}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- User Deletion modal -->
@endsection
