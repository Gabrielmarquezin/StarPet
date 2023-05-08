<?php
namespace Boringue\Backend\domain\entities;

use Boringue\Backend\domain\contract\BanhoHorarioEntityInterface;

class HorarioBanhoEntity implements BanhoHorarioEntityInterface{
    private static $cod;
    private static $horario;

    public function setCod($cod)
    {
        self::$cod = $cod;
        return $this;
    }

    public function setHorario($horario)
    {
        self::$horario = $horario;
        return $this;
    }

    public function getCod()
    {
        return self::$cod;
    }

    public function getHorario()
    {
        return self::$horario;
    }
}