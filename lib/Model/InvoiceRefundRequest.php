<?php

namespace UniPayment\SDK\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;

class InvoiceRefundRequest
{

    /**
     * @SerializedName("refund_price_amount")
     */
    private ?float $refundPriceAmount;
    /**
     * @SerializedName("price_currency")
     */
    private ?string $priceCurrency;
    /**
     * @SerializedName("fee_payer")
     */
    private ?string $feePayer;
    /**
     * @SerializedName("reason")
     */
    private ?string $reason;

    public function getRefundPriceAmount(): ?float
    {
        return $this->refundPriceAmount;
    }

    public function setRefundPriceAmount(?float $refundPriceAmount): void
    {
        $this->refundPriceAmount = $refundPriceAmount;
    }

    public function getPriceCurrency(): ?string
    {
        return $this->priceCurrency;
    }

    public function setPriceCurrency(?string $priceCurrency): void
    {
        $this->priceCurrency = $priceCurrency;
    }

    public function getFeePayer(): ?string
    {
        return $this->feePayer;
    }

    public function setFeePayer(?string $feePayer): void
    {
        $this->feePayer = $feePayer;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(?string $reason): void
    {
        $this->reason = $reason;
    }

}