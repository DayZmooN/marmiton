<?php

class IngredientsModel extends Model
{

    public function getAllIngredients()
    {
        $ingredients = [];
        $req = $this->getDb()->query("SELECT `id`, `name` FROM `ingredients` ORDER BY `id`;");
        while ($ingredient = $req->fetch(PDO::FETCH_ASSOC)) {
            $ingredients[] = new Ingredients($ingredient);
        }
        $req->closeCursor();
        return $ingredients;
    }

    public function getOneIngredient()
    {
        $req = $this->getDb()->prepare('SELECT `id`, `title` FROM `ingredients` WHERE `id` = :id');
        $req->bindParam('id', $id, PDO::PARAM_INT);
        $req->execute();
        $categorie = new Ingredients($req->fetch(PDO::FETCH_ASSOC));
        $req->closeCursor();
        return $categorie;
    }

    public function getAddIngredient()
    {
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $req = $this->getDb()->prepare("INSERT INTO `ingredients` (`name`) VALUES (:name)");
            $req->bindParam('name', $name, PDO::PARAM_STR);
            $req->execute();
        }
    }

    public function getDeleteIngredient()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $reqdel = $this->getDb()->prepare("DELETE FROM `ingredients` WHERE `id` = :id");
            $reqdel->bindParam('id', $id, PDO::PARAM_INT);
            $reqdel->execute();
        }
    }

    public function getEditIngredient()
    {
        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $req = $this->getDb()->prepare("UPDATE `ingredients` SET `name` = :name WHERE `id` = :id");
            $req->bindParam('id', $id, PDO::PARAM_INT);
            $req->bindParam('name', $name, PDO::PARAM_STR);
            $req->execute();
        }
    }
}
