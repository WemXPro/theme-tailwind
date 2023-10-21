@props([
    'order' => $order,
    'data' => $order->data,
])

<a href="{{ route('service', ['order' => $order->id, 'page' => 'manage']) }}"
    class="py-2 px-3 flex items-center text-sm font-medium text-center text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
        viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
        <path
            d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
        <path fill-rule="evenodd"
            d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
            clip-rule="evenodd" />
    </svg>
    {!! __('client.manage') !!}
</a>

@foreach($order->package->service()->getServiceButtons($order)->all() as $key => $button)
    @if(empty($button))
        @continue;
    @endif
    <a href="{{ $button['href'] ?? '#' }}" target="{{ $button['target'] ?? '' }}"
    class="text-white bg-{{$button['color']}}-700 hover:bg-{{$button['color']}}-800 focus:ring-4 focus:ring-{{$button['color']}}-300 font-medium rounded-lg text-sm px-3 py-2 dark:bg-{{$button['color']}}-600 dark:hover:bg-{{$button['color']}}-700 focus:outline-none dark:focus:ring-{{$button['color']}}-800">
    <span class="font-xl mr-1">{!! $button['icon'] ?? '' !!}</span>
    {!! $button['name'] !!}
    </a>
@endforeach

@include(Theme::path('components.orders.renew-modal'), $order)
@include(Theme::path('components.orders.cancel-modal'), $order)
