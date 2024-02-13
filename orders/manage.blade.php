@extends(Theme::path('orders.master'))

@section('title', __('client.services'))

@section('content')
    @includeIf(Theme::serviceView($order->service, 'stats'))

    <div id="service">
        <div class="mb-4 rounded-lg bg-gray-50 p-4 dark:bg-gray-800" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $order->package['name'] }}
            </h5>

            <div class="mt-4 grid grid-cols-3 gap-4">
                <div class="relative flex flex-col items-start justify-between rounded-lg bg-gray-100 p-3 dark:bg-gray-700">
                    <h6 class="mb-2 text-base font-medium leading-none text-gray-900 dark:text-white">{!! __('client.package') !!}</h6>
                    <div class="flex items-center text-gray-500 dark:text-gray-400">{{ $order->package['name'] }}</div>
                </div>
                <div class="relative flex flex-col justify-between rounded-lg bg-gray-100 p-3 dark:bg-gray-700">
                    <h6 class="mb-2 text-base font-medium leading-none text-gray-900 dark:text-white">{!! __('client.billing_cycle') !!}</h6>
                    <div class="flex items-center text-gray-500 dark:text-gray-400">
                        <span class="mr-1 font-bold text-gray-500 dark:text-white">
                            {{ currency('symbol') }}{{ number_format($order->price['renewal_price'], 2) }}
                        </span>
                        / {{ $order->period() }}
                    </div>
                </div>
                <div class="relative rounded-lg bg-gray-100 p-3 dark:bg-gray-700">
                    <h6 class="mb-2 text-base font-medium leading-none text-gray-900 dark:text-white">{!! __('client.status') !!}</h6>
                    <span
                        class="@if ($order->status == 'active') bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300 @elseif($order->status == 'suspended') bg-yellow-100 text-yellow-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300 @elseif($order->status == 'cancelled') bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300 @elseif($order->status == 'terminated') bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300 @endif">{!! __('admin.' . $order->status) !!}</span>
                </div>
                @if ($order->isRecurring())
                    <div class="relative rounded-lg bg-gray-100 p-3 dark:bg-gray-700">
                        <h6 class="mb-2 text-base font-medium leading-none text-gray-900 dark:text-white">{!! __('client.due_date') !!}</h6>
                        <div class="flex items-center text-gray-500 dark:text-gray-400">
                            {{ $order->due_date->translatedFormat('d M Y') }}
                        </div>
                    </div>
                    <div class="relative rounded-lg bg-gray-100 p-3 dark:bg-gray-700">
                        <h6 class="mb-2 text-base font-medium leading-none text-gray-900 dark:text-white">{!! __('client.last_renewal_date') !!}
                        </h6>
                        <div class="flex items-center text-gray-500 dark:text-gray-400">
                            {{ $order->last_renewed_at->translatedFormat('d M Y') }}
                        </div>
                    </div>
                    <div class="relative rounded-lg bg-gray-100 p-3 dark:bg-gray-700">
                        <h6 class="mb-2 text-base font-medium leading-none text-gray-900 dark:text-white">{!! __('client.next_invoice') !!}</h6>
                        <div class="flex items-center text-gray-500 dark:text-gray-400">
                            {{ $order->due_date->translatedFormat('d M Y') }}
                        </div>
                    </div>
                @endif
            </div>
            <div class="mt-4 flex items-center space-x-3">
                @include(Theme::path('components.orders.buttons'), $order)
            </div>
        </div>

        @if ($order->getService()->canChangePassword())
            <div class="mb-4 flex items-end justify-between rounded-lg bg-white p-6 shadow dark:bg-gray-800">
                <div>
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ __('client.service_account', ['service' => ucfirst($order->package->service)]) }}</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $order->getExternalUser()->username ?? '' }}</p>
                </div>
                <button type="button" data-drawer-target="drawer-change-password" data-drawer-show="drawer-change-password"
                    data-drawer-placement="right" aria-controls="drawer-change-password"
                    class="inline-flex items-center rounded-lg bg-blue-700 px-3 py-2 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    {{ __('client.change_password') }}
                    <svg class="ml-2 h-3.5 w-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </button>
            </div>

            <!-- Change Password -->
            <div id="drawer-change-password"
                class="fixed right-0 top-0 z-40 h-screen w-80 translate-x-full overflow-y-auto bg-white p-4 transition-transform dark:bg-gray-800"
                tabindex="-1" aria-labelledby="drawer-change-password-label">
                <h5 id="drawer-change-password-label"
                    class="mb-4 inline-flex items-center text-base font-semibold text-gray-500 dark:text-gray-400"><svg class="mr-2.5 h-4 w-4"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>{{ __('client.change_password') }}</h5>
                <button type="button" data-drawer-hide="drawer-change-password" aria-controls="drawer-change-password"
                    class="absolute right-2.5 top-2.5 inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">{{ __('client.close_menu') }}</span>
                </button>
                <p class="mb-6 text-sm text-gray-500 dark:text-gray-400">
                    {{ __('client.change_service_password', ['service' => $order->package->service]) }}</p>
                <form action="{{ route('service', ['order' => $order->id, 'page' => 'change-password']) }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label for="password"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">{{ __('auth.new_password') }}</label>
                        <input type="text" name="password" id="password"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                            placeholder="{{ __('auth.new_password') }}" required>
                    </div>

                    <div class="mb-6">
                        <label for="password_confirmation"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">{{ __('auth.confirm_new_password') }}</label>
                        <input type="text" name="password_confirmation" id="password_confirmation"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                            placeholder="{{ __('auth.confirm_new_password') }}" required>
                    </div>

                    <div class="">
                        <button type="submit" style="width: 100%"
                            class="items-center rounded-lg bg-blue-700 px-4 py-2 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            {{ __('client.change_password') }}
                        </button>
                    </div>
                </form>
            </div>
        @endif

        @includeIf(Theme::serviceView($order->service, 'service'))
    </div>
@endsection
