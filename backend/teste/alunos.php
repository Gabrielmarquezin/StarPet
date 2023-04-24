<?php


class a{
    public $dado;
    public function __construct($dado)
    {
        $this->dado = $dado;
    }

    public function c(){
        echo "deu bom";
    }
}



class d{
    public $dado;
    public function __construct($dado)
    {
        $this->dado = $dado;
    }

    public function e($a){
        echo $a->c();
    }
}

$obj = new d('');


