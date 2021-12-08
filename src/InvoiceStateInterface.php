<?php

namespace Oop;

interface InvoiceStateInterface
{
    public function publish(): InvoiceStateInterface;

    public function pay(): InvoiceStateInterface;

    public function cancel(): InvoiceStateInterface;
}
