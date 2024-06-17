@extends(Theme::path('auth.registration.layout'))

@section('content')
    <div class="w-full">
        <div class="mb-8 flex items-center justify-center space-x-4 lg:hidden">
            <a href="#" class="flex items-center text-2xl font-semibold">
                <img class="mr-2 h-8 w-8" src="@settings('logo', '/assets/core/img/logo.png')" alt="logo" />
                <span class="text-gray-900 dark:text-white">@settings('app_name', 'WemX')</span>
            </a>
        </div>

        {{-- include alerts --}}
        @include(Theme::path('layouts.alerts'))

        <div class="mb-4">
            <h1 class="leding-tight capitalize mb-2 text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white">
                {{ __('client.address') }}
            </h1>
            <p class="font-light text-gray-500 dark:text-gray-400">
                {{ __('client.complete_address_to_proceed') }}
            </p>
        </div>

        <form method="POST" action="{{ route('update-address') }}">
            @csrf
        <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6 sm:col-span-6">
                <label for="organization" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                    {!! __('client.organization') !!} {!! __('client.optional') !!}
                </label>
                <input type="text" name="company_name" placeholder="{!! __('client.organization') !!} {!! __('client.optional') !!}" value="{{ auth()->user()->address->company_name ?? '' }}" id="organization"
                    class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:text-sm">
            </div>
            @if(settings('require_phone_number', false))
            <div class="col-span-6 sm:col-span-6">
                <label for="phone-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('client.phone_number') }}</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 19 18">
                            <path d="M18 13.446a3.02 3.02 0 0 0-.946-1.985l-1.4-1.4a3.054 3.054 0 0 0-4.218 0l-.7.7a.983.983 0 0 1-1.39 0l-2.1-2.1a.983.983 0 0 1 0-1.389l.7-.7a2.98 2.98 0 0 0 0-4.217l-1.4-1.4a2.824 2.824 0 0 0-4.218 0c-3.619 3.619-3 8.229 1.752 12.979C6.785 16.639 9.45 18 11.912 18a7.175 7.175 0 0 0 5.139-2.325A2.9 2.9 0 0 0 18 13.446Z"/>
                        </svg>
                    </div>
                    <input type="text" id="phone-input" name="phone_number" value="{{ auth()->user()->address->phone_number ?? '' }}" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="123-456-7890" required />
                </div>
            </div>
            @endif
            <div class="col-span-6 sm:col-span-6">
                <label for="address" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                    {!! __('admin.street') !!}
                </label>
                <input type="text" name="address" required placeholder="{!! __('admin.street') !!}" value="{{ auth()->user()->address->address ?? '' }}" id="address"
                    class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:text-sm">
            </div>
            <div class="col-span-6 sm:col-span-6">
                <label for="countries" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                    {{ __('client.country') }}
                </label>
                <select id="countries" name="country" required
                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500">
                    @foreach (config('utils.countries') as $key => $country)
                        <option value="{{ $key }}" @if(request()->header('cf-ipcountry') == $key) selected @endif>
                            {{ $country }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-6 sm:col-span-2">
                <label for="city" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                    {!! __('admin.city') !!}
                </label>
                <input type="text" placeholder="{{ __('client.city') }}" name="city"
                    value="{{ auth()->user()->address->city ?? '' }}" id="city" required
                    class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:text-sm">
            </div>
            <div class="col-span-6 sm:col-span-2">
                <label for="zip_code" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                    {!! __('auth.zip_code') !!}
                </label>
                <input type="text" placeholder="{{ __('client.zip_code') }}" name="zip_code"
                    value="{{ auth()->user()->address->zip_code ?? '' }}" id="zip_code" required
                    class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:text-sm">
            </div>
            <div class="col-span-6 sm:col-span-2">
                <label for="region" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                    {!! __('client.state_region_provice') !!}
                </label>
                <input type="text" placeholder="{{ __('client.region') }}" name="region"
                    value="{{ auth()->user()->address->region ?? '' }}" id="region" required
                    class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 sm:text-sm">
            </div>
            <div class="sm:col-full col-span-6 flex justify-end">
                <button
                    class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 rounded-lg px-5 py-2.5 text-center text-sm font-medium text-white focus:ring-4"
                    type="submit">
                    {!! __('client.save_all') !!}
                </button>
            </div>
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
