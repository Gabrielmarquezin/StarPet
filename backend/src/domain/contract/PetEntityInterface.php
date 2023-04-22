<?php
namespace Boringue\Backend\domain\contract;

interface PetEntityInterface{
    public function setCod($cod);
    public function setPhoto($photo);
    public function setDesc(string $descricao);
    public function setEstoque(int $quantidade);
    public function setNome(string $nome);
    public function setCodCategoria($cod);
    public function setCodFihcaTec($cod);
    public function setPreco(float $preco);

    public function getCod();
    public function getPhoto();
    public function getDesc() :string;
    public function getEstoque() :int;
    public function getNome() :string;
    public function getCodCategoria();
    public function getCodFihcaTec();
    public function getPreco();
}