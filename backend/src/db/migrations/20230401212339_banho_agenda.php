<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class BanhoAgenda extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $agenda_banho = $this->table('banho_agenda', ['id' => 'cod']);
        $agenda_banho->addColumn('pet_name', 'string', ['null' => false, 'limit' => '45'])
                     ->addColumn('email', 'string', ['null' => false, 'limit' => '160'])
                     ->addColumn('telefone', 'string', ['null' => false, 'limit' => '16'])
                     ->addColumn('observacoes', 'string', ['limit' => '1500'])
                     ->addColumn('kit_banho', 'string', ['null' => false, 'limit' => '45'])

                     ->addColumn('cod_horario', 'integer', ["signed" => false])
                     ->addForeignKey('cod_horario', 'banho_horario', 'cod', ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION'])

                     ->create();
    }
}
