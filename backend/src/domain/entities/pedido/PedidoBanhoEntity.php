<?php
namespace Boringue\Backend\domain\entities\pedido;

use Boringue\Backend\domain\contract\pedido\PedidoBanhoInterface;

class PedidoBanhoEntity implements PedidoBanhoInterface{
    private static $cod_agenda;
    private static $cod_user;
    private static $preco;
    private static $cod_pagamento;

    public function setCodAgenda($cod)
    {
        self::$cod_agenda = $cod;
        return $this;
    }

    public function setCodUser($cod)
    {
        self::$cod_user = $cod;
        return $this;
    }

    public function setPreco(float $preco)
    {
        self::$preco = $preco;
        return $this;
    }

    public function setCodPagamento($cod)
    {
        self::$cod_pagamento = $cod;
        return $this;
    }


    public function getCodAgenda()
    {
        return self::$cod_agenda;
    }

    public function getCodUser()
    {
        return self::$cod_user;
    }

    public function getPreco()
    {
        return self::$preco;
    }

    public function getCodPagamento()
    {
        return self::$cod_pagamento;
    }

}