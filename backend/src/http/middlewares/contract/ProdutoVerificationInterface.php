<?php
namespace Boringue\Backend\http\middlewares\contract;

Interface ProdutoVerificationInterface{
    public function ValuesNotNull();
    public function ValuesLength();
}