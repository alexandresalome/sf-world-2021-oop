<?php

declare(strict_types=1);

namespace Oop\Validator;

use Oop\Invoice;
use Oop\Price\Price;

class InvoiceValidatorFactory
{
    /**
     * Returns the validator depending on the invoice, but does not execute it.
     */
    public function getInvoiceValidator(Invoice $invoice): InvoiceValidatorInterface
    {
        return new ChainValidator([
            new ConditionalDayValidator(new MinimumAmountValidator(Price::euro(10000000)), 'Friday'),
            new NegateValidator(new SpecialDayValidator('Wednesday', Price::euro(10000000)), 'No order > 100 on tuesday.'),
            new SpecialDayValidator('Tuesday', Price::euro(10000)),
            new SpecialDayValidator('Monday', Price::euro(1000)),
            new QuantityValidator(),
            new PriceValidator(),
            new BagRequiredValidator(),
        ]);
    }
}
