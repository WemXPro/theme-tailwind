@props([
    'order' => $order,
    'data' => $order->data,
])

<button type="button" data-modal-target="renewService-{{ $order->id }}" data-modal-toggle="renewService-{{ $order->id }}"
    class="rounded-lg bg-green-700 px-3 py-2 text-sm font-medium font-medium text-white hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
    <i class='bx bx-recycle font-xl mr-1'></i>
    {!! __('client.renew') !!}
</button>

<!-- Main modal -->
<div id="renewService-{{ $order->id }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
    class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full overflow-y-auto overflow-x-hidden p-4 md:inset-0">
    <div class="relative max-h-full w-full max-w-2xl">
        <!-- Modal content -->
        <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between rounded-t border-b p-4 dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    {!! __('client.ptero_renew_plan') !!}
                </h3>
                <button type="button"
                    class="ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="renewService-{{ $order->id }}">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <!-- Modal body -->
            <div class="space-y-6 p-6">
                <div class="mb-4 text-sm text-gray-800 dark:text-gray-300">
                    {!! __('client.ptero_renew_desc', [
                        'due_date' => $order->due_date->translatedFormat('d M Y'),
                        'due_date_diff' => $order->due_date->diffForHumans(),
                        'period' => $order->period(),
                    ]) !!}
                </div>
                <form action="{{ route('service', ['order' => $order->id, 'page' => 'renew']) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <div class="mb-4" id="renew-presets-{{ $order->id }}" style="display: unset">
                            <label for="renew-presets-input-{{ $order->id }}"
                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">{!! __('client.renew_for') !!}</label>
                            <select id="renew-presets-input-{{ $order->id }}" name="days"
                                class="mb-6 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500">
                                @foreach (range(1, 12) as $value)
                                    <option value="{{ $value * $order->price()->period }}" @if ($value == 1) selected @endif>{{ $value }}
                                        {{ ucfirst($order->period()) }} -
                                        {{ price($value * $order->price()->renewal_price) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4" id="renew-customdate-{{ $order->id }}" style="display: none;">
                            <div>
                                <label for="renew-presets-input-{{ $order->id }}" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">{{ __('client.select_date') }}</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                      <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                      </svg>
                                    </div>
                                    <input autocomplete="off" datepicker datepicker-title="{{ __('client.current_due_date') }} {{ $order->due_date->translatedFormat(settings('date_format', 'd M Y')) }}" inline-datepicker datepicker-autohide datepicker-min-date="{{ $order->due_date->addDays(14)->format('m/d/Y') }}" id="renew-customdate-input-{{ $order->id }}" name="" type="text" value="{{ $order->due_date->format('m/d/Y') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm mb-6 rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Select date">
                                </div>
                            </div>

                            <dl class="max-w-md text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                                <div class="flex flex-col pb-3">
                                    <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">{{ __('client.total') }}</dt>
                                    <dd class="text-lg font-semibold" id="custom-renewal-total-{{ $order->id }}">-</dd>
                                </div>
                            </dl>
                            
                        </div>
                
                        @if ($order->package->settings('allow_custom_renewal_date', true))
                            <button type="button" onclick="toggleCustomRenewalDate('{{ $order->id }}')" id="toggle-custom-renewal-date-{{ $order->id }}" class="font-medium text-primary-600 dark:text-primary-500 hover:underline">{{ __('client.select_custom_date') }}</button>
                        @endif
                    </div>
                
                    <!-- Modal footer -->
                    <div class="flex items-center space-x-2 rounded-b border-t border-gray-200 p-6 dark:border-gray-600">
                        <button data-modal-hide="renewService-{{ $order->id }}" type="button"
                            class="rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-900 focus:z-10 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:border-gray-500 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-600">{!! __('client.cancel') !!}</button>
                        <button data-modal-hide="renewService-{{ $order->id }}" type="submit"
                            class="rounded-lg bg-primary-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">{!! __('client.create_invoice') !!}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleCustomRenewalDate(orderId) {
        var customDate = document.getElementById('renew-customdate-' + orderId);
        var presets = document.getElementById('renew-presets-' + orderId);
        var presetsInput = document.getElementById('renew-presets-input-' + orderId);
        var customDateInput = document.getElementById('renew-customdate-input-' + orderId);
        var toggle = document.getElementById('toggle-custom-renewal-date-' + orderId);

        if (customDate.style.display === 'none') {
            customDate.style.display = 'unset';
            presets.style.display = 'none';
            presetsInput.setAttribute('name', '');
            customDateInput.setAttribute('name', 'custom_date');
            toggle.innerText = '{{ __('client.select_from_preset') }}';
        } else {
            customDate.style.display = 'none';
            presets.style.display = 'unset';
            presetsInput.setAttribute('name', 'days');
            customDateInput.setAttribute('name', '');
            toggle.innerText = '{{ __('client.select_custom_date') }}';
        }
    }

    // add event listener that listens for the date change
    var renewalDatePicker = document.getElementById('renew-customdate-input-{{ $order->id }}');
    renewalDatePicker.addEventListener('changeDate', function() {
        var startDate = new Date('{{ $order->due_date->format('m/d/Y') }}');
        var endDate = new Date(this.value);

        // get the difference in days between start and end date
        var diffTime = Math.abs(endDate - startDate);
        var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        var dailyPrice = {{ $order->price()->renewal_price / $order->price()->period }};
        var currencySymbol = '{{ currency('symbol') }}';
        var currencyCode = '{{ currency('short') }}';

        
        var totalPrice = diffDays * dailyPrice;
        document.getElementById('custom-renewal-total-{{ $order->id }}').innerText = currencySymbol + totalPrice.toFixed(2) + ' ' + currencyCode;
    });
</script>