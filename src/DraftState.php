<?php

declare(strict_types=1);

namespace Oop;

class DraftState extends AbstractState
{
    public function publish(): InvoiceStateInterface
    {
        return new PublishedState();
    }
}
