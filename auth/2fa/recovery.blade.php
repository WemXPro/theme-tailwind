@extends(Theme::wrapper())

@section('title', 'Recover 2FA')

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
                <li class="flex md:w-full items-center text-blue-600 dark:text-blue-500 sm:after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                    <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                        </svg>

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

            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{!! __('auth.recovery_codes') !!}</h5>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{!! __('auth.recovery_in_case_lost_access_to_device') !!}</p>

            <div id="alert-additional-content-1" class="p-4 mb-4 text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800" role="alert">
                <div class="flex items-center">
                  <svg class="flex-shrink-0 w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                  </svg>

                  <span class="sr-only">{!! __('auth.info') !!}</span>
                  <h3 class="text-lg font-medium">{!! __('auth.keep_recovery_codes_safe') !!}</h3>
                </div>
                <div class="mt-2 mb-4 text-sm">
                     {!! __('auth.lose_access_to_2fa_device') !!}
                </div>
            </div>


            <div class="columns-3 mt-6 mb-3">
                @foreach($recoveryCodes as $key => $code)
                    <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-500 dark:text-gray-300 text-center">{{ $code }}</h5>
                @endforeach
            </div>

            <form action="{{ route('2fa.activate') }}" method="POST">
                @csrf
                <div style="display: flex;align-items: flex-end;justify-content: space-between;">
                    <div class="flex items-center">
                        <input id="default-checkbox" name="stored_recovery" required="" type="checkbox" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">

                        <label for="default-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{!! __('auth.confirm_safely_stored_codes') !!}</label>

                    </div>

                    <div class="flex justify-end mt-4">
                        <a href="{{ route('2fa.recovery.download') }}" class="inline-flex items-center mr-2 px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">

                            {!! __('client.download') !!}
                            <i class='bx bx-cloud-download ml-2' style="font-size: 20px"></i>
                        </a>
                        <button href="submit" class=" inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            {!! __('auth.activate') !!}

                            <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
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
