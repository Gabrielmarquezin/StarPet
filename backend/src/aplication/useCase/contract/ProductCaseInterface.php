<?php
namespace Boringue\Backend\aplication\useCase\contract;

use Boringue\Backend\aplication\repositories\ProductRepository;
use Boringue\Backend\domain\entities\CategoriaEntity;
use Boringue\Backend\domain\entities\FichaProdutoEntity;
use Boringue\Backend\domain\entities\ProductEntity;
use FichaProduto;

interface ProductCaseInterface{
     public function addProduct(ProductEntity $product, ProductRepository $productRepository, FichaProdutoEntity $fichaTecnica);
     public function getProduct(ProductEntity $product,ProductRepository $productRepository, $id);
     public function getProductByCategoria(CategoriaEntity $categoria_entity, ProductRepository $productRepository);
     public function deleteProduct(ProductRepository $productRepository,$idProduto);
}