<?php

namespace UniPayment\SDK;

class OauthTokenAPITest extends BaseTest
{

    /**
     * Test case for ping
     * @throws UnipaymentSDKException
     */
    public function testGetAccessToken()
    {
        $tokenResponse = $this->oauthTokenAPI->getAccessToken();
        $this->assertNotNull($tokenResponse->getAccessToken());
    }
}