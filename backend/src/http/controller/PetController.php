<?php
namespace Boringue\Backend\http\controller;

use Boringue\Backend\aplication\repositories\PetRepository;
use Boringue\Backend\aplication\useCase\PetCase;
use Boringue\Backend\config\Database;
use Boringue\Backend\domain\entities\FichaPetEntity;
use Boringue\Backend\domain\entities\PetEntity;
use Boringue\Backend\http\controller\contract\ProdutoControllerInterface;
use Exception;
use Pet;

class PetController implements ProdutoControllerInterface{
    public function add()
    {
        $body = file_get_contents('php://input');
        $dados = json_decode($body, true);

        $pet_case = new PetCase($dados);
        try{
            $response = $pet_case->addPet(new PetEntity(), new FichaPetEntity(),new PetRepository(new Database()));

            echo json_encode(["idPet" => $response, "data" => date("Y-m-d H:i:s"), "status" => "adicionado"]);
        }catch(Exception $e){
            echo json_encode($e->getMessage());
        }
    }

    public function getByCategoria()
    {
        $dados = [
            "categoria" => $_GET['nome']
        ];
        $pet_case = new PetCase($dados);

        try{
            $pets = $pet_case->getByCategoria(new PetEntity, new PetRepository(new Database()));

            echo json_encode($pets);
        }catch(Exception $e){
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function get()
    {
        $idPet = empty($_GET['id']) == 1 ? 0 : intval($_GET['id']);
        $dados = [
            "idPet" => $idPet
        ];
        $pet_case = new PetCase($dados);

        try{
            $pets = $pet_case->getPet(new PetEntity, new PetRepository(new Database()));

            echo json_encode($pets);
        }catch(Exception $e){
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function update()
    {
        
    }

    public function delete()
    {
        $body = file_get_contents('php://input');
        $dados = json_decode($body, true);

        $data = [
            "idPet" => $dados['idPet']
        ];

        $pet_case = new PetCase($data);
        try{
            $response = $pet_case->deletePet(new PetEntity, new PetRepository(new Database()));

            echo json_encode(["message" => $response, "data" => date("Y-m-d H:i:s")]);
        }catch(Exception $e){
            echo json_encode(["message" => $e->getMessage()]);
        }
    }
}