<?php

namespace UniPayment\SDK\Model;

use DateTime;

/**
 * Host To Host Data
 *
 * @category Class
 * @package  UniPayment\SDK\Model
 */
class HostToHostData
{
    private string $network;
    private string $address;

    /**
     * @SerializedName("pay_amount")
     */
    private float $payAmount;

    /**
     * @SerializedName("pay_currency")
     */
    private string $payCurrency;
    private string $type;

    public function getNetwork(): string
    {
        return $this->network;
    }

    public function setNetwork(string $network): void
    {
        $this->network = $network;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function getPayAmount(): float
    {
        return $this->payAmount;
    }

    public function setPayAmount(float $payAmount): void
    {
        $this->payAmount = $payAmount;
    }

    public function getPayCurrency(): string
    {
        return $this->payCurrency;
    }

    public function setPayCurrency(string $payCurrency): void
    {
        $this->payCurrency = $payCurrency;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

}