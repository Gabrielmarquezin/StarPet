<?php


use Phinx\Seed\AbstractSeed;

class PetPedido extends AbstractSeed
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
        $pet_pedido = $this->table('pet_pedido');

        $data = [];

        for($i = 1; $i<= 3; $i++){
            $data[] = [
                'cod_user' => $i,
                'cod_pet' => $i,
                'data_pedido' =>date("Y-m-d H:i:s"),
                'preco_total' => $faker->randomFloat(1, 20, 30),
                'cpf' => $faker->cpf,
                'rua' => $faker->streetName(),
                'bairro' => $faker->city(),
                'telefone' => '(85) 991022800',
                'cod_pagamento' => $i
            ]; 
        }

        $pet_pedido->insert($data)->save();
    }
}
