@extends(Theme::path('auth.registration.layout'))

@section('content')
    <div class="w-full">
        <div class="mb-8 flex items-center justify-center space-x-4 lg:hidden">
            <a href="#" class="flex items-center text-2xl font-semibold">
                <img class="mr-2 h-8 w-8" src="@settings('logo', '/assets/core/img/logo.png')" alt="logo" />
                <span class="text-gray-900 dark:text-white">@settings('app_name', 'WemX')</span>
            </a>
        </div>
        <ol class="mb-6 flex items-center text-center text-sm font-medium text-gray-500 dark:text-gray-400 sm:text-base lg:mb-12">
            <li
                class="text-primary-600 dark:text-primary-500 after:border-1 flex items-center after:mx-6 after:hidden after:h-1 after:w-12 after:border-b after:border-gray-200 dark:after:border-gray-700 sm:after:inline-block sm:after:content-[''] xl:after:mx-10">
                <div
                    class="flex items-center after:mx-2 after:font-light after:text-gray-200 after:content-['/'] dark:after:text-gray-500 sm:block sm:after:hidden">
                    <svg class="mr-2 h-4 w-4 shrink-0 sm:mx-auto sm:mb-2 sm:h-6 sm:w-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    {!! __('auth.personal') !!} <span class="hidden sm:inline-flex">{!! __('auth.info') !!}</span>
                </div>
            </li>
            <li
                class="text-primary-600 dark:text-primary-500 after:border-1 flex items-center after:mx-6 after:hidden after:h-1 after:w-12 after:border-b after:border-gray-200 after:content-[''] dark:after:border-gray-700 sm:after:inline-block xl:after:mx-10">
                <div
                    class="flex items-center after:mx-2 after:font-light after:text-gray-200 after:content-['/'] dark:after:text-gray-500 sm:block sm:after:hidden">
                    <svg class="mr-2 h-4 w-4 shrink-0 sm:mx-auto sm:mb-2 sm:h-6 sm:w-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    {!! __('auth.account') !!} <span class="hidden sm:inline-flex">{!! __('auth.info') !!}</span>
                </div>
            </li>
            <li class="flex items-center sm:block">
                <div class="mr-2 sm:mx-auto sm:mb-2">3</div>
                {!! __('auth.confirmation') !!}
            </li>
        </ol>

        {{-- include alerts --}}
        @include(Theme::path('layouts.alerts'))

        <h1 class="leding-tight mb-2 text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white">
            {!! __('auth.verify_email_address') !!}</h1>
        <p class="font-light text-gray-500 dark:text-gray-400">{!! __('auth.send_code') !!} <span
                class="font-medium text-gray-900 dark:text-white">{{ Auth::user()->email }}</span>.
            {!! __('auth.confirm_code') !!}</p>
        <form action="{{ route('verification.validate') }}" method="POST">
            @csrf
            <div class="my-4 flex space-x-2 sm:space-x-4 md:my-6">
                <div>
                    <label for="code-1" class="sr-only">{!! __('auth.first_code') !!}</label>
                    <input type="text" maxlength="1" onkeyup="focusNextInput(this, 'code-1', 'code-2')" id="code-1" name="first_digit"
                        @if (request()->input('code')) value="{{ request()->input('code')[0] }}" @endif
                        class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block h-12 w-12 rounded-lg border border-gray-300 bg-white py-3 text-center text-2xl font-extrabold text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:h-16 sm:w-16 sm:py-4 sm:text-4xl"
                        required>
                </div>
                <div>
                    <label for="code-2" class="sr-only">{!! __('auth.second_code') !!}</label>
                    <input type="text" maxlength="1" onkeyup="focusNextInput(this, 'code-1', 'code-3')" id="code-2" name="second_digit"
                        @if (request()->input('code')) value="{{ request()->input('code')[1] }}" @endif
                        class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block h-12 w-12 rounded-lg border border-gray-300 bg-white py-3 text-center text-2xl font-extrabold text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:h-16 sm:w-16 sm:py-4 sm:text-4xl"
                        required>
                </div>
                <div>
                    <label for="code-3" class="sr-only">{!! __('auth.third_code') !!}</label>
                    <input type="text" maxlength="1" onkeyup="focusNextInput(this, 'code-2', 'code-4')" id="code-3" name="third_digit"
                        @if (request()->input('code')) value="{{ request()->input('code')[2] }}" @endif
                        class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block h-12 w-12 rounded-lg border border-gray-300 bg-white py-3 text-center text-2xl font-extrabold text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:h-16 sm:w-16 sm:py-4 sm:text-4xl"
                        required>
                </div>
                <div>
                    <label for="code-4" class="sr-only">{!! __('auth.fourth_code') !!}</label>
                    <input type="text" maxlength="1" onkeyup="focusNextInput(this, 'code-3', 'code-5')" id="code-4" name="fourth_digit"
                        @if (request()->input('code')) value="{{ request()->input('code')[3] }}" @endif
                        class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block h-12 w-12 rounded-lg border border-gray-300 bg-white py-3 text-center text-2xl font-extrabold text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:h-16 sm:w-16 sm:py-4 sm:text-4xl"
                        required>
                </div>
                <div>
                    <label for="code-5" class="sr-only">{!! __('auth.fifth_code') !!}</label>
                    <input type="text" maxlength="1" onkeyup="focusNextInput(this, 'code-4', 'code-6')" id="code-5" name="fifth_digit"
                        @if (request()->input('code')) value="{{ request()->input('code')[4] }}" @endif
                        class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block h-12 w-12 rounded-lg border border-gray-300 bg-white py-3 text-center text-2xl font-extrabold text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:h-16 sm:w-16 sm:py-4 sm:text-4xl"
                        required>
                </div>
                <div>
                    <label for="code-6" class="sr-only">{!! __('auth.sixth_code') !!}</label>
                    <input type="text" maxlength="1" onkeyup="focusNextInput(this, 'code-5', 'code-6')" id="code-6" name="sixth_digit"
                        @if (request()->input('code')) value="{{ request()->input('code')[5] }}" @endif
                        class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block h-12 w-12 rounded-lg border border-gray-300 bg-white py-3 text-center text-2xl font-extrabold text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:h-16 sm:w-16 sm:py-4 sm:text-4xl"
                        required>
                </div>
            </div>
            <p class="mb-4 rounded-lg bg-gray-50 p-4 text-sm text-gray-500 dark:bg-gray-800 dark:text-gray-400 md:mb-6">
                {!! __('auth.sure_keep_window_open') !!}</p>
            <div class="flex space-x-3">
                <button type="submit"
                    class="bg-primary-600 hover:bg-primary-700 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 w-full rounded-lg px-5 py-2.5 text-center text-sm font-medium text-white focus:outline-none focus:ring-4 sm:py-3.5">
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
        document.querySelectorAll('input[id^="code-"]').forEach(input => {
            input.addEventListener('paste', function(event) {
                event.preventDefault();
                const pasteData = event.clipboardData.getData('text').trim();
                if (pasteData.length === 6) {
                    pasteData.split('').forEach((char, index) => {
                        const field = document.getElementById(`code-${index + 1}`);
                        if (field) {
                            field.value = char;
                        }
                    });
                }
            });
        });
    </script>
@endsection
