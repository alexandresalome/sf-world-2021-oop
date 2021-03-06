<?php

declare(strict_types=1);

namespace Oop\Validator;

use Oop\Invoice;

class ChainValidator implements InvoiceValidatorInterface
{
    /**
     * @var InvoiceValidatorInterface[]
     */
    private array $validators;

    /**
     * @param InvoiceValidatorInterface[] $validators
     */
    public function __construct(array $validators)
    {
        $this->validators = $validators;
    }

    public function validate(Invoice $invoice): void
    {
        foreach ($this->validators as $validator) {
            $validator->validate($invoice);
        }
    }
}
