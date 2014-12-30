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
        $sql = 'select * from posts where ID = :postId';
        $data = array(':postId' => $postId);

        return $this->getDb()->fetchOne($sql, $data);
    }

    public function create($data)
    {
        $sql = 'insert into posts (title, content, author, created, updated)'
            .' values (:title, :content, :author, now(), now())';
        $data = array(
            ':title' => $data['title'],
            ':content' => $data['content'],
            ':author' => $data['author']
        );

        return $this->getDb()->execute($sql, $data);
    }

    public function delete($postId)
    {
        $sql = 'delete from posts where ID = :postId';
        $data = array('postId' => $postId);

        return $this->getDb()->execute($sql, $data);
    }

    public function save($data)
    {
        if (!isset($data['id']) || !is_numeric($data['id'])) {
            throw new \Exception('Invalid post ID!');
        }

        $sql = 'update posts set title = :title, content = :content, author = :author, updated = now()'
            .' where id = '.$data['id'];
        $data = array(
            ':title' => $data['title'],
            ':content' => $data['content'],
            ':author' => $data['author']
        );

        return $this->getDb()->execute($sql, $data);
    }
}