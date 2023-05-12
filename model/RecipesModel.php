<?php
class RecipeModel extends Model
{

    public function getAllRecipes()
    {
        $recipes = [];
        $req = $this->getDb()->query('SELECT `id_recipes`, `title`, `duration`, `slug`, `user_id`,`content`,`thumbnail` FROM `recipes` ORDER BY `id_recipes`');
        while ($recipe = $req->fetch(PDO::FETCH_ASSOC)) {
            $recipes[] = new Recipes($recipe);
        }
        $req->closeCursor();
        return $recipes;
    }

    public function getOneRecipe($id)
    {
        $req = $this->getDb()->prepare('SELECT `id_recipes`, `title`, `duration`, `slug`, `user_id`,`content`,`thumbnail` FROM `recipes` WHERE `id_recipes` = :id');
        $req->bindParam('id', $id, PDO::PARAM_INT);
        $req->execute();
        $recipe = new Recipes($req->fetch(PDO::FETCH_ASSOC));
        $req->closeCursor();
        return $recipe;
    }

    public function getCreatRecipe()
    {

        if (isset($_POST['submit'])) {
            // $recipes = ($_POST['recipes']);
            $id_recipes = ($_POST['id_recipes']);
            $title = ($_POST['title']);
            $slug = ($_POST['slug']);
            $duration = ($_POST['duration']);
            $user_id = ($_POST['user_id']);
            $thumbnail = ($_POST['thumbnail']);
            $content = ($_POST['content']);

            $req = $this->getDb()->prepare("INSERT INTO `recipes`(`id_recipes`, `title`, `slug`, `duration`, `user_id`, `thumbnail`, `content`) VALUES (:id_recipes, :title, :slug, :duration, :user_id, :thumbnail, :content)");


            $req->bindParam('id_recipes', $id_recipes, PDO::PARAM_INT);
            $req->bindParam('title', $title, PDO::PARAM_STR);
            $req->bindParam('slug', $slug, PDO::PARAM_STR);
            $req->bindParam('duration', $duration, PDO::PARAM_INT);
            $req->bindParam('user_id', $user_id, PDO::PARAM_INT);
            $req->bindParam('thumbnail', $thumbnail, PDO::PARAM_STR);
            $req->bindParam('content', $content, PDO::PARAM_STR);

            $req->execute();
            // $_SESSION['sucess'] = "Produit ajouté avec succès !";
            // exit();
        }
    }

    public function getDelete()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $req = $this->getDb()->prepare("DELETE FROM `recipes` WHERE `id_recipes`= :id");
            $req->bindParam('id', $id, PDO::PARAM_INT);

            $req->execute();
        }
    }

    public function getEditRecipe()
    {
        $id_recipes = ($_POST['id_recipes']);
        $title = ($_POST['title']);
        $slug = ($_POST['slug']);
        $duration = ($_POST['duration']);
        $user_id = ($_POST['user_id']);
        $thumbnail = ($_POST['thumbnail']);
        $content = ($_POST['content']);

        $req = $this->getDb()->prepare("UPDATE `recipes` SET `id_recipes`= :id_recipes, `title`= :title, `slug`= :slug, `duration`= :duration, `user_id`= :user_id, `thumbnail`= :thumbnail, `content`= :content WHERE `recipes`= :id");



        $req->bindParam('id_recipes', $id_recipes, PDO::PARAM_INT);
        $req->bindParam('title', $title, PDO::PARAM_STR);
        $req->bindParam('slug', $slug, PDO::PARAM_STR);
        $req->bindParam('duration', $duration, PDO::PARAM_INT);
        $req->bindParam('user_id', $user_id, PDO::PARAM_INT);
        $req->bindParam('thumbnail', $thumbnail, PDO::PARAM_STR);
        $req->bindParam('content', $content, PDO::PARAM_STR);


        $req->execute();
    }
}
