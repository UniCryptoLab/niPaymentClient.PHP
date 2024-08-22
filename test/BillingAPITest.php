<?php

namespace UniPayment\SDK;

use Ramsey\Uuid\Uuid;
use UniPayment\SDK\Model\CreateInvoiceRequest;
use UniPayment\SDK\Model\InvoiceErrorStatus;
use UniPayment\SDK\Model\InvoiceStatus;
use UniPayment\SDK\Model\QueryInvoicesRequest;
use UniPayment\SDK\Utils\JsonSerializer;

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
        $createInvoiceRequest->setHostToHostMode(true);
        $createInvoiceRequest->setPaymentMethodType("CRYPTO");
        $createInvoiceRequest->setPayCurrency("BNB");
        $createInvoiceRequest->setPayNetwork("NETWORK_BSC");

        print JsonSerializer::toJson($createInvoiceRequest);

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


}