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

    public function create($data)
    {
        $sql = 'insert into posts (title, content, author, created, updated)'
            .' values ("'.$data['title'].'", "'.addslashes($data['content']).'", "'.$data['author'].'",'
            .' now(), now())';
        return $this->getDb()->execute($sql);
    }

    public function delete($postId)
    {
        $sql = 'delete from posts where ID = '.$postId;
        return $this->getDb()->execute($sql);
    }

    public function save($data)
    {
        $sql = 'update posts set title="'.$data['title'].'", content="'.addslashes($data['content']).'"'
            .', author = "'.$data['author'].'",'
            .' updated = now() where id = '. $data['id'];
        return $this->getDb()->execute($sql);
    }
}