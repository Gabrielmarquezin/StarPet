<?php
namespace Boringue\Backend\aplication\useCase;

use Boringue\Backend\aplication\repositories\AvaliacaoRepository;
use Boringue\Backend\aplication\useCase\contract\AvaliacaoCaseInterface;
use Boringue\Backend\domain\entities\AvaliacaoEntity;
use Exception;

/**
 * classe que aplica regras de negocio para mensagens
 * seleciona qual entidade vai receber, pegar e excluir as mensagens, existem 3: pet adocao, pet, produto
 * produto refere-se a objetos
 */

class AvaliacaoCase implements AvaliacaoCaseInterface{
    private $dados;


    /**
     * $dados que serao mandados para a camada entity
     *
     * @param array $dados
     */

    public function __construct($dados)
    {
        $this->dados = $dados;
    }


    /**
     * verefica para onde mandar a mensagem com base no cod
     * 
     *
     * @param AvaliacaoEntity $avaliacao
     * @param AvaliacaoRepository $avalicao_repository
     * @return void $id da mensagem
     */

    public function add(AvaliacaoEntity $avaliacao, AvaliacaoRepository $avalicao_repository)
    {
        $dados = $this->dados;
        $avaliacao->setStar($dados['stars'])
                  ->setMessage($dados['message'])
                  ->setCodUser($dados['cod_user']);

        try{
            if(isset($dados['cod_pet'])){
                $avaliacao->setCodProduto($dados['cod_pet']);
                
                $idAvaliacao = $avalicao_repository->addMessagePet($avaliacao);
                return $idAvaliacao;
            }
    
            if(isset($dados['cod_pet_adocao'])){
                $avaliacao->setCodProduto($dados['cod_pet_adocao']);
    
                $idAvaliacao = $avalicao_repository->addMessagePetAdocao($avaliacao);
                return $idAvaliacao;
            }

            $idAvaliacao = $avalicao_repository->addMessage($avaliacao);
            return $idAvaliacao;
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }


    /**
     * pega as mensagens da entidade produto
     *
     * @param AvaliacaoEntity $avaliacao
     * @param AvaliacaoRepository $avalicao_repository
     * @return void
     */


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



    public function getMessagePet(AvaliacaoEntity $avaliacao, AvaliacaoRepository $avalicao_repository)
    {
        $dados = $this->dados;
        $avaliacao->setCodProduto($dados['cod_pet']);

        
        try{
            $mensagens = $avalicao_repository->findMessagePet($avaliacao);
        
            if(empty($mensagens)){
                throw new Exception("nenhum usuario comentou");
            }
           
            return $mensagens;
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function getMessagePetAdocao(AvaliacaoEntity $avaliacao, AvaliacaoRepository $avalicao_repository)
    {
        $dados = $this->dados;
        $avaliacao->setCodProduto($dados['cod_pet_adocao']);
        
        try{
            $mensagens = $avalicao_repository->findMessageAdocao($avaliacao);
        
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
            $avalicao_repository->updateMessage($avaliacao, "avaliacao");
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }


    public function updatePet(AvaliacaoEntity $avaliacao, AvaliacaoRepository $avalicao_repository)
    {
        $dados = $this->dados;

        $avaliacao->setCod($dados['cod_mensagem'])
                  ->setMessage($dados['message']);

        try{
            $avalicao_repository->updateMessage($avaliacao, "avaliacao_pet");
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function updateAdocao(AvaliacaoEntity $avaliacao, AvaliacaoRepository $avalicao_repository)
    {
        $dados = $this->dados;

        $avaliacao->setCod($dados['cod_mensagem'])
                  ->setMessage($dados['message']);

        try{
            $avalicao_repository->updateMessage($avaliacao, "avaliacao_adocao");
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function delete(AvaliacaoEntity $avaliacao, AvaliacaoRepository $avalicao_repository)
    {
        $idAvaliacao = ($this->dados)['cod_mensagem'];
        $avaliacao->setCod($idAvaliacao);

        try{
            $avalicao_repository->deleteMessage($avaliacao, "avaliacao");
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function deletePet(AvaliacaoEntity $avaliacao, AvaliacaoRepository $avalicao_repository)
    {
        $idAvaliacao = ($this->dados)['cod_mensagem'];
        $avaliacao->setCod($idAvaliacao);

        try{
            $avalicao_repository->deleteMessage($avaliacao, "avaliacao_pet");
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function deletePetAdocao(AvaliacaoEntity $avaliacao, AvaliacaoRepository $avalicao_repository)
    {
        $idAvaliacao = ($this->dados)['cod_mensagem'];
        $avaliacao->setCod($idAvaliacao);

        try{
            $avalicao_repository->deleteMessage($avaliacao, "avaliacao_adocao");
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }
}