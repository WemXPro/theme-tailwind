@extends(Theme::wrapper())
@section('title', __('client.dashboard'))

{{-- Keywords for search engines --}}
@section('keywords', 'WemX Dashboard, WemX Panel')

@section('container')
    <div class="flex flex-wrap">
        <div class="w-full pl-4 pl-4 pl-4 pr-4 pr-4 pr-4 sm:w-1/2 md:w-1/3 lg:w-1/4">
            @if ($order->domain)
                <div class="mb-4 rounded bg-white p-6 shadow dark:border-gray-700 dark:bg-gray-800">
                    <h5 class="mb-4 text-center text-lg font-bold tracking-tight text-gray-900 dark:text-white">{{ $order->domain }}</h5>
                    <div>
                        <a href="http://{{ $order->domain }}" target="_blank"
                            class="mb-2 mb-3 mr-2 flex justify-center rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:hover:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-700">{!! __('client.visit_website') !!}
                        </a>
                        <a href="https://www.whois.com/whois/{{ $order->domain }}" target="_blank"
                            class="mb-2 mr-2 flex justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">{!! __('client.whois_info') !!}
                        </a>
                    </div>
                </div>
            @endif
            <div class="mb-6 overflow-y-auto rounded bg-gray-50 px-3 py-4 dark:bg-gray-800">
                <ul class="space-y-2 font-medium">
                    <li>
                        <a href="{{ route('service', ['order' => $order->id, 'page' => 'manage']) }}"
                            class="{{ is_active('service', ['order' => $order, 'page' => 'manage'], 'bg-gray-100 dark:bg-gray-700') }} flex items-center rounded-lg p-2 text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                            <svg aria-hidden="true"
                                class="h-6 w-6 flex-shrink-0 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                                </path>
                            </svg>
                            <span class="ml-3 flex-1 whitespace-nowrap">{!! __('client.general') !!}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('service', ['order' => $order->id, 'page' => 'invoices']) }}"
                            class="{{ is_active('service', ['order' => $order, 'page' => 'invoices'], 'bg-gray-100 dark:bg-gray-700') }} flex items-center rounded-lg p-2 text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                            <svg aria-hidden="true"
                                class="h-6 w-6 flex-shrink-0 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z">
                                </path>
                                <path
                                    d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z">
                                </path>
                            </svg>
                            <span class="ml-3 flex-1 whitespace-nowrap">{!! __('client.invoices') !!}</span>
                            <span
                                class="ml-3 inline-flex h-3 w-3 items-center justify-center rounded-full bg-primary-100 p-3 text-sm font-medium text-primary-800 dark:bg-primary-900 dark:text-primary-300">
                                {{ $order->payments->where('user_id', auth()->user()->id)->count() }}
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('service', ['order' => $order->id, 'page' => 'members']) }}"
                            class="{{ is_active('service', ['order' => $order, 'page' => 'members'], 'bg-gray-100 dark:bg-gray-700') }} flex items-center rounded-lg p-2 text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                            <svg class="h-5 w-6 flex-shrink-0 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 19">
                                <path
                                    d="M14.5 0A3.987 3.987 0 0 0 11 2.1a4.977 4.977 0 0 1 3.9 5.858A3.989 3.989 0 0 0 14.5 0ZM9 13h2a4 4 0 0 1 4 4v2H5v-2a4 4 0 0 1 4-4Z" />
                                <path
                                    d="M5 19h10v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2ZM5 7a5.008 5.008 0 0 1 4-4.9 3.988 3.988 0 1 0-3.9 5.859A4.974 4.974 0 0 1 5 7Zm5 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm5-1h-.424a5.016 5.016 0 0 1-1.942 2.232A6.007 6.007 0 0 1 17 17h2a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5ZM5.424 9H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h2a6.007 6.007 0 0 1 4.366-5.768A5.016 5.016 0 0 1 5.424 9Z" />
                            </svg>
                            <span class="ml-3 flex-1 whitespace-nowrap">{!! __('client.members') !!}</span>
                        </a>
                    </li>
                    @foreach ($order->package->service()->getServiceSidebarButtons($order)->all() as $key => $button)
                        @if (empty($button))
                            @continue;
                        @endif
                        <li>
                            <a href="{{ $button['href'] ?? '#' }}" target="{{ $button['target'] ?? '' }}"
                                class="{{ is_active($button['href'], ['order' => $order, 'page' => 'invoices'], 'bg-gray-100 dark:bg-gray-700') }} flex items-center rounded-lg p-2 text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                <span
                                    class="flex h-6 w-6 flex-shrink-0 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                                    style="font-size: 23px;">
                                    {!! $button['icon'] !!}
                                </span>
                                <span class="ml-3 flex-1 whitespace-nowrap">{!! $button['name'] !!}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            @includeIf(Theme::serviceView($order->package->service, 'order_sidebar'))
        </div>
        <div class="w-full pl-4 pl-4 pl-4 pr-4 pr-4 pr-4 sm:w-1/2 md:w-2/3 lg:w-3/4">
            @include(Theme::path('components.orders.alerts'), $order)
            @yield('content')
        </div>
    </div>
@endsection
