<?php

declare(strict_types=1);

namespace Oop;

class InvoiceManager
{
    private static ?self $instance = null;

    private function __construct()
    {
        self::$instance = $this;
    }

    public static function getInstance(): self
    {
        if (null === self::$instance) {
            self::$instance = new InvoiceManager();
        }

        return self::$instance;
    }

    public function getFruitInvoice(bool $discounted): Invoice
    {
        // Either be filled by the user or fetched from a service
        $id = 123;
        $lines = [
            [300, 'Apples', Price::euro(39)],
            [2, 'Bananas', Price::euro(60)],
            [1, 'Bag', Price::euro(100)],
        ];

        // Discount logic f($items) --> $items
        foreach ($lines as $key => [$qty, $desc, $price]) {
            if ($desc === 'Bananas' && $discounted) {
                $lines[$key][2] = $lines[$key][2]->multiply(0.5);
                $lines[$key][1] .= ' (-50%)';
            }

            if ($desc === 'Apples' && $discounted) {
                $lines[$key][2] = $lines[$key][2]->multiply(0.9);
                $lines[$key][1] .= ' (-10%)';
            }
        }

        $lines = array_map(function ($line) {
            return new InvoiceLine($line[0], $line[1], $line[2]);
        }, $lines);

        return new Invoice($id, new InvoiceLineCollection($lines));
    }
}
