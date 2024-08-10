<?php

namespace UniPayment\SDK;

use Ramsey\Uuid\Uuid;
use UniPayment\SDK\Model\BankPaymentMethodDetail;
use UniPayment\SDK\Model\Beneficiary;
use UniPayment\SDK\Model\BeneficiaryType;
use UniPayment\SDK\Model\CryptoPaymentMethodDetail;
use UniPayment\SDK\Model\InternalPaymentMethodDetail;
use UniPayment\SDK\Model\PaymentMethod;
use UniPayment\SDK\Model\QueryBeneficiaryRequest;
use UniPayment\SDK\Model\Relationship;
use UniPayment\SDK\Model\TransferMethod;

class BeneficiaryAPITest extends BaseTest
{
    /**
     * Test case for createBeneficiary
     * @throws UnipaymentSDKException
     */
    public function testCreateBeneficiary()
    {
        $beneficiary = new Beneficiary();
        $beneficiary->setName("Beneficiary 1");
        $beneficiary->setEmail("beneficiary1@gmail.com");
        $beneficiary->setType(BeneficiaryType::INDIVIDUAL);
        $beneficiary->setRelationship(Relationship::CUSTOMER);

        $createBeneficiaryResponse = $this->beneficiaryAPI->createBeneficiary($beneficiary);
        $this->assertNotNull($createBeneficiaryResponse);
        $this->assertEquals('OK', $createBeneficiaryResponse->getCode());
    }

    /**
     * Test case for queryBeneficiaries
     * @throws UnipaymentSDKException
     */
    public function testQueryBeneficiaries()
    {
        $queryBeneficiaryRequest = new QueryBeneficiaryRequest();
        $queryBeneficiaryResponse = $this->beneficiaryAPI->queryBeneficiaries($queryBeneficiaryRequest);
        $this->assertNotNull($queryBeneficiaryResponse);
        $this->assertEquals('OK', $queryBeneficiaryResponse->getCode());
    }

    /**
     * Test case for getBeneficiaryById
     * @throws UnipaymentSDKException
     */
    public function testGetBeneficiaryById()
    {
        $queryBeneficiaryRequest = new QueryBeneficiaryRequest();
        $queryBeneficiaryResponse = $this->beneficiaryAPI->queryBeneficiaries($queryBeneficiaryRequest);
        $beneficiaries = array_filter($queryBeneficiaryResponse->getData()->getModels(), function (Beneficiary $beneficiary) {
            return $beneficiary->getEmail() === 'beneficiary1@gmail.com';
        });
        $beneficiaryId = reset($beneficiaries)->getId();
        $queryBeneficiaryByIdResponse = $this->beneficiaryAPI->getBeneficiaryById($beneficiaryId);
        $this->assertNotNull($queryBeneficiaryByIdResponse);
        $this->assertEquals('OK', $queryBeneficiaryByIdResponse->getCode());
    }

    /**
     * Test case for updateBeneficiary
     * @throws UnipaymentSDKException
     */
    public function testUpdateBeneficiary()
    {
        $queryBeneficiaryRequest = new QueryBeneficiaryRequest();
        $queryBeneficiaryResponse = $this->beneficiaryAPI->queryBeneficiaries($queryBeneficiaryRequest);
        $beneficiaries = array_filter($queryBeneficiaryResponse->getData()->getModels(), function (Beneficiary $beneficiary) {
            return $beneficiary->getEmail() === 'beneficiary1@gmail.com';
        });

        /** @var Beneficiary $beneficiary */
        $beneficiary = reset($beneficiaries);
        $beneficiaryId = $beneficiary->getId();

        $beneficiary->setAddress("123 Street");
        $beneficiary->setCity("NYC");
        $beneficiary->setCountry("US");
        $beneficiary->setState("NY");
        $beneficiary->setZipcode("12345");

        $queryBeneficiaryByIdResponse = $this->beneficiaryAPI->updateBeneficiary($beneficiaryId, $beneficiary);
        $this->assertNotNull($queryBeneficiaryByIdResponse);
        $this->assertEquals('OK', $queryBeneficiaryByIdResponse->getCode());
    }

