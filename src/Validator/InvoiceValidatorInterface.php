<?php

declare(strict_types=1);

namespace Oop\Validator;

use Oop\Invoice;

interface InvoiceValidatorInterface
{
    /**
     * @throws \LogicException Invalid invoice
     */
    public function validate(Invoice $invoice): void;
}
