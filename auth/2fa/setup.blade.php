@extends(Theme::wrapper())

@section('title', 'Setup 2FA')

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
                        class="after:border-1 flex items-center after:mx-6 after:hidden after:h-1 after:w-full after:border-b after:border-gray-200 after:content-[''] dark:after:border-gray-700 sm:after:inline-block md:w-full xl:after:mx-10">
                        <span
                            class="flex items-center after:mx-2 after:text-gray-200 after:content-['/'] dark:after:text-gray-500 sm:after:hidden">
                            <span class="mr-2">2</span>
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
                <div class="mb-6 flex justify-center rounded" data-tooltip-target="tooltip-secret_key">
                    {!! $QRcode !!}
                </div>

                <div id="tooltip-secret_key" role="tooltip"
                    class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700">
                    {{ $secretKey }}
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>

                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{!! __('auth.scan_qr_code') !!} </p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{!! __('auth.enter_digit_code_authenticator_app') !!}</p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{!! __('auth.contine_next_step') !!}</p>

                <div data-popover id="popover-default" role="tooltip"
                    class="invisible absolute z-10 inline-block w-64 rounded-lg border border-gray-200 bg-white text-sm text-gray-500 opacity-0 shadow-sm transition-opacity duration-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400">
                    <div class="rounded-t-lg border-b border-gray-200 bg-gray-100 px-3 py-2 dark:border-gray-600 dark:bg-gray-700">
                        <h3 class="font-semibold text-gray-900 dark:text-white">{!! __('auth.secret_key') !!}</h3>
                    </div>
                    <div class="px-3 py-2">
                        <p>{{ $secretKey }}</p>
                    </div>
                    <div data-popper-arrow></div>
                </div>

                <form action="{{ route('2fa.setup.validate') }}" method="POST" class="mt-6">
                    @csrf
                    <div class="field">
                        <label for="input-group-1"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">{!! __('auth.verify_code_app') !!}</label>
                        <div class="relative mb-6">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                                <i class='bx bx-qr-scan font-2xl text-gray-500 dark:text-gray-400'></i>
                            </div>
                            <input type="text" name="OPT" id="input-group-1" required
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 pl-10 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                placeholder="123456">
                        </div>
                    </div>
                    <p class="mb-3 flex font-normal text-gray-700 dark:text-gray-400">
                        <svg class="mr-2 h-5 w-5 flex-shrink-0 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                clip-rule="evenodd"></path>
                        </svg>
                        {!! __('auth.view_2fa_secretcode') !!}
                    </p>
                    <div class="flex justify-end">
                        <button type="submit"
                            class="inline-flex items-center rounded-lg bg-primary-700 px-3 py-2 text-center text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            {!! __('auth.continue') !!}
                            <svg class="ml-2 h-3.5 w-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </button>
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
