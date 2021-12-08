<?php

declare(strict_types=1);

namespace Oop;

use Exception;
use Oop\Price\Price;
use Traversable;

class InvoiceLineCollection implements \IteratorAggregate
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

    public function getTotal(): Price
    {
        $total = Price::euro(0);
        foreach ($this->lines as $line) {
            $total = $total->add($line->getLinePrice());
        }

        return $total;
    }

    public function unitPriceLowerThan(Price $price): self
    {
        return $this->filterLines(function (InvoiceLine $line) use ($price) {
            return $line->getUnitPrice()->isLowerThan($price);
        });
    }

    public function noBag(): self
    {
        return $this->filterLines(function (InvoiceLine $line) {
            return $line->getDescription() !== 'Bag';
        });
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->lines);
    }

    private function filterLines(\Closure $callable): self
    {
        return new InvoiceLineCollection(array_filter($this->lines, $callable));
    }
}
