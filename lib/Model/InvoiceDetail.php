<?php

namespace UniPayment\SDK\Model;
use JMS\Serializer\Annotation\Type;

/**
 * Invoice Detail
 *
 * @category Class
 * @package  UniPayment\SDK\Model
 */
class InvoiceDetail extends Invoice
{
    /**
     * @Type("array<UniPayment\SDK\Model\Transaction>")
     */
    private array $transactions;

    /**
     * @Type("array<UniPayment\SDK\Model\InvoiceRefund>")
     */
    private array $refunds;

    /**
     * @return Transaction[]
     */
    public function getTransactions(): array
    {
        return $this->transactions;
    }

    public function setTransactions(array $transactions): void
    {
        $this->transactions = $transactions;
    }

    /**
     * @return InvoiceRefund[]
     */
    public function getRefunds(): array
    {
        return $this->refunds;
    }

    /**
     * @param array $refunds
     */
    public function setRefunds(array $refunds): void
    {
        $this->refunds = $refunds;
    }
}
