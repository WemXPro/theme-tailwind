@extends(Theme::wrapper())

@section('title')
    {!! __('client.payment_canceled') !!}
@endsection

@section('container')
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            <div class="mx-auto max-w-screen-sm text-center">
                <div class="flex items-center justify-center mb-4">
                    <img src="https://media.tenor.com/WlEMaEwvewsAAAAS/crying-sad.gif" style="width: 275px">
                </div>
                <p class="mb-4 text-3xl tracking-tight font-bold text-gray-900 md:text-4xl dark:text-white">{!! __('client.payment_canceled') !!}</p>
                <p class="mb-4 text-lg font-light text-gray-500 dark:text-gray-400">{!! __('client.payment_canceled_desc') !!}</p>
                <a href="{{route('dashboard')}}"
                   class="inline-flex text-white bg-primary-600 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-primary-900 my-4">{!! __('client.back_dashboard') !!}</a>
                <a href="{{ route('invoice', $payment->id) }}"
                   class="inline-flex text-white bg-primary-600 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-primary-900 my-4">{!! __('client.view_invoice') !!}</a>
            </div>
        </div>
    </section>
@endsection
