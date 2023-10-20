@if($order->status == 'suspended')
    <div id="alert-additional-content-4" class="p-4 mb-4 text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300 dark:border-yellow-800" role="alert">
        <div class="flex items-center">
            <svg aria-hidden="true" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Info</span>
            <h3 class="text-lg font-medium">This service has been suspended</h3>
        </div>
        <div class="mt-2 mb-4 text-sm">
            The due date for this service was on the  {{ $order->due_date->translatedFormat('d M Y') }} ({{ $order->due_date->diffForHumans() }})<br><br>

            We regret to inform you that your service has been suspended due to overdue payment. To avoid termination, please settle any outstanding invoices within @settings('orders::terminate_suspended_after', 7) days from the due date. If payment is not received within this timeframe, your service will be terminated, resulting in the deletion or revocation of all associated data, files, and licenses.
        </div>
        <div class="flex">
            <button
                type="button" data-modal-target="renewService-22" data-modal-toggle="renewService-22"
                class="text-white bg-yellow-800 hover:bg-yellow-900 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-xs px-3 py-1.5 mr-2 text-center inline-flex items-center dark:bg-yellow-300 dark:text-gray-800 dark:hover:bg-yellow-400 dark:focus:ring-yellow-800"
            >
                <i class="bx bx-recycle mr-1"></i>
                Renew
            </button>
        </div>
    </div>

@endif

@if($order->status == 'cancelled')
    <div id="alert-additional-content-2" class="p-4 mb-4 text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
        <div class="flex items-center">
        <svg aria-hidden="true" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
        <span class="sr-only">Important</span>
        <h3 class="text-lg font-medium">This service has been cancelled</h3>
        </div>
        <div class="mt-2 mb-4 text-sm">
            This service is set to be cancelled on {{ $order->cancelled_at->translatedFormat('d M Y') }} ({{ $order->cancelled_at->diffForHumans() }})<br> <br> If you have changed your mind, you can undo the cancellation before this date. If no action is taken, your service will be suspended and terminated. All files and data belonging to this service will be deleted forever.
        </div>
        <div class="flex">
        <a href="{{ route('service', ['order' => $order->id, 'page' => 'cancel-undo']) }}" class="text-white bg-red-800 hover:bg-red-900 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-xs px-3 py-1.5 mr-2 text-center inline-flex items-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
            <i class='bx bx-revision font-2xl mr-1'></i>
            Do Not Cancel
        </a>
        </div>
    </div>
@endif

@if($order->status == 'terminated')
    <div id="alert-additional-content-2" class="p-4 mb-4 text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
        <div class="flex items-center">
        <svg aria-hidden="true" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
        <span class="sr-only">Important</span>
        <h3 class="text-lg font-medium">This service has been terminated</h3>
        </div>
        <div class="mt-2 mb-4 text-sm">
            This service was terminated. Termination can happen due to a couple of reasons. You were late on payment, or you cancelled the service. All data / files / licenses belonging to this service have been deleted or revoked. This process is irreversible
        </div>
        <div class="flex">
        </div>
    </div>
@endif
