<?php

declare(strict_types=1);

namespace Oop;

interface InvoiceRendererInterface
{
    public function render(Invoice $invoice): void;
}
