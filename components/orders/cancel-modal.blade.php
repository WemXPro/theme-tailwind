@props([
    'order' => $order,
    'data' => $order->data,
])

<button type="button"
data-modal-target="cancelService-{{ $order->id }}"
data-modal-toggle="cancelService-{{ $order->id }}"
class="py-2 px-3 flex items-center text-sm font-medium text-center text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 rounded-lg dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
    viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
    <path fill-rule="evenodd"
        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
        clip-rule="evenodd" />
</svg>
{!! __('client.cancel') !!}
</button>

<!-- Main modal -->
<div id="cancelService-{{ $order->id }}" data-modal-backdrop="static"
    tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div
                class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    {!! __('client.cancel_plan') !!}
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="cancelService-{{ $order->id }}">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                @if($order->price['cancellation_fee'] > 0)
                    <div class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                        <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">{!! __('client.info') !!}</span>
                        <div>

                            <span class="font-medium">{!! __('client.ptero_cancellation_fee_info', ['symbol' => currency('symbol'), 'cancellation_fee' =>  number_format($order->price['cancellation_fee'], 2)]) !!}
                        </div>
                    </div>
                @endif
                <form action="{{ route('service', ['order' => $order->id, 'page' => 'cancel-service']) }}" method="POST">
                    @csrf
                    <div class="flex mb-4">
                        <div class="flex items-center h-5">
                            <input id="helper-radio" aria-describedby="helper-radio-text"
                                type="radio" value="end_of_term" name="cancelled_at" checked
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        </div>
                        <div class="ml-2 text-sm">
                            <label for="helper-radio"
                                class="font-medium text-gray-900 dark:text-gray-300">{!! __('client.cancel_at_end_of_term') !!}</label>
                            <p id="helper-radio-text"
                                class="text-xs font-normal text-gray-500 dark:text-gray-300">
                                {!! __('client.service_cancelled_gracefully_at_due_date', ['due_date' => $order->due_date->translatedFormat('d M Y')]) !!}
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <label for="message"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{!! __('client.cancellation_reason') !!}</label>
                        <textarea id="message" rows="4" name="cancel_reason"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="{!! __('client.custom_notes_placeholder') !!}"></textarea>

                            @if($order->price['cancellation_fee'] > 0)
                                <label for="gateway"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-6">{!! __('client.payment_method_reason') !!}</label>
                                <select
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 mb-4"
                                name="gateway" tabindex="-1" aria-hidden="true" required>

                                @foreach (App\Models\Gateways\Gateway::getActive() as $gateway)
                                    @if($gateway->name == 'Balance')
                                        <option value="{{ $gateway->id }}" @if(Auth::user()->balance >= $order->price['cancellation_fee']) selected @endif>{!! __('client.pay_with_balance') !!} ({{ currency('symbol') }}{{ number_format(Auth::user()->balance, 2) }})</option>
                                        @continue
                                    @endif

                                    <option value="{{ $gateway->id }}">{{ $gateway->name }}</option>
                                @endforeach

                                </select>
                            @endif
                    </div>
            </div>
            <!-- Modal footer -->
            <div
                class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button data-modal-hide="cancelService-{{ $order->id }}"
                    type="button"
                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">{!! __('client.discard') !!}</button>
                <button data-modal-hide="cancelService-{{ $order->id }}"
                    type="submit"
                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">{!! __('client.cancel_now') !!}</button>
            </div>
        </form>
        </div>
    </div>
</div>
