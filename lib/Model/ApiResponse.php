<?php

namespace UniPayment\SDK\Model;

class ApiResponse
{
    private string $code;
    private string $msg;
    private object $data;

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

    public function getData(): object
    {
        return $this->data;
    }

    public function setData(object $data): void
    {
        $this->data = $data;
    }
}