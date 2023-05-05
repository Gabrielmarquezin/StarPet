<?php
namespace Boringue\Backend\aplication\useCase\contract\pedido;

use Boringue\Backend\domain\contract\pedido\PedidoInterface;
use Boringue\Backend\domain\entities\pedido\PedidoProdutoEntity;

interface PedidoCaseInterface{
    public function getPedido(PedidoProdutoEntity $pedido);
    public function addPedido(PedidoProdutoEntity $pedido);
}