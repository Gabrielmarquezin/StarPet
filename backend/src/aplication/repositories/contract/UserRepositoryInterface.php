<?php
namespace Boringue\Backend\aplication\repositories\contract;

use Boringue\Backend\domain\entities\UserEntity;

interface UserRepositoryInterface{
    public function findUser(UserEntity $user);
    public function addUser(UserEntity $user);
    public function findAll(UserEntity $user);
}