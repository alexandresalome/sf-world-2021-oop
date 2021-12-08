<?php

declare(strict_types=1);

namespace Main;

use Money\Money;
use Oop\Builder\InvoiceBuilder;
use Oop\Event\InvoicePaidEvent;
use Oop\EventSubscriber\ConsoleLogOnOrderPaid;
use Oop\EventSubscriber\ConsoleLogSubscriber;
use Oop\Invoice;
use Oop\Price\Price;
use Oop\Renderer\InvoiceCliRenderer;
use Oop\Renderer\InvoiceHtmlRenderer;
use Oop\Renderer\InvoiceRendererInterface;
use Oop\Validator\InvoiceValidatorFactory;
use Oop\Price\MoneyAdapter;
use Symfony\Component\ErrorHandler\Debug;
use Symfony\Component\EventDispatcher\EventDispatcher;

require_once __DIR__.'/vendor/autoload.php';

Debug::enable();

// Configuration
$discounted = ($argv[1] ?? '') === 'discount';

$invoice = (new InvoiceBuilder())
    ->setId(123)
    ->addLine(300, 'Apples', new MoneyAdapter(Money::EUR(39)))
    ->removeLine('Apples')
    ->addLine(1, 'Bananas', new MoneyAdapter(Money::EUR(71)))
    ->increment('Bananas', 1)
    ->addLine(1, 'Bag', new MoneyAdapter(Money::EUR(30)))
    ->addLine(300, 'Apples', new MoneyAdapter(Money::EUR(39)))
    ->getInvoice()
;

(new InvoiceValidatorFactory())
    ->getInvoiceValidator($invoice)
    ->validate($invoice)
;

$invoice->publish();
$invoice->pay();

// $eventDispatcher = new EventDispatcher();
// $eventDispatcher->addSubscriber(new ConsoleLogSubscriber());
// $eventDispatcher->addListener(InvoicePaidEvent::class, function ($invoice) {
//     // do nothing :)
// });
// $eventDispatcher->dispatch(new InvoicePaidEvent($invoice));


$invoice->onPaid(new ConsoleLogOnOrderPaid());


// filter the invoice lines
// $invoice = new Invoice(
//     124,
//     $invoice->getLines()
//         ->unitPriceLowerThan(Price::euro(70))
//         ->noBag()
// );

$cli = PHP_SAPI === 'cli';
/** @var InvoiceRendererInterface $renderer */
$renderer = $cli ? new InvoiceCliRenderer() : new InvoiceHtmlRenderer();
$renderer->render($invoice);
