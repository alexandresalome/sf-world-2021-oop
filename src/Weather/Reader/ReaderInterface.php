<?php

namespace Oop\Weather\Reader;

use Oop\Weather\Weather;

interface ReaderInterface
{
    public function read(): Weather;
    public function getName(): string;
}
