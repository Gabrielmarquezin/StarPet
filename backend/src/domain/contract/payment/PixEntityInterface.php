<?php
namespace Boringue\Backend\domain\contract\payment;

interface PixEntityInterface{
    public function setEmail(string $email);
    public function setCPF(string $cpf);
    public function setCEP(string $cep);
    public function setBairro($bairro);
    public function setRua($rua);
    public function setUF($uf);
    public function setCity($city);
    public function setFirstName($name);
    public function setLastName($name);
    public function setStreetNumber(string $number);
}