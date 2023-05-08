<?php
namespace Boringue\Backend\aplication\repositories\contract\pedido;

use Boringue\Backend\domain\entities\AgendaBanhoEntity;
use Boringue\Backend\domain\entities\HorarioBanhoEntity;
use Boringue\Backend\domain\entities\MethodPaymentEntity;
use Boringue\Backend\domain\entities\pedido\PedidoBanhoEntity;

interface PedidoBanhoRepositoryInterface{
    public function addHorario(HorarioBanhoEntity $horario);
    public function addBanho(AgendaBanhoEntity $agenda, PedidoBanhoEntity $pedido, MethodPaymentEntity $method);
    public function findBanho(PedidoBanhoEntity $pedido);
    public function findHorario();
    public function findAll();
    public function deleteHorario(HorarioBanhoEntity $horario);
}