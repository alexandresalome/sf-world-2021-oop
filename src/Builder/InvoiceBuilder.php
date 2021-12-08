<?php

declare(strict_types=1);

namespace Oop\Builder;

use Oop\Invoice;
use Oop\Price\Price;

class InvoiceBuilder
{
    private int $id;

    private InvoiceLineCollectionBuilder $lines;

    public function __construct()
    {
        $this->lines = new InvoiceLineCollectionBuilder();
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function addLine(int $quantity, string $description, Price $price): self
    {
        $this->lines->addLine($quantity, $description, $price);

        return $this;
    }

    public function removeLine(string $description): self
    {
        $this->lines->removeLine($description);

        return $this;
    }

    public function increment(string $description, int $amount): self
    {
        $this->lines->increment($description, $amount);

        return $this;
    }

    public function getInvoice(): Invoice
    {
        return new Invoice($this->id, $this->lines->getInvoiceLineCollection());
    }
}
