<?php

namespace Oop;

class InvoiceCliRenderer implements InvoiceRendererInterface
{
    public function render(Invoice $invoice): void
    {
        echo sprintf("## INVOICE #%s\n\n", $invoice->getId());

        echo sprintf("%-20s %-8s %-8s\n", 'Description', 'Qty', 'Total');
        echo sprintf("%-20s %-8s %-8s\n", '-----------', '---', '-----');

        foreach ($invoice->getLines() as $line) {
            echo sprintf(
                "%-20s %-8s %-8s\n",
                $line->getDescription(),
                $line->getQuantity(),
                $line->getUnitPrice()->toString()
            );
        }

        echo "\n";
        echo sprintf("Delivery fees: %s\n", $invoice->getDeliveryFees()->toString());
        echo "\n";
        echo sprintf("TOTAL: %s\n", $invoice->getTotal()->toString());
    }
}
