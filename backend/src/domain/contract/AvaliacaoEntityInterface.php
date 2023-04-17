<?php
namespace Boringue\Backend\domain\contract;

interface AvaliacaoEntityInterface{
    public function setCod($cod);
    public function setStar(int $star);
    public function setMessage(string $message);
    public function setCodUser($cod_user);
    public function setCodProduto($cod_produto);

    public function getCod();
    public function getStar() :int;
    public function getMessage() :string;
    public function getCodUser();
    public function getCodProduto();

}