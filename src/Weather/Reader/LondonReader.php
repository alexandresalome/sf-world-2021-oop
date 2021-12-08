<?php

namespace Oop\Weather\Reader;

class LondonReader extends AbstractReader
{
    public function getName(): string
    {
        return 'london';
    }

    protected function getWindSpeedSystem(): string
    {
        return 'mi/h';
    }
}
