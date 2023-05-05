<?php
namespace Boringue\Backend\domain\contract\pedido;

interface PedidoInterface{
    public function setCodUser($cod);
    public function setCodProduto($cod);
    public function setCodPagamento($cod);
    public function setTelefone(string $telefone);
    public function setCPF(string $cpf);
    public function setRua(string $rua);
    public function setBairro(string $bairro);
    public function setCasaN(string $number_house);
    public function setEmail(string $email);
    public function setNome($nome);
    public function setCep(string $cep);

    public function getCodUser();
    public function getCodProduto();
    public function getCodPagamento();
    public function getTelefone() :string;
    public function getCPF() :string;
    public function getRua() :string;
    public function getBairro() :string;
    public function getCasaN() :string;
    public function getEmail() :string;
    public function getNome();
    public function getCep();
}