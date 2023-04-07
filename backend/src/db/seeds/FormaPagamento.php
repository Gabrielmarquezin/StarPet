<?php


use Phinx\Seed\AbstractSeed;

class FormaPagamento extends AbstractSeed
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
        $forma_pagamento = $this->table('forma_pagamento');

        $data = [];

        for($i = 0; $i<= 3; $i++){
            $data[] = [
                'forma_payment' => $faker->creditCardType(),
                'parcelas' => $faker->numberBetween(1, 13)
            ]; 
        }

        $forma_pagamento->insert($data)->save();
    }
}
