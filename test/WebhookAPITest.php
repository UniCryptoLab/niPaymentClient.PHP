<?php

namespace UniPayment\SDK;

use UniPayment\SDK\Model\UpdateNotifyUrlRequest;
use UniPayment\SDK\Model\UpdateSecretKeyRequest;

class WebhookAPITest extends BaseTest
{
    /**
     * Test case for updateNotifyUrl
     * @throws UnipaymentSDKException
     */
    public function testUpdateNotifyUrl()
    {
        $updateNotifyUrlRequest = new UpdateNotifyUrlRequest();
        $updateNotifyUrlRequest->setUpdateNotifyUrl('https://en7exsmaa68jo.x.pipedream.net');
        $updateNotifyUrlResponse = $this->webhookAPI->updateNotifyUrl($updateNotifyUrlRequest);
        $this->assertNotNull($updateNotifyUrlResponse);
        $this->assertEquals('OK', $updateNotifyUrlResponse->getCode());
    }

    /**
     * Test case for updateSecretKey
     * @throws UnipaymentSDKException
     */
    public function testUpdateSecretKey()
    {
        $updateSecretKeyRequest = new UpdateSecretKeyRequest();
        $updateSecretKeyRequest->setSecretKey('s3cretKey@2024%');
        $updateNotifyUrlResponse = $this->webhookAPI->updateSecretKey($updateSecretKeyRequest);
        $this->assertNotNull($updateNotifyUrlResponse);
        $this->assertEquals('OK', $updateNotifyUrlResponse->getCode());
    }
}