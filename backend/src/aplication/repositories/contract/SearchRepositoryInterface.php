<?php
namespace Boringue\Backend\aplication\repositories\contract;

use Boringue\Backend\domain\entities\ProductEntity;

interface SearchRepositoryInterface{
    public function search(ProductEntity $product);
}