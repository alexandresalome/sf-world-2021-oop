<?php

namespace Oop;

class InvoiceHtmlRenderer
{
    public function render(string $id, array $items): void
    {
        echo "<h1>INVOICE #$id</h1>";
        echo '<pre>';

        $total = 0;

        echo sprintf("%-20s %-8s %-8s\n", 'Description', 'Qty', 'Total');
        echo sprintf("%-20s %-8s %-8s\n", '-----------', '---', '-----');

        foreach ($items as [$qty, $desc, $price]) {
            echo sprintf("%-20s %-8s %-8s\n", $desc, $qty, $price);
            $total += $qty * $price;
        }

        echo "\n";
        echo sprintf("<strong>>TOTAL</strong>: %s</pre>", $total);
    }
}
