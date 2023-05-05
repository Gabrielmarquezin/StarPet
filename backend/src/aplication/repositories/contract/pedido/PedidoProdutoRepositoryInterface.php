<?php
namespace Boringue\Backend\aplication\repositories\contract\pedido;

use Boringue\Backend\domain\entities\CategoriaEntity;
use Boringue\Backend\domain\entities\MethodPaymentEntity;
use Boringue\Backend\domain\entities\pedido\PedidoProdutoEntity;

interface PedidoProdutoRepositoryInterface {
    public function addPedido(PedidoProdutoEntity $pedido, MethodPaymentEntity $method);
    public function findPedido(PedidoProdutoEntity $pedido);
    public function findPedidoByCategoria(CategoriaEntity $categoria);
    public function findPedidoByUser(PedidoProdutoEntity $pedido);
    public function findAllPedido();
}