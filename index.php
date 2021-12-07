<?php

namespace Main;

use Oop\InvoiceCliRenderer;
use Oop\InvoiceHtmlRenderer;
use Oop\InvoiceManager;
use Oop\StaticValidator;
use Symfony\Component\ErrorHandler\Debug;

require_once __DIR__.'/vendor/autoload.php';

Debug::enable();

// Configuration
$discounted = ($argv[1] ?? '') === 'discount';
$invoice = InvoiceManager::getInstance()->getFruitInvoice($discounted);

$validator = new StaticValidator(true);
$validator->validate($invoice);

$cli = PHP_SAPI === 'cli';
/** @var \Oop\InvoiceRendererInterface $renderer */
$renderer = $cli ? new InvoiceCliRenderer() : new InvoiceHtmlRenderer();
$renderer->render($invoice);
