@extends(Theme::wrapper())

@section('title', __('client.invoice'))

@section('container')
<main>
<div class="grid grid-cols-12 gap-4">
  <div class="col-span-12 p-4 mx-4 mb-4 bg-white rounded-lg shadow sm:p-6 xl:p-8 dark:bg-gray-800 xl:col-start-2 xl:col-span-10 2xl:col-start-3 2xl:col-span-8 md:mx-6 lg:my-6">
      <div class="overflow-hidden p-4 space-y-6 md:p-8">
          <div class="sm:flex">
              <div class="mb-5 text-2xl font-bold sm:text-3xl sm:mb-0 dark:text-white">{!! __('client.invoice') !!} #{{  substr($payment->id, 0, 8) }} <br>
                @if($payment->status == 'paid')
                    <span class="bg-green-100 text-green-800 text-sm font-large mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{!! __('client.paid') !!}</span>
                @elseif($payment->status == 'unpaid')
                    <span class="bg-red-100 text-red-800 text-sm font-large mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">{!! __('client.unpaid') !!}</span>
                @elseif($payment->status == 'refunded')
                <span class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">{!! __('client.refunded') !!}</span>
                @endif
              </div>
              <div class="space-y-3 text-right sm:ml-auto sm:text-right flex flex-col items-end	">
                    <img src="@settings('logo')" style="width: 64px; height: 64px;">
                  <div class="space-y-1">
                      <div class="text-lg font-semibold text-gray-900 dark:text-white">@settings('app_name')</div>
                      <div class="text-sm font-normal text-gray-900 dark:text-white">@settings('company_address', '291 N 4th St, San Jose, CA 95112, USA')</div>
                  </div>
                  <div class="text-sm font-normal text-gray-500 dark:text-gray-400">{{ $payment->created_at->translatedFormat(settings('date_format', 'd M Y')) }}</div>
              </div>
          </div>
          <div class="sm:w-72">
              <div class="mb-4 text-base font-bold text-gray-900 uppercase dark:text-white">{!! __('client.bill_to') !!}</div>
              <address class="text-base font-normal text-gray-500 dark:text-gray-400">
                @if(Auth::guest() OR Auth::user()->id !== $payment->user->id)
                    {!! __('client.address_only_vissible') !!} {{ $payment->user->username }}
                @else
                  {{ $payment->user->first_name }} {{ $payment->user->last_name }} <br>
                  @isset($payment->user->address->address) {{ $payment->user->address->address }}, @endisset {{ $payment->user->address->city }} <br>
                  @isset($payment->user->address->zip_code) {{ $payment->user->address->zip_code }}, @endisset @isset($payment->user->address->region) {{ $payment->user->address->region }}, @endisset {{ $payment->user->address->country }}
                @endif
              </address>
          </div>
          <!-- Table -->
          <div class="flex flex-col my-8">
              <div class="overflow-x-auto border-b border-gray-200 dark:border-gray-600">
                  <div class="inline-block min-w-full align-middle">
                      <div class="overflow-hidden shadow">
                          <table class="min-w-full">
                              <thead class="text-gray-900 bg-gray-50 dark:text-white dark:bg-gray-700">
                                  <tr>
                                      <th scope="col" class="p-4 text-xs font-semibold tracking-wider text-left uppercase rounded-l-lg">
                                          {!! __('client.item') !!}
                                      </th>
                                      <th scope="col" class="p-4 text-xs font-semibold tracking-wider text-left uppercase">
                                          {!! __('client.price') !!}
                                      </th>
                                      <th scope="col" class="p-4 text-xs font-semibold tracking-wider text-left uppercase">
                                          {!! __('client.qty') !!}
                                      </th>
                                      <th scope="col" class="p-4 text-xs font-semibold tracking-wider text-left uppercase">
                                          {!! __('client.discounts') !!}
                                      </th>
                                      <th scope="col" class="p-4 text-xs font-semibold tracking-wider text-left uppercase rounded-r-lg">
                                          {!! __('client.total') !!}
                                      </th>
                                  </tr>
                              </thead>
                              <tbody class="text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                                  <tr>
                                      <td class="p-4 text-sm font-normal whitespace-nowrap">
                                          <div class="text-base font-semibold">{{ $payment->description }}</div>
                                          <div class="text-sm font-normal text-gray-500 dark:text-gray-400"></div>
                                      </td>
                                      <td class="p-4 text-base font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                            {{ currency('symbol') }}{{ $payment->amount }}
                                      </td>
                                      <td class="p-4 text-base font-semibold text-gray-900 whitespace-nowrap dark:text-white">
                                          1
                                      </td>
                                      <td class="p-4 text-base font-normal whitespace-nowrap">
                                          0%
                                      </td>
                                      <td class="p-4 text-base font-semibold whitespace-nowrap">
                                            {{ currency('symbol') }}{{ $payment->amount }}
                                      </td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
          <div class="space-y-3 sm:text-right sm:ml-auto sm:w-72">
              <div class="flex justify-between">
                  <div class="text-sm font-medium text-gray-500 uppercase dark:text-gray-400">{!! __('client.subtotal') !!}</div>
                  <div class="text-base font-medium text-gray-900 dark:text-white">{{ currency('symbol') }}{{ $payment->amount }}</div>
              </div>
              <div class="flex justify-between">
                  <div class="text-sm font-medium text-gray-500 uppercase dark:text-gray-400">{!! __('client.tax_rate') !!}</div>
                  <div class="text-base font-medium text-gray-900 dark:text-white">0%</div>
              </div>
              <div class="flex justify-between">
                  <div class="text-sm font-medium text-gray-500 uppercase dark:text-gray-400">{!! __('client.discounts') !!}</div>
                  <div class="text-base font-medium text-gray-900 dark:text-white">{{ currency('symbol') }}0</div>
              </div>
              <div class="flex justify-between">
                  <div class="text-base font-semibold text-gray-900 uppercase dark:text-white">{!! __('client.total') !!}</div>
                  <div class="text-base font-bold text-gray-900 dark:text-white">{{ currency('symbol') }}{{ $payment->amount }}</div>
              </div>
          </div>
          @if($payment->status == 'unpaid')
            <form class="mt-8 space-y-6" method="POST" action="{{ route('invoice.pay', ['payment' => $payment->id]) }}">
            @csrf
            <div class="sm:w-72">
                <div class="mb-4 text-base font-bold text-gray-900 uppercase dark:text-white">{!! __('client.complete_payment') !!}</div>
                    <select
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 mb-4"
                        name="gateway" tabindex="-1" aria-hidden="true" required>

                        @foreach (App\Models\Gateways\Gateway::getActive() as $gateway)
                            @if($gateway->name == 'Balance')
                                <option value="{{ $gateway->id }}" @if(Auth::user()->balance >= $payment->amount) selected @endif>Pay with Balance ({{ currency('symbol') }}{{ number_format(Auth::user()->balance, 2) }})</option>
                                @continue
                            @endif

                            <option value="{{ $gateway->id }}">{{ $gateway->name }}</option>
                        @endforeach

                    </select>
                    <div class="flex">
                        <button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Pay</button>
                        <button type="button" onclick="copy('share', '{{ route('invoice', ['payment' => $payment->id]) }}')" id="share" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">{!! __('client.share') !!}</button>
                        <a href="{{ route('invoice.download', $payment->id) }}" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">{!! __('client.sownload') !!}</a>
                    </div>
                </div>
                <div class="text-sm text-gray-500 dark:text-gray-400" style="margin-top: 5px">
                    {!! __('client.share_invoice_desc') !!}
                </div>
            </form>
        @else 
            <a href="{{ route('invoice.download', $payment->id) }}" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">{!! __('client.sownload') !!}</a>
        @endif
      </div>
  </div>
</div>
</main>

<script>

    function copy(id, text) {
        // Copy the text inside the text field
        navigator.clipboard.writeText(text);
        document.getElementById(id).innerHTML = 'Copied';
    }

    </script>
@endsection
