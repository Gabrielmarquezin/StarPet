<?php
namespace Boringue\Backend\aplication\useCase;

use Boringue\Backend\aplication\repositories\UserRepository;
use Boringue\Backend\domain\entities\UserEntity;

class UserCase{
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
             ->setRua($dados['rua'])
             ->setBairro($dados['bairro'])
             ->setCasaN($dados['casa_numero']);

        $r = $UserRepository->findUser($UserEntity);
        // $UserRepository->addUser($UserEntity);

        return $r;
    }
}