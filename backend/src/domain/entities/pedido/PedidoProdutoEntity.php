<?php
namespace Boringue\Backend\domain\entities\pedido;

use Boringue\Backend\domain\contract\pedido\PedidoInterface;

class PedidoProdutoEntity implements PedidoInterface{
    private static $cod_user;
    private static $cod_produto;
    private static $cod_pagamento;
    private static $telefone;
    private static $cpf;
    private static $rua;
    private static $bairro;
    private static $casa_number;
    private static $email;
    private static $preco;
    private static $cep;
    private static $nome;

    public function setCodPagamento($cod)
    {
        self::$cod_pagamento = $cod;
        return $this;
    }
   
    public function setCodUser($cod)
    {
        self::$cod_user = $cod;
        return $this;
    }

    public function setCodProduto($cod)
    {
        self::$cod_produto = $cod;
        return $this;
    }

    public function setTelefone(string $telefone)
    {
        self::$telefone = $telefone;
        return $this;
    }

    public function setCPF(string $cpf)
    {
        self::$cpf = $cpf;
        return $this;
    }

    public function setRua(string $rua)
    {
        self::$rua = $rua;
        return $this;
    }

    public function setBairro(string $bairro)
    {
        self::$bairro = $bairro;
        return $this;
    }

    public function setCasaN(string $number_house)
    {
        self::$casa_number = $number_house;
        return $this;
    }

    public function setEmail(string $email)
    {
        self::$email = $email;
        return $this;
    }

    public function setPreco($preco){
        self::$preco = $preco;
        return $this;
    }

    public function setNome($nome)
    {
        self::$nome = $nome;
        return $this;
    }

    public function setCep(string $cep)
    {
        self::$cep = $cep;
        return $this;
    }

    public function getCodPagamento()
    {
        return self::$cod_pagamento;
    }

    public function getCodUser()
    {
        return self::$cod_user;
    }

    public function getCodProduto()
    {
        return self::$cod_produto;
    }

    public function getTelefone(): string
    {
        return self::$telefone;
    }

    public function getCPF(): string
    {
        return self::$cpf;
    }

    public function getRua(): string
    {
        return self::$rua;
    }

    public function getBairro(): string
    {
        return self::$bairro;
    }

    public function getCasaN(): string
    {
        return self::$casa_number;
    }

    public function getEmail(): string
    {
        return self::$email;
    }

    public function getPreco(){
        return self::$preco;
    }

    public function getNome()
    {
        return self::$nome;
    }

    public function getCep()
    {
        return self::$cep;
    }
}