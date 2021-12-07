<?php

namespace Oop;

class InvoiceHtmlRenderer implements InvoiceRendererInterface
{
    public function render(Invoice $invoice): void
    {
        echo sprintf("<h1>INVOICE #%s</h1>", $invoice->getId());
        echo '<pre>';

        $total = Price::euro(0);

        echo sprintf("%-20s %-8s %-8s\n", 'Description', 'Qty', 'Total');
        echo sprintf("%-20s %-8s %-8s\n", '-----------', '---', '-----');

        foreach ($invoice->getLines() as [$qty, $desc, $price]) {
            /** @var Price $price */
            echo sprintf("%-20s %-8s %-8s\n", $desc, $qty, $price);
            $total = $total->add($price->multiply($qty));
        }

        echo "\n";
        echo sprintf("<strong>>TOTAL</strong>: %s</pre>", $total);
    }
}
