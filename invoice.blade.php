@extends(Theme::wrapper())

@section('title', __('client.invoice'))

@section('container')
    <main>
        <div class="grid grid-cols-12 gap-4">
            <div
                class="col-span-12 mx-4 mb-4 rounded-lg bg-white p-4 shadow dark:bg-gray-800 sm:p-6 md:mx-6 lg:my-6 xl:col-span-10 xl:col-start-2 xl:p-8 2xl:col-span-8 2xl:col-start-3">
                <div class="space-y-6 overflow-hidden p-4 md:p-8">
                    <div class="sm:flex">
                        <div class="mb-5 text-2xl font-bold dark:text-white sm:mb-0 sm:text-3xl">
                            {!! __('client.invoice') !!} #{{ substr($payment->id, 0, 8) }} <br>

                            @if ($payment->status == 'paid')
                                <span
                                    class="font-large mr-2 rounded bg-green-100 px-2.5 py-0.5 text-sm text-green-800 dark:bg-green-900 dark:text-green-300">
                                    {!! __('client.paid') !!}
                                </span>
                            @elseif($payment->status == 'unpaid')
                                <span
                                    class="font-large mr-2 rounded bg-red-100 px-2.5 py-0.5 text-sm text-red-800 dark:bg-red-900 dark:text-red-300">
                                    {!! __('client.unpaid') !!}
                                </span>
                            @elseif($payment->status == 'refunded')
                                <span
                                    class="mr-2 rounded bg-blue-100 px-2.5 py-0.5 text-sm font-medium text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                    {!! __('client.refunded') !!}
                                </span>
                            @endif
                        </div>
                        <div class="flex flex-col items-end space-y-3 text-right sm:ml-auto sm:text-right">
                            <img src="@settings('logo')" style="width: 64px; height: 64px;">
                            <div class="space-y-1">
                                <div class="text-lg font-semibold text-gray-900 dark:text-white">@settings('app_name')</div>
                                <div class="text-sm font-normal text-gray-900 dark:text-white">
                                    @settings('company_address', '291 N 4th St, San Jose, CA 95112, USA')
                                </div>
                            </div>
                            <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                {{ $payment->created_at->translatedFormat(settings('date_format', 'd M Y')) }}
                            </div>
                        </div>
                    </div>
                    <div class="sm:w-72">
                        <div class="mb-4 text-base font-bold uppercase text-gray-900 dark:text-white">
                            {!! __('client.bill_to') !!}
                        </div>
                        <address class="text-base font-normal text-gray-500 dark:text-gray-400">
                            @if (Auth::guest() or Auth::user()->id !== $payment->user->id)
                                {!! __('client.address_only_vissible') !!} {{ $payment->user->username }}
                            @else
                                {{ $payment->user->address->company_name ?? $payment->user->fullname }} <br>
                                @isset($payment->user->address->address)
                                    {{ $payment->user->address->address }},
                                @endisset {{ $payment->user->address->city }} <br>
                                @isset($payment->user->address->zip_code)
                                    {{ $payment->user->address->zip_code }},
                                    @endisset @isset($payment->user->address->region)
                                    {{ $payment->user->address->region }},
                                @endisset {{ $payment->user->address->country }}
                            @endif
                        </address>
                    </div>

                    <!-- Table -->
                    <div class="my-8 flex flex-col">
                        <div class="overflow-x-auto border-b border-gray-200 dark:border-gray-600">
                            <div class="inline-block min-w-full align-middle">
                                <div class="overflow-hidden shadow">
                                    <table class="min-w-full">
                                        <thead class="bg-gray-50 text-gray-900 dark:bg-gray-700 dark:text-white">
                                            <tr>
                                                <th scope="col"
                                                    class="rounded-l-lg p-4 text-left text-xs font-semibold uppercase tracking-wider">
                                                    {!! __('client.item') !!}
                                                </th>
                                                <th scope="col" class="p-4 text-left text-xs font-semibold uppercase tracking-wider">
                                                    {!! __('client.price') !!}
                                                </th>
                                                <th scope="col" class="p-4 text-left text-xs font-semibold uppercase tracking-wider">
                                                    {!! __('client.qty') !!}
                                                </th>
                                                <th scope="col" class="p-4 text-left text-xs font-semibold uppercase tracking-wider">
                                                    {!! __('client.discounts') !!}
                                                </th>
                                                <th scope="col"
                                                    class="rounded-r-lg p-4 text-left text-xs font-semibold uppercase tracking-wider">
                                                    {!! __('client.total') !!}
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white text-gray-900 dark:bg-gray-800 dark:text-white">
                                            <tr>
                                                <td class="whitespace-nowrap p-4 text-sm font-normal">
                                                    <div class="text-base font-semibold">{{ $payment->description }}</div>
                                                    <div class="text-sm font-normal text-gray-500 dark:text-gray-400"></div>
                                                </td>
                                                <td class="whitespace-nowrap p-4 text-base font-normal text-gray-500 dark:text-gray-400">
                                                    {{ price($payment->amount) }}
                                                </td>
                                                <td class="whitespace-nowrap p-4 text-base font-semibold text-gray-900 dark:text-white">
                                                    1
                                                </td>
                                                <td class="whitespace-nowrap p-4 text-base font-normal">
                                                    0%
                                                </td>
                                                <td class="whitespace-nowrap p-4 text-base font-semibold">
                                                    {{ price($payment->amount) }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-3 sm:ml-auto sm:w-72 sm:text-right">
                        <div class="flex justify-between">
                            <div class="text-sm font-medium uppercase text-gray-500 dark:text-gray-400">
                                {!! __('client.subtotal') !!}
                            </div>
                            <div class="text-base font-medium text-gray-900 dark:text-white">
                                {{ price($payment->amount) }}
                            </div>
                        </div>
                        {{-- @if (settings('taxes'))
                            <div class="flex justify-between">
                                <div class="text-sm font-medium uppercase text-gray-500 dark:text-gray-400">{!! __('client.tax_rate') !!}</div>
                                <div class="text-base font-medium text-gray-900 dark:text-white">0%</div>
                            </div>
                        @endif --}}
                        <div class="flex justify-between">
                            <div class="text-sm font-medium uppercase text-gray-500 dark:text-gray-400">
                                {!! __('client.discounts') !!}</div>
                            <div class="text-base font-medium text-gray-900 dark:text-white">{{ price(0) }}
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <div class="text-base font-semibold uppercase text-gray-900 dark:text-white">
                                {!! __('client.total') !!}</div>
                            <div class="text-base font-bold text-gray-900 dark:text-white">
                                {{ price($payment->amount) }}
                            </div>
                        </div>
                    </div>
                    @if ($payment->status == 'unpaid')
                        <form class="mt-8 space-y-6" method="POST" action="{{ route('invoice.pay', ['payment' => $payment->id]) }}">
                            @csrf
                            <div class="sm:w-72">
                                <div class="mb-4 text-base font-bold uppercase text-gray-900 dark:text-white">
                                    {!! __('client.complete_payment') !!}</div>
                                <select
                                    class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 mb-4 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                                    name="gateway" tabindex="-1" aria-hidden="true" required>
                                    @foreach (App\Models\Gateways\Gateway::getActive() as $gateway)
                                        @if ($gateway->name == 'Balance')
                                            <option value="{{ $gateway->id }}" @if (Auth::user()->balance >= $payment->amount) selected @endif>
                                                {{ __('client.pay_with_balance') }}
                                                ({{ price(Auth::user()->balance) }})
                                            </option>
                                            @continue
                                        @endif

                                        <option value="{{ $gateway->id }}">{{ $gateway->name }}</option>
                                    @endforeach
                                </select>
                                <div class="flex">
                                    <button type="submit"
                                        class="mb-2 mr-2 rounded-lg bg-green-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                        {{ __('client.pay') }}
                                    </button>
                                    <button type="button" onclick="copy('share', '{{ route('invoice', ['payment' => $payment->id]) }}')"
                                        id="share"
                                        class="mb-2 mr-2 rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:hover:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                                        {!! __('client.share') !!}
                                    </button>
                                    <a href="{{ route('invoice.download', $payment->id) }}"
                                        class="mb-2 mr-2 rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:hover:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                                        {!! __('client.sownload') !!}
                                    </a>
                                </div>
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400" style="margin-top: 5px">
                                {!! __('client.share_invoice_desc') !!}
                            </div>
                        </form>
                    @else
                        <a href="{{ route('invoice.download', $payment->id) }}"
                            class="mb-2 mr-2 rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:hover:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                            {!! __('client.sownload') !!}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </main>

    <script>
        function copy(id, text) {
            // Copy the text inside the text field
            navigator.clipboard.writeText(text);
            document.getElementById(id).innerHTML = 'Copied';
        }
    </script>
@endsection
