<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class PetPedido extends AbstractMigration
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
        $pet_pedido = $this->table('pet_pedido', ['id' => false, 'primary_key' => 
        ['cod_user', 'cod_pet']]);

        $pet_pedido->addColumn('cod_user', 'integer')
                   ->addColumn('cod_pet', 'integer')
                   ->addColumn('cpf', 'string', ['null' => false, 'limit' => '16'])
                   ->addColumn('rua', 'string', ['null' => false, 'limit' => '100'])
                   ->addColumn('bairro', 'string', ['null' => false, 'limit' => '100'])
                   ->addColumn('telefone', 'string', ['limit' => '16'])
                   ->addColumn('cep', 'string', ['null' => false, 'limit' => '9'])
                   ->addColumn('nome', 'string', ['null' => false, 'limit' => '50'])
                   ->addColumn('email', 'string', ['null' => false, 'limit' => '100'])
                   ->addTimestamps('data_pedido', 'udpate_pedido')
                   ->addColumn('preco_total', 'decimal', ['null' => false, 'scale' => '2', 'precision' => '7'])

                   ->addColumn('cod_pagamento', 'integer', ["signed" => false])
                   ->addForeignKey('cod_pagamento', 'forma_pagamento', 'cod', ['delete' => 'RESTRICT', 'update' => 'NO_ACTION'])

                   ->create();
    }
}
