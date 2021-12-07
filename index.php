<?php

namespace Main;

use Oop\InvoiceCliRenderer;
use Oop\InvoiceHtmlRenderer;
use Symfony\Component\ErrorHandler\ErrorHandler;

require_once __DIR__.'/vendor/autoload.php';

ErrorHandler::register();

// Configuration
$discounted = ($argv[1] ?? '') === 'discount';

// Either be filled by the user or fetched from a service
$id = 123;
$items = [
    [3, 'Apples', 39],
    [2, 'Bananas', 60],
    [1, 'Bag', 100],
];

// Discount logic f($items) --> $items
foreach ($items as $key => [$qty, $desc, $price]) {
    if ($desc === 'Bananas' && $discounted) {
        $items[$key][2] /= 2;
        $items[$key][1] .= ' (-50%)';
    }

    if ($desc === 'Apples' && $discounted) {
        $items[$key][2] = (int) $items[$key][2] * .9;
        $items[$key][1] .= ' (-10%)';
    }
}

$cli = PHP_SAPI === 'cli';
$renderer = $cli ? new InvoiceCliRenderer() : new InvoiceHtmlRenderer();
$renderer->render($id, $items, $discounted);
