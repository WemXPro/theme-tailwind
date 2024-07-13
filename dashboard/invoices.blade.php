@extends(Theme::wrapper())
@section('title', __('client.dashboard'))

{{-- Keywords for search engines --}}
@section('keywords', 'WemX Dashboard, WemX Panel')

@section('container')
    <div class="flex flex-wrap">
        <div class="w-full pl-2 pr-2 sm:w-1/2 md:w-1/3 lg:w-1/3">
            @include(Theme::path('layouts.widgets.user_balance'))
        </div>
        <div class="w-full pl-2 pr-2 sm:w-1/2 md:w-2/3 lg:w-2/3">
            @include(Theme::path('layouts.widgets.service_stats'))

            <section class="py-3 dark:bg-gray-900 sm:py-5">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <div class="flex flex-col items-center justify-between space-y-3 p-4 bg-white dark:bg-gray-800 md:flex-row md:space-x-4 md:space-y-0">
                        <ul class="hidden flex-wrap text-center text-sm font-medium text-gray-500 dark:text-gray-400 md:flex">
                            <li class="mr-2 lg:mr-4">
                                <a href="/invoices"
                                    class="@if (request()->input('where', 'paid') == 'paid') inline-block px-4 py-2 text-white rounded-full bg-primary-600
                                @else inline-block px-4 py-2 border rounded-full dark:bg-gray-700 dark:border-gray-600 hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-white @endif">
                                    {!! __('client.paid') !!}
                                </a>
                            </li>

                            <li class="mr-2 lg:mr-4">
                                <a href="/invoices?where=unpaid"
                                    class="@if (request()->input('where', 'paid') == 'unpaid') inline-block px-4 py-2 text-white rounded-full bg-primary-600
                                @else inline-block px-4 py-2 border rounded-full dark:bg-gray-700 dark:border-gray-600 hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-white @endif"
                                    aria-current="page">
                                    {!! __('client.unpaid') !!}
                                </a>
                            </li>

                            @if (auth()->user()->payments()->where('status', 'refunded')->exists())
                                <li class="mr-2 lg:mr-4">
                                    <a href="/invoices?where=refunded"
                                        class="@if (request()->input('where', 'paid') == 'refunded') inline-block px-4 py-2 text-white rounded-full bg-primary-600
                                @else inline-block px-4 py-2 border rounded-full dark:bg-gray-700 dark:border-gray-600 hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-white @endif"
                                        aria-current="page">
                                        {!! __('client.refunded') !!}
                                    </a>
                                </li>
                            @endif

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
                            @foreach (auth()->user()->payments()->where('status', request()->input('where', 'paid'))->orderBy('created_at', 'desc')->paginate(15) as $payment)
                                @if ($payment->status == 'unpaid' and !$payment->show_as_unpaid_invoice)
                                    @continue
                                @endif

                                <tr class="border-b bg-white dark:border-gray-700 dark:bg-gray-800">
                                    <th scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        {{ $payment->description }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ price($payment->amount) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="pl-3">
                                            <div class="text-base text-sm font-semibold">{{ $payment->created_at->translatedFormat('d M Y') }}
                                            </div>
                                            <div class="font-normal text-gray-500">{{ $payment->created_at->diffForHumans() }}</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="{{ route('invoice', ['payment' => $payment->id]) }}" target="_blank"
                                            class="font-medium text-blue-600 hover:underline dark:text-blue-500">{!! __('client.invoice') !!}</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="flex flex-col items-start justify-between space-y-3 pb-4 pt-3 md:flex-row md:items-center md:space-y-0"
                    aria-label="{{ __('client.table_navigation') }}">
                    {{ auth()->user()->payments()->where('status', request()->input('where', 'paid'))->where('show_as_unpaid_invoice', request()->input('where', 'paid') == 'paid' ? false : true)->paginate(15)->links(Theme::pagination()) }}
                </div>
                @if (auth()->user()->payments->where('status', request()->input('where', 'paid'))->where('show_as_unpaid_invoice', request()->input('where', 'paid') == 'paid' ? false : true)->count() == 0)
                    @include(Theme::path('empty-state'), [
                        'title' => __('client.no_records_found'),
                        'description' => __('client.no_record_found_desc', ['paid' => request()->input('where', 'paid')]),
                    ])
                @endif
            </section>
        </div>
    </div>
@endsection
