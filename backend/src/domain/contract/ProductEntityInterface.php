<?php
namespace Boringue\Backend\domain\contract;

Interface ProductEntityInterface{
    public function setCod($cod);
    public function setPhoto($photo);
    public function setCodFichaTec($cod_fichatec);
    public function setCodCategoria($cod_categoria);
    public function setDescricao(string $descricao);
    public function setPreco(float $preco);
    public function setQuantidade(int $quantidade);
    public function setNome(string $nome);

    public function getCod();
    public function getPhoto();
    public function getCodFichaTec();
    public function getCodCategoria();
    public function getDescricao() :string;
    public function getPreco() :float;
    public function getQuantidade() :int;
    public function getNome();
}