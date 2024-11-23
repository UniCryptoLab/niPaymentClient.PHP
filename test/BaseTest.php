<?php

namespace UniPayment\SDK;
require_once(__DIR__ . '/../vendor/autoload.php');

use Monolog\Logger;
use PHPUnit\Framework\TestCase;
use UniPayment\SDK\Utils\JsonSerializer;

class BaseTest extends TestCase
{
    private string $clientId = 'dd57d7c5-9b63-4a42-8bde-7d38dce13dea';
    private string $clientSecret = '9vHvCZzpZS2jkeo78Y8aGB9xLFawLrSnz';
    private string $appId = '2a9bd90b-fe95-4659-83cb-04de662fbbac';
    protected Configuration $configuration;
    protected OauthTokenAPI $oauthTokenAPI;
    protected CommonAPI $commonAPI;
    protected BillingAPI $billingAPI;
    protected ExchangeAPI $exchangeAPI;
    protected WalletAPI $walletAPI;
    protected PaymentAPI $paymentAPI;
    protected BeneficiaryAPI $beneficiaryAPI;
    protected WebhookAPI $webhookAPI;
    protected Logger $logger;

    /**
     * Setup before running each test case
     */
    public function setUp(): void
    {
        $this->configuration = new Configuration();
        $this->configuration->setClientId($this->clientId);
        $this->configuration->setClientSecret($this->clientSecret);
        $this->configuration->setIsSandbox(true);
        $this->configuration->setAppId($this->appId);
        $this->oauthTokenAPI = new OauthTokenAPI($this->configuration);
        $this->commonAPI = new CommonAPI($this->configuration);
        $this->billingAPI = new BillingAPI($this->configuration);
        $this->exchangeAPI = new ExchangeAPI($this->configuration);
        $this->walletAPI = new WalletAPI($this->configuration);
        $this->paymentAPI = new PaymentAPI($this->configuration);
        $this->beneficiaryAPI = new BeneficiaryAPI($this->configuration);
        $this->webhookAPI = new WebhookAPI($this->configuration);
        $this->logger = new Logger($this->toString());
    }

    public function logRequest($request): void
    {
        $this->logger->debug("Request Body: " . JsonSerializer::toJson($request));
    }

    public function logResponse($response): void
    {
        $this->logger->debug("Response Body: " . JsonSerializer::toJson($response));
    }
}