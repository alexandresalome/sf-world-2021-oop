<?php

namespace Oop;

class InvoiceCliRenderer
{
    public function render(string $id, array $items): void
    {
        echo "INVOICE #$id\n\n";

        $total = 0;

        echo sprintf("%-20s %-8s %-8s\n", 'Description', 'Qty', 'Total');
        echo sprintf("%-20s %-8s %-8s\n", '-----------', '---', '-----');

        foreach ($items as [$qty, $desc, $price]) {
            echo sprintf("%-20s %-8s %-8s\n", $desc, $qty, $price);
            $total += $qty * $price;
        }

        echo "\n";
        echo sprintf("TOTAL: %s\n", $total);
    }
}
