<div class="relative mt-8 rounded-lg bg-white p-4 shadow dark:bg-gray-800 sm:p-5" id="tax-card">
    <div class="mb-3 flex justify-between rounded-t sm:mb-3">
        <div class="text-lg text-gray-900 dark:text-white md:text-xl">
            <h3 class="font-semibold">{!! __('client.personal_details') !!}</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                {!! __('client.personal_details_desc') !!}
            </p>
        </div>
        <div></div>
    </div>

    <div class="mb-6">
        <div class="relative flex">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                <i class='bx bxs-building-house text-gray-500 dark:text-gray-400'></i>
            </div>
            <input
                type="text"
                id="zip_code"
                required
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 pl-10
                       text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500
                       dark:border-gray-600 dark:bg-gray-700 dark:text-white
                       dark:placeholder-gray-400 dark:focus:border-primary-500
                       dark:focus:ring-primary-500"
                placeholder="Zip/Post Code"
                name="zip_code"
                value="{{ session('zip_code', auth()->user()->address->zip_code ?? null) }}"
            />
        </div>
    </div>

    <select
        class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500
               dark:focus:border-primary-500 mb-6 block w-full rounded-lg border border-gray-300
               bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700
               dark:text-white dark:placeholder-gray-400"
        name="country"
        id="country"
        tabindex="-1"
        aria-hidden="true"
        required
    >
        @foreach (config('utils.countries') as $key => $country)
            <option
                value="{{ $key }}"
                @if (request()->header('cf-ipcountry', auth()->user()->address->country ?? null) == $key)
                    selected
                @endif
            >
                {{ $country }}
            </option>
        @endforeach
    </select>
</div>
