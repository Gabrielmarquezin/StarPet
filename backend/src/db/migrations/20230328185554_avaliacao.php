<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Avaliacao extends AbstractMigration
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
        $produto_avalicao = $this->table('avaliacao', ['id' => 'cod']);
        $produto_avalicao->addColumn('quantidade_stars', 'integer', ['null' => false ])
                         ->addColumn('mensagem', 'string', ['null' => false,'limit' => '1000'])

                         ->addColumn('cod_user', 'integer', ["signed" => false])
                         ->addColumn('cod_produto', 'integer', ["signed" => false])

                         ->addForeignKey('cod_user', 'users', 'cod', ['delete' => 'RESTRICT', 'update' => 'NO_ACTION'])
                         ->addForeignKey('cod_produto', 'produto', 'cod', ['delete' => 'RESTRICT', 'update' => 'NO_ACTION'])

                         ->create();
    }
}
