<?php

namespace UniPayment\SDK\Model;


use DateTime;
use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * Exchange Order
 *
 * @category Class
 * @package  UniPayment\SDK\Model
 */
class ExchangeOrder extends Quote
{
    private string $id;

    /**
     * @SerializedName("status")
     */
    private string $status;

    /**
     * @SerializedName("exchange_amount")
     */
    private float $exchangeAmount;

    /**
     * @var DateTime
     */
    /**
     * @SerializedName("create_time")
     */
    private string $createTime;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getExchangeAmount(): float
    {
        return $this->exchangeAmount;
    }

    public function setExchangeAmount(float $exchangeAmount): void
    {
        $this->exchangeAmount = $exchangeAmount;
    }

    public function getCreateTime(): string
    {
        return $this->createTime;
    }

    public function setCreateTime(string $createTime): void
    {
        $this->createTime = $createTime;
    }
}