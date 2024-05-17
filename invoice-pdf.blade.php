<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title>{{ __('client.invoice_template') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        @font-face {
            font-family: 'DejaVu Sans';
            src: url('{{ storage_path("fonts/DejaVuSans.ttf") }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        body, table, th, td, div, span {
            font-family: 'DejaVu Sans', sans-serif;
        }
        .status-span {
            display: inline-block;
            background-color: #237142;
            color: #86efac;
            border-radius: 5px;
            font-size: 26px;
            text-transform: capitalize;
            line-height: 40px;
            padding: 0 10px;
            font-weight: 600;
            text-align: center;
        }
        .status-span.unpaid {
            background-color: #bf3a3a;
            color: #ffffff;
        }
    </style>
</head>

<body>
    <div class="web-container">
        <div class="page-container">
            {{ __('client.page') }}
            <span class="page"></span>
            {{ __('client.of') }}
            <span class="pages"></span>
        </div>

        <table style="width:100%; margin-bottom: 30px;">
            <tr>
                <td style="vertical-align:middle;">
                    <span class="status-span {{ $payment->status == 'unpaid' ? 'unpaid' : '' }}">
                        {{ __('client.' . $payment->status) }}
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
                    {{ $payment->user->address->company_name ?? $payment->user->fullname }}
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
                    {{ __('client.invoice_date') }}:
                    <strong>{{ $payment->created_at->translatedFormat(settings('date_format', 'd M Y')) }}</strong>
                </td>
                <td>

                </td>
            </tr>
            <tr>
                <td>
                    {{ $payment->user->email }}
                </td>
                <td>
                    {{ __('client.invoice_no') }}: <strong>{{ $payment->shortId() }}</strong>
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
                        @if ($payment->package_id !== null)
                            <img style="display: inline-block; vertical-align: middle; width: 24px; border-radius: 5px; margin-right: 5px"
                                src="{{ $payment->package->icon() }}" alt="{{ __('client.package_icon') }}">
                        @endif
                        <span style="display: inline-block; vertical-align: middle;">{{ $payment->description }}</span>
                    </td>
                    <td class="right">{{ price($payment->amount) }}</td>
                    <td class="bold">{{ price($payment->amount) }}</td>
                </tr>
            </tbody>
        </table>

        <table class="line-items-container has-bottom-border">
            <thead>
                <tr>
                    <th>{{ __('client.payment_info') }}</th>
                    <th>{{ __('client.total_due') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="payment-info">
                        <div>
                            @isset($payment->gateway['name'])
                                {{ __('client.payment_gateway') }}: <strong>{{ $payment->gateway['name'] }}</strong>
                            @endisset
                        </div>
                        <div>
                            @if ($payment->transaction_id !== null)
                                {{ __('client.transaction_id') }}: <strong>{{ $payment->transaction_id }}</strong>
                            @endif
                        </div>
                    </td>
                    <td class="large total">{{ price($payment->amount) }}</td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            <div class="footer-info">
                <span>@settings('contact_email')</span> |
                <span>@settings('app_name')</span>
            </div>
            <div class="footer-thanks">
                <span>{{ __('client.thank_you') }}</span>
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
