<?php

declare(strict_types=1);

namespace Oop\Validator;

use Oop\Invoice;

class StaticValidator implements InvoiceValidatorInterface
{
    private bool $error;

    public function __construct(bool $error = false)
    {
        $this->error = $error;
    }

    public function validate(Invoice $invoice): void
    {
        if ($this->error) {
            throw new \LogicException('Neh!');
        }
    }
}
