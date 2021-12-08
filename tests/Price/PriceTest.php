<?php

namespace Oop\Tests\Price;

use Oop\Price\Price;
use PHPUnit\Framework\TestCase;

class PriceTest extends TestCase
{
    public function testIsPositive_zero(): void
    {
        $price = Price::euro(0);
        $this->assertFalse($price->isPositive());
    }

    public function testIsPositive_one(): void
    {
        $price = Price::euro(1);
        $this->assertTrue($price->isPositive());
    }

    public function testIsPositive_negative(): void
    {
        $price = Price::euro(-1);
        $this->assertFalse($price->isPositive());
    }
}
