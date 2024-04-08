@props([
    'order' => $order,
    'data' => $order->data,
])

<button type="button" data-modal-target="cancelService-{{ $order->id }}" data-modal-toggle="cancelService-{{ $order->id }}"
    class="flex items-center rounded-lg bg-red-700 px-3 py-2 text-center text-sm font-medium text-white hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
    <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 h-4 w-4" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
        <path fill-rule="evenodd"
            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
            clip-rule="evenodd" />
    </svg>
    {!! __('client.cancel') !!}
</button>

<!-- Main modal -->
<div id="cancelService-{{ $order->id }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
    class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full overflow-y-auto overflow-x-hidden p-4 md:inset-0">
    <div class="relative max-h-full w-full max-w-2xl">
        <!-- Modal content -->
        <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between rounded-t border-b p-4 dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    {!! __('client.cancel_plan') !!}
                </h3>
                <button type="button"
                    class="ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="cancelService-{{ $order->id }}">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <!-- Modal body -->
            <div class="space-y-6 p-6">
                @if ($order->price['cancellation_fee'] > 0)
                    <div class="mb-4 flex rounded-lg bg-red-50 p-4 text-sm text-red-800 dark:bg-gray-800 dark:text-red-400" role="alert">
                        <svg aria-hidden="true" class="mr-3 inline h-5 w-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">{!! __('client.info') !!}</span>
                        <div>

                            <span class="font-medium">{!! __('client.ptero_cancellation_fee_info', [
                                'cancellation_fee' => price($order->price['cancellation_fee']),
                            ]) !!}
                        </div>
                    </div>
                @endif
                <form action="{{ route('service', ['order' => $order->id, 'page' => 'cancel-service']) }}" method="POST">
                    @csrf
                    <div class="mb-4 flex">
                        <div class="flex h-5 items-center">
                            <input id="helper-radio" aria-describedby="helper-radio-text" type="radio" value="end_of_term"
                                name="cancelled_at" checked
                                class="h-4 w-4 border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600">
                        </div>
                        <div class="ml-2 text-sm">
                            <label for="helper-radio" class="font-medium text-gray-900 dark:text-gray-300">{!! __('client.cancel_at_end_of_term') !!}</label>
                            <p id="helper-radio-text" class="text-xs font-normal text-gray-500 dark:text-gray-300">
                                {!! __('client.service_cancelled_gracefully_at_due_date', ['due_date' => $order->due_date->translatedFormat('d M Y')]) !!}
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <label for="message"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">{!! __('client.cancellation_reason') !!}</label>
                        <textarea id="message" rows="4" name="cancel_reason"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                            placeholder="{!! __('client.custom_notes_placeholder') !!}"></textarea>
                        @if ($order->price['cancellation_fee'] > 0)
                            <label for="gateway"
                                class="mb-2 mt-6 block text-sm font-medium text-gray-900 dark:text-white">{!! __('client.payment_method_reason') !!}</label>
                            <select
                                class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 mb-4 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                                name="gateway" tabindex="-1" aria-hidden="true" required>
                                @foreach (App\Models\Gateways\Gateway::getActive() as $gateway)
                                    @if ($gateway->name == 'Balance')
                                        <option value="{{ $gateway->id }}" @if (Auth::user()->balance >= $order->price['cancellation_fee']) selected @endif>
                                            {!! __('client.pay_with_balance') !!} ({{ price(Auth::user()->balance) }})
                                        </option>
                                        @continue
                                    @endif
                                    <option value="{{ $gateway->id }}">{{ $gateway->name }}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center space-x-2 rounded-b border-t border-gray-200 p-6 dark:border-gray-600">
                        <button data-modal-hide="cancelService-{{ $order->id }}" type="button"
                            class="rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-900 focus:z-10 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:border-gray-500 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-600">{!! __('client.discard') !!}</button>
                        <button data-modal-hide="cancelService-{{ $order->id }}" type="submit"
                            class="mr-2 rounded-lg bg-red-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">{!! __('client.cancel_now') !!}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
