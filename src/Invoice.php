<?php

declare(strict_types=1);

namespace Oop;

use Oop\Price\Price;

class Invoice
{
    private int $id;
    private InvoiceLineCollection $lines;

    public function __construct(int $id, InvoiceLineCollection $lines)
    {
        $this->id = $id;
        $this->lines = $lines;
    }

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return InvoiceLineCollection
     */
    public function getLines(): InvoiceLineCollection
    {
        return $this->lines;
    }

    public function getTotal(): Price
    {
        return $this->lines->getTotal()->add($this->getDeliveryFees());
    }

    public function getDeliveryFees(): Price
    {
        return Price::euro(700);
    }
}
