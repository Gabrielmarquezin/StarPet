<?php
namespace Boringue\Backend\http\controller;

use Avaliacao;
use Boringue\Backend\aplication\repositories\AvaliacaoRepository;
use Boringue\Backend\aplication\useCase\AvaliacaoCase;
use Boringue\Backend\config\Database;
use Boringue\Backend\domain\entities\AvaliacaoEntity;
use Boringue\Backend\http\controller\contract\AvaliacaoControllerInterface;
use Exception;

class AvaliacaoController implements AvaliacaoControllerInterface{
    public function addMessages()
    {
        $body = file_get_contents('php://input');
        $dados = json_decode($body, true);

        $headers = getallheaders();
        $contentType = $headers["Content-Type"];

        if (strpos($contentType, 'multipart/form-data;') !== false) {
            $dados = [
                "stars" => $_POST["stars"],
                "message" => $_POST["message"],
                "cod_user" => $_POST["cod_user"],
            ];

            if(isset($_POST["cod_adocao_pet"])){
              $dados["cod_adocao_pet"] = $_POST["cod_adocao_pet"];
            }
            if(isset($_POST["cod_pet"])){
              $dados["cod_pet"] = $_POST["cod_pet"];
            }
            if(isset($_POST["cod_produto"])){
              $dados["cod_produto"] = $_POST["cod_produto"];
            }
        }

        $avalicao_case = new AvaliacaoCase($dados);

        try{
            $response = $avalicao_case->add(new AvaliacaoEntity(), new AvaliacaoRepository(new Database()));
            echo json_encode(["message" => "mensagem: ".$response." adicionada"]);
        }catch(Exception $e){
            echo json_encode($e->getMessage());
        }
    }

    

    public function getMessages()
    {
       if(empty($_GET['produto'])){
         http_response_code(400);
         echo json_encode("falta parametros na url");
         return;
       }

       $dados = [
        "cod_produto" => $_GET['produto']
       ];

       $avalicao_case = new AvaliacaoCase($dados);

       try{
        $response = $avalicao_case->get(new AvaliacaoEntity(), new AvaliacaoRepository(new Database()));
        echo json_encode($response);

       }catch(Exception $e){
         echo json_encode($e->getMessage());
       }
    }

    public function getMessagesPet()
    {
       if(empty($_GET['produto'])){
         http_response_code(400);
         echo json_encode("falta parametros na url");
         return;
       }

       $dados = [
        "cod_pet" => $_GET['produto']
       ];

       $avalicao_case = new AvaliacaoCase($dados);

       try{
        $response = $avalicao_case->getMessagePet(new AvaliacaoEntity(), new AvaliacaoRepository(new Database()));
        echo json_encode($response);

       }catch(Exception $e){
         echo json_encode($e->getMessage());
       }
    }

    public function getMessagesPetAdocao()
    {
       if(empty($_GET['produto'])){
         http_response_code(400);
         echo json_encode("falta parametros na url");
         return;
       }

       $dados = [
        "cod_pet_adocao" => $_GET['produto']
       ];

       $avalicao_case = new AvaliacaoCase($dados);

       try{
        $response = $avalicao_case->getMessagePetAdocao(new AvaliacaoEntity(), new AvaliacaoRepository(new Database()));
        echo json_encode($response);
       }catch(Exception $e){
         echo json_encode($e->getMessage());
       }
    }


    public function updateMessage()
    {
      $body = file_get_contents('php://input');
      $dados = json_decode($body, true);

      $headers = getallheaders();
      $contentType = $headers["Content-Type"];

        if(strpos($contentType, 'multipart/form-data;') !== false) {
            $dados = [
                "cod_mensagem" => $_POST["cod_mensagem"],
                "message" => $_POST["message"]
            ];
        }
      
      $avalicao_case = new AvaliacaoCase($dados);
      try{
        $avalicao_case->update(new AvaliacaoEntity(), new AvaliacaoRepository(new Database()));

        echo json_encode(["message" => "mensagem atualizada"]);
      }catch(Exception $e){
        echo json_encode(["message" => $e->getMessage()]);
      }
    }

    public function updateMessagePet()
    {
      $body = file_get_contents('php://input');
      $dados = json_decode($body, true);

      $headers = getallheaders();
      $contentType = $headers["Content-Type"];

        if (strpos($contentType, 'multipart/form-data;') !== false) {
            $dados = [
                "cod_mensagem" => $_POST["cod_mensagem"],
                "message" => $_POST["message"]
            ];
        }
      
      $avalicao_case = new AvaliacaoCase($dados);
      try{
        $avalicao_case->updatePet(new AvaliacaoEntity(), new AvaliacaoRepository(new Database()));

        echo json_encode(["message" => "mensagem atualizada"]);
      }catch(Exception $e){
        echo json_encode(["message" => $e->getMessage()]);
      }
    }

    public function updateMessageAdocao()
    {
      $body = file_get_contents('php://input');
      $dados = json_decode($body, true);

      $headers = getallheaders();
      $contentType = $headers["Content-Type"];

        if (strpos($contentType, 'multipart/form-data;') !== false) {
            $dados = [
                "cod_mensagem" => $_POST["cod_mensagem"],
                "message" => $_POST["message"]
            ];
        }
      
      $avalicao_case = new AvaliacaoCase($dados);
      try{
        $avalicao_case->updateAdocao(new AvaliacaoEntity(), new AvaliacaoRepository(new Database()));

        echo json_encode(["message" => "mensagem atualizada"]);
      }catch(Exception $e){
        echo json_encode(["message" => $e->getMessage()]);
      }
    }

    

    public function deleteMessage()
    {
         if(empty($_GET['id'])){
          http_response_code(400);
          echo json_encode("falta parametros na url");
          return;
        }
        $dados = [
          "cod_mensagem" => $_GET['id']
        ];

        $avalicao_case = new AvaliacaoCase($dados);

        try{
          $avalicao_case->delete(new AvaliacaoEntity(), new AvaliacaoRepository(new Database()));

          echo json_encode(["message" => "mensagem excluida"]);
        }catch(Exception $e){
          echo json_encode($e->getMessage());
        }
    }

    public function deleteMessagePet()
    {
      if(empty($_GET['id'])){
        http_response_code(400);
        echo json_encode("falta parametros na url");
        return;
      }
      $dados = [
        "cod_mensagem" => $_GET['id']
      ];

      $avalicao_case = new AvaliacaoCase($dados);

      try{
        $avalicao_case->deletePet(new AvaliacaoEntity(), new AvaliacaoRepository(new Database()));

        echo json_encode(["message" => "mensagem excluida"]);
      }catch(Exception $e){
        echo json_encode($e->getMessage());
      }
    }

    public function deleteMessageAdocao()
    {
      if(empty($_GET['id'])){
        http_response_code(400);
        echo json_encode("falta parametros na url");
        return;
      }
      $dados = [
        "cod_mensagem" => $_GET['id']
      ];

      $avalicao_case = new AvaliacaoCase($dados);

      try{
        $avalicao_case->deletePetAdocao(new AvaliacaoEntity(), new AvaliacaoRepository(new Database()));

        echo json_encode(["message" => "mensagem excluida"]);
      }catch(Exception $e){
        echo json_encode($e->getMessage());
      }
    }

}