<?php

namespace UniPayment\SDK;

use UniPayment\SDK\Model\ExchangeOrderStatus;
use UniPayment\SDK\Model\GetQuoteRequest;
use UniPayment\SDK\Model\QueryExchangeOrdersRequest;

class ExchangeAPITest extends BaseTest
{

    /**
     * Test case for getQuote
     * @throws UnipaymentSDKException
     */
    public function testGetQuote()
    {
        $getQuoteRequest = new GetQuoteRequest();
        $getQuoteRequest->setFromCurrency('USDT');
        $getQuoteRequest->setToCurrency('BNB');
        $getQuoteRequest->setExchangeAmount(10);

        $getQuoteResponse = $this->exchangeAPI->getQuote($getQuoteRequest);
        $this->assertNotNull($getQuoteResponse);
        $this->assertEquals('OK', $getQuoteResponse->getCode());
    }

    /**
     * Test case for acceptQuote
     * @throws UnipaymentSDKException
     */
    public function testAcceptQuote()
    {
        $getQuoteRequest = new GetQuoteRequest();
        $getQuoteRequest->setFromCurrency('USDT');
        $getQuoteRequest->setToCurrency('BNB');
        $getQuoteRequest->setExchangeAmount(10);
        $getQuoteResponse = $this->exchangeAPI->getQuote($getQuoteRequest);

        $acceptQuoteResponse = $this->exchangeAPI->acceptQuote($getQuoteResponse->getData()->getQuoteId());
        $this->assertNotNull($acceptQuoteResponse);
        $this->assertEquals('OK', $acceptQuoteResponse->getCode());
        $this->assertEquals(ExchangeOrderStatus::PLACED, $acceptQuoteResponse->getData()->getStatus());
    }

    /**
     * Test case for queryExchangeOrders
     * @throws UnipaymentSDKException
     */
    public function testQueryExchangeOrders()
    {
        $queryExchangeOrdersRequest = new QueryExchangeOrdersRequest();
        $queryExchangeOrdersResponse = $this->exchangeAPI->queryExchangeOrders($queryExchangeOrdersRequest);
        $this->assertNotNull($queryExchangeOrdersResponse);
        $this->assertEquals('OK', $queryExchangeOrdersResponse->getCode());
    }

    /**
     * Test case for getExchangeOrderByOrderId
     * @throws UnipaymentSDKException
     */
    public function testQetExchangeOrderByOrderId()
    {
        $queryExchangeOrdersRequest = new QueryExchangeOrdersRequest();
        $queryExchangeOrdersRequest->setFromCurrency('USDT');
        $queryExchangeOrdersRequest->setToCurrency('BNB');
        $queryExchangeOrdersResponse = $this->exchangeAPI->queryExchangeOrders($queryExchangeOrdersRequest);
        $orderId = $queryExchangeOrdersResponse->getData()->getModels()[0]->getId();

        $getExchangeOrderResponse = $this->exchangeAPI->getExchangeOrderByOrderId($orderId);
        $this->assertNotNull($getExchangeOrderResponse);
        $this->assertEquals('OK', $getExchangeOrderResponse->getCode());
        $this->assertEquals(ExchangeOrderStatus::COMPLETED, $getExchangeOrderResponse->getData()->getStatus());
    }
}