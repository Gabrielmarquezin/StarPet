<?php
declare(strict_types=1);

use Phinx\Db\Action\AddColumn;
use Phinx\Migration\AbstractMigration;

final class ProdutoPedido extends AbstractMigration
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
        $produto_pedido = $this->table('produto_pedido', ['id' => false, 'primary_key' => ['cod_user', 'cod_produto']]);
        $produto_pedido->addColumn('cod_user', 'integer')
                       ->addColumn('cod_produto', 'integer')
                       ->addTimestamps('data_payment', 'update_payment')
                       ->addColumn('preco_total', 'decimal', ['null' => false,'scale' => '2', 'precision' => '7'])
                       ->addColumn('cpf', 'string', ['null' => false,'limit' => '16'])
                       ->addColumn('rua', 'string', ['null' => false,'limit' => '100'])
                       ->addColumn('bairro', 'string', ['null' => false, 'limit' => '100'])
                       ->addColumn('telefone', 'string', ['limit' => '18'])
                       ->addColumn('cep', 'string', ['null' => false, 'limit' => '9'])
                       ->addColumn('nome', 'string', ['null' => false, 'limit' => '50'])
                       ->addColumn('email', 'string', ['null' => false, 'limit' => '100'])
                       ->addColumn("casa_number", "string", ["limit" => "5"])
                       ->addColumn('cod_pagamento', 'integer', ["signed" => false])
                       ->addForeignKey('cod_pagamento', 'forma_pagamento', 'cod', ['delete' => 'RESTRICT', 'update' => 'NO_ACTION'])

                       ->create();
    }
}
