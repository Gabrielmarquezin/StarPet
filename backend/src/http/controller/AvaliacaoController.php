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

    public function updateMessage()
    {
      $body = file_get_contents('php://input');
      $dados = json_decode($body, true);

      $avalicao_case = new AvaliacaoCase($dados);
      try{
        $avalicao_case->update(new AvaliacaoEntity(), new AvaliacaoRepository(new Database()));

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
}