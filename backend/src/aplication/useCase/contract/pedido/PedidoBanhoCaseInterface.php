<?php
namespace Boringue\Backend\aplication\useCase\contract\pedido;

use Boringue\Backend\domain\entities\AgendaBanhoEntity;
use Boringue\Backend\domain\entities\HorarioBanhoEntity;
use Boringue\Backend\domain\entities\MethodPaymentEntity;
use Boringue\Backend\domain\entities\pedido\PedidoBanhoEntity;

interface PedidoBanhoCaseInterface{
    public function addBanho(AgendaBanhoEntity $agenda, PedidoBanhoEntity $pedido, MethodPaymentEntity $method);
    public function getBanho(PedidoBanhoEntity $pedido);
}