    /**
     * Test case for updateBeneficiary
     * @throws UnipaymentSDKException
     */
    public function testDeleteBeneficiary()
    {
        $beneficiary = new Beneficiary();
        $beneficiary->setName("Beneficiary 2");
        $beneficiary->setEmail("beneficiary2@gmail.com");
        $beneficiary->setType(BeneficiaryType::INDIVIDUAL);
        $beneficiary->setRelationship(Relationship::CUSTOMER);

        $createBeneficiaryResponse = $this->beneficiaryAPI->createBeneficiary($beneficiary);
        $deleteBeneficiaryResponse = $this->beneficiaryAPI->deleteBeneficiary($createBeneficiaryResponse->getData()->getId());
        $this->assertNotNull($deleteBeneficiaryResponse);
        $this->assertEquals('OK', $deleteBeneficiaryResponse->getCode());
    }

    /**
     * Test case for createPaymentMethod
     * @throws UnipaymentSDKException
     */
    public function testCreatePaymentMethods()
    {
        $queryBeneficiaryRequest = new QueryBeneficiaryRequest();
        $queryBeneficiaryResponse = $this->beneficiaryAPI->queryBeneficiaries($queryBeneficiaryRequest);
        $beneficiaries = array_filter($queryBeneficiaryResponse->getData()->getModels(), function (Beneficiary $beneficiary) {
            return $beneficiary->getEmail() === 'beneficiary1@gmail.com';
        });

        /** @var Beneficiary $beneficiary */
        $beneficiary = reset($beneficiaries);
        $beneficiaryId = $beneficiary->getId();

        $createPaymentMethodResponse = $this->beneficiaryAPI->createPaymentMethod($beneficiaryId, $this->createCryptoPaymentMethod());
        $this->assertNotNull($createPaymentMethodResponse);
        $this->assertEquals('OK', $createPaymentMethodResponse->getCode());

        $createPaymentMethodResponse = $this->beneficiaryAPI->createPaymentMethod($beneficiaryId, $this->createInternalPaymentMethod());
        $this->assertNotNull($createPaymentMethodResponse);
        $this->assertEquals('OK', $createPaymentMethodResponse->getCode());

        $createPaymentMethodResponse = $this->beneficiaryAPI->createPaymentMethod($beneficiaryId, $this->createBankPaymentMethodDetail());
        $this->assertNotNull($createPaymentMethodResponse);
        $this->assertEquals('OK', $createPaymentMethodResponse->getCode());
    }

    /**
     * Test case for getPaymentMethodList
     * @throws UnipaymentSDKException
     */
    public function testGetPaymentMethodList()
    {
        $queryBeneficiaryRequest = new QueryBeneficiaryRequest();
        $queryBeneficiaryResponse = $this->beneficiaryAPI->queryBeneficiaries($queryBeneficiaryRequest);
        $beneficiaries = array_filter($queryBeneficiaryResponse->getData()->getModels(), function (Beneficiary $beneficiary) {
            return $beneficiary->getEmail() === 'beneficiary1@gmail.com';
        });

        /** @var Beneficiary $beneficiary */
        $beneficiary = reset($beneficiaries);
        $beneficiaryId = $beneficiary->getId();

        $getPaymentMethodListResponse = $this->beneficiaryAPI->getPaymentMethodList($beneficiaryId);
        $this->assertNotNull($getPaymentMethodListResponse);
        $this->assertEquals('OK', $getPaymentMethodListResponse->getCode());
    }

    /**
     * Test case for getPaymentMethodById
     * @throws UnipaymentSDKException
     */
    public function testGetPaymentMethodById()
    {
        $queryBeneficiaryRequest = new QueryBeneficiaryRequest();
        $queryBeneficiaryResponse = $this->beneficiaryAPI->queryBeneficiaries($queryBeneficiaryRequest);
        $beneficiaries = array_filter($queryBeneficiaryResponse->getData()->getModels(), function (Beneficiary $beneficiary) {
            return $beneficiary->getEmail() === 'beneficiary1@gmail.com';
        });

        /** @var Beneficiary $beneficiary */
        $beneficiary = reset($beneficiaries);
        $beneficiaryId = $beneficiary->getId();

        $getPaymentMethodListResponse = $this->beneficiaryAPI->getPaymentMethodList($beneficiaryId);
        foreach ($getPaymentMethodListResponse->getData() as $paymentMethod) {
            $getPaymentMethodIdResponse = $this->beneficiaryAPI->getPaymentMethodById($beneficiaryId, $paymentMethod->getId());
            $this->assertNotNull($getPaymentMethodIdResponse);
            $this->assertEquals('OK', $getPaymentMethodIdResponse->getCode());
            switch ($getPaymentMethodIdResponse->getData()->getTransferMethod()) {
                case TransferMethod::INTERNAL;
                    $this->assertTrue($getPaymentMethodIdResponse->getData()->getDetail() instanceof InternalPaymentMethodDetail);
                    break;
                case TransferMethod::BANK;
                    $this->assertTrue($getPaymentMethodIdResponse->getData()->getDetail() instanceof BankPaymentMethodDetail);
                    break;
                case TransferMethod::CRYPTO;
                    $this->assertTrue($getPaymentMethodIdResponse->getData()->getDetail() instanceof CryptoPaymentMethodDetail);
                    break;
            }
        }
    }

