<?php
namespace Boringue\Backend\domain\contract;

interface CategoriaEntityInterface{
    public function getCategoriaName();
    public function setCod($cod);
    public function getCod();
}