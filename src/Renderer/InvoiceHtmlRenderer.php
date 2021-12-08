<?php

declare(strict_types=1);

namespace Oop\Renderer;

use Oop\Invoice;
use Oop\InvoiceLine;

class InvoiceHtmlRenderer extends AbstractRenderer
{
    public function getName(): string
    {
        return 'html';
    }

    protected function renderHeading(Invoice $invoice): void
    {
        echo sprintf("<h1>INVOICE #%s</h1>", $invoice->getId());
    }

    protected function renderLineStart(): void
    {
        echo <<<EOT
        <table>
        <thead>
           <tr>
                <th>Description</th>
                <th>Quantity</th>
                <th>Unit Price</th>
            </tr>
        </thead>
        <tbody>
        EOT;
    }

    protected function renderLine(InvoiceLine $line): void
    {
        echo sprintf(
            "<tr><td>%-20s</td><td>%-8s</td><td>%-8s</td></tr>",
            $line->getDescription(),
            $line->getQuantity(),
            $line->getUnitPrice()->toString()
        );
    }

    protected function renderLineEnd(): void
    {
        echo '</table>';
    }

    protected function renderFooter(Invoice $invoice): void
    {
        echo sprintf("<p>Delivery fees: %s</p>", $invoice->getDeliveryFees()->toString());
        echo sprintf("<p>TOTAL: %s</p>", $invoice->getTotal()->toString());
    }

    protected function renderSeparator(): void
    {
        echo '<hr />';
    }
}