    /**
     * Test case for getPaymentMethodById
     * @throws UnipaymentSDKException
     */
    public function testUpdatePaymentMethod()
    {
        $queryBeneficiaryRequest = new QueryBeneficiaryRequest();
        $queryBeneficiaryResponse = $this->beneficiaryAPI->queryBeneficiaries($queryBeneficiaryRequest);
        $beneficiaries = array_filter($queryBeneficiaryResponse->getData()->getModels(), function (Beneficiary $beneficiary) {
            return $beneficiary->getEmail() === 'beneficiary1@gmail.com';
        });

        /** @var Beneficiary $beneficiary */
        $beneficiary = reset($beneficiaries);
        $beneficiaryId = $beneficiary->getId();

        $getPaymentMethodListResponse = $this->beneficiaryAPI->getPaymentMethodList($beneficiaryId);
        foreach ($getPaymentMethodListResponse->getData() as $paymentMethod) {
            $getPaymentMethodIdResponse = $this->beneficiaryAPI->getPaymentMethodById($beneficiaryId, $paymentMethod->getId());
            $this->assertNotNull($getPaymentMethodIdResponse);
            $this->assertEquals('OK', $getPaymentMethodIdResponse->getCode());
            switch ($getPaymentMethodIdResponse->getData()->getTransferMethod()) {
                case TransferMethod::INTERNAL;
                    $internalPaymentMethod = $getPaymentMethodIdResponse->getData();
                    $internalPaymentMethod->setTitle('internal-' . Uuid::uuid4());
                    $updatePaymentMethodResponse = $this->beneficiaryAPI->updatePaymentMethod($beneficiaryId, $internalPaymentMethod->getId(), $internalPaymentMethod);
                    $this->assertNotNull($updatePaymentMethodResponse);
                    $this->assertEquals('OK', $updatePaymentMethodResponse->getCode());
                    break;
                case TransferMethod::BANK;
                    $bankPaymentMethod = $getPaymentMethodIdResponse->getData();
                    $bankPaymentMethod->setTitle('bank-' . Uuid::uuid4());
                    $updatePaymentMethodResponse = $this->beneficiaryAPI->updatePaymentMethod($beneficiaryId, $bankPaymentMethod->getId(), $bankPaymentMethod);
                    $this->assertNotNull($updatePaymentMethodResponse);
                    $this->assertEquals('OK', $updatePaymentMethodResponse->getCode());
                    break;
                case TransferMethod::CRYPTO;
                    $cryptoPaymentMethod = $getPaymentMethodIdResponse->getData();
                    $cryptoPaymentMethod->setTitle('crypto-' . Uuid::uuid4());
                    $updatePaymentMethodResponse = $this->beneficiaryAPI->updatePaymentMethod($beneficiaryId, $cryptoPaymentMethod->getId(), $cryptoPaymentMethod);
                    $this->assertNotNull($updatePaymentMethodResponse);
                    $this->assertEquals('OK', $updatePaymentMethodResponse->getCode());
                    break;
            }
        }
    }

