@extends(Theme::wrapper())

@section('container')
    <script src="https://js.stripe.com/v3/"></script>

    <h1 class="mb-3 text-3xl font-semibold dark:text-gray-300">{!! __('client.stripe_card_payment') !!}</h1>
    <p class="ml-2 text-lg dark:text-gray-400">{{ price($payment->amount, 2, $payment->currency) }}</p>

    <form action="{{ route('payment.process', ['gateway' => $gateway->id, 'payment' => $payment->id]) }}" method="post" id="payment-form"
        class="mt-4">
        @csrf
        <div class="form-group">
            <input type="hidden" name="price_id" value="{{ $payment->id }}">
            <input type="hidden" name="gateway" value="{{ $gateway->id }}">
            <label for="card-element" class="block font-medium text-gray-700 dark:text-gray-300">
                {!! __('client.credit_debit_card') !!}
            </label>
            <div id="card-element"
                class="mt-1 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500">
                <!-- A Stripe Element will be inserted here. -->
            </div>
            <!-- Used to display form errors. -->
            <div id="card-errors" role="alert" class="mt-2 text-red-500 dark:text-red-400"></div>
        </div>
        <button type="submit"
            class="mt-4 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:bg-indigo-500 dark:hover:bg-indigo-400 dark:focus:ring-offset-gray-800">
            {!! __('client.submit_payment') !!}
        </button>
    </form>

    <script>
        // Create a Stripe instance.
        const stripe = Stripe('{{ $gateway->config['publicKey'] }}');

        // Create an instance of Elements.
        const elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        const style = {
            base: {
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        // Create an instance of the card Element.
        const card = elements.create('card', {
            style: style
        });

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function(event) {
            const displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission.
        const form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    const errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });

        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            const form = document.getElementById('payment-form');
            const hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }
    </script>
@endsection
