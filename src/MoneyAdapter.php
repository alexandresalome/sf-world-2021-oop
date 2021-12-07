<?php

declare(strict_types=1);

namespace Oop;

use Money\Money;

class MoneyAdapter extends Price
{
    public function __construct(Money $money)
    {
        $amount = $money->getAmount();
        if (!is_string($amount) || !preg_match('/^\d+$/', $amount)) {
            throw new \RuntimeException('!!!');
        }

        parent::__construct(
            (int) $amount,
            new Currency($money->getCurrency()->getCode())
        );
    }
}
