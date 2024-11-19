<?php

namespace App\Simple;

use App\Interface\ResponseDataInterface;

abstract class AbstractResponseData implements ResponseDataInterface
{
    private int $responseCode = 0;
    private array $responseBody = [];

    final public function setResponseCode(int $responseCode): static
    {
        $this->responseCode = $responseCode;

        return $this;
    }

    final public function getResponseCode(): int
    {
        return $this->responseCode;
    }

    final public function setResponseBody(array $responseBody): static
    {
        $this->responseBody = $responseBody;

        return $this;
    }

    final public function getResponseBody(): array
    {
        return $this->responseBody;
    }
}
