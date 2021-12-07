<?php

declare(strict_types=1);

namespace Oop;

class Currency
{
    private string $code;

    public function __construct(string $code)
    {
        if (!in_array($code, ['EUR', 'USD', 'CAD'], true)) {
            throw new \InvalidArgumentException('Unsupported currency.');
        }

        $this->code = $code;
    }

    public static function euro(): Currency
    {
        return new Currency('EUR');
    }

    public function equals(self $other): bool
    {
        return $this->code === $other->code;
    }

    public function toString(): string
    {
        return $this->code;
    }

}
