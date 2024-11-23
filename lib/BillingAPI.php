<?php
/**
 * Billing API
 */

namespace UniPayment\SDK;

use UniPayment\SDK\Model\CancelInvoiceRefundRequest;
use UniPayment\SDK\Model\CancelInvoiceRefundResponse;
use UniPayment\SDK\Model\CreateInvoiceRefundResponse;
use UniPayment\SDK\Model\CreateInvoiceRequest;
use UniPayment\SDK\Model\CreateInvoiceResponse;
use UniPayment\SDK\Model\GetInvoiceByIdResponse;
use UniPayment\SDK\Model\InvoiceRefundRequest;
use UniPayment\SDK\Model\QueryInvoiceRefundsRequest;
use UniPayment\SDK\Model\QueryInvoiceRefundsResponse;
use UniPayment\SDK\Model\QueryInvoicesRequest;
use UniPayment\SDK\Model\QueryInvoicesResponse;
use UniPayment\SDK\Utils\JsonSerializer;

/**
 * Billing API
 */
final class BillingAPI extends BaseClient
{

    /**
     * @throws UnipaymentSDKException
     */
    public function createInvoice(CreateInvoiceRequest $createInvoiceRequest): CreateInvoiceResponse
    {
        $accessToken = $this->getAccessToken();
        $headers = [
            'Authorization' => 'Bearer ' . $accessToken
        ];
        $endpoint = 'v' . $this->getConfiguration()->getApiVersion() . '/invoices';
        $response = $this->getApiClient()->post($endpoint, $headers, JsonSerializer::toJson($createInvoiceRequest));
        return JsonSerializer::fromJSON($response['response'], CreateInvoiceResponse::class);
    }

    /**
     * @throws UnipaymentSDKException
     */
    public function getInvoiceById(string $invoiceId): GetInvoiceByIdResponse
    {
        $accessToken = $this->getAccessToken();
        $headers = [
            'Authorization' => 'Bearer ' . $accessToken
        ];
        $endpoint = 'v' . $this->getConfiguration()->getApiVersion() . '/invoices/' . $invoiceId;
        $response = $this->getApiClient()->get($endpoint, $headers);
        return JsonSerializer::fromJSON($response['response'], GetInvoiceByIdResponse::class);
    }

    /**
     * @throws UnipaymentSDKException
     */
    public function queryInvoices(QueryInvoicesRequest $queryInvoiceRequest): QueryInvoicesResponse
    {
        $accessToken = $this->getAccessToken();
        $headers = [
            'Authorization' => 'Bearer ' . $accessToken
        ];
        $endpoint = 'v' . $this->getConfiguration()->getApiVersion() . '/invoices?' . $queryInvoiceRequest;
        $response = $this->getApiClient()->get($endpoint, $headers);
        return JsonSerializer::fromJSON($response['response'], QueryInvoicesResponse::class);
    }


    /**
     * @throws UnipaymentSDKException
     */
    public function createInvoiceRefund(string $invoiceId, InvoiceRefundRequest $queryInvoiceRequest): CreateInvoiceRefundResponse
    {
        $accessToken = $this->getAccessToken();
        $headers = [
            'Authorization' => 'Bearer ' . $accessToken
        ];
        $endpoint = 'v' . $this->getConfiguration()->getApiVersion() . '/invoices/' . $invoiceId . '/refunds';
        $response = $this->getApiClient()->post($endpoint, $headers, JsonSerializer::toJson($queryInvoiceRequest));
        return JsonSerializer::fromJSON($response['response'], CreateInvoiceRefundResponse::class);
    }

    /**
     * @throws UnipaymentSDKException
     */
    public function cancelInvoiceRefund(string $refundId, CancelInvoiceRefundRequest $cancelInvoiceRefundRequest): CancelInvoiceRefundResponse
    {
        $accessToken = $this->getAccessToken();
        $headers = [
            'Authorization' => 'Bearer ' . $accessToken
        ];
        $endpoint = 'v' . $this->getConfiguration()->getApiVersion() . '/invoices/refunds/' . $refundId . '/cancel';
        $response = $this->getApiClient()->put($endpoint, $headers, JsonSerializer::toJson($cancelInvoiceRefundRequest));
        return JsonSerializer::fromJSON($response['response'], CancelInvoiceRefundResponse::class);
    }

    /**
     * @throws UnipaymentSDKException
     */
    public function queryInvoiceRefunds(QueryInvoiceRefundsRequest $queryInvoiceRefundsRequest): QueryInvoiceRefundsResponse
    {
        $accessToken = $this->getAccessToken();
        $headers = [
            'Authorization' => 'Bearer ' . $accessToken
        ];
        $endpoint = 'v' . $this->getConfiguration()->getApiVersion() . '/invoices/refunds?' . $queryInvoiceRefundsRequest;
        $response = $this->getApiClient()->get($endpoint, $headers);
        return JsonSerializer::fromJSON($response['response'], QueryInvoiceRefundsResponse::class);
    }

}