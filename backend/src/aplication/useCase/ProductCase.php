<?php
namespace Boringue\Backend\aplication\useCase;

use Boringue\Backend\aplication\repositories\ProductRepository;
use Boringue\Backend\aplication\useCase\contract\ProductCaseInterface;
use Boringue\Backend\domain\entities\ProductEntity;
use Boringue\Backend\domain\entities\CategoriaEntity;
use Boringue\Backend\domain\entities\UserEntity;
use FichaProduto;

class ProductCase implements ProductCaseInterface{
     private $dados;

     public function __construct($dados)
     {
        $this->dados = $dados;
     }

     public function addProduct(ProductEntity $product, ProductRepository $productRepository)
     {
        $dados = $this->dados;
        $product->setPhoto($dados['photo'])
                ->setDescricao($dados['descricao'])
                ->setPreco($dados['preco'])
                ->setQuantidade($dados['quantidade'])
                ->setNome($dados['nome']);

        if(empty($dados['fichatecnica'])){
            $nomeCategoria = $this->dados['categoria'];
            global $idCat;

            $getCategoria = $productRepository->findProductCategoria(new CategoriaEntity($nomeCategoria));

            if(!empty($getCategoria[0])){
                $idCat = $getCategoria[0]["codigo"];

                $product->setCodCategoria($idCat)
                        ->setCodFichaTec(null);

                $productRepository->add($product);
            }else{

                $idCat = $productRepository->addCategoria(new CategoriaEntity($nomeCategoria));

                $product->setCodCategoria($idCat)
                        ->setCodFichaTec(null);

                $productRepository->add($product);
            }

        }

        return ["message" => "produto adicionado"];
     }

     public function getProduct($idProduto)
     {
        
     }

     public function getAllProduct()
     {
        
     }

     public function deleteProduct($idProduto)
     {
        
     }
}