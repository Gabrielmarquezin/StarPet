<?php
namespace Boringue\Backend\http\controller;

use Boringue\Backend\aplication\repositories\UserRepository;
use Boringue\Backend\aplication\useCase\UserCase;
use Boringue\Backend\config\Database;
use Boringue\Backend\domain\entities\UserEntity;
use Boringue\Backend\http\controller\contract\UserControllerInterface;

class UserController implements UserControllerInterface{
    public function createUser()
    {
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            die('Method invalid');
        }

        $body = file_get_contents('php://input');
        $dados = json_decode($body, true);

        $UseCase = new UserCase($dados);
        $b = $UseCase->add(new UserEntity(), new UserRepository(new Database));
    
        echo json_encode($b);
    }

    public function getUser()
    {
        
    }

    public function updateUser()
    {
        
    }
}