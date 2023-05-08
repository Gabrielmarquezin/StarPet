<?php
namespace Boringue\Backend\domain\contract;

interface BanhoHorarioEntityInterface{
    public function setCod($cod);
    public function setHorario($horario);

    public function getCod();
    public function getHorario();
}