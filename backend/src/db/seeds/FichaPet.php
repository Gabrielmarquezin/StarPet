<?php


use Phinx\Seed\AbstractSeed;

class FichaPet extends AbstractSeed
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
        $ficha_pet = $this->table('ficha_pet');

        $data = [];

        for($i = 1; $i<= 3; $i++){
            $data[] = [
                'raca' => $faker->firstName(),
                'alergias' => $faker->name(),
                'observacoes' => $faker->paragraph(1),
                'tamanho' => $faker->randomNumber(5, true),
                'estoque' => $faker->randomNumber(3, true)
            ];
        }

        $ficha_pet->insert($data)->save();
    }
}
