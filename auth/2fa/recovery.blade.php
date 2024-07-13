@extends(Theme::wrapper())

@section('title', 'Recover 2FA')

@section('container')
    <section class="flex" style="height: 100%;">
        <div class="mx-auto max-w-screen-md px-4 py-8 lg:py-16" style="width: 100%;">
            <div class="stepper mb-8">
                <ol class="flex w-full items-center text-center text-sm font-medium text-gray-500 dark:text-gray-400 sm:text-base">
                    <li
                        class="after:border-1 flex items-center text-primary-600 after:mx-6 after:hidden after:h-1 after:w-full after:border-b after:border-gray-200 dark:text-primary-500 dark:after:border-gray-700 sm:after:inline-block sm:after:content-[''] md:w-full xl:after:mx-10">
                        <span
                            class="flex items-center after:mx-2 after:text-gray-200 after:content-['/'] dark:after:text-gray-500 sm:after:hidden">
                            <svg class="mr-2.5 h-3.5 w-3.5 sm:h-4 sm:w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                            </svg>

                            {!! __('auth.setup') !!}<span class="hidden sm:ml-2 sm:inline-flex">({!! __('auth.2fa') !!})</span>

                        </span>
                    </li>
                    <li
                        class="after:border-1 flex items-center text-primary-600 after:mx-6 after:hidden after:h-1 after:w-full after:border-b after:border-gray-200 dark:text-primary-500 dark:after:border-gray-700 sm:after:inline-block sm:after:content-[''] md:w-full xl:after:mx-10">
                        <span
                            class="flex items-center after:mx-2 after:text-gray-200 after:content-['/'] dark:after:text-gray-500 sm:after:hidden">
                            <svg class="mr-2.5 h-3.5 w-3.5 sm:h-4 sm:w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                            </svg>

                            {!! __('auth.recovery') !!}<span class="hidden sm:ml-2 sm:inline-flex">({!! __('auth.codes') !!})</span>

                        </span>
                    </li>
                    <li class="flex items-center">
                        <span class="mr-2">3</span>

                        {!! __('auth.confirmation') !!}
                    </li>
                </ol>
            </div>

            <div class="rounded-lg border border-gray-200 bg-white p-6 shadow dark:border-gray-700 dark:bg-gray-800">

                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{!! __('auth.recovery_codes') !!}</h5>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{!! __('auth.recovery_in_case_lost_access_to_device') !!}</p>

                <div id="alert-additional-content-1"
                    class="mb-4 rounded-lg border border-primary-300 bg-primary-50 p-4 text-primary-800 dark:border-primary-800 dark:bg-gray-800 dark:text-primary-400"
                    role="alert">
                    <div class="flex items-center">
                        <svg class="mr-2 h-4 w-4 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>

                        <span class="sr-only">{!! __('auth.info') !!}</span>
                        <h3 class="text-lg font-medium">{!! __('auth.keep_recovery_codes_safe') !!}</h3>
                    </div>
                    <div class="mb-4 mt-2 text-sm">
                        {!! __('auth.lose_access_to_2fa_device') !!}
                    </div>
                </div>

                <div class="mb-3 mt-6 columns-3">
                    @foreach ($recoveryCodes as $key => $code)
                        <h5 class="mb-2 text-center text-xl font-bold tracking-tight text-gray-500 dark:text-gray-300">{{ $code }}</h5>
                    @endforeach
                </div>

                <form action="{{ route('2fa.activate') }}" method="POST">
                    @csrf
                    <div style="display: flex;align-items: flex-end;justify-content: space-between;">
                        <div class="flex items-center">
                            <input id="default-checkbox" name="stored_recovery" required="" type="checkbox" value="1"
                                class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600">

                            <label for="default-checkbox"
                                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{!! __('auth.confirm_safely_stored_codes') !!}</label>

                        </div>

                        <div class="mt-4 flex justify-end">
                            <a href="{{ route('2fa.recovery.download') }}"
                                class="mr-2 inline-flex items-center rounded-lg bg-primary-700 px-3 py-2 text-center text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">

                                {!! __('client.download') !!}
                                <i class='bx bx-cloud-download ml-2' style="font-size: 20px"></i>
                            </a>
                            <button href="submit"
                                class="inline-flex items-center rounded-lg bg-primary-700 px-3 py-2 text-center text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                {!! __('auth.activate') !!}

                                <svg class="ml-2 h-3.5 w-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <style>
        svg {
            border-radius: 0.25rem;
        }
    </style>
@endsection
