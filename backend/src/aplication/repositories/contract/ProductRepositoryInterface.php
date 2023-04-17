<?php
namespace Boringue\Backend\aplication\repositories\contract;

use Boringue\Backend\domain\entities\CategoriaEntity;
use Boringue\Backend\domain\entities\FichaProduto;
use Boringue\Backend\domain\entities\FichaProdutoEntity;
use Boringue\Backend\domain\entities\ProductEntity;
use FichaTecnica;

interface ProductRepositoryInterface{
    public function add(ProductEntity $produto);
    public function addCategoria(CategoriaEntity $categoria);
    public function addFichaTec(FichaProdutoEntity $ficha);
    public function find(ProductEntity $produto, FichaProdutoEntity $fica_tecnica);
    public function findAll();
    public function findByCategoria(CategoriaEntity $categoria_entity);
    public function findCategoriaForName(CategoriaEntity $categoria);
    public function delete($idProduto);
}