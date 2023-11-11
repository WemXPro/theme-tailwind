@extends(Theme::wrapper())
@section('title', __('client.dashboard'))

{{-- Keywords for search engines --}}
@section('keywords', 'WemX Dashboard, WemX Panel')

@push('widgets')
    <div class="flex flex-wrap ">
        <div class="lg:w-1/4 pr-4 pl-4 md:w-1/3 pr-4 pl-4 sm:w-1/2 pr-4 pl-4 w-full">
            @include(Theme::path('layouts.widgets.user_balance'))
        </div>
        @endpush

        @section('container')
            <div class="lg:w-3/4 pr-4 pl-4 md:w-2/3 pr-4 pl-4 sm:w-1/2 pr-4 pl-4 w-full">

                @include(Theme::path('layouts.widgets.service_stats'))

                <section class="dark:bg-gray-900 py-3 sm:py-5">
                    <div class="mx-auto max-w-screen-2xl">
                        <!-- Start coding here -->
                        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                            <div
                                class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4 border-b dark:border-gray-700">
                                <div class="w-full flex items-center space-x-3">
                                    <h5 class="dark:text-white font-semibold">{!! __('client.your_services') !!}</h5>
                                    <div
                                        class="text-gray-400 font-medium">{{ count(auth()->user()->orders()->where('status', Cookie::get('filter_orders', 'active'))->orderBy('status', 'asc')->orderBy('created_at', 'desc')->paginate(10)) }} {!! __('client.results') !!}</div>

                                    @if(count(auth()->user()->orders()->where('status', Cookie::get('filter_orders', 'active'))->orderBy('status', 'asc')->orderBy('created_at', 'desc')->paginate(10)) > 10)
                                        <div data-tooltip-target="results-tooltip">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400"
                                                 viewbox="0 0 20 20"
                                                 fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                      d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                      clip-rule="evenodd"/>
                                            </svg>
                                            <span class="sr-only">{!! __('client.more_info') !!}</span>
                                        </div>
                                        <div id="results-tooltip" role="tooltip"
                                             class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                            {!! __('client.showing', ['count' => '1-10', 'all' => count(auth()->user()->orders()->where('status', Cookie::get('filter_orders', 'active'))->orderBy('status', 'asc')->orderBy('created_at', 'desc')->paginate(10))]) !!}
                                            <div class="tooltip-arrow" data-popper-arrow=""></div>
                                        </div>
                                    @endif

                                </div>
                                <div class="w-full flex flex-row items-center justify-end space-x-3">
                                    <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown"
                                            class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                                            type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                             class="h-4 w-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                                                  clip-rule="evenodd"></path>
                                        </svg>
                                        {{ __('client.filter') }}
                                        <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                             xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path clip-rule="evenodd" fill-rule="evenodd"
                                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"></path>
                                        </svg>
                                    </button>
                                    <div id="filterDropdown"
                                         class="z-10 w-48 p-3 bg-white rounded-lg shadow dark:bg-gray-700 hidden"
                                         data-popper-placement="bottom"
                                         style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(1222px, 84px);">
                                        <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">{{ __('client.filter_status') }}</h6>
                                        <ul class="space-y-2 text-sm" aria-labelledby="filterDropdownButton">

                                            @foreach(auth()->user()->orders()->distinct()->pluck('status') as $status)
                                                <li class="flex items-center"
                                                    onclick="window.location.href = '{{ route('filter-orders', $status) }}'">
                                                    <input id="{{ $status }}"
                                                           @if(Cookie::get('filter_orders', 'active') == $status) checked
                                                           @endif type="checkbox" value="{{ $status }}"
                                                           class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="{{ $status }}"
                                                           class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">{{ __('client.'.$status) }}
                                                        ({{ auth()->user()->orders()->where('status', $status)->count() }}
                                                        )</label>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                    <button type="button" data-drawer-target="drawer-example"
                                            data-drawer-show="drawer-example" aria-controls="drawer-example"
                                            class="lg:truncate w-full md:w-auto flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-3 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                                        {!! __('client.add_balance') !!}
                                    </button>
                                    <a href="{{ route('store.index') }}"
                                       class="lg:truncate w-full md:w-auto flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-3 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                             xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path clip-rule="evenodd" fill-rule="evenodd"
                                                  d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"/>
                                        </svg>
                                        {!! __('client.order_new_service') !!}
                                    </a>
                                </div>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="px-4 py-3">
                                            <span class="sr-only">{!! __('client.expand_collapse_row') !!}</span>
                                        </th>
                                        <th scope="col"
                                            class="px-4 py-3 min-w-[14rem]">{!! __('client.product') !!}</th>
                                        <th scope="col" class="px-4 py-3 min-w-[10rem]">
                                            {!! __('client.service') !!}
                                            <svg class="h-4 w-4 ml-1 inline-block" fill="currentColor"
                                                 viewbox="0 0 20 20"
                                                 xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path clip-rule="evenodd" fill-rule="evenodd"
                                                      d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z"/>
                                            </svg>
                                        </th>
                                        <th scope="col" class="px-4 py-3 min-w-[6rem]">
                                            {!! __('client.category') !!}
                                            <svg class="h-4 w-4 ml-1 inline-block" fill="currentColor"
                                                 viewbox="0 0 20 20"
                                                 xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path clip-rule="evenodd" fill-rule="evenodd"
                                                      d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z"/>
                                            </svg>
                                        </th>
                                        <th scope="col" class="px-4 py-3 min-w-[7rem]">
                                            {!! __('client.status') !!}
                                            <svg class="h-4 w-4 ml-1 inline-block" fill="currentColor"
                                                 viewbox="0 0 20 20"
                                                 xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path clip-rule="evenodd" fill-rule="evenodd"
                                                      d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z"/>
                                            </svg>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody data-accordion="table-column">

                                    @foreach (auth()->user()->orders()->where('status', Cookie::get('filter_orders', 'active'))->orderBy('status', 'asc')->orderBy('created_at', 'desc')->paginate(10) as $order)

                                        <tr class="border-b dark:border-gray-700 hover:bg-gray-200 dark:hover:bg-gray-700 cursor-pointer transition"
                                            id="table-column-header-0"
                                            data-accordion-target="#table-column-body-{{ $order->id }}"
                                            aria-expanded="false" aria-controls="table-column-body-{{ $order->id }}">
                                            <td class="p-3 w-4">
                                                <svg data-accordion-icon="" class="w-6 h-6 shrink-0" fill="currentColor"
                                                     viewbox="0 0 20 20" aria-hidden="true"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                          clip-rule="evenodd"/>
                                                </svg>
                                            </td>

                                            <th scope="row"
                                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white flex items-center">
                                                <img class="w-9 h-9 rounded mr-2"
                                                     src="{{ asset('storage/products/' . $order->package['icon']) }}"
                                                     alt="">
                                                <span class="flex flex-col">{{ $order->name }} <small
                                                        class="text-gray-500 dark:text-gray-400">@isset($order->domain)
                                                            {{ $order->domain }}
                                                        @endisset</small></span>
                                            </th>
                                            <td class="px-4 py-3">{{ $order->service }}</td>
                                            <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $order->package['category']['name'] }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap">
                                                <span
                                                    class="@if($order->status == 'active') bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300
                                                    @elseif($order->status == 'suspended')
                                                    bg-yellow-100 text-yellow-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300
                                                    @elseif($order->status == 'cancelled') bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300
                                                    @elseif($order->status == 'terminated') bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300 @endif">
                                                    {!! __('client.'.  $order->status) !!}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr class="hidden flex-1 overflow-x-auto w-full"
                                            id="table-column-body-{{ $order->id }}"
                                            aria-labelledby="table-column-header-0">
                                            <td class="p-4 border-b dark:border-gray-700" colspan="9">
                                                <div>
                                                    @include(Theme::path('components.orders.alerts'), $order)

                                                    <h6 class="mb-2 text-base leading-none font-medium text-gray-900 dark:text-white">
                                                        {!! __('client.details') !!}
                                                    </h6>
                                                </div>
                                                <div class="grid grid-cols-3 gap-4 mt-4">
                                                    <div
                                                        class="relative p-3 bg-gray-100 rounded-lg dark:bg-gray-700 flex flex-col items-start justify-between">
                                                        <h6 class="mb-2 text-base leading-none font-medium text-gray-900 dark:text-white">
                                                            {!! __('client.package') !!}
                                                        </h6>
                                                        <div class="flex items-center text-gray-500 dark:text-gray-400">
                                                            {{ $order->package['name'] }}</div>
                                                    </div>
                                                    <div
                                                        class="relative p-3 bg-gray-100 rounded-lg dark:bg-gray-700 flex flex-col justify-between">
                                                        <h6 class="mb-2 text-base leading-none font-medium text-gray-900 dark:text-white">
                                                            {!! __('client.billing_cycle') !!}
                                                        </h6>
                                                        <div class="flex items-center text-gray-500 dark:text-gray-400">
                                                        <span class="text-dark font-bold mr-1 dark:text-gray-200">
                                                            {{ currency('symbol') }}{{ $order->price['renewal_price'] }}</span>
                                                            /
                                                            {{ $order->periodToHuman() }}
                                                        </div>
                                                    </div>

                                                    <div class="relative p-3 bg-gray-100 rounded-lg dark:bg-gray-700">
                                                        <h6 class="mb-2 text-base leading-none font-medium text-gray-900 dark:text-white">
                                                            {!! __('client.status') !!}
                                                        </h6>
                                                        <span class="@if($order->status == 'active') bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300
                                                            @elseif($order->status == 'suspended') bg-yellow-100 text-yellow-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300
                                                            @elseif($order->status == 'cancelled') bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300
                                                            @elseif($order->status == 'terminated') bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300 @endif">
                                                            {!! __('client.'.  $order->status) !!}
                                                        </span>

                                                    </div>
                                                    @if($order->isRecurring())
                                                    <div class="relative p-3 bg-gray-100 rounded-lg dark:bg-gray-700">
                                                        <h6 class="mb-2 text-base leading-none font-medium text-gray-900 dark:text-white">
                                                            {!! __('client.due_date') !!}
                                                        </h6>
                                                        <div class="flex items-center text-gray-500 dark:text-gray-400">
                                                            {{ $order->due_date->translatedFormat('d M Y') }}</div>
                                                    </div>
                                                    <div class="relative p-3 bg-gray-100 rounded-lg dark:bg-gray-700">
                                                        <h6 class="mb-2 text-base leading-none font-medium text-gray-900 dark:text-white">
                                                            {!! __('client.last_renewal_date') !!}
                                                        </h6>
                                                        <div class="flex items-center text-gray-500 dark:text-gray-400">
                                                            {{ $order->last_renewed_at->translatedFormat('d M Y') }}</div>
                                                    </div>
                                                    <div class="relative p-3 bg-gray-100 rounded-lg dark:bg-gray-700">
                                                        <h6 class="mb-2 text-base leading-none font-medium text-gray-900 dark:text-white">
                                                            {!! __('client.next_invoice') !!}
                                                        </h6>
                                                        <div class="flex items-center text-gray-500 dark:text-gray-400">
                                                            {{ $order->due_date->translatedFormat('d M Y') }}</div>
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="flex items-center space-x-3 mt-4">
                                                    {{-- @include(Theme::path('components.orders.buttons'), $order) --}}
                                                    <x-orders.buttons :order="$order"/>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div
                                class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 px-4 pt-3 pb-4"
                                aria-label="{{ __('client.table_navigation') }}">
                                {{ auth()->user()->orders()->where('status', Cookie::get('filter_orders', 'active'))->orderBy('status', 'asc')->orderBy('created_at', 'desc')->paginate(10)->links(Theme::pagination()) }}
                            </div>
                        </div>
                        @if(count(auth()->user()->orders()->where('status', Cookie::get('filter_orders', 'active'))->orderBy('status', 'asc')->orderBy('created_at', 'desc')->paginate(10)) == 0)
                            <div class="mt-7">
                                @include(Theme::path('empty-state'), ['title' => __('client.no_orders_found'), 'description' => __('client.no_orders_found_desc')])
                            </div>
                        @endif
                    </div>
                </section>
            </div>
    </div>
    @endsection
