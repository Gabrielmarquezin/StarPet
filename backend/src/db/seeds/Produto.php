<?php


use Phinx\Seed\AbstractSeed;

class Produto extends AbstractSeed
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
        $produto = $this->table('produto');

        $data = [];

        for($i = 0; $i<= 3; $i++){
            $data[] = [
                'photo' => $faker->image(null, 360, 360, 'animals', true),
                'desc' =>  $faker->paragraph(3),
                'preco' =>  $faker->randomFloat(2, 1, 100),
                'cod_fichatec' => null,
                'cod_categoria' => null,
                'quantidade' => $faker->numerify(),
                'nome' => $faker->name()
            ];
        }

        $produto->insert($data)->save();
    }
}
