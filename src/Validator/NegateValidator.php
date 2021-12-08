<?php

namespace Oop\Validator;

use Oop\Invoice;

class NegateValidator implements InvoiceValidatorInterface
{
    private InvoiceValidatorInterface $validator;
    private string $errorMessage;

    public function __construct(InvoiceValidatorInterface $validator, string $errorMessage)
    {
        $this->validator = $validator;
        $this->errorMessage = $errorMessage;
    }

    public function validate(Invoice $invoice): void
    {
        try {
            $this->validator->validate($invoice);
        } catch (\Throwable) {
            return;
        }

        throw new \LogicException($this->errorMessage);
    }
}
