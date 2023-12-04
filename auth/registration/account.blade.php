@extends(Theme::path('auth.registration.layout'))

@section('content')
    <div class="w-full">
        <div class="flex items-center justify-center mb-8 space-x-4 lg:hidden">
            <a href="#" class="flex items-center text-2xl font-semibold">
                <img class="w-8 h-8 mr-2" src="@settings('logo', 'https://imgur.com/oJDxg2r.png')" />
                <span class="text-gray-900 dark:text-white">@settings('app_name', 'WemX')</span>
            </a>
        </div>
        <ol
            class="flex items-center mb-6 text-sm font-medium text-center text-gray-500 dark:text-gray-400 lg:mb-12 sm:text-base">
            <li
                class="flex items-center text-primary-600 dark:text-primary-500 sm:after:content-[''] after:w-12 after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                <div
                    class="flex items-center sm:block after:content-['/'] sm:after:hidden after:mx-2 after:font-light after:text-gray-200 dark:after:text-gray-500">
                    <svg class="w-4 h-4 mr-2 sm:mb-2 sm:w-6 sm:h-6 sm:mx-auto" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    {!! __('auth.account_details', ['default' => 'Account <span class="hidden sm:inline-flex">Details</span>']) !!}
                </div>
            </li>
            <li
                class="flex items-center after:content-[''] after:w-12 after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                <div
                    class="flex items-center sm:block after:content-['/'] sm:after:hidden after:mx-2 after:font-light after:text-gray-200 dark:after:text-gray-500">
                    <div class="mr-2 sm:mb-2 sm:mx-auto">2</div>
                    {!! __('auth.email_verification', ['default' => 'Email Verification']) !!}

                </div>
            </li>
            <li class="flex items-center sm:block">
                <div class="mr-2 sm:mb-2 sm:mx-auto">3</div>
                {!! __('auth.confirmation', ['default' => 'Confirmation']) !!}
            </li>
        </ol>
        <h1 class="mb-4 text-2xl font-extrabold tracking-tight text-gray-900 sm:mb-6 leding-tight dark:text-white">
            {!! __('auth.account_details', ['default' => 'Account details']) !!}
        </h1>

        {{-- include alerts --}}
        @include(Theme::path('layouts.alerts'))

        <form method="POST" action="#">
            @csrf
            <div class="grid gap-5 my-6 sm:grid-cols-2">
                <div>
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        {!! __('auth.first_name', ['default' => 'First Name']) !!}
                    </label>
                    <input type="text" name="first_name" id="first_name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                        placeholder="{!! __('John') !!}" required="" value="{{ old('first_name') }}">
                </div>
                <div>
                    <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        {!! __('auth.name', ['default' => 'Last Name']) !!}
                    </label>
                    <input type="text" name="last_name" id="last_name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                        placeholder="Smith" required="" value="{{ old('last_name') }}">
                </div>
            </div>
            <div class="grid gap-5 my-6 sm:grid-cols-1">
                <div>

                    <label for="username"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{!! __('auth.your_username') !!}</label>
                    <input type="text" name="username" id="username"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                        placeholder="{!! __('auth.username') !!}" required="" value="{{ old('username') }}">
                </div>
            </div>
            <div class="grid gap-5 my-6 sm:grid-cols-1">
                <div>
                    <label for="email"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{!! __('auth.your_email') !!}</label>
                    <input type="email" name="email" id="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                        placeholder="name@company.com" required="" value="{{ old('email') }}">
                </div>
            </div>
            <div class="grid gap-5 my-6 sm:grid-cols-2">
                <div>
                    <label for="password"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{!! __('auth.password') !!}</label>
                    <input type="password" name="password" id="password" placeholder="••••••••"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                        required="">
                </div>
                <div>
                    <label for="password_confirmation"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{!! __('auth.confirm_password') !!}</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                        required="">
                </div>
            </div>
            <div class="space-y-3">

                @if ($page = Page::wherePath('terms-and-conditions')->first())
                    <div class="flex items-start mb-6">
                        <div class="flex items-center h-5">
                            <input required="" id="terms" aria-describedby="terms" name="terms" type="checkbox"
                                class="w-4 h-4 bg-gray-50 rounded border-gray-300 focus:ring-3 focus:ring-blue-300 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600" />
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="terms"
                                class="font-medium text-gray-900 dark:text-white">{!! __('client.i_accept_the') !!}<a
                                    class="ml-1 text-blue-700 dark:text-blue-500 hover:underline"
                                    href="{{ route('page', $page->path) }}"
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
                    class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 sm:py-3.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    {!! __('pagination.next') !!}: {!! __('auth.email_verification') !!}
                </button>
            </div>
        </form>
    </div>
@endsection
