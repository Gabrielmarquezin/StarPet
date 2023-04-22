<?php
namespace Boringue\Backend\aplication\useCase\contract;

use Boringue\Backend\aplication\repositories\AdocaoRepository;
use Boringue\Backend\domain\entities\AdocaoEntity;

interface AdocaoCaseInterface{
    public function addPedidoAdocao(AdocaoEntity $adocao, AdocaoRepository $adocao_repository);
    public function getPedidoAdocao(AdocaoEntity $adocao, AdocaoRepository $adocao_repository);
}