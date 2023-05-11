<?php
class PostModel extends Model
{

    public function getAllRecipes()
    {
        $recipes = [];
        $req = $this->getDb()->query('SELECT `id_recipes`, `title`, `duration`, `slug`, `user_id` FROM `recipes` ORDER BY `id_recipes`');
        while ($recipe = $req->fetch(PDO::FETCH_ASSOC)) {
            $recipes[] = new Post($recipe);
        }
        $req->closeCursor();
        return $recipes;
    }

    public function getOneRecipe()
    {
        $req = $this->getDb()->prepare('SELECT `id_recipes`, `title`, `duration`, `slug`, `user_id` FROM `recipes` WHERE `user_id` = :id');
        $req->bindParam('id', $id, PDO::FETCH_ASSOC);
        $req->execute();
        $recipe = new Post($req->fetch(PDO::FETCH_ASSOC));
        $req->closeCursor();
        return $recipe;
    }
}
