@extends(Theme::wrapper())

@section('title')
    {!! __('client.services') !!}
@endsection

@section('container')

        <section class="bg-white dark:bg-gray-900">
            <div class="py-8 px-4 mx-auto max-w-screen-xl lg:px-6">
                <div class="mx-auto max-w-screen-md text-center mb-8 lg:mb-12">
                    <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white"{!! __('client.pricing_for') !!} {{ $category->name }}</h2>
                </div>
                <div class="space-y-8 lg:grid lg:grid-cols-3 sm:gap-6 xl:gap-10 lg:space-y-0">

                    @foreach ($category->packages as $package)

                        @if($package->status == 'unlisted' OR $package->status == 'inactive' OR $package->status == 'restricted')
                            @if($package->status == 'restricted')
                                @if(Auth::guest() OR !Auth::user()->is_admin())
                                    @continue
                                @endif
                            @else
                                @continue
                            @endif
                        @endif

                        <div
                            class="flex flex-col p-6 mx-auto max-w-lg text-center text-gray-900 bg-white rounded-lg border border-gray-100 shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                            <h3 class="mb-4 text-2xl font-semibold">{{ $package->name }}</h3>
                            <div class="overflow-hidden flex items-center justify-center mb-5 rounded-lg">
                                <img class="w-full h-auto" src="{{ asset('storage/products/' . $package->icon) }}" alt="icon"/>
                            </div>

                            <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400">
                                {!! __('client.price_block_desc', [
                                                'period' => mb_strtolower($package->prices->first()->period()),
                                                'total_price' => $package->prices->first()->totalPrice(),
                                                'renewal_price' => $package->prices->first()->renewal_price,
                                                'per_period' => mb_strtolower($package->prices->first()->periodToHuman()),
                                                'symbol' => currency('symbol')])
                                !!}
                            </p>
                            <div class="flex justify-center items-baseline my-8">
                                <span class="mr-2 text-5xl font-extrabold">{{ currency('symbol') }}{{ $package->prices->first()->renewal_price }}</span>
                                <span class="text-gray-500 dark:text-gray-400">/{{ $package->prices->first()->periodToHuman() }}</span>
                            </div>
                            <!-- List -->
                            <ul role="list" class="mb-8 space-y-4 text-left">


                                @foreach($package->features()->orderBy('order', 'desc')->get() as $feature)
                                <li class="flex items-center space-x-3">
                                    <!-- Icon -->
                                    <span class="text-{{$feature->color}}-500 dark:text-{{$feature->color}}-500 bx-sm">
                                        {!! $feature->icon !!}
                                    </span>
                                    <span>{{ $feature->description }}</span>
                                </li>
                                @endforeach


                            </ul>
                            <a href="{{ route('store.package', ['package' => $package->id]) }}"
                                class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white  dark:focus:ring-primary-900">
                                {!! __('client.get_started') !!}
                            </a>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>

@endsection
