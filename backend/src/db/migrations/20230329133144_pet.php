<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Pet extends AbstractMigration
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
        $pet = $this->table('pet', ['id' => 'cod']);
        $pet->addColumn('photo', 'binary')
            ->addColumn('descricao', 'string', ['limit' => '1500'])
            ->addColumn('quantidade', 'integer', ['null' => false])

            ->addColumn('cod_categoria', 'integer',["signed" => false])
            ->addColumn('cod_fichapet', 'integer',["signed" => false])
            ->addColumn('preco', 'decimal', ['precision' => '9', 'scale' => '2'])

            ->addForeignKey('cod_categoria', 'produto_categoria', 'cod', ['delete' => 'RESTRICT', 'update' => 'NO_ACTION'])
            ->addForeignKey('cod_fichapet', 'ficha_pet', 'cod', ['delete' => 'RESTRICT', 'update' => 'NO_ACTION'])

            ->create();
        }
}
