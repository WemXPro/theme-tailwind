<div class="relative mt-8 rounded-lg bg-white p-4 shadow dark:bg-gray-800 sm:p-5">
    <div class="mb-3 flex justify-between rounded-t sm:mb-3">
        <div class="text-lg text-gray-900 dark:text-white md:text-xl">
            <h3 class="font-semibold">{!! __('client.payment_method') !!}</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                {!! __('client.payment_method_desc') !!}
            </p>
        </div>
        <div></div>
    </div>

    <!-- Coupon -->
    <div class="mb-6">
        <div class="relative flex">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                <i class='bx bxs-coupon text-gray-500 dark:text-gray-400'></i>
            </div>
            <input
                type="text"
                id="coupon"
                class="mr-4 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 pl-10
                       text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500
                       dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400
                       dark:focus:border-primary-500 dark:focus:ring-primary-500"
                placeholder="coupon"
                name="coupon"
                value="{{ session('coupon_code') }}"
            />
            <button
                type="button"
                onclick="applyCoupon()"
                class="mr-2 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm
                       font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700
                       focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-200
                       dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400
                       dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700"
            >
                {{ __('client.apply') }}
            </button>
        </div>
        <p id="coupon-description" class="mt-2 text-sm text-gray-500 dark:text-gray-400"></p>
    </div>

    <!-- Select payment gateway -->
    <select
        class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500
               dark:focus:border-primary-500 mb-6 block w-full rounded-lg border border-gray-300
               bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700
               dark:text-white dark:placeholder-gray-400"
        name="gateway"
        id="gateway"
        tabindex="-1"
        aria-hidden="true"
        required
    >
        @foreach (App\Models\Gateways\Gateway::getActive('subscription') as $gateway)
            <option
                @if ($gateway->default) selected @endif
            data-gateway-type="subscription"
                value="{{ $gateway->id }}"
            >
                {{ $gateway->name }} ({{ __('client.subscription') }})
            </option>
        @endforeach

        @foreach (App\Models\Gateways\Gateway::getActive() as $gateway)
            @auth
                @if ($gateway->driver == 'Balance')
                    <option
                        @if ($gateway->default) selected @endif
                    value="{{ $gateway->id }}"
                        data-gateway-type="once"
                    >
                        Pay with Balance ({{ price(Auth::user()->balance) }})
                    </option>
                    @continue
                @endif
            @endauth
            <option
                @if ($gateway->default) selected @endif
            value="{{ $gateway->id }}"
            >
                {{ $gateway->name }}
            </option>
        @endforeach
    </select>
</div>
