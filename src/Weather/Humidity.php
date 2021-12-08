<?php

namespace Oop\Weather;

class Humidity
{
    private float $value;

    public function __construct(float $value)
    {
        if ($value < 0 || $value > 1) {
            throw new \InvalidArgumentException(sprintf(
                'Expected a value between 0 and 1, got "%.2f".',
                $value
            ));
        }
        $this->value = $value;
    }

    public function toString(): string
    {
        return sprintf('%d%%', $this->value * 100);
    }
}
