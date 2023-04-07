<?php
namespace Boringue\Backend\domain\contract;

interface UserInterface{
    public function setNome(string $nome);
    public function setEmail(string $email);
    public function setPhoto($photo);
    public function setRua(string $rua);
    public function setBairro(string $bairro);
    public function setCasaN(string $casaN);

    public function getNome();
    public function getEmail();
    public function getPhoto();
    public function getRua();
    public function getBairro();
    public function getCasaN();

}