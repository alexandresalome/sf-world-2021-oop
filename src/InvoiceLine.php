<?php

declare(strict_types=1);

namespace Oop;

use Oop\Price\Price;

class InvoiceLine
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

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return Price
     */
    public function getUnitPrice(): Price
    {
        return $this->unitPrice;
    }

    public function getLinePrice(): Price
    {
        return $this->unitPrice->multiply($this->quantity);
    }
}
