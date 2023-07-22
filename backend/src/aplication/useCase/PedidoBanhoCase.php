<?php
namespace Boringue\Backend\aplication\useCase;

require_once "./global.php";
include "src/config/gatewayPayment.php";

use Boringue\Backend\aplication\useCase\contract\pedido\PedidoBanhoCaseInterface;
use Boringue\Backend\aplication\useCase\contract\pedido\PedidoCaseInterface;
use Boringue\Backend\domain\entities\AgendaBanhoEntity;
use Boringue\Backend\domain\entities\pedido\PedidoBanhoEntity;
use Boringue\Backend\domain\entities\HorarioBanhoEntity;
use Boringue\Backend\domain\entities\MethodPaymentEntity;
use Boringue\Backend\domain\entities\pedido\PedidoProdutoEntity;
use Exception;

class PedidoBanhoCase implements PedidoBanhoCaseInterface{
    private array $dados;
    private $repository;
    
    public function __construct(array $dados, $repository)
    {
        $this->dados = $dados;
        $this->repository = $repository;
    }


    public function addBanho(AgendaBanhoEntity $agenda, PedidoBanhoEntity $pedido, MethodPaymentEntity $method)
    {
        $dados = $this->dados;
        $banho_repository = $this->repository;
        
        $agenda->setPetName($dados['pet_name'])
               ->setEmail($dados['email'])
               ->setTelefone($dados['telefone'])
               ->setObservacoes($dados['observacoes'])
               ->setKitBanho($dados['kit'])
               ->setCodHorario($dados['cod_horario']);

        $pedido->setPreco($dados['preco'])
               ->setCodUser($dados['cod_user']);

        $nome_user = explode(" ",$dados['nome']);
         
        \MercadoPago\SDK::setAccessToken(TOKEN);

        $payment = new \MercadoPago\Payment();

        $payment->transaction_amount = $pedido->getPreco();
        $payment->description = "Produto comprado";
        $payment->payment_method_id = "pix";
        $payment->notification_url = NGROK."/backend/src/webhook/notification.php";

        $payment->payer = array(
            "email" => $agenda->getEmail(),
            "first_name" => $nome_user[0],
            "last_name" => end($nome_user),
            "identification" => array(
                "type" => "CPF",
                "number" => $dados['cpf']
            ),
            "address" => array(
                "zip_code" => $dados['cep'],
                "street_name" => $dados['rua'],
                "street_number" => $dados['casa_number'],
                "neighborhood" => $dados['bairro'],
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

            $method->setMethod("pix")
                    ->setCodTransaction($payment->id)
                    ->setState("approved");

            $qr_code = $dados['qr_code_base64'];
            try{
                $banho_repository->addBanho($agenda, $pedido, $method);
                return $dados;
            }catch(Exception $e){
                throw new Exception($e->getMessage());
            }
        } else {
            echo "Error: " . $payment->error->message;
            var_dump($payment->error);
        }

    }

    public function getBanho(PedidoBanhoEntity $pedido)
    {
        $dados = $this->dados;
        $banho_repository = $this->repository;
        global $pedidos;
        try{
            if(isset($dados['cod_user'])){
                $pedido->setCodUser($dados['cod_user']);
                $pedidos = $banho_repository->findBanho($pedido);
            }else{
                $pedidos = $banho_repository->findAll();
            }

            if(empty($pedidos)){
                throw new Exception("Nao ha pedidos");
            }

            return $pedidos;
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function addHorario(HorarioBanhoEntity $horario){
        $dados = $this->dados;
        $banho_repository = $this->repository;

        $horario->setHorario($dados['horario']);

        try{
            $cod = $banho_repository->addHorario($horario);

            return $cod;
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function getHorario(){
        $banho_repository = $this->repository;
        try{
            $horarios = $banho_repository->findHorario();

            if(empty($horarios)){
                throw new Exception("Nenhum horario disponivel");
            }else{
                return $horarios;
            }
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function deleteHorario(HorarioBanhoEntity $horario){
        $dados = $this->dados;
        $banho_repository = $this->repository;
        $horario->setCod($dados['cod_horario']);

        try{
            $banho_repository->deleteHorario($horario);
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }
}