<?php

namespace App\Simple\RequestData;

final class ProductRequestData extends AbstractRequestData
{
    private ?string $name = null;
    private ?string $description = null;
    private ?int $price = null;
    private ?bool $available = null;

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setPrice(?int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setAvailable(?bool $available): self
    {
        $this->available = $available;

        return $this;
    }

    public function getAvailable(): ?bool
    {
        return $this->available;
    }
}
