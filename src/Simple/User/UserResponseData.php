<?php

namespace App\Simple\User;

use App\Simple\AbstractResponseData;

final class UserResponseData extends AbstractResponseData
{
    private ?string $authenticationToken = null;
    private ?int $userId = null;
    private ?string $username = null;
    private ?string $role = null;

    public function setAuthenticationToken(?string $authenticationToken): self
    {
        $this->authenticationToken = $authenticationToken;

        return $this;
    }

    public function getAuthenticationToken(): ?string
    {
        return $this->authenticationToken;
    }

    public function setUserId(?int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setRole(?string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }
}
