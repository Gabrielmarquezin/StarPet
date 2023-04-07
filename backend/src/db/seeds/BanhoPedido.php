<?php


use Phinx\Seed\AbstractSeed;

class BanhoPedido extends AbstractSeed
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
        $banho_pedido = $this->table('banho_pedido');

        $data = [];

        for($i = 1; $i<= 3; $i++){
            $data[] = [
                'cod_user' => $i,
                'cod_agenda' => $i,
                'data_agenda' =>date("Y-m-d H:i:s"),
                'valor_total' => $faker->randomFloat(1, 20, 30),
                'cod_payment' => $i
            ]; 
        }

        $banho_pedido->insert($data)->save();
    }
}
