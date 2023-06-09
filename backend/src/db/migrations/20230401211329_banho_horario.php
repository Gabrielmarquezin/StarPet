<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class BanhoHorario extends AbstractMigration
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
        $banho_horario = $this->table('banho_horario', ['id' => 'cod']);
        $banho_horario->addColumn('horario', 'datetime')
                      ->create();

        $banho_horario->insert(["horario" => "0000-00-00"])->save();
    }
}
