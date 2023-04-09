<?php
namespace Boringue\Backend\http\controller;

use Boringue\Backend\aplication\repositories\ProductRepository;
use Boringue\Backend\aplication\useCase\ProductCase;
use Boringue\Backend\config\Database;
use Boringue\Backend\domain\entities\ProductEntity;
use Boringue\Backend\http\controller\contract\ProdutoControllerInterface;

class ProdutoController implements ProdutoControllerInterface{
    public function add()
    {
        $body = file_get_contents('php://input');
        $dados = json_decode($body, true);

        $product_case = new ProductCase($dados);
        $response = $product_case->addProduct(new ProductEntity(), new ProductRepository(new Database()));

        echo json_encode($response);
    }

    public function get()
    {
        
    }
}