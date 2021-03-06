<?php

declare(strict_types=1);

namespace Oop\Validator;

use Oop\Invoice;

class QuantityValidator implements InvoiceValidatorInterface
{
    public function validate(Invoice $invoice): void
    {
        foreach ($invoice->getLines() as $line) {
            if($line->getQuantity() < 0)
            {
                throw new \LogicException("Quantity < 0");
            }
        }
    }
}
