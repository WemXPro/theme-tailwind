@extends('layouts::wrapper')
@section('title', $package->name)

@section('container')
    @include('theme::store.checkout.top-affiliate', ['package' => $package])

    <form action="{{ route('payment.package', ['package' => $package->id]) }}" method="POST" id="price">
        @csrf

        <div class="flex flex-wrap">
            {{-- Left column (2/3) --}}
            <div class="w-full px-4 sm:w-1/2 md:w-2/3 lg:w-2/3">

                {{-- Package description block + selection of period/prices --}}
                @include('theme::store.checkout.package-details', ['package' => $package])

                {{-- If you need a domain --}}
                @if ($package->require_domain)
                    @include('theme::store.checkout.domain', ['package' => $package])
                @endif

                {{-- Configurable options (if any) --}}
                @if ($package->configOptions->count() > 0)
                    @include('theme::store.checkout.config-options', ['package' => $package])
                @endif

                {{-- If the service has additional fields --}}
                @if ($package->service()->hasCheckoutConfig($package))
                    @include('theme::store.checkout.service-checkout-config', ['package' => $package])
                @else
                    @includeIf(theme()::serviceView($package->service, 'props.checkout-options'))
                @endif

                {{-- Payment methods (coupon, gateway) --}}
                @include('theme::store.checkout.payment-methods', ['package' => $package])

                {{-- Taxes (if enabled) --}}
                @if (settings('taxes'))
                    @include('theme::store.checkout.taxes-details', ['package' => $package])
                @endif

                {{-- Additional notes (if allowed) --}}
                @if ($package->allow_notes)
                    @include('theme::store.checkout.custom-notes', ['package' => $package])
                @endif
            </div>

            {{-- The right column (1/3) is the summary of the order --}}
            <div class="w-full px-4 sm:w-1/2 md:w-1/3 lg:w-1/3">
                @include('theme::store.checkout.order-summary', ['package' => $package])
            </div>
        </div>
    </form>

    {{-- JS logic for price calculation and other scripts --}}
    @include('theme::store.checkout.checkout-scripts', ['package' => $package])
@endsection
