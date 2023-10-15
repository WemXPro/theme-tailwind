@extends(Theme::wrapper())
@section('title', __('client.dashboard'))

{{-- Keywords for search engines --}}
@section('keywords', 'WemX Dashboard, WemX Panel')

@section('container')
    <div class="flex flex-wrap ">
        <div class="lg:w-1/4 pr-4 pl-4 md:w-1/3 pr-4 pl-4 sm:w-1/2 pr-4 pl-4 w-full">
            @include(Theme::path('layouts.widgets.user_balance'))
        </div>
        <div class="lg:w-3/4 pr-4 pl-4 md:w-2/3 pr-4 pl-4 sm:w-1/2 pr-4 pl-4 w-full">

            @include(Theme::path('layouts.widgets.service_stats'))

            <section class="dark:bg-gray-900 py-3 sm:py-5">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <div
                        class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4 dark:bg-gray-800">
                        <ul class="flex-wrap hidden text-sm font-medium text-center text-gray-500 md:flex dark:text-gray-400">

                            <li class=" mr-2 lg:mr-4">
                                <a href="/invoices" class="@if(request()->input('where', 'paid') == 'paid') inline-block px-4 py-2 text-white rounded-full bg-primary-600
                                @else inline-block px-4 py-2 border rounded-full dark:bg-gray-700 dark:border-gray-600 hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-white  @endif">
                                    {!! __('client.paid') !!}
                                </a>
                            </li>

                            <li class=" mr-2 lg:mr-4">
                                <a href="/invoices?where=unpaid" class="@if(request()->input('where', 'paid') == 'unpaid') inline-block px-4 py-2 text-white rounded-full bg-primary-600
                                @else inline-block px-4 py-2 border rounded-full dark:bg-gray-700 dark:border-gray-600 hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-white  @endif"
                                   aria-current="page">
                                    {!! __('client.unpaid') !!}
                                </a>
                            </li>

                            @if(auth()->user()->payments()->where('status' , 'refunded')->exists())
                                <li class=" mr-2 lg:mr-4">
                                    <a href="/invoices?where=refunded" class="@if(request()->input('where', 'paid') == 'refunded') inline-block px-4 py-2 text-white rounded-full bg-primary-600
                                @else inline-block px-4 py-2 border rounded-full dark:bg-gray-700 dark:border-gray-600 hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-white  @endif"
                                       aria-current="page">
                                        {!! __('client.refunded') !!}
                                    </a>
                                </li>
                            @endif

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
                        @foreach (auth()->user()->payments()->where('status' , request()->input('where', 'paid'))->orderBy('created_at', 'desc')->paginate(15) as $payment)

                            @if($payment->status == 'unpaid' AND !$payment->show_as_unpaid_invoice)
                                @continue
                            @endif

                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $payment->description }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ currency('symbol') }}{{ number_format($payment->amount, 2) }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="pl-3">
                                        <div
                                            class="text-base font-semibold text-sm">{{$payment->created_at->translatedFormat('d M Y') }}</div>
                                        <div
                                            class="font-normal text-gray-500">{{ $payment->created_at->diffForHumans() }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('invoice', ['payment' => $payment->id]) }}" target="_blank"
                                       class="font-medium text-blue-600 dark:text-blue-500 hover:underline">{!! __('client.invoice') !!}</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div
                    class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 pt-3 pb-4"
                    aria-label="{{ __('client.table_navigation') }}">
                    {{ auth()->user()->payments()->where('status' , request()->input('where', 'paid'))->where('show_as_unpaid_invoice', request()->input('where', 'paid') == 'paid' ? false : true)->paginate(15)->links(Theme::pagination()) }}
                </div>
                @if(auth()->user()->payments->where('status' , request()->input('where', 'paid'))->where('show_as_unpaid_invoice', request()->input('where', 'paid') == 'paid' ? false : true)->count() == 0)
                    @include(Theme::path('empty-state'), [ 'title' => __('client.no_records_found'),
                    'description' => __('client.no_record_found_desc', ['paid' => request()->input('where', 'paid')])])
                @endif
            </section>
        </div>
    </div>
@endsection
