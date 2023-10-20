@props(['button', 'order'])

@php
    if (function_exists($button['function'])) {
        if (!empty($button['arg'])){
            $response = call_user_func($button['function'], $order->{$button['arg']});
        } else {
            $response = call_user_func($button['function']);
        }

        $button['name'] = $button['name'] == 'response' ? $response : $button['name'];
    } else {
        $button['name'] = 'Function not found';
    }
@endphp

<a href="{{ $button['href'] ?? '#' }}" target="{{ $button['target'] ?? '' }}" @if($button['onclick'] == 'copy') onclick="copyToClipboard('{!! $button['name'] !!}')" @endif
   class="text-white bg-{{$button['color']}}-700 hover:bg-{{$button['color']}}-800 focus:ring-4 focus:ring-{{$button['color']}}-300 font-medium rounded-lg text-sm px-3 py-2 dark:bg-{{$button['color']}}-600 dark:hover:bg-{{$button['color']}}-700 focus:outline-none dark:focus:ring-{{$button['color']}}-800">
    <span class="font-xl mr-1">{!! $button['icon'] ?? '' !!}</span>
    {!! $button['name'] !!}
</a>


<script>
    function copyToClipboard(text) {
        var textarea = document.createElement("textarea");
        textarea.textContent = text;
        document.body.appendChild(textarea);
        textarea.select();
        try {
            document.execCommand('copy');
            alert('{!! __('client.copied_successfully') !!}');
        } catch (err) {
            console.error('Error in execCommand: ', err);
        } finally {
            document.body.removeChild(textarea);
        }
    }
</script>
