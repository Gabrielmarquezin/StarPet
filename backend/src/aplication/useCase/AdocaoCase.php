<?php
namespace Boringue\Backend\aplication\useCase;

use Boringue\Backend\aplication\repositories\AdocaoRepository;
use Boringue\Backend\aplication\useCase\contract\AdocaoCaseInterface;
use Boringue\Backend\domain\entities\AdocaoEntity;
use Exception;

/**
 * Clase para manipular as regras de negocio da adoção.
 */

class AdocaoCase implements AdocaoCaseInterface{
    private $dados;

    /**
     * O construtor adiciona os dados para eventualmente ser adicionado na entidade adoção
     * 
     * @param array $dados
     */

    public function __construct(array $dados)
    {
        $this->dados = $dados;
    }

    public function addPedidoAdocao(AdocaoEntity $adocao, AdocaoRepository $adocao_repository)
    {
        $dados = $this->dados;

        $adocao->setCodUser($dados['cod_user'])
               ->setCodProduto($dados['cod_pet'])
               ->setEmail($dados['email'])
               ->setBairro($dados['bairro'])
               ->setRua($dados['rua'])
               ->setCasaN($dados['casa_number'])
               ->setCPF($dados['cpf'])
               ->setTelefone($dados['telefone']);
        try{
            if(!empty($adocao_repository->findByPet($adocao))){
                throw new Exception("O Pet ja foi adotado");
            }

            $id_adocao = $adocao_repository->add($adocao);

            return $id_adocao;
        }catch(Exception $e){
            throw new Exception(($e->getMessage()));
        }
    }

    public function getPedidoAdocao(AdocaoEntity $adocao, AdocaoRepository $adocao_repository)
    {
        
    }

}