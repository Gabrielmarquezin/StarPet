<?php
namespace Boringue\Backend\http\controller;

use Boringue\Backend\aplication\repositories\BanhoPedidoRepository;
use Boringue\Backend\aplication\repositories\PetPedidoRepository;
use Boringue\Backend\aplication\repositories\ProdutoPedidoRepository;
use Boringue\Backend\aplication\useCase\PedidoBanhoCase;
use Boringue\Backend\aplication\useCase\PedidoProdutoCase;
use Boringue\Backend\config\Database;
use Boringue\Backend\domain\entities\AgendaBanhoEntity;
use Boringue\Backend\domain\entities\HorarioBanhoEntity;
use Boringue\Backend\domain\entities\MethodPaymentEntity;
use Boringue\Backend\domain\entities\pedido\PedidoBanhoEntity;
use Boringue\Backend\domain\entities\pedido\PedidoProdutoEntity;
use Boringue\Backend\http\controller\contract\pedido\PedidoInterface;
use Exception;

class PedidoProdutoController implements PedidoInterface{
  
    public function addPedido()
    {
        $body = file_get_contents('php://input');
        $dados = json_decode($body, true);

        $headers = getallheaders();
        $contentType = $headers["Content-Type"];

        if (strpos($contentType, 'multipart/form-data;') !== false) {
            $dados = [
                "cod_user" => (int)$_POST["cod_user"],
                "cod_produto" => (int) $_POST["cod_produto"],
                "cpf" => $_POST["cpf"],
                "rua" => $_POST["rua"],
                "bairro" => $_POST["bairro"],
                "casa_number" => $_POST["casa_number"],
                "telefone" => $_POST["telefone"],
                "email" => $_POST["email"],
                "preco" => (float) $_POST["preco"],
                "quantidade" => (int) $_POST["quantidade"],
                "nome" => $_POST["nome"],
                "cep" => $_POST["cep"],
                "city" => $_POST["city"],
                "uf" => $_POST["uf"],
            ];
        }

        $pedido_case = new PedidoProdutoCase($dados, new ProdutoPedidoRepository(new Database()));

        try{
            $qr_code = $pedido_case->addPedido(new PedidoProdutoEntity());

            echo json_encode(["id_pedido" => $dados['cod_user'], "data" =>  date("Y-m-d H:i:s"), "qr_code" => $qr_code]);
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

    public function addPedidoPet()
    {
        $body = file_get_contents('php://input');
        $dados = json_decode($body, true);

        $headers = getallheaders();
        $contentType = $headers["Content-Type"];

        if (strpos($contentType, 'multipart/form-data;') !== false) {
            $dados = [
                "cod_user" => $_POST["cod_user"],
                "cod_pet" => $_POST["cod_produto"],
                "cpf" => $_POST["cpf"],
                "rua" => $_POST["rua"],
                "bairro" => $_POST["bairro"],
                "casa_number" => $_POST["casa_number"],
                "telefone" => $_POST["telefone"],
                "email" => $_POST["email"],
                "preco" => $_POST["preco"],
                "quantidade" => $_POST["quantidade"],
                "nome" => $_POST["nome"],
                "cep" => $_POST["cep"],
                "city" => $_POST["city"],
                "uf" => $_POST["uf"],
                "type" => "pet"
            ];
        }

        $pedido_case = new PedidoProdutoCase($dados, new PetPedidoRepository(new Database()));

        try{
            $qr_code = $pedido_case->addPedido(new PedidoProdutoEntity());

            echo json_encode(["id_pedido" => $dados['cod_user'], "data" =>  date("Y-m-d H:i:s"), "qr_code" => $qr_code]);
        }catch(Exception $e){
            echo json_encode($e->getMessage());
        }
    }

    public function getPedidoPet()
    {
        global $dados;
        if(!isset($_GET['user']) && !isset($_GET['pet'])){
            $dados = [];
        }
        
        if(isset($_GET['user']) && isset($_GET['pet'])){
            $dados = [
                "cod_user" => $_GET['user'],
                "cod_produto" => $_GET['pet']
            ];
        }
        
        if(isset($_GET['user']) && !isset($_GET['pet'])){
            $dados["cod_user"] = $_GET['user'];
        }

        $pedido_case = new PedidoProdutoCase($dados, new PetPedidoRepository(new Database()));
        try{
            $pedidos = $pedido_case->getPedido(new PedidoProdutoEntity());

            echo json_encode($pedidos);
        }catch(Exception $e){
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function getByCategoriaPet(){
        $dados["categoria"] = $_GET['categoria'];
        $pedido_case = new PedidoProdutoCase($dados, new PetPedidoRepository(new Database()));
        try{
            $pedidos = $pedido_case->getByCategoria();
            echo json_encode($pedidos);
        }catch(Exception $e){
            echo json_encode(["message" => $e->getMessage()]);
        }
    }


    public function addBanho(){
        $body = file_get_contents('php://input');
        $dados = json_decode($body, true);
       
        $headers = getallheaders();
        $contentType = $headers["Content-Type"];

        if (strpos($contentType, 'multipart/form-data;') !== false) {

            $dados = [
                "cod_user" => $_POST["cod_user"],
                "cod_horario" => $_POST["cod_horario"],
                "cpf" => $_POST["cpf"],
                "rua" => $_POST["rua"],
                "bairro" => $_POST["bairro"],
                "casa_number" => $_POST["casa_number"],
                "telefone" => $_POST["telefone"],
                "email" => $_POST["email"],
                "preco" => $_POST["preco"],
                "kit" => $_POST["kit"],
                "pet_name" => $_POST["pet_name"],
                "cep" => $_POST["cep"],
                "city" => $_POST["city"],
                "uf" => $_POST["uf"],
                "observacoes" => $_POST["observacoes"],
                "nome" => $_POST["nome"]
            ];

            
        }

        $banho_case = new PedidoBanhoCase($dados, new BanhoPedidoRepository(new Database()));

        try{
            $response = $banho_case->addBanho(new AgendaBanhoEntity(), new PedidoBanhoEntity(), new MethodPaymentEntity());
            echo json_encode($response);

        }catch(Exception $e){
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function addHorario(){
        $body = file_get_contents('php://input');
        $dados = json_decode($body, true);
        $banho_case = new PedidoBanhoCase($dados, new BanhoPedidoRepository(new Database()));

        $headers = getallheaders();
        $contentType = $headers["Content-Type"];

        if (strpos($contentType, 'multipart/form-data;') !== false) {
            $dados = [
                "horario" => $_POST["horario"],
            ];
        }

        try{
            $response = $banho_case->addHorario(new HorarioBanhoEntity());
            echo json_encode(["cod" => $response]);

        }catch(Exception $e){
            echo json_encode(["message" => $e->getMessage()]);
        }
    }
    

    public function getBanho(){

        if(isset($_GET['user'])){
            $dados["cod_user"] = $_GET['user'];
            $banho_case = new PedidoBanhoCase($dados, new BanhoPedidoRepository(new Database()));
        }else{
            $banho_case = new PedidoBanhoCase([], new BanhoPedidoRepository(new Database()));
        }

       try{

        $pedidos = $banho_case->getBanho(new PedidoBanhoEntity());
        echo json_encode($pedidos);
       }catch(Exception $e){
         echo json_encode(["message" => $e->getMessage()]);
       }
    }

    public function getHorario(){
        $banho_case = new PedidoBanhoCase([], new BanhoPedidoRepository(new Database()));
        try{
            $horarios = $banho_case->getHorario();

            echo json_encode($horarios);
        }catch(Exception $e){
            echo json_encode(["message" => $e->getMessage()]);
        }
    }

    public function deleteHorario(){
        $dados["cod_horario"] = $_GET['cod'];
        $banho_case = new PedidoBanhoCase($dados, new BanhoPedidoRepository(new Database()));
        try{
            $banho_case->deleteHorario(new HorarioBanhoEntity());
            echo json_encode(["message" => "deletado"]);
        }catch(Exception $e){
            echo json_encode(["message" => $e->getMessage()]);
        }
    }
}