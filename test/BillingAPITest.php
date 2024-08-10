<?php

namespace UniPayment\SDK;

use Ramsey\Uuid\Uuid;
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
        $createInvoiceRequest->setPriceAmount(1.0);
        $createInvoiceRequest->setPriceCurrency('USD');
        $createInvoiceRequest->setLang("en");
        $createInvoiceRequest->setExtArgs("Merchant Pass Through Data");

        $createInvoiceResponse = $this->billingAPI->createInvoice($createInvoiceRequest);
        $this->assertNotNull($createInvoiceResponse);
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
        $this->assertEquals('OK', $getInvoiceByIdResponse->getCode());
        $this->assertEquals(InvoiceErrorStatus::NONE, $getInvoiceByIdResponse->getData()->getErrorStatus());
        $this->assertEquals(InvoiceStatus::EXPIRED, $getInvoiceByIdResponse->getData()->getStatus());
    }


}