    /**
     * Test case for deletePaymentMethod
     * @throws UnipaymentSDKException
     */
    public function testDeletePaymentMethod()
    {
        $queryBeneficiaryRequest = new QueryBeneficiaryRequest();
        $queryBeneficiaryResponse = $this->beneficiaryAPI->queryBeneficiaries($queryBeneficiaryRequest);
        $beneficiaries = array_filter($queryBeneficiaryResponse->getData()->getModels(), function (Beneficiary $beneficiary) {
            return $beneficiary->getEmail() === 'beneficiary1@gmail.com';
        });

        /** @var Beneficiary $beneficiary */
        $beneficiary = reset($beneficiaries);
        $beneficiaryId = $beneficiary->getId();

        $createPaymentMethodResponse = $this->beneficiaryAPI->createPaymentMethod($beneficiaryId, $this->createCryptoPaymentMethod());
        $deletePaymentMethodResponse = $this->beneficiaryAPI->deletePaymentMethod($beneficiaryId, $createPaymentMethodResponse->getData()->getId());
        $this->assertNotNull($deletePaymentMethodResponse);
        $this->assertEquals('OK', $deletePaymentMethodResponse->getCode());

        $createPaymentMethodResponse = $this->beneficiaryAPI->createPaymentMethod($beneficiaryId, $this->createInternalPaymentMethod());
        $deletePaymentMethodResponse = $this->beneficiaryAPI->deletePaymentMethod($beneficiaryId, $createPaymentMethodResponse->getData()->getId());
        $this->assertNotNull($deletePaymentMethodResponse);
        $this->assertEquals('OK', $deletePaymentMethodResponse->getCode());

        $createPaymentMethodResponse = $this->beneficiaryAPI->createPaymentMethod($beneficiaryId, $this->createBankPaymentMethodDetail());
        $deletePaymentMethodResponse = $this->beneficiaryAPI->deletePaymentMethod($beneficiaryId, $createPaymentMethodResponse->getData()->getId());
        $this->assertNotNull($deletePaymentMethodResponse);
        $this->assertEquals('OK', $deletePaymentMethodResponse->getCode());
    }

    private function createCryptoPaymentMethod(): PaymentMethod
    {
        $paymentMethodCrypto = new PaymentMethod();
        $paymentMethodCrypto->setTransferMethod(TransferMethod::CRYPTO);
        $paymentMethodCrypto->setTitle('crypto-' . Uuid::uuid4());

        $cryptoPaymentMethodDetail = new CryptoPaymentMethodDetail();
        $cryptoPaymentMethodDetail->setAssetType('BTC');
        $cryptoPaymentMethodDetail->setAddress("bc1qxy2kgdygjrsqtzq2n0yrf2493p83kkfjhx0wlh");
        $cryptoPaymentMethodDetail->setNetwork("NETWORK_BTC");
        $paymentMethodCrypto->setDetail($cryptoPaymentMethodDetail);
        return $paymentMethodCrypto;
    }

    private function createInternalPaymentMethod(): PaymentMethod
    {
        $paymentMethodInternal = new PaymentMethod();
        $paymentMethodInternal->setTransferMethod(TransferMethod::INTERNAL);
        $paymentMethodInternal->setTitle('internal-' . Uuid::uuid4());

        $internalPaymentMethodDetail = new InternalPaymentMethodDetail();
        $internalPaymentMethodDetail->setAssetType('USDT');
        $internalPaymentMethodDetail->setUid('1000000');
        $paymentMethodInternal->setDetail($internalPaymentMethodDetail);
        return $paymentMethodInternal;
    }

    private function createBankPaymentMethodDetail(): PaymentMethod
    {
        $paymentMethodBank = new PaymentMethod();
        $paymentMethodBank->setTransferMethod(TransferMethod::BANK);
        $paymentMethodBank->setTitle('bank-' . Uuid::uuid4());

        $bankPaymentMethodDetail = new BankPaymentMethodDetail();
        $bankPaymentMethodDetail->setAssetType("USD");
        $bankPaymentMethodDetail->setAccountNumber("1234567890");
        $bankPaymentMethodDetail->setBankIdentifier("CITIUS33XXX");
        $bankPaymentMethodDetail->setBankAddress("388 GREENWICH STREET NYC NY");
        $bankPaymentMethodDetail->setBankName("CITIBANK");
        $bankPaymentMethodDetail->setBankCountry("US");
        $bankPaymentMethodDetail->setBic("CITIUS33XXX");
        $bankPaymentMethodDetail->setNetwork("BANK_SWIFT");

        $paymentMethodBank->setDetail($bankPaymentMethodDetail);
        return $paymentMethodBank;
    }
}