<?php
namespace Boringue\Backend\aplication\useCase\contract;

use Boringue\Backend\aplication\repositories\ProductRepository;
use Boringue\Backend\domain\entities\CategoriaEntity;
use Boringue\Backend\domain\entities\ProductEntity;
use FichaProduto;

interface ProductCaseInterface{
     public function addProduct(ProductEntity $product, ProductRepository $productRepository);
     public function getProduct(ProductEntity $product,ProductRepository $productRepository, $id);
     public function getAllProduct();
     public function deleteProduct($idProduto);
}