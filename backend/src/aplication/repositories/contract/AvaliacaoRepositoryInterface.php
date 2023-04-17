<?php
namespace Boringue\Backend\aplication\repositories\contract;

use Avaliacao;
use Boringue\Backend\domain\entities\AvaliacaoEntity;

interface AvaliacaoRepositoryInterface{
    public function addMessage(AvaliacaoEntity $avaliacao);
    public function findMessage(AvaliacaoEntity $avaliacao);
    public function updateMessage(AvaliacaoEntity $avaliacao);
    public function deleteMessage(AvaliacaoEntity $avaliacao);
}