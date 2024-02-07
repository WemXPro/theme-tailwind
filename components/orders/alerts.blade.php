@if($order->status == 'suspended')
    <div id="alert-additional-content-4" class="p-4 mb-4 text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300 dark:border-yellow-800" role="alert">
        <div class="flex items-center">
            <svg aria-hidden="true" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">{{ __('client.info') }}</span>
            <h3 class="text-lg font-medium">{!! __('client.ptero_alerts_suspended') !!}</h3>
        </div>
        <div class="mt-2 mb-4 text-sm">
            {!! __('client.renew_service_desc', ['translated_format' => $order->due_date->translatedFormat('d M Y'), 'diff_for_humans' => $order->due_date->diffForHumans(), 'terminate_suspended_after' => settings('orders::terminate_suspended_after', 7)]) !!}
        </div>
        <div class="flex">
            <button
                type="button" data-modal-target="renewService-{{$order->id}}" data-modal-toggle="renewService-{{$order->id}}"
                class="text-white bg-yellow-800 hover:bg-yellow-900 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-xs px-3 py-1.5 mr-2 text-center inline-flex items-center dark:bg-yellow-300 dark:text-gray-800 dark:hover:bg-yellow-400 dark:focus:ring-yellow-800"
            >
                <i class="bx bx-recycle mr-1"></i>
                {!! __('client.renew') !!}
            </button>
        </div>
    </div>

@endif

@if($order->status == 'cancelled')
    <div id="alert-additional-content-2" class="p-4 mb-4 text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
        <div class="flex items-center">
        <svg aria-hidden="true" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
        <span class="sr-only">{{ __('client.important') }}</span>
        <h3 class="text-lg font-medium">{!! __('client.ptero_alerts_cancelled') !!}</h3>
        </div>
        <div class="mt-2 mb-4 text-sm">
            {!! __('client.cancel_alert_desc', ['translated_format' => $order->cancelled_at->translatedFormat('d M Y'), 'diff_for_humans' => $order->cancelled_at->diffForHumans()]) !!}
        </div>
        <div class="flex">
        <a href="{{ route('service', ['order' => $order->id, 'page' => 'cancel-undo']) }}" class="text-white bg-red-800 hover:bg-red-900 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-xs px-3 py-1.5 mr-2 text-center inline-flex items-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
            <i class='bx bx-revision font-2xl mr-1'></i>
            {{ __('client.do_not_cancel') }}
        </a>
        </div>
    </div>
@endif

@if($order->status == 'terminated')
    <div id="alert-additional-content-2" class="p-4 mb-4 text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
        <div class="flex items-center">
        <svg aria-hidden="true" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
        <span class="sr-only">{{ __('client.important') }}</span>
        <h3 class="text-lg font-medium">{!! __('client.ptero_alerts_terminated') !!}</h3>
        </div>
        <div class="mt-2 mb-4 text-sm">
            {!! __('client.ptero_alerts_terminated_desc') !!}
        </div>
        <div class="flex">
        </div>
    </div>
@endif

@if(ErrorLog::where('order_id', $order->id)->where('severity','!=','RESOLVED')->count() !== 0)
    <div id="alert-additional-content-2"
         class="p-4 mb-4 text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800"
         role="alert">
        <div class="flex items-center">
            <svg aria-hidden="true" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"
                 xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                      clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">{!! __('client.important') !!}</span>
            <h3 class="text-lg font-medium">{!! __('client.ptero_alerts_failed_server') !!}</h3>
        </div>
        <div class="mt-2 mb-4 text-sm">
            {!! __('client.ptero_alerts_failed_server_desc') !!}
        </div>
        <div class="flex">
        </div>
    </div>
@endif
