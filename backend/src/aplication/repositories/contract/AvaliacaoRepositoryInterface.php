<?php
namespace Boringue\Backend\aplication\repositories\contract;

use Avaliacao;
use Boringue\Backend\domain\entities\AvaliacaoEntity;

interface AvaliacaoRepositoryInterface{
    public function addMessage(AvaliacaoEntity $avaliacao);
    public function addMessagePet(AvaliacaoEntity $avaliacao);
    public function addMessagePetAdocao(AvaliacaoEntity $avaliacao);

    public function findMessage(AvaliacaoEntity $avaliacao);
    public function findMessagePet(AvaliacaoEntity $avaliacao);
    public function findMessageAdocao(AvaliacaoEntity $avaliacao);
    
    public function updateMessage(AvaliacaoEntity $avaliacao, string $table_name);
    public function deleteMessage(AvaliacaoEntity $avaliacao, string $table_name);
}