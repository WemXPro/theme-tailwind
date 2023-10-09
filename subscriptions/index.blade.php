@extends(Theme::wrapper())
@section('title',  __('client.subscriptions'))
@section('container')
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="mx-auto max-w-screen-xl">
            <!-- Start coding here -->
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div
                    class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="w-full md:w-1/2">
                        <h5 class="dark:text-white font-semibold">{!! __('client.subscriptions') !!}</h5>
                    </div>
                    <div
                        class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                        <button data-modal-target="createSubscriptionModal" data-modal-toggle="createSubscriptionModal"
                                type="button"
                                class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                      d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"/>
                            </svg>
                            {!! __('client.create_subscription') !!}
                        </button>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">{!! __('client.subscription_name') !!}</th>
                            <th scope="col" class="px-4 py-3">{!! __('client.order') !!}</th>
                            <th scope="col" class="px-4 py-3">{!! __('client.status') !!}</th>
                            <th scope="col" class="px-4 py-3">{!! __('client.gateway') !!}</th>
                            <th scope="col" class="px-4 py-3">{!! __('client.billed_as') !!}</th>
                            <th scope="col" class="px-4 py-3">{!! __('client.next_billing_date') !!}</th>
                            <th scope="col" class="px-4 py-3">{!! __('client.created_at') !!}</th>
                            <th scope="col" class="px-4 py-3">
                                <span class="sr-only">{!! __('client.actions') !!}</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        {{-- Paddle Subscriptions --}}
                        @foreach ($subscriptions_paddle as $subscription)
                            <tr class="border-b dark:border-gray-700">
                                <th scope="row"
                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $subscription->name }} ({{ $subscription->gateway_subscription_id }})</th>
                                <td class="px-4 py-3">{{ $subscription->order->name }} (#{{ $subscription->order->id }})
                                </td>
                                <td class="px-4 py-3">
                                    @if ($subscription->status == 'active')
                                        <span
                                            class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                                {!! __('client.active') !!}
                                            </span>
                                    @elseif($subscription->status == 'cancelled')
                                        <span
                                            class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                                                 {!! __('client.cancelled') !!}
                                            </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">{{ $subscription->gateway }}</td>
                                <td class="px-4 py-3">{{ currency('symbol') }}{{ $subscription->price['renewal_price'] }}
                                    @ {{ $subscription->price['period'] }} {!! __('client.days') !!}</td>
                                <td class="px-4 py-3">
                                    {{ $subscription->ends_at->translatedFormat(settings('date_format', 'd M Y')) }}</td>
                                <td class="px-4 py-3">
                                    {{ $subscription->created_at->translatedFormat(settings('date_format', 'd M Y')) }}</td>
                                <td class="px-4 py-3 flex items-center justify-end">
                                    <button type="button"
                                            onclick="setManageFrame(this, '{{ $subscription->data['update_url'] }}')"
                                            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                        {!! __('client.manage') !!}
                                    </button>
                                    <button type="button"
                                            onclick="setCancelFrame(this, '{{ $subscription->data['cancel_url'] }}')"
                                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 inline-flex items-center">
                                        {!! __('client.cancel') !!}
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        {{-- Paddle Subscriptions --}}
                        </tbody>
                    </table>
                </div>
                <nav
                    class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
                    aria-label="Table navigation">
                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                        {!! __('client.showing', ['count' => '1-10', 'all' => $subscriptions_paddle->count()]) !!}
                    </span>
                    {{ $subscriptions_paddle->links(Theme::pagination()) }}
                </nav>
            </div>
        </div>
    </section>

    <!-- Create subscription modal -->
    <div id="createSubscriptionModal" tabindex="-1" aria-hidden="true"
         class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        {!! __('client.create_subscription') !!}
                    </h3>
                    <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="createSubscriptionModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                  clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">{!! __('client.close_modal') !!}</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="{{ route('subscription.store') }}" method="POST">
                    @csrf
                    <div class="p-6 space-y-6">
                        <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                            {!! __('client.subscription_order_desc') !!}
                        </p>

                        <div class="form">
                            <label for="order"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                {!! __('client.subscription_order') !!}
                            </label>
                            <select id="order" name="order_id" onchange="retrieveJSONList()"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach (auth()->user()->orders()->whereStatus('active')->get() as $order)
                                    @if (!Subscription::where('order_id', $order->id)->whereStatus('active')->exists())
                                        <option value="{{ $order->id }}">{{ $order->name }} (#{{ $order->id }})
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form">
                            <label for="prices"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                {!! __('client.subscription_price') !!}
                            </label>
                            <select id="prices" name="price_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                            </select>
                        </div>

                        <div class="form">
                            <label for="gateway"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                {!! __('client.payment_method') !!}
                            </label>
                            <select id="gateway" name="gateway"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach (App\Models\Gateways\Gateway::getActive('subscription') as $gateway)
                                    <option value="{{ $gateway->id }}">{{ $gateway->name }} (Subscription)</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div
                        class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button data-modal-hide="createSubscriptionModal" type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            {!! __('client.create') !!}
                        </button>
                        <button data-modal-hide="createSubscriptionModal" type="button"
                                class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            {!! __('client.cancel') !!}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Create subscription modal -->

    <script>
        function setCancelFrame(element, url) {

            element.innerHTML = `<svg aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
    </svg> {!! __('client.cancelling') !!}...`;


            var iframe = document.getElementById("paddle_frame");
            iframe.src = url;

            setTimeout(function () {
                document.getElementById('frame').style.display = 'unset';
                element.innerHTML = `Cancel`;
            }, 1000);

        }

        function setManageFrame(element, url) {

            element.innerHTML = `<svg aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
    </svg> {!! __('client.managing') !!}...`;


            var iframe = document.getElementById("paddle_frame");
            iframe.src = url;

            setTimeout(function () {
                document.getElementById('frame').style.display = 'unset';
                element.innerHTML = `Manage`;
            }, 1000);

        }

        function closeFrame() {
            var iframe = document.getElementById("paddle_frame");
            iframe.src = '';
            document.getElementById('frame').style.display = 'none';
        }

        retrieveJSONList();

        function retrieveJSONList() {
            const selectElement = document.getElementById('prices');
            var id = document.getElementById('order').value;
            fetch('/subscriptions/prices/' + id, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => response.json())
                .then(data => {
                    selectElement.innerHTML = '';

                    data.forEach(function (price) {
                        if (typeof price.data.paddle_id !== 'undefined') {
                            const optionElement = document.createElement('option');
                            optionElement.value = price.id;
                            optionElement.text = '{{ currency('symbol') }}' + price.price.toFixed(2) + ' @ ' + price.period + ' {!! __('client.days') !!}';
                            selectElement.appendChild(optionElement);
                        }
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Handle the error case
                });

        }
    </script>

    <div id="frame" style="display: flex;flex-direction: column; display: none;">
        <div class=""
             style="
        background: rgba(48, 47, 60, 0.8);
        width: 100%;
        display: flex;
        justify-content: center;
    ">
            <button type="button" onclick="closeFrame()"
                    class="py-2.5 px-5 mr-2 mb-2 mt-6 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                {!! __('client.close') !!}
            </button>
        </div>
        <iframe id="paddle_frame" src="" style="width: 100%;height: 100%;"></iframe>
    </div>

    <style>
        #frame {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
@endsection
