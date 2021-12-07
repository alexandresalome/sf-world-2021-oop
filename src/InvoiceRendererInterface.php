<?php

namespace Oop;

interface InvoiceRendererInterface
{
    public function render(Invoice $invoice): void;
}
