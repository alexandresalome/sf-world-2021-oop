<?php

namespace Oop\EventSubscriber;

class ConsoleLogOnOrderPaid
{
    public function __invoke(): void
    {
        echo "We confirm that the invoice was paid. Moneeeyyyyy $$$$\n";
    }
}
