<?php
namespace Boringue\Backend\aplication\useCase\contract;

use Boringue\Backend\aplication\repositories\UserRepository;
use Boringue\Backend\domain\entities\UserEntity;

interface UserCaseInterface{
    public function add(UserEntity $UserEntity, UserRepository $UserRepository);
    public function find(UserEntity $UserEntity, UserRepository $UserRepository, $email);
}