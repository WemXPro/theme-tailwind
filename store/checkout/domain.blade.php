<div class="relative mb-6 mt-8 rounded-lg bg-white p-4 shadow dark:bg-gray-800 sm:p-5">
    <div class="custom-note">
        <div class="mb-3 flex justify-between rounded-t sm:mb-3">
            <div class="text-lg text-gray-900 dark:text-white md:text-xl">
                <h3 class="font-semibold">{!! __('client.enter_domain') !!}</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    {!! __('client.enter_domain_desc') !!}
                </p>
            </div>
        </div>
        <label for="helper-text" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
            {!! __('client.domain') !!}
        </label>
        <input
            type="text"
            id="helper-text"
            name="domain"
            value="{{ old('domain') }}"
            aria-describedby="helper-text-explanation"
            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900
                   focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700
                   dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
            placeholder="i.e example.com"
        >
        <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400">
            {!! __('client.enter_domain_helper') !!}
        </p>
    </div>
</div>
