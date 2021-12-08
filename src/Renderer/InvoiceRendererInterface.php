<?php

declare(strict_types=1);

namespace Oop\Renderer;

use Oop\Invoice;

interface InvoiceRendererInterface
{
    public function render(Invoice $invoice): void;
    public function getName(): string;
}
