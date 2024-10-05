@props([
    'order' => $order,
    'data' => $order->data,
])

@foreach ($order->package->service()->getServiceButtons($order)->all() as $key => $button)
    @if (empty($button))
        @continue;
    @endif
    <{{ $button['tag'] ?? 'a' }} href="{{ $button['href'] ?? '#' }}" target="{{ $button['target'] ?? '' }}"
        @isset($button['onclick']) onclick="{{ $button['onclick'] }}" @endisset
        class="bg-{{ $button['color'] }}-700 hover:bg-{{ $button['color'] }}-800 focus:ring-{{ $button['color'] }}-300 dark:bg-{{ $button['color'] }}-600 dark:hover:bg-{{ $button['color'] }}-700 dark:focus:ring-{{ $button['color'] }}-800 rounded-lg px-3 py-2 text-sm font-medium text-white focus:outline-none focus:ring-4">
        <span class="font-xl mr-1">{!! $button['icon'] ?? '' !!}</span>
        {!! $button['name'] !!}
        </{{ $button['tag'] ?? 'a' }}>
@endforeach

@if (request('page') !== 'manage')
    <a href="{{ route('service', ['order' => $order->id, 'page' => 'manage']) }}"
        class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 flex items-center rounded-lg px-3 py-2 text-center text-sm font-medium text-white focus:outline-none focus:ring-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 h-4 w-4" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                clip-rule="evenodd" />
        </svg>
        {!! __('client.manage') !!}
    </a>
@endif

@if ($order->getService()->canLoginToPanel())
    <a href="{{ route('service', ['order' => $order->id, 'page' => 'login-to-panel']) }}" target="_blank"
        class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 flex items-center rounded-lg px-3 py-2 text-center text-sm font-medium text-white focus:outline-none focus:ring-4">
        {!! __('client.login_to_panel') !!}
    </a>
@endif

{{-- and $order->package->settings('allow_upgrading', true) --}}
@if ($order->getService()->canUpgrade())
    @if($order->status !== 'terminated')
        @include(Theme::path('components.orders.upgrade-drawer'), $order)
    @endif
@endif

@if ($order->isRecurring())
    @if($order->status !== 'terminated')
        @include(Theme::path('components.orders.renew-modal'), $order)
    @endif

    @if($order->package->settings('allow_cancellation', true))
        @if($order->status !== 'terminated')
            @include(Theme::path('components.orders.cancel-modal'), $order)
        @endif
    @endif
@endif
