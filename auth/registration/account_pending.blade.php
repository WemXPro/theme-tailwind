@extends(Theme::path('auth.registration.layout'))

@section('content')
    <div class="w-full">
        <div class="mb-8 flex items-center justify-center space-x-4 lg:hidden">
            <a href="#" class="flex items-center text-2xl font-semibold">
                <img class="mr-2 h-8 w-8" src="@settings('logo', '/assets/core/img/logo.png')" alt="{{ __('logo') }}" />
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
            <li class="text-primary-600 dark:text-primary-500 flex items-center">
                <div class="flex items-center sm:block">
                    <svg class="mr-2 h-4 w-4 shrink-0 sm:mx-auto sm:mb-2 sm:h-6 sm:w-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    {!! __('auth.confirmation') !!}
                </div>
            </li>
        </ol>
        <svg class="mb-4 h-12 w-12 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                clip-rule="evenodd"></path>
        </svg>
        <h1 class="leding-tight mb-2 text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white">{!! __('auth.approval_required') !!}
        </h1>
        <p class="mb-4 font-light text-gray-500 dark:text-gray-400 md:mb-6">
            {!! __('auth.approval_required_desc') !!}</p>
        <a href="#"
            class="bg-primary-600 hover:bg-primary-700 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 block w-full rounded-lg px-5 py-2.5 text-center text-sm font-medium text-white focus:outline-none focus:ring-4 sm:py-3.5">
            {!! __('admin.try_again') !!}</a>
    </div>
@endsection
