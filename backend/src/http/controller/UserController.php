<?php
namespace Boringue\Backend\http\controller;

use Boringue\Backend\aplication\repositories\UserRepository;
use Boringue\Backend\aplication\useCase\UserCase;
use Boringue\Backend\config\Database;
use Boringue\Backend\domain\entities\UserEntity;
use Boringue\Backend\http\controller\contract\UserControllerInterface;
use Exception;
use React\Dns\Query\RetryExecutor;

class UserController implements UserControllerInterface{
    public function createUser()
    {
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            die('Method invalid');
        }
        
        $body = file_get_contents('php://input');
        $dados = json_decode($body, true);
        
        $headers = getallheaders();
        $contentType = $headers["Content-Type"];

        if (strpos($contentType, 'multipart/form-data;') !== false) {
           
            $dados = [
                "nome" => $_POST["nome"],
                "email" => $_POST["email"],
                "photo" => isset($_FILES["photo"]) ? $_FILES["photo"] : "",
                "bairro" => $_POST["bairro"],
                "rua" => $_POST["rua"],
                "casa_numero" => $_POST["casa_numero"]
            ];
        }
        
        try{
            $UseCase = new UserCase($dados);
            $response = $UseCase->add(new UserEntity(), new UserRepository(new Database));
            
            echo json_encode(["message"=>"user create", "cod_user"=>$response]);
        }catch(Exception $e){
            echo json_encode($e->getMessage());
        }
    
    }

    public function getUser()
    {
        $cod = empty($_GET['cod']) == 1 ? 0 : $_GET['cod'];
        $UseCase = new UserCase([]);
         
        $data = $UseCase->find(new UserEntity, new UserRepository(new Database), $cod);
        
        echo json_encode($data);
    }

    public function getAdm()
    {
        $email = $_GET["email"];
        $senha = $_GET["senha"];

        $UseCase = new UserCase(["email" => $email, "senha" => $senha]);
         
        try{
            $data = $UseCase->findAdm(new UserEntity, new UserRepository(new Database));
        
            echo json_encode($data);
        }catch(Exception $e){
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function updateUser()
    {
        // if($_SERVER['REQUEST_METHOD'] !== 'PUT' || $_SERVER['REQUEST_METHOD'] !== 'POST'){
        //     die('Method invalid');
        // }

        $body = file_get_contents('php://input');
        $dados = json_decode($body, true);

        $headers = getallheaders();
        $contentType = $headers["Content-Type"];

        if(strpos($contentType, 'multipart/form-data;') !== false) {
    
            $dados = [
                "photo" => isset($_FILES["photo"]) ? $_FILES["photo"] : "",
                "bairro" => $_POST["bairro"],
                "rua" => $_POST["rua"],
                "casa_numero" => $_POST["casa_numero"],
                "cod_user" => (int)$_POST["cod_user"]
            ];
        }

        $UseCase = new UserCase($dados);
        try{
            $UseCase->updateUser(new UserEntity(), new UserRepository(new Database));
        
            echo json_encode(["message" => "atualizado"]);
        }catch(Exception $e){
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function createADM()
    {
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            die('Method invalid');
        }

        $body = file_get_contents('php://input');
        $dados = json_decode($body, true);

        $headers = getallheaders();
        $contentType = $headers["Content-Type"];

        if (strpos($contentType, 'multipart/form-data;') !== false) {
            $dados = [
                "nome" => $_POST["nome"],
                "email" => $_POST["email"],
                "photo" => isset($_FILES["photo"]) ? $_FILES["photo"] : "",
                "bairro" => $_POST["bairro"],
                "rua" => $_POST["rua"],
                "casa_numero" => $_POST["casa_numero"],
                "senha" => $_POST["senha"]
            ];
        }
        $UseCase = new UserCase($dados);
        try{
            $response = $UseCase->addAdm(new UserEntity(), new UserRepository(new Database));

            echo json_encode(["message" => "adm ".$response." adicionado"]);
        }catch(Exception $e){
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

}