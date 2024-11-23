<?php

namespace UniPayment\SDK\Model;
class CancelInvoiceRefundRequest
{
    private string $note;

    public function getNote(): string
    {
        return $this->note;
    }

    public function setNote(string $note): void
    {
        $this->note = $note;
    }

}