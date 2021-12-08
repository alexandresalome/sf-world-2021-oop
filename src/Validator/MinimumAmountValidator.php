<?php

declare(strict_types=1);

namespace Oop\Validator;

use Oop\Invoice;
use Oop\Price\Price;

class MinimumAmountValidator implements InvoiceValidatorInterface
{

    private Price $minPrice;

    public function __construct(Price $minPrice)
    {
        $this->minPrice = $minPrice;
    }

    public function validate(Invoice $invoice): void
    {
        if (!$invoice->getTotal()->isGreaterThan($this->minPrice)) {
            throw new \RuntimeException("Min amount is {$this->minPrice->toString()}");
        }
    }
}
