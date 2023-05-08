<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class BanhoPedido extends AbstractMigration
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
        $banho_pedido = $this->table('banho_pedido', ['id' => false, 'primary_key' => 
        ['cod_agenda', 'cod_user']]);

        $banho_pedido->addColumn('cod_agenda', 'integer')
                     ->addColumn('cod_user', 'integer')
                     ->addTimestamps('data_agenda', 'update_agenda')
                     ->addColumn('valor_total', 'decimal', ['null' => false, 'scale' => '2', 'precision' => '9'])

                     ->addColumn('cod_payment', 'integer', ["signed" => false])
                     ->addForeignKey('cod_payment', 'forma_pagamento', 'cod', ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION'])

                     ->create();
    }
}
