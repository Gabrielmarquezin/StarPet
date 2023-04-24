<?php
namespace Boringue\Backend\domain\contract\payment;

interface CreditCardEntityInterface extends MethodPaymentInterface{
    public function setCardNumber(string $number);
    public function setExpMonth(string $exp_month);
    public function setExpYear(string $exp_year);
    public function setCodeSecurity(string $secutity);
    public function setName(string $name_cartao);
    public function setInstallments(int $installments);
    public function setDescription(string $description);
}