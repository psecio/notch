<?php

use Phinx\Migration\AbstractMigration;

class CreateInitUsers extends AbstractMigration
{
    /**
     * Migrate Up.
     */
    public function up()
    {
        // Lets make some users!
        $users = array(
            array('username' => 'user1', 'password' => 'user1', 'email' => 'user1@test.com'),
            array('username' => 'user2', 'password' => 'user2', 'email' => 'user2@test.com'),
            array('username' => 'user3', 'password' => 'user2', 'email' => 'user3@test.com')
        );
        foreach ($users as $user) {
            $sql = 'insert into users (username, password, email, created, updated)'
                .' values ("'.$user['username'].'", "'.$user['password'].'", "'.$user['email'].'",'
                .' now(), now())';
            $this->execute($sql);
        }
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->execute('delete from users where username in ("user1", "user2", "user3")');
    }
}