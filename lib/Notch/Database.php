<?php

namespace Notch;

class Database
{
    private $db;

    public function __construct($host, $user, $pass, $dbname)
    {
        $dsn = 'mysql:host='.$host.';dbname='.$dbname;
        $this->db = new \PDO($dsn, $user, $pass);
    }

    public function execute($sql, array $data = array())
    {
        $sth = $this->db->prepare($sql);
        return $sth->execute($data);
    }

    public function fetch($sql, array $data = array())
    {
        $sth = $this->db->prepare($sql);
        $sth->execute($data);

        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function fetchOne($sql, array $data = array())
    {
        $result = $this->fetch($sql, $data);
        return array_shift($result);
    }
}