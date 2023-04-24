<?php
namespace Boringue\Backend\domain\contract\payment;

interface MethodPaymentInterface{
    public function setCostumer(array $costumer);
    public function setShipping(array $adress);
    public function setNotification(string $url);
    public function setItemValues(array $item);
    public function pay();
}