<?php

namespace Notch;

class Users extends Base
{
    public function getUserById($userId)
    {
        return $this->getDb()->fetchOne(
            'select * from users where id = :userId',
            array(':userId' => $userId)
        );
    }

    public function getUserByUsername($username)
    {
        return $this->getDb()->fetchOne(
            'select * from users where username = :username',
            array(':username' => $username)
        );
    }

    public function login($username, $password)
    {
        $sql = 'select * from users where username = :username and password = :password';
        $data = array(
            ':username' => $username,
            ':password' => $password
        );
        $result = $this->getDb()->fetchOne($sql, $data);
        return (empty($result)) ? false : true;
    }

    public function create($data)
    {
        $sql = 'insert into users (username, password, email, created, updated)'
            .' values (:username, :password, :email, now(), now())';
        $data = array(
            ':username' => $data['username'],
            ':password' => $data['password'],
            ':email' => $data['email']
        );

        return $this->getDb()->execute($sql, $data);
    }
}