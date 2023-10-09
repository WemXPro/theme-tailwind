@extends(Theme::path('auth.registration.layout'))

@section('content')
    <div class="w-full">
        <div class="flex items-center justify-center mb-8 space-x-4 lg:hidden">
            <a href="#" class="flex items-center text-2xl font-semibold">
                <img class="w-8 h-8 mr-2" src="@settings('logo', 'https://imgur.com/oJDxg2r.png')" alt="logo"/>
                <span class="text-gray-900 dark:text-white">@settings('app_name', 'WemX')</span>
            </a>
        </div>
        <ol
            class="flex items-center mb-6 text-sm font-medium text-center text-gray-500 dark:text-gray-400 lg:mb-12 sm:text-base">
            <li
                class="flex items-center text-primary-600 dark:text-primary-500 sm:after:content-[''] after:w-12 after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                <div
                    class="flex items-center sm:block after:content-['/'] sm:after:hidden after:mx-2 after:font-light after:text-gray-200 dark:after:text-gray-500">
                    <svg class="w-4 h-4 mr-2 sm:mb-2 sm:w-6 sm:h-6 sm:mx-auto shrink-0" fill="currentColor"
                         viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                              clip-rule="evenodd"></path>
                    </svg>
                    {!! __('auth.personal') !!} <span class="hidden sm:inline-flex">{!! __('auth.info') !!}</span>
                </div>
            </li>
            <li
                class="flex items-center text-primary-600 dark:text-primary-500 after:content-[''] after:w-12 after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                <div
                    class="flex items-center sm:block after:content-['/'] sm:after:hidden after:mx-2 after:font-light after:text-gray-200 dark:after:text-gray-500">
                    <svg class="w-4 h-4 mr-2 sm:mb-2 sm:w-6 sm:h-6 sm:mx-auto shrink-0" fill="currentColor"
                         viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                              clip-rule="evenodd"></path>
                    </svg>
                    {!! __('auth.account') !!} <span class="hidden sm:inline-flex">{!! __('auth.info') !!}</span>
                </div>
            </li>
            <li class="flex items-center sm:block">
                <div class="mr-2 sm:mb-2 sm:mx-auto">3</div>
                {!! __('auth.confirmation') !!}
            </li>
        </ol>

        {{-- include alerts --}}
        @include(Theme::path('layouts.alerts'))

        <h1 class="mb-2 text-2xl font-extrabold tracking-tight text-gray-900 leding-tight dark:text-white">
           {!! __('auth.verify_email_address') !!}</h1>
        <p class="font-light text-gray-500 dark:text-gray-400">{!! __('auth.send_code') !!} <span
                class="font-medium text-gray-900 dark:text-white">{{ Auth::user()->email }}</span>.
            {!! __('auth.confirm_code') !!}</p>
        <form action="{{ route('verification.validate') }}" method="POST">
            @csrf
            <div class="flex my-4 space-x-2 sm:space-x-4 md:my-6">
                <div>
                    <label for="code-1" class="sr-only">{!! __('auth.first_code') !!}</label>
                    <input type="text" maxlength="1" onkeyup="focusNextInput(this, 'code-1', 'code-2')" id="code-1"
                           name="first_digit" @if(request()->input('code')) value="{{ request()->input('code')[0] }}"
                           @endif
                           class="block w-12 h-12 py-3 text-2xl font-extrabold text-center text-gray-900 bg-white border border-gray-300 rounded-lg sm:py-4 sm:text-4xl sm:w-16 sm:h-16 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                           required>
                </div>
                <div>
                    <label for="code-2" class="sr-only">{!! __('auth.second_code') !!}</label>
                    <input type="text" maxlength="1" onkeyup="focusNextInput(this, 'code-1', 'code-3')" id="code-2"
                           name="second_digit" @if(request()->input('code')) value="{{ request()->input('code')[1] }}"
                           @endif
                           class="block w-12 h-12 py-3 text-2xl font-extrabold text-center text-gray-900 bg-white border border-gray-300 rounded-lg sm:py-4 sm:text-4xl sm:w-16 sm:h-16 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                           required>
                </div>
                <div>
                    <label for="code-3" class="sr-only">{!! __('auth.third_code') !!}</label>
                    <input type="text" maxlength="1" onkeyup="focusNextInput(this, 'code-2', 'code-4')" id="code-3"
                           name="third_digit" @if(request()->input('code')) value="{{ request()->input('code')[2] }}"
                           @endif
                           class="block w-12 h-12 py-3 text-2xl font-extrabold text-center text-gray-900 bg-white border border-gray-300 rounded-lg sm:py-4 sm:text-4xl sm:w-16 sm:h-16 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                           required>
                </div>
                <div>
                    <label for="code-4" class="sr-only">{!! __('auth.fourth_code') !!}</label>
                    <input type="text" maxlength="1" onkeyup="focusNextInput(this, 'code-3', 'code-5')" id="code-4"
                           name="fourth_digit" @if(request()->input('code')) value="{{ request()->input('code')[3] }}"
                           @endif
                           class="block w-12 h-12 py-3 text-2xl font-extrabold text-center text-gray-900 bg-white border border-gray-300 rounded-lg sm:py-4 sm:text-4xl sm:w-16 sm:h-16 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                           required>
                </div>
                <div>
                    <label for="code-5" class="sr-only">{!! __('auth.fifth_code') !!}</label>
                    <input type="text" maxlength="1" onkeyup="focusNextInput(this, 'code-4', 'code-6')" id="code-5"
                           name="fifth_digit" @if(request()->input('code')) value="{{ request()->input('code')[4] }}"
                           @endif
                           class="block w-12 h-12 py-3 text-2xl font-extrabold text-center text-gray-900 bg-white border border-gray-300 rounded-lg sm:py-4 sm:text-4xl sm:w-16 sm:h-16 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                           required>
                </div>
                <div>
                    <label for="code-6" class="sr-only">{!! __('auth.sixth_code') !!}</label>
                    <input type="text" maxlength="1" onkeyup="focusNextInput(this, 'code-5', 'code-6')" id="code-6"
                           name="sixth_digit" @if(request()->input('code')) value="{{ request()->input('code')[5] }}"
                           @endif
                           class="block w-12 h-12 py-3 text-2xl font-extrabold text-center text-gray-900 bg-white border border-gray-300 rounded-lg sm:py-4 sm:text-4xl sm:w-16 sm:h-16 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                           required>
                </div>
            </div>
            <p class="p-4 mb-4 text-sm text-gray-500 rounded-lg bg-gray-50 dark:text-gray-400 md:mb-6 dark:bg-gray-800">
                {!! __('auth.sure_keep_window_open') !!}</p>
            <div class="flex space-x-3">
                <button type="submit"
                        class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4
                        focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5
                        py-2.5 sm:py-3.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    {!! __('auth.verify_account') !!}
                </button>
            </div>
        </form>
    </div>

    <script>
        function focusNextInput(el, prevId, nextId) {
            if (el.value.length === 0) {
                document.getElementById(prevId).focus();
            } else {
                document.getElementById(nextId).focus();
            }
        }
    </script>
@endsection
