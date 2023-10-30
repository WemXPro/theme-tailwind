@props([
    'order' => $order,
    'data' => $order->data,
])

@if(request('page') == 'manage')
<button  type="button" data-drawer-target="upgradeService-{{ $order->id }}" data-drawer-show="upgradeService-{{ $order->id }}" data-drawer-placement="right" aria-controls="upgradeService-{{ $order->id }}"
class="focus:outline-none text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg px-3 py-2 text-sm font-medium dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
<i class='bx bxs-box font-xl mr-1'></i>
{{ __('client.upgrade') }}
</button>

<!-- Main modal -->
<!-- drawer component -->
<div id="upgradeService-{{ $order->id }}" class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-80 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-upgrade-label">
    <h5 id="drawer-upgrade-label" class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400"><svg class="w-4 h-4 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
  </svg>{{ __('client.upgrade') }} {{ $order->name }}</h5>
   <button type="button" data-drawer-hide="upgradeService-{{ $order->id }}" aria-controls="upgradeService-{{ $order->id }}" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 right-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white" >
      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
         <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
      </svg>
      <span class="sr-only">{{ __('client.close_menu') }}</span>
   </button>
   <p class="mb-6 text-sm text-gray-500 dark:text-gray-400">{!! __('client.upgrade_current_package_to_category', ['package' => $order->package->name]) !!} <a target="_blank" href="{{ route('store.index', $order->package->category->path) }}" class="text-blue-600 underline font-medium dark:text-blue-500 hover:no-underline">{{ $order->package->category->name }}</a></p>
   @if($order->hasActiveSubscription())
   <div class="flex items-center p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-900 dark:text-blue-400" role="alert">
        <span class="sr-only">Info</span>
        <div>
        <span class="font-medium">{{ __('client.cancel_subscription_to_continue') }}
        </div>
    </div>
    @endif
   <form action="{{ route('service', ['order' => $order->id, 'page' => 'upgrade']) }}" method="POST">
    @csrf
    <div style="height: 300px; overflow: scroll;">
        @foreach(Package::where('category_id', $order->package->category->id)->get() as $package)
        <div class="flex items-center space-x-4 mb-2">
            <img class="mb-4 w-10 h-10 rounded sm:w-10 sm:h-10" src="{{ $package->icon() }}" alt="package icon">
            <div class="w-full"> 
                @if($order->package->id == $package->id)
                <span class="bg-blue-100 text-blue-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 mb-1 sm:mb-1">
                    {{ __('client.current_package') }}
                </span>
                @endif
                <h2 class="flex items-center mb-2 text-md leading-none text-gray-700 sm:text-md dark:text-gray-200 flex justify-between">
                    {{ $package->name }}
                    <span class="bg-gray-100 text-gray-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300 uppercase ml-2.5">{{ currency('symbol') }}{{ $package->prices()->first()->renewal_price }}/{{ $package->prices()->first()->period() }}</span>
                </h2>
                @if($order->package->id == $package->id)
                <a href="#" class="text-blue-600 ml-2" onclick="selectUpgradePackage('{{$package->id}}', '{{$package->name}}')" id="{{$package->id}}-upgrade-select">{{ __('client.change_price_cycle') }}</a>
                @else 
                    <a href="#" class="text-blue-600" onclick="selectUpgradePackage('{{$package->id}}', '{{$package->name}}')" id="{{$package->id}}-upgrade-select">{{ __('client.select') }}</a>
                @endif 
            </div>
        </div>
        @endforeach
    </div>
    <div class="list">
        <p class="font-normal text-sm text-gray-700 dark:text-gray-400 flex justify-between mb-4"><span id="period">{{ __('client.selected') }}</span>
            <span id="selected_package">{{ $order->package->name }}</span>
        </p>

        <p class="font-normal text-sm text-gray-700 dark:text-gray-400 flex justify-between mb-4"><span id="period">{{ __('client.cycle') }}</span>
            <span>{{ currency('symbol') }}<span id="recurring">0.00</span></span>
        </p>

        <p class="font-normal text-sm text-gray-700 dark:text-gray-400 flex justify-between mb-4"><span id="period">{{ __('client.cancellation_fee') }}</span>
            <span>{{ currency('symbol') }}<span id="cancellation_fee">0.00</span></span>
        </p>

        <p class="font-normal text-sm text-gray-700 dark:text-gray-400 flex justify-between mb-4"><span id="period">{{ __('client.due_today') }} <i class='bx bxs-help-circle' data-popover-target="popover-default"></i></span>
            <span>{{ currency('symbol') }}<span id="due_today">0.00</span></span>
        </p>
        <div data-popover id="popover-default" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
            <div class="px-3 py-2">
                <p>{!! __('client.upgrade_price_info', ['days' => now()->diffInDays($order->due_date), 'package' => $order->package->name]) !!}</p>
            </div>
            <div data-popper-arrow></div>
        </div>
        <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">
    </div>

    <input type="text" id="package_id" name="package_id" class="hidden" required>

    <div id="price-div" class="hidden">
        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('client.price_cycle') }}</label>
        <select
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 mb-4"
        name="price_id" tabindex="-1" aria-hidden="true" required>
    
        </select>
    </div>
    <label for="gateway" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('client.gateway') }}</label>
    <select
    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 mb-4"
    name="gateway" tabindex="-1" aria-hidden="true" required>

    @foreach (App\Models\Gateways\Gateway::getActive() as $gateway)
        @if($gateway->name == 'Balance')
            <option value="{{ $gateway->id }}" @if(Auth::user()->balance >= 0) selected @endif>{{ __('client.pay_with_balance') }} ({{ currency('symbol') }}{{ number_format(Auth::user()->balance, 2) }})</option>
            @continue
        @endif

        <option value="{{ $gateway->id }}">{{ $gateway->name }}</option>
    @endforeach

    </select>

    <div class="text-center">
        <button type="submit" style="width: 100%" class="inline-flex justify-center items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">{{ __('client.upgrade_now') }} <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
    </svg></button>
     </div>
   </form>
</div>
<script>
function selectUpgradePackage(package, package_name) {
    document.getElementById(package + '-upgrade-select').innerHTML = '{{ __('client.selected') }}';

    document.getElementById('selected_package').innerHTML = package_name;
    document.getElementById('selected_package2').innerHTML = package_name;

    package_field = document.getElementById('package_id');
    if(package_field.value !== '') {
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
                if(item.id == '{{ $order->price['id'] }}') {
                    return;
                }
                var option = new Option('{{currency("symbol")}}' + item.renewal_price.toFixed(2) + ' / ' + item.cycle, item.id);
                option.dataset.cycle = item.cycle;
                option.dataset.period = item.period;
                option.dataset.renewalPrice = item.renewal_price.toFixed(2);
                option.dataset.cancellationFee = item.cancellation_fee.toFixed(2);
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
    document.getElementById('cancellation_fee').textContent = selectedOption.dataset.cancellationFee;

    var upgradePrice = (selectedOption.dataset.renewalPrice / selectedOption.dataset.period - {{ $order->price['renewal_price'] }} / {{ $order->price['period'] }}) * {{ now()->diffInDays($order->due_date) }};
    console.log(upgradePrice.toFixed(2));

    if(upgradePrice > 0) {
        // calculate the upgrade price
        // upgradePrice = selectedOption.dataset.renewalPrice - {{ $order->price['renewal_price'] }};
        document.getElementById('due_today').innerHTML = upgradePrice.toFixed(2);
    } else {
        document.getElementById('due_today').innerHTML = '0.00';
    }
}

</script>
@endif