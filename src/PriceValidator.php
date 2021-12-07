<?php

namespace Oop;

class PriceValidator implements InvoiceValidatorInterface
{
    public function validate(Invoice $invoice): void
    {
        foreach ($invoice->getLines() as $line) {
            if(!$line->getUnitPrice()->isPositive())
            {
                throw new \LogicException("Price < 0");
            }
        }
    }
}
