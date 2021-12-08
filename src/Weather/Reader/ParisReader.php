<?php

namespace Oop\Weather\Reader;

class ParisReader extends AbstractReader
{
    public function getName(): string
    {
        return 'paris';
    }
}
