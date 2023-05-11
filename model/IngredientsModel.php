<?php

class Ingredients extends Model
{

    public function getAllIngredients()
    {
        $_POST = [];
        $req = $this->getDb()->query("SELECT `id`,`name` FROM `ingredients` ORDER BY `id`;");
        while ($post = $req->fetch(PDO::FETCH_ASSOC)) {
            $posts[] = new Post($post);
        }
        $req->closeCursor();
        return $posts;
    }

    public function getAddIngredient()
    {
        if (isset($_POST['submit'])) {
            $name = ($_POST['name']);
            $req = $this->getDb()->prepare("INSERT INTO `category` (`name`) VALUE ('$name')");
            $req->execute();
        }
    }

    public function getDeleteIngredient()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $reqdel = $this->getDb()->prepare("DELETE FROM `ingredients` WHERE `id`= :id");
            $reqdel->bindParam('id', $id, PDO::PARAM_INT);
            $reqdel->execute();
        }
    }
}
