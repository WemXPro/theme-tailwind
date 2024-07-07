@props([
    'order' => $order,
    'data' => $order->data,
])

@if (request('page') == 'manage')
    <button type="button" data-drawer-target="upgradeService-{{ $order->id }}" data-drawer-show="upgradeService-{{ $order->id }}"
        data-drawer-placement="right" aria-controls="upgradeService-{{ $order->id }}"
        class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 rounded-lg px-3 py-2 text-sm font-medium font-medium text-white focus:outline-none focus:ring-4">
        <i class='bx bxs-box font-xl mr-1'></i>
        {{ __('client.upgrade') }}
    </button>

    <!-- Main modal -->
    <!-- drawer component -->
    <div id="upgradeService-{{ $order->id }}"
        class="fixed right-0 top-0 z-40 h-screen w-80 translate-x-full overflow-y-auto bg-white p-4 transition-transform dark:bg-gray-800"
        tabindex="-1" aria-labelledby="drawer-upgrade-label">
        <h5 id="drawer-upgrade-label" class="mb-4 inline-flex items-center text-base font-semibold text-gray-500 dark:text-gray-400"><svg
                class="mr-2.5 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>{{ __('client.upgrade') }} {{ $order->name }}</h5>
        <button type="button" data-drawer-hide="upgradeService-{{ $order->id }}" aria-controls="upgradeService-{{ $order->id }}"
            class="absolute right-2.5 top-2.5 inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white">
            <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">{{ __('client.close_menu') }}</span>
        </button>
        <p class="mb-6 text-sm text-gray-500 dark:text-gray-400">{!! __('client.upgrade_current_package_to_category', ['package' => $order->package->name]) !!} <a target="_blank"
                href="{{ route('store.index', $order->package->category->path) }}"
                class="font-medium text-blue-600 underline hover:no-underline dark:text-blue-500">{{ $order->package->category->name }}</a>
        </p>
        @if ($order->hasActiveSubscription())
            <div class="mb-4 flex items-center rounded-lg bg-blue-50 p-4 text-sm text-blue-800 dark:bg-gray-900 dark:text-blue-400"
                role="alert">
                <span class="sr-only">{!! __('client.info') !!}</span>
                <div>
                    <span class="font-medium">{{ __('client.cancel_subscription_to_continue') }}
                </div>
            </div>
        @endif
        <form action="{{ route('service', ['order' => $order->id, 'page' => 'upgrade']) }}" method="POST">
            @csrf
            <div style="height: 300px; overflow: scroll;">
                @foreach (Package::where('category_id', $order->package->category->id)->get() as $package)
                    @if ($package->status !== 'active' or !$package->settings('allow_upgrading', true))
                        @continue
                    @endif
                    <div class="mb-2 flex items-center space-x-4">
                        <img class="mb-4 h-10 w-10 rounded sm:h-10 sm:w-10" src="{{ $package->icon() }}" alt="package icon">
                        <div class="w-full">
                            @if ($order->package->id == $package->id)
                                <span
                                    class="mb-1 inline-flex items-center rounded bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800 dark:bg-blue-200 dark:text-blue-800 sm:mb-1">
                                    {{ __('client.current_package') }}
                                </span>
                            @endif
                            <h2
                                class="text-md sm:text-md mb-2 flex flex items-center justify-between leading-none text-gray-700 dark:text-gray-200">
                                {{ $package->name }}
                                <span
                                    class="ml-2.5 mr-2 rounded bg-gray-100 px-2.5 py-0.5 text-sm font-medium uppercase text-gray-800 dark:bg-gray-700 dark:text-gray-300">{{ price($package->prices()->first()->renewal_price) }}/{{ $package->prices()->first()->period() }}</span>
                            </h2>
                            @if ($order->package->id == $package->id)
                                <a href="#" class="ml-2 text-blue-600"
                                    onclick="selectUpgradePackage('{{ $package->id }}', '{{ $package->name }}')"
                                    id="{{ $package->id }}-upgrade-select">{{ __('client.change_price_cycle') }}</a>
                            @else
                                <a href="#" class="text-blue-600"
                                    onclick="selectUpgradePackage('{{ $package->id }}', '{{ $package->name }}')"
                                    id="{{ $package->id }}-upgrade-select">{{ __('client.select') }}</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="list">
                <p class="mb-4 flex justify-between text-sm font-normal text-gray-700 dark:text-gray-400"><span
                        id="period">{{ __('client.selected') }}</span>
                    <span id="selected_package">{{ $order->package->name }}</span>
                </p>
                <p class="mb-4 flex justify-between text-sm font-normal text-gray-700 dark:text-gray-400"><span
                        id="period">{{ __('client.cycle') }}</span>
                    <span>{{ currency('symbol') }}<span id="recurring">0.00</span></span>
                </p>
                <p class="mb-4 flex justify-between text-sm font-normal text-gray-700 dark:text-gray-400"><span
                        id="period">{{ __('admin.upgrade_fee') }}</span>
                    <span>{{ currency('symbol') }}<span id="upgrade_fee">0.00</span></span>
                </p>
                <p class="mb-4 flex justify-between text-sm font-normal text-gray-700 dark:text-gray-400"><span
                        id="period">{{ __('client.due_today') }} <i class='bx bxs-help-circle'
                            data-popover-target="popover-default"></i></span>
                    <span>{{ currency('symbol') }}<span id="due_today">0.00</span></span>
                </p>
                <div data-popover id="popover-default" role="tooltip"
                    class="invisible absolute z-10 inline-block w-64 rounded-lg border border-gray-200 bg-white text-sm text-gray-500 opacity-0 shadow-sm transition-opacity duration-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400">
                    <div class="px-3 py-2">
                        <p>{!! __('client.upgrade_price_info', ['days' => now()->diffInDays($order->due_date), 'package' => $order->package->name]) !!}</p>
                    </div>
                    <div data-popper-arrow></div>
                </div>
                <hr class="my-4 h-px border-0 bg-gray-200 dark:bg-gray-700">
            </div>

            <input type="text" id="package_id" name="package_id" class="hidden" required>

            <div id="price-div" class="hidden">
                <label for="price"
                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">{{ __('client.price_cycle') }}</label>
                <select
                    class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 mb-4 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                    name="price_id" tabindex="-1" aria-hidden="true" required>

                </select>
            </div>
            <label for="gateway" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">{{ __('client.gateway') }}</label>
            <select
                class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 mb-4 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                name="gateway" tabindex="-1" aria-hidden="true" required>

                @foreach (App\Models\Gateways\Gateway::getActive() as $gateway)
                    @if ($gateway->name == 'Balance')
                        <option value="{{ $gateway->id }}" @if (Auth::user()->balance >= 0) selected @endif>
                            {{ __('client.pay_with_balance') }} ({{ price(Auth::user()->balance) }})
                        </option>
                        @continue
                    @endif
                    <option value="{{ $gateway->id }}">{{ $gateway->name }}</option>
                @endforeach
            </select>
            <div class="text-center">
                <button type="submit" style="width: 100%"
                    class="inline-flex items-center justify-center rounded-lg bg-blue-700 px-4 py-2 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    {{ __('client.upgrade_now') }}
                    <svg class="ml-2 h-3.5 w-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </button>
            </div>
        </form>
    </div>

    <script>
        function selectUpgradePackage(package, package_name) {
            document.getElementById(package + '-upgrade-select').innerHTML = '{{ __('client.selected') }}';

            document.getElementById('selected_package').innerHTML = package_name;
            document.getElementById('selected_package2').innerHTML = package_name;

            package_field = document.getElementById('package_id');
            if (package_field.value !== '') {
                document.getElementById(package_field.value + '-upgrade-select').innerHTML = '{{ __('client.select') }}';
            }

            package_field.value = package;

            select_price = document.getElementById('price-div').classList.remove("hidden");
            var select = document.getElementsByName('price_id')[0];

            // 2. Clear Existing Options
            select.innerHTML = '';

            // 3. Make an API Request
            fetch('/service/package/' + package + '/prices')
                .then(response => response.json())
                .then(data => {
                    // 4. Process the JSON Response
                    data.forEach(item => {
                        // 5. Update the Select Options
                        if (item.id == '{{ $order->price['id'] }}') {
                            return;
                        }
                        // if(item.type !== '{{ isset($order->price['type']) ? $order->price['type'] : 'recurring' }}') {
                        //     return;
                        // }
                        var option = new Option('{{ currency('symbol') }}' + item.renewal_price.toFixed(2) + ' / ' + item.cycle,
                            item.id);
                        option.dataset.cycle = item.cycle;
                        option.dataset.period = item.period;
                        option.dataset.renewalPrice = item.renewal_price.toFixed(2);
                        option.dataset.upgradeFee = item.upgrade_fee.toFixed(2);
                        select.add(option);
                    });

                    updatePriceHTML(select);

                })
                .catch(error => console.error('Error fetching data:', error));

            // 6. Add Event Listener for Option Selection
            select.onchange = function() {
                updatePriceHTML(select);
            };
        }

        function updatePriceHTML(select) {
            var selectedOption = select.options[select.selectedIndex];
            document.getElementById('recurring').textContent = selectedOption.dataset.renewalPrice + ' / ' + selectedOption.dataset.cycle;
            document.getElementById('upgrade_fee').textContent = selectedOption.dataset.upgradeFee;

            var upgradePrice = (selectedOption.dataset.renewalPrice / selectedOption.dataset.period - {{ $order->price['renewal_price'] }} /
                {{ $order->price['period'] }}) * {{ now()->diffInDays($order->due_date) }};
            upgradePrice = upgradePrice + parseFloat(selectedOption.dataset.upgradeFee);

            if (upgradePrice > 0) {
                // calculate the upgrade price
                // upgradePrice = selectedOption.dataset.renewalPrice - {{ $order->price['renewal_price'] }};
                document.getElementById('due_today').innerHTML = upgradePrice.toFixed(2);
            } else {
                document.getElementById('due_today').innerHTML = '0.00';
            }
        }
    </script>
@endif
