<?php

namespace UniPayment\SDK\Model;

/**
 * Create Invoice Response
 * @category Class
 * @package  UniPayment\SDK\Model
 */
class CreateInvoiceRefundResponse
{
    private string $msg;
    private string $code;
    private InvoiceRefund $data;

    public function getMsg(): string
    {
        return $this->msg;
    }

    public function setMsg(string $msg): void
    {
        $this->msg = $msg;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function getData(): InvoiceRefund
    {
        return $this->data;
    }

    public function setData(InvoiceRefund $data): void
    {
        $this->data = $data;
    }

}
