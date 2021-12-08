<?php

declare(strict_types=1);

namespace Oop\Validator;

use Oop\Invoice;

class ConditionalDayValidator implements InvoiceValidatorInterface
{

    private InvoiceValidatorInterface $validator;
    private string $day;

    public function __construct(InvoiceValidatorInterface $validator, string $day)
    {
        $this->validator = $validator;
        $this->day = $day;
    }

    public function validate(Invoice $invoice): void
    {
        if (date('l') !== $this->day) {
            return;
        }

        $this->validator->validate($invoice);
    }
}
