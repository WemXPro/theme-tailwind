<script>
    /**
     * Class-based approach to handle pricing, tax, and coupon logic.
     */
    class CheckoutCalculator {
        /**
         * @param {Object} options
         *   - options.prices: array of price objects from the server (package->prices->toArray())
         *   - options.formId: the ID of your form element (e.g. 'price')
         *   - optional: any other IDs you might want to reference (#coupon, #gateway, #country, etc.)
         */
        constructor(options) {
            this.prices = options.prices || [];
            this.form   = document.getElementById(options.formId);

            // If you have IDs for country, gateway, coupon, etc., store them:
            this.gatewayEl   = document.getElementById(options.gatewayId   || 'gateway');
            this.countryEl   = document.getElementById(options.countryId   || 'country');
            this.couponEl    = document.getElementById(options.couponId    || 'coupon');
            this.discountEl  = document.getElementById(options.discountEl  || 'discounted');
            this.taxEl       = document.getElementById(options.taxEl       || 'taxes');
            this.setupFeeEl  = document.getElementById(options.setupFeeEl  || 'setup_fee');
            this.configEl    = document.getElementById(options.configEl    || 'config_options_price');
            this.totalEl     = document.getElementById(options.totalEl     || 'total_price');
            this.recurringEl = document.getElementById(options.recurringEl || 'recurring');
            this.periodEl    = document.getElementById(options.periodEl    || 'period');
            this.disclosureEl= document.getElementById(options.disclosureEl|| 'disclosure');

            // We store coupon data as we had coupon_data in the old code
            this.couponData = null;

            this.init();
        }

        /**
         * Initialize event listeners and do the first price update.
         */
        init() {
            // If the form exists, handle 'change' events
            if (this.form) {
                this.form.addEventListener('change', (e) => {
                    e.preventDefault();
                    this.updateCheckoutPrice();
                });
            }

            // If there's a coupon input and pre-filled session code
            @if (session('coupon_code'))
            if (this.couponEl) {
                this.couponEl.value = "{{ session('coupon_code') }}";
                // Attempt to apply it immediately
                this.applyCoupon();
            }
            @endif

            // If you want to attach direct event listeners to #country or #gateway:
            if (this.countryEl) {
                this.countryEl.addEventListener('change', () => this.updateCheckoutPrice());
                this.countryEl.addEventListener('input',  () => this.updateCheckoutPrice());
            }
            if (this.gatewayEl) {
                this.gatewayEl.addEventListener('change', () => this.updateCheckoutPrice());
                this.gatewayEl.addEventListener('input',  () => this.updateCheckoutPrice());
            }
            if (this.couponEl) {
                // If you want the coupon to apply on "blur" or an "Apply" button
                // this.couponEl.addEventListener('blur', () => this.applyCoupon());
            }

            // Initial price calculation
            this.updateCheckoutPrice();
        }

        /**
         * Finds which price is currently selected (the active radio).
         * This is your old "activePrice()" function.
         */
        activePrice() {
            // We iterate over form elements to see which price_id is checked
            let selectedPrice = null;
            if (!this.form) return null;

            for (let i = 0; i < this.form.length; i++) {
                if (this.form[i].checked) {
                    // Now we compare against this.prices array
                    this.prices.forEach(price => {
                        if (this.form[i].value == price.id) {
                            selectedPrice = price;
                            return;
                        }
                    });
                    break;
                }
            }
            return selectedPrice;
        }

        /**
         * Main function to re-calculate everything (discount, tax, total).
         */
        updateCheckoutPrice() {
            const price = this.activePrice();
            if (!price) return;

            // If 'single', hide subscription gateways, else show them
            if (price.type === 'single') {
                this.hideSubscriptionGateways();
            } else {
                this.showSubscriptionGateways();
            }

            // Update text for the period
            if (this.periodEl) {
                this.periodEl.textContent = this.periodToHuman(price);
            }

            // Setup fee
            if (this.setupFeeEl) {
                this.setupFeeEl.textContent = price.setup_fee.toFixed(2);
            }

            // Calculate discount
            const discount = this.getTotalDiscount(price.price + price.setup_fee);
            if (this.discountEl) {
                this.discountEl.textContent = discount.toFixed(2);
            }

            // Calculate tax on (base + setup - discount)
            const taxed = this.calculateTax( (price.price + price.setup_fee) - discount );
            if (this.taxEl) {
                this.taxEl.textContent = taxed.toFixed(2);
            }

            // Final total (including discount, custom options, tax)
            const total = Math.max(0, this.getTotalPrice(price)).toFixed(2);

            // Show final total
            if (this.totalEl) {
                this.totalEl.textContent = total;
            }

            // Also set the recurring element
            if (this.recurringEl) {
                this.recurringEl.textContent = total;
            }

            // If there's a cancellation fee
            if (this.disclosureEl) {
                if (price.cancellation_fee > 0) {
                    this.disclosureEl.textContent = "*Selected price cycle includes a cancellation fee of $" +
                        price.cancellation_fee.toFixed(2);
                } else {
                    this.disclosureEl.textContent = '';
                }
            }
        }

        /**
         * Returns the final total including custom options, discount, tax, etc.
         * This was your old getTotalPrice().
         */
        getTotalPrice(price) {
            let totalPrice = price.price + price.setup_fee;

            // Add custom options
            totalPrice += this.calculateCustomOptionsPrice();

            // Subtract discount
            totalPrice -= this.getTotalDiscount(totalPrice);

            // If the tax is added "on top"
            @if (settings('tax_add_to_price'))
                totalPrice += this.calculateTax(totalPrice);
            @endif

                return totalPrice;
        }

        /**
         * Sums up the configurable options cost.
         * This was your old calculateCustomOptionsPrice().
         */
        calculateCustomOptionsPrice() {
            let result = 0;
            const active = this.activePrice(); // get current radio selection
            if (!active) return 0;

                @foreach($package->configOptions()->orderBy('order', 'desc')->get() as $option)
                @if($option->type == 'select')
            {
                const selEl = document.getElementById('option-{{ $option->id }}');
                if (selEl) {
                    const selIndex = selEl.selectedIndex;
                    const unitPrice = selEl.options[selIndex].getAttribute('data-select-option-unitprice');
                    result += (unitPrice / 30) * active.period;
                }
            }
                @elseif($option->type == 'number')
            {
                const numEl = document.getElementById('option-{{ $option->id }}');
                if (numEl) {
                    result += ({{ $option->data['monthly_price_unit'] ?? 0 }} / 30) * numEl.value * active.period;
                }
            }
                @elseif($option->type == 'range')
            {
                const rangeEl = document.getElementById('option-{{ $option->id }}');
                if (rangeEl) {
                    result += ({{ $option->data['monthly_price_unit'] ?? 0 }} / 30) * rangeEl.value * active.period;
                }
            }
            @endif
            @endforeach

            // if there's a #config_options_price element
            if (this.configEl) {
                this.configEl.textContent = result.toFixed(2);
            }
            return result;
        }

        /**
         * Calculates discount from affiliate or coupon.
         * This was your old getTotalDiscount().
         */
        getTotalDiscount(totalPrice) {
            let totalDiscount = 0.0;

            // Affiliate factor
                @if (Cookie::get('affiliate'))
            {
                const factor = {{ Affiliate::calculateDiscountFactor(Cookie::get('affiliate')) }};
                totalDiscount += totalPrice * factor;
            }
            @endif

            // Coupon
            if (this.couponData) {
                if (this.couponData.discount_type === 'percentage') {
                    totalDiscount += totalPrice * (this.couponData.discount_amount / 100);
                } else {
                    totalDiscount += this.couponData.discount_amount;
                }
            }

            // If you want to update 'discounted' DOM here, you can do so
            if (this.discountEl) {
                this.discountEl.textContent = totalDiscount.toFixed(2);
            }
            return parseFloat(totalDiscount.toFixed(2));
        }

        /**
         * Calculates the tax on a given totalPrice.
         * This was your old calculateTax().
         */
        calculateTax(totalPrice) {
            @if(!settings('taxes'))
                return 0;
            @endif

            if (!this.gatewayEl || !this.countryEl) return 0;

            const gateway = this.gatewayEl.value;
            let disabledGateways = @settings('tax_disabled_gateways', '[]');

            if (disabledGateways.includes(gateway)) {
                // hide tax-card, set 0, return
                const taxCard = document.getElementById("tax-card");
                if (taxCard) {
                    taxCard.style.display = 'none';
                }
                if (this.taxEl) {
                    this.taxEl.textContent = '0.00 (Calculated next step)';
                }
                return 0;
            } else {
                // show tax-card
                const taxCard = document.getElementById("tax-card");
                if (taxCard) {
                    taxCard.style.display = '';
                }
            }

            let totalTax = 0;
            const country = this.countryEl.value;
            let rates = @json(config('tax.rates') ?? []);

            if (country && rates[country]) {
                const ratePercent = rates[country].standard_rate / 100;
                @if (settings('tax_add_to_price'))
                    totalTax = totalPrice * ratePercent;
                @else
                    totalTax = totalPrice - (totalPrice / (1 + ratePercent));
                @endif
            }

            if (this.taxEl) {
                this.taxEl.textContent = totalTax.toFixed(2);
            }
            return parseFloat(totalTax.toFixed(2));
        }

        /**
         * Hides subscription gateways (if single price is chosen).
         */
        hideSubscriptionGateways() {
            const options = document.querySelectorAll('#gateway option[data-gateway-type="subscription"]');
            options.forEach(opt => {
                opt.setAttribute('disabled', '');
                opt.hidden = true;
            });
        }

        /**
         * Shows subscription gateways (if recurring price is chosen).
         */
        showSubscriptionGateways() {
            const options = document.querySelectorAll('#gateway option[data-gateway-type="subscription"]');
            options.forEach(opt => {
                opt.removeAttribute('disabled');
                opt.hidden = false;
            });
        }

        /**
         * The coupon logic (applyCoupon()) from your code.
         */
        applyCoupon() {
            if (!this.couponEl) return;
            const coupon = this.couponEl.value;
            if (!coupon) {
                this.alertCoupon('Please enter a coupon to apply it');
                return;
            }
            // fetch ...
            fetch('/store/validate-coupon/{{ $package->id }}/' + coupon, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        this.alertCoupon(data.description);
                        return;
                    }
                    this.couponData = data;
                    this.alertCoupon(data.description);
                    this.updateCheckoutPrice();
                })
                .catch((error) => {
                    this.alertCoupon('Something went wrong, please refresh and try again.');
                });

            this.updateCheckoutPrice();
        }

        /**
         * Replaces alertCoupon(desc).
         */
        alertCoupon(desc) {
            const couponDescEl = document.getElementById('coupon-description');
            if (couponDescEl) {
                couponDescEl.innerHTML = desc;
            }
        }

        /**
         * Convert the price's period to a human string (old periodToHuman()).
         */
        periodToHuman(price) {
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

        /**
         * incrementInput() / decrementInput() can also be class-based
         */
        incrementInput(id) {
            const el = document.getElementById(id);
            el.value = parseInt(el.value) + 1;
            this.updateCheckoutPrice();
        }

        decrementInput(id) {
            const el = document.getElementById(id);
            el.value = parseInt(el.value) - 1;
            this.updateCheckoutPrice();
        }
    }

    // Now we instantiate the class after DOMContentLoaded
    document.addEventListener('DOMContentLoaded', () => {
        // Create a new CheckoutCalculator with your references
        new CheckoutCalculator({
            prices: {!! json_encode($package->prices->toArray()) !!},
            formId: 'price',

            // If you want to pass custom IDs:
            gatewayId:   'gateway',
            countryId:   'country',
            couponId:    'coupon',
            discountEl:  'discounted',
            taxEl:       'taxes',
            setupFeeEl:  'setup_fee',
            configEl:    'config_options_price',
            totalEl:     'total_price',
            recurringEl: 'recurring',
            periodEl:    'period',
            disclosureEl:'disclosure',
        });
    });
</script>
