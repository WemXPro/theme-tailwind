<div class="relative mt-8 p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5 mb-6">
    <div class="custom-note">
        <div class="flex justify-between mb-3 rounded-t sm:mb-3">
            <div class="text-lg text-gray-900 md:text-xl dark:text-white">
                <h3 class="font-semibold">{{ __('client.configurable_options') }}</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    {{ __('client.configurable_options_desc') }}
                </p>
            </div>
        </div>
        {{-- load configurable options --}}
        @foreach($package->configOptions()->orderBy('order', 'desc')->get() as $option)
            @if($option->type == 'number')
                <div class="mb-4">
                    <label for="option-{{ $option->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        {!! $option->data['label'] ?? $option->key !!}
                    </label>
                    <div class="relative flex items-center max-w-[8rem]">
                        <button
                            type="button"
                            onclick="decrementInput('option-{{ $option->id }}')"
                            class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600
                                   hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11
                                   focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none"
                        >
                            <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="M1 1h16"/>
                            </svg>
                        </button>
                        <input
                            type="text"
                            id="option-{{ $option->id }}"
                            name="custom_option[{{ $option->key }}]"
                            min="{{ $option->data['min'] ?? '0' }}"
                            max="{{ $option->data['max'] ?? '0' }}"
                            value="{{ $option->data['default_value'] ?? '0' }}"
                            class="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm
                                   focus:ring-primary-500 focus:border-primary-500 block w-full py-2.5
                                   dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                                   dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="999"
                            required
                        >
                        <button
                            type="button"
                            onclick="incrementInput('option-{{ $option->id }}')"
                            class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600
                                   hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11
                                   focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none"
                        >
                            <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="M9 1v16M1 9h16"/>
                            </svg>
                        </button>
                    </div>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        {!! $option->data['description'] ?? '' !!}
                    </p>
                </div>
            @elseif($option->type == 'range')
                <div class="relative mb-6">
                    <label for="option-{{ $option->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        {!! $option->data['label'] ?? $option->key !!}
                    </label>
                    <div class="p-2">
                        <input
                            id="option-{{ $option->id }}"
                            type="range"
                            name="custom_option[{{ $option->key }}]"
                            value="{{ $option->data['default_value'] ?? 0 }}"
                            min="{{ $option->data['min'] ?? 0 }}"
                            max="{{ $option->data['max'] ?? 10 }}"
                            step="{{ $option->data['step'] ?? 1 }}"
                            class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
                        >
                        <div class="relative mt-2">
                            @php
                                $min = $option->data['min'] ?? 0;
                                $max = $option->data['max'] ?? 10;
                                $step = $option->data['step'] ?? 1;
                                $range = range($min + $step, $max - $step, $step);
                            @endphp
                            <span class="text-sm ml-2 text-gray-500 dark:text-gray-400
                                  absolute left-0 transform -translate-x-1/2 -bottom-6">
                                {{ $min }}
                            </span>
                            @foreach ($range as $value)
                                @php
                                    $percentage = round(($value - $min) / ($max - $min) * 100, 2);
                                @endphp
                                <span
                                    class="text-sm text-gray-500 dark:text-gray-400 absolute"
                                    style="left: {{ $percentage }}%; transform: translateX(-50%);"
                                >
                                    {{ $value }}
                                </span>
                            @endforeach
                            <span class="text-sm mr-2 text-gray-500 dark:text-gray-400
                                  absolute right-0 transform translate-x-1/2 -bottom-6">
                                {{ $max }}
                            </span>
                        </div>
                    </div>
                    <div class="mt-8">
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            {!! $option->data['description'] ?? '' !!}
                        </p>
                    </div>
                </div>
            @elseif($option->type == 'select')
                <div class="mb-4">
                    <label for="option-{{ $option->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        {!! $option->data['label'] ?? $option->key !!}
                    </label>
                    <select
                        id="option-{{ $option->id }}"
                        name="custom_option[{{ $option->key }}]"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                               focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5
                               dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                               dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    >
                        @foreach($option->data['options'] as $key => $selectOption)
                            <option
                                value="{{ $selectOption['value'] }}"
                                data-select-option-value="{{ $selectOption['value'] }}"
                                data-select-option-unitprice="{{ $selectOption['monthly_price'] }}"
                            >
                                {{ $selectOption['name'] }}
                                @ {{ price($selectOption['monthly_price'] / 30 * $package->prices->first()->period) }}
                                {{ $package->prices->first()->periodToHuman() }}
                            </option>
                        @endforeach
                    </select>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        {!! $option->data['description'] ?? '' !!}
                    </p>
                </div>
            @elseif($option->type == 'text')
                <div class="mb-4">
                    <label for="helper-text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        {!! $option->data['label'] ?? $option->key !!}
                    </label>
                    <input
                        type="{{ $option->data['type'] ?? 'text' }}"
                        name="custom_option[{{ $option->key }}]"
                        value="{{ $option->data['default_value'] ?? '' }}"
                        placeholder="{{ $option->data['placeholder'] ?? '' }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                               focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5
                               dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                               dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    >
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        {!! $option->data['description'] ?? '' !!}
                    </p>
                </div>
            @endif
        @endforeach
    </div>
</div>
