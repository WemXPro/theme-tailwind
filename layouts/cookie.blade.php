{{-- Cookies --}}
<div id="cookies-modal" tabindex="-1" aria-hidden="false" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full p-4">
    <div class="overflow-y-auto relative p-4 w-full max-w-2xl h-[40rem] bg-white rounded-lg shadow md:p-6 dark:bg-gray-800">
        <a href="#" class="flex justify-center items-center mb-8 text-xl font-semibold text-gray-900 dark:text-white">
            <img src="@settings('logo')" class="mr-2 h-7 rounded" alt="logo">
            @settings('app_name', 'WemX')    
        </a>
        <div class="space-y-4 font-light text-gray-500 divide-y divide-gray-200 dark:text-gray-400 dark:divide-gray-700">
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
                <a href="#" data-collapse-toggle="cookies-info-2" class="inline-flex items-center text-sm font-medium text-primary-600 dark:text-primary-500 hover:underline">
                    {!! __('client.view_cookies') !!}
                    <svg class="ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </a>
                <div id="cookies-info-2" class="hidden overflow-x-auto relative mt-4 bg-gray-100 sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    Name
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Provider
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Expiration
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Purpose
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-gray-100 dark:bg-gray-800">
                                <th scope="row" class="py-4 px-6 font-light text-gray-500 whitespace-nowrap dark:text-gray-400">
                                   _cfduid
                                </th>
                                <td class="py-4 px-6">
                                    CloudFlare Inc
                                </td>
                                <td class="py-4 px-6">
                                    1 Year
                                </td>
                                <td class="py-4 px-6">
                                    Static file delivery
                                </td>
                            </tr>
                            <!-- Laravel Session Cookie -->
                            <tr class="bg-gray-100 dark:bg-gray-800">
                                <th scope="row" class="py-4 px-6 font-light text-gray-500 whitespace-nowrap dark:text-gray-400">
                                    laravel_session
                                </th>
                                <td class="py-4 px-6">
                                    @settings('app_name', 'WemX')
                                </td>
                                <td class="py-4 px-6">
                                    Session
                                </td>
                                <td class="py-4 px-6">
                                    Identifies a session instance for a user
                                </td>
                            </tr>
                            
                            <!-- Laravel XSRF-TOKEN Cookie (If not already included) -->
                            <tr class="bg-gray-100 dark:bg-gray-800">
                                <th scope="row" class="py-4 px-6 font-light text-gray-500 whitespace-nowrap dark:text-gray-400">
                                    XSRF-TOKEN
                                </th>
                                <td class="py-4 px-6">
                                    @settings('app_name', 'WemX')
                                </td>
                                <td class="py-4 px-6">
                                    Session
                                </td>
                                <td class="py-4 px-6">
                                    Prevent cross-site request forgery (CSRF) attacks
                                </td>
                            </tr>

                            <!-- Optional, if you are using Laravel API authentication -->
                            <tr class="bg-gray-100 dark:bg-gray-800">
                                <th scope="row" class="py-4 px-6 font-light text-gray-500 whitespace-nowrap dark:text-gray-400">
                                    laravel_token
                                </th>
                                <td class="py-4 px-6">
                                    @settings('app_name', 'WemX')
                                </td>
                                <td class="py-4 px-6">
                                    Session
                                </td>
                                <td class="py-4 px-6">
                                    API authentication
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
                    <a href="#" data-collapse-toggle="cookies-info-4" class="inline-flex items-center text-sm font-medium text-primary-600 dark:text-primary-500 hover:underline">
                        {!! __('client.view_cookies') !!}
                        <svg class="ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </a>
                </div>
                <label for="functional-cookies-toggle" class="inline-flex relative items-center cursor-pointer">
                    <input type="checkbox" value="" checked id="functional-cookies-toggle" class="sr-only peer">
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    <span class="sr-only">Toggle me</span>
                </label>
            </div>
            <div id="cookies-info-4" class="hidden overflow-x-auto relative mt-4 bg-gray-100 sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="py-3 px-6">
                                Name
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Provider
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Expiration
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Purpose
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-gray-100 dark:bg-gray-800">
                            <th scope="row" class="py-4 px-6 font-light text-gray-500 whitespace-nowrap dark:text-gray-400">
                               filter_orders
                            </th>
                            <td class="py-4 px-6">
                                @settings('app_name', 'WemX')
                            </td>
                            <td class="py-4 px-6">
                                Session
                            </td>
                            <td class="py-4 px-6">
                                Set preffered order status
                            </td>
                        </tr>
                        <tr class="bg-gray-100 dark:bg-gray-800">
                            <th scope="row" class="py-4 px-6 font-light text-gray-500 whitespace-nowrap dark:text-gray-400">
                                <-article->-feedback
                            </th>
                            <td class="py-4 px-6">
                                @settings('app_name', 'WemX')
                            </td>
                            <td class="py-4 px-6">
                                Session
                            </td>
                            <td class="py-4 px-6">
                                Collect Article Feedback
                            </td>
                        </tr>
                        <tr class="bg-gray-100 dark:bg-gray-800">
                            <th scope="row" class="py-4 px-6 font-light text-gray-500 whitespace-nowrap dark:text-gray-400">
                                affiliate
                            </th>
                            <td class="py-4 px-6">
                                @settings('app_name', 'WemX')
                            </td>
                            <td class="py-4 px-6">
                                Session
                            </td>
                            <td class="py-4 px-6">
                                Track users invited by affiliates
                            </td>
                        </tr>
                        <tr class="bg-gray-100 dark:bg-gray-800">
                            <th scope="row" class="py-4 px-6 font-light text-gray-500 whitespace-nowrap dark:text-gray-400">
                                affiliate_invite
                            </th>
                            <td class="py-4 px-6">
                                @settings('app_name', 'WemX')
                            </td>
                            <td class="py-4 px-6">
                                Session
                            </td>
                            <td class="py-4 px-6">
                                Keep track of affiliate invites
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="justify-between items-center mt-5 space-y-4 sm:flex sm:space-y-0">
            <div class="flex items-center space-x-4 text-sm text-gray-500 dark:text-gray-400">
                <button  id="accept-cookies" type="button" class="text-white w-full sm:w-auto bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">{!! __('client.accept_all') !!}</button>
                <button id="block-cookies" type="button" class="py-2.5 px-5 mr-2 w-full sm:w-auto text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">{!! __('client.reject_all') !!}</button>
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