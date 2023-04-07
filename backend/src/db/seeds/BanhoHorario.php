<?php


use Phinx\Seed\AbstractSeed;

class BanhoHorario extends AbstractSeed
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
        $banho_horario = $this->table('banho_horario');

        $data = [];

        for($i = 0; $i<= 3; $i++){
            $data[] = [
                'horario' => date("Y-m-d H:i:s")
            ]; 
        }

        $banho_horario->insert($data)->save();
    }
}
