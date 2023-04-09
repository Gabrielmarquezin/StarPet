<?php
namespace Boringue\Backend\http\middlewares;

use Boringue\Backend\http\middlewares\contract\ProdutoVerificationInterface;


class ProdutoVerification implements ProdutoVerificationInterface{
    private $dados;

    public function __construct($dados)
    {
        $this->dados = $dados;
    }

    public function ValuesNotNull()
    {
        $dados =  $this->dados;

        global $response;

        
        if(empty($dados['photo']) || empty($dados['preco']) || empty($dados['quantidade'])){
            $response = false;
        }else{
            $response = true;
        }
        
        return $response;
    }

    public function ValuesLength()
    {
        $dados = $this->dados;

         global $response;

         if(!empty($dados['descricao'])){
            if(strlen($dados['descricao']) > 1500){
                $response = "descricao too long";
             }
         }else{
            $response = "ok";
         }

         if(!empty($dados['nome'])){
            if(strlen($dados['nome']) > 45){
                $response = "nome too long";
             }
         }else{
            $response = "ok";
         }

         return $response;
    }
}