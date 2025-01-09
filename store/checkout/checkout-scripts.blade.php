<script>
    const prices = {!! json_encode($package->prices->toArray()) !!};
    const form = document.getElementById('price');
    let coupon_data;

    // When the page is loaded (DOMContentLoaded) — update the price
    document.addEventListener('DOMContentLoaded', function() {
        updateCheckoutPrice();

        // If the session already has a coupon
        @if (session('coupon_code'))
        document.getElementById('coupon').value = "{{ session('coupon_code') }}";
        applyCoupon();
        @endif

        // We listen to the change in form
        form.addEventListener('change', function(event) {
            event.preventDefault();
            updateCheckoutPrice();
        });
    });

    function activePrice() {
        let selectedPrice = null;
        // We go through the inputs of the form, we are looking for the active Radio (price_id)
        for (var i = 0; i < form.length; i++) {
            if (form[i].checked) {
                prices.forEach(price => {
                    if (form[i].value == price.id) {
                        selectedPrice = price;
                        return;
                    }
                });
                break;
            }
        }
        return selectedPrice;
    }

    function updateCheckoutPrice() {
        // We get the currently selected price
        const price = activePrice();
        if (!price) return;

        // If a one-time payment (single), we hide subscription gateways and vice versa
        if (price.type === 'single') {
            hideSubscriptionGateways();
        } else {
            showSubscriptionGateways();
        }

        // Period display (to see "Month", "Year", etc.)
        document.getElementById('period').textContent = periodToHuman(price);

        // Setup fee update
        document.getElementById('setup_fee').textContent = price.setup_fee.toFixed(2);

        // Discount calculation
        const discount = getTotalDiscount(price.price + price.setup_fee);
        document.getElementById('discounted').textContent = discount.toFixed(2);

        // Tax calculation
        const taxed = calculateTax((price.price + price.setup_fee) - discount);
        document.getElementById('taxes').textContent = taxed.toFixed(2);

        // Final price (including options, discounts, taxes)
        const total = Math.max(0, getTotalPrice(price)).toFixed(2);
        document.getElementById('total_price').textContent = total;

        // We are updating the display of the recurring price
        document.getElementById('recurring').textContent = total;

        // If there is a cancellation_fee for this price, we show a message
        if (price.cancellation_fee > 0) {
            document.getElementById('disclosure').textContent =
                '*Selected price cycle includes a cancellation fee of $' + price.cancellation_fee.toFixed(2);
        } else {
            document.getElementById('disclosure').textContent = '';
        }
    }

    function getTotalPrice(price) {
        let totalPrice = price.price + price.setup_fee;

        // Add configurable options
        totalPrice += calculateCustomOptionsPrice();

        // Discount
        totalPrice -= getTotalDiscount(totalPrice);

        // If the tax is added "from above" (tax_add_to_price)
        @if (settings('tax_add_to_price'))
            totalPrice += calculateTax(totalPrice);
        @endif

            return totalPrice;
    }

    function calculateCustomOptionsPrice() {
        let result = 0;
        @foreach($package->configOptions()->orderBy('order', 'desc')->get() as $option)
        @if($option->type == 'select')
        const selectEl = document.getElementById('option-{{ $option->id }}');
        if (selectEl) {
            const selIndex = selectEl.selectedIndex;
            const unitPrice = selectEl.options[selIndex].getAttribute('data-select-option-unitprice');
            result += (unitPrice / 30) * activePrice().period;
        }
        @elseif($option->type == 'number')
        const numberEl = document.getElementById('option-{{ $option->id }}');
        if (numberEl) {
            result += ({{ $option->data['monthly_price_unit'] ?? 0 }} / 30)
                * numberEl.value
                * activePrice().period;
        }
        @elseif($option->type == 'range')
        const rangeEl = document.getElementById('option-{{ $option->id }}');
        if (rangeEl) {
            result += ({{ $option->data['monthly_price_unit'] ?? 0 }} / 30)
                * rangeEl.value
                * activePrice().period;
        }
        @endif
        @endforeach

        // Оновити в полі
        const configPriceEl = document.getElementById('config_options_price');
        if (configPriceEl) {
            configPriceEl.innerHTML = result.toFixed(2);
        }
        return result;
    }

    function getTotalDiscount(totalPrice) {
        let totalDiscount = 0;
        // Affiliate
        @if (Cookie::get('affiliate'))
        const factor = {{ Affiliate::calculateDiscountFactor(Cookie::get('affiliate')) }};
        totalDiscount += totalPrice * factor;
        @endif

        // Coupon
        if (typeof coupon_data !== "undefined") {
            if (coupon_data.discount_type === 'percentage') {
                totalDiscount += totalPrice * (coupon_data.discount_amount / 100);
            } else {
                totalDiscount += coupon_data.discount_amount;
            }
        }
        document.getElementById('discounted').textContent = totalDiscount.toFixed(2);
        return parseFloat(totalDiscount.toFixed(2));
    }

    function calculateTax(totalPrice) {
        @if (!settings('taxes'))
            return 0;
        @endif

        const gateway = document.getElementById('gateway').value;
        let disabledGateways = @settings('tax_disabled_gateways', '[]');

        // If the gateway in the disable list is 0
        if (disabledGateways.includes(gateway)) {
            document.getElementById("tax-card").style.display = 'none';
            document.getElementById("taxes").innerHTML = '0.00 (Calculated next step)';
            return 0;
        } else {
            document.getElementById("tax-card").style.display = '';
        }

        let totalTax = 0;
        const country = document.getElementById('country').value;
        const rates = @json(config('tax.rates') ?? []);

        if (country && rates[country]) {
            const ratePercent = rates[country].standard_rate / 100;
            @if (settings('tax_add_to_price'))
                totalTax = totalPrice * ratePercent;
            @else
                totalTax = totalPrice - (totalPrice / (1 + ratePercent));
            @endif
        }
        document.getElementById("taxes").innerHTML = totalTax.toFixed(2);
        return parseFloat(totalTax.toFixed(2));
    }

    function applyCoupon() {
        const coupon = document.getElementById('coupon').value;
        if (!coupon) {
            alertCoupon('Please enter a coupon to apply it');
            return;
        }

        fetch('/store/validate-coupon/{{ $package->id }}/' + coupon, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            }
        })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    alertCoupon(data.description);
                    return;
                }
                coupon_data = data;
                alertCoupon(data.description);
                updateCheckoutPrice();
            })
            .catch(error => {
                alertCoupon('Something went wrong, please refresh and try again.');
            });

        // Recalculation
        updateCheckoutPrice();
    }

    function alertCoupon(desc) {
        document.getElementById('coupon-description').innerHTML = desc;
    }

    // If single => hide subscription
    function hideSubscriptionGateways() {
        const options = document.querySelectorAll('#gateway option[data-gateway-type="subscription"]');
        options.forEach(option => {
            option.setAttribute('disabled', '');
            option.hidden = true;
        });
    }

    // Show subscription
    function showSubscriptionGateways() {
        const options = document.querySelectorAll('#gateway option[data-gateway-type="subscription"]');
        options.forEach(option => {
            option.removeAttribute('disabled');
            option.hidden = false;
        });
    }

    // The "period in a human-understandable form" function
    function periodToHuman(price) {
        if (price.type === 'single') {
            return '{!! __('admin.once') !!}';
        }
        switch (price.period) {
            case 1:    return '{!! __('admin.daily') !!}';
            case 7:    return '{!! __('admin.weekly') !!}';
            case 30:   return '{!! __('admin.monthly') !!}';
            case 90:   return '{!! __('admin.quaterly') !!}';
            case 180:  return '{!! __('admin.semi_yearly') !!}';
            case 365:  return '{!! __('admin.yearly') !!}';
            case 730:  return '{!! __('admin.per_years', ['years' => 2]) !!}';
            case 1825: return '{!! __('admin.per_years', ['years' => 5]) !!}';
            case 3650: return '{!! __('admin.per_years', ['years' => 10]) !!}';
            default:   return '{!! __('admin.daily') !!}';
        }
    }

    // increment/decrement for number
    function incrementInput(id) {
        const el = document.getElementById(id);
        el.value = parseInt(el.value) + 1;
        updateCheckoutPrice();
    }

    function decrementInput(id) {
        const el = document.getElementById(id);
        el.value = parseInt(el.value) - 1;
        updateCheckoutPrice();
    }
</script>
