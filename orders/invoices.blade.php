@extends(Theme::path('orders.master'))

@section('title', __('client.services'))

@section('content')
<section class="dark:bg-gray-900">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4 dark:bg-gray-800">
            <ul class="flex-wrap hidden text-sm font-medium text-center text-gray-500 md:flex dark:text-gray-400">

                <li class=" mr-2 lg:mr-4">
                    <a href="{{ url()->current() }}" class="@if(request()->input('where', 'paid') == 'paid') inline-block px-4 py-2 text-white rounded-full bg-primary-600 @else inline-block px-4 py-2 border rounded-full dark:bg-gray-700 dark:border-gray-600 hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-white  @endif">
                        {!! __('client.paid') !!}
                    </a>
                  </li>

                <li class=" mr-2 lg:mr-4">
                    <a href="{{ url()->current() }}?where=unpaid" class="@if(request()->input('where', 'paid') == 'unpaid') inline-block px-4 py-2 text-white rounded-full bg-primary-600 @else inline-block px-4 py-2 border rounded-full dark:bg-gray-700 dark:border-gray-600 hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-white  @endif" aria-current="page">
                        {!! __('client.unpaid') !!}
                    </a>
                  </li>

              </ul>
        </div>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
            @foreach (auth()->user()->payments()->where('order_id', $order->id)->where('status' , request()->input('where', 'paid'))->get() as $payment)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                       {{ $payment->description }}
                    </th>
                    <td class="px-6 py-4">
                        {{ currency('symbol') }}{{ number_format($payment->amount, 2) }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="pl-3">
                            <div class="text-base font-semibold text-sm">{{ $payment->created_at->translatedFormat('d M Y') }}</div>
                            <div class="font-normal text-gray-500">{{ $payment->created_at->diffForHumans() }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('invoice', ['payment' => $payment->id]) }}" target="_blank" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                            {!! __('client.invoice') !!}</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 pt-3 pb-4" aria-label="Table navigation">

    </div>
    @if(auth()->user()->payments->where('order_id', $order->id)->where('status' , request()->input('where', 'paid'))->count() == 0)
        @include(Theme::path('empty-state'), ['title' => 'No records found', 'description' => 'You have not yet '.request()->input('where', 'paid').' any invoices, '.request()->input('where', 'paid').' invoices will appear here'])
    @endif
</section>
@endsection