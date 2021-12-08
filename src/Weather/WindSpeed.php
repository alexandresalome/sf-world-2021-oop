<?php

namespace Oop\Weather;

class WindSpeed
{
    private float $value;
    private string $system;

    public function __construct(float $value, string $system)
    {
        $this->value = $value;
        $this->system = $system;
    }

    public static function kilometersPerHour(float $value): self
    {
        return new self($value, 'km/h');
    }

    public static function milesPerHour(float $value): self
    {
        return new self($value, 'mi/h');
    }

    public function toString(): string
    {
        return sprintf('%.2f %s', $this->value, $this->system);
    }
}
