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
            new QuantityValidator(),
            new PriceValidator(),
            new BagRequiredValidator(),
        ]);
    }
}
