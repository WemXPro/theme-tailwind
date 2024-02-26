@extends(Theme::wrapper())

@section('title', $package->name)

@section('container')
    @if (Cookie::get('affiliate'))
        <div class="mb-4 flex items-center rounded-lg border border-blue-300 bg-blue-50 p-4 text-sm text-blue-800 dark:border-blue-800 dark:bg-gray-800 dark:text-blue-400"
            role="alert">
            <svg class="mr-3 inline h-4 w-4 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">{{ __('client.info') }}</span>
            <div>
                {!! __('client.affiliate_discount_info', ['percent' => Affiliate::calculateDiscountPercentage(Cookie::get('affiliate'))]) !!}
            </div>
        </div>
    @endif

    <form action="{{ route('payment.package', ['package' => $package->id]) }}" method="POST" id="price">
        @csrf
        <div class="flex flex-wrap">
            <div class="w-full pl-4 pl-4 pl-4 pr-4 pr-4 pr-4 sm:w-1/2 md:w-2/3 lg:w-2/3">
                <div class="relative rounded-lg bg-white p-4 shadow dark:bg-gray-800 sm:p-5">
                    <!-- Modal header -->
                    <div class="mb-4 flex justify-between rounded-t sm:mb-4">
                        <div class="text-lg text-gray-900 dark:text-white md:text-xl">
                            <h3 class="font-semibold">
                                {{ $package->category->name }} {{ $package->name }}
                            </h3>
                            <p class="text-small text-base text-gray-500 dark:text-gray-400">
                                {!! $package->description !!}
                            </p>
                        </div>
                        <div>
                        </div>
                    </div>

                    <!-- List -->
                    <ul role="list" class="mb-8 space-y-4 text-left">
                        <div class="grid grid-cols-3 gap-4">
                            @foreach ($package->features()->orderBy('order', 'desc')->get() as $feature)
                                <li class="flex items-center space-x-3">
                                    <!-- Icon -->
                                    <span class="text-{{ $feature->color }}-500 dark:text-{{ $feature->color }}-500 bx-sm">
                                        {!! $feature->icon !!}
                                    </span>
                                    <span class="text-gray-500 dark:text-gray-400">{{ $feature->description }}</span>
                                </li>
                            @endforeach
                        </div>
                    </ul>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3 sm:space-x-4">
                        </div>
                    </div>
                </div>

                <ul class="mb-5 mt-8 grid w-full gap-6 md:grid-cols-3">
                    @foreach ($package->prices->where('is_active', true) as $price)
                        <li>
                            <input type="radio" id="price-radio-{{ $price->id }}" name="price_id" value="{{ $price->id }}"
                                class="peer hidden" required @if ($price->id == request()->input('price', $package->prices->first()->id)) checked @endif>
                            <label for="price-radio-{{ $price->id }}"
                                class="dark:peer-checked:text-primary-500 peer-checked:border-primary-600 peer-checked:text-primary-600 inline-flex w-full cursor-pointer items-center justify-between rounded-lg border border-gray-200 bg-white p-5 text-gray-500 hover:bg-gray-100 hover:text-gray-600 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300">
                                <div class="block">
                                    <div class="w-full text-lg font-semibold">
                                        {{ currency('symbol') }}{{ number_format($price->renewal_price, 2) }}
                                        /
                                        {{ $price->periodToHuman() }}</div>
                                    <div class="w-full">{!! $price->type == 'recurring'
                                        ? __('client.price_block_desc', [
                                            'period' => mb_strtolower($price->period()),
                                            'total_price' => $price->totalPrice(),
                                            'renewal_price' => $price->renewal_price,
                                            'per_period' => mb_strtolower($price->period()),
                                            'symbol' => currency('symbol'),
                                        ])
                                        : __('client.price_onetime_block_desc', ['symbol' => currency('symbol'), 'price' => number_format($price->price, 2)]) !!}
                                        @isset($price->data['badge'])
                                            <span
                                                class="bg-primary-100 text-primary-800 dark:bg-primary-900 dark:text-primary-300 inline-block rounded px-2.5 py-0.5 text-xs font-medium">{{ $price->data['badge'] }}</span>
                                        @endisset
                                    </div>
                                </div>
                            </label>
                        </li>
                    @endforeach
                </ul>

                @if ($package->require_domain)
                    <div class="relative mb-6 mt-8 rounded-lg bg-white p-4 shadow dark:bg-gray-800 sm:p-5">
                        <div class="custom-note">
                            <div class="mb-3 flex justify-between rounded-t sm:mb-3">
                                <div class="text-lg text-gray-900 dark:text-white md:text-xl">
                                    <h3 class="font-semibold">{!! __('client.enter_domain') !!}</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {!! __('client.enter_domain_desc') !!}
                                    </p>
                                </div>
                            </div>
                            <label for="helper-text"
                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">{!! __('client.domain') !!}</label>
                            <input type="text" id="helper-text" name="domain" value="{{ old('domain') }}"
                                aria-describedby="helper-text-explanation"
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                placeholder="i.e example.com">
                            <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                {!! __('client.enter_domain_helper') !!}
                            </p>
                        </div>
                    </div>
                @endif

                @if ($package->service()->hasCheckoutConfig($package))
                    <div class="relative mb-6 mt-8 rounded-lg bg-white p-4 shadow dark:bg-gray-800 sm:p-5">
                        <div class="custom-note">
                            <div class="mb-3 flex justify-between rounded-t sm:mb-3">
                                <div class="text-lg text-gray-900 dark:text-white md:text-xl">
                                    <h3 class="font-semibold">{!! __('client.custom_options') !!}</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {!! __('client.custom_options_desc') !!}
                                    </p>
                                </div>
                                <div></div>
                            </div>
                            <div class="flex flex-wrap">
                                @foreach ($package->service()->getCheckoutConfig($package)->all() ?? [] as $name => $field)
                                    <div class="@isset($field['col']) {{ $field['col'] }} @else w-1/2 p-2 @endisset"
                                        style="display: flex;flex-direction: column;">
                                        <label class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                            {!! $field['name'] !!} {!! isset($field['required']) && $field['required'] ? '<span class="text-red-500">*</span>' : '' !!}
                                        </label>
                                        @if ($field['type'] == 'select')
                                            <select
                                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                                tabindex="-1" aria-hidden="true" name="{{ $field['key'] }}" id="{{ $field['key'] }}"
                                                @if (isset($field['disabled']) and $field['disabled']) disabled @endif
                                                @if (isset($field['multiple']) and $field['multiple']) multiple @endif>
                                                @foreach ($field['options'] ?? [] as $key => $option)
                                                    <option value="{{ $key }}" @if (is_array($option) and isset($option['disabled']) and $option['disabled']) disabled @endif
                                                        @if (in_array($key, (array) getValueByKey($field['key'], $package->data, $field['default_value'] ?? ''))) selected @endif>
                                                        {{ is_string($option) ? $option : $option['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @elseif($field['type'] == 'bool')
                                            <label class="relative mt-2 inline-flex cursor-pointer items-center">
                                                @if ($field['required'])
                                                    <input type="hidden" name="{{ $field['key'] }}" value="0">
                                                @endif
                                                <input type="checkbox" name="{{ $field['key'] }}" value="1" class="peer sr-only"
                                                    @if (getValueByKey($field['key'], $package->data, $field['default_value'] ?? '0')) checked @endif
                                                    @if (isset($field['disabled']) and $field['disabled']) disabled @endif>
                                                <div
                                                    class="peer h-6 w-11 rounded-full bg-gray-200 after:absolute after:left-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-blue-600 peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:border-gray-600 dark:bg-gray-700 dark:peer-focus:ring-blue-800">
                                                </div>
                                                <span
                                                    class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">{!! $field['name'] !!}</span>
                                            </label>
                                        @else
                                            <input
                                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                                type="{{ $field['type'] }}" name="{{ $field['key'] }}" id="{{ $field['key'] }}"
                                                @isset($field['min']) min="{{ $field['min'] }}" @endisset
                                                @isset($field['max']) max="{{ $field['max'] }}" @endisset
                                                value="{{ getValueByKey($field['key'], $package->data, $field['default_value'] ?? '') }}"
                                                placeholder="@isset($field['placeholder']){{ $field['placeholder'] }} @else{{ $field['name'] }} @endisset"
                                                @if (in_array('required', $field['rules'])) required="" @endif
                                                @if (isset($field['disabled']) and $field['disabled']) disabled @endif>
                                        @endif
                                        <small class="text-muted mt-2 text-sm text-gray-500 dark:text-gray-400">
                                            {!! $field['description'] !!}
                                        </small>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @else
                    @includeIf(Theme::serviceView($package->service, 'props.checkout-options'))
                @endif

                <div class="relative mt-8 rounded-lg bg-white p-4 shadow dark:bg-gray-800 sm:p-5">
                    <div class="mb-3 flex justify-between rounded-t sm:mb-3">
                        <div class="text-lg text-gray-900 dark:text-white md:text-xl">
                            <h3 class="font-semibold">{!! __('client.payment_method') !!}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{!! __('client.payment_method_desc') !!}</p>
                        </div>
                        <div></div>
                    </div>

                    <div class="mb-6">
                        <div class="relative flex">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <i class='bx bxs-coupon text-gray-500 dark:text-gray-400'></i>
                            </div>
                            <input type="text" id="coupon"
                                class="mr-4 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 pl-10 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                placeholder="coupon" name="coupon" value="{{ session('coupon_code') }}" />
                            <button type="button" onclick="applyCoupon()"
                                class="mr-2 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">{{ __('client.apply') }}</button>

                        </div>
                        <p id="coupon-description" class="mt-2 text-sm text-gray-500 dark:text-gray-400"></p>
                    </div>

                    <select
                        class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 mb-6 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                        name="gateway" id="gateway" tabindex="-1" aria-hidden="true" required>

                        @foreach (App\Models\Gateways\Gateway::getActive('subscription') as $gateway)
                            <option @if ($gateway->default) selected @endif data-gateway-type="subscription"
                                value="{{ $gateway->id }}">{{ $gateway->name }}
                                ({!! __('client.subscription') !!})
                            </option>
                        @endforeach

                        @foreach (App\Models\Gateways\Gateway::getActive() as $gateway)
                            @auth
                                @if ($gateway->driver == 'Balance')
                                    <option @if ($gateway->default) selected @endif value="{{ $gateway->id }}"
                                        data-gateway-type="once" @if (Auth::user()->balance >= $package->prices->first()->totalPrice())  @endif>
                                        Pay with Balance ({{ currency('symbol') }}{{ number_format(Auth::user()->balance, 2) }})
                                    </option>
                                    @continue
                                @endif
                            @endauth
                            <option @if ($gateway->default) selected @endif value="{{ $gateway->id }}">{{ $gateway->name }}
                            </option>
                        @endforeach

                    </select>
                </div>

                @if (settings('taxes'))
                    <div class="relative mt-8 rounded-lg bg-white p-4 shadow dark:bg-gray-800 sm:p-5" id="tax-card">
                        <div class="mb-3 flex justify-between rounded-t sm:mb-3">
                            <div class="text-lg text-gray-900 dark:text-white md:text-xl">
                                <h3 class="font-semibold">{!! __('client.personal_details') !!}</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{!! __('client.personal_details_desc') !!}</p>
                            </div>
                            <div></div>
                        </div>

                        <div class="mb-6">
                            <div class="relative flex">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <i class='bx bxs-building-house text-gray-500 dark:text-gray-400'></i>
                                </div>
                                <input type="text" id="zip_code" required
                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 pl-10 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                    placeholder="Zip/Post Code" name="zip_code"
                                    value="{{ session('zip_code', auth()->user()->address->zip_code ?? null) }}" />
                            </div>
                            <p id="coupon-description" class="mt-2 text-sm text-gray-500 dark:text-gray-400"></p>
                        </div>

                        <select
                            class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 mb-6 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                            name="country" id="country" tabindex="-1" aria-hidden="true" required>
                            @foreach (config('utils.countries') as $key => $country)
                                <option value="{{ $key }}" @if (request()->header('cf-ipcountry', auth()->user()->address->country ?? null) == $key) selected @endif>{{ $country }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                @if ($package->allow_notes)
                    <div class="relative mb-6 mt-8 rounded-lg bg-white p-4 shadow dark:bg-gray-800 sm:p-5">
                        <div class="custom-note">
                            <div class="mb-3 flex justify-between rounded-t sm:mb-3">
                                <div class="text-lg text-gray-900 dark:text-white md:text-xl">
                                    <h3 class="font-semibold">{!! __('client.custom_notes') !!}</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {!! __('client.custom_notes_desc') !!}
                                    </p>
                                </div>
                                <div></div>
                            </div>
                            <textarea id="message" name="notes" rows="4"
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                placeholder="{!! __('client.custom_notes_placeholder') !!}"></textarea>
                        </div>
                    </div>
                @endif

            </div>

            <div class="w-full pl-4 pl-4 pl-4 pr-4 pr-4 pr-4 sm:w-1/2 md:w-1/3 lg:w-1/3">
                <div class="sticky left-0 top-8 max-w-sm rounded-lg border-gray-200 bg-white p-6 shadow dark:bg-gray-800">
                    <a href="#">
                        <h5 class="mb-2 mb-4 text-2xl font-bold tracking-tight text-gray-900 dark:text-gray-200">
                            {!! __('client.order_summary') !!}
                        </h5>
                    </a>

                    <p class="mb-1 flex justify-between text-sm font-normal text-gray-700 dark:text-gray-400">{!! __('client.recurring') !!}</p>

                    <p class="mb-4 flex justify-between text-sm font-normal text-gray-700 dark:text-gray-400"><span
                            id="period">{{ $package->prices->first()->periodToHuman() }}</span>
                        <span>{{ currency('symbol') }}<span
                                id="recurring">{{ number_format($package->prices->first()->renewal_price, 2) }}</span></span>
                    </p>

                    <hr class="my-4 h-px border-0 bg-gray-200 dark:bg-gray-700">
                    <p class="mb-4 flex justify-between text-sm font-normal text-gray-700 dark:text-gray-400">
                        <span>{!! __('client.setup_fee') !!}</span> <span>{{ currency('symbol') }}<span
                                id="setup_fee">{{ number_format($package->prices->first()->setup_fee, 2) }}</span></span>
                    </p>

                    <hr class="my-4 h-px border-0 bg-gray-200 dark:bg-gray-700">
                    <p class="mb-4 flex justify-between text-sm font-normal text-gray-700 dark:text-gray-400">
                        <span>{{ __('client.discount') }}</span> <span>-{{ currency('symbol') }}<span id="discounted">0.00</span></span>
                    </p>

                    <div class="@if (!settings('taxes')) hidden @endif" id="tax-div">
                        <hr class="my-4 h-px border-0 bg-gray-200 dark:bg-gray-700">
                        <p class="mb-4 flex justify-between text-sm font-normal text-gray-700 dark:text-gray-400">
                            <span>{!! __('client.vat') !!} @if (settings('tax_add_to_price'))
                                    {!! __('client.incl') !!}
                                @else
                                    {!! __('client.excl') !!}
                                @endif
                            </span> <span>{{ currency('symbol') }}<span id="taxes">0.00</span></span>
                        </p>
                    </div>

                    <hr class="my-4 h-px border-0 bg-gray-200 dark:bg-gray-700">

                    <p class="mb-2 flex justify-between text-sm font-normal text-gray-700 dark:text-gray-400">
                        <span>{!! __('client.due_today') !!}</span>
                    </p>

                    <h5 class="mb-2 mb-6 text-4xl font-bold tracking-tight text-gray-900 dark:text-white">
                        {{ currency('symbol') }}<span id="total_price"></span>
                    </h5>

                    @if ($page = Page::wherePath('terms-and-conditions')->first())
                        <div class="mb-4 flex items-start">
                            <div class="flex h-5 items-center">
                                <input required="" id="terms" aria-describedby="terms" type="checkbox"
                                    class="focus:ring-3 h-4 w-4 rounded border-gray-300 bg-gray-50 focus:ring-blue-300 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600" />
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="terms" class="font-medium text-gray-900 dark:text-white">{!! __('client.i_accept_the') !!}<a
                                        class="ml-1 text-blue-700 hover:underline dark:text-blue-500" href="{{ route('page', $page->path) }}"
                                        target="_blank">{!! __('client.terms_and_conditions') !!}</a></label>
                            </div>
                        </div>
                    @endif

                    <button type="submit" id="checkout"
                        class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 min-w-full rounded-lg px-6 py-3.5 text-center text-base font-medium text-white focus:outline-none focus:ring-4">
                        {!! __('client.complete_checkout') !!}
                    </button>

                </div>
                <p class="mt-3 text-sm text-gray-500 dark:text-gray-400" id="disclosure">
                    @if ($package->prices->first()->cancellation_fee > 0)
                        {!! __('client.selected_price_includes_cancellation_fee') !!}
                        {{ currency('symbol') }}{{ number_format($package->prices->first()->cancellation_fee, 2) }}
                    @endif
                </p>
            </div>
        </div>
    </form>

    <script>
        const prices = {!! json_encode($package->prices->toArray()) !!};
        const form = document.getElementById('price');

        function activePrice() {
            var selectedPrice = null;

            for (var i = 0; i < form.length; i++) {
                if (form[i].checked) {
                    prices.forEach(price => {
                        if (form[i].value == price.id) {
                            selectedPrice = price;
                            return; // Exit the forEach loop early once a match is found
                        }
                    });
                    break;
                }
            }

            return selectedPrice;
        }

        updateCheckoutPrice();
        @if (session('coupon_code'))
            applyCoupon();
        @endif

        form.addEventListener('change', function(event) {
            event.preventDefault(); // Prevents the default form submission behavior

            updateCheckoutPrice();

        });

        function updateCheckoutPrice() {
            var price = activePrice();

            if (price.type == 'single') {
                hideSubscriptionGateways();
            } else {
                showSubscriptionGateways();
            }

            document.getElementById('recurring').innerHTML = price.renewal_price.toFixed(2);
            document.getElementById('period').innerHTML = periodToHuman(price);

            document.getElementById('setup_fee').innerHTML = price.setup_fee.toFixed(2);
            document.getElementById('discounted').innerHTML = getTotalDiscount((price.price + price.setup_fee));

            document.getElementById('taxes').innerHTML = calculateTax((price.price + price.setup_fee) - getTotalDiscount((price.price + price
                .setup_fee))).toFixed(2);

            document.getElementById('total_price').innerHTML = Math.max(0, getTotalPrice(price)).toFixed(2);

            if (price.cancellation_fee > 0) {
                document.getElementById('disclosure').innerHTML = '*Selected price cycle includes a cancellation fee of $' + price
                    .cancellation_fee.toFixed(2);
            } else {
                document.getElementById('disclosure').innerHTML = '';
            }
        }

        function getTotalPrice(price) {
            totalPrice = (price.price + price.setup_fee);

            // apply discount
            totalPrice = totalPrice - getTotalDiscount(totalPrice);

            // price excluded from tax
            @if (settings('tax_add_to_price'))
                totalPrice = totalPrice + calculateTax(totalPrice);
            @endif

            return totalPrice.toFixed(2);
        }

        function getTotalDiscount(totalPrice) {

            let totalDiscount = 0;
            // check for affiliate discount using php
            @if (Cookie::get('affiliate'))
                let factor = {{ Affiliate::calculateDiscountFactor(Cookie::get('affiliate')) }};
                totalDiscount += totalPrice * factor;
            @endif

            if (typeof coupon_data !== "undefined") {
                if (coupon_data.discount_type == 'percentage') {
                    totalDiscount += totalPrice * (coupon_data.discount_amount / 100);
                } else {
                    totalDiscount += coupon_data.discount_amount;
                }
            }

            return totalDiscount.toFixed(2);
        }

        function calculateTax(totalPrice) {
            @if (!settings('taxes'))
                return 0;
            @endif

            gateway = document.getElementById('gateway').value;
            let disabledGateways = @settings('tax_disabled_gateways', '[]');

            if (disabledGateways.includes(gateway)) {
                document.getElementById("tax-card").style.display = 'none';
                document.getElementById("taxes").innerHTML = '0.00 (Calculated next step)';
                return 0;
            } else {
                document.getElementById("tax-card").style.display = '';
            }

            totalTax = 0;
            country = document.getElementById('country').value;
            let rates = @json(config('tax.rates'));
            if (country in rates) {
                rate = rates[country].standard_rate / 100;
                @if (settings('tax_add_to_price'))
                    totalTax = totalPrice * rate;
                @else
                    totalTax = totalPrice - (totalPrice / (1 + rate));
                @endif
            }

            return parseFloat(totalTax.toFixed(2));
        }

        function applyCoupon() {
            coupon = document.getElementById('coupon').value;

            if (coupon == '') {
                alertCoupon('Please enter a coupon to apply it');
                return;
            }

            fetch('/store/validate-coupon/{{ $package->id }}/' + coupon, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                    }
                }).then(response => response.json())
                .then(coupon => {
                    if (!coupon.success) {
                        alertCoupon(coupon.description);
                        return;
                    }

                    coupon_data = coupon;
                    alertCoupon(coupon.description);
                    updateCheckoutPrice();
                })
                .catch(error => {
                    alertCoupon('Something went wrong, please refresh and try again.');
                    return;
                });

            updateCheckoutPrice();
        }

        function hideSubscriptionGateways() {
            // Get all select elements on the page
            var options = document.querySelectorAll('option');

            // Loop through the NodeList of select elements
            options.forEach(function(option) {
                // Check if the data-x attribute's value matches the given value
                if (option.getAttribute('data-gateway-type') == 'subscription') {
                    // Remove the select element from the document
                    // option.style.display = 'none'
                    option.setAttribute('disabled', '');
                }
            });
        }

        function showSubscriptionGateways() {
            // Get all select elements on the page
            var options = document.querySelectorAll('option');

            // Loop through the NodeList of select elements
            options.forEach(function(option) {
                // Check if the data-x attribute's value matches the given value
                if (option.getAttribute('data-gateway-type') == 'subscription') {
                    // Remove the select element from the document
                    option.removeAttribute('disabled', '');
                }
            });
        }

        function alertCoupon(desc) {
            document.getElementById('coupon-description').innerHTML = desc;
        }

        function period(price) {
            if (price.type == 'single') {
                return '{!! __('admin.once') !!}';
            }

            if (price.period == 1) {
                return '{!! __('admin.day') !!}';
            } else if (price.period == 7) {
                return '{!! __('admin.week') !!}';
            } else if (price.period == 30) {
                return '{!! __('admin.month') !!}';
            } else if (price.period == 90) {
                return '{!! __('admin.quarter') !!}';
            } else if (price.period == 365) {
                return '{!! __('admin.year') !!}';
            } else if (price.period == 730) {
                return '{!! __('admin.per_years', ['years' => 2]) !!}';
            } else if (price.period == 1825) {
                return '{!! __('admin.per_years', ['years' => 5]) !!}';
            } else if (price.period == 3650) {
                return '{!! __('admin.per_years', ['years' => 10]) !!}';
            } else {
                return '{!! __('admin.day') !!}';
            }
        }

        function periodToHuman(price) {
            if (price.type == 'single') {
                return '{!! __('admin.once') !!}';
            }

            if (price.period == 1) {
                return '{!! __('admin.daily') !!}';
            } else if (price.period == 7) {
                return '{!! __('admin.weekly') !!}';
            } else if (price.period == 30) {
                return '{!! __('admin.monthly') !!}';
            } else if (price.period == 90) {
                return '{!! __('admin.quaterly') !!}';
            } else if (price.period == 365) {
                return '{!! __('admin.yearly') !!}';
            } else if (price.period == 730) {
                return '{!! __('admin.per_years', ['years' => 2]) !!}';
            } else if (price.period == 1825) {
                return '{!! __('admin.per_years', ['years' => 5]) !!}';
            } else if (price.period == 3650) {
                return '{!! __('admin.per_years', ['years' => 10]) !!}';
            } else {
                return '{!! __('admin.daily') !!}';
            }
        }

        function incrementInput(id) {
            document.getElementById(id).value = parseInt(document.getElementById(id).value) + 1;
            updateCheckoutPrice();
        }

        function decrementInput(id) {
            document.getElementById(id).value = parseInt(document.getElementById(id).value) - 1;
            updateCheckoutPrice();
        }
    </script>
@endsection
