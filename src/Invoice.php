<?php

namespace Oop;

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
     * @return InvoiceLine[]
     */
    public function getLines(): array
    {
        return $this->lines->getLines();
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
