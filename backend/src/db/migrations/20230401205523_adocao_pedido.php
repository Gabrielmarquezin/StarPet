<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AdocaoPedido extends AbstractMigration
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
        $adocao_pedido = $this->table('adocao_pedido', ['id' => false, 'primary_key' =>
        ['cod_user', 'cod_pet_adocao']]);

        $adocao_pedido->addColumn('cod_user', 'integer')
                      ->addColumn('cod_pet_adocao', 'integer')
                      ->addColumn('email', 'string', ['null' => false, 'limit' => '150'])
                      ->addColumn('cpf', 'string', ['null' => false, 'limit' => '16'])
                      ->addColumn('rua', 'string', ['null' => false, 'limit' => '100'])
                      ->addColumn('bairro', 'string', ['null' => false, 'limit' => '100'])
                      ->addColumn('telefone', 'string', ['limit' => '16'])
                      ->addColumn("casa", "string", ["null" => false, "limit" => 10])
                      ->addTimestamps('data_pedido', 'update_pedido')

                      ->create();
    }
}
