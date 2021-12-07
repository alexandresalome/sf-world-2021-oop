<?php

namespace Oop;

class InvoiceLineBuilder
{
    private int $quantity;
    private string $description;
    private Price $unitPrice;

    public function __construct(int $quantity, string $description, Price $unitPrice)
    {
        $this->quantity = $quantity;
        $this->description = $description;
        $this->unitPrice = $unitPrice;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function setUnitPrice(Price $unitPrice): self
    {
        $this->unitPrice = $unitPrice;

        return $this;
    }

    public function getLine(): InvoiceLine
    {
        return new InvoiceLine($this->quantity, $this->description, $this->unitPrice);
    }

    public function incrementQuantity(int $amount): void
    {
        $this->quantity += $amount;
    }
}
