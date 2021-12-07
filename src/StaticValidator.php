<?php

namespace Oop;

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
