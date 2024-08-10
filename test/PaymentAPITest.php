<?php

namespace UniPayment\SDK;

use Ramsey\Uuid\Uuid;
use UniPayment\SDK\Model\CreatePaymentRequest;
use UniPayment\SDK\Model\PaymentReason;
use UniPayment\SDK\Model\QueryPaymentRequest;

class PaymentAPITest extends BaseTest
{
    /**
     * Test case for createPayment
     * @throws UnipaymentSDKException
     */
    public function testCreatePayment()
    {
        $createPaymentRequest = $this->createPaymentRequest();
        $createPaymentResponse = $this->paymentAPI->createPayment($createPaymentRequest);
        $this->assertNotNull($createPaymentResponse);
        $this->assertEquals('OK', $createPaymentResponse->getCode());
    }

    /**
     * Test case for confirmPayment
     * @throws UnipaymentSDKException
     */
    public function testConfirmPayment()
    {
        $createPaymentRequest = $this->createPaymentRequest();
        $createPaymentResponse = $this->paymentAPI->createPayment($createPaymentRequest);

        $paymentId = $createPaymentResponse->getData()->getId();
        $confirmPaymentResponse = $this->paymentAPI->confirmPayment($paymentId);
        $this->assertNotNull($confirmPaymentResponse);
        $this->assertEquals('OK', $confirmPaymentResponse->getCode());
    }

    /**
     * Test case for cancelPayment
     * @throws UnipaymentSDKException
     */
    public function testCancelPayment()
    {
        $createPaymentRequest = $this->createPaymentRequest();
        $createPaymentResponse = $this->paymentAPI->createPayment($createPaymentRequest);

        $paymentId = $createPaymentResponse->getData()->getId();
        $cancelPaymentResponse = $this->paymentAPI->cancelPayment($paymentId);
        $this->assertNotNull($cancelPaymentResponse);
        $this->assertEquals('OK', $cancelPaymentResponse->getCode());
    }

    /**
     * Test case for queryPayments
     * @throws UnipaymentSDKException
     */
    public function testQueryPayments()
    {
        $queryPaymentRequest = new QueryPaymentRequest();
        $queryPaymentResponse = $this->paymentAPI->queryPayments($queryPaymentRequest);
        $this->assertNotNull($queryPaymentResponse);
        $this->assertEquals('OK', $queryPaymentResponse->getCode());
    }

    /**
     * Test case for getPaymentById
     * @throws UnipaymentSDKException
     */
    public function testGetPaymentById()
    {
        $queryPaymentRequest = new QueryPaymentRequest();
        $queryPaymentResponse = $this->paymentAPI->queryPayments($queryPaymentRequest);
        $paymentId = $queryPaymentResponse->getData()->getModels()[0]->getId();

        $getPaymentByIdResponse = $this->paymentAPI->getPaymentById($paymentId);
        $this->assertNotNull($getPaymentByIdResponse);
        $this->assertEquals('OK', $getPaymentByIdResponse->getCode());
    }

    /**
     * Test case for getPaymentFee
     * @throws UnipaymentSDKException
     */
    public function testGetPaymentFee()
    {
        $paymentFeeResponse = $this->paymentAPI->getPaymentFee('BTC');
        $this->assertNotNull($paymentFeeResponse);
        $this->assertEquals('OK', $paymentFeeResponse->getCode());
    }

    private function createPaymentRequest(): CreatePaymentRequest
    {
        $createPaymentRequest = new CreatePaymentRequest();
        $createPaymentRequest->setFromAccountId('d7c5db2e-8572-4a2f-9300-84dc4b3fd052');
        $createPaymentRequest->setAmount('10.00');
        $createPaymentRequest->setToAccountId('f0b4083b-8b43-4267-a321-f96bdba8c9e4');
        $createPaymentRequest->setAssetType('USDT');
        $createPaymentRequest->setPaymentMethodId('5c0bce95-7d10-47f3-8e11-250ab900da07');
        $createPaymentRequest->setReason(PaymentReason::INTERNAL_TRANSFER);
        $createPaymentRequest->setUniqueId(Uuid::uuid4());
        $createPaymentRequest->setNote('Internal Transfer');
        return $createPaymentRequest;
    }
}