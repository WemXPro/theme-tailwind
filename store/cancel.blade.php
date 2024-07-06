@extends(Theme::wrapper())

@section('title')
    {!! __('client.payment_canceled') !!}
@endsection

@section('container')
    <section>
        <div class="mx-auto max-w-screen-xl px-4 py-8 lg:px-6 lg:py-16">
            <div class="mx-auto max-w-screen-sm text-center">
                <div class="flex justify-center mx-auto mb-6 items-center w-12 h-12 sm:w-16 sm:h-16 rounded-full bg-red-100 dark:bg-red-900">
                    <svg class="w-8 h-8 sm:w-12 sm:h-12 text-red-700 dark:text-red-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
                    </svg>                
                </div>
                <p class="mb-4 text-3xl font-bold tracking-tight text-gray-900 dark:text-white md:text-4xl">
                    {!! __('client.payment_canceled') !!}
                </p>
                <p class="mb-4 text-lg font-light text-gray-500 dark:text-gray-400">{!! __('client.payment_canceled_desc') !!}</p>
                <a href="{{ route('dashboard') }}"
                    class="bg-primary-600 hover:bg-primary-800 focus:ring-primary-300 dark:focus:ring-primary-900 my-4 inline-flex rounded-lg px-5 py-2.5 text-center text-sm font-medium text-white focus:outline-none focus:ring-4">
                    {!! __('client.back_dashboard') !!}
                </a>
                <a href="{{ route('invoice', $payment->id) }}"
                    class="bg-primary-600 hover:bg-primary-800 focus:ring-primary-300 dark:focus:ring-primary-900 my-4 inline-flex rounded-lg px-5 py-2.5 text-center text-sm font-medium text-white focus:outline-none focus:ring-4">
                    {!! __('client.view_invoice') !!}
                </a>
            </div>
        </div>
    </section>
@endsection
