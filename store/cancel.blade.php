@extends(Theme::wrapper())

@section('title')
    {!! __('client.payment_canceled') !!}
@endsection

@section('container')
    <section class="bg-white dark:bg-gray-900">
        <div class="mx-auto max-w-screen-xl px-4 py-8 lg:px-6 lg:py-16">
            <div class="mx-auto max-w-screen-sm text-center">
                <div class="mb-4 flex items-center justify-center">
                    <img src="https://media.tenor.com/WlEMaEwvewsAAAAS/crying-sad.gif" style="width: 275px">
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
