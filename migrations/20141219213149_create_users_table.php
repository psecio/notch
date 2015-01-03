<?php

use Phinx\Migration\AbstractMigration;

class CreateUsersTable extends AbstractMigration
{
    /**
     * Migrate Up.
     */
    public function up()
    {
        $posts = $this->table('users');
        $posts->addColumn('username', 'string')
            ->addColumn('password', 'text')
            ->addColumn('email', 'string')
            ->addColumn('avatar', 'string', array('null' => true))
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime')
            ->create();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->dropTable('users');
    }
}