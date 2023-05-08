<?php
namespace Boringue\Backend\domain\entities;

use Boringue\Backend\domain\contract\AgendaBanhoEntityInterface;

class AgendaBanhoEntity implements AgendaBanhoEntityInterface{
    private static $email;
    private static $pet_name;
    private static $cod;
    private static $telefone;
    private static $observacoes;
    private static $kit;
    private static $cod_horario;

    public function setEmail($email)
    {
        self::$email = $email;
        return $this;
    }

    public function setPetName(string $name)
    {
        self::$pet_name = $name;
        return $this;
    }

    public function setCod($cod)
    {
        self::$cod = $cod;
        return $this;
    }

    public function setTelefone(string $telefone)
    {
        self::$telefone = $telefone;
        return $this;
    }

    public function setObservacoes($observacoes)
    {
        self::$observacoes = $observacoes;
        return $this;
    }

    public function setKitBanho($kit)
    {
        self::$kit = $kit;
        return $this;
    }

    public function setCodHorario($cod)
    {
        self::$cod_horario = $cod;
        return $this;
    }

    public function getEmail()
    {
        return self::$email;
    }

    public function getPetName()
    {
        return self::$pet_name;
    }

    public function getCod()
    {
        return self::$cod;
    }

    public function getTelefone()
    {
        return self::$telefone;
    }

    public function getObservacoes()
    {
        return self::$observacoes;
    }

    public function getKitBanho()
    {
        return self::$kit;
    }

    public function getCodHorario()
    {
        return self::$cod_horario;
    }

}