<?php
namespace Boringue\Backend\domain\contract\payment;

interface PaymentInterface{
    public function setAmount($amount);
    public function setDescription($description);
    public function setNotification($url);
    public function setMethod($method);
    public function pay() :array;
}