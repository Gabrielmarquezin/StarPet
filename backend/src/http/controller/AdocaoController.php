<?php
namespace Boringue\Backend\http\controller;

use Boringue\Backend\aplication\repositories\AdocaoRepository;
use Boringue\Backend\aplication\useCase\AdocaoCase;
use Boringue\Backend\config\Database;
use Boringue\Backend\domain\entities\AdocaoEntity;
use Boringue\Backend\http\controller\contract\PedidoInterface;
use Exception;

class AdocaoController implements PedidoInterface{
    private $case;

    public function __construct()
    {
        // $body = file_get_contents('php://input');
        // $dados = json_decode($body, true);

        // $this->case = new AdocaoCase($dados); 
    }
    
    public function addPedido()
    {
        $adocao_case = $this->case;
        try{
            $id = $adocao_case->addPedidoAdocao(new AdocaoEntity(), new AdocaoRepository(new Database()));

            echo json_encode(["message" => "pedido adicionado", "cod" => $id]);
        }catch(Exception $e){
            echo json_encode($e->getMessage());
        }
    }

    public function getPedido()
    {
        
    }
}