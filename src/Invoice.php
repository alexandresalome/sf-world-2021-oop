<?php

namespace Oop;

class Invoice
{
    private string $id;
    private array $lines;

    public function __construct(string $id, array $lines)
    {
        $this->id = $id;
        $this->lines = $lines;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getLines(): array
    {
        return $this->lines;
    }
}
