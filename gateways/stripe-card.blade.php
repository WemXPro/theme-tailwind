@extends(Theme::wrapper())

@section('container')
    <script src="https://js.stripe.com/v3/"></script>

    <h1 class="text-3xl font-semibold mb-3 dark:text-gray-300">{!! __('client.stripe_card_payment') !!}</h1>
    <p class="text-lg ml-2 dark:text-gray-400">${{ $payment->amount }} {{ $payment->currency }}</p>
    <form action="{{ route('payment.process', ['gateway' => $gateway->id, 'payment' => $payment->id]) }}" method="post" id="payment-form" class="mt-4">
        @csrf
        <div class="form-group">
            <input type="hidden" name="price_id" value="{{ $payment->id }}">
            <input type="hidden" name="gateway" value="{{ $gateway->id }}">
            <label for="card-element" class="block text-gray-700 font-medium dark:text-gray-300">
                {!! __('client.credit_debit_card') !!}
            </label>
            <div id="card-element"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-1">
                <!-- A Stripe Element will be inserted here. -->
            </div>
            <!-- Used to display form errors. -->
            <div id="card-errors" role="alert" class="text-red-500 mt-2 dark:text-red-400"></div>
        </div>
        <button type="submit"
            class="mt-4 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-indigo-500 dark:hover:bg-indigo-400 dark:focus:ring-offset-gray-800">
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
