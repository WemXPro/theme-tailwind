@if ($order->status == 'suspended')
    <div id="alert-additional-content-4"
        class="mb-4 rounded-lg border border-yellow-300 bg-yellow-50 p-4 text-yellow-800 dark:border-yellow-800 dark:bg-gray-800 dark:text-yellow-300"
        role="alert">
        <div class="flex items-center">
            <svg aria-hidden="true" class="mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                    clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">{{ __('client.info') }}</span>
            <h3 class="text-lg font-medium">{!! __('client.ptero_alerts_suspended') !!}</h3>
        </div>
        <div class="mb-4 mt-2 text-sm">
            {!! __('client.suspended_order_alert', ['translated_format' => $order->due_date->translatedFormat('d M Y'), 'diff_for_humans' => $order->due_date->diffForHumans(), 'terminate_suspended_after' => settings('orders::terminate_suspended_after', 7)]) !!}
        </div>
    </div>
@endif

@if ($order->status == 'cancelled')
    <div id="alert-additional-content-2"
        class="mb-4 rounded-lg border border-red-300 bg-red-50 p-4 text-red-800 dark:border-red-800 dark:bg-gray-800 dark:text-red-400"
        role="alert">
        <div class="flex items-center">
            <svg aria-hidden="true" class="mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                    clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">{{ __('client.important') }}</span>
            <h3 class="text-lg font-medium">{!! __('client.ptero_alerts_cancelled') !!}</h3>
        </div>
        <div class="mb-4 mt-2 text-sm">
            {!! __('client.cancel_alert_desc', ['translated_format' => $order->cancelled_at->translatedFormat('d M Y'), 'diff_for_humans' => $order->cancelled_at->diffForHumans()]) !!}
        </div>
        <div class="flex">
            <a href="{{ route('service', ['order' => $order->id, 'page' => 'cancel-undo']) }}"
                class="mr-2 inline-flex items-center rounded-lg bg-red-800 px-3 py-1.5 text-center text-xs font-medium text-white hover:bg-red-900 focus:outline-none focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                <i class='bx bx-revision font-2xl mr-1'></i>
                {{ __('client.do_not_cancel') }}
            </a>
        </div>
    </div>
@endif

@if ($order->status == 'terminated')
    <div id="alert-additional-content-2"
        class="mb-4 rounded-lg border border-red-300 bg-red-50 p-4 text-red-800 dark:border-red-800 dark:bg-gray-800 dark:text-red-400"
        role="alert">
        <div class="flex items-center">
            <svg aria-hidden="true" class="mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                    clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">{{ __('client.important') }}</span>
            <h3 class="text-lg font-medium">{!! __('client.ptero_alerts_terminated') !!}</h3>
        </div>
        <div class="mb-4 mt-2 text-sm">
            {!! __('client.ptero_alerts_terminated_desc') !!}
        </div>
        <div class="flex">
        </div>
    </div>
@endif

@if (ErrorLog::where('order_id', $order->id)->where('severity', '!=', 'RESOLVED')->count() !== 0)
    <div id="alert-additional-content-2"
        class="mb-4 rounded-lg border border-red-300 bg-red-50 p-4 text-red-800 dark:border-red-800 dark:bg-gray-800 dark:text-red-400"
        role="alert">
        <div class="flex items-center">
            <svg aria-hidden="true" class="mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                    clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">{!! __('client.important') !!}</span>
            <h3 class="text-lg font-medium">{!! __('client.ptero_alerts_failed_server') !!}</h3>
        </div>
        <div class="mb-4 mt-2 text-sm">
            {!! __('client.ptero_alerts_failed_server_desc') !!}
        </div>
    </div>
@endif
