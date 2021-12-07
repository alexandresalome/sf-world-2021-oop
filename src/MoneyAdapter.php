<?php

namespace Oop;

use Money\Money;

class MoneyAdapter extends Price
{
    public function __construct(Money $money)
    {
        parent::__construct(
            $money->getAmount(),
            new Currency($money->getCurrency()->getCode())
        );
    }
}
