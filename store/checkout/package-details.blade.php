<div class="relative rounded-lg bg-white p-4 shadow dark:bg-gray-800 sm:p-5">
    <!-- Package title and description -->
    <div class="mb-4 flex justify-between rounded-t sm:mb-4">
        <div class="text-lg text-gray-900 dark:text-white md:text-xl">
            <h3 class="font-semibold">
                {{ $package->category->name }} {{ $package->name }}
            </h3>
            <p class="text-small text-base text-gray-500 dark:text-gray-400">
                {!! $package->description !!}
            </p>
        </div>
        <div></div>
    </div>

    <!-- Features -->
    <ul role="list" class="mb-8 space-y-4 text-left">
        <div class="grid grid-cols-3 gap-4">
            @foreach ($package->features()->orderBy('order', 'desc')->get() as $feature)
                <li class="flex items-center space-x-3">
                    <span class="text-{{ $feature->color }}-500 dark:text-{{ $feature->color }}-500 bx-sm">
                        {!! $feature->icon !!}
                    </span>
                    <span class="text-gray-500 dark:text-gray-400">
                        {{ $feature->description }}
                    </span>
                </li>
            @endforeach
        </div>
    </ul>
</div>

<!-- Вибір періоду/цін -->
<ul class="mb-5 mt-8 grid w-full gap-6 md:grid-cols-3">
    @foreach ($package->prices->where('is_active', true) as $price)
        <li>
            <input
                type="radio"
                id="price-radio-{{ $price->id }}"
                name="price_id"
                value="{{ $price->id }}"
                class="peer hidden"
                required
                @if ($price->id == request()->input('price', $package->prices->first()->id)) checked @endif
            >
            <label
                for="price-radio-{{ $price->id }}"
                class="dark:peer-checked:text-primary-500 peer-checked:border-primary-600 peer-checked:text-primary-600
                       inline-flex w-full cursor-pointer items-center justify-between rounded-lg border
                       border-gray-200 bg-white p-5 text-gray-500 hover:bg-gray-100 hover:text-gray-600
                       dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700
                       dark:hover:text-gray-300"
            >
                <div class="block">
                    <div class="w-full text-lg font-semibold">
                        {{ price($price->renewal_price) }} / {{ $price->periodToHuman() }}
                    </div>
                    <div class="w-full">
                        @if ($price->type == 'recurring')
                            {!! __('client.price_block_desc', [
                                'period' => mb_strtolower($price->period()),
                                'total_price' => price($price->totalPrice()),
                                'renewal_price' => price($price->renewal_price),
                                'per_period' => mb_strtolower($price->period()),
                                'symbol' => currency('symbol'),
                            ]) !!}
                        @else
                            {!! __('client.price_onetime_block_desc', ['price' => price($price->price)]) !!}
                        @endif

                        @isset($price->data['badge'])
                            <span class="bg-primary-100 text-primary-800 dark:bg-primary-900 dark:text-primary-300
                                       inline-block rounded px-2.5 py-0.5 text-xs font-medium">
                                {{ $price->data['badge'] }}
                            </span>
                        @endisset
                    </div>
                </div>
            </label>
        </li>
    @endforeach
</ul>
