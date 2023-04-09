<?php
namespace Boringue\Backend\domain\entities;

use Boringue\Backend\domain\contract\CategoriaEntityInterface;

class CategoriaEntity implements CategoriaEntityInterface{
    private $categoria;
    private $cod;

    public function __construct($categoria)
    {
        $this->categoria = $categoria;
    }

    public function getCategoriaName()
    {
        return $this->categoria;
    }

    public function getCod()
    {
        return $this->categoria;
    }

    public function setCod($cod)
    {
        $this->cod = $cod;
        return $this;
    }
};