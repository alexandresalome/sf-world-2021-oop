<?php

namespace Oop\EventSubscriber;

use Oop\Event\InvoicePaidEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ConsoleLogSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            InvoicePaidEvent::class => 'onInvoicePaid'
        ];
    }

    public function onInvoicePaid(): void
    {
        echo "We confirm that the invoice was paid. Moneeeyyyyy $$$$\n";
    }
}
