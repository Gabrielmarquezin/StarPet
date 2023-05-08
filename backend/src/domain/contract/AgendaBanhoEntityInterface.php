<?php
namespace Boringue\Backend\domain\contract;

interface AgendaBanhoEntityInterface{
    public function setCod($cod);
    public function setPetName(string $name);
    public function setEmail($email);
    public function setTelefone(string $telefone);
    public function setObservacoes($observacoes);
    public function setKitBanho($kit);
    public function setCodHorario($cod);

    public function getCod();
    public function getPetName();
    public function getEmail();
    public function getTelefone();
    public function getObservacoes();
    public function getKitBanho();
    public function getCodHorario();
}