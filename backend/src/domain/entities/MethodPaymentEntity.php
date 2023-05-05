<?php
namespace Boringue\Backend\domain\entities;

use Boringue\Backend\domain\contract\payment\MethodPaymentInterface;

class MethodPaymentEntity implements MethodPaymentInterface{
    private static $method;
    private static $cod_transaction;
    private static $estado;

    public function setMethod($method)
    {
        self::$method = $method;
        return $this;
    }

    public function setCodTransaction($cod)
    {
        self::$cod_transaction = $cod;
        return $this;
    }

    public function setState($state)
    {
        self::$estado = $state;
        return $this;
    }

    public function getMethod()
    {
        return self::$method;
    }

    public function getCodTransaction()
    {
        return self::$cod_transaction;
    }

    public function getState()
    {
        return self::$estado;
    }
}