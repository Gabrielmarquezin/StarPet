<?php
namespace Boringue\Backend\domain\contract;

use Boringue\Backend\domain\contract\pedido\PedidoInterface;

interface AdocaoEntityInterface{
    public function setDataAdocao($date);
    public function getDataAdocao();
}