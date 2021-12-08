<?php

declare(strict_types=1);

namespace Oop;

class AbstractState implements InvoiceStateInterface
{

    public function publish(): InvoiceStateInterface
    {
        throw new \Exception('Cannot change state');
    }

    public function pay(): InvoiceStateInterface
    {
        throw new \Exception('Cannot change state');
    }

    public function cancel(): InvoiceStateInterface
    {
        throw new \Exception('Cannot change state');
    }
}
