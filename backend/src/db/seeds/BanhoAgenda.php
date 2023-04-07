<?php


use Phinx\Seed\AbstractSeed;

class BanhoAgenda extends AbstractSeed
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
        $banho_agenda = $this->table('banho_agenda');

        $data = [];

        for($i = 1; $i<= 3; $i++){
            $data[] = [
                'cod_horario' => $i,
                'pet_name' => $faker->name(),
                'email' => $faker->email(),
                'telefone' => '(85) 991022800',
                'observacoes' => $faker->paragraph(2),
                'kit_banho' => 'premium'
            ]; 
        }

        $banho_agenda->insert($data)->save();
    }
}
