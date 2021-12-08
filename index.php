<?php

declare(strict_types=1);

namespace Main;

use Money\Money;
use Oop\Builder\InvoiceBuilder;
use Oop\Renderer\InvoiceCliRenderer;
use Oop\Renderer\InvoiceHtmlRenderer;
use Oop\Validator\InvoiceValidatorFactory;
use Oop\Price\MoneyAdapter;
use Symfony\Component\ErrorHandler\Debug;

require_once __DIR__.'/vendor/autoload.php';

Debug::enable();

// Configuration
$discounted = ($argv[1] ?? '') === 'discount';
//$invoice = InvoiceManager::getInstance()->getFruitInvoice($discounted);

$invoice = (new InvoiceBuilder())
    ->setId(123)
    ->addLine(300, 'Apples', new MoneyAdapter(Money::EUR(39)))
    ->removeLine('Apples')
    ->addLine(1, 'Bananas', new MoneyAdapter(Money::EUR(60)))
    ->increment('Bananas', 1)
    ->addLine(1, 'Bag', new MoneyAdapter(Money::EUR(100)))
    ->addLine(300, 'Apples', new MoneyAdapter(Money::EUR(39)))
    ->getInvoice()
;


(new InvoiceValidatorFactory())
    ->getInvoiceValidator($invoice)
    ->validate($invoice)
;

$cli = PHP_SAPI === 'cli';
/** @var \Oop\InvoiceRendererInterface $renderer */
$renderer = $cli ? new InvoiceCliRenderer() : new InvoiceHtmlRenderer();
$renderer->render($invoice);
