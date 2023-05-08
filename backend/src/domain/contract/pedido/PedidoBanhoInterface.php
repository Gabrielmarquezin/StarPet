<?php
namespace Boringue\Backend\domain\contract\pedido;

interface PedidoBanhoInterface{
    public function setCodAgenda($cod);
    public function setCodUser($cod);
    public function setCodPagamento($cod);
    public function setPreco(float $preco);

    public function getCodAgenda();
    public function getCodUser();
    public function getCodPagamento();
    public function getPreco();

}