<?php

namespace Notch;

class Posts
{
    protected $di;

    public function __construct(\Pimple\Container $di)
    {
        $this->di = $di;
    }

    public function getLatest($limit = 10)
    {
        $db = $this->di['db'];
        $sql = 'select * from posts order by created desc limit '.$limit;
        $posts = $db->fetch($sql);

        return $posts;
    }

    public function getDetail($postId)
    {
        $db = $this->di['db'];
        $sql = 'select * from posts where ID = '.$postId;
        return $db->fetchOne($sql);
    }
}