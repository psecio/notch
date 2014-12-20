<?php

namespace Notch;

class Database
{
    private $db;

    public function __construct($host, $user, $pass, $dbname)
    {
        $this->db = mysql_connect($host, $user, $pass);
        mysql_select_db($dbname, $this->db);
    }

    public function execute($sql)
    {
        return mysql_query($sql, $this->db);
    }

    public function fetch($sql)
    {
        $results = array();
        $result = mysql_query($sql, $this->db);
        while($row = mysql_fetch_assoc($result)) {
            $results[] = $row;
        }
        return $results;
    }
    public function fetchOne($sql)
    {
        $result = $this->fetch($sql);
        return array_shift($result);
    }
}