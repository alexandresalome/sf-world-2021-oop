<?php

namespace Oop;

class InvoiceCliRenderer implements InvoiceRendererInterface
{
    public function render(Invoice $invoice): void
    {
        echo sprintf("## INVOICE #%s\n\n", $invoice->getId());

        $total = 0;

        echo sprintf("%-20s %-8s %-8s\n", 'Description', 'Qty', 'Total');
        echo sprintf("%-20s %-8s %-8s\n", '-----------', '---', '-----');

        foreach ($invoice->getLines() as [$qty, $desc, $price]) {
            echo sprintf("%-20s %-8s %-8s\n", $desc, $qty, $price);
            $total += $qty * $price;
        }

        echo "\n";
        echo sprintf("TOTAL: %s\n", $total);
    }
}
