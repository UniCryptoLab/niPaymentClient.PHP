<?php

namespace UniPayment\SDK;

use Ramsey\Uuid\Uuid;
use UniPayment\SDK\Model\BuyerInfo;
use UniPayment\SDK\Model\CreateInvoiceRequest;
use UniPayment\SDK\Model\InvoiceErrorStatus;
use UniPayment\SDK\Model\InvoiceStatus;
use UniPayment\SDK\Model\QueryInvoicesRequest;

class BillingAPITest extends BaseTest
{
    /**
     * Test case for createInvoice
     * @throws UnipaymentSDKException
     */
    public function testCreateInvoice()
    {
        $createInvoiceRequest = new CreateInvoiceRequest();
        $createInvoiceRequest->setAppId($this->configuration->getAppId());
        $createInvoiceRequest->setOrderId(Uuid::uuid4());
        $createInvoiceRequest->setPriceAmount(20.0);
        $createInvoiceRequest->setPriceCurrency('USD');
        $createInvoiceRequest->setLang("en");
        $createInvoiceRequest->setExtArgs("Merchant Pass Through Data");
        $createInvoiceRequest->setNotifyURL('https://en7exsmaa68jo.x.pipedream.net');
        $this->logRequest($createInvoiceRequest);

        $createInvoiceResponse = $this->billingAPI->createInvoice($createInvoiceRequest);
        $this->assertNotNull($createInvoiceResponse);
        $this->logResponse($createInvoiceResponse);
        $this->assertEquals('OK', $createInvoiceResponse->getCode());
    }

    /**
     * Test case for queryInvoices
     * @throws UnipaymentSDKException
     */
    public function testQueryInvoices()
    {
        $queryInvoicesResponse = $this->billingAPI->queryInvoices(new QueryInvoicesRequest());
        $this->assertNotNull($queryInvoicesResponse);
        $this->logResponse($queryInvoicesResponse);
        $this->assertEquals('OK', $queryInvoicesResponse->getCode());
    }

    /**
     * Test case for getInvoiceById
     * @throws UnipaymentSDKException
     */
    public function testGetInvoiceById()
    {
        $getInvoiceByIdResponse = $this->billingAPI->getInvoiceById('SrAARgNrPgvveiBQtNc4gk');
        $this->assertNotNull($getInvoiceByIdResponse);
        $this->logResponse($getInvoiceByIdResponse);
        $this->assertEquals('OK', $getInvoiceByIdResponse->getCode());
        $this->assertEquals(InvoiceErrorStatus::NONE, $getInvoiceByIdResponse->getData()->getErrorStatus());
        $this->assertEquals(InvoiceStatus::EXPIRED, $getInvoiceByIdResponse->getData()->getStatus());
    }

    /**
     * Test case for createInvoice
     * @throws UnipaymentSDKException
     */
    public function testCreateInvoice_HostToHostMode()
    {
        $createInvoiceRequest = new CreateInvoiceRequest();
        $createInvoiceRequest->setAppId($this->configuration->getAppId());
        $createInvoiceRequest->setOrderId(Uuid::uuid4());
        $createInvoiceRequest->setPriceAmount(20.0);
        $createInvoiceRequest->setPriceCurrency('USD');
        $createInvoiceRequest->setLang("en");
        $createInvoiceRequest->setExtArgs("Merchant Pass Through Data");
        $createInvoiceRequest->setNotifyURL('https://en7exsmaa68jo.x.pipedream.net');
        $createInvoiceRequest->setHostToHostMode(true);
        $createInvoiceRequest->setPaymentMethodType("CRYPTO");
        $createInvoiceRequest->setPayCurrency("BNB");
        $createInvoiceRequest->setPayNetwork("NETWORK_BSC");
        $this->logRequest($createInvoiceRequest);

        $createInvoiceResponse = $this->billingAPI->createInvoice($createInvoiceRequest);
        $this->assertNotNull($createInvoiceResponse);
        $this->logResponse($createInvoiceResponse);
        $this->assertEquals('OK', $createInvoiceResponse->getCode());
    }

    /**
     * Test case for createInvoice
     * @throws UnipaymentSDKException
     */
    public function testCreateInvoice_BuyerInfo()
    {
        $createInvoiceRequest = new CreateInvoiceRequest();
        $createInvoiceRequest->setAppId($this->configuration->getAppId());
        $createInvoiceRequest->setOrderId(Uuid::uuid4());
        $createInvoiceRequest->setPriceAmount(20.0);
        $createInvoiceRequest->setPriceCurrency('USD');
        $createInvoiceRequest->setLang("en");
        $createInvoiceRequest->setExtArgs("Merchant Pass Through Data");
        $createInvoiceRequest->setNotifyURL('https://en7exsmaa68jo.x.pipedream.net');

        $buyerInfo = new BuyerInfo();
        $buyerInfo->setName("John Doe");
        $buyerInfo->setEmail("john@doe.com");
        $buyerInfo->setAddress1("Address 1");
        $buyerInfo->setAddress2("Address 2");
        $buyerInfo->setState("NYC");
        $buyerInfo->setCountry("US");
        $buyerInfo->setZipCode("12345");
        $createInvoiceRequest->setBuyerInfo($buyerInfo);

        $this->logRequest($createInvoiceRequest);

        $createInvoiceResponse = $this->billingAPI->createInvoice($createInvoiceRequest);
        $this->assertNotNull($createInvoiceResponse);
        $this->logResponse($createInvoiceResponse);
        $this->assertEquals('OK', $createInvoiceResponse->getCode());
    }

}