<div class="sticky left-0 top-8 max-w-sm rounded-lg border-gray-200 bg-white p-6 shadow dark:bg-gray-800">
    <a href="#">
        <h5 class="mb-4 text-2xl font-bold tracking-tight text-gray-900 dark:text-gray-200">
            {!! __('client.order_summary') !!}
        </h5>
    </a>

    <p class="mb-1 flex justify-between text-sm font-normal text-gray-700 dark:text-gray-400">
        {!! __('client.recurring') !!}
    </p>
    <p class="mb-4 flex justify-between text-sm font-normal text-gray-700 dark:text-gray-400">
        <span id="period">{{ $package->prices->first()->periodToHuman() }}</span>
        <span>{{ currency('symbol') }}
            <span id="recurring">
{{--                {{ price($package->prices->first()->renewal_price) }}--}}
            </span>
        </span>
    </p>

    <hr class="my-4 h-px border-0 bg-gray-200 dark:bg-gray-700">
    <p class="mb-4 flex justify-between text-sm font-normal text-gray-700 dark:text-gray-400">
        <span>{!! __('client.setup_fee') !!}</span>
        <span>{{ currency('symbol') }}
            <span id="setup_fee">{{ price($package->prices->first()->setup_fee) }}</span>
        </span>
    </p>

    @if($package->configOptions->count() > 0)
        <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">
        <p class="font-normal text-sm text-gray-700 dark:text-gray-400 flex justify-between mb-4">
            <span>{!! __('client.options') !!}</span>
            <span>{{ currency('symbol') }}<span id="config_options_price">0.00</span></span>
        </p>
    @endif

    <hr class="my-4 h-px border-0 bg-gray-200 dark:bg-gray-700">
    <p class="mb-4 flex justify-between text-sm font-normal text-gray-700 dark:text-gray-400">
        <span>{{ __('client.discount') }}</span>
        <span>-{{ currency('symbol') }}<span id="discounted">0.00</span></span>
    </p>

    <div class="@if (!settings('taxes')) hidden @endif" id="tax-div">
        <hr class="my-4 h-px border-0 bg-gray-200 dark:bg-gray-700">
        <p class="mb-4 flex justify-between text-sm font-normal text-gray-700 dark:text-gray-400">
            <span>
                {!! __('client.vat') !!}
                @if (settings('tax_add_to_price'))
                    {!! __('client.incl') !!}
                @else
                    {!! __('client.excl') !!}
                @endif
            </span>
            <span>{{ currency('symbol') }}<span id="taxes">0.00</span></span>
        </p>
    </div>

    <hr class="my-4 h-px border-0 bg-gray-200 dark:bg-gray-700">
    <p class="mb-2 flex justify-between text-sm font-normal text-gray-700 dark:text-gray-400">
        <span>{!! __('client.due_today') !!}</span>
    </p>
    <h5 class="mb-6 text-4xl font-bold tracking-tight text-gray-900 dark:text-white">
        {{ currency('symbol') }}<span id="total_price"></span>
    </h5>

    @if ($page = Page::wherePath('terms-and-conditions')->first())
        <div class="mb-4 flex items-start">
            <div class="flex h-5 items-center">
                <input
                    required
                    id="terms"
                    aria-describedby="terms"
                    type="checkbox"
                    class="focus:ring-3 h-4 w-4 rounded border-gray-300 bg-gray-50
                           focus:ring-primary-300 dark:border-gray-600 dark:bg-gray-700
                           dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                />
            </div>
            <div class="ml-3 text-sm">
                <label for="terms" class="font-medium text-gray-900 dark:text-white">
                    {!! __('client.i_accept_the') !!}
                    <a class="ml-1 text-primary-700 hover:underline dark:text-primary-500"
                       href="{{ route('page', $page->path) }}" target="_blank">
                        {!! __('client.terms_and_conditions') !!}
                    </a>
                </label>
            </div>
        </div>
    @endif

    <button
        type="submit"
        id="checkout"
        class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 dark:bg-primary-600
               dark:hover:bg-primary-700 dark:focus:ring-primary-800 min-w-full rounded-lg
               px-6 py-3.5 text-center text-base font-medium text-white focus:outline-none focus:ring-4"
    >
        {!! __('client.complete_checkout') !!}
    </button>

</div>

<p class="mt-3 text-sm text-gray-500 dark:text-gray-400" id="disclosure">
    @if ($package->prices->first()->cancellation_fee > 0)
        {!! __('client.selected_price_includes_cancellation_fee') !!}
        {{ price($package->prices->first()->cancellation_fee) }}
    @endif
</p>
