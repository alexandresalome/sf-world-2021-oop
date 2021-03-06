<?php

declare(strict_types=1);

namespace Oop\Validator;

use Oop\Invoice;

class BagRequiredValidator implements InvoiceValidatorInterface
{
    public function validate(Invoice $invoice): void
    {
        foreach ($invoice->getLines() as $line) {
            if("Bag" === $line->getDescription())
            {
                return;
            }
        }

        throw new \LogicException("No Bag inserted");
    }
}
