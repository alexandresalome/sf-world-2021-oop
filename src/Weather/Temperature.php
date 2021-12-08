<?php

namespace Oop\Weather;

class Temperature
{
    private float $value;
    private string $system;

    public function __construct(float $value, string $system)
    {
        $this->value = $value;
        $this->system = $system;
    }

    public static function celcius(float $value): self
    {
        return new self($value, 'C');
    }

    public function toString(): string
    {
        return sprintf('%.2f°%s', $this->value, $this->system);
    }
}
