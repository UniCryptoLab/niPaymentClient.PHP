# UniPayment PHP Client

[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](https://github.com/UniCryptoLab/UniPaymentClient.PHP/blob/main/UniPaymentClient/LICENSE.txt)
[![Packagist](https://img.shields.io/packagist/v/unipayment/client.svg?style=flat-square)](https://packagist.org/packages/unipayment/client)

A PHP SDK for the [UniPayment Client API](https://unipayment.readme.io/reference/overview).

This SDK provides a convenient abstraction of UniPayment's Gateway API and allows developers to focus on payment
flow/e-commerce integration rather than on the specific details of client-server interaction using the raw API.

## Getting Started

[Integration Tutorial](https://bit.ly/up-help-integration)

Before using the UniPayment API, sign up for your [API key](https://console.unipayment.io/).

If you want to use the Sandbox, sign up [here](https://sandbox-console.unipayment.io/).

## Installation

### Install Composer

```bash
curl -sS https://getcomposer.org/installer | php
```

### Install via composer

Add unipayment/client into require section of composer.json

```json
{
  "require": {
    "unipayment/client": "2.*"
  }
}

```

## Initializing UniPayment SDK

```php
$configuration = new \UniPayment\SDK\Configuration();
$configuration->setClientId('your client id');
$configuration->setClientSecret('your secret key');
$configuration->setAppId('your app id');
$configuration->setIsSandbox(false);
```

Sandbox is used in the same way with is_sandbox as true.

```php
$configuration = new \UniPayment\SDK\Configuration();
$configuration->setClientId('your client id');
$configuration->setClientSecret('your secret key');
$configuration->setAppId('your app id');
$configuration->setIsSandbox(true);
$configuration->setDebug(true);        
```


## Create an invoice

> Reference：https://unipayment.readme.io/reference/create_invoice

```php
$createInvoiceRequest = new \UniPayment\SDK\Model\CreateInvoiceRequest();
$createInvoiceRequest->setAppId($configuration->getAppId());
$createInvoiceRequest->setOrderId(Uuid::uuid4());
$createInvoiceRequest->setPriceAmount(1.0);
$createInvoiceRequest->setPriceCurrency('USD');
$createInvoiceRequest->setLang("en");
$createInvoiceRequest->setExtArgs("Merchant Pass Through Data");

$billingAPI  = new \UniPayment\SDK\BillingAPI($configuration);
try{
    $createInvoiceResponse = $billingAPI->createInvoice($createInvoiceRequest);
} catch (\UniPayment\SDK\UnipaymentSDKException $e) {
   ...
}
```

### CreateInvoiceResponse

```json
{
  "msg": "",
  "code": "OK",
  "data": {
    "app_id": "df01ae1f-8c31-4ecd-8ab1-9e31289d4823",
    "payment_method_type": "UNKNOWN",
    "invoice_id": "88144dSLPujPsUJYakkJdx",
    "order_id": "ORDER_1721023791051",
    "price_amount": 2.0,
    "price_currency": "USD",
    "network": null,
    "address": null,
    "pay_amount": 0.0,
    "pay_currency": null,
    "exchange_rate": 0.0,
    "paid_amount": 0.0,
    "refunded_price_amount": 0.0,
    "create_time": "2024-07-15T06:09:54",
    "expiration_time": "2024-07-15T06:29:54",
    "confirm_speed": "Medium",
    "status": "New",
    "error_status": "None",
    "invoice_url": "https://sandbox.api.unipayment.com/i/88144dSLPujPsUJYakkJdx"
  }
}

```

## Webhook Notification
[Webhook Tutorial](https://bit.ly/up-help-webhook)

## Webhook Signature Verification

Use the below code to verify of the 'hmac_signature' which can extract from the request header

```php

use UniPayment\SDK\Utils\WebhookSignatureUtil;

//Use raw json payload (no formatting or pretty print)
$payload = 'json payload';
$secretKey = 'your secret key';
$signature = 'signature to verify';
$valid = WebhookSignatureUtil::isValid($payload, $secretKey, $signature);

```

## Run Example

1.Get source code form GitHub

``` bash
git clone https://github.com/UniCryptoLab/UniPaymentClient.PHP.git
```

2.Run project in PHPStorm

## License

MIT License

Copyright (c) 2024 UniPayment

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
