<?php
namespace Boringue\Backend\aplication\useCase;

use Boringue\Backend\aplication\repositories\ProductRepository;
use Boringue\Backend\aplication\useCase\contract\ProductCaseInterface;
use Boringue\Backend\domain\entities\ProductEntity;
use Boringue\Backend\domain\entities\CategoriaEntity;
use Boringue\Backend\domain\entities\FichaProdutoEntity;
use Boringue\Backend\domain\entities\UserEntity;
use Exception;
use FichaProduto;

class ProductCase implements ProductCaseInterface{
     private $dados;

     public function __construct($dados)
     {
        $this->dados = $dados;
     }

     public function addProduct(ProductEntity $product, ProductRepository $productRepository, FichaProdutoEntity $ficha_tecnica)
     {
        global $idCat;
        $dados = $this->dados;

        $product->setPhoto($dados['photo'])
                ->setDescricao($dados['descricao'])
                ->setPreco($dados['preco'])
                ->setQuantidade($dados['quantidade'])
                ->setNome($dados['nome']);


        $nomeCategoria = $this->dados['categoria'];
        
    //verificando a existencia da categoria
        $getCategoria = $productRepository->findCategoriaForName(new CategoriaEntity($nomeCategoria));

        if(!empty($getCategoria[0])){
            $idCat = $getCategoria[0]["codigo"];
            $product->setCodCategoria($idCat);

        }else{

            $idCat = $productRepository->addCategoria(new CategoriaEntity($nomeCategoria));
            $product->setCodCategoria($idCat);
        }

//adicionando ficha tecnica
        $ficha_tecnica->setLinha($dados['fichatecnica']['linha'])
                    ->setModelo($dados['fichatecnica']['modelo'])
                    ->setMarca($dados['fichatecnica']['marca'])
                    ->setTamanho($dados['fichatecnica']['tamanho'])
                    ->setCor($dados['fichatecnica']['cor'])
                    ->setEstoque($dados['fichatecnica']['estoque']);

        $idFichatec = $productRepository->addFichaTec($ficha_tecnica);
        $product->setCodFichaTec($idFichatec);
        
        $productRepository->add($product);

        return ["message" => "produto adicionado"];
     }

     public function getProduct(ProductEntity $product ,ProductRepository $productRepository, $id)
     {
        if($id == 0){
            $Allprodutos = $productRepository->findAll();
           
            return $Allprodutos;
        }else{
            $product->setCod($id);
            $getProdutos = $productRepository->find($product, new FichaProdutoEntity());

            return $getProdutos;
        }
     }

     public function getProductByCategoria(CategoriaEntity $categoria_entity, ProductRepository $productRepository)
     {
       try{
         $respose_data = $productRepository->findByCategoria($categoria_entity);

         return $respose_data;
       }catch(Exception $e){
         throw new Exception($e->getMessage());
       }
     }

     public function deleteProduct(ProductRepository $productRepository,$idProduto)
     {
        try{
           $respose = $productRepository->delete($idProduto);

           return $respose;
        }catch(Exception $e){
           throw new Exception($e->getMessage());
        }
     }
}