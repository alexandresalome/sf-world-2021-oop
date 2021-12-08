<?php

namespace Oop\Weather\Reader;

class BerlinReader extends AbstractReader
{
    public function getName(): string
    {
        return 'berlin';
    }

    protected function getNestedArrays(): array
    {
        return ['measure'];
    }

    protected function getTemperatureKey(): string
    {
        return 'temp';
    }
}
