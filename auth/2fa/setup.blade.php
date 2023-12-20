@extends(Theme::wrapper())

@section('title', 'Setup 2FA')

@section('container')
<section class="bg-white dark:bg-gray-900 flex" style="height: 100%;">
    <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md" style="width: 100%;">

        <div class="stepper mb-8">
            <ol class="flex items-center w-full text-sm font-medium text-center text-gray-500 dark:text-gray-400 sm:text-base">
                <li class="flex md:w-full items-center text-blue-600 dark:text-blue-500 sm:after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                    <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                        </svg>
                        {!! __('auth.setup') !!}<span class="hidden sm:inline-flex sm:ml-2">({!! __('auth.2fa') !!})</span>
                    </span>
                </li>
                <li class="flex md:w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                    <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                        <span class="mr-2">2</span>
                        {!! __('auth.recovery') !!}<span class="hidden sm:inline-flex sm:ml-2">({!! __('auth.codes') !!})</span>
                    </span>
                </li>
                <li class="flex items-center">
                    <span class="mr-2">3</span>
                    {!! __('auth.confirmation') !!}
                </li>
            </ol>
        </div>

        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

            <div class="rounded flex justify-center mb-6" data-tooltip-target="tooltip-secret_key">
                {!! $QRcode !!}
            </div>


            <div id="tooltip-secret_key" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                {{ $secretKey }}
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>

            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{!! __('auth.scan_qr_code') !!} </p>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{!! __('auth.enter_digit_code_authenticator_app') !!}</p>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{!! __('auth.contine_next_step') !!}</p>

            <div data-popover id="popover-default" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                <div class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
                    <h3 class="font-semibold text-gray-900 dark:text-white">{!! __('auth.secret_key') !!}</h3>
                </div>
                <div class="px-3 py-2">
                    <p>{{ $secretKey}}</p>
                </div>
                <div data-popper-arrow></div>
            </div>

            <form action="{{ route('2fa.setup.validate') }}" method="POST" class="mt-6">
                @csrf

                <div class="field">
                    <label for="input-group-1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{!! __('auth.verify_code_app') !!}</label>
                    <div class="relative mb-6">
                      <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                        <i class='bx bx-qr-scan text-gray-500 dark:text-gray-400 font-2xl'></i>
                      </div>
                      <input type="text" name="OPT" id="input-group-1" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="123456">
                    </div>
                </div>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 flex">
                    <svg class="flex-shrink-0 mr-2 w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg>
                    {!! __('auth.view_2fa_secretcode') !!}
                </p>
            <div class="flex justify-end">
                <button type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    {!! __('auth.continue') !!}
                    <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
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
