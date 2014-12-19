<?php

use Phinx\Migration\AbstractMigration;

class CreateUsersPostsTable extends AbstractMigration
{
    /**
     * Migrate Up.
     */
    public function up()
    {
        $posts = $this->table('user_post');
        $posts->addColumn('user_id', 'integer')
            ->addColumn('post_id', 'integer')
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime')
            ->create();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->dropTable('user_post');
    }
}