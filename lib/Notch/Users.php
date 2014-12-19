<?php

namespace Notch;

class Users
{
    protected $di;

    public function __construct(\Pimple\Container $di)
    {
        $this->di = $di;
    }

    public function getUser($userId)
    {
        $db = $this->di['db'];
        return $db->fetchOne('select * from users where id = '.$userId);
    }

    public function login($username, $password)
    {
        $db = $this->di['db'];
        $result = $db->fetchOne(
            'select * from users where username = "'.$username.'" and password = "'.$password.'"'
        );
        return (empty($result)) ? false : true;
    }
}