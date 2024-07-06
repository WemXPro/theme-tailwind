@extends(Theme::path('auth.registration.layout'))

@section('content')
    <div class="w-full">
        <div class="mb-8 flex items-center justify-center space-x-4 lg:hidden">
            <a href="#" class="flex items-center text-2xl font-semibold">
                <img class="mr-2 h-8 w-8" src="@settings('logo', '/assets/core/img/logo.png')" />
                <span class="text-gray-900 dark:text-white">@settings('app_name', 'WemX')</span>
            </a>
        </div>
        <ol class="mb-6 flex items-center text-center text-sm font-medium text-gray-500 dark:text-gray-400 sm:text-base lg:mb-12">
            <li
                class="text-primary-600 dark:text-primary-500 after:border-1 flex items-center after:mx-6 after:hidden after:h-1 after:w-12 after:border-b after:border-gray-200 dark:after:border-gray-700 sm:after:inline-block sm:after:content-[''] xl:after:mx-10">
                <div
                    class="flex items-center after:mx-2 after:font-light after:text-gray-200 after:content-['/'] dark:after:text-gray-500 sm:block sm:after:hidden">
                    <svg class="mr-2 h-4 w-4 sm:mx-auto sm:mb-2 sm:h-6 sm:w-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    {!! __('auth.account_details', ['default' => 'Account <span class="hidden sm:inline-flex">Details</span>']) !!}
                </div>
            </li>
            <li
                class="after:border-1 flex items-center after:mx-6 after:hidden after:h-1 after:w-12 after:border-b after:border-gray-200 after:content-[''] dark:after:border-gray-700 sm:after:inline-block xl:after:mx-10">
                <div
                    class="flex items-center after:mx-2 after:font-light after:text-gray-200 after:content-['/'] dark:after:text-gray-500 sm:block sm:after:hidden">
                    <div class="mr-2 sm:mx-auto sm:mb-2">2</div>
                    {!! __('auth.email_verification', ['default' => 'Email Verification']) !!}

                </div>
            </li>
            <li class="flex items-center sm:block">
                <div class="mr-2 sm:mx-auto sm:mb-2">3</div>
                {!! __('auth.confirmation', ['default' => 'Confirmation']) !!}
            </li>
        </ol>
        <h1 class="leding-tight mb-4 text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white sm:mb-6">
            {!! __('auth.account_details', ['default' => 'Account details']) !!}
        </h1>

        {{-- include alerts --}}
        @include(Theme::path('layouts.alerts'))

        <form method="POST" action="#">
            @csrf
            <div class="my-6 grid gap-5 sm:grid-cols-2">
                <div>
                    <label for="first_name" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                        {!! __('auth.first_name', ['default' => 'First Name']) !!}
                    </label>
                    <input type="text" name="first_name" id="first_name" onchange="generateUsername()"
                        class="focus:ring-primary-600 focus:border-primary-600 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:text-sm"
                        placeholder="{!! __('John') !!}" required="">
                </div>
                <div>
                    <label for="last_name" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                        {!! __('auth.name', ['default' => 'Last Name']) !!}
                    </label>
                    <input type="text" name="last_name" id="last_name"
                        class="focus:ring-primary-600 focus:border-primary-600 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:text-sm"
                        placeholder="Smith" required="">
                </div>
            </div>
            <div class="my-6 grid gap-5 sm:grid-cols-1">
                <div>

                    <label for="username" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">{!! __('auth.your_username') !!}</label>
                    <input type="text" name="username" id="username" oninput="usernameAvailability(this.value)"
                        class="focus:ring-primary-600 focus:border-primary-600 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:text-sm"
                        placeholder="{!! __('auth.username') !!}" required="">
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500" style="display: none;" id="username_error_desc"></p>
                </div>
            </div>
            <div class="my-6 grid gap-5 sm:grid-cols-1">
                <div>
                    <label for="email" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">{!! __('auth.your_email') !!}</label>
                    <input type="email" name="email" id="email"
                        class="focus:ring-primary-600 mb-1 focus:border-primary-600 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:text-sm"
                        placeholder="name@company.com" oninput="suggestProvider()" required="">
                    <div id="email_providers" style="display: none;">
                        @foreach(config('mail.extensions') as $extension)
                            <a onclick="appendProvider('{{ $extension }}')" href="#" class="mt-2 mr-1 text-sm text-primary-600 hover:underline dark:text-primary-500">{{ $extension }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="my-6 grid gap-5 sm:grid-cols-2">
                <div>
                    <label for="password" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">{!! __('auth.password') !!}</label>
                    <input type="password" name="password" id="password" placeholder="••••••••"
                        class="focus:ring-primary-600 focus:border-primary-600 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:text-sm"
                        required="">
                    {{-- <div id="passworbarhousing" class="w-2/5 mt-2 bg-gray-200 rounded-full h-1.5 dark:bg-gray-600">
                        <div id="passwordbar" class="bg-orange-500 h-1.5 rounded-full" style="width: 85%"></div>
                    </div> --}}
                    <p data-modal-target="password-modal" data-modal-toggle="password-modal" class="mt-2 text-sm text-gray-500 dark:text-gray-400"><a href="#" class="font-medium text-primary-600 hover:underline dark:text-primary-500">{{ __('client.generate_password') }}</a></p>
                </div>
                <div>
                    <label for="password_confirmation"
                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">{!! __('auth.confirm_password') !!}</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••"
                        class="focus:ring-primary-600 focus:border-primary-600 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:text-sm"
                        required="">
                </div>
            </div>
            <div class="mb-4 space-y-3">
                @if ($page = Page::wherePath('terms-and-conditions')->first())
                    <div class="mb-6 flex items-start">
                        <div class="flex h-5 items-center">
                            <input required="" id="terms" aria-describedby="terms" name="terms" type="checkbox"
                                class="focus:ring-3 h-4 w-4 rounded border-gray-300 bg-gray-50 focus:ring-primary-300 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="terms" class="font-medium text-gray-900 dark:text-white">{!! __('client.i_accept_the') !!}<a
                                    class="ml-1 text-primary-700 hover:underline dark:text-primary-500" href="{{ route('page', $page->path) }}"
                                    target="_blank">{!! __('client.terms_and_conditions') !!}</a></label>
                        </div>
                    </div>
                @endif

                @if (Settings::getJson('encrypted::captcha::cloudflare', 'page_register', false))
                    <x-turnstile />
                @endif
            </div>
            <div class="flex space-x-3">
                <button type="submit"
                    class="bg-primary-600 hover:bg-primary-700 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 w-full rounded-lg px-5 py-2.5 text-center text-sm font-medium text-white focus:outline-none focus:ring-4 sm:py-3.5">
                    {!! __('pagination.next') !!}: {!! __('auth.email_verification') !!}
                </button>
            </div>
        </form>
    </div>

<!-- Password Generator Modal -->
<div id="password-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    {{ __('client.generate_password') }}
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="password-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">

                <div>
                    <label for="quantity-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('client.minimum_characters') }}</label>
                    <div class="relative flex items-center max-w-[8rem]">
                        <button type="button" id="decrement-button" data-input-counter-decrement="password_length" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                            <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                            </svg>
                        </button>
                        <input type="text" min="6" id="password_length" data-input-counter aria-describedby="helper-text-explanation" value="12" class="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-primary-500 focus:border-primary-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="999" required />
                        <button type="button" id="increment-button" data-input-counter-increment="password_length" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                            <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div>
                    <label for="helper-text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('client.generated_password') }}</label>
                    <input type="text" id="generated_password" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 mb-3 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    <button onclick="regenPassword()" type="button" class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        <svg class="w-4 h-4 me-2 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.651 7.65a7.131 7.131 0 0 0-12.68 3.15M18.001 4v4h-4m-7.652 8.35a7.13 7.13 0 0 0 12.68-3.15M6 20v-4h4"/>
                          </svg>
                            {{ __('client.regenerate') }}
                    </button>
                    <button onclick="copyPassword()" type="button" class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        <svg class="w-4 h-4 me-2 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M7 9v6a4 4 0 0 0 4 4h4a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h1v2Z" clip-rule="evenodd"/>
                            <path fill-rule="evenodd" d="M13 3.054V7H9.2a2 2 0 0 1 .281-.432l2.46-2.87A2 2 0 0 1 13 3.054ZM15 3v4a2 2 0 0 1-2 2H9v6a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2h-3Z" clip-rule="evenodd"/>
                          </svg>
                            <span id="copy_password">{{ __('client.copy') }}</span>
                    </button>
                </div>

            </div>
            <!-- Modal footer -->
            <div class="flex items-center justify-end p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button data-modal-hide="password-modal" type="button" class="py-2.5 px-5 mr-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">{{ __('client.dismiss') }}</button>
                <button onclick="copyAndUse()" data-modal-hide="password-modal" type="button" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">{{ __('client.copy_and_insert') }}</button>
            </div>
        </div>
    </div>
</div>

<script>
    function generateUsername() {
        // only generate username if the username field is empty
        var usernameField = document.getElementById('username');
        if (usernameField.value === '')
        {
            var first_name = document.getElementById('first_name').value;
            var username = first_name;
            usernameField.value = username.toLowerCase().replace(/\s/g, '');
            usernameAvailability(usernameField.value);
        }
    }

    function usernameAvailability(username) {
        fetch('/api/v1/users/username-availability?username=' + username, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest', // This header is to mimic an AJAX request
            },
        })
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                document.getElementById('username_error_desc').style.display = '';
                document.getElementById('username_error_desc').innerHTML = data.errors[0];
            } else {
                document.getElementById('username_error_desc').style.display = 'none';
                document.getElementById('username_error_desc').innerHTML = '';
            }
        })
        .catch((error) => {
            console.error('Error:', error.body);
        });
    }

    regenPassword();
    function regenPassword()
    {
        var length = document.getElementById('password_length').value;
        var result = '';
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_+';
        var charactersLength = characters.length;
        for ( var i = 0; i < length; i++ ) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        document.getElementById('generated_password').value = result;
    }

    function copyPassword() {
        var copyText = document.getElementById("generated_password");
        copyText.select();
        copyText.setSelectionRange(0, 99999)
        document.execCommand("copy");
        // set text to copied
        document.getElementById('copy_password').innerHTML = '{{ __('client.copied') }}';
    }

    function copyAndUse()
    {
        copyPassword();
        document.getElementById('password').value = document.getElementById('generated_password').value;
        document.getElementById('password_confirmation').value = document.getElementById('generated_password').value;

        // make the password field visible
        document.getElementById('password').type = 'text';
        document.getElementById('password_confirmation').type = 'text';
    }

    function suggestProvider() {
        // check if the email field contains @
        var email = document.getElementById('email').value;
        if (email.includes('@')) {
            // if contains . after @ then hide the email providers
            if (email.split('@')[1].includes('.')) {
                document.getElementById('email_providers').style.display = 'none';
                return;
            }

            // set display to block
            document.getElementById('email_providers').style.display = 'block';
        } else {
            // set display to none
            document.getElementById('email_providers').style.display = 'none';
        }
    }

    function appendProvider(provider) {
        var email = document.getElementById('email').value;

        // append extension after @
        var new_email = email.split('@')[0] + '@' + provider;
        document.getElementById('email').value = new_email;
        document.getElementById('email_providers').style.display = 'none';
    }
</script>
@endsection
