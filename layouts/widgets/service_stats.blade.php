@php($paymentsCount = auth()->user()->payments()->whereStatus('unpaid')->where('show_as_unpaid_invoice', true)->count())
@if ($paymentsCount > 0)
    <div class="mb-4 flex rounded-lg border border-gray-300 bg-gray-50 p-4 text-sm text-gray-800 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300"
        role="alert">
        <svg aria-hidden="true" class="mr-3 inline h-5 w-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                clip-rule="evenodd"></path>
        </svg>
        <span class="sr-only">{!! __('client.info') !!}</span>
        <div>
            {!! __('client.unpaid_warn', [
                'count' => $paymentsCount,
            ]) !!}
        </div>
    </div>
@endif

<div class="columns-3">
    <a href="{{ route('dashboard') }}"
        class="block max-w-sm rounded-lg border border-gray-200 bg-white p-6 shadow hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
        <div class="flex flex-col items-center justify-center">
            <dt class="mb-2 text-3xl font-extrabold dark:text-gray-200">{{ $userOrdersCount }}</dt>
            </dt>
            <dd class="text-gray-500 dark:text-gray-400">{!! __('client.services') !!}</dd>
        </div>
    </a>
    <a href="{{ route('invoices', ['where' => 'unpaid']) }}"
        class="block max-w-sm rounded-lg border border-gray-200 bg-white p-6 shadow hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
        <div class="flex flex-col items-center justify-center">
            <dt class="mb-2 text-3xl font-extrabold dark:text-gray-200">
                {{ $paymentsCount }}
            </dt>
            <dd class="text-gray-500 dark:text-gray-400">{!! __('client.invoices') !!}</dd>
        </div>
    </a>
    <a href="{{ route('balance') }}"
        class="block max-w-sm rounded-lg border border-gray-200 bg-white p-6 shadow hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
        <div class="flex flex-col items-center justify-center">
            <dt class="mb-2 text-3xl font-extrabold dark:text-gray-200">
                {{ price(Auth::user()->balance) }}
            </dt>
            <dd class="text-gray-500 dark:text-gray-400">{!! __('client.balance') !!}</dd>
        </div>
    </a>
</div>
