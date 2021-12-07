<?php

namespace Oop;

class InvoiceValidatorFactory
{
    /**
     * Returns the validator depending on the invoice, but does not execute it.
     */
    public function getInvoiceValidator(Invoice $invoice): InvoiceValidatorInterface
    {
        return new ChainValidator([
            new SpecialDayValidator('Tuesday', Price::euro(10000)),
            new SpecialDayValidator('Monday', Price::euro(1000)),
            new QuantityValidator(),
            new PriceValidator(),
            new BagRequiredValidator(),
        ]);
    }
}
