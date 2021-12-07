<?php

namespace Oop;

class InvoiceBuilder
{
    private string $id;

    /** @var InvoiceLine[] */
    private array $lines;

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function addLine(int $quantity, string $description, Price $price): self
    {
        $this->lines[$description] = new InvoiceLine($quantity, $description, $price);

        return $this;
    }

    public function removeLine(string $description): self
    {
        unset($this->lines[$description]);

        return $this;
    }

    public function increment(string $description, int $amount): self
    {
        $oldLine = $this->lines[$description];
        $newQuantity = $oldLine->getQuantity() + $amount;
        $newLine = new InvoiceLine($newQuantity, $description, $oldLine->getUnitPrice()->multiply($newQuantity));

        $this->lines[$description] = $newLine;

        return $this;
    }

    public function getInvoice(): Invoice
    {
        return new Invoice($this->id, new InvoiceLineCollection($this->lines));
    }
}
