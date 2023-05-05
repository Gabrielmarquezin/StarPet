<?php
namespace Boringue\Backend\http\controller;

use Boringue\Backend\aplication\repositories\ProdutoPedidoRepository;
use Boringue\Backend\aplication\useCase\PedidoProdutoCase;
use Boringue\Backend\config\Database;
use Boringue\Backend\domain\entities\pedido\PedidoProdutoEntity;
use Boringue\Backend\http\controller\contract\PedidoInterface;
use Exception;

class PedidoProdutoController implements PedidoInterface{
  
    public function addPedido()
    {
        $body = file_get_contents('php://input');
        $dados = json_decode($body, true);

        $pedido_case = new PedidoProdutoCase($dados, new ProdutoPedidoRepository(new Database()));

        try{
            $qr_code = $pedido_case->addPedido(new PedidoProdutoEntity());

            echo json_encode(["id_pedido" => $dados['cod_user'].$dados['cod_user'], "data" =>  date("Y-m-d H:i:s"), "qr_code" => $qr_code]);
        }catch(Exception $e){
            echo json_encode($e->getMessage());
        }
    }

    public function getPedido()
    {
        global $dados;
        if(!isset($_GET['user']) && !isset($_GET['produto'])){
            $dados = [];
        }
        
        if(isset($_GET['user']) && isset($_GET['produto'])){
            $dados = [
                "cod_user" => $_GET['user'],
                "cod_produto" => $_GET['produto']
            ];
        }
        
        if(isset($_GET['user']) && !isset($_GET['produto'])){
            $dados["cod_user"] = $_GET['user'];
        }

        $pedido_case = new PedidoProdutoCase($dados, new ProdutoPedidoRepository(new Database()));
        try{
            $pedidos = $pedido_case->getPedido(new PedidoProdutoEntity());

            echo json_encode($pedidos);
        }catch(Exception $e){
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function getByCategoria(){
        $dados["categoria"] = $_GET['categoria'];
        $pedido_case = new PedidoProdutoCase($dados, new ProdutoPedidoRepository(new Database()));
        try{
            $pedidos = $pedido_case->getByCategoria();
            echo json_encode($pedidos);
        }catch(Exception $e){
            echo json_encode(["message" => $e->getMessage()]);
        }
    }
}