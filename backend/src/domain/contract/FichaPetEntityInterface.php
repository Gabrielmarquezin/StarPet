<?php
namespace Boringue\Backend\domain\contract;

interface FichaPetEntityInterface{
    public function setCod($cod);
    public function setRaca(string $raca);
    public function setAlergias(string $alergias);
    public function setObservacoes(string $observacoes);
    public function setTamanho(string $tamanho);
    public function setEstoque(int $estoque);

    public function getCod();
    public function getRaca();
    public function getAlergias();
    public function getObservacoes();
    public function getTamanho();
    public function getEstoque();
}
