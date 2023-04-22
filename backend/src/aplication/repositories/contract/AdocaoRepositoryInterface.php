<?php
namespace Boringue\Backend\aplication\repositories\contract;

use Boringue\Backend\domain\entities\AdocaoEntity;
use Boringue\Backend\domain\entities\CategoriaEntity;
use Boringue\Backend\domain\entities\UserEntity;

interface AdocaoRepositoryInterface{
    public function add(AdocaoEntity $adocao);
    public function find(AdocaoEntity $adocao);
    public function findByPet(AdocaoEntity $adocao);
    public function findByCategoriaProduto(CategoriaEntity $categoria, UserEntity $user);
    public function findAll();
}