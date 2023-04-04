<?php


use Phinx\Seed\AbstractSeed;

class AvaliacaoProduto extends AbstractSeed
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
        $avaliacao = $this->table('avaliacao');

        $data = [];

        for($i = 1; $i<= 3; $i++){
            $data[] = [
                'quantidade_stars' => $faker->numberBetween(0, 6),
                'mensagem' => $faker->paragraph(3),
                'cod_user' => $i,
                'cod_produto' => $i
            ];
        }

        $avaliacao->insert($data)->save();
    }
}
