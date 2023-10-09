@if(auth()->user()->payments()->whereStatus('unpaid')->where('show_as_unpaid_invoice', true)->count() > 0)
    <div class="flex p-4 text-sm mb-4 text-gray-800 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600" role="alert">
        <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
        <span class="sr-only">{!! __('client.info') !!}</span>
        <div>
            {!! __('client.unpaid_warn', ['count' => auth()->user()->payments()->whereStatus('unpaid')->where('show_as_unpaid_invoice', true)->count()]) !!}
        </div>
      </div>
@endif

<div class="columns-3">
    <a href="{{ route('dashboard') }}"
        class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        <div class="flex flex-col items-center justify-center">
            <dt class="mb-2 text-3xl font-extrabold dark:text-gray-200">{{ auth()->user()->orders()->count() }}
            </dt>
            <dd class="text-gray-500 dark:text-gray-400">{!! __('client.services') !!}</dd>
        </div>
    </a>

    <a href="{{ route('invoices', ['where' => 'unpaid']) }}"
        class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        <div class="flex flex-col items-center justify-center">
            <dt class="mb-2 text-3xl font-extrabold dark:text-gray-200">{{ auth()->user()->payments()->whereStatus('unpaid')->where('show_as_unpaid_invoice', true)->count() }}
            </dt>
            <dd class="text-gray-500 dark:text-gray-400">{!! __('client.invoices') !!}</dd>
        </div>
    </a>

    <a href="{{ route('balance') }}" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        <div class="flex flex-col items-center justify-center">
            <dt class="mb-2 text-3xl font-extrabold dark:text-gray-200">{{ currency('symbol') }}{{ number_format(Auth::user()->balance, 2) }}</dt>
            <dd class="text-gray-500 dark:text-gray-400">{!! __('client.balance') !!}</dd>
        </div>
    </a>
</div>

