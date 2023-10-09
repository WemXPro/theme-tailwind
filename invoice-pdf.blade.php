<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title>Invoice Template</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<div class="web-container">

<div class="page-container">
  Page
  <span class="page"></span>
  of
  <span class="pages"></span>
</div>

<table style="width:100%; margin-bottom: 30px;">
    <tr>
        <td style="text-align:center; vertical-align:middle;">
            <span style="
                width: 128px;
                height: 40px;
                background-color: @if($payment->status == 'unpaid') #bf3a3a @else #237142 @endif;
                color: @if($payment->status == 'unpaid') #ffffff @else #86efac @endif;
                display: block;
                border-radius: 5px;
                font-size: 26px;
                text-transform: capitalize;
                line-height: 40px;
                padding-bottom: 5px;
                font-weight: 600;
            ">
                {{ $payment->status }}
            </span>
        </td>
        <td style="vertical-align:end;">
            <img style="width: 48px; border-radius: 5px;" src="@settings('logo', 'https://dev2.wemx.net/static/wemx.png')">
        </td>
    </tr>
</table>


<table class="invoice-info-container">
  <tr>
    <td rowspan="2" class="client-name">
      {{ $payment->user->first_name }} {{ $payment->user->last_name }}
    </td>
    <td>
      @settings('app_name')
    </td>
  </tr>
  <tr>
    <td>
        @settings('company_address', '291 N 4th St, San Jose, CA 95112, USA')
    </td>
  </tr>
  <tr>
    <td>
      Invoice Date: <strong>{{ $payment->created_at->format(settings('date_format', 'd M Y')) }}</strong>
    </td>
    <td>
        
    </td>
  </tr>
  <tr>
    <td>
       {{ $payment->user->email }}
    </td>
    <td>
        Invoice No: <strong>{{ $payment->shortId() }}</strong>
    </td>
  </tr>
</table>


<table class="line-items-container">
  <thead>
    <tr>
      <th class="heading-quantity">{!! __('client.qty') !!}</th>
      <th class="heading-description">{!! __('client.item') !!}</th>
      <th class="heading-price">{!! __('client.price') !!}</th>
      <th class="heading-subtotal">{!! __('client.total') !!}</th>
    </tr>
  </thead>
  <tbody>
    <tr>
        <td>1</td>
        <td>
            @if($payment->package_id !== NULL)
                <img style="display: inline-block; vertical-align: middle; width: 24px; border-radius: 5px; margin-right: 5px" src="{{ $payment->package->icon() }}" alt="Package Icon">
            @endif
            <span style="display: inline-block; vertical-align: middle;">{{ $payment->description }}</span>
        </td>
        <td class="right">{{ currency('symbol') }}{{ number_format($payment->amount, 2) }}</td>
        <td class="bold">{{ currency('symbol') }}{{ number_format($payment->amount, 2) }}</td>
      </tr>
  </tbody>
</table>


<table class="line-items-container has-bottom-border">
  <thead>
    <tr>
      <th>Payment Info</th>
      <th>Total Due</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="payment-info">
        <div>
          @isset($payment->gateway['name']) Payment Gateway: <strong>{{ $payment->gateway['name'] }}</strong> @endisset
        </div>
        <div>
        @if($payment->transaction_id !== NULL)
            Transaction ID: <strong>{{ $payment->transaction_id }}</strong>
        @endif
        </div>
      </td>
      <td class="large total">{{ currency('symbol') }}{{ number_format($payment->amount, 2) }}</td>
    </tr>
  </tbody>
</table>

<div class="footer">
  <div class="footer-info">
    <span>@settings('contact_email')</span> |
    <span>@settings('app_name')</span>
  </div>
  <div class="footer-thanks">
    <span>Thank you!</span>
  </div>
</div>

</div>

</body>
</html>

<style>
/*
  Common invoice styles. These styles will work in a browser or using the HTML
  to PDF anvil endpoint.
*/

body {
  font-size: 16px;
  font-family: sans-serif;
}

table {
  width: 100%;
  border-collapse: collapse;
}

table tr td {
  padding: 0;
}

table tr td:last-child {
  text-align: right;
}

.bold {
  font-weight: bold;
}

.right {
  text-align: right;
}

.large {
  font-size: 1.75em;
}

.total {
  font-weight: bold;
}

.logo-container {
  margin: 20px 0 30px 0;
}

.invoice-info-container {
  font-size: 0.875em;
}
.invoice-info-container td {
  padding: 4px 0;
}

.client-name {
  font-size: 1.5em;
  vertical-align: top;
}

.line-items-container {
  margin: 70px 0;
  font-size: 0.875em;
}

.line-items-container th {
  text-align: left;
  color: #999;
  border-bottom: 2px solid #ddd;
  padding: 10px 0 15px 0;
  font-size: 0.75em;
  text-transform: uppercase;
}

.line-items-container th:last-child {
  text-align: right;
}

.line-items-container td {
  padding: 15px 0;
}

.line-items-container tbody tr:first-child td {
  padding-top: 25px;
}

.line-items-container.has-bottom-border tbody tr:last-child td {
  padding-bottom: 25px;
  border-bottom: 2px solid #ddd;
}

.line-items-container.has-bottom-border {
  margin-bottom: 0;
}

.line-items-container th.heading-quantity {
  width: 50px;
}
.line-items-container th.heading-price {
  text-align: right;
  width: 100px;
}
.line-items-container th.heading-subtotal {
  width: 100px;
}

.payment-info {
  width: 38%;
  font-size: 0.75em;
  line-height: 1.5;
}

.footer {
  margin-top: 100px;
}

.footer-thanks {
  font-size: 1.125em;
}

.footer-thanks img {
  display: inline-block;
  position: relative;
  top: 1px;
  width: 16px;
  margin-right: 4px;
}

.footer-info {
  float: right;
  margin-top: 5px;
  font-size: 0.75em;
  color: #ccc;
}

.footer-info span {
  padding: 0 5px;
  color: black;
}

.footer-info span:last-child {
  padding-right: 0;
}

.page-container {
  display: none;
}
</style>