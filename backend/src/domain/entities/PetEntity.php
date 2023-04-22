<?php
namespace Boringue\Backend\domain\entities;

use Boringue\Backend\domain\contract\PetEntityInterface;

class PetEntity implements PetEntityInterface{
    private static $cod;
    private static $photo;
    private static $desc;
    private static $estoque;
    private static $nome;
    private static $cod_categoria;
    private static $cod_fichapet;
    private static $preco;

    public function setCod($cod)
    {
        self::$cod = $cod;
        return $this;
    }

    public function setPhoto($photo)
    {
        self::$photo = $photo;
        return $this;
    }

    public function setDesc(string $descricao)
    {
        self::$desc = $descricao;
        return $this;
    }

    public function setEstoque(int $quantidade)
    {
        self::$estoque = $quantidade;
        return $this;
    }

    public function setNome(string $nome)
    {
        self::$nome = $nome;
        return $this;
    }

    public function setCodCategoria($cod)
    {
        self::$cod_categoria = $cod;
        return $this;
    }

    public function setCodFihcaTec($cod)
    {
        self::$cod_fichapet = $cod;
        return $this;
    }

    public function setPreco(float $preco)
    {
        self::$preco = $preco;
        return $this;
    }

    public function getCod() :float
    {
        return self::$cod;
    }

    public function getPhoto()
    {
        return self::$photo;
    }

    public function getDesc(): string
    {
        return self::$desc;
    }

    public function getEstoque(): int
    {
        return self::$estoque;
    }

    public function getNome(): string
    {
        return self::$nome;
    }

    public function getCodCategoria()
    {
        return self::$cod_categoria;
    }

    public function getCodFihcaTec()
    {
        return self::$cod_fichapet;
    }

    public function getPreco()
    {
        return self::$preco;
    }
}