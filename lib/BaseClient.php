<?php

namespace UniPayment\SDK;

abstract class BaseClient
{
    private ApiClient $apiClient;
    private Configuration $configuration;
    private OauthTokenAPI $oauthTokenAPI;

    public function __construct(Configuration $configuration)
    {
        $this->apiClient = new ApiClient($configuration);
        $this->configuration = $configuration;
        $this->oauthTokenAPI = new OauthTokenAPI($configuration);
    }

    /**
     * @return ApiClient
     */
    public function getApiClient(): ApiClient
    {
        return $this->apiClient;
    }

    /**
     * @return Configuration
     */
    public function getConfiguration(): Configuration
    {
        return $this->configuration;
    }

    /**
     * @return string
     * @throws UnipaymentSDKException
     */
    public function getAccessToken(): string
    {
        if (TokenCache::get('access_token')) {
            $accessToken = TokenCache::get('access_token');
        } else {
            $tokenResponse = $this->oauthTokenAPI->getAccessToken();
            $accessToken = $tokenResponse->getAccessToken();
            TokenCache::set('access_token', $tokenResponse->getAccessToken(), $tokenResponse->getExpiresIn());
        }
        return $accessToken;
    }
}