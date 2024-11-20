<?php

namespace App\Simple\RequestData;

use App\Interface\RequestDataInterface;

abstract class AbstractRequestData implements RequestDataInterface
{
    private ?string $authorizationToken = null;
    private string $method;
    private ?string $endpoint = null;
    private ?string $id = null;

    final public function setAuthorizationToken(?string $authorizationToken): static
    {
        $this->authorizationToken = $authorizationToken;

        return $this;
    }

    final public function getAuthorizationToken(): ?string
    {
        return $this->authorizationToken;
    }

    final public function setMethod(string $method): static
    {
        $this->method = $method;

        return $this;
    }

    final public function getMethod(): string
    {
        return $this->method;
    }

    final public function setEndpoint(?string $endpoint): static
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    final public function getEndpoint(): ?string
    {
        return $this->endpoint;
    }

    final public function setId(?string $id): self
    {
        $this->id = $id;

        return $this;
    }

    final public function getId(): ?string
    {
        return $this->id;
    }
}
