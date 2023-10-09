@extends(Theme::wrapper())

@section('container')
    <div class="flex flex-wrap ">
        <div class="w-full md:w-full pr-4 pl-4 lg:w-1/3 pr-4 pl-4">
            <div
                class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 bg-white rounded-lg shadow-md dark:bg-gray-800 border border-gray-200 dark:border-gray-800 mb-5">
                <div class="flex-auto p-4">
                    <div class="justify-center" style="display: flex;">
                        <img alt="image" style="width: 100%" src="{{ $checkout->checkout->QR_code }}"
                             class="max-w-full h-auto" data-toggle="tooltip" title=""
                             data-original-title="Scan via your Wallet App">
                    </div>
                </div>
            </div>

            <div class="max-w-sm p-6 bg-white rounded-lg shadow dark:bg-gray-800">
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{!! __('client.status') !!}:
                    <span
                        class="bg-yellow-100 text-yellow-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">
                        {!! __('client.' . $payment->status) !!}
                    </span><br>
                    {!! __('client.payment_not_received') !!}<br><br>
                    {!! __('client.checking_in') !!}: <span id="countdown"> </span>
                </p>
            </div>
            <a class="text-gray-700 text-sm" href="https://bitpave.com" target="_blank">
                {!! __('client.bitpave_payment_engine') !!}</a>
        </div>

        <div class="w-full md:w-full pr-4 pl-4 lg:w-2/3 pr-4 pl-4">


            <div
                class="min-w-0  p-6 bg-white rounded-lg shadow dark:bg-gray-800">
                <a href="#" class="flex justify-between	content-center">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        {!! __('client.payment_details') !!}
                    </h5>
                    <h5 class="mb-2 text-xl tracking-tight text-gray-700 dark:text-gray-400" id="timer"></h5>
                </a>
                <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">
                    {!! __('client.payment_total_is', ['is' => $payment->amount, 'for' => $payment->description]) !!}
                </p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                    {!! __('client.bitpave_instruction', ['price' => $checkout->price->btc, 'wallet' => $checkout->session->wallet]) !!}
                </p>

                <label for="wallet" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{!! __('client.wallet') !!}</label>
                <div class="relative mb-4 mt-4">
                    <div
                        class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-900 dark:text-gray-300 ">
                        <i class='bx bxs-wallet'></i>
                    </div>
                    <input type="text" id="email-address-icon"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           value="{{ $checkout->session->wallet }}" disabled>
                </div>

                <label for="email-address-icon" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    {!! __('client.bitcoin_amount') !!}
                </label>
                <div class="relative mb-6">
                    <div
                        class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-900 dark:text-gray-300">
                        <i class='bx bxl-bitcoin'></i>
                    </div>
                    <input type="text" id="email-address-icon"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           value="{{ $checkout->price->btc }}" disabled>
                </div>

                <button disabled type="button"
                        class="text-white w-full	justify-center	 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 inline-flex items-center">
                    <svg aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-white animate-spin"
                         viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                            fill="#E5E7EB"/>
                        <path
                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                            fill="currentColor"/>
                    </svg>
                    {!! __('client.awaiting_payment') !!}
                </button>
            </div>
        </div>
    </div>

    <script>
        countdownToUnixTimestamp('{{ $checkout->session->expires_at }}');

        function countdownToUnixTimestamp(unixTimestamp) {
            const timerElement = document.getElementById('timer');

            const countdownInterval = setInterval(() => {
                const now = Math.floor(Date.now() / 1000);
                const secondsLeft = unixTimestamp - now;

                if (secondsLeft <= 0) {
                    clearInterval(countdownInterval);
                    timerElement.innerHTML = '{!! __('client.session_expired') !!}';
                    return;
                }

                const minutes = Math.floor(secondsLeft / 60);
                const seconds = secondsLeft % 60;
                timerElement.innerHTML = `${minutes}:${seconds.toString().padStart(2, '0')}`;
            }, 1000);
        }

        function copy(data, element) {

            // Copy the text inside the text field
            navigator.clipboard.writeText(data);

            // Alert the copied text
            elem = document.getElementById(element);
            elem.innerHTML = '{!! __('client.copied') !!} ' + element;
            elem.classList.remove("btn-info");
            elem.classList.add("btn-success");
        }

        var transactions = setInterval(function () {

            $.getJSON('https://bitpave.com/api/session/{{ $checkout->session->session }}/confirm', function (data) {
                console.log(data);

                if (data.status == 'completed') {
                    location.reload()
                    return clearInterval(transactions);
                }
                if (data.status == 'expired') {
                    location.reload()
                    return clearInterval(transactions);
                }
            });

        }, 15000);

        let countdown;

        function startCountdown() {
            let timeLeft = 15;
            let countdownElement = document.getElementById('countdown');

            clearInterval(countdown); // Reset countdown if already running

            countdown = setInterval(function () {
                if (timeLeft <= 0) {
                    clearInterval(countdown);
                    countdownElement.innerText = "{!! __('client.scanning_payments') !!}";
                    startCountdown(); // Reset countdown
                } else {
                    countdownElement.innerText = timeLeft + "s";
                    timeLeft--;
                }
            }, 1000);
        }

        startCountdown();
    </script>
    <style>
        .loader {
            border: 4px solid #ffffff30;
            border-top: 4px solid #ffffff;
            border-radius: 86%;
            width: 32px;
            height: 32px;
            animation: spin 1s linear infinite;
            margin-right: 10px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .dead-center {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            min-height: 100vh;
        }

        @media only screen and (max-width: 768px) {
            .instructions {
                justify-content: center;
                flex-direction: column;
                align-items: center;
            }

            .instructions-div {
                margin-top: 20px;
            }
        }
    </style>
@endsection
