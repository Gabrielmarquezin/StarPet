<?php
namespace Boringue\Backend\aplication\useCase\contract;

use Boringue\Backend\aplication\repositories\AvaliacaoRepository;
use Boringue\Backend\domain\entities\AvaliacaoEntity;

interface AvaliacaoCaseInterface{
    public function add(AvaliacaoEntity $avaliacao, AvaliacaoRepository $avalicao_repository);

    public function get(AvaliacaoEntity $avaliacao, AvaliacaoRepository $avalicao_repository);
    public function getMessagePet(AvaliacaoEntity $avaliacao, AvaliacaoRepository $avalicao_repository);
    public function getMessagePetAdocao(AvaliacaoEntity $avaliacao, AvaliacaoRepository $avalicao_repository);

    public function update(AvaliacaoEntity $avaliacao, AvaliacaoRepository $avalicao_repository);
    public function updatePet(AvaliacaoEntity $avaliacao, AvaliacaoRepository $avalicao_repository);
    public function updateAdocao(AvaliacaoEntity $avaliacao, AvaliacaoRepository $avalicao_repository);

    public function delete(AvaliacaoEntity $avaliacao, AvaliacaoRepository $avalicao_repository);
    public function deletePet(AvaliacaoEntity $avaliacao, AvaliacaoRepository $avalicao_repository);
    public function deletePetAdocao(AvaliacaoEntity $avaliacao, AvaliacaoRepository $avalicao_repository);

}