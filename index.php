<?php

namespace Main;

use Oop\Currency;
use Oop\Invoice;
use Oop\InvoiceCliRenderer;
use Oop\InvoiceHtmlRenderer;
use Oop\InvoiceLine;
use Oop\InvoiceLineCollection;
use Oop\Price;
use Symfony\Component\ErrorHandler\Debug;

require_once __DIR__.'/vendor/autoload.php';

Debug::enable();

// Configuration
$discounted = ($argv[1] ?? '') === 'discount';

// Either be filled by the user or fetched from a service
$id = 123;
$lines = [
    [3, 'Apples', Price::euro(39)],
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

$invoice = new Invoice($id, new InvoiceLineCollection($lines));

$cli = PHP_SAPI === 'cli';
/** @var \Oop\InvoiceRendererInterface $renderer */
$renderer = $cli ? new InvoiceCliRenderer() : new InvoiceHtmlRenderer();
$renderer->render($invoice);
