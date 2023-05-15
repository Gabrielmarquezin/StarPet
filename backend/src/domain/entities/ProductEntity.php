<?php
namespace Boringue\Backend\domain\entities;

use Boringue\Backend\domain\contract\ProductEntityInterface;

class ProductEntity implements ProductEntityInterface{
    private static $cod;
    private static $photo;
    private static $descricao;
    private static $preco;
    private static $quantidade;
    private static $nome;
    private static $cod_fichatec;
    private static $cod_categoria;
    private static $type;

    public function setType(string $type){
        self::$type = $type;
        return $this;
    }

    public function setPhoto($photo)
    {
        self::$photo = $photo;
        return $this;
    }

    public function setCod($cod)
    {
        self::$cod = $cod;
        return $this;
    }

    public function setDescricao(string $descricao)
    {
        self::$descricao = $descricao;
        return $this;
    }

    public function setPreco(float $preco)
    {
        self::$preco = $preco;
        return $this;
    }

    public function setQuantidade(int $quantidade)
    {
        self::$quantidade = $quantidade;
        return $this;
    }

    public function setNome(string $nome)
    {
        self::$nome = $nome;
        return $this;
    }

    public function setCodFichaTec($cod_fichatec)
    {
        self::$cod_fichatec = $cod_fichatec;
        return $this;
    }

    public function setCodCategoria($cod_categoria)
    {
        self::$cod_categoria = $cod_categoria;
        return $this;
    }

    public function getCod(){
        return self::$cod;
    }

    public function getPhoto()
    {
        return self::$photo;
    }

    public function getDescricao(): string
    {
        return self::$descricao;
    }

    public function getPreco(): float
    {
        return self::$preco;
    }

    public function getQuantidade(): int
    {
        return self::$quantidade;
    }

    public function getNome()
    {
        return self::$nome;
    }

    public function getCodFichaTec()
    {
        return self::$cod_fichatec;
    }

    public function getCodCategoria()
    {
        return self::$cod_categoria;
    }

    public function getType(){
        return self::$type;
    }

}