<?php

declare(strict_types=1);

namespace Oop\Price;

// Value Object
class Price
{
    private int $cents;
    private Currency $currency;

    public function __construct(int $cents, Currency $currency)
    {
        $this->cents = $cents;
        $this->currency = $currency;
    }

    public function add(Price $price): Price
    {
        if (!$price->currency->equals($this->currency)) {
            throw new \LogicException(sprintf(
                'Cannot add "%s" and "%s".',
                $price->currency->toString(),
                $this->currency->toString()
            ));
        }

        return new Price(
            $price->cents + $this->cents,
            $this->currency
        );
    }

    public function multiply(float $ratio): Price
    {
        return new Price(
            (int) $ratio * $this->cents,
            $this->currency
        );
    }

    public static function euro(int $cents): Price
    {
        return new Price($cents, Currency::euro());
    }

    public function toString(): string
    {
        return sprintf(
            '%.2f %s',
            $this->cents / 100,
            $this->currency->toString(),
        );
    }

    public function isPositive(): bool
    {
        return $this->cents > 0;
    }

    public function isGreaterThan(Price $price): bool
    {
        if (!$price->currency->equals($this->currency)) {
            throw new \RuntimeException(sprintf(
                'Can\'t compare two prices in two different currencies ("%s" and "%s").',
                $price->currency->toString(),
                $this->currency->toString(),
            ));
        }

        return $this->cents > $price->cents;
    }
}
