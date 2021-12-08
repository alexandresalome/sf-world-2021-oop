<?php

declare(strict_types=1);

namespace Oop\Validator;

use Oop\Invoice;

class NegateValidator implements InvoiceValidatorInterface
{
    private InvoiceValidatorInterface $validator;
    private string $message;

    public function __construct(InvoiceValidatorInterface $validator, string $message)
    {
        $this->validator = $validator;
        $this->message = $message;
    }

    public function validate(Invoice $invoice): void
    {
        try {
            $this->validator->validate($invoice);
        } catch (\RuntimeException $exception) {
            return;
        }

        throw new \RuntimeException($this->message);
    }
}
