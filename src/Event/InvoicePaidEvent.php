<?php

namespace Oop\Event;

use Oop\Invoice;
use Symfony\Contracts\EventDispatcher\Event;

class InvoicePaidEvent extends Event
{
    public function __construct(private Invoice $invoice)
    {
    }

    public function getInvoice(): Invoice
    {
        return $this->invoice;
    }
}
