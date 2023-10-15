@extends(Theme::path('auth.registration.layout'))

@section('content')
    <div class="w-full">
        <div class="flex items-center justify-center mb-8 space-x-4 lg:hidden">
            <a href="#" class="flex items-center text-2xl font-semibold">
                <img class="w-8 h-8 mr-2" src="@settings('logo', 'https://imgur.com/oJDxg2r.png')"  alt="{{__('logo')}}"/>
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
            <li class="flex items-center text-primary-600 dark:text-primary-500">
                <div class="flex items-center sm:block">
                    <svg class="w-4 h-4 mr-2 sm:mb-2 sm:w-6 sm:h-6 sm:mx-auto shrink-0" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    {!! __('auth.confirmation') !!}
                </div>
            </li>
        </ol>
        <svg class="w-12 h-12 mb-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                clip-rule="evenodd"></path>
        </svg>
        <h1 class="mb-2 text-2xl font-extrabold tracking-tight text-gray-900 leding-tight dark:text-white">{!! __('auth.approval_required') !!}
        </h1>
        <p class="mb-4 font-light text-gray-500 dark:text-gray-400 md:mb-6">
            {!! __('auth.approval_required_desc') !!}</p>
        <a href="#"
            class="block w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300
            font-medium rounded-lg text-sm px-5 py-2.5 sm:py-3.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
            {!! __('admin.try_again') !!}</a>
    </div>
@endsection
