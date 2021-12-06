<?php

namespace Main;

use Symfony\Component\ErrorHandler\ErrorHandler;

require_once __DIR__.'/vendor/autoload.php';

ErrorHandler::register();

// Configuration
$discounted = ($argv[1] ?? '') === 'discount';
$id = 123;
$items = [
    [3, 'Apples', 39],
    [2, 'Bananas', 60],
    [1, 'Bag', 100],
];

echo "INVOICE #$id\n\n";

$total = 0;

echo sprintf("%-20s %-8s %-8s\n", 'Description', 'Qty', 'Total');
echo sprintf("%-20s %-8s %-8s\n", '-----------', '---', '-----');

foreach ($items as [$qty, $desc, $price]) {
    if ($desc === 'Bananas' && $discounted) {
        $price /= 2;
        $desc .= ' (-50%)';
    }

    if ($desc === 'Apples' && $discounted) {
        $price = (int) $price * .9;
        $desc .= ' (-10%)';
    }

    echo sprintf("%-20s %-8s %-8s\n", $desc, $qty, $price);
    $total += $qty * $price;
}

echo "\n";
echo sprintf("TOTAL: %s\n", $total);
