<?php
namespace Boringue\Backend\aplication\useCase\contract;

use Boringue\Backend\aplication\repositories\PetRepository;
use Boringue\Backend\domain\entities\FichaPetEntity;
use Boringue\Backend\domain\entities\PetEntity;

interface PetCaseInterface{
    public function addPet(PetEntity $pet, FichaPetEntity $ficah_pet ,PetRepository $pet_repository);
    public function getPet(PetEntity $pet, PetRepository $pet_repository);
    public function getByCategoria(PetEntity $pet, PetRepository $pet_repository);
    public function updatePet(PetEntity $pet, PetRepository $pet_repository);
    public function deletePet(PetEntity $pet, PetRepository $pet_repository);
}