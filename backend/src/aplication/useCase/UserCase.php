<?php
namespace Boringue\Backend\aplication\useCase;

use Boringue\Backend\aplication\repositories\UserRepository;
use Boringue\Backend\aplication\useCase\contract\UserCaseInterface;
use Boringue\Backend\domain\entities\UserEntity;
use Exception;

class UserCase implements UserCaseInterface{
    private $dados = [];

    public function __construct($dados)
    {
        $this->dados = $dados;
    }

    public function add(UserEntity $UserEntity ,UserRepository $UserRepository){
        $dados = $this->dados;

        $UserEntity->setNome($dados['nome'])
             ->setEmail($dados['email'])
             ->setPhoto($dados['photo'])
             ->setBairro($dados['bairro'])
             ->setRua($dados['rua'])
             ->setCasaN($dados['casa_numero']);

        $cont = $UserRepository->findUser($UserEntity);

        if(count($cont) == 0){
            $UserRepository->addUser($UserEntity);

            return "user create";
        }
        
        throw new Exception("user have been exist");
    }

    public function find(UserEntity $userEntity, UserRepository $userRepository, $email){
        if($email == 0){
            $users = $userRepository->findAll($userEntity);
            
            return $users;
        }else{
            $userEntity->setEmail($email);

            $user = $userRepository->findUser($userEntity);

            return $user;
        }
    }
}