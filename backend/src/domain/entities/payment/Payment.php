<?php
namespace Boringue\Backend\domain\entities\payment;

use Boringue\Backend\domain\contract\payment\PaymentInterface;

class Payment implements PaymentInterface{
    private static $payment;
    public function __construct($payment)
    {
        self::$payment = $payment;
    }

    public function setMethod($method)
    {
        
        return $method->setGateway(self::$payment);
    }

    public function setDescription($description)
    {
        self::$payment->description = $description;
        return $this;
    }

    public function setNotification($url)
    {
        self::$payment->notification_url = $url;
        return $this;
    }

    public function setAmount($amount)
    {
        self::$payment->transaction_amount = $amount;
        return $this;
    }

    public function pay(): array
    {

        return [];
    }
}