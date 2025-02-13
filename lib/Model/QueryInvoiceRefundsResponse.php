<?php

namespace UniPayment\SDK\Model;

/**
 * Query Invoices Response
 *
 * @category Class
 * @package  UniPayment\SDK\Model
 */
class QueryInvoiceRefundsResponse
{
    private string $code;
    private string $msg;
    private InvoiceRefundPageList $data;

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function getMsg(): string
    {
        return $this->msg;
    }

    public function setMsg(string $msg): void
    {
        $this->msg = $msg;
    }

    public function getData(): InvoiceRefundPageList
    {
        return $this->data;
    }

    public function setData(InvoiceRefundPageList $data): void
    {
        $this->data = $data;
    }

}
