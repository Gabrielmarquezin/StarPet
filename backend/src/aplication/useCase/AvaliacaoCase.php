<?php
namespace Boringue\Backend\aplication\useCase;

use Boringue\Backend\aplication\repositories\AvaliacaoRepository;
use Boringue\Backend\aplication\useCase\contract\AvaliacaoCaseInterface;
use Boringue\Backend\domain\entities\AvaliacaoEntity;
use Exception;

class AvaliacaoCase implements AvaliacaoCaseInterface{
    private $dados;

    public function __construct($dados)
    {
        $this->dados = $dados;
    }

    public function add(AvaliacaoEntity $avaliacao, AvaliacaoRepository $avalicao_repository)
    {
        $dados = $this->dados;
        try{
            $avaliacao->setStar($dados['stars'])
                      ->setMessage($dados['message'])
                      ->setCodUser($dados['cod_user'])
                      ->setCodProduto($dados['cod_produto']);
            
            $idAvaliacao = $avalicao_repository->addMessage($avaliacao);

            return $idAvaliacao;
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function get(AvaliacaoEntity $avaliacao, AvaliacaoRepository $avalicao_repository)
    {
        $dados = $this->dados;

        $avaliacao->setCodProduto($dados['cod_produto']);
        
        try{
            $mensagens = $avalicao_repository->findMessage($avaliacao);

            if(empty($mensagens)){
                throw new Exception("nenhum usuario comentou");
            }

            return $mensagens;
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function update(AvaliacaoEntity $avaliacao, AvaliacaoRepository $avalicao_repository)
    {
        $dados = $this->dados;

        $avaliacao->setCod($dados['cod_mensagem'])
                  ->setMessage($dados['message']);

        try{
            $avalicao_repository->updateMessage($avaliacao);

        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function delete(AvaliacaoEntity $avaliacao, AvaliacaoRepository $avalicao_repository)
    {
        $idAvaliacao = ($this->dados)['cod_mensagem'];
        $avaliacao->setCod($idAvaliacao);

        try{
            $avalicao_repository->deleteMessage($avaliacao);
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }
}