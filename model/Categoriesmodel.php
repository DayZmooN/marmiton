<?php

class CategoriesModel  extends Model
{

    public function getAllCategories()
    {
        $_POST = [];
        $req = $this->getDb()->query('SELECT `id`,`title` FROM `categories` ORDER BY `id`;');
        while ($post = $req->fetch(PDO::FETCH_ASSOC)) {
            $posts[] = new Categories($post);
        }
        $req->closeCursor();
        return $posts;
    }

    public function getOneCategories()
    {
        $req = $this->getDb()->prepare('SELECT `id`, `title` FROM `categories` WHERE `id` = :id');
        $req->bindParam('id', $id, PDO::PARAM_INT);
        $req->execute();
        $categorie = new Categories($req->fetch(PDO::FETCH_ASSOC));
        $req->closeCursor();
        return $categorie;
    }

    public function getAddCategories()
    {
        if (isset($_POST['submit'])) {
            $title = $_POST['name'];
            $req = $this->getDb()->prepare("INSERT INTO `categories` (`title`) VALUES (:title)");
            $req->bindParam('title', $title, PDO::PARAM_STR);
            $req->execute();
        }
    }

    public function getEditCategories()
    {
        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $req = $this->getDb()->prepare("UPDATE `categories` SET `title` = :title WHERE `id` = :id");
            $req->bindParam('id', $id, PDO::PARAM_INT);
            $req->bindParam('title', $title, PDO::PARAM_STR);
            $req->execute();
        }
    }
    public function getDelete()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $reqdel = $this->getDb()->prepare("DELETE FROM `ingredients` WHERE `id` = :id");
            $reqdel->bindParam('id', $id, PDO::PARAM_INT);
            $reqdel->execute();
        }
    }
}
