@extends(Theme::wrapper())
@section('title', __('client.dashboard'))

{{-- Keywords for search engines --}}
@section('keywords', 'WemX Dashboard, WemX Panel')

@php
    if (Cookie::get('filter_orders', 'all') == 'all') {
        $orders = auth()->user()->orders()->orderBy('status', 'asc')->orderBy('created_at', 'desc')->paginate(10);
    } else {
        $orders = auth()->user()->orders()->where('status', Cookie::get('filter_orders', 'active'))->orderBy('status', 'asc')->orderBy('created_at', 'desc')->paginate(10);
    }
@endphp

@push('widgets')
    <div class="flex flex-wrap">
        <div class="w-full pl-2 pr-2 sm:w-1/2 md:w-1/3 lg:w-1/3">
            @include(Theme::path('layouts.widgets.user_balance'))

            @if(settings('widget:dashboard:2fa', false))
            <div class="mb-4 rounded-lg bg-white p-4 shadow dark:bg-gray-800 sm:p-6 xl:p-8">
                <h3 class="text-xl font-bold dark:text-white">{!! __('client.two_factor_authentication') !!}</h3>
                <p class="mt-2 text-sm font-normal text-gray-500 dark:text-gray-400">
                    {!! __('client.two_factor_authentication_desc') !!}
                </p>
                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                    <li class="py-4">
                        <div class="flex justify-end space-x-4">
                            <div class="inline-flex items-center">
                                @if (!Auth::user()->TwoFa()->exists())
                                    <a href="{{ route('2fa.setup') }}"
                                        class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 mb-2 mr-2 rounded-lg px-5 py-2.5 text-sm font-medium text-white focus:outline-none focus:ring-4">
                                        {!! __('client.enable') !!}
                                    </a>
                                @else
                                    <button type="button" data-modal-target="disableTwoFA" data-modal-toggle="disableTwoFA"
                                        class="mb-2 mr-2 rounded-lg bg-red-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                        {!! __('client.disable') !!}
                                    </button>
                                @endif
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

                @if (Auth::user()->TwoFa()->exists())
                <!-- Disable 2FA modal -->
                <div id="disableTwoFA" tabindex="-1" aria-hidden="true"
                    class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full overflow-y-auto overflow-x-hidden p-4 md:inset-0">
                    <div class="relative max-h-full w-full max-w-2xl">
                        <!-- Modal content -->
                        <form action="{{ route('2fa.disable') }}" method="POST">
                            @csrf
                            <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
                                <!-- Modal header -->
                                <div class="flex items-start justify-between rounded-t border-b p-4 dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        {!! __('client.two_factor_authentication') !!}
                                    </h3>
                                    <button type="button"
                                        class="ml-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                                        data-modal-hide="disableTwoFA">
                                        <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">{{ __('client.disable') }}</span>
                                    </button>
                                </div>
        
                                <!-- Modal body -->
                                <div class="space-y-6 p-6">
                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                        {!! __('client.two_factor_authentication_desc') !!}
                                    </p>
                                    <div>
                                        <label for="opt"
                                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-gray-300">{!! __('auth.2fa_code') !!}</label>
                                        <input type="text" name="OPT" id="opt"
                                            class="focus:ring-primary-500 focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                                            placeholder="XXXXXX" required="">
                                    </div>
                                    <div class="flex items-start justify-between">
                                        <div class="flex items-center justify-end">
                                            <a href="{{ route('2fa.recover') }}"
                                                class="text-primary-600 dark:text-primary-500 text-sm font-medium hover:underline">
        
                                                {!! __('auth.lost_access_to_device') !!}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal footer -->
                                <div class="flex items-center justify-end space-x-2 rounded-b border-t border-gray-200 p-6 dark:border-gray-600">
                                    <button type="submit"
                                        class="rounded-lg bg-red-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">{!! __('client.disable') !!}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Disable 2FA modal -->
            @endif
            @endif

            @if(settings('widget:dashboard:social_accounts', false))
            <div class="mb-4 rounded-lg bg-white p-4 shadow dark:bg-gray-800 sm:p-6 xl:p-8">
                <div class="flow-root">
                    <h3 class="text-xl font-bold dark:text-white">{!! __('client.social_accounts') !!}</h3>
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                        @if (Settings::getJson('encrypted::oauth::google', 'is_enabled', false))
                            <li class="pb-6 pt-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <i class='bx bxl-google dark:text-white' style="font-size: 1.75rem;"></i>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <span class="block truncate text-base font-semibold text-gray-900 dark:text-white">
                                            {!! __('client.google_account') !!}
                                        </span>
                                        <span class="block flex items-center truncate text-sm font-normal text-gray-500 dark:text-gray-400">
                                            @if (Auth::user()->oauthService('google')->exists())
                                                {{ Auth::user()->oauthService('google')->first()->email }} <i
                                                    class='bx bxs-badge-check ml-1'></i>
                                            @else
                                                {!! __('client.not_connected') !!}
                                            @endif
                                        </span>
                                    </div>
                                    <div class="inline-flex items-center">
                                        @if (Auth::user()->oauthService('google')->exists())
                                            <a href="{{ route('oauth.remove', 'google') }}"
                                                class="mb-2 mr-3 rounded-lg border border-red-700 px-3 py-2 text-center text-sm font-medium text-red-700 hover:bg-red-800 hover:text-white focus:outline-none focus:ring-4 focus:ring-red-300 dark:border-red-500 dark:text-red-500 dark:hover:bg-red-600 dark:hover:text-white dark:focus:ring-red-900">
                                                {!! __('client.remove') !!}
                                            </a>
                                        @else
                                            <a href="{{ route('oauth.connect', 'google') }}"
                                                class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 mr-3 rounded-lg px-3 py-2 text-center text-sm font-medium text-white focus:ring-4">
                                                {!! __('client.connect') !!}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endif
                        @if (Settings::getJson('encrypted::oauth::github', 'is_enabled', false))
                            <li class="pb-6 pt-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <i class='bx bxl-github dark:text-white' style="font-size: 1.75rem;"></i>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <span class="block truncate text-base font-semibold text-gray-900 dark:text-white">
                                            {!! __('client.github_account') !!}
                                        </span>
                                        <span class="block truncate text-sm font-normal text-gray-500 dark:text-gray-400">
                                            @if (Auth::user()->oauthService('github')->exists())
                                                <a class="text-blue-500"
                                                    href="{{ Auth::user()->oauthService('github')->first()->external_profile }}"
                                                    target="_blank">{{ Auth::user()->oauthService('github')->first()->external_profile }}</a>
                                            @else
                                                {!! __('client.not_connected') !!}
                                            @endif
                                        </span>
                                    </div>
                                    <div class="inline-flex items-center">
                                        @if (Auth::user()->oauthService('github')->exists())
                                            <a href="{{ route('oauth.remove', 'github') }}"
                                                class="mb-2 mr-3 rounded-lg border border-red-700 px-3 py-2 text-center text-sm font-medium text-red-700 hover:bg-red-800 hover:text-white focus:outline-none focus:ring-4 focus:ring-red-300 dark:border-red-500 dark:text-red-500 dark:hover:bg-red-600 dark:hover:text-white dark:focus:ring-red-900">
                                                {!! __('client.remove') !!}
                                            </a>
                                        @else
                                            <a href="{{ route('oauth.connect', 'github') }}"
                                                class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 mr-3 rounded-lg px-3 py-2 text-center text-sm font-medium text-white focus:ring-4">
                                                {!! __('client.connect') !!}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endif
                        @if (Settings::getJson('encrypted::oauth::discord', 'is_enabled', false))
                            <li class="pb-6 pt-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <i class='bx bxl-discord-alt dark:text-white' style="font-size: 1.75rem;"></i>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <span class="block truncate text-base font-semibold text-gray-900 dark:text-white">
                                            {!! __('client.discord_account') !!}
                                        </span>
                                        <span class="block flex items-center truncate text-sm font-normal text-gray-500 dark:text-gray-400">
                                            @if (Auth::user()->oauthService('discord')->exists())
                                                {{ Auth::user()->oauthService('discord')->first()->data->username }} <i
                                                    class='bx bxs-badge-check ml-1'></i>
                                            @else
                                                {!! __('client.not_connected') !!}
                                            @endif
                                        </span>
                                    </div>
                                    <div class="inline-flex items-center">
                                        @if (Auth::user()->oauthService('discord')->exists())
                                            <a href="{{ route('oauth.remove', 'discord') }}"
                                                class="mb-2 mr-3 rounded-lg border border-red-700 px-3 py-2 text-center text-sm font-medium text-red-700 hover:bg-red-800 hover:text-white focus:outline-none focus:ring-4 focus:ring-red-300 dark:border-red-500 dark:text-red-500 dark:hover:bg-red-600 dark:hover:text-white dark:focus:ring-red-900">
                                                {!! __('client.remove') !!}
                                            </a>
                                        @else
                                            <a href="{{ route('oauth.connect', 'discord') }}"
                                                class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 mr-3 rounded-lg px-3 py-2 text-center text-sm font-medium text-white focus:ring-4">
                                                {!! __('client.connect') !!}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endif
                        @foreach (enabledModules() as $module)
                            @if(settings("widget:dashboard-sidebar:{$module->getLowerName()}", false))
                                @includeIf(Theme::moduleView($module->getLowerName(), 'widgets.dashboard-sidebar-widget'))
                            @endif
                        @endforeach
                    </ul>
                    <div></div>
                </div>
            </div>
            @endif
        </div>
        @endpush

        @section('container')
            <div class="w-full pl-2 pr-2 sm:w-1/2 md:w-2/3 lg:w-2/3">
                @include(Theme::path('layouts.widgets.service_stats'))

                <section class="py-3 dark:bg-gray-900 sm:py-5">
                    <div class="mx-auto max-w-screen-2xl">
                        <div class="relative overflow-visible bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                            <div
                                class="flex flex-col items-center justify-between space-y-3 border-b p-4 dark:border-gray-700 md:flex-row md:space-x-4 md:space-y-0">
                                <div class="flex w-full items-center space-x-3">
                                    <h5 class="font-semibold dark:text-white">{!! __('client.your_services') !!}</h5>
                                    <div class="font-medium text-gray-400">
                                        {{ count($orders) }} {!! __('client.results') !!}
                                    </div>

                                    @if (count($orders) > 10)
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
                                             class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700">
                                            {!! __('client.showing', [
                                                'count' => '1-10',
                                                'all' => count($orders),
                                            ]) !!}
                                            <div class="tooltip-arrow" data-popper-arrow=""></div>
                                        </div>
                                    @endif

                                </div>
                                <div class="flex w-full flex-row items-center justify-end space-x-3">
                                    <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown"
                                            class="hover:text-primary-700 flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 md:w-auto"
                                            type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                             class="mr-2 h-4 w-4 text-gray-400"
                                             viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                                                  clip-rule="evenodd"></path>
                                        </svg>
                                        {{ __('client.filter') }}
                                        <svg class="-mr-1 ml-1.5 h-5 w-5" fill="currentColor" viewBox="0 0 20 20"
                                             xmlns="http://www.w3.org/2000/svg"
                                             aria-hidden="true">
                                            <path clip-rule="evenodd" fill-rule="evenodd"
                                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z">
                                            </path>
                                        </svg>
                                    </button>
                                    <div id="filterDropdown"
                                         class="z-10 hidden w-48 rounded-lg bg-white p-3 shadow dark:bg-gray-700"
                                         data-popper-placement="bottom"
                                         style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(1222px, 84px);">
                                        <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">{{ __('client.filter_status') }}</h6>
                                        <ul class="space-y-2 text-sm" aria-labelledby="filterDropdownButton">
                                            <li class="flex items-center"
                                                onclick="window.location.href = '{{ route('filter-orders', 'all') }}'">
                                                <input id="all" type="checkbox" name="filter_orders"
                                                       @if (Cookie::get('filter_orders', 'all') == 'all') checked
                                                       @endif
                                                       class="text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 h-4 w-4 rounded border-gray-300 bg-gray-100 focus:ring-2 dark:border-gray-500 dark:bg-gray-600 dark:ring-offset-gray-700">
                                                <label for="all"
                                                       class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">{{ __('admin.view_all') }}
                                                    ({{ auth()->user()->orders->count() }})
                                                </label>
                                            </li>
                                            @foreach (auth()->user()->orders()->distinct()->pluck('status') as $status)
                                                <li class="flex items-center"
                                                    onclick="window.location.href = '{{ route('filter-orders', $status) }}'">
                                                    <input id="{{ $status }}"
                                                           @if (Cookie::get('filter_orders', 'all') == $status) checked
                                                           @endif type="checkbox"
                                                           value="{{ $status }}"
                                                           class="text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 h-4 w-4 rounded border-gray-300 bg-gray-100 focus:ring-2 dark:border-gray-500 dark:bg-gray-600 dark:ring-offset-gray-700">
                                                    <label for="{{ $status }}"
                                                           class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">{{ __('client.' . $status) }}
                                                        ({{ auth()->user()->orders()->where('status', $status)->count() }})
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <button type="button" data-drawer-target="drawer-example"
                                            data-drawer-show="drawer-example"
                                            aria-controls="drawer-example"
                                            class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 flex w-full items-center justify-center truncate rounded-lg px-3 py-2 text-sm font-medium text-white focus:outline-none focus:ring-4 md:w-auto">
                                        {!! __('client.add_balance') !!}
                                    </button>
                                    <a href="{{ route('store.index') }}"
                                       class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 flex w-full items-center justify-center truncate rounded-lg px-3 py-2 text-sm font-medium text-white focus:outline-none focus:ring-4 md:w-auto">
                                        <svg class="mr-2 h-3.5 w-3.5" fill="currentColor" viewbox="0 0 20 20"
                                             xmlns="http://www.w3.org/2000/svg"
                                             aria-hidden="true">
                                            <path clip-rule="evenodd" fill-rule="evenodd"
                                                  d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"/>
                                        </svg>
                                        {!! __('client.order_new_service') !!}
                                    </a>
                                </div>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                                    <thead class="bg-gray-50 text-xs uppercase dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="px-4 py-3 whitespace-nowrap">
                                            <span class="sr-only">{!! __('client.expand_collapse_row') !!}</span>
                                        </th>
                                        <th scope="col"
                                            class="px-4 py-3 whitespace-nowrap">{!! __('client.product') !!}</th>
                                        <th scope="col"
                                            class="px-4 py-3 whitespace-nowrap">{!! __('client.members') !!}</th>
                                        <th scope="col" class="px-4 py-3 whitespace-nowrap">
                                            {!! __('client.due_date') !!}
                                        </th>
                                        <th scope="col" class="px-4 py-3 whitespace-nowrap">
                                            {!! __('client.category') !!}
                                        </th>
                                        <th scope="col" class="px-4 py-3 whitespace-nowrap text-right">
                                            {!! __('client.status') !!}
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody data-accordion="table-column">
                                    @foreach ($orders as $order)
                                        <tr class="cursor-pointer border-b transition hover:bg-gray-200 dark:border-gray-700 dark:hover:bg-gray-700"
                                            id="table-column-header-0"
                                            data-accordion-target="#table-column-body-{{ $order->id }}"
                                            aria-expanded="false" aria-controls="table-column-body-{{ $order->id }}">
                                            <td class="w-4 p-3">
                                                <svg data-accordion-icon="" class="h-6 w-6 shrink-0" fill="currentColor"
                                                     viewbox="0 0 20 20"
                                                     aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                          clip-rule="evenodd"/>
                                                </svg>
                                            </td>
                                            <th scope="row"
                                                class="flex items-center whitespace-nowrap px-4 py-3 font-medium text-gray-900 dark:text-white">
                                                <img class="mr-2 h-9 w-9 rounded"
                                                     src="{{ asset('storage/products/' . $order->package['icon']) }}"
                                                     alt="">
                                                <span class="flex flex-col">{{ $order->name }} <small
                                                        class="text-gray-500 dark:text-gray-400">
                                                            @isset($order->domain)
                                                            {{ $order->domain }}
                                                        @endisset
                                                        </small></span>
                                            </th>
                                            <td class="px-4 py-3">
                                                <div class="flex -space-x-4 rtl:space-x-reverse">
                                                    @if ($order->user->avatar)
                                                        <img
                                                            class="h-10 w-10 rounded-full border-2 border-white dark:border-gray-800"
                                                            src="{{ $order->user->avatar() }}" alt="">
                                                    @else
                                                        <div
                                                            class="relative mt-0.5 inline-flex h-9 w-9 items-center justify-center overflow-hidden rounded-full border border-gray-500 bg-gray-100 dark:bg-gray-600">
                                                                <span
                                                                    class="font-medium text-gray-600 dark:text-gray-300">{{ substr($order->user->username, 0, 2) }}</span>
                                                        </div>
                                                    @endif
                                                    @foreach ($order->members()->paginate(2) as $member)
                                                        @if ($member->user->avatar ?? false)
                                                            <img
                                                                class="@if ($loop->last) z-10 @endif h-10 w-10 rounded-full border-2 border-white dark:border-gray-800"
                                                                src="{{ $member->user->avatar() }}" alt="">
                                                        @else
                                                            <div
                                                                class="relative mt-0.5 inline-flex h-9 w-9 items-center justify-center overflow-hidden rounded-full border border-gray-500 bg-gray-100 dark:bg-gray-600">
                                                                    <span
                                                                        class="font-medium text-gray-600 dark:text-gray-300">{{ substr($member->email, 0, 2) }}</span>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                    @if ($order->members()->count() > 2)
                                                        <a class="z-30 flex h-10 w-10 items-center justify-center rounded-full border-2 border-white bg-gray-700 text-xs font-medium text-white hover:bg-gray-600 dark:border-gray-800"
                                                           href="{{ route('service', ['order' => $member->order->id, 'page' => 'members']) }}">+{{ $order->members()->count() - 2 }}</a>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-4 py-3">
                                                @if ($order->isRecurring())
                                                    {{ $order->due_date->translatedFormat(settings('date_format', 'd M Y')) }}
                                                @else
                                                    {{ __('client.never') }}
                                                @endif
                                            </td>
                                            <td class="whitespace-nowrap px-4 py-3 font-medium text-gray-900 dark:text-white">
                                                {{ $order->package['category']['name'] }}</td>
                                            <td class="whitespace-nowrap px-4 py-3 text-right">
                                                    <span
                                                        class="@if ($order->status == 'active') bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300
                                                        @elseif($order->status == 'suspended')
                                                        bg-yellow-100 text-yellow-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300
                                                        @elseif($order->status == 'cancelled') bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300
                                                        @elseif($order->status == 'terminated') bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300 @endif">
                                                        {!! __('client.' . $order->status) !!}
                                                    </span>
                                            </td>
                                        </tr>
                                        <tr class="hidden w-full flex-1 overflow-x-auto"
                                            id="table-column-body-{{ $order->id }}"
                                            aria-labelledby="table-column-header-0">
                                            <td class="border-b p-4 dark:border-gray-700" colspan="9">
                                                <div>
                                                    @include(Theme::path('components.orders.alerts'), $order)

                                                    <h6 class="mb-2 text-base font-medium leading-none text-gray-900 dark:text-white">
                                                        {!! __('client.details') !!}
                                                    </h6>
                                                </div>
                                                <div class="mt-4 grid grid-cols-3 gap-4">
                                                    <div
                                                        class="relative flex flex-col items-start justify-between rounded-lg bg-gray-100 p-3 dark:bg-gray-700">
                                                        <h6 class="mb-2 text-base font-medium leading-none text-gray-900 dark:text-white">
                                                            {!! __('client.package') !!}
                                                        </h6>
                                                        <div class="flex items-center text-gray-500 dark:text-gray-400">
                                                            {{ $order->package['name'] }}</div>
                                                    </div>
                                                    <div
                                                        class="relative flex flex-col justify-between rounded-lg bg-gray-100 p-3 dark:bg-gray-700">
                                                        <h6 class="mb-2 text-base font-medium leading-none text-gray-900 dark:text-white">
                                                            {!! __('client.billing_cycle') !!}
                                                        </h6>
                                                        <div class="flex items-center text-gray-500 dark:text-gray-400">
                                                                <span class="text-dark mr-1 font-bold dark:text-gray-200">
                                                                    {{ price($order->price['renewal_price']) }}</span> / {{ $order->periodToHuman() }}
                                                        </div>
                                                    </div>
                                                    <div class="relative rounded-lg bg-gray-100 p-3 dark:bg-gray-700">
                                                        <h6 class="mb-2 text-base font-medium leading-none text-gray-900 dark:text-white">
                                                            {!! __('client.status') !!}
                                                        </h6>
                                                        <span
                                                            class="@if ($order->status == 'active') bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300
                                                                @elseif($order->status == 'suspended') bg-yellow-100 text-yellow-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300
                                                                @elseif($order->status == 'cancelled') bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300
                                                                @elseif($order->status == 'terminated') bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300 @endif">
                                                                {!! __('client.' . $order->status) !!}
                                                            </span>
                                                    </div>
                                                    @if ($order->isRecurring())
                                                        <div
                                                            class="relative rounded-lg bg-gray-100 p-3 dark:bg-gray-700">
                                                            <h6 class="mb-2 text-base font-medium leading-none text-gray-900 dark:text-white">
                                                                {!! __('client.due_date') !!}
                                                            </h6>
                                                            <div
                                                                class="flex items-center text-gray-500 dark:text-gray-400">
                                                                {{ $order->due_date->translatedFormat('d M Y') }}
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="relative rounded-lg bg-gray-100 p-3 dark:bg-gray-700">
                                                            <h6 class="mb-2 text-base font-medium leading-none text-gray-900 dark:text-white">
                                                                {!! __('client.last_renewal_date') !!}
                                                            </h6>
                                                            <div
                                                                class="flex items-center text-gray-500 dark:text-gray-400">
                                                                {{ $order->last_renewed_at->translatedFormat('d M Y') }}
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="relative rounded-lg bg-gray-100 p-3 dark:bg-gray-700">
                                                            <h6 class="mb-2 text-base font-medium leading-none text-gray-900 dark:text-white">
                                                                {!! __('client.next_invoice') !!}
                                                            </h6>
                                                            <div
                                                                class="flex items-center text-gray-500 dark:text-gray-400">
                                                                {{ $order->due_date->translatedFormat('d M Y') }}
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="mt-4 flex items-center space-x-3">
                                                    <x-orders.buttons :order="$order"/>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                    @foreach (auth()->user()->suborders()->where('status', 'active')->get() as $member)
                                        @php
                                            $order = $member->order;
                                        @endphp
                                        <tr class="cursor-pointer border-b transition hover:bg-gray-200 dark:border-gray-700 dark:hover:bg-gray-700"
                                            id="table-column-header-0"
                                            data-accordion-target="#table-column-body-{{ $order->id }}"
                                            aria-expanded="false" aria-controls="table-column-body-{{ $order->id }}">
                                            <td class="w-4 p-3">
                                                <svg data-accordion-icon="" class="h-6 w-6 shrink-0" fill="currentColor"
                                                     viewbox="0 0 20 20"
                                                     aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                          clip-rule="evenodd"/>
                                                </svg>
                                            </td>

                                            <th scope="row"
                                                class="flex items-center whitespace-nowrap px-4 py-3 font-medium text-gray-900 dark:text-white">
                                                <img class="mr-2 h-9 w-9 rounded"
                                                     src="{{ asset('storage/products/' . $order->package['icon']) }}"
                                                     alt="">
                                                <span class="flex flex-col">{{ $order->name }} <small
                                                        class="text-gray-500 dark:text-gray-400">
                                                        @isset($order->domain)
                                                            {{ $order->domain }}
                                                        @endisset
                                                    </small></span>
                                            </th>
                                            <td class="px-4 py-3">
                                                <div class="flex -space-x-4 rtl:space-x-reverse">
                                                    @if ($order->user->avatar)
                                                        <img
                                                            class="h-10 w-10 rounded-full border-2 border-white dark:border-gray-800"
                                                            src="{{ $order->user->avatar() }}" alt="">
                                                    @else
                                                        <div
                                                            class="relative mt-0.5 inline-flex h-9 w-9 items-center justify-center overflow-hidden rounded-full border border-gray-500 bg-gray-100 dark:bg-gray-600">
                                                            <span
                                                                class="font-medium text-gray-600 dark:text-gray-300">{{ substr($order->user->username, 0, 2) }}</span>
                                                        </div>
                                                    @endif
                                                    @foreach ($order->members()->paginate(2) as $member)
                                                        @if ($member->user->avatar ?? false)
                                                            <img
                                                                class="@if ($loop->last) z-10 @endif h-10 w-10 rounded-full border-2 border-white dark:border-gray-800"
                                                                src="{{ $member->user->avatar() }}" alt="">
                                                        @else
                                                            <div
                                                                class="relative mt-0.5 inline-flex h-9 w-9 items-center justify-center overflow-hidden rounded-full border border-gray-500 bg-gray-100 dark:bg-gray-600">
                                                                <span
                                                                    class="font-medium text-gray-600 dark:text-gray-300">{{ substr($member->email, 0, 2) }}</span>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                    @if ($order->members()->count() > 2)
                                                        <a class="z-30 flex h-10 w-10 items-center justify-center rounded-full border-2 border-white bg-gray-700 text-xs font-medium text-white hover:bg-gray-600 dark:border-gray-800"
                                                           href="{{ route('service', ['order' => $member->order->id, 'page' => 'members']) }}">+{{ $order->members()->count() - 2 }}</a>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-4 py-3">
                                                @if ($order->isRecurring())
                                                    {{ $order->due_date->translatedFormat(settings('date_format', 'd M Y')) }}
                                                @else
                                                    {{ __('client.never') }}
                                                @endif
                                            </td>
                                            <td class="whitespace-nowrap px-4 py-3 font-medium text-gray-900 dark:text-white">
                                                {{ $order->package['category']['name'] }}</td>
                                            <td class="whitespace-nowrap px-4 py-3 text-right">
                                                <span
                                                    class="@if ($order->status == 'active') bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300
                                                    @elseif($order->status == 'suspended')
                                                    bg-yellow-100 text-yellow-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300
                                                    @elseif($order->status == 'cancelled') bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300
                                                    @elseif($order->status == 'terminated') bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300 @endif">
                                                    {!! __('client.' . $order->status) !!}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr class="hidden w-full flex-1 overflow-x-auto"
                                            id="table-column-body-{{ $order->id }}"
                                            aria-labelledby="table-column-header-0">
                                            <td class="border-b p-4 dark:border-gray-700" colspan="9">
                                                <div>
                                                    @include(Theme::path('components.orders.alerts'), $order)

                                                    <h6 class="mb-2 text-base font-medium leading-none text-gray-900 dark:text-white">
                                                        {!! __('client.details') !!}
                                                    </h6>
                                                </div>
                                                <div class="mt-4 grid grid-cols-3 gap-4">
                                                    <div
                                                        class="relative flex flex-col items-start justify-between rounded-lg bg-gray-100 p-3 dark:bg-gray-700">
                                                        <h6 class="mb-2 text-base font-medium leading-none text-gray-900 dark:text-white">
                                                            {!! __('client.package') !!}
                                                        </h6>
                                                        <div class="flex items-center text-gray-500 dark:text-gray-400">
                                                            {{ $order->package['name'] }}
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="relative flex flex-col justify-between rounded-lg bg-gray-100 p-3 dark:bg-gray-700">
                                                        <h6 class="mb-2 text-base font-medium leading-none text-gray-900 dark:text-white">
                                                            {!! __('client.billing_cycle') !!}
                                                        </h6>
                                                        <div class="flex items-center text-gray-500 dark:text-gray-400">
                                                            <span class="text-dark mr-1 font-bold dark:text-gray-200">
                                                                {{ price($order->price['renewal_price']) }}
                                                            </span>
                                                            / {{ $order->periodToHuman() }}
                                                        </div>
                                                    </div>

                                                    <div class="relative rounded-lg bg-gray-100 p-3 dark:bg-gray-700">
                                                        <h6 class="mb-2 text-base font-medium leading-none text-gray-900 dark:text-white">
                                                            {!! __('client.status') !!}
                                                        </h6>
                                                        <span
                                                            class="@if ($order->status == 'active') bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300
                                                            @elseif($order->status == 'suspended') bg-yellow-100 text-yellow-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300
                                                            @elseif($order->status == 'cancelled') bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300
                                                            @elseif($order->status == 'terminated') bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300 @endif">
                                                            {!! __('client.' . $order->status) !!}
                                                        </span>
                                                    </div>
                                                    @if ($order->isRecurring())
                                                        <div
                                                            class="relative rounded-lg bg-gray-100 p-3 dark:bg-gray-700">
                                                            <h6 class="mb-2 text-base font-medium leading-none text-gray-900 dark:text-white">
                                                                {!! __('client.due_date') !!}
                                                            </h6>
                                                            <div
                                                                class="flex items-center text-gray-500 dark:text-gray-400">
                                                                {{ $order->due_date->translatedFormat('d M Y') }}</div>
                                                        </div>
                                                        <div
                                                            class="relative rounded-lg bg-gray-100 p-3 dark:bg-gray-700">
                                                            <h6 class="mb-2 text-base font-medium leading-none text-gray-900 dark:text-white">
                                                                {!! __('client.last_renewal_date') !!}
                                                            </h6>
                                                            <div
                                                                class="flex items-center text-gray-500 dark:text-gray-400">
                                                                {{ $order->last_renewed_at->translatedFormat('d M Y') }}</div>
                                                        </div>
                                                        <div
                                                            class="relative rounded-lg bg-gray-100 p-3 dark:bg-gray-700">
                                                            <h6 class="mb-2 text-base font-medium leading-none text-gray-900 dark:text-white">
                                                                {!! __('client.next_invoice') !!}
                                                            </h6>
                                                            <div
                                                                class="flex items-center text-gray-500 dark:text-gray-400">
                                                                {{ $order->due_date->translatedFormat('d M Y') }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="mt-4 flex items-center space-x-3">
                                                    <x-orders.buttons :order="$order"/>
                                                </div>
                                            </td>
                                        </tr>
                                        @php
                                            unset($order);
                                        @endphp
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div
                                class="flex flex-col items-start justify-between space-y-3 px-4 pb-4 pt-3 md:flex-row md:items-center md:space-y-0"
                                aria-label="{{ __('client.table_navigation') }}">
                                {{ $orders->links(Theme::pagination()) }}
                            </div>
                        </div>
                        @if (count($orders) == 0)
                            <div class="mt-4">
                                @include(Theme::path('empty-state'), [
                                    'title' => __('client.no_orders_found'),
                                    'description' => __('client.no_orders_found_desc'),
                                ])
                            </div>
                        @endif
                    </div>
                </section>

                @foreach (enabledModules() as $module)
                    @if(settings("widget:dashboard:{$module->getLowerName()}", false))
                        @includeIf(Theme::moduleView($module->getLowerName(), 'widgets.dashboard-widget'))
                    @endif
                @endforeach
            </div>
    </div>
    @endsection
