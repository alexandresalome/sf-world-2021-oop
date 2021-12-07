<?php

declare(strict_types=1);

namespace Oop;

class SpecialDayValidator implements InvoiceValidatorInterface
{
    private string $day;
    private Price $minimumPrice;

    public function __construct(string $day, Price $minimumPrice)
    {
        $this->day = $day;
        $this->minimumPrice = $minimumPrice;
    }

    public function validate(Invoice $invoice): void
    {
        $total = $invoice->getTotal();

        if (date('l') !== $this->day) {
            return;
        }

        if ($total->isGreaterThan($this->minimumPrice)) {
            return;
        }

        throw new \RuntimeException(sprintf(
            'We don\'t accept order lower than "%s" on "%s".',
            $this->minimumPrice->toString(),
            $this->day
        ));
    }
}
