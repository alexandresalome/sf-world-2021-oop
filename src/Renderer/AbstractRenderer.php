<?php

namespace Oop\Renderer;

use Oop\Invoice;
use Oop\InvoiceLine;

abstract class AbstractRenderer implements InvoiceRendererInterface
{
    abstract protected function renderHeading(Invoice $invoice): void;
    abstract protected function renderLine(InvoiceLine $line): void;
    abstract protected function renderFooter(Invoice $invoice): void;
    abstract protected function renderSeparator(): void;

    protected function renderLineEnd(): void
    {
    }

    protected function renderLineStart(): void
    {
    }

    public function render(Invoice $invoice): void
    {
        $this->renderHeading($invoice);
        $this->renderSeparator();

        $this->renderLineStart();
        foreach ($invoice->getLines() as $line) {
            $this->renderLine($line);
        }
        $this->renderLineEnd();

        $this->renderSeparator();

        $this->renderFooter($invoice);
    }
}
