<?php


use Phinx\Seed\AbstractSeed;

class AdocaoPedido extends AbstractSeed
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
        $adocao_pedido = $this->table('adocao_pedido');

        $data = [];

        for($i = 1; $i<= 3; $i++){
            $data[] = [
                'cod_user' => $i,
                'cod_pet' => $i,
                'data_pedido' =>date("Y-m-d H:i:s"),
                'email' => $faker->email(),
                'cpf' => $faker->cpf,
                'rua' => $faker->streetName(),
                'bairro' => $faker->city(),
                'telefone' => '(85) 991022800'
            ]; 
        }

        $adocao_pedido->insert($data)->save();
    }
}
