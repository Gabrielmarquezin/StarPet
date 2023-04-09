<?php
namespace Boringue\Backend\http\controller;

use Boringue\Backend\aplication\repositories\UserRepository;
use Boringue\Backend\aplication\useCase\UserCase;
use Boringue\Backend\config\Database;
use Boringue\Backend\domain\entities\UserEntity;
use Boringue\Backend\http\controller\contract\UserControllerInterface;
use Exception;

class UserController implements UserControllerInterface{
    public function createUser()
    {
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            die('Method invalid');
        }

        $body = file_get_contents('php://input');
        $dados = json_decode($body, true);

        try{
            $UseCase = new UserCase($dados);
            $response = $UseCase->add(new UserEntity(), new UserRepository(new Database));

            echo json_encode($response);
        }catch(Exception $e){
            echo json_encode($e->getMessage());
        }
    
    }

    public function getUser()
    {
        $email = empty($_GET['email']) == 1 ? 0 : $_GET['email'];
        $UseCase = new UserCase([]);
         
        $data = $UseCase->find(new UserEntity, new UserRepository(new Database), $email);
    
        echo json_encode($data);
    }

    public function updateUser()
    {
        
    }
}