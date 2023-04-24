<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class User extends AbstractMigration
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
        $user = $this->table('users', ['id' => 'cod']);
        $user->addColumn('nome', 'string', ['null' => false,'limit' => '45'])
             ->addColumn('email', 'string', ['null' => false, 'limit' => '60'])
             ->addColumn('senha', 'string', ['limit' => '30'])
             ->addColumn('photo', 'binary')
             ->addColumn('rua', 'string', ['limit' => '100'])
             ->addColumn('bairro', 'string', ['limit' => '100'])
             ->addColumn('casa', 'string', ['limit' => '10'])
             ->addIndex(['email'], ['unique' => true])
             ->create();
    }
}
