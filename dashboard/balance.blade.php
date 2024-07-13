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
                    @if (auth()->user()->balance_transactions()->count() == 0)
                        @include(Theme::path('empty-state'), [
                            'title' => 'No records found',
                            'description' => 'You have an empty balance history, click the widget to update your balance.',
                        ])
                    @else
                        <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                            <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        {!! __('client.description') !!}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <div class="flex items-center">
                                            {!! __('client.balance_before_transaction') !!}
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <div class="flex justify-end">
                                            {!! __('client.amount') !!}
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <div class="flex items-center">
                                            {!! __('client.date') !!}
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (auth()->user()->balance_transactions()->latest()->paginate(15) as $transaction)
                                    <tr class="border-b bg-white dark:border-gray-700 dark:bg-gray-800">
                                        <th scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white">
                                            <a href="@isset($transaction->payment_id){{ route('invoice', ['payment' => $transaction->payment_id]) }}@else # @endif">{{ $transaction->description }}</a>
                                        </th>
                                        <td class="px-6 py-4">
                                           {{ price($transaction->balance_before_transaction) }}
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            @if ($transaction->result == '+')
                                                <span class="bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                                    {{ $transaction->result }} {{ price($transaction->amount) }}</span>
                                            @elseif($transaction->result == '-')
                                                <span class="bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                                                    {{ $transaction->result }} {{ price($transaction->amount) }}</span>
                                            @elseif($transaction->result == '=')
                                                <span class="bg-gray-100 text-gray-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">
                                                    {{ $transaction->result }} {{ price($transaction->amount) }}</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="pl-3">
                                                <div class="text-base font-semibold text-sm">{{ $transaction->created_at->translatedFormat('d M Y') }}</div>
                                                <div class="font-normal text-gray-500">{{ $transaction->created_at->diffForHumans() }}</div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
                <div class="pagination
                                                mt-3 flex justify-end">
                                                {{ auth()->user()->balance_transactions()->latest()->paginate(15)->links(Theme::pagination()) }}
                </div>
            </section>
        </div>
    </div>
@endsection
