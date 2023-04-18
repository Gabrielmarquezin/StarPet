<?php
namespace Boringue\Backend\http\controller;

use Boringue\Backend\aplication\repositories\ProductRepository;
use Boringue\Backend\aplication\useCase\ProductCase;
use Boringue\Backend\config\Database;
use Boringue\Backend\domain\entities\CategoriaEntity;
use Boringue\Backend\domain\entities\FichaProdutoEntity;
use Boringue\Backend\domain\entities\ProductEntity;
use Boringue\Backend\http\controller\contract\ProdutoControllerInterface;
use Exception;

class ProdutoController implements ProdutoControllerInterface{
    public function add()
    {
        $body = file_get_contents('php://input');
        $dados = json_decode($body, true);

        $product_case = new ProductCase($dados);
        $response = $product_case->addProduct(new ProductEntity(), new ProductRepository(new Database()), new FichaProdutoEntity());
       
        echo json_encode($response);
    }

    public function get()
    {

        $id = empty($_GET['id']) == 1 ? 0 : intval($_GET['id']);
        $product_case = new ProductCase(null);
        $produtos = $product_case->getProduct(new ProductEntity(), new ProductRepository(new Database()), $id);

        if(empty($produtos)){
            echo json_encode(["message" => "nao ha produto"]);
        }else{
            echo json_encode($produtos);
        }
    }

    public function getByCategoria()
    {
        $categoria = empty($_GET['name']) == 1 ? 0 : $_GET['name'];
        $product_case = new ProductCase(null);

        try{
            $datas = $product_case->getProductByCategoria(new CategoriaEntity($categoria), new ProductRepository(new Database()));

            echo json_encode($datas);
        }catch(Exception $e){
            echo json_encode(["repository"=>$e->getMessage()]);
        }
    }

    public function delete()
    {
        $body = file_get_contents('php://input');
        $dados = json_decode($body, true);
        
        $product_case = new ProductCase($dados);
        try{
            $response = $product_case->deleteProduct(new ProductRepository(new Database()),$dados['idProduto']);

            echo json_encode(["message" => $response]);
        }catch(Exception $e){
            echo json_encode(["error"=>$e->getMessage()]);
        }
        
    }

    public function update()
    {
        $body = file_get_contents('php://input');
        $dados = json_decode($body, true);
        
        $product_case = new ProductCase($dados);

        try{
            $response = $product_case->updateProduct(new ProductEntity(), new ProductRepository(new Database()));

            echo json_encode(["message" => $response, "data_upadte" => date("Y-m-d H:i:s")]);
        }catch(Exception $e){
            echo json_encode(["message" => $e->getMessage()]);
        }
    }
}