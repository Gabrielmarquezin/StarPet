<?php
namespace Boringue\Backend\http\controller\contract;

Interface ProdutoControllerInterface{
    public function add();
    public function get();
    public function getByCategoria();
    public function delete();
    public function update();
}