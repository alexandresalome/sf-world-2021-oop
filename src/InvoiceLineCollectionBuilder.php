<?php

namespace Oop;

class InvoiceLineCollectionBuilder
{
    /**
     * @var InvoiceLineBuilder[]
     */
    private array $lineBuilders = [];

    public function addLine(int $quantity, string $description, Price $price): self
    {
        if (isset($this->lineBuilders[$description])) {
            throw new \RuntimeException(sprintf(
                'A line with description "%s" is already present.',
                $description
            ));
        }

        $this->lineBuilders[$description] = new InvoiceLineBuilder($quantity, $description, $price);

        return $this;
    }

    public function removeLine(string $description): self
    {
        $this->ensureLineExists($description);

        unset($this->lineBuilders[$description]);

        return $this;
    }

    public function increment(string $description, int $amount): self
    {
        $this->ensureLineExists($description);

        $this->lineBuilders[$description]->incrementQuantity($amount);

        return $this;
    }

    public function getInvoiceLineCollection(): InvoiceLineCollection
    {
        $lines = [];
        foreach ($this->lineBuilders as $lineBuilder) {
            $lines[] = $lineBuilder->getLine();
        }

        return new InvoiceLineCollection($lines);
    }

    private function ensureLineExists(string $description): void
    {
        if (!isset($this->lineBuilders[$description])) {
            throw new \RuntimeException(sprintf(
                'No line present with description "%s".',
                $description
            ));
        }
    }
}
