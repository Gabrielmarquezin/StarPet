<?php
namespace Boringue\Backend\aplication\repositories\contract;

use Boringue\Backend\domain\entities\CategoriaEntity;
use Boringue\Backend\domain\entities\FichaProduto;
use Boringue\Backend\domain\entities\ProductEntity;

interface ProductRepositoryInterface{
    public function add(ProductEntity $produto);
    public function addCategoria(CategoriaEntity $categoria);
    public function addFichaTec(FichaProduto $ficha);
    public function find(ProductEntity $produto);
    public function findProductCategoria(CategoriaEntity $categoria);
    public function findAll();
    public function delete();
}