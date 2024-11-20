<?php

namespace App\Simple;

final class ResponseData
{
    private int $responseCode = 0;
    private array $responseBody = [];

    public function setResponseCode(int $responseCode): self
    {
        $this->responseCode = $responseCode;

        return $this;
    }

    public function getResponseCode(): int
    {
        return $this->responseCode;
    }

    public function setResponseBody(array $responseBody): self
    {
        $this->responseBody = $responseBody;

        return $this;
    }

    public function getResponseBody(): array
    {
        return $this->responseBody;
    }
}
