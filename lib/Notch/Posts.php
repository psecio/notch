<?php

namespace Notch;

class Posts extends Base
{
    public function getLatest($limit = 10)
    {
        $sql = 'select * from posts order by created desc limit '.$limit;
        $posts = $this->getDb()->fetch($sql);

        return $posts;
    }

    public function getDetail($postId)
    {
        $sql = 'select * from posts where ID = '.$postId;
        return $this->getDb()->fetchOne($sql);
    }
}