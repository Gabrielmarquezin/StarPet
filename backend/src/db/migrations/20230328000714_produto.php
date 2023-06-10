<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Produto extends AbstractMigration
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
        $produto = $this->table('produto', ['id' => 'cod']);
        $produto->addColumn('photo', 'binary', ['null' => false, "length" => 1000000])
                ->addColumn('cod_fichatec', 'integer', ["signed" => false])
                ->addColumn('cod_categoria', 'integer', ["signed" => false])
                ->addColumn('descricao', 'string', ['limit' => '1500'])
                ->addColumn('preco', 'decimal', ['null' => false, 'scale' => '2', 'precision' => '7'] )
                ->addColumn('quantidade', 'integer', ['null' => false])
                ->addColumn('nome', 'string', ['limit' => '45'])
                ->addColumn("tipo", "string", ['limit' => '45'])
                ->addTimestamps("creat_at", "update_at")
                ->addForeignKey('cod_fichatec', 'ficha_tecnica', 'cod', ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION'])
                ->addForeignKey('cod_categoria', 'produto_categoria', 'cod', ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION'])
                
                ->create();
    }
}
