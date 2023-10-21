@extends(Theme::path('orders.master'))

@section('title', __('client.services'))

@section('content')

        <div id="service">
            <div class="p-4 mb-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel"
                aria-labelledby="profile-tab">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $order->package['name'] }}
                </h5>

                <div class="grid grid-cols-3 gap-4 mt-4">
                    <div
                        class="relative p-3 bg-gray-100 rounded-lg dark:bg-gray-700 flex flex-col items-start justify-between">
                        <h6 class="mb-2 text-base leading-none font-medium text-gray-900 dark:text-white">{!! __('client.package') !!}</h6>
                        <div class="flex items-center text-gray-500 dark:text-gray-400">{{ $order->package['name'] }}</div>
                    </div>
                    <div class="relative p-3 bg-gray-100 rounded-lg dark:bg-gray-700 flex flex-col justify-between">
                        <h6 class="mb-2 text-base leading-none font-medium text-gray-900 dark:text-white">{!! __('client.billing_cycle') !!}</h6>
                        <div class="flex items-center text-gray-500 dark:text-gray-400">
                            <span class="text-gray-500 dark:text-white font-bold mr-1"> {{ currency('symbol') }}{{ number_format($order->price['renewal_price'], 2) }}</span> /
                            {{ $order->period() }}
                        </div>
                    </div>
                    <div class="relative p-3 bg-gray-100 rounded-lg dark:bg-gray-700">
                        <h6 class="mb-2 text-base leading-none font-medium text-gray-900 dark:text-white">{!! __('client.status') !!}</h6>
                        <span class="@if($order->status == 'active') bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300 @elseif($order->status == 'suspended') bg-yellow-100 text-yellow-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300 @elseif($order->status == 'cancelled') bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300 @elseif($order->status == 'terminated') bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300 @endif">{!! __('admin.' . $order->status) !!}</span>
                    </div>
                    <div class="relative p-3 bg-gray-100 rounded-lg dark:bg-gray-700">
                        <h6 class="mb-2 text-base leading-none font-medium text-gray-900 dark:text-white">{!! __('client.due_date') !!}</h6>
                        <div class="flex items-center text-gray-500 dark:text-gray-400">
                            {{ $order->due_date->translatedFormat('d M Y') }}</div>
                    </div>
                    <div class="relative p-3 bg-gray-100 rounded-lg dark:bg-gray-700">
                        <h6 class="mb-2 text-base leading-none font-medium text-gray-900 dark:text-white">{!! __('client.last_renewal_date') !!}
                        </h6>
                        <div class="flex items-center text-gray-500 dark:text-gray-400">
                            {{ $order->last_renewed_at->translatedFormat('d M Y') }}</div>
                    </div>
                    <div class="relative p-3 bg-gray-100 rounded-lg dark:bg-gray-700">
                        <h6 class="mb-2 text-base leading-none font-medium text-gray-900 dark:text-white">{!! __('client.next_invoice') !!}</h6>
                        <div class="flex items-center text-gray-500 dark:text-gray-400">
                            {{ $order->due_date->translatedFormat('d M Y') }}</div>
                    </div>
                </div>
                <div class="flex items-center space-x-3 mt-4">
                    @include(Theme::path('components.orders.buttons'), $order)
                </div>
            </div>

            @includeIf(Theme::serviceView($order->service, 'service'))

        </div>
    {{-- @endforeach --}}
@endsection