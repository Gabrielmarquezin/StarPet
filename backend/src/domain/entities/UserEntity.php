<?php
namespace Boringue\Backend\domain\entities;

use Boringue\Backend\domain\contract\UserInterface;

class UserEntity implements UserInterface{
    private static $nome;
    public static $email;
    private static $photo;
    private static $rua;
    private static $bairro;
    private static $casaNumber;
    private static $id;
    private static $senha;

    public function setNome(string $nome)
    {
        self::$nome = $nome;

        return $this;
    }

    public function setEmail(string $email)
    {
        self::$email = $email;

        return $this;
    }

    public function setPhoto($photo)
    {
        self::$photo = $photo;

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

    public function setCasaN(string $casaN)
    {
        self::$casaNumber = $casaN;

        return $this;
    }

    public function setId($id){
        self::$id = $id;

        return $this;
    }

    public function setSenha($senha)
    {
        self::$senha = $senha;
        return $this;
    }

    public function getNome()
    {
        return self::$nome;
    }

    public function getEmail()
    {
        return self::$email;
    }

    public function getPhoto()
    {
        return self::$photo;
    }

    public function getRua()
    {
        return self::$rua;
    }

    public function getBairro()
    {
        return self::$bairro;
    }

    public function getCasaN()
    {
        return self::$casaNumber;
    }

    public function getId(){
        return self::$id;
    }

    public function getSenha()
    {
        return self::$senha;
    }
}