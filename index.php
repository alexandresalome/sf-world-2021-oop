<?php

namespace Main;

use Oop\Invoice;
use Oop\InvoiceCliRenderer;
use Oop\InvoiceHtmlRenderer;
use Symfony\Component\ErrorHandler\ErrorHandler;

require_once __DIR__.'/vendor/autoload.php';

ErrorHandler::register();

// Configuration
$discounted = ($argv[1] ?? '') === 'discount';

// Either be filled by the user or fetched from a service
$id = 123;
$lines = [
    [3, 'Apples', 39],
    [2, 'Bananas', 60],
    [1, 'Bag', 100],
];

// Discount logic f($items) --> $items
foreach ($lines as $key => [$qty, $desc, $price]) {
    if ($desc === 'Bananas' && $discounted) {
        $lines[$key][2] /= 2;
        $lines[$key][1] .= ' (-50%)';
    }

    if ($desc === 'Apples' && $discounted) {
        $lines[$key][2] = (int) $lines[$key][2] * .9;
        $lines[$key][1] .= ' (-10%)';
    }
}

$invoice = new Invoice($id, $lines);

$cli = PHP_SAPI === 'cli';
/** @var \Oop\InvoiceRendererInterface $renderer */
$renderer = $cli ? new InvoiceCliRenderer() : new InvoiceHtmlRenderer();
$renderer->render($invoice);
