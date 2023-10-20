@props([
    'order' => $order,
    'data' => $order->data,
])

<button type="button"
data-modal-target="renewService-{{ $order->id }}"
data-modal-toggle="renewService-{{ $order->id }}"
class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg px-3 py-2 text-sm font-medium dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
<i class='bx bx-recycle font-xl mr-1'></i>
Renew
</button>

<!-- Main modal -->
<div id="renewService-{{ $order->id }}" data-modal-backdrop="static"
    tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div
                class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Renew Plan
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="renewService-{{ $order->id }}">
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
                <div class="mb-4 text-sm text-gray-800 dark:text-gray-300">
                    Your service is expires on the {{ $order->due_date->translatedFormat('d M Y') }}, {{ $order->due_date->diffForHumans() }}.

                    <br><br>
                    Below you can renew your service for another {{ $order->period() }}. After hitting "Renew", we will generate an invoice for you to pay.
                </div>
                <form action="{{ route('service', ['order' => $order->id, 'page' => 'renew']) }}" method="POST">
                    @csrf
                    <label for="default" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Renew for</label>
                    <select id="default" name="frequency" class="bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                      @foreach (range(1, 12) as $value)
                        <option value="{{ $value }}" @if($value == 1) selected @endif>{{ $value }} {{ ucfirst($order->period()) }} - {{ currency('symbol') }}{{ number_format($value * $order->price['renewal_price'], 2)}}</option>
                      @endforeach
                    </select>
            </div>
            <!-- Modal footer -->
            <div
                class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button data-modal-hide="renewService-{{ $order->id }}"
                    type="button"
                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                    <button data-modal-hide="renewService-{{ $order->id }}"
                        type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create Invoice</button>
            </div>
        </form>
        </div>
    </div>
</div>
