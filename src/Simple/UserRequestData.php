<?php

namespace App\Simple;

final class UserRequestData extends AbstractRequestData
{
    private ?int $userId;

    public function setUserId(?int $userId): UserRequestData
    {
        $this->userId = $userId;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }
}
