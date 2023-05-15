<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class FichaPet extends AbstractMigration
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
        $ficha_pet = $this->table('ficha_pet', ['id' => 'cod']);
        $ficha_pet ->addColumn('raca', 'string', ['limit' => '30'])
                   ->addColumn('alergias', 'string', ['limit' => '500'])
                   ->addColumn('observacoes', 'string', ['limit' => '1000'])
                   ->addColumn('tamanho', 'string', ['limit' => '45'])
                   ->addColumn('estoque', 'integer')

                   ->create();
    }
}
