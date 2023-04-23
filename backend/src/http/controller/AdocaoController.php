<?php
namespace Boringue\Backend\http\controller;

use Boringue\Backend\aplication\repositories\AdocaoRepository;
use Boringue\Backend\aplication\useCase\AdocaoCase;
use Boringue\Backend\config\Database;
use Boringue\Backend\domain\entities\AdocaoEntity;
use Boringue\Backend\http\controller\contract\PedidoInterface;
use Exception;

class AdocaoController implements PedidoInterface{
  
    public function addPedido()
    {
        $body = file_get_contents('php://input');
        $dados = json_decode($body, true);
        
        $adocao_case = new AdocaoCase($dados);
        try{
            $adocao_case->addPedidoAdocao(new AdocaoEntity(), new AdocaoRepository(new Database()));

            echo json_encode(["message" => "pedido adicionado", "data" => date("Y-m-d H:i:s")]);
        }catch(Exception $e){
            echo json_encode($e->getMessage());
        }
    }

    public function getPedido()
    {
        global $dados;
        global $pedidos;

        if(isset($_GET['user']) && isset($_GET['pet'])){
            $dados = [
                "cod_user" => $_GET['user'],
                "cod_pet_adocao" => $_GET['pet']
            ];
        }else{
            $dados = [];
        }

        $adocao_case = new AdocaoCase($dados);
        try{
            if(isset($_GET['user']) && isset($_GET['pet'])){
                $pedidos = $adocao_case->getPedidoAdocao(new AdocaoEntity(), new AdocaoRepository(new Database()));
            }else{
                $pedidos = $adocao_case->getAll(new AdocaoRepository(new Database()));
            }

            echo json_encode($pedidos);
        }catch(Exception $e){
            echo json_encode(["error" => $e->getMessage()]);
        }
    }

    public function getPedidoByPet()
    {
        $dados = [
            "cod_pet_adocao" => $_GET['cod']
        ];

        $adocao_case = new AdocaoCase($dados);
        try{
            $pedidos = $adocao_case->getPedidoAdocaoByPet(new AdocaoEntity(), new AdocaoRepository(new Database()));
            echo json_encode($pedidos);
        }catch(Exception $e){
            echo json_encode(["error" => $e->getMessage()]);
        }
    }

    public function getPedidoByCategoria()
    {
        $dados = [
            "categoria" => $_GET['nome']
        ];

        $adocao_case = new AdocaoCase($dados);
        try{
            $pedidos = $adocao_case->getPedidoAdocaoByCategoria(new AdocaoEntity(), new AdocaoRepository(new Database()));
            echo json_encode($pedidos);
        }catch(Exception $e){
            echo json_encode(["error" => $e->getMessage()]);
        }
    }
}