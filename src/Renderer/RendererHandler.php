<?php

namespace Oop\Renderer;

use Oop\Invoice;

class RendererHandler
{
    /** @var InvoiceRendererInterface[] */
    private array $renderers = [];

    /**
     * @param InvoiceRendererInterface[] $renderers
     */
    public function __construct(array $renderers)
    {
        foreach ($renderers as $renderer) {
            $this->addRenderer($renderer);
        }
    }

    public function render(Invoice $invoice, string $renderer): void
    {
        if (!isset($this->renderers[$renderer])) {
            throw new \InvalidArgumentException(sprintf(
                'No renderer with name "%s". Available are: %s.',
                $renderer,
                implode(', ', array_keys($this->renderers)),
            ));
        }

        $this->renderers[$renderer]->render($invoice);
    }

    private function addRenderer(InvoiceRendererInterface $renderer): void
    {
        $this->renderers[$renderer->getName()] = $renderer;
    }
}
