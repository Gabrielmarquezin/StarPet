<?php
namespace Boringue\Backend\aplication\useCase;

require_once "./global.php";
include "src/config/gatewayPayment.php";

use Boringue\Backend\aplication\repositories\ProdutoPedidoRepository;
use Boringue\Backend\aplication\useCase\contract\pedido\PedidoCaseInterface;
use Boringue\Backend\domain\contract\pedido\PedidoInterface;
use Boringue\Backend\domain\entities\CategoriaEntity;
use Boringue\Backend\domain\entities\MethodPaymentEntity;
use Boringue\Backend\domain\entities\pedido\PedidoProdutoEntity;
use Exception;

class PedidoProdutoCase implements PedidoCaseInterface{
    /**
     * dados advindo do controller
     *
     * @var [array]
     */
    private array $dados;
    private $repository;
    
    public function __construct(array $dados, $repository)
    {
        $this->dados = $dados;
        $this->repository = $repository;
    }

    public function addPedido(PedidoProdutoEntity $pedido)
    {
        $repository_pedido = $this->repository;
        $dados = $this->dados;
        $method_payment = new MethodPaymentEntity();

        $pedido->setCodUser($dados["cod_user"])
               ->setCodProduto(isset($dados["cod_produto"]) ? $dados["cod_produto"] : $dados['cod_pet'])
               ->setCPF($dados["cpf"])
               ->setRua($dados["rua"])
               ->setBairro($dados["bairro"])
               ->setCasaN($dados["casa_number"])
               ->setTelefone($dados["telefone"])
               ->setEmail($dados["email"])
               ->setPreco($dados["preco"] * $dados["quantidade"])
               ->setCep($dados['cep'])
               ->setNome($dados['nome']);

        
        $nome_user = explode(" ",$dados['nome']);

        \MercadoPago\SDK::setAccessToken(TOKEN);

        $payment = new \MercadoPago\Payment();

        $payment->transaction_amount = $pedido->getPreco();
        $payment->description = "Produto comprado";
        $payment->payment_method_id = "pix";
        $payment->notification_url = NGROK."/StarPet/backend/src/webhook/notification.php";

        $payment->payer = array(
            "email" => $pedido->getEmail(),
            "first_name" => $nome_user[0],
            "last_name" => end($nome_user),
            "identification" => array(
                "type" => "CPF",
                "number" => $pedido->getCPF()
            ),
            "address" => array(
                "zip_code" => $pedido->getCep(),
                "street_name" => $pedido->getRua(),
                "street_number" => $pedido->getCasaN(),
                "neighborhood" => $pedido->getBairro(),
                "city" => $dados["city"],
                "federal_unit" => $dados["uf"]
            )
        );

        if ($payment->save()) {
            $dados = [
                'qr_code_base64' => $payment->point_of_interaction->transaction_data->qr_code_base64,
                'qr_code' => $payment->point_of_interaction->transaction_data->qr_code,
                'payment_id' => $payment->id
            ];

            $method_payment->setMethod("pix")
                           ->setCodTransaction($payment->id)
                           ->setState("approved");

            $qr_code = $dados['qr_code_base64'];
            echo "<img src=data:image/jpeg;base64,$qr_code style='width: 350px; height:350px'/>";
            try{
                if(empty($repository_pedido->findPedido($pedido))){
                    $repository_pedido->addPedido($pedido, $method_payment);
                }else{
                    $repository_pedido->DeletePedido($pedido);
                    $repository_pedido->addPedido($pedido, $method_payment);
                }

                return $dados;
            }catch(Exception $e){
                throw new Exception($e->getMessage());
            }
        } else {
            echo "Error: " . $payment->error->message;
            var_dump($payment->error);
        }


        
    }

    public function getPedido(PedidoProdutoEntity $pedido)
    {
        $dados_pedido = $this->dados;
        $repository_pedido = $this->repository;

        global $pedidos_fetch;

        try{
            if(empty($dados_pedido)){
                $pedidos_fetch = $repository_pedido->findAllPedido();
            }

            if(isset($dados_pedido['cod_user']) && isset($dados_pedido['cod_produto'])){
                $pedido->setCodUser($dados_pedido['cod_user'])
                       ->setCodProduto($dados_pedido['cod_produto']);

                $pedidos_fetch = $repository_pedido->findPedido($pedido);
            }else{
                if(isset($dados_pedido['cod_user'])){
                    $pedido->setCodUser($dados_pedido['cod_user']);
                    $pedidos_fetch = $repository_pedido->findPedidoByUser($pedido);
                }
            }


            if(empty($pedidos_fetch)){
                throw new Exception("nenhum produto registrado");
            }
            return $pedidos_fetch;
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function getByCategoria(){
        $dados = $this->dados;
        $repository_pedido = $this->repository;
        try{
            $pedidos_fetch = $repository_pedido->findPedidoByCategoria(new CategoriaEntity($dados['categoria']));
            if(empty($pedidos_fetch)){
                throw new Exception("nenhum pedido registrado");
            }

            return $pedidos_fetch;
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }
}