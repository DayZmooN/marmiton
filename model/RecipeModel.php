<?php
class RecipeModel extends Model
{

    public function getAllRecipes()
    {
        $recipes = [];
        $req = $this->getDb()->query('SELECT `id_recipes`, `title`, `duration`, `slug`, `userid`,`content`,`thumbnail` FROM `recipes` ORDER BY `id_recipes`');
        while ($recipe = $req->fetch(PDO::FETCH_ASSOC)) {
            $recipes[] = new Recipes($recipe);
        }
        $req->closeCursor();
        return $recipes;
    }

    public function getOneRecipe($id)
    {
        $req = $this->getDb()->prepare('SELECT `id_recipes`, `title`, `duration`, `slug`, `userid`,`content`,`thumbnail` FROM `recipes` WHERE `id_recipes` = :id');
        $req->bindParam('id', $id, PDO::PARAM_INT);
        $req->execute();
        $recipe = new Recipes($req->fetch(PDO::FETCH_ASSOC));
        $req->closeCursor();
        return $recipe;
    }


    public function addRecipe(Recipes $recipe)
    {
        $userid = $_SESSION['id'];
        $title = $recipe->getTitle();
        $duration = $recipe->getDuration();
        $content = $recipe->getContent();
        $thumbnail = $recipe->getThumbnail();
        $slug = $recipe->getSlug();

        $result = [
            'success' => false,
            'message' => ''
        ];

        try {
            $req = $this->getDb()->prepare('INSERT INTO `recipes`(`title`, `slug`, `duration`, `userid`, `thumbnail`, `content`) VALUES (:title, :slug, :duration, :userid, :thumbnail, :content)');

            $req->bindParam('title', $title, PDO::PARAM_STR);
            $req->bindParam('slug', $slug, PDO::PARAM_STR);
            $req->bindParam('duration', $duration, PDO::PARAM_INT);
            $req->bindParam('userid', $userid, PDO::PARAM_INT);
            $req->bindParam('thumbnail', $thumbnail, PDO::PARAM_STR);
            $req->bindParam('content', $content, PDO::PARAM_STR);

            $req->execute();

            $result['success'] = true;
        } catch (PDOException $e) {
            $result['message'] = "Une erreur s'est produite lors de l'ajout de la recette : " . $e->getMessage();
        }

        return $result;
    }




    public function getIngredients($id)
    {
        $req = $this->getDb()->prepare("SELECT `id`, `name` FROM `ingredients` WHERE `id`= :id");
        $req->bindParam('id', $id, PDO::PARAM_INT);
        $req->execute();
        $ingredient = $req->fetch(PDO::FETCH_ASSOC);

        // Retourne l'ingrédient s'il existe, sinon retourne false
        return $ingredient ? new Ingredients($ingredient) : false;
    }

    public function getDeleteRecipe($recipeId)
    {
        $result = [
            'success' => false,
            'message' => ''
        ];

        // Supprimer la recette de la base de données
        $req = $this->getDb()->prepare("DELETE FROM `recipes` WHERE `id_recipes` = :id");
        $req->bindParam(':id', $recipeId, PDO::PARAM_INT);
        $req->execute();

        // Supprimer les ingrédients associés dans la table intermédiaire
        $reqIngredients = $this->getDb()->prepare("DELETE FROM `ingredient_recipes` WHERE `recipe_id` = :id");
        $reqIngredients->bindParam(':id', $recipeId, PDO::PARAM_INT);
        $reqIngredients->execute();

        // Vérifier si la suppression a réussi
        if ($req->rowCount() > 0 && $reqIngredients->rowCount() > 0) {
            $result['success'] = true;
        } else {
            $result['message'] = "Erreur lors de la suppression de la recette.";
        }

        return $result;
    }




    public function editRecipe(Recipes $recipe)
    {
        $id = $recipe->getId_recipes();
        $title = $recipe->getTitle();
        $duration = $recipe->getDuration();
        $content = $recipe->getContent();

        $req = $this->getDb()->prepare('UPDATE `recipes` SET `title` = :title, `duration` = :duration, `content` = :content WHERE `id_recipes` = :id_recipes');

        $req->bindParam('id_recipes', $id, PDO::PARAM_INT);
        $req->bindParam('title', $title, PDO::PARAM_STR);
        $req->bindParam('duration', $duration, PDO::PARAM_STR);
        $req->bindParam('content', $content, PDO::PARAM_STR);

        $req->execute();
    }
}
