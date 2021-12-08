<?php

declare(strict_types=1);

namespace Oop;

use Oop\Price\Price;

class Invoice
{
    private int $id;
    private InvoiceLineCollection $lines;
    private InvoiceStateInterface $state;

    /** @var callable[] */
    private array $onPaidListeners = [];

    public function __construct(int $id, InvoiceLineCollection $lines)
    {
        $this->id = $id;
        $this->lines = $lines;

        $this->state = new DraftState();
    }

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return InvoiceLineCollection
     */
    public function getLines(): InvoiceLineCollection
    {
        return $this->lines;
    }

    public function getTotal(): Price
    {
        return $this->lines->getTotal()->add($this->getDeliveryFees());
    }

    public function getDeliveryFees(): Price
    {
        return Price::euro(700);
    }

    public function publish(): void
    {
        $this->state = $this->state->publish();
    }

    public function onPaid(callable $callable): void
    {
        $this->onPaidListeners[] = $callable;
    }

    public function pay(): void
    {
        $this->state = $this->state->pay();
        foreach ($this->onPaidListeners as $listener) {
            $listener($this);
        }
    }

    public function cancel(): void
    {
        $this->state = $this->state->cancel();
    }
}
