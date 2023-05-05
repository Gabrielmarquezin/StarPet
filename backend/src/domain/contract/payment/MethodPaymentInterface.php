<?php
namespace Boringue\Backend\domain\contract\payment;

interface MethodPaymentInterface{
   public function setMethod($method);
   public function setCodTransaction($cod);
   public function setState($state);

   public function getMethod();
   public function getCodTransaction();
   public function getState();
}