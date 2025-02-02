@if (settings('cookie_popup_enabled', true))
    {{-- Cookies --}}
    <div id="cookies-modal" tabindex="-1" aria-hidden="false"
        class="h-modal fixed left-0 right-0 top-0 z-50 hidden w-full items-center justify-center overflow-y-auto overflow-x-hidden p-4 md:inset-0 md:h-full">
        <div class="relative h-[40rem] w-full max-w-2xl overflow-y-auto rounded-lg bg-white p-4 shadow dark:bg-gray-800 md:p-6">
            <a href="#" class="mb-8 flex items-center justify-center text-xl font-semibold text-gray-900 dark:text-white">
                <img src="@settings('logo')" class="mr-2 h-7 rounded" alt="logo">
                @settings('app_name', 'WemX')
            </a>
            <div class="space-y-4 divide-y divide-gray-200 font-light text-gray-500 dark:divide-gray-700 dark:text-gray-400">
                <div>
                    <p class="mb-4 text-2xl font-bold leading-tight text-gray-900 dark:text-white">{!! __('client.cookies_settings') !!}</p>
                    <p class="mb-2">
                        {!! __('client.cookies_settings_description') !!}
                    </p>
                </div>
                <div class="pt-4">
                    <p class="mb-2 text-lg font-semibold leading-tight text-gray-900 dark:text-white">{!! __('client.essential_cookies') !!}</p>
                    <p class="mb-2">
                        {!! __('client.essential_cookies_description') !!}
                    </p>
                    <a href="#" data-collapse-toggle="cookies-info-2"
                        class="text-primary-600 dark:text-primary-500 inline-flex items-center text-sm font-medium hover:underline">
                        {!! __('client.view_cookies') !!}
                        <svg class="ml-1 h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                    <div id="cookies-info-2" class="relative mt-4 hidden overflow-x-auto bg-gray-100 sm:rounded-lg">
                        <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                            <thead class="bg-gray-100 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('client.name') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('client.provider') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('client.expiration') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        {{ __('client.purpose') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-gray-100 dark:bg-gray-800">
                                    <th scope="row" class="whitespace-nowrap px-6 py-4 font-light text-gray-500 dark:text-gray-400">
                                        _cfduid
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ __('client.cloudflare_inc') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ __('client.year_1') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ __('client.static_file_delivery') }}
                                    </td>
                                </tr>

                                <!-- Laravel Session Cookie -->
                                <tr class="bg-gray-100 dark:bg-gray-800">
                                    <th scope="row" class="whitespace-nowrap px-6 py-4 font-light text-gray-500 dark:text-gray-400">
                                        laravel_session
                                    </th>
                                    <td class="px-6 py-4">
                                        @settings('app_name', 'WemX')
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ __('client.session') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ __('client.identifies_a_session_instance_for_a_user') }}
                                    </td>
                                </tr>

                                <!-- Laravel XSRF-TOKEN Cookie (If not already included) -->
                                <tr class="bg-gray-100 dark:bg-gray-800">
                                    <th scope="row" class="whitespace-nowrap px-6 py-4 font-light text-gray-500 dark:text-gray-400">
                                        XSRF-TOKEN
                                    </th>
                                    <td class="px-6 py-4">
                                        @settings('app_name', 'WemX')
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ __('client.session') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ __('client.prevent_crosssite_request_forgery_csrf_attacks') }}
                                    </td>
                                </tr>

                                <!-- Optional, if you are using Laravel API authentication -->
                                <tr class="bg-gray-100 dark:bg-gray-800">
                                    <th scope="row" class="whitespace-nowrap px-6 py-4 font-light text-gray-500 dark:text-gray-400">
                                        laravel_token
                                    </th>
                                    <td class="px-6 py-4">
                                        @settings('app_name', 'WemX')
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ __('client.session') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ __('client.api_authentication') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="flex items-start pt-4">
                    <div>
                        <p class="mb-2 text-lg font-semibold leading-tight text-gray-900 dark:text-white">{!! __('client.functional_cookies') !!}</p>
                        <p class="mb-2">
                            {!! __('client.functional_cookies_description') !!}
                        </p>
                        <a href="#" data-collapse-toggle="cookies-info-4"
                            class="text-primary-600 dark:text-primary-500 inline-flex items-center text-sm font-medium hover:underline">
                            {!! __('client.view_cookies') !!}
                            <svg class="ml-1 h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    </div>
                    <label for="functional-cookies-toggle" class="relative inline-flex cursor-pointer items-center">
                        <input type="checkbox" value="" checked id="functional-cookies-toggle" class="peer sr-only">
                        <div
                            class="peer h-6 w-11 rounded-full bg-gray-200 after:absolute after:left-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-blue-600 peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:border-gray-600 dark:bg-gray-700 dark:peer-focus:ring-blue-800">
                        </div>
                        <span class="sr-only">{{ __('client.toggle_me') }}</span>
                    </label>
                </div>
                <div id="cookies-info-4" class="relative mt-4 hidden overflow-x-auto bg-gray-100 sm:rounded-lg">
                    <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                        <thead class="bg-gray-100 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    {{ __('client.name') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ __('client.provider') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ __('client.expiration') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ __('client.purpose') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-gray-100 dark:bg-gray-800">
                                <th scope="row" class="whitespace-nowrap px-6 py-4 font-light text-gray-500 dark:text-gray-400">
                                    filter_orders
                                </th>
                                <td class="px-6 py-4">
                                    @settings('app_name', 'WemX')
                                </td>
                                <td class="px-6 py-4">
                                    {{ __('client.session') }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ __('client.set_preffered_order_status') }}
                                </td>
                            </tr>
                            <tr class="bg-gray-100 dark:bg-gray-800">
                                <th scope="row" class="whitespace-nowrap px-6 py-4 font-light text-gray-500 dark:text-gray-400">
                                    <-article->-feedback
                                </th>
                                <td class="px-6 py-4">
                                    @settings('app_name', 'WemX')
                                </td>
                                <td class="px-6 py-4">
                                    {{ __('client.session') }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ __('client.collect_article_feedback') }}
                                </td>
                            </tr>
                            <tr class="bg-gray-100 dark:bg-gray-800">
                                <th scope="row" class="whitespace-nowrap px-6 py-4 font-light text-gray-500 dark:text-gray-400">
                                    {{ __('client.affiliate') }}
                                </th>
                                <td class="px-6 py-4">
                                    @settings('app_name', 'WemX')
                                </td>
                                <td class="px-6 py-4">
                                    {{ __('client.session') }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ __('client.track_users_invited_by_affiliates') }}
                                </td>
                            </tr>
                            <tr class="bg-gray-100 dark:bg-gray-800">
                                <th scope="row" class="whitespace-nowrap px-6 py-4 font-light text-gray-500 dark:text-gray-400">
                                    affiliate_invite
                                </th>
                                <td class="px-6 py-4">
                                    @settings('app_name', 'WemX')
                                </td>
                                <td class="px-6 py-4">
                                    {{ __('client.session') }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ __('client.keep_track_of_affiliate_invites') }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-5 items-center justify-between space-y-4 sm:flex sm:space-y-0">
                <div class="flex items-center space-x-4 text-sm text-gray-500 dark:text-gray-400">
                    <button id="accept-cookies" type="button"
                        class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 w-full rounded-lg px-5 py-2.5 text-center text-sm font-medium text-white focus:outline-none focus:ring-4 sm:w-auto">{!! __('client.accept_all') !!}</button>
                    <button id="block-cookies" type="button"
                        class="mr-2 w-full rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 sm:w-auto">{!! __('client.reject_all') !!}</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to check user's cookie consent
        function checkCookieConsent() {
            const userChoice = localStorage.getItem('cookieConsent');

            if (userChoice) {
                if (userChoice === 'accepted') {
                    // Cookies accepted; you can initialize cookie-based tracking here
                } else {
                    // Cookies blocked; you can disable cookie-based tracking here
                }
            } else {
                // If the user has not made a choice yet, show the cookies modal
                cookiesModal.show();
            }
        }

        // Initialize modal
        const modalEl = document.getElementById('cookies-modal');
        const cookiesModal = new Modal(modalEl, {
            placement: 'center'
        });

        // Event listener for the "Accept Cookies" button
        const acceptCookiesEl = document.getElementById('accept-cookies');
        acceptCookiesEl.addEventListener('click', function() {
            localStorage.setItem('cookieConsent', 'accepted');
            // Cookies accepted; you can initialize cookie-based tracking here
            cookiesModal.hide();
        });

        // Event listener for the "Block Cookies" button
        const blockCookiesEl = document.getElementById('block-cookies');
        blockCookiesEl.addEventListener('click', function() {
            localStorage.setItem('cookieConsent', 'blocked');
            // Cookies blocked; you can disable cookie-based tracking here
            cookiesModal.hide();
        });

        // Check user's cookie consent when the page loads
        window.addEventListener('load', function() {
            checkCookieConsent();
        });
    </script>
@endif
