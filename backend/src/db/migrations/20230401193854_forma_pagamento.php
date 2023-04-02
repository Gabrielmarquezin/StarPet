<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class FormaPagamento extends AbstractMigration
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
        $forma_pagamento = $this->table('forma_pagamento', ['id' => 'cod']);
        $forma_pagamento->addColumn('forma_payment', 'string',['limit' => '45'])
                        ->addColumn('parcelas', 'integer', ['precision' => '2'])
                        ->create();
    }
}
