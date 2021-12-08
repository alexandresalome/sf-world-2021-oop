<?php

declare(strict_types=1);

namespace Oop;

class PublishedState extends AbstractState
{
    public function pay(): InvoiceStateInterface
    {
        return new PaidState();
    }

    public function cancel(): InvoiceStateInterface
    {
        return new CanceledState();
    }

}
