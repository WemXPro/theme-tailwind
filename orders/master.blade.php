@extends(Theme::wrapper())
@section('title', __('client.dashboard'))

{{-- Keywords for search engines --}}
@section('keywords', 'WemX Dashboard, WemX Panel')

@section('container')
    <div class="flex flex-wrap ">
        <div class="lg:w-1/4 pr-4 pl-4 md:w-1/3 pr-4 pl-4 sm:w-1/2 pr-4 pl-4 w-full">
            @if($order->domain)
            <div class="p-6 bg-white rounded shadow dark:bg-gray-800 dark:border-gray-700 mb-4">
                <h5 class="mb-4 text-lg font-bold tracking-tight text-gray-900 dark:text-white text-center">{{ $order->domain }}</h5>
                <div>
                    <a href="http://{{ $order->domain }}" target="_blank" class="text-gray-900 mb-3 flex justify-center bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Visit Website</a>
                    <a href="https://www.whois.com/whois/{{ $order->domain }}" target="_blank" class="text-white flex justify-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">WHOIS Info</a>
                </div>
            </div>
            @endif
            <div class="px-3 rounded py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
                <ul class="space-y-2 font-medium">
                    <li>
                        <a href="{{ route('service', ['order' => $order->id, 'page' => 'manage']) }}"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 {{ is_active('service', ['order' => $order, 'page' => 'manage'], 'bg-gray-100 dark:bg-gray-700') }}">
                            <svg aria-hidden="true"
                                class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                                </path>
                            </svg>
                            <span class="flex-1 ml-3 whitespace-nowrap">{!! __('client.general') !!}</span>
                            <span
                                class="inline-flex items-center justify-center px-2 ml-3 text-sm font-medium text-gray-800 bg-gray-200 rounded-full dark:bg-gray-700 dark:text-gray-300">Pro</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('service', ['order' => $order->id, 'page' => 'invoices']) }}"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 {{ is_active('service', ['order' => $order, 'page' => 'invoices'], 'bg-gray-100 dark:bg-gray-700') }}">
                            <svg aria-hidden="true"
                                class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z">
                                </path>
                                <path
                                    d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z">
                                </path>
                            </svg>
                            <span class="flex-1 ml-3 whitespace-nowrap">{!! __('client.invoices') !!}</span>
                            <span
                                class="inline-flex items-center justify-center w-3 h-3 p-3 ml-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">
                                {{ $order->payments->where('user_id', auth()->user()->id)->count() }}</span>
                        </a>
                    </li>
                    @foreach($order->package->service()->getServiceSidebarButtons($order)->all() as $key => $button)
                    @if(empty($button))
                        @continue;
                    @endif
                    <li>
                        <a href="{{ $button['href'] ?? '#' }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-600 hover:border-gray-300 dark:hover:border-gray-400 dark:hover:text-gray-300">
                            <span class="flex-shrink-0 flex w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" style="font-size: 23px;"">
                                {!! $button['icon'] !!}
                            </span>
                            <span class="flex-1 ml-3 whitespace-nowrap">{!! $button['name'] !!}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="lg:w-3/4 pr-4 pl-4 md:w-2/3 pr-4 pl-4 sm:w-1/2 pr-4 pl-4 w-full">
            @include(Theme::path('components.orders.alerts'), $order)
            @includeIf(Theme::serviceView($order->service, 'stats'))
            @yield('content')
        </div>
    </div>
@endsection