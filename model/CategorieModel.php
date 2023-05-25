<?php

class CategorieModel  extends Model
{

    public function getAllCategories()
    {
        $categories = [];
        $req = $this->getDb()->query('SELECT `id`,`title` FROM `categories` ORDER BY `id`;');
        while ($categorie = $req->fetch(PDO::FETCH_ASSOC)) {
            $categories[] = new Categories($categorie);
        }
        return $categories;
    }

    public function getOneCategorie($id_recipes)
    {
        $req = $this->getDb()->prepare('SELECT `id`, `title` FROM `categories` WHERE `id` = :id_recipes');
        $req->bindParam('id_recipes', $id_recipes, PDO::PARAM_INT);
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
            $id_recipes = $_POST['id_recipes'];
            $title = $_POST['title'];
            $req = $this->getDb()->prepare("UPDATE `categories` SET `title` = :title WHERE `id_recipes` = :id_recipes");
            $req->bindParam('id_recipes', $id_recipes, PDO::PARAM_INT);
            $req->bindParam('title', $title, PDO::PARAM_STR);
            $req->execute();
        }
    }
    public function getDelete()
    {
        if (isset($_GET['id_recipes'])) {
            $id_recipes = $_GET['id_recipes'];
            $reqdel = $this->getDb()->prepare("DELETE FROM `ingredients` WHERE `id_recipes` = :id_recipes");
            $reqdel->bindParam('id_recipes', $id_recipes, PDO::PARAM_INT);
            $reqdel->execute();
        }
    }

    public function getRecipesByCategorie(int $categoryId)
    {
        $recipes = [];
        $req = $this->getDb()->prepare('SELECT `recipes`.`id_recipes`, `recipes`.`userid`, `recipes`.`title`, `recipes`.`duration`, `recipes`.`thumbnail`, `recipes`.`content`, `recipes`.`created_at` FROM `recipes` INNER JOIN `categories_recipes` ON `categories_recipes`.`recipe_id` = `recipes`.`id_recipes` INNER JOIN `categories` ON `categories_recipes`.`category_id` = `categories`.`id` WHERE `categories`.`id` = :categoryId');
        $req->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
        $req->execute();

        while ($recipeData = $req->fetch(PDO::FETCH_ASSOC)) {
            $recipes[] = new Recipes($recipeData);
        }

        return $recipes;
    }
}
