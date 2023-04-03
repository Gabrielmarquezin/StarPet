<?php


use Phinx\Seed\AbstractSeed;

class ProdutoCategoria extends AbstractSeed
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
        $produto_categoria = $this->table('produto_categoria');

        $data = [];

        for($i = 0; $i<= 3; $i++){
            $data[] = [
                'nome' => $faker->state()
            ];
        }

        $produto_categoria->insert($data)->save();
    }
}
