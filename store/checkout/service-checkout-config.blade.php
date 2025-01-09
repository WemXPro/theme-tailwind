<div class="relative mb-6 mt-8 rounded-lg bg-white p-4 shadow dark:bg-gray-800 sm:p-5">
    <div class="custom-note">
        <div class="mb-3 flex justify-between rounded-t sm:mb-3">
            <div class="text-lg text-gray-900 dark:text-white md:text-xl">
                <h3 class="font-semibold">{!! __('client.custom_options') !!}</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    {!! __('client.custom_options_desc') !!}
                </p>
            </div>
            <div></div>
        </div>
        <div class="flex flex-wrap">
            @foreach ($package->service()->getCheckoutConfig($package)->all() ?? [] as $name => $field)
                <div
                    class="@isset($field['col']) {{ $field['col'] }} @else w-1/2 p-2 @endisset"
                    style="display: flex; flex-direction: column;"
                >
                    <label class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                        {!! $field['name'] !!}
                        @if (isset($field['required']) && $field['required'])
                            <span class="text-red-500">*</span>
                        @endif
                    </label>
                    @if ($field['type'] == 'select')
                        <select
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm
                                   text-gray-900 focus:border-primary-500 focus:ring-primary-500
                                   dark:border-gray-600 dark:bg-gray-700 dark:text-white
                                   dark:placeholder-gray-400 dark:focus:border-primary-500
                                   dark:focus:ring-primary-500"
                            tabindex="-1" aria-hidden="true"
                            name="{{ $field['key'] }}"
                            id="{{ $field['key'] }}"
                            @if (isset($field['disabled']) and $field['disabled']) disabled @endif
                            @if (isset($field['multiple']) and $field['multiple']) multiple @endif
                        >
                            @foreach ($field['options'] ?? [] as $k => $opt)
                                @php
                                    // Можливо, деякі опції мають дод. параметри (disabled)
                                    $optName = is_array($opt) ? $opt['name'] : $opt;
                                    $optDisabled = is_array($opt) && ($opt['disabled'] ?? false);
                                @endphp
                                <option
                                    value="{{ $k }}"
                                    @if ($optDisabled) disabled @endif
                                    @if (in_array($k, (array) getValueByKey($field['key'], $package->data, $field['default_value'] ?? '')))
                                        selected
                                    @endif
                                >
                                    {{ $optName }}
                                </option>
                            @endforeach
                        </select>
                    @elseif($field['type'] == 'bool')
                        <label class="relative mt-2 inline-flex cursor-pointer items-center">
                            @if ($field['required'])
                                <input type="hidden" name="{{ $field['key'] }}" value="0">
                            @endif
                            <input
                                type="checkbox"
                                name="{{ $field['key'] }}"
                                value="1"
                                class="peer sr-only"
                                @if (getValueByKey($field['key'], $package->data, $field['default_value'] ?? '0')) checked @endif
                                @if (isset($field['disabled']) and $field['disabled']) disabled @endif
                            >
                            <div
                                class="peer h-6 w-11 rounded-full bg-gray-200 after:absolute after:left-[2px]
                                       after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border
                                       after:border-gray-300 after:bg-white after:transition-all after:content-['']
                                       peer-checked:bg-primary-600 peer-checked:after:translate-x-full
                                       peer-checked:after:border-white peer-focus:outline-none peer-focus:ring-4
                                       peer-focus:ring-primary-300 dark:border-gray-600 dark:bg-gray-700
                                       dark:peer-focus:ring-primary-800"
                            >
                            </div>
                            <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                                {!! $field['name'] !!}
                            </span>
                        </label>
                    @else
                        <input
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm
                                   text-gray-900 focus:border-primary-500 focus:ring-primary-500
                                   dark:border-gray-600 dark:bg-gray-700 dark:text-white
                                   dark:placeholder-gray-400 dark:focus:border-primary-500
                                   dark:focus:ring-primary-500"
                            type="{{ $field['type'] }}"
                            name="{{ $field['key'] }}"
                            id="{{ $field['key'] }}"
                            @isset($field['min']) min="{{ $field['min'] }}" @endisset
                            @isset($field['max']) max="{{ $field['max'] }}" @endisset
                            value="{{ getValueByKey($field['key'], $package->data, $field['default_value'] ?? '') }}"
                            placeholder="@isset($field['placeholder']){{ $field['placeholder'] }} @else{{ $field['name'] }} @endisset"
                            @if (in_array('required', $field['rules'] ?? [])) required @endif
                            @if (isset($field['disabled']) and $field['disabled']) disabled @endif
                        >
                    @endif
                    <small class="text-muted mt-2 text-sm text-gray-500 dark:text-gray-400">
                        {!! $field['description'] !!}
                    </small>
                </div>
            @endforeach
        </div>
    </div>
</div>
