@extends(Theme::wrapper())
@section('title', __('client.profile'))
@section('container')
    <div class="grid grid-cols-1 px-4 pt-6 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900">

        <!-- Right Content -->
        <div class="col-span-full xl:col-auto">
            <div class="p-4 mb-4 bg-white rounded-lg shadow sm:p-6 xl:p-8 dark:bg-gray-800">
                <div class="items-center sm:flex xl:block 2xl:flex sm:space-x-4 xl:space-x-0 2xl:space-x-4"
                    style="display: flex;justify-content: space-evenly;">
                    @if (auth()->user()->avatar !== null)
                        <img class="mb-4 w-28 h-28 rounded-lg sm:mb-0 xl:mb-4 2xl:mb-0" src="{{ auth()->user()->avatar() }}"
                            alt="user photo">
                    @else
                        <div
                            class="relative inline-flex items-center justify-center mb-4 w-28 h-28 rounded-lg sm:mb-0 xl:mb-4 2xl:mb-0 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                            <span
                                class="font-medium text-gray-600 dark:text-gray-300">{{ substr(auth()->user()->first_name, 0, 1) . substr(auth()->user()->last_name, 0, 1) }}</span>
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

                <form action="{{ route('upload-profile-picture') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="dropzone-file"
                        class="flex flex-col justify-center items-center w-full h-20 mt-4 mb-4 bg-gray-50 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                        <div class="flex flex-col justify-center items-center pt-5 pb-6">
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                {!! __('client.drag_and_drop') !!}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                        </div>
                        <input id="dropzone-file" type="file" name="avatar" accept="image/*" required class="hidden">
                    </label>
                    <button type="submit"
                        class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        <svg class="mr-2 -ml-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z">
                            </path>
                            <path d="M9 13h2v5a1 1 0 11-2 0v-5z"></path>
                        </svg>
                        {!! __('client.upload') !!}
                    </button>
                </form>
            </div>
            <div class="p-4 mb-4 bg-white rounded-lg shadow sm:p-6 xl:p-8 dark:bg-gray-800">
                <h3 class="text-xl font-bold dark:text-white">{!! __('client.two_factor_authentication') !!}</h3>
                <p class="text-sm font-normal text-gray-500 dark:text-gray-400 mt-2">
                    {!! __('client.two_factor_authentication_desc') !!}
                </p>
                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                    <li class="py-4">
                        <div class="flex justify-end space-x-4">
                            <div class="inline-flex items-center">
                                @if (!Auth::user()->TwoFa()->exists())
                                    <a href="{{ route('2fa.setup') }}"
                                        class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">{!! __('client.enable') !!}</a>
                                @else
                                    <button type="button" data-modal-target="disableTwoFA" data-modal-toggle="disableTwoFA"
                                        class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">{!! __('client.disable') !!}</button>
                                @endif
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="p-4 mb-4 bg-white rounded-lg shadow sm:p-6 xl:p-8 dark:bg-gray-800">
                <div class="flow-root">
                    <h3 class="text-xl font-bold dark:text-white">{!! __('client.social_accounts') !!}</h3>
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                        @if (Settings::getJson('encrypted::oauth::google', 'is_enabled', false))
                            <li class="pt-4 pb-6">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <i class='bx bxl-google dark:text-white ' style="font-size: 1.75rem;"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <span class="block text-base font-semibold text-gray-900 truncate dark:text-white">
                                            {!! __('client.google_account') !!}
                                        </span>
                                        <span
                                            class="block text-sm font-normal text-gray-500 truncate dark:text-gray-400 flex items-center">
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
                                                class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 text-center mr-3 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">{!! __('client.remove') !!}</a>
                                        @else
                                            <a href="{{ route('oauth.connect', 'google') }}"
                                                class="py-2 px-3 mr-3 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">{!! __('client.connect') !!}</a>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endif
                        @if (Settings::getJson('encrypted::oauth::github', 'is_enabled', false))
                            <li class="pt-4 pb-6">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <i class='bx bxl-github dark:text-white ' style="font-size: 1.75rem;"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <span class="block text-base font-semibold text-gray-900 truncate dark:text-white">
                                            {!! __('client.github_account') !!}
                                        </span>
                                        <span class="block text-sm font-normal text-gray-500 truncate dark:text-gray-400">
                                            @if (Auth::user()->oauthService('github')->exists())
                                                <a class="text-blue-500"
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
                                                class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 text-center mr-3 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">{!! __('client.remove') !!}</a>
                                        @else
                                            <a href="{{ route('oauth.connect', 'github') }}"
                                                class="py-2 px-3 mr-3 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">{!! __('client.connect') !!}</a>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endif
                        @if (Settings::getJson('encrypted::oauth::discord', 'is_enabled', false))
                            <li class="pt-4 pb-6">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <i class='bx bxl-discord-alt dark:text-white ' style="font-size: 1.75rem;"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <span class="block text-base font-semibold text-gray-900 truncate dark:text-white">
                                            {!! __('client.discord_account') !!}
                                        </span>
                                        <span
                                            class="block text-sm font-normal text-gray-500 truncate dark:text-gray-400 flex items-center">
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
                                                class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 text-center mr-3 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">{!! __('client.remove') !!}</a>
                                        @else
                                            <a href="{{ route('oauth.connect', 'discord') }}"
                                                class="py-2 px-3 mr-3 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">{!! __('client.connect') !!}</a>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endif
                    </ul>
                    <div>

                    </div>
                </div>
            </div>
            <div class="p-4 mb-4 bg-white rounded-lg shadow sm:p-6 xl:p-8 dark:bg-gray-800">
                <h3 class="text-xl font-bold dark:text-white">{!! __('client.sessions') !!}</h3>
                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach (auth()->user()->devices()->latest()->paginate(5) as $device)
                        <li class="py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    @if ($device->device_name == 'Phone')
                                        <svg class="w-6 h-6 dark:text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    @else
                                        <svg class="w-6 h-6 dark:text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-base font-semibold text-gray-900 truncate dark:text-white">
                                        {{ $device->device_type }}
                                    </p>
                                    <p class="text-sm font-normal text-gray-500 truncate dark:text-gray-400">
                                        {{ $device->device_name }} ({{ $device->ip_address }}) <br>
                                        {!! __('client.last_seen') !!}: {{ $device->last_login_at->diffForHumans() }}
                                    </p>
                                </div>
                                <div class="inline-flex items-center">
                                    @if (!$device->is_revoked)
                                        <a href="{{ route('revoke', ['device' => $device->id]) }}"
                                            class="py-2 px-3 mr-3 mb-3 text-sm font-medium text-center text-gray-900 bg-white rounded-lg border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                            {!! __('client.revoke') !!}</a>
                                    @else
                                        <a href="{{ route('revoke', ['device' => $device->id]) }}"
                                            class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 text-center py-2 px-3 mr-3 mb-3 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">{!! __('client.revoked') !!}</a>
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
                    {{-- <button class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">See more</button> --}}
                </div>
            </div>
            @if (settings('download_user_data', true))
                <div class="p-4 mb-4 bg-white rounded-lg shadow sm:p-6 xl:p-8 dark:bg-gray-800">
                    <h3 class="text-xl font-bold dark:text-white">{!! __('client.download_my_data') !!}</h3>
                    <p class="text-sm font-normal text-gray-500 dark:text-gray-400 mt-2">
                        {!! __('client.download_data_description') !!}
                    </p>
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                        <li class="py-4">
                            <div class="flex justify-end space-x-4">
                                <div class="inline-flex items-center">
                                    <button type="button" data-modal-target="downloadUserData"
                                        data-modal-toggle="downloadUserData"
                                        class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">{!! __('client.download') !!}</button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            @endif
        </div>
        <div class="col-span-2">
            <div class="p-4 mb-4 bg-white rounded-lg shadow sm:p-6 xl:p-8 dark:bg-gray-800">
                <h3 class="mb-4 text-xl font-bold dark:text-white">{!! __('client.general_information') !!}</h3>
                <form method="post" action="{{ route('update-username') }}">
                    @csrf
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="first-name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{!! __('auth.username') !!}</label>
                            <input type="text" value="{{ auth()->user()->username }}" name="username" required=""
                                id="first-name"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="last-name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{!! __('auth.email') !!}</label>
                            <input type="text" placeholder="{{ auth()->user()->email }}" disabled=""
                                id="last-name"
                                class="shadow-sm bg-gray-50 cursor-not-allowed border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                required>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="first-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                {!! __('auth.first_name') !!}
                            </label>
                            <input type="text" placeholder="{{ auth()->user()->first_name }}" disabled=""
                                id="first-name"
                                class="shadow-sm bg-gray-50 cursor-not-allowed border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="last-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                {!! __('auth.last_name') !!}
                            </label>
                            <input type="text" placeholder="{{ auth()->user()->last_name }}" disabled=""
                                id="last-name"
                                class="shadow-sm bg-gray-50 cursor-not-allowed border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="organization"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                {!! __('client.organization') !!} {!! __('client.optional') !!}
                            </label>
                            <input type="text" name="company_name"
                                value="{{ auth()->user()->address->company_name }}" id="organization"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                {{ __('client.select_an_option') }}
                            </label>

                            <select id="countries" name="country"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                @foreach (config('utils.countries') as $key => $country)
                                    <option value="{{ $key }}"
                                        @if (request()->header('HTTP_CF_IPCOUNTRY', auth()->user()->address->country ?? 'UK') == $key) selected @endif>
                                        {{ $country }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                {!! __('auth.address') !!}
                            </label>
                            <input type="text" name="address" value="{{ auth()->user()->address->address }}"
                                id="address"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        </div>
                        {{-- <div class="col-span-6 sm:col-span-3">
                        <label for="address_2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address 2 (optional)</label>
                        <input type="text" placeholder="address 2" name="address_2" value="{{ auth()->user()->address->address_2 }}" id="address_2" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    </div> --}}
                        <div class="col-span-6 sm:col-span-3">
                            <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                {!! __('admin.city') !!}
                            </label>
                            <input type="text" placeholder="{{ __('client.city') }}" name="city"
                                value="{{ auth()->user()->address->city }}" id="city"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="zip_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                {!! __('auth.zip_code') !!}
                            </label>
                            <input type="text" placeholder="{{ __('client.zip_code') }}" name="zip_code"
                                value="{{ auth()->user()->address->zip_code }}" id="zip_code"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="region" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                {!! __('client.state_region_provice') !!}
                            </label>
                            <input type="text" placeholder="{{ __('client.region') }}" name="region"
                                value="{{ auth()->user()->address->region }}" id="region"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" value="1" name="is_subscribed" class="sr-only peer"
                                    @if (auth()->user()->is_subscribed) checked @endif />
                                <div
                                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                </div>
                                <span
                                    class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">{!! __('client.subscribe_to_emails') !!}</span>
                            </label>
                        </div>
                        <div class="col-span-6 sm:col-full">
                            <button
                                class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                                type="submit">
                                {!! __('client.save_all') !!}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="p-4 mb-4 bg-white rounded-lg shadow sm:p-6 xl:p-8 dark:bg-gray-800">
                <h3 class="mb-4 text-xl font-bold dark:text-white">{!! __('auth.update_email') !!}</h3>
                <form method="post" action="{{ route('update-email') }}" autocomplete="off">
                    @csrf
                    <div class="">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="current-password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                {!! __('auth.current_password') !!}
                            </label>
                            <input type="password" name="current_password" id="current-password"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="••••••••" required>
                        </div>
                        <div class="col-span-6 sm:col-span-3 mt-6 mb-6">
                            <label for="new_email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                {!! __('auth.new_email') !!}
                            </label>
                            <input type="email" name="new_email" id="new_email"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                required>
                        </div>
                        <div class="col-span-6 sm:col-full">
                            <button
                                class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                                type="submit">{!! __('client.save_all') !!}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="p-4 mb-4 bg-white rounded-lg shadow sm:p-6 xl:p-8 dark:bg-gray-800">
                <h3 class="mb-4 text-xl font-bold dark:text-white">{!! __('auth.update_password') !!}</h3>
                <form method="post" action="{{ route('update-password') }}">
                    @csrf
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="current-password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                {!! __('auth.current_password') !!}
                            </label>
                            <input type="password" name="current_password" id="current-password"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="••••••••" required>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="new-password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                {!! __('auth.new_password') !!}
                            </label>
                            <input type="password" name="new_password" id="new-password"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="••••••••" required>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="confirm-password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                {!! __('auth.confirm_password') !!}
                            </label>
                            <input type="password" name="new_password_confirmation" id="confirm-password"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="••••••••" required>
                        </div>
                        <div class="col-span-full">
                            <div class="text-sm font-medium dark:text-white">{!! __('auth.password_recommended_requirements') !!}:</div>
                            <div class="mb-1 text-sm font-normal text-gray-500 dark:text-gray-400">
                                {!! __('auth.password_recommended_requirements_desc') !!}:
                            </div>
                            <ul class="pl-4 space-y-1 text-gray-500 dark:text-gray-400">
                                <li class="text-xs font-normal">{!! __('auth.password_recommended_requirements_chracters') !!}</li>
                                <li class="text-xs font-normal">{!! __('auth.at_least_lowercase_character') !!}</li>
                                <li class="text-xs font-normal">{!! __('auth.inclusion_least_special_character') !!}
                                    ?
                                </li>
                            </ul>
                        </div>
                        <div class="col-span-6 sm:col-full">
                            <button
                                class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                                type="submit">{!! __('client.save_all') !!}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            @if (settings('delete_user_account', true))
                <div class="p-4 mb-4 bg-white rounded-lg shadow sm:p-6 xl:p-8 dark:bg-gray-800">
                    <h3 class="text-xl font-bold dark:text-white">{!! __('client.delete_my_account') !!}</h3>
                    <p class="text-sm font-normal text-gray-500 dark:text-gray-400 mt-2">
                        {!! __('client.delete_account_description') !!}
                    </p>
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                        <li class="py-4">
                            <div class="flex justify-end space-x-4">
                                <div class="inline-flex items-center">
                                    @if ($request = auth()->user()->deletion_requests()->first())
                                        <a href="{{ route('user.cancel-removal') }}"
                                            class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">{!! __('client.cancel') !!}</a>
                                    @else
                                        <button type="button" data-modal-target="deleteAccountModal"
                                            data-modal-toggle="deleteAccountModal"
                                            class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">{!! __('client.delete_account') !!}</button>
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
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <form action="{{ route('2fa.disable') }}" method="POST">
                    @csrf
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                {!! __('client.two_factor_authentication') !!}
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="disableTwoFA">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">{{ __('client.disable') }}</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 space-y-6">
                            <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                {!! __('client.two_factor_authentication_desc') !!}
                            </p>
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
                        </div>
                        <!-- Modal footer -->
                        <div
                            class="flex items-center justify-end p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                            <button type="submit"
                                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">{!! __('client.disable') !!}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Disable 2FA modal -->
    @endif

    <!-- Download User Data modal -->
    <div id="downloadUserData" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <form action="{{ route('user.download-data') }}" method="POST">
                @csrf
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            {!! __('client.download_my_data') !!}
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="downloadUserData">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">{{ __('client.close_menu') }}</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6">
                        <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                            {!! __('client.download_data_description') !!}
                        </p>
                        <div class="">
                            <label for="confirm-password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                {!! __('auth.confirm_password') !!}
                            </label>
                            <input type="password" name="current_password" id="confirm-password"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="••••••••" required>
                        </div>
                        @if (auth()->user()->TwoFa()->exists())
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
                    </div>
                    <!-- Modal footer -->
                    <div
                        class="flex items-center justify-end p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button data-modal-hide="downloadUserData" type="submit"
                            class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">{!! __('client.download') !!}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Download User Data modal -->

    <!-- User Deletion modal -->
    <div id="deleteAccountModal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <form action="{{ route('user.request-removal') }}" method="POST">
                @csrf
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            {!! __('client.delete_my_account') !!}
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="deleteAccountModal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">{{ __('client.close_menu') }}</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6">
                        <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                            {!! __('client.delete_account_description') !!}
                        </p>
                        <div class="">
                            <label for="confirm-password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                {!! __('auth.confirm_password') !!}
                            </label>
                            <input type="password" name="current_password" id="confirm-password"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="••••••••" required>
                        </div>
                        @if (auth()->user()->TwoFa()->exists())
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
                        <div class="flex">
                            <div class="flex items-center h-5">
                                <input id="helper-checkbox" aria-describedby="helper-checkbox-text" name="disclosure"
                                    type="checkbox" value="1" required
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            </div>
                            <div class="ml-2 text-sm">
                                <label for="helper-checkbox" class="font-medium text-gray-900 dark:text-gray-300"></label>
                                <p id="helper-checkbox-text" class="text-xs font-normal text-gray-500 dark:text-gray-300">
                                    {!! __('client.delete_account_disclosure') !!}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div
                        class="flex items-center justify-end p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button data-modal-hide="deleteAccountModal" type="button"
                            class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">{!! __('client.cancel') !!}</button>
                        <button type="submit"
                            class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">{!! __('client.delete_account') !!}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- User Deletion modal -->
@endsection
