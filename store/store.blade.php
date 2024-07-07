@extends(Theme::wrapper())

@section('title', __('client.pricing_for_service', ['service' => $category->name]))

@section('container')
    <section>
        <div class="mx-auto max-w-screen-xl px-4 py-8 lg:px-6">
            <div class="mx-auto mb-8 max-w-screen-md text-center lg:mb-12">
                <h2 class="mb-4 text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white">{!! __('client.pricing_for_service', ['service' => $category->name]) !!}</h2>
            </div>
            <div class="space-y-8 sm:gap-6 lg:grid lg:grid-cols-3 lg:space-y-0 xl:gap-10">
                @foreach ($category->packages as $package)
                    @if ($package->status == 'unlisted' or $package->status == 'inactive' or $package->status == 'restricted')
                        @if ($package->status == 'restricted')
                            @if (Auth::guest() or !Auth::user()->is_admin())
                                @continue
                            @endif
                        @else
                            @continue
                        @endif
                    @endif

                    <div
                        class="mx-auto flex max-w-lg flex-col rounded-lg border border-gray-100 bg-white p-6 text-center text-gray-900 shadow dark:border-gray-600 dark:bg-gray-800 dark:text-white xl:p-8">
                        <h3 class="mb-4 text-2xl font-semibold">{{ $package->name }}</h3>
                        <div class="mb-5 flex items-center justify-center overflow-hidden rounded-lg">
                            <img class="h-auto w-full" src="{{ asset('storage/products/' . $package->icon) }}" alt="icon" />
                        </div>

                        <p class="font-light text-gray-500 dark:text-gray-400 sm:text-lg">
                            {!! __('client.price_block_desc', [
                                'period' => mb_strtolower($package->prices->first()->period()),
                                'total_price' => price($package->prices->first()->totalPrice()),
                                'renewal_price' => price($package->prices->first()->renewal_price),
                                'per_period' => mb_strtolower($package->prices->first()->period()),
                            ]) !!}
                        </p>
                        <div class="my-8 flex items-baseline justify-center">
                            <span
                                class="mr-2 text-5xl font-extrabold">{{ price($package->prices->first()->renewal_price) }}</span>
                            <span class="text-gray-500 dark:text-gray-400">/{{ $package->prices->first()->periodToHuman() }}</span>
                        </div>

                        <!-- List -->
                        <ul role="list" class="mb-8 space-y-4 text-left">
                            @foreach ($package->features()->orderBy('order', 'desc')->get() as $feature)
                                <li class="flex items-center space-x-3">
                                    <!-- Icon -->
                                    <span class="text-{{ $feature->color }}-500 dark:text-{{ $feature->color }}-500 bx-sm">
                                        {!! $feature->icon !!}
                                    </span>
                                    <span>{{ $feature->description }}</span>
                                </li>
                            @endforeach
                        </ul>

                        <a href="{{ route('store.package', ['package' => $package->id]) }}"
                            class="bg-primary-600 hover:bg-primary-700 focus:ring-primary-200 dark:focus:ring-primary-900 rounded-lg px-5 py-2.5 text-center text-sm font-medium text-white focus:ring-4 dark:text-white mt-auto">
                            {!! __('client.get_started') !!}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
