<?php

namespace App\Simple;

abstract class AbstractRequestData
{
    private ?string $authorizationToken;
    private string $method;
    private string $routeName;

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

    final public function setRouteName(string $routeName): static
    {
        $this->routeName = $routeName;

        return $this;
    }

    final public function getRouteName(): string
    {
        return $this->routeName;
    }
}
