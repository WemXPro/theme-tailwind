@extends(Theme::path('orders.master'))

@section('title', __('client.services'))

@section('content')
    <section>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="flex flex-col items-center justify-between space-y-3 p-4 bg-white dark:bg-gray-800 md:flex-row md:space-x-4 md:space-y-0">
                <ul class="hidden flex-wrap text-center text-sm font-medium text-gray-500 dark:text-gray-400 md:flex">
                    <li class="mr-2 lg:mr-4">
                        <a href="{{ url()->current() }}"
                            class="@if (request()->input('where', 'paid') == 'paid') inline-block px-4 py-2 text-white rounded-full bg-primary-600 @else inline-block px-4 py-2 border rounded-full dark:bg-gray-700 dark:border-gray-600 hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-white @endif">
                            {!! __('client.paid') !!}
                        </a>
                    </li>
                    <li class="mr-2 lg:mr-4">
                        <a href="{{ url()->current() }}?where=unpaid"
                            class="@if (request()->input('where', 'paid') == 'unpaid') inline-block px-4 py-2 text-white rounded-full bg-primary-600 @else inline-block px-4 py-2 border rounded-full dark:bg-gray-700 dark:border-gray-600 hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-white @endif"
                            aria-current="page">
                            {!! __('client.unpaid') !!}
                        </a>
                    </li>
                </ul>
            </div>
            <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            {!! __('client.description') !!}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                {!! __('client.amount') !!}
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                {!! __('client.date') !!}
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">{!! __('client.actions') !!}</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (auth()->user()->payments()->where('order_id', $order->id)->where('status', request()->input('where', 'paid'))->get() as $payment)
                        <tr class="border-b bg-white dark:border-gray-700 dark:bg-gray-800">
                            <th scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white">
                                {{ $payment->description }}
                            </th>
                            <td class="px-6 py-4">
                                {{ price($payment->amount) }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="pl-3">
                                    <div class="text-base text-sm font-semibold">{{ $payment->created_at->translatedFormat('d M Y') }}</div>
                                    <div class="font-normal text-gray-500">{{ $payment->created_at->diffForHumans() }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('invoice', ['payment' => $payment->id]) }}" target="_blank"
                                    class="font-medium text-primary-600 hover:underline dark:text-primary-500">
                                    {!! __('client.invoice') !!}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="flex flex-col items-start justify-between space-y-3 pb-4 pt-3 md:flex-row md:items-center md:space-y-0"
            aria-label="Table navigation"></div>
        @if (auth()->user()->payments->where('order_id', $order->id)->where('status', request()->input('where', 'paid'))->count() == 0)
            @include(Theme::path('empty-state'), [
                'title' => 'No records found',
                'description' =>
                    'You have not yet ' .
                    request()->input('where', 'paid') .
                    ' any invoices, ' .
                    request()->input('where', 'paid') .
                    ' invoices will appear here',
            ])
        @endif
    </section>
@endsection
