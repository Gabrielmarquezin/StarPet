<?php
namespace Boringue\Backend\aplication\repositories\contract;

use Boringue\Backend\domain\entities\CategoriaEntity;
use Boringue\Backend\domain\entities\FichaPetEntity;
use Boringue\Backend\domain\entities\PetEntity;

interface PetRepositoryInterface{
    public function add(PetEntity $pet);
    public function addPetAdocao(PetEntity $pet);

    public function addFichaPet(FichaPetEntity $ficha_pet);

    public function find(PetEntity $pet);
    public function findAll(PetEntity $pet);
    public function findByCategoria(PetEntity $pet, CategoriaEntity $categoria);

    public function findPetAdocao(PetEntity $pet);
    public function findAllPetAdocao(PetEntity $pet);
    public function findByCategoriaPetAdocao(PetEntity $pet, CategoriaEntity $categoria);

    public function updatePet(PetEntity $pet);
    public function updatePetAdocao(PetEntity $pet);

    public function deletePet(PetEntity $pet);
    public function deletePetAdocao(PetEntity $pet);

}