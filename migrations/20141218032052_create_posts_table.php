<?php

use Phinx\Migration\AbstractMigration;

class CreatePostsTable extends AbstractMigration
{
    /**
     * Migrate Up.
     */
    public function up()
    {
        $posts = $this->table('posts');
        $posts->addColumn('title', 'string')
            ->addColumn('content', 'text')
            ->addColumn('author', 'string')
            ->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime')
            ->create();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->dropTable('posts');
    }
}