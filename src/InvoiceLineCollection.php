<?php

namespace Oop;

class InvoiceLineCollection
{
    /**
     * @var InvoiceLine[]
     */
    private array $lines;

    /**
     * @param InvoiceLine[] $lines
     */
    public function __construct(array $lines)
    {
        $this->lines = $lines;
    }

    /**
     * @return InvoiceLine[]
     */
    public function getLines(): array
    {
        return $this->lines;
    }

    public function getTotal(): Price
    {
        $total = Price::euro(0);
        foreach ($this->lines as $line) {
            $total = $total->add($line->getLinePrice());
        }

        return $total;
    }
}
