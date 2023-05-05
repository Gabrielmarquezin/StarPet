<?php
namespace Boringue\Backend\domain\entities;

use Boringue\Backend\domain\contract\AdocaoEntityInterface;

class AdocaoEntity implements AdocaoEntityInterface{
    private static $cod_adocao;
    private static $cod_user;
    private static $cod_pet;
    private static $email;
    private static $telefone;
    private static $CPF;
    private static $rua;
    private static $bairro;
    private static $number_house;
    private static $data;

    public function setCod($cod)
    {
        self::$cod_adocao = $cod;
        return $this;
    }

    public function setCodUser($cod)
    {
        self::$cod_user = $cod;
        return $this;
    }

    public function setCodProduto($cod)
    {
        self::$cod_pet = $cod;
        return $this;
    }

    public function setEmail(string $email)
    {
        self::$email = $email;
        return $this;
    }

    public function setTelefone(string $telefone)
    {
        self::$telefone = $telefone;
        return $this;
    }

    public function setCPF(string $cpf)
    {
        self::$CPF = $cpf;
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
        self::$number_house = $number_house;
        return $this;
    }

    public function setDataAdocao($date)
    {
        self::$data = $date;
        return $this;
    }

    public function getCod()
    {
        return self::$cod_adocao;
    }

    public function getCodUser()
    {
        return self::$cod_user;
    }

    public function getCodProduto()
    {
       return self::$cod_pet;
    }

    public function getEmail() :string
    {
        return self::$email;
    }

    public function getTelefone() :string
    {
        return self::$telefone;
    }

    public function getCPF() :string
    {
        return self::$CPF;
    }

    public function getRua() :string
    {
        return self::$rua;
    }

    public function getBairro() :string
    {
        return self::$bairro;
    }

    public function getCasaN() :string
    {
        return self::$number_house;
    }

    public function getDataAdocao()
    {
       return self::$data;
    }
}