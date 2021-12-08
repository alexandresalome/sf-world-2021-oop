<?php

declare(strict_types=1);

namespace Oop\Renderer;

use Oop\Invoice;
use Oop\InvoiceLine;

class InvoiceCliRenderer extends AbstractRenderer
{
    protected function renderHeading(Invoice $invoice): void
    {
        echo sprintf("## INVOICE #%s\n", $invoice->getId());
    }

    protected function renderLine(InvoiceLine $line): void
    {
        echo sprintf(
            "%-20s %-8s %-8s\n",
            $line->getDescription(),
            $line->getQuantity(),
            $line->getUnitPrice()->toString()
        );
    }

    protected function renderFooter(Invoice $invoice): void
    {
        echo sprintf("Delivery fees: %s\n", $invoice->getDeliveryFees()->toString());
        echo "\n";
        echo sprintf("TOTAL: %s\n", $invoice->getTotal()->toString());
    }

    protected function renderSeparator(): void
    {
        echo "\n---------------------------------------\n\n";
    }
}
