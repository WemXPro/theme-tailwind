@props([
    'order' => $order,
    'data' => $order->data,
])

<button type="button" data-modal-target="renewService-{{ $order->id }}" data-modal-toggle="renewService-{{ $order->id }}"
    class="rounded-lg bg-green-700 px-3 py-2 text-sm font-medium font-medium text-white hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
    <i class='bx bx-recycle font-xl mr-1'></i>
    {!! __('client.renew') !!}
</button>

<!-- Main modal -->
<div id="renewService-{{ $order->id }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
    class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full overflow-y-auto overflow-x-hidden p-4 md:inset-0">
    <div class="relative max-h-full w-full max-w-2xl">
        <!-- Modal content -->
        <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between rounded-t border-b p-4 dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    {!! __('client.ptero_renew_plan') !!}
                </h3>
                <button type="button"
                    class="ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="renewService-{{ $order->id }}">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <!-- Modal body -->
            <div class="space-y-6 p-6">
                <div class="mb-4 text-sm text-gray-800 dark:text-gray-300">
                    {!! __('client.ptero_renew_desc', [
                        'due_date' => $order->due_date->translatedFormat('d M Y'),
                        'due_date_diff' => $order->due_date->diffForHumans(),
                        'period' => $order->period(),
                    ]) !!}
                </div>
                <form action="{{ route('service', ['order' => $order->id, 'page' => 'renew']) }}" method="POST">
                    @csrf
                    <label for="default"
                        class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">{!! __('client.renew_for') !!}</label>
                    <select id="default" name="frequency"
                        class="mb-6 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500">
                        @foreach (range(1, 12) as $value)
                            <option value="{{ $value }}" @if ($value == 1) selected @endif>{{ $value }}
                                {{ ucfirst($order->period()) }} -
                                {{ currency('symbol') }}{{ number_format($value * $order->price['renewal_price'], 2) }}</option>
                        @endforeach
                    </select>
                    <!-- Modal footer -->
                    <div class="flex items-center space-x-2 rounded-b border-t border-gray-200 p-6 dark:border-gray-600">
                        <button data-modal-hide="renewService-{{ $order->id }}" type="button"
                            class="rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-900 focus:z-10 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:border-gray-500 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-600">{!! __('client.cancel') !!}</button>
                        <button data-modal-hide="renewService-{{ $order->id }}" type="submit"
                            class="rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{!! __('client.create_invoice') !!}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
