<?php
namespace Boringue\Backend\domain\entities;

use Boringue\Backend\domain\contract\FichaProdutoEntityInterface;

class FichaProdutoEntity implements FichaProdutoEntityInterface{
    private static $cod;
    private static $linha;
    private static $modelo;
    private static $marca;
    private static $tamanho;
    private static $cor;
    private static $estoque;

    public function setCod($cod)
    {
        self::$cod = $cod;
        return $this;
    }

    public function setLinha(string $linha)
    {
        self::$linha = $linha;
        return $this;
    }

    public function setModelo(string $modelo)
    {
        self::$modelo = $modelo;
        return $this;
    }

    public function setMarca(string $marca)
    {
        self::$marca = $marca;
        return $this;
    }

    public function setTamanho(string $tamanho)
    {
        self::$tamanho = $tamanho;
        return $this;
    }

    public function setCor(string $cor)
    {
        self::$cor = $cor;
        return $this;
    }

    public function setEstoque(string $estoque)
    {
        self::$estoque = $estoque;
        return $this;
    }

    public function getCod()
    {
        return self::$cod;
    }

    public function getLinha(): string
    {
        return self::$linha;
    }

    public function getModelo(): string
    {
        return self::$modelo;
    }

    public function getMarca(): string
    {
        return self::$marca;
    }

    public function getTamanho(): string
    {
        return self::$tamanho;
    }

    public function getCor(): string
    {
        return self::$cor;
    }

    public function getEstoque(): string
    {
        return self::$estoque;
    }
}