<?php


use Phinx\Seed\AbstractSeed;

class ProdutoPedido extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('pt_BR');
        $produto_pedido = $this->table('produto_pedido');

        $data = [];

        for($i = 1; $i<= 3; $i++){
            $data[] = [
                'cod_user' => $i,
                'cod_produto' => $i,
                'data_payment' =>date("Y-m-d H:i:s"),
                'preco_total' => $faker->randomFloat(1, 20, 30),
                'cpf' => $faker->creditCardNumber(),
                'rua' => $faker->streetName(),
                'bairro' => $faker->city(),
                'telefone' => $faker->phoneNumber(),
                'cod_pagamento' => $faker-> $i
            ]; 
        }

        $produto_pedido->insert($data)->save();
    }
}
