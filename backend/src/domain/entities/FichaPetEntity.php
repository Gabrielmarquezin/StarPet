<?php
namespace Boringue\Backend\domain\entities;

use Boringue\Backend\domain\contract\FichaPetEntityInterface;

class FichaPetEntity implements FichaPetEntityInterface{
    private static $cod;
    private static $raca;
    private static $alergias;
    private static $observacoes;
    private static $estoque;
    private static $tamanho;

    public function setCod($cod)
    {
        self::$cod = $cod;
        return $this;
    }

    public function setRaca(string $raca)
    {
        self::$raca = $raca;
        return $this;
    }

    public function setAlergias(string $alergias)
    {
        self::$alergias = $alergias;
        return $this;
    }

    public function setObservacoes(string $observacoes)
    {
        self::$observacoes = $observacoes;
        return $this;
    }

    public function setEstoque(int $estoque)
    {
        self::$estoque = $estoque;
        return $this;
    }

    public function setTamanho(string $tamanho)
    {
        self::$tamanho = $tamanho;
        return $this;
    }

    public function getCod()
    {
        return self::$cod;
    }

    public function getRaca()
    {
        return self::$raca;
    }

    public function getAlergias()
    {
        return self::$alergias;
    }

    public function getObservacoes()
    {
        return self::$observacoes;
    }

    public function getTamanho()
    {
        return self::$tamanho;
    }

    public function getEstoque()
    {
        return self::$estoque;
    }
}