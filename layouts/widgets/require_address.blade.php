@auth
@if(settings('require_address', false) AND !auth()->user()->address->address)
<div id="promo-popup" tabindex="-1" class="bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-30 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full" style="
    display: flex;
    align-items: center;
    justify-content: space-evenly;
">
  <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
      <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 md:p-6">


          <div class="mb-5 text-sm font-light text-gray-500 dark:text-gray-400">
              <h3 class="mb-3 text-2xl font-bold text-gray-900 dark:text-white">
                  {!! __('client.provide_missing_information') !!}
              </h3>
              <p class="mb-2">{!! __('client.provide_missing_information_desc') !!}</p>
              <form method="POST" action="{{ route('update-address') }}">
                    @csrf
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="organization" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                {!! __('client.organization') !!} {!! __('client.optional') !!}
                            </label>
                            <input type="text" name="company_name" value="{{ auth()->user()->address->company_name }}" id="organization" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="{!! __('client.company_name') !!}">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                {!! __('client.select_an_option') !!}
                            </label>
                            <select id="countries" name="country" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach(config('utils.countries') as $key => $country)
                                    <option value="{{ $key }}" @if(auth()->user()->address->country == $key) selected @endif>{{ $country }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('client.address') }}</label>
                            <input type="text" placeholder="{!! __('client.address') !!}" name="address" value="{{ auth()->user()->address->address }}" id="address" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                {!! __('client.city') !!}
                            </label>
                            <input type="text" placeholder="{!! __('client.city') !!}" name="city" value="{{ auth()->user()->address->city }}" id="city" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="zip_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                {!! __('client.zip_code') !!}
                            </label>
                            <input type="text" placeholder="{!! __('client.zip_code') !!}" name="zip_code" value="{{ auth()->user()->address->zip_code }}" id="zip_code" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="region" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                {!! __('client.state_region_provice') !!}
                            </label>
                            <input type="text" placeholder="{!! __('client.region') !!}" name="region" value="{{ auth()->user()->address->region }}" id="region" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        </div>
                        <div class="col-span-6 sm:col-full">
                            <button class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800" type="submit">
                                {!! __('client.save_all') !!}
                            </button>
                        </div>
                    </div>
                </form>
          </div>

      </div>
  </div>
</div>
@endif
@endauth
