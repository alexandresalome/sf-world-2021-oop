<?php

declare(strict_types=1);

namespace Oop;

use Oop\Price\Price;

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
