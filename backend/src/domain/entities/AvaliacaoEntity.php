<?php
namespace Boringue\Backend\domain\entities;

use Boringue\Backend\domain\contract\AvaliacaoEntityInterface;

class AvaliacaoEntity implements AvaliacaoEntityInterface{
    private static $cod;
    private static $star;
    private static $message;
    private static $cod_user;
    private static $cod_produto;

    public function setCod($cod)
    {
        self::$cod = $cod;
        return $this;
    }

    public function setStar(int $star)
    {
        self::$star = $star;
        return $this;
    }

    public function setMessage(string $message)
    {
        self::$message = $message;
        return $this;
    }

    public function setCodUser($cod_user)
    {
        self::$cod_user = $cod_user;
        return $this;
    }

    public function setCodProduto($cod_produto)
    {
        self::$cod_produto = $cod_produto;
        return $this;
    }

    public function getCod()
    {
        return self::$cod;
    }

    public function getStar(): int
    {
        return self::$star;
    }

    public function getMessage(): string
    {
        return self::$message;
    }

    public function getCodUser()
    {
        return self::$cod_user;
    }

    public function getCodProduto()
    {
        return self::$cod_produto;
    }
}