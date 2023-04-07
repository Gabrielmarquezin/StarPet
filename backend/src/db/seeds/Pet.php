<?php


use Phinx\Seed\AbstractSeed;

class Pet extends AbstractSeed
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
        $pet = $this->table('pet');

        $data = [];

        for($i = 1; $i<= 3; $i++){
            $data[] = [
                'photo' => $faker->image(null, 360, 360, 'animals', true),
                'desc' => $faker->paragraph(2),
                'quantidade' => $faker->numberBetween(0, 15),
                'preco' => $faker->randomFloat(2, 1, 100),
                'cod_fichapet' => 4,
                'cod_categoria' => 2
            ];
        }

        $pet->insert($data)->save();
    }
}
