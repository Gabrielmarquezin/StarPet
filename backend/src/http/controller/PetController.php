<?php
namespace Boringue\Backend\http\controller;

use Boringue\Backend\aplication\repositories\PetRepository;
use Boringue\Backend\aplication\useCase\PetCase;
use Boringue\Backend\config\Database;
use Boringue\Backend\domain\entities\FichaPetEntity;
use Boringue\Backend\domain\entities\PetEntity;
use Boringue\Backend\http\controller\contract\ProdutoControllerInterface;
use Boringue\Backend\http\middlewares\CPF;
use Exception;
use Pet;

class PetController implements ProdutoControllerInterface{
    public function add()
    {
        $body = file_get_contents('php://input');
        $dados = json_decode($body, true);

        $headers = getallheaders();
        $contentType = $headers["Content-Type"];

        if (strpos($contentType, 'multipart/form-data;') !== false) {
            $dados = [
                "nome" => $_POST["nome"],
                "categoria" => $_POST["categoria"],
                "photo" => isset($_FILES["photo"]) ? $_FILES["photo"] : "",
                "descricao" => $_POST["descricao"],
                "preco" => $_POST["preco"],
                "quantidade" => $_POST["quantidade"],
                "ficha_pet" => [
                    "raca" => $_POST["raca"],
                    "alergias" => $_POST["alergias"],
                    "observacoes" => $_POST["observacoes"],
                    "tamanho" => $_POST["tamanho"],
                    "estoque" => $_POST["estoque"]
                ]
            ];
        }

        $pet_case = new PetCase($dados);
        try{
            $response = $pet_case->addPet(new PetEntity(), new FichaPetEntity(),new PetRepository(new Database()));

            echo json_encode(["idPet" => $response, "data" => date("Y-m-d H:i:s"), "status" => "adicionado"]);
        }catch(Exception $e){
            echo json_encode($e->getMessage());
        }
    }

    public function addPetAdocao()
    {
        $body = file_get_contents('php://input');
        $dados = json_decode($body, true);

        $headers = getallheaders();
        $contentType = $headers["Content-Type"];

        if (strpos($contentType, 'multipart/form-data;') !== false) {
            $dados = [
                "cod_user" => $_POST["cod_user"],
                "cod_pet" => $_POST["cod_pet"],
                "email" => $_POST["email"],
                "cpf" => $_POST["cpf"],
                "rua" => $_POST["rua"],
                "bairro" => $_POST["bairro"],
                "telefone" => $_POST["telefone"],
                "casa_number" => $_POST["casa_number"]
            ];
        }

        $pet_case = new PetCase($dados);
        $middleware = new CPF($dados['cpf']);
        try{
            $middleware->lenghtCPF();
            $middleware->isInvalid();

            $response = $pet_case->addPetAdocao(new PetEntity(), new FichaPetEntity(),new PetRepository(new Database()));

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

    public function getByCategoriaPetAdocao()
    {
        $dados = [
            "categoria" => $_GET['nome']
        ];
        $pet_case = new PetCase($dados);

        try{
            $pets = $pet_case->getByCategoriaPetAdocao(new PetEntity, new PetRepository(new Database()));

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

    public function getPetAdocao()
    {
        $idPet = empty($_GET['id']) == 1 ? 0 : intval($_GET['id']);
        $dados = [
            "idPet" => $idPet
        ];
    
        $pet_case = new PetCase($dados);

        try{
            $pets = $pet_case->getPetAdocao(new PetEntity, new PetRepository(new Database()));

            echo json_encode($pets);
        }catch(Exception $e){
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function update()
    {
        $body = file_get_contents('php://input');
        $dados = json_decode($body, true);

        $headers = getallheaders();
        $contentType = $headers["Content-Type"];

        if (strpos($contentType, 'multipart/form-data;') !== false) {
            $dados = [
                "nome" => $_POST["nome"],
                "photo" => isset($_FILES["photo"]) ? $_FILES["photo"] : "",
                "descricao" => $_POST["descricao"],
                "preco" => $_POST["preco"],
                "cod" => $_POST["cod"],
            ];
        }

        $pet_case = new PetCase($dados);
        try{
            $response = $pet_case->updatePet(new PetEntity(), new PetRepository(new Database()));
            echo json_encode(["message" => $response, "data" => date("Y-m-d H:i:s")]);
        }catch(Exception $e){
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function updatePetAdocao()
    {
        $body = file_get_contents('php://input');
        $dados = json_decode($body, true);

        $headers = getallheaders();
        $contentType = $headers["Content-Type"];

        if (strpos($contentType, 'multipart/form-data;') !== false) {
            $dados = [
                "nome" => $_POST["nome"],
                "photo" => isset($_FILES["photo"]) ? $_FILES["photo"] : "",
                "descricao" => $_POST["descricao"],
                "preco" => $_POST["preco"],
                "cod" => $_POST["cod"],
            ];
        }

        $pet_case = new PetCase($dados);
        try{
            $response = $pet_case->updatePetAdocao(new PetEntity(), new PetRepository(new Database()));
            echo json_encode(["message" => $response, "data" => date("Y-m-d H:i:s")]);
        }catch(Exception $e){
            echo json_encode(["message" => $e->getMessage()]);
        }
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

    public function deletePetAdocao()
    {
        $body = file_get_contents('php://input');
        $dados = json_decode($body, true);

        $data = [
            "idPet" => $dados['idPet']
        ];

        $pet_case = new PetCase($data);
        try{
            $response = $pet_case->deletePetAdocao(new PetEntity, new PetRepository(new Database()));

            echo json_encode(["message" => $response, "data" => date("Y-m-d H:i:s")]);
        }catch(Exception $e){
            echo json_encode(["message" => $e->getMessage()]);
        }
    }
}