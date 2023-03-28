<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class FichaTecnica extends AbstractMigration
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
        $table = $this->table('ficha_tecnica', ['id' => 'cod']);
        $table->addColumn('linha', 'string', ['limit' => '45'])
              ->addColumn('modelo', 'string', ['limit' => '45'])
              ->addColumn('marca', 'string', ['limit' => '45'])
              ->addColumn('tamanho', 'string', ['limit' => '45'])
              ->addColumn('cor', 'string', ['limit' => '20'])
              ->addColumn('estoque', 'string', ['limit' => '20'])
              ->create();
    }
}
