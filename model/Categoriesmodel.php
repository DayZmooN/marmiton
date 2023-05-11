<?php

class Categories extends Model
{

    public function getAllCategories()
    {
        $_POST = [];
        $req = $this->getDb()->query('SELECT `id`,`title` FROM `categories` ORDER BY `id`;');
        while ($post = $req->fetch(PDO::FETCH_ASSOC)) {
            $posts[] = new Post($post);
        }
        $req->closeCursor();
        return $posts;
    }
}
