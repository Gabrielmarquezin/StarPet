<?php
namespace Boringue\Backend\domain\contract;

interface FichaProdutoEntityInterface{
    public function setCod($cod);
    public function setLinha(string $linha);
    public function setModelo(string $modelo);
    public function setMarca(string $marca);
    public function setTamanho(string $tamanho);
    public function setCor(string $cor);
    public function setEstoque(string $estoque);

    public function getCod();
    public function getLinha() :string;
    public function getModelo() :string;
    public function getMarca() :string;
    public function getTamanho() :string;
    public function getCor() :string;
    public function getEstoque() :string;

}