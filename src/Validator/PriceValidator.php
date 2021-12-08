<?php

declare(strict_types=1);

namespace Oop\Validator;

use Oop\Invoice;

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
