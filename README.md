# UniPayment PHP Client

[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](https://github.com/UniCryptoLab/UniPaymentClient.PHP/blob/main/UniPaymentClient/LICENSE.txt)
[![Packagist](https://img.shields.io/packagist/v/unipayment/client.svg?style=flat-square)](https://packagist.org/packages/unipayment/client)

A PHP SDK for the [UniPayment Client API](https://unipayment.readme.io/reference/overview).

This SDK provides a convenient abstraction of UniPayment's Gateway API and allows developers to focus on payment
flow/e-commerce integration rather than on the specific details of client-server interaction using the raw API.

## Getting Started

[Integrate Tutorial](https://help.unipayment.io/en/articles/7851188-integrate-with-payment-gateway)

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

## Authentication

> Reference：https://unipayment.readme.io/reference/authentication

### Obtaining An Access Token

To authenticate your application, you need to obtain an access token by making a request to our OAuth 2.0 token
endpoint. This request must include your client_id, client_secret, and the grant_type.

> How to obtain an access token: https://unipayment.readme.io/reference/access-token

## Create an invoice

> Reference：https://unipayment.readme.io/reference/create_invoice

```php
$client_id='your client id'
$client_secret='your client secret'
$app_id = 'your payment app id'

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

## Handle IPN

> Reference：https://unipayment.readme.io/reference/ipn-check

> Invoice Status: https://unipayment.readme.io/reference/invoice-status

IPNs (Instant Payment Notifications) are sent to the notify_url when order status is changed to paid, confirmed and
complete.

```php

$notify='{"ipn_type":"invoice","event":"invoice_created","app_id":"cee1b9e2-d90c-4b63-9824-d621edb38012","invoice_id":"12wQquUmeCPUx3qmp3aHnd","order_id":"ORDER_123456","price_amount":2.0,"price_currency":"USD","network":null,"address":null,"pay_currency":null,"pay_amount":0.0,"exchange_rate":0.0,"paid_amount":0.0,"confirmed_amount":0.0,"refunded_price_amount":0.0,"create_time":"2022-09-14T04:57:54.5599307Z","expiration_time":"2022-09-14T05:02:54.559933Z","status":"New","error_status":"None","ext_args":"Merchant Pass Through Data","transactions":null,"notify_id":"fd58cedd-67c6-4053-ae65-2f6fb09a7d2c","notify_time":"0001-01-01T00:00:00"}';

$commonAPI = new \UniPayment\SDK\CommonAPI($configuration);
$response = $commonAPI->checkIpn($notify);

```

IPN notify

``` json
{
  "ipn_type": "invoice",
  "event": "invoice_expired",
  "app_id": "cee1b9e2-d90c-4b63-9824-d621edb38012",
  "invoice_id": "3Q7fyLnB2YNhUDW1fFNyEz",
  "order_id": "20",
  "price_amount": 6.0,
  "price_currency": "SGD",
  "network": null,
  "address": null,
  "pay_currency": null,
  "pay_amount": 0.0,
  "exchange_rate": 0.0,
  "paid_amount": 0.0,
  "confirmed_amount": 0.0,
  "refunded_price_amount": 0.0,
  "create_time": "2022-09-12T03:36:03",
  "expiration_time": "2022-09-12T03:41:03",
  "status": "Expired",
  "error_status": "None",
  "ext_args": null,
  "transactions": null,
  "notify_id": "8ccd2b61-226b-48e5-99b8-acb1f350313e",
  "notify_time": "2022-09-12T03:56:10.5852752Z"
}
```

## Webhook Signature Verification

See https://unipayment.readme.io/reference/webhook

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
