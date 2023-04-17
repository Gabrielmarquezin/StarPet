<?php
namespace Boringue\Backend\aplication\repositories\contract;

use Boringue\Backend\domain\entities\CategoriaEntity;
use Boringue\Backend\domain\entities\FichaPetEntity;
use Boringue\Backend\domain\entities\PetEntity;

interface PetRepositoryInterface{
    public function add(PetEntity $pet);
    public function addFichaPet(FichaPetEntity $ficha_pet);
    public function find(PetEntity $pet);
    public function findAll(PetEntity $pet);
    public function findByCategoria(PetEntity $pet, CategoriaEntity $categoria);
    public function updatePet(PetEntity $pet);
    public function deletePet(PetEntity $pet);
}