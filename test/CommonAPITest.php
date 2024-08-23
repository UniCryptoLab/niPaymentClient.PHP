<?php

namespace UniPayment\SDK;

class CommonAPITest extends BaseTest
{

    /**
     * Test case for 'GET' ping
     * @throws UnipaymentSDKException
     */
    public function testGetPing()
    {
        $pingResponse = $this->commonAPI->ping();
        $this->assertNotNull($pingResponse);
        $this->logResponse($pingResponse);
        $this->assertEquals('OK', $pingResponse->getCode());
        $this->assertEquals('pong', $pingResponse->getMsg());
    }

    /**
     * Test case for 'POST' ping
     * @throws UnipaymentSDKException
     */
    public function testPostPing()
    {
        $pingResponse = $this->commonAPI->ping(true);
        $this->assertNotNull($pingResponse);
        $this->logResponse($pingResponse);
        $this->assertEquals('OK', $pingResponse->getCode());
        $this->assertEquals('pong', $pingResponse->getMsg());
    }

    /**
     * Test case for queryIps
     * @throws UnipaymentSDKException
     */
    public function testQueryIps()
    {
        $queryIpsResponse = $this->commonAPI->queryIps();
        $this->assertNotNull($queryIpsResponse);
        $this->logResponse($queryIpsResponse);
        $this->assertEquals('OK', $queryIpsResponse->getCode());
        $this->assertNotNull($queryIpsResponse->getData());
    }

    /**
     * Test case for getCurrencies
     * @throws UnipaymentSDKException
     */
    public function testGetCurrencies()
    {
        $getCurrenciesResponse = $this->commonAPI->getCurrencies();
        $this->assertNotNull($getCurrenciesResponse);
        $this->logResponse($getCurrenciesResponse);
        $this->assertEquals('OK', $getCurrenciesResponse->getCode());
        $this->assertEquals('Australian Dollar', $getCurrenciesResponse->getData()[0]->getName());
    }

    /**
     * Test case for getExchangeRateByCurrencyPair
     * @throws UnipaymentSDKException
     */
    public function testGetExchangeRateByCurrencyPair()
    {
        $getExchangeRateByCurrencyPairResponse = $this->commonAPI->getExchangeRateByCurrencyPair('USD', 'BTC');
        $this->assertNotNull($getExchangeRateByCurrencyPairResponse);
        $this->logResponse($getExchangeRateByCurrencyPairResponse);
        $this->assertEquals('OK', $getExchangeRateByCurrencyPairResponse->getCode());
        $this->assertEquals('BTC', $getExchangeRateByCurrencyPairResponse->getData()->getFrom());
    }

    /**
     * Test case for getExchangeRateByFiatCurrency
     * @throws UnipaymentSDKException
     */
    public function testGetExchangeRateByFiatCurrency()
    {
        $getExchangeRateByFiatCurrencyResponse = $this->commonAPI->getExchangeRateByFiatCurrency('USD');
        $this->assertNotNull($getExchangeRateByFiatCurrencyResponse);
        $this->logResponse($getExchangeRateByFiatCurrencyResponse);
        $this->assertEquals('OK', $getExchangeRateByFiatCurrencyResponse->getCode());
        $this->assertNotNull($getExchangeRateByFiatCurrencyResponse->getData());
    }

    /**
     * Test case for checkIpn
     * @throws UnipaymentSDKException
     */
    public function testCheckIpn()
    {
        $body = '{
          "ipn_type": "invoice",
          "event": "invoice_created",
          "app_id": "cee1b9e2-d90c-4b63-9824-d621edb38012",
          "invoice_id": "12wQquUmeCPUx3qmp3aHnd",
          "order_id": "ORDER_123456",
          "price_amount": 2.0,
          "price_currency": "USD",
          "network": null,
          "address": null,
          "pay_currency": null,
          "pay_amount": 0.0,
          "exchange_rate": 0.0,
          "paid_amount": 0.0,
          "confirmed_amount": 0.0,
          "refunded_price_amount": 0.0,
          "create_time": "2022-09-14T04:57:54.5599307Z",
          "expiration_time": "2022-09-14T05:02:54.559933Z",
          "status": "New",
          "error_status": "None",
          "ext_args": "Merchant Pass Through Data",
          "transactions": null,
          "notify_id": "fd58cedd-67c6-4053-ae65-2f6fb09a7d2c",
          "notify_time": "0001-01-01T00:00:00"
        }';
        $checkIpnResponse = $this->commonAPI->checkIpn($body);
        $this->assertNotNull($checkIpnResponse);
        $this->logResponse($checkIpnResponse);
        $this->assertEquals('OK', $checkIpnResponse->getCode());
        $this->assertEquals('IPN is verified.', $checkIpnResponse->getMsg());
    }

}