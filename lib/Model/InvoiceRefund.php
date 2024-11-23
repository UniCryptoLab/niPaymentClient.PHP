<?php

namespace UniPayment\SDK\Model;

use DateTime;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;

/**
 * Invoice Refund
 *
 * @category Class
 * @package  UniPayment\SDK\Model
 */
class InvoiceRefund
{
    /**
     * @SerializedName("refund_id")
     */
    private ?string $refundId;
    /**
     * @SerializedName("invoice_id")
     */
    private ?string $invoiceId;
    /**
     * @SerializedName("price_currency")
     */
    private ?string $priceCurrency;
    /**
     * @SerializedName("refund_price_amount")
     */
    private float $refundPriceAmount;
    /**
     * @SerializedName("fee_payer")
     */
    private ?string $feePayer;
    /**
     * @SerializedName("fee")
     */
    private ?float $fee;
    /**
     * @SerializedName("status")
     */
    private ?string $status;
    /**
     * @SerializedName("reason")
     */
    private ?string $reason;
    /**
     * @SerializedName("create_time")
     * @Type("DateTime<'Y-m-d\TH:i:s'>")
     */
    private ?DateTime $createTime;

    public function getRefundId(): ?string
    {
        return $this->refundId;
    }

    public function setRefundId(?string $refundId): void
    {
        $this->refundId = $refundId;
    }

    public function getInvoiceId(): ?string
    {
        return $this->invoiceId;
    }

    public function setInvoiceId(?string $invoiceId): void
    {
        $this->invoiceId = $invoiceId;
    }

    public function getPriceCurrency(): ?string
    {
        return $this->priceCurrency;
    }

    public function setPriceCurrency(?string $priceCurrency): void
    {
        $this->priceCurrency = $priceCurrency;
    }

    public function getRefundPriceAmount(): float
    {
        return $this->refundPriceAmount;
    }

    public function setRefundPriceAmount(float $refundPriceAmount): void
    {
        $this->refundPriceAmount = $refundPriceAmount;
    }

    public function getFeePayer(): ?string
    {
        return $this->feePayer;
    }

    public function setFeePayer(?string $feePayer): void
    {
        $this->feePayer = $feePayer;
    }

    public function getFee(): ?float
    {
        return $this->fee;
    }

    public function setFee(?float $fee): void
    {
        $this->fee = $fee;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(?string $reason): void
    {
        $this->reason = $reason;
    }

    public function getCreateTime(): ?DateTime
    {
        return $this->createTime;
    }

    public function setCreateTime(?DateTime $createTime): void
    {
        $this->createTime = $createTime;
    }

}