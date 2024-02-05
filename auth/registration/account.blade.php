@extends(Theme::path('auth.registration.layout'))

@section('content')
    <div class="w-full">
        <div class="mb-8 flex items-center justify-center space-x-4 lg:hidden">
            <a href="#" class="flex items-center text-2xl font-semibold">
                <img class="mr-2 h-8 w-8" src="@settings('logo', 'https://imgur.com/oJDxg2r.png')" />
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
                    <input type="text" name="first_name" id="first_name"
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
                    <input type="text" name="username" id="username"
                        class="focus:ring-primary-600 focus:border-primary-600 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:text-sm"
                        placeholder="{!! __('auth.username') !!}" required="">
                </div>
            </div>
            <div class="my-6 grid gap-5 sm:grid-cols-1">
                <div>
                    <label for="email" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">{!! __('auth.your_email') !!}</label>
                    <input type="email" name="email" id="email"
                        class="focus:ring-primary-600 focus:border-primary-600 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:text-sm"
                        placeholder="name@company.com" required="">
                </div>
            </div>
            <div class="my-6 grid gap-5 sm:grid-cols-2">
                <div>
                    <label for="password" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">{!! __('auth.password') !!}</label>
                    <input type="password" name="password" id="password" placeholder="••••••••"
                        class="focus:ring-primary-600 focus:border-primary-600 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:text-sm"
                        required="">
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
                                class="focus:ring-3 h-4 w-4 rounded border-gray-300 bg-gray-50 focus:ring-blue-300 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600" />
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="terms" class="font-medium text-gray-900 dark:text-white">{!! __('client.i_accept_the') !!}<a
                                    class="ml-1 text-blue-700 hover:underline dark:text-blue-500" href="{{ route('page', $page->path) }}"
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
@endsection
