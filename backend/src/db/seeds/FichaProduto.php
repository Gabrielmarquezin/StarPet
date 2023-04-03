<?php


use Phinx\Seed\AbstractSeed;

class FichaProduto extends AbstractSeed
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
        $ficha_tecnica = $this->table('ficha_tecnica');

        $data = [];

        for($i = 0; $i<= 3; $i++){
            $data[] = [
                'linha' => $faker->word(),
                'modelo' =>  $faker->word(),
                'marca' =>  $faker->word(),
                'tamanho' => $faker->randomNumber(5, true),
                'cor' => $faker->safeColorName(),
                'estoque' => $faker->numerify()
            ];
        }

        $ficha_tecnica->insert($data)->save();
    }
